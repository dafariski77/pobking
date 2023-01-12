<?php
include('side_menu.php');
?>

<div class="component">
  <div class="d-flex justify-content-between">
    <h2>Data User</h2>
    <a class="btn btn-pinjam" href="./user_add.php"><i class="fa fa-plus"></i> Tambah</a>
  </div>
  <table class="table table-bordered text-white mt-4 table-dark table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">No</th>
        <th scope="col">NIM</th>
        <th scope="col">Nama</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if (empty($db->tampil_user())) {
        echo "<td colspan='6' class='text-center'>Data Kosong</td>";
      } else {
        foreach ($db->tampil_user() as $x) {
          ?>
          <tr>
            <form action="user.php" method="post">
              <input type="text" name="id" value="<?php echo $x['id']; ?>" hidden />
              <td class="text-center">
                <?php echo $no++; ?>
              </td>
              <td><?php echo $x['nim']; ?></td>
              <td>
                <?php echo $x['name']; ?>
              </td>
              <td class="text-center">
                <a class="btn btn-success" href="user_edit.php?id=<?php echo $x['id']; ?>"><i class="fa fa-edit"></i></a>
                <button type="submit" class="btn btn-danger" name="Delete"><i class="fa fa-trash"></i></button>
              </td>
            </form>
          </tr>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>

<?php
if (isset($_POST['Delete'])) {
  $id = $_POST['id'];
  $db->hapus_user($id);
  echo "<meta http-equiv='refresh' content='0'>";
}
?>

</div>
</div>
</main>

</body>

</html>