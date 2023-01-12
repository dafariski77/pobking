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

  function login($username, $password)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    $cek = mysqli_num_rows($sql);
    if ($cek > 0) {
      $_SESSION['username'] = $username;
      $_SESSION['status'] = "login";
      header("location: dashboard.php");
    } else {
      header("location: login.php?pesan=gagal");
    }
  }

  function hitung_row($table)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM $table");
    $count = mysqli_num_rows($sql);
    return $count;
  }

  function tampil_user()
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM user ORDER BY nim");
    if (mysqli_num_rows($sql) > 0) {
      while ($row_user = mysqli_fetch_array($sql)) {
        $hasil_user[] = $row_user;
      }
      return $hasil_user;
    }
  }

  function add_user($nim, $password, $name)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM data_mhs WHERE nim='$nim' and name='$name'");
    if (mysqli_num_rows($sql) > 0) {
      $cek = mysqli_query($this->conn, "SELECT * FROM user WHERE nim='$nim'");
      if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIM sudah terdaftar!')</script>";
      } else {
        mysqli_query($this->conn, "INSERT INTO user VALUES('', '$nim', '$password', '$name')");
        header('Location: user.php');
      }
    } else {
      echo "<script>alert('NIM dan Nama tidak terdaftar di Polines!')</script>";
    }
  }

  function get_user_byid($id, $db)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM $db WHERE id='$id'");
    while ($row_id = mysqli_fetch_array($sql)) {
      $hasil_id[] = $row_id;
    }
    return $hasil_id;
  }

  function edit_user($id, $password)
  {
    mysqli_query(
      $this->conn,
      "UPDATE user SET password='$password', WHERE id='$id'"
    );
  }

  function hapus_user($id)
  {
    mysqli_query($this->conn, "DELETE FROM user WHERE id='$id'");
  }

  function show_mahasiswa()
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM data_mhs ORDER BY nim");
    if (mysqli_num_rows($sql) > 0) {
      while ($row_mhs = mysqli_fetch_array($sql)) {
        $hasil_mhs[] = $row_mhs;
      }
      return $hasil_mhs;
    }
  }
  function add_mhs($nim, $name, $kelas)
  {
    mysqli_query($this->conn, "INSERT INTO data_mhs VALUES('', '$nim', '$name', '$kelas')");
    header('location: mahasiswa.php');
  }

  function edit_mhs($id, $nim, $name, $kelas)
  {
    mysqli_query(
      $this->conn,
      "UPDATE data_mhs SET nim='$nim', name='$name', kelas='$kelas' WHERE id='$id'"
    );
  }

  function hapus_mhs($id)
  {
    mysqli_query(
      $this->conn,
      "DELETE FROM data_mhs WHERE id='$id'"
    );
  }

  function show_barang()
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM barang ORDER BY kode_barang");
    if (mysqli_num_rows($sql) > 0) {
      while ($row_barang = mysqli_fetch_array($sql)) {
        $hasil_barang[] = $row_barang;
      }
      return $hasil_barang;
    }
  }

  function add_barang($kode_brg, $nama_brg, $img, $stok)
  {
    $sql = mysqli_query($this->conn, "SELECT * FROM barang WHERE kode_barang='$kode_brg'");
    if (mysqli_num_rows($sql) > 0) {
      echo "<script>alert('Kode Barang sudah ada!')</script>";
    } else {
      mysqli_query(
        $this->conn,
        "INSERT INTO barang VALUES('', '$kode_brg', '$nama_brg', '$img', '$stok', '')"
      );
      header("location: barang.php");
    }
  }

  function hapus_barang($kode_brg)
  {
    mysqli_query(
      $this->conn,
      "DELETE FROM barang WHERE kode_barang='$kode_brg'"
    );
  }

  function edit_barang($id, $kode_brg, $nama_brg, $img, $stok)
  {
    mysqli_query($this->conn, "UPDATE barang SET kode_barang='$kode_brg', nama_barang='$nama_brg', img='$img', stok='$stok' WHERE id='$id'");
  }

  function show_pinjam()
  {
    $join = "SELECT a.*, b.kode_barang, b.nama_barang from peminjaman a INNER JOIN barang b ON b.kode_barang = a.kode_barang ORDER BY kode_peminjaman DESC";
    $sql = mysqli_query($this->conn, $join);
    if (mysqli_num_rows($sql) > 0) {
      while ($row_pinjam = mysqli_fetch_array($sql)) {
        $hasil[] = $row_pinjam;
      }
      return $hasil;
    }
  }

  function update_status($id, $status, $kode_brg, $jumlah)
  {
    $time = date("H:i");
    if ($status == "Dipinjam") {
      $update = "UPDATE peminjaman SET keterangan='$status', waktu_kembali='--:--' WHERE id=$id";
      $update2 = "UPDATE barang SET stok=STOK - $jumlah WHERE kode_barang='$kode_brg'";
      mysqli_query($this->conn, $update);
      mysqli_query($this->conn, $update2);
      // menjadi dipinjam
    } elseif ($status == "Dikembalikan") {
      $update = "UPDATE peminjaman SET keterangan='$status', waktu_kembali='$time' WHERE id=$id";
      $update2 = "UPDATE barang SET stok=STOK + $jumlah, total_dipinjam=TOTAL_DIPINJAM + $jumlah WHERE kode_barang='$kode_brg'";
      mysqli_query($this->conn, $update);
      mysqli_query($this->conn, $update2);
      // menjadi dikembalikan
    } elseif ($status == "Belum diambil") {
      $update = "UPDATE peminjaman SET keterangan='$status', waktu_kembali='--:--' WHERE id=$id";
      mysqli_query($this->conn, $update);
    }
  }
  function del_pinjam($id)
  {
    mysqli_query($this->conn, "DELETE FROM peminjaman WHERE id='$id'");
  }

  function show_belum_kembali()
  {
    $join = "SELECT a.*, b.kode_barang, b.nama_barang from peminjaman a INNER JOIN barang b ON b.kode_barang = a.kode_barang WHERE keterangan='Dipinjam'";
    $sql = mysqli_query($this->conn, $join);
    if (mysqli_num_rows($sql) > 0) {
      while ($row = mysqli_fetch_array($sql)) {
        $hasil[] = $row;
      }
      return $hasil;
    }
  }

  function show_belum_diambil()
  {
    $join = "SELECT a.*, b.kode_barang, b.nama_barang from peminjaman a INNER JOIN barang b ON b.kode_barang = a.kode_barang WHERE keterangan='Belum diambil'";
    $sql = mysqli_query($this->conn, $join);
    if (mysqli_num_rows($sql) > 0) {
      while ($row = mysqli_fetch_array($sql)) {
        $hasil[] = $row;
      }
      return $hasil;
    }
  }

}
?>