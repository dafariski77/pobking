<?php
include('side_menu.php');
?>

<div class="component">
  <div class="d-flex justify-content-between">
    <h2 class="text-white">Data Peminjaman</h2>
  </div>
  <table class="table table-bordered text-white mt-4 table-dark table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">No</th>
        <th scope="col">Kode Peminjaman</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Nama Peminjam</th>
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
      if (empty($db->show_pinjam())) {
        echo "<td colspan='11' class='text-center'>Data Kosong</td>";
      } else {
        foreach ($db->show_pinjam() as $x) {
          ?>
          <tr>
            <form action="peminjaman.php" method="post">
              <input type="text" name="id" value="<?php echo $x['id']; ?>" hidden />
              <input type="text" name="kode_brg" value="<?php echo $x['kode_barang']; ?>" hidden />
              <input type="text" name="jumlah" value="<?php echo $x['jumlah']; ?>" hidden />
              <input type="text" name="prev_status" value="<?php echo $x['keterangan']; ?>" hidden />
              <td class="text-center">
                <?php echo $no++; ?>
              </td>
              <td><?php echo $x['kode_peminjaman']; ?></td>
              <td>
                <?php echo $x['nama_barang']; ?>
              </td>
              <td><?php echo $x['nama_peminjam']; ?></td>
              <td>
                <?php echo $x['ruangan']; ?>
              </td>
              <td><?php echo $x['tanggal']; ?></td>
              <td>
                <?php echo $x['waktu_pinjam']; ?>
              </td>
              <td><?php echo $x['waktu_kembali']; ?></td>
              <td>
                <?php echo $x['jumlah']; ?>
              </td>
              <td class="text-center">
                <select name="status">
                  <?php
                  if ($x['keterangan'] == "Belum diambil") {
                    ?>
                    <option value="<?= $x['keterangan']; ?>" selected>
                      <?php echo $x['keterangan']; ?>
                    </option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <?php
                  } elseif ($x['keterangan'] == "Dipinjam") {
                    ?>
                    <option value="<?= $x['keterangan']; ?>" selected>
                      <?php echo $x['keterangan']; ?>
                    </option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <option value="Belum diambil">Belum diambil</option>
                    <?php
                  } elseif ($x['keterangan'] == "Dikembalikan") {
                    ?>
                    <option value="<?= $x['keterangan']; ?>" selected>
                      <?php echo $x['keterangan']; ?>
                    </option>
                    <option value="Belum diambil">Belum diambil</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <?php
                  }
                  ?>
                </select>
                <button name="set_status" class="badge bg-success" type="submit">Set status</button>
              </td>
              <td class="text-center">
                <button type="submit" class="btn btn-danger" name="Delete"><i class="fa fa-times"></i> Delete</button>
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
  $db->del_pinjam($id);
  echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_POST['set_status'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $kode_brg = $_POST['kode_brg'];
  $prev_status = $_POST['prev_status'];

  $jumlah = $_POST['jumlah'];

  $db->update_status($id, $status, $kode_brg, $jumlah);
  echo "<meta http-equiv='refresh' content='0'>";
}
?>

</div>
</div>
</main>

</body>

</html>
</body>

</html>