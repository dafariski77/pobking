<?php
include('./side_menu.php');
?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $data = $db->get_user_byid($id, 'user');
} else {
  header('location: user.php');
}
?>

<div class="component text-white">
  <h2>Edit User</h2>
  <hr>
  <form method="POST" action="user_edit.php">
    <input type="text" class="form-control" name="id" value="<?php echo $data[0]['id']; ?>" hidden>
    <div class="mb-3 col-md-4">
      <label for="nim" class="form-label">NIM</label>
      <input type="text" class="form-control" name="Nim" value="<?php echo $data[0]['nim']; ?>" disabled>
    </div>
    <div class="mb-3 col-md-4">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" name="Nama" value="<?php echo $data[0]['name']; ?>" disabled>
    </div>
    <div class="mb-3 col-md-4">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="Password" value="<?php echo $data[0]['password']; ?>">
    </div>
    <a href="./user.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-pinjam" name="Submit">Update</button>
  </form>
</div>
</div>
</div>
</main>
<?php
if (isset($_POST['Submit'])) {
  $id = $_POST['id'];
  $password = $_POST["Password"];
  $kelas = $_POST["Kelas"];

  echo "<h1>$id, $password, $kelas</h1>";
  $db->edit_user($id, $password);
}
?>
</body>

</html>