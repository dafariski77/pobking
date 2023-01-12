<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="./css/style.css" />

  <style>
    section {
      background: url("./img/login-main.jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }

    .form-login {
      margin-top: 60px;
    }

    .img-left {
      background: url("./img/left.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    @media (min-width: 768px) {
      .gradient-form {
        height: 100vh !important;
      }
    }
  </style>
</head>

<body>
  <?php
  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") { ?>
      <script>alert("Login gagal! username dan password salah!")</script>
      <?php
    } else if ($_GET['pesan'] == 'logout') { ?>
      <script>alert("Berhasil logout!")</script>
      <?php
    } else if ($_GET['pesan'] == "belum_login") { ?>
      <script>alert("Anda harus login terlebih dahulu!")</script>
      <?php
    }
  }
  ?>
  <section class="h-100 gradient-form">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="bg-dark text-black">
            <div class="row g-0">
              <div class="col-lg-6 d-flex img-left"></div>
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <img src="./img/logo.png" style="width: 225px" alt="logo" />
                  </div>
                  <form action="register.php" class="form-login" method="post">
                    <div class="form-outline mb-4">
                      <input type="text" name="nim" class="form-control" placeholder="NIM" />
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text" name="nama" class="form-control" placeholder="Nama" />
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="pt-2 mb-5 pb-1" style="text-align: right !important;">
                      <button class="btn-pinjam fa-lg mb-3" type="submit" name="Submit">
                        Register
                      </button>
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2 text-white">Sudah punya akun?</p>
                      <a href="./login.php" class="text-pinjam">
                        Login
                      </a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  if (isset($_POST['Submit'])) {
    session_start();

    include 'config.php';
    $db = new database();

    $nim = $_POST["nim"];
    $password = $_POST["password"];
    $name = $_POST["nama"];

    $db->register($nim, $password, $name);
  }
  ?>

  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>
</body>

</html>