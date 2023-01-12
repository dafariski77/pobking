<?php
include('./nav.php');
?>

<main class="bg-dark">
  <section id="hero">
    <div class="hero vh-100">
      <div class="container">
        <div class="row">
          <div class="title">
            <h1 class="text-title mt-5" data-aos="fade-right" data-aos-duration="2000">TINGGAL KLIK</h1>
            <h1 class="text-title" data-aos="fade-right" data-aos-duration="2000">SAY GOODBYE TO</h1>
            <h1 class="text-title mb-5" data-aos="fade-right" data-aos-duration="2000">NUNGGU DEPAN PINTU
            </h1>
            <a href="./tool_list.php" class="btn-title">Pinjam Alat Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="tools">
    <div class="container text-center text-white py-5">
      <h2>Paling Sering Dipinjam</h2>
      <div class="card-group d-flex justify-content-center py-5">
        <!-- buat foreach berdasarkan peminjaman terbanyak -->
        <?php
        $sliced = array_slice($db->get_tool(), 0, 4);
        foreach ($sliced as $x) {
          ?>
          <div class="tool" data-aos="zoom-in">
            <img src="./admin/img/<?php echo $x['img']; ?>" />
            <h5 class="text-dark my-4">
              <?php echo $x['nama_barang']; ?>
            </h5>
            <a href="./tool_list.php" class="btn-pinjam my-2">Pinjam</a>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="more mt-5">
        <a href="./tool_list.php" class="btn-pinjam-reverse">Lihat Semua</a>
      </div>
    </div>
  </section>
  <section id="about">
    <div class="about-img vh-100">
      <div class="container about">
        <div class="content text-white" data-aos="fade-up" data-aos-duration="2000">
          <h1>About POBKING</h1>
          <p>POOBKING memberikan pengalaman Booking Tools pada Mahasiswa Polines
            Khususnya kepada Jurusan Elektro . Sekarang anda tidak perlu khawatir akan Stock Tools
            dan Menunggu lama untuk peminjaman karena semua tersedia di sini</p>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
include('footer.php');
?>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>

</html>