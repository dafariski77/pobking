<!doctype html>
<html lang="en">

<head>
  <title>Admin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body class="text-white" style="background-color: #393e46;">
  <?php
  session_start();
  include('config.php');
  $db = new database();
  if ($_SESSION['status'] != "login") {
    header("location: login.php?pesan=belum_login");
  }
  ?>
  <main>
    <div class="wrapper bg-dark">
      <nav id="sidebar" class="bg-dark navbar-dark">
        <a class="sidebar-header d-flex align-items-center" href="#">
          <img src="../img/logo.png" />
        </a>
        <ul class="list-unstyled components">
          <li>
            <a href="./dashboard.php">Dashboard</a>
          </li>
          <li>
            <a href="./barang.php">Barang</a>
          </li>
          <li>
            <a href="./peminjaman.php">Peminjaman</a>
          </li>
          <li>
            <a href="./user.php">Users</a>
          </li>
          <li>
            <a href="./mahasiswa.php">Mahasiswa</a>
          </li>
          <li>
            <a href="./logout.php">Logout</a>
          </li>
        </ul>
      </nav>
      <div id="content">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
          <div class="head">
            <a class="navbar-brand" href="#">Admin Page</a>
            <form class="d-flex my-2 my-lg-0">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Admin</a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="./logout.php">Logout</a>
                  </div>
                </li>
              </ul>
            </form>
          </div>
        </nav>
        <!-- Your code here? -->