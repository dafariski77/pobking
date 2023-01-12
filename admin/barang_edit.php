<?php
include('./side_menu.php');
?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $data = $db->get_user_byid($id, 'barang');
} else {
  header('location: barang.php');
}
?>

<div class="component text-white">
  <h2>Edit Barang</h2>
  <hr>
  <form method="post" action="barang_edit.php" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="<?php echo $data[0]['id']; ?>">
    <input type="hidden" class="form-control" name="img_null" value="<?php echo $data[0]['img']; ?>">
    <div class="mb-3 col-md-3">
      <label for="kode_brg" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" name="kode_brg" value="<?php echo $data[0]['kode_barang']; ?>">
    </div>
    <div class="mb-3 col-md-6">
      <label for="nama_brg" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" name="nama_brg" value="<?php echo $data[0]['nama_barang']; ?>">
    </div>
    <div class="mb-3 col-md-4">
      <label for="img" class="form-label">Gambar</label>
      <?php
      if (empty($data[0]['img'])) {
        ?>
        <div class="alert alert-danger" role="alert">
          Foto belum ada!
        </div>
        <input type="file" class="form-control" name="img">
        <?php
      } else {
        ?>
        <br>
        <img src="./img/<?php echo $data[0]['img']; ?>" width="100">
        <input type="file" class="form-control mt-2" name="img" value="<?php echo $data[0]['img']; ?>">
        <?php
      }
      ?>
    </div>
    <div class="mb-3 col-md-2">
      <label for="stok" class="form-label">Stok</label>
      <input type="text" class="form-control" name="stok" value="<?php echo $data[0]['stok']; ?>">
    </div>
    <a href="./barang.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-pinjam" name="Submit">Update</button>
  </form>
</div>

</div>
</div>
</main>

<?php
if (isset($_POST['Submit'])) {
  $id = $_POST['id'];
  $kode_brg = $_POST['kode_brg'];
  $nama_brg = $_POST['nama_brg'];
  $img = $_FILES['img']['name'];
  $stok = $_POST['stok'];
  $img_null = $_POST['img_null'];

  if ($img != "") {
    $ext_list = array('png', 'jpg', 'jpeg');
    $x = explode('.', $img);
    $ext = $x[1];
    $file_tmp = $_FILES['img']['tmp_name'];
    $random = rand(1, 999);
    $img_name = $random . "-" . $img;
    if (in_array($ext, $ext_list) === true) {
      move_uploaded_file($file_tmp, "img/" . $img_name);
      $db->edit_barang($id, $kode_brg, $nama_brg, $img_name, $stok);
    } else {
      echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='barang.php';</script>";
    }
  } else {
    $db->edit_barang($id, $kode_brg, $nama_brg, $img_null, $stok);
  }

}
?>

</body>

</html>