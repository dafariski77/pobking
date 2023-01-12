<?php
include('side_menu.php');
?>

<div class="statistic d-flex justify-content-between">
  <div class="count rounded bg-dark">
    <h6>Barang</h6>
    <h4>
      <?php echo $db->hitung_row("barang"); ?>
    </h4>
  </div>
  <div class="count rounded bg-dark">
    <h6>Peminjaman</h6>
    <h4><?php echo $db->hitung_row("peminjaman"); ?></h4>
  </div>
  <div class="count rounded bg-dark">
    <h6>User</h6>
    <h4>
      <?php echo $db->hitung_row("user"); ?>
    </h4>
  </div>
  <div class="count rounded bg-dark">
    <h6>Mahasiswa</h6>
    <h4>
      <?php echo $db->hitung_row("data_mhs"); ?>
    </h4>
  </div>
</div>
<div class="rounded mx-5 p-4 bg-dark">
  <h4>
    Belum dikembalikan
  </h4>
  <table class="table text-white table-dark mt-4 table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">No</th>
        <th scope="col">Kode Pinjam</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Waktu Pinjam</th>
        <th scope="col">Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if (empty($db->show_belum_kembali())) {
        echo "<td colspan='11' class='text-center'>Data Kosong</td>";
      } else {
        foreach ($db->show_belum_kembali() as $x) {
          ?>
          <tr class="table-danger text-center">
            <td><?php echo $no++; ?></td>
            <td>
              <?php echo $x['kode_peminjaman']; ?>
            </td>
            <td><?php echo $x['nama_barang']; ?></td>
            <td>
              <?php echo $x['nama_peminjam']; ?>
            </td>
            <td><?php echo $x['ruangan']; ?></td>
            <td>
              <?php echo $x['tanggal']; ?>
            </td>
            <td><?php echo $x['waktu_pinjam']; ?></td>
            <td>
              <?php echo $x['jumlah']; ?>
            </td>
          </tr>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>
<div class="rounded m-5 p-4 bg-dark">
  <h4>
    Belum Diambil
  </h4>
  <table class="table text-white table-dark mt-4 table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">No</th>
        <th scope="col">Kode Pinjam</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Waktu Pinjam</th>
        <th scope="col">Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if (empty($db->show_belum_diambil())) {
        echo "<td colspan='11' class='text-center'>Data Kosong</td>";
      } else {
        foreach ($db->show_belum_diambil() as $x) {
          ?>
          <tr class="table-success text-center">
            <td><?php echo $no++; ?></td>
            <td>
              <?php echo $x['kode_peminjaman']; ?>
            </td>
            <td><?php echo $x['nama_barang']; ?></td>
            <td>
              <?php echo $x['nama_peminjam']; ?>
            </td>
            <td><?php echo $x['ruangan']; ?></td>
            <td>
              <?php echo $x['tanggal']; ?>
            </td>
            <td><?php echo $x['waktu_pinjam']; ?></td>
            <td>
              <?php echo $x['jumlah']; ?>
            </td>
          </tr>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>
</div>
</div>
</main>

</body>

</html>