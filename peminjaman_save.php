<?php
session_start();
include 'config.php';
$db = new database();
if (isset($_POST['del'])) {
  if (($key = array_search($_POST['nama_brg_list'], $_SESSION['nama_bag'])) !== false) {
    // print_r($_SESSION['nama_bag']);
    unset($_SESSION['nama_bag'][$key]);
  }
  if (($key = array_search($_POST['kode_brg_list'], $_SESSION['kode_bag'])) !== false) {
    // print_r($_SESSION['kode_bag']);
    unset($_SESSION['kode_bag'][$key]);
  }
  // echo $_POST['kode_brg_list'];
  // print_r($_SESSION['kode_bag']);
  header('location: tool_list.php');
}

if (isset($_POST['pinjam'])) {
  $random = random_int(1, 10000);
  $kode_peminjaman = "PB" . $random;
  $arr_length = count($_SESSION['kode_bag']);
  for ($i = 0; $i < $arr_length; $i++) {
    $barang = $db->get_tool_byname($_SESSION['kode_bag'][$i]);
    if (is_array($barang) || is_object($barang)) {
      foreach ($barang as $b) {
        $kode_brg = $b['kode_barang'];
        $name = $_SESSION['name'];
        $room = $_POST['room'];
        $waktu_pinjam = $_POST['waktu_pinjam'];
        $jumlah = $_POST['jumlah'];
        $row_jumlah = $b['stok'];
        $total = $row_jumlah - $jumlah[$i];
        if (in_array("", $jumlah, true)) {
          header('location: tool_list.php?status=out_stock');
        } else {
          if ($total > 0) {
            if ($waktu_pinjam) {
              $db->pinjam($kode_peminjaman, $kode_brg, $name, $room, $waktu_pinjam, "--:--", $jumlah[$i]);
              header('location: peminjaman.php');
            } else {
              header('location: tool_list.php?status=null_val');
            }
          } else {
            header('location: tool_list.php?status=out_stock');
          }
        }
        // $jumlah[$i];

        // print_r($jumlah);
        // echo "<br>";
        // echo strlen($jumlah[$i]);
        // echo "<br>";
        // echo $total;
        //   echo "gagal";
        // } else {
        //   echo "$total";
        //   header('location: tool_list.php?status=out_stock');
        // }
      }
    }
  }
  unset($_SESSION['kode_bag']);
  unset($_SESSION['nama_bag']);
}
?>