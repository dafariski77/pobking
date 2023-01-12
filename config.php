<?php
class database
{
  var $host = 'localhost';
  var $username = 'root';
  var $password = '';
  var $db = 'lab';
  var $conn = '';

  function __construct()
  {
    date_default_timezone_set('Asia/Jakarta');
    $this->conn = mysqli_connect(
      $this->host,
      $this->username,
      $this->password,
      $this->db
    );
    if (!$this->conn) {
      echo 'Koneksi error!';
    }
  }

  function login($nim, $password)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM user WHERE nim='$nim' and password='$password'");
    if (mysqli_num_rows($sql) > 0) {
      $_SESSION['nim'] = $nim;
      $_SESSION['status'] = "login";

      $row = mysqli_fetch_array($sql);
      $_SESSION['name'] = $row['name'];
      $_SESSION['kelas'] = $row['kelas'];

      header("location: main.php");
    } else {
      header("location: login.php?pesan=gagal");
    }
  }

  function register($nim, $password, $name)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM data_mhs WHERE nim='$nim' and name='$name'");
    if (mysqli_num_rows($sql) > 0) {
      $cek = mysqli_query($this->conn, "SELECT * FROM user WHERE nim='$nim'");
      if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIM sudah terdaftar!')</script>";
      } else {
        mysqli_query($this->conn, "INSERT INTO user VALUES('', '$nim', '$password', '$name')");
        header('Location: main.php');
      }
    } else {
      echo "<script>alert('NIM dan Nama tidak terdaftar di Polines!')</script>";
    }
  }

  function get_tool()
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM barang ORDER BY total_dipinjam DESC");
    while ($row_tool = mysqli_fetch_array($sql)) {
      $hasil_tool[] = $row_tool;
    }
    return $hasil_tool;
  }

  function get_tool_byname($kode_brg)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM barang WHERE kode_barang='$kode_brg'");
    if (mysqli_num_rows($sql) > 0) {
      while ($row_pinjam = mysqli_fetch_array($sql)) {
        $hasil[] = $row_pinjam;
      }
      return $hasil;
    }
  }

  function pinjam(
    $kode_peminjaman,
    $nama_brg,
    $nama_peminjam,
    $ruangan,
    $waktu_pinjam,
    $waktu_kembali,
    $jumlah
  )
  {
    $curr_date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO peminjaman VALUES (
      '',
      '$kode_peminjaman', 
      '$nama_brg', 
      '$nama_peminjam', 
      '$ruangan',
      '$curr_date', 
      '$waktu_pinjam', 
      '$waktu_kembali', 
      '$jumlah', 
      'Belum diambil'
    )";
    mysqli_query(
      $this->conn,
      $sql
    );
  }

  function show_pinjam($user)
  {
    $join = "SELECT a.*, b.kode_barang, b.nama_barang from peminjaman a INNER JOIN barang b ON b.kode_barang = a.kode_barang WHERE nama_peminjam='$user' ORDER BY kode_peminjaman DESC";
    $sql = mysqli_query($this->conn, $join);
    if (mysqli_num_rows($sql) > 0) {
      while ($row_pinjam = mysqli_fetch_array($sql)) {
        $hasil[] = $row_pinjam;
      }
      return $hasil;
    }
  }

  function cancel($id)
  {
    mysqli_query($this->conn, "DELETE FROM peminjaman WHERE id='$id'");
  }

}
?>