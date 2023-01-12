<?php
include('./side_menu.php');
?>

<div class="component text-white">
  <h2>Tambah Barang</h2>
  <hr>
  <form method="post" action="barang_add.php" enctype="multipart/form-data">
    <div class="mb-3 col-md-3">
      <label for="kode_brg" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" name="kode_brg">
    </div>
    <div class="mb-3 col-md-6">
      <label for="nama_brg" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" name="nama_brg">
    </div>
    <div class="mb-3 col-md-4">
      <label for="img" class="form-label">Gambar</label>
      <input type="file" class="form-control" name="img">
    </div>
    <div class="mb-3 col-md-2">
      <label for="stok" class="form-label">Stok</label>
      <input type="text" class="form-control" name="stok">
    </div>
    <a href="./barang.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-pinjam" name="Submit">Simpan</button>
  </form>
</div>

</div>
</div>
</main>

<?php
if (isset($_POST['Submit'])) {
  $kode_brg = $_POST['kode_brg'];
  $nama_brg = $_POST['nama_brg'];
  $img = $_FILES['img']['name'];
  $stok = $_POST['stok'];

  if ($img != "") {
    $ext_list = array('png', 'jpg', 'jpeg');
    $x = explode('.', $img);
    $ext = $x[1];
    $file_tmp = $_FILES['img']['tmp_name'];
    $random = rand(1, 999);
    $img_name = $random . "-" . $img;
    if (in_array($ext, $ext_list) === true) {
      move_uploaded_file($file_tmp, "img/" . $img_name);
      $db->add_barang($kode_brg, $nama_brg, $img_name, $stok);
    } else {
      echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='barang.php';</script>";
    }
  } else {
    $db->add_barang($kode_brg, $nama_brg, "", $stok);
  }

}
?>

</body>

</html>