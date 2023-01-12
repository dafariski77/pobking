<?php
include('side_menu.php');
?>

<div class="component">
  <div class="d-flex justify-content-between">
    <h2>Data Barang</h2>
    <a class="btn btn-pinjam" href="./barang_add.php"><i class="fa fa-plus"></i> Tambah</a>
  </div>
  <table class="table table-bordered text-white mt-4 table-dark table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">No</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Gambar</th>
        <th scope="col">Stok</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if (empty($db->show_barang())) {
        echo "<td colspan='6' class='text-center'>Data Kosong</td>";
      } else {
        foreach ($db->show_barang() as $x) {
          ?>
          <tr class="text-center">
            <form action="barang.php" method="post">
              <input type="text" name="kode_brg" value="<?php echo $x['kode_barang']; ?>" hidden />
              <td>
                <?php echo $no++; ?>
              </td>
              <td><?php echo $x['kode_barang']; ?></td>
              <td>
                <?php echo $x['nama_barang']; ?>
              </td>
              <td><img src="./img/<?php echo $x['img']; ?>" style="text-align: center; width: 100px;"></td>
              <td>
                <?php echo $x['stok']; ?>
              </td>
              <td>
                <a class="btn btn-success" href="barang_edit.php?id=<?php echo $x['id']; ?>"><i class="fa fa-edit"></i></a>
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
  $kode_brg = $_POST['kode_brg'];
  $db->hapus_barang($kode_brg);
  echo "<meta http-equiv='refresh' content='0'>";
}
?>

</div>
</div>
</main>

</body>

</html>