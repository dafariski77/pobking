<?php
session_start();
include('./config.php');
$db = new database();
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pobking</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body style="background-color: #393e46;">
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark px-5 fixed-top">
      <a class="navbar-brand" href="./main.php">
        <img src="./img/logo.png" width="30" />
      </a>
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
        aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./main.php" aria-current="page">Home <span
                class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./tool_list.php">List Alat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./peminjaman.php">Pinjamanku</a>
          </li>
        </ul>
        <form class="d-flex my-2 my-lg-0">
          <?php
          if ($name == "") {
            ?>
            <a class="btn-pinjam-reverse my-2 my-sm-0 me-3" href="./register.php">
              Register
            </a>
            <a class="btn-pinjam my-2 my-sm-0" href="./login.php">
              Login
            </a>
            <?php
          } else {
            ?>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" style="color: #ff5f00;">
                  <?php echo $name ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownId">
                  <a class="dropdown-item" href="./logout.php">Logout</a>
                </div>
              </li>
            </ul>
            <?php
          }
          ?>
        </form>
      </div>
    </nav>
  </header>