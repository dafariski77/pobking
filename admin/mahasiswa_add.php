<?php
include('./side_menu.php');
?>

<div class="component text-white">
  <h2>Tambah User</h2>
  <hr>
  <form method="post" action="mahasiswa_add.php">
    <div class="mb-3 col-md-4">
      <label for="nim" class="form-label">NIM</label>
      <input type="text" class="form-control" name="nim">
    </div>
    <div class="mb-3 col-md-4">
      <label for="name" class="form-label">Nama</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3 col-md-4">
      <label for="kelas" class="form-label">Kelas</label>
      <input type="text" class="form-control" name="kelas">
    </div>
    <a href="./user.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-pinjam" name="Submit">Simpan</button>
  </form>
</div>

</div>
</div>
</main>

<?php
if (isset($_POST['Submit'])) {
  $nim = $_POST["nim"];
  $name = $_POST["name"];
  $kelas = $_POST["kelas"];

  $db->add_mhs($nim, $name, $kelas);
}
?>

</body>

</html>