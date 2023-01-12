<?php
include('./side_menu.php');
?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $data = $db->get_user_byid($id, 'data_mhs');
} else {
  header('location: mahasiswa.php');
}
?>

<div class="component text-white">
  <h2>Edit User</h2>
  <hr>
  <form method="POST" action="mahasiswa_edit.php">
    <input type="text" class="form-control" name="id" value="<?php echo $data[0]['id']; ?>" hidden>
    <div class="mb-3 col-md-4">
      <label for="nim" class="form-label">NIM</label>
      <input type="text" class="form-control" name="nim" value="<?php echo $data[0]['nim']; ?>">
    </div>
    <div class="mb-3 col-md-4">
      <label for="name" class="form-label">Nama</label>
      <input type="text" class="form-control" name="name" value="<?php echo $data[0]['name']; ?>">
    </div>
    <div class="mb-3 col-md-4">
      <label for="kelas" class="form-label">Kelas</label>
      <input type="text" class="form-control" name="kelas" value="<?php echo $data[0]['kelas']; ?>">
    </div>
    <a href="./mahasiswa.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-pinjam" name="Submit">Update</button>
  </form>
</div>
</div>
</div>
</main>
<?php
if (isset($_POST['Submit'])) {
  $id = $_POST['id'];
  $nim = $_POST["nim"];
  $name = $_POST["name"];
  $kelas = $_POST["kelas"];
  $db->edit_mhs($id, $nim, $name, $kelas);
}
?>
</body>

</html>