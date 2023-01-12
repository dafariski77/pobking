<?php
include('./nav.php');
$nim = $_SESSION['nim'];
if ($nim != "") {
  ?>

  <main class="list-tool container">
    <div class="component">
      <div class="d-flex justify-content-between">
        <h2 class="text-white">Barang yang aku pinjam</h2>
      </div>
      <table class="table table-bordered text-white mt-4 table-dark table-striped">
        <thead>
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Kode Peminjaman</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Ruangan</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Waktu Pinjam</th>
            <th scope="col">Waktu Kembali</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          if (empty($db->show_pinjam($name))) {
            echo "<td colspan='10' class='text-center'>Data Kosong</td>";
          } else {
            foreach ($db->show_pinjam($name) as $x) {
              ?>
              <tr>
                <form action="peminjaman.php" method="post">
                  <input type="text" name="id" value="<?php echo $x['id']; ?>" hidden />
                  <td class="text-center">
                    <?php echo $no++; ?>
                  </td>
                  <td><?php echo $x['kode_peminjaman']; ?></td>
                  <td>
                    <?php echo $x['nama_barang']; ?>
                  </td>
                  <td><?php echo $x['ruangan']; ?></td>
                  <td>
                    <?php echo $x['tanggal']; ?>
                  </td>
                  <td><?php echo $x['waktu_pinjam']; ?></td>
                  <td>
                    <?php echo $x['waktu_kembali']; ?>
                  </td>
                  <td><?php echo $x['jumlah']; ?></td>
                  <td>
                    <?php echo $x['keterangan']; ?>
                  </td>
                  <td class="text-center">
                    <?php
                    if ($x['keterangan'] == "Belum diambil") {

                      ?>
                      <button type="submit" class="btn btn-danger" name="Delete"><i class="fa fa-times"></i> Cancel</button>

                      <?php
                    } else {
                      ?>
                      <button class="btn btn-secondary" disabled><i class="fa fa-times"></i> Cancel</button>

                      <?php
                    }
                    ?>
                  </td>
                </form>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>

    <?php
    if (isset($_POST['Delete'])) {
      $id = $_POST['id'];
      $db->cancel($id);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    </div>
    </div>
  </main>

  </body>

  </html>
  </main>
  </body>

  </html>

<?php
} else {
  header("location: login.php");
}
?>