<?php
include('./side_menu.php');
?>

<div class="component text-white">
  <h2>Tambah User</h2>
  <hr>
  <form method="post" action="user_add.php">
    <div class="mb-3 col-md-4">
      <label for="nim" class="form-label">NIM</label>
      <input type="text" class="form-control" name="nim">
    </div>
    <div class="mb-3 col-md-4">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" name="nama">
    </div>
    <div class="mb-3 col-md-4">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
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
  $password = $_POST["password"];
  $name = $_POST["nama"];

  $db->add_user($nim, $password, $name);
}
?>

</body>

</html>