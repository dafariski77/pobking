<?php
include('./nav.php');
$nim = $_SESSION['nim'];
if ($nim != "") {
  if (!isset($_SESSION['kode_bag']) || !isset($_SESSION['nama_bag'])) {
    $_SESSION['kode_bag'] = [];
    $_SESSION['nama_bag'] = [];
  }

  if (isset($_POST['tambah'])) {
    if (!in_array($_POST['kode_brg'], $_SESSION['kode_bag'], true)) {
      array_push($_SESSION['kode_bag'], $_POST['kode_brg']);
      array_push($_SESSION['nama_bag'], $_POST['nama_brg']);
      echo "<script>alert('Alat telah ditambahkan ke Tas!')</script>";
    } else {
      echo "<script>alert('Alat sudah ada di Tas!')</script>";
    }
  }
  ?>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Tasku</h5>
        <span class="close-btn">&times;</span>
      </div>
      <div class="modal-body py-2">
        <?php
        if (empty($_SESSION['kode_bag']) && empty($_SESSION['nama_bag'])) {
          ?>
          <p>Masih Kosong...</p>
          <?php
        } else {
          $name1 = array_unique($_SESSION['nama_bag'], SORT_STRING);
          $kode = array_unique($_SESSION['kode_bag'], SORT_STRING);
          foreach ($name1 as $index => $name) {
            ?>
            <form action="peminjaman_save.php" method="post">
              <input type="hidden" name="nama_brg_list" value="<?php echo $name; ?>">
              <input type="hidden" name="kode_brg_list" value="<?php echo $kode[$index]; ?>">
              <div class="d-flex barang justify-content-between" style="padding: 8px 20px !important;">
                <div>
                  <span>
                    <?php echo $name; ?>
                  </span><br>
                  <input type="text" class="form-control ml-2" name="jumlah[]" width="10px" placeholder="Jumlah"
                    style="width: 100px !important;">
                </div>
                <div class="row">
                  <button class="btn btn-linky" type="submit" name="del"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <?php
          }
          ?>
        </div>
        <div class="modal-footer d-flex justify-content-between form-inline">
          <div class="col-auto">
            <label for="waktu_pinjam">Pinjam</label>
            <input type="time" class="form-control" name="waktu_pinjam" placeholder="Pinjam">
          </div>
          <div class="col-auto">
            <label for="room">Ruangan</label>
            <input type="text" class="form-control" name="room" placeholder="Ruangan">
          </div>
          <div class="col-auto">
            <label for="pinjam"></label>
            <input type="submit" name="pinjam" class="btn btn-secondary form-control" value="Gass Pinjam"
              style="background-color: #ff5f00 !important;">
            <!-- <button type="submit" name="pinjam" class="btn-pinjam" style="margin: 0 !important;">Gass Pinjam</button> -->
          </div>
          </form>
          <?php
        }
        ?>
      </div>

    </div>
  </div>
  <main>
    <div class="list-tool container">
      <button id="btnModal" class="btn-modal text-white"><i class="fa fa-briefcase fa-lg"></i></button>
      <h1 class="text-white">List Alat</h1>
      <hr class="text-secondary">
      <?php
      if (isset($_GET['status'])) {
        $info = $_GET['status'];
        if ($info == "out_stock") {
          ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
              Jumlah tidak boleh kosong atau melebihi stok!
            </div>
          </div>
          <?php
        } elseif ($info == "null_val") {
          ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
              Pastikan semua field terisi!
            </div>
          </div>
          <?php
        }
      }
      ?>
      <div class="card-group d-flex justify-content-center text-center">
        <?php
        foreach ($db->get_tool() as $x) {
          ?>
          <div class="tool d-flex flex-column bg-dark">
            <img src="./admin/img/<?php echo $x['img']; ?>" height="160px" style="background-color: white !important;" />
            <h5 class="text-white my-3">
              <?php echo $x['nama_barang']; ?>
            </h5>
            <form action="tool_list.php" method="post">
              <input type="hidden" name="nama_brg" value="<?php echo $x['nama_barang']; ?>">
              <input type="hidden" name="kode_brg" value="<?php echo $x['kode_barang']; ?>">
              <button id="tambah" type="submit" name="tambah" class="btn-pinjam my-2">Pinjam</button>
            </form>
            <p class="text-stok">Stok : <?php echo $x['stok']; ?></p>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </main>

  <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btnModal");
    var btnAdd = document.getElementById("tambah");
    var span = document.getElementsByClassName("close-btn")[0];

    btn.onclick = function () {
      modal.style.display = "block";
    };

    span.onclick = function () {
      modal.style.display = "none";
    };

    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };

  </script>
  </body>

  </html>

<?php
} else {
  header("location: login.php");
}
?>