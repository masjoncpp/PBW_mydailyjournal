<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Daily Journal</title>
  <link rel="icon" href="img/logo.webp" type="image/webp" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">My Daily Journal</a>
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar + Login -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="#profile">Profile</a></li>
        </ul>

        <!-- tombol login -->
        <div class="d-lg-none text-center mt-3 mb-2">
          <button id="tmblLogin1" class="btn btn-warning fw-semibold w-75">Login</button>
        </div>
        <div class="d-none d-lg-flex align-items-center ms-3">
          <button id="tmblLogin2" class="btn btn-warning fw-semibold">Login</button>
        </div>

        <!-- tombol theme -->
        <div class="d-flex align-items-center ms-3">
          <button id="tombolIreng" class="btn btn-dark me-2">
            <i class="bi bi-moon-fill"></i>
          </button>
          <button id="tombolPth" class="btn btn-light border">
            <i class="bi bi-sun-fill"></i>
          </button>
        </div>
  </nav>

  <section id="home" class="text-md-start text-center p-5 bg-light bg-opacity-75 rounded-4 shadow">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-5">
        <img src="img/banner.webp" width="300" class="img-fluid rounded shadow" alt="Banner" />
        <div class="text-md-start text-center">
          <h1 class="fw-bold display-5 text-success">
            Merekam keseharian saya
          </h1>
          <h4 class="lead text-dark">
            Pengembangan Web menggunakan php dan menambahkan fitur Login!
          </h4>
          <h6><span id="tanggal"></span> <span id="jam"></span></h6>
        </div>
      </div>
    </div>
  </section>


  <!-- article begin -->
  <section id="article" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3">Article</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
          ?>
          <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"] ?></h5>
                <p class="card-text">
                  <?= $row["isi"] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"] ?>
                </small>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </section>
  <!-- article end -->


  <section id="gallery" class="text-center p-5 bg-success-subtle">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 border-bottom border-dark">
        Gallery
      </h1>
      <div id="carouselExample" class="carousel slide mt-4">
        <div class="carousel-inner">
          <?php
          $sql_gallery = "SELECT * FROM gallery ORDER BY tanggal DESC";
          $hasil_gallery = $conn->query($sql_gallery);
          $first = true;
          while ($row_gallery = $hasil_gallery->fetch_assoc()) {
            ?>
            <div class="carousel-item <?= $first ? 'active' : '' ?>">
              <img src="img/<?= $row_gallery["gambar"] ?>" class="d-block w-100" alt="<?= $row_gallery["judul"] ?>"
                style="max-height: 500px; object-fit: contain;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                <h5><?= $row_gallery["judul"] ?></h5>
                <p><?= $row_gallery["deskripsi"] ?></p>
              </div>
            </div>
            <?php
            $first = false;
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <!--jadwal-->
  <section id="schedule" class="text-center p-5 bg-light-subtle">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 border-bottom border-dark">Jadwal Kuliah & Kegiatan Mahasiswa</h1>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4 justify-content-start text-start">

        <!-- Senin -->
        <div class="col">
          <div class="card h-100 border border-primary">
            <div class="card-header bg-primary text-white fw-bold">Senin</div>
            <div class="card-body">
              <p><strong>07:00-09.30</strong><br>Rekayasa Perangkat Lunak<br>Ruang H.3.11</p>
              <p><strong>12:30- 15:00</strong><br>Probabilitas dan Statistik<br>Ruang H.5.4</p>
              <p><strong>16:20 - 18:00</strong><br>Pendidikan Kewarganegaraan<br>Kulino</p>
            </div>
          </div>
        </div>

        <!-- Selasa -->
        <div class="col">
          <div class="card h-100 border border-success">
            <div class="card-header bg-success text-white fw-bold">Selasa</div>
            <div class="card-body">
              <p><strong>08:40 - 12:00</strong><br>Sistem Operasi<br>Ruang H.5.10</p>
              <p><strong>12:30 - 14:10</strong><br>Basis Data<br>Ruang H.5.9</p>
            </div>
          </div>
        </div>

        <!-- Rabu -->
        <div class="col">
          <div class="card h-100 border border-danger">
            <div class="card-header bg-danger text-white fw-bold">Rabu</div>
            <div class="card-body">
              <p><strong>07:00 - 08:40</strong><br>Basis Data<br>Ruang D.2.K</p>
              <p><strong>09:30 - 12:00</strong><br>Logika Informatika<br>Ruang H.3.8</p>
              <p><strong>14:10 - 15:50</strong><br>Technopreneurship<br>Ruang H.5.8</p>
            </div>
          </div>
        </div>

        <!-- Kamis -->
        <div class="col">
          <div class="card h-100 border border-warning">
            <div class="card-header bg-warning fw-bold">Kamis</div>
            <div class="card-body">
              <p><strong>08:40 - 10:20</strong><br>Pemrograman Berbasis Web<br>Ruang D.2.J</p>
            </div>
          </div>
        </div>

        <!-- Jumat -->
        <div class="col">
          <div class="card h-100 border border-info">
            <div class="card-header bg-info text-white fw-bold">Jumat</div>
            <div class="card-body">
              <p><strong>15:00 - 22:00</strong><br>PPK Ormawa Komunitas Kamadiksi<br>Desa Klepu Ungaran</p>
            </div>
          </div>
        </div>

        <!-- Sabtu -->
        <div class="col">
          <div class="card h-100 border border-secondary">
            <div class="card-header bg-secondary text-white fw-bold">Sabtu</div>
            <div class="card-body">
              <p><strong>08:00 - 22:00</strong><br>PPK Ormawa Komunitas Kamadiksi<br>Desa Klepu Ungaran</p>
            </div>
          </div>
        </div>

        <!-- Minggu -->
        <div class="col">
          <div class="card h-100 border border-dark">
            <div class="card-header bg-dark text-white fw-bold">Minggu</div>
            <div class="card-body">
              <p><strong>08:00 - 13:00</strong><br>PPK Ormawa Komunitas Kamadiksi<br>Desa Klepu Ungaran</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section id="profile" class="p-5 bg-light-subtle">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 border-bottom border-dark text-center">Profil Mahasiswa</h1>
      <div class="row align-items-center">
        <div class="col-md-4 text-center">
          <img src="img/fotoku.jpg" class="img-fluid rounded-circle mb-3" alt="Foto Profil" width="200" />
        </div>
        <div class="col-md-8">
          <h3 class="fw-bold mb-2">M. Jottie Ramadhan Putu Sigit</h3>
          <p class="text-muted mb-4"></p>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>NIM</th>
                <td>A11.2024.16048</td>
              </tr>
              <tr>
                <th>Program Studi</th>
                <td>Teknik Informatika</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>111202416048@mhs.dinus.ac.id</td>
              </tr>
              <tr>
                <th>Telepon</th>
                <td>+6285179663623</td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>Kebonbatur, Mranggen, Demak, Jawa Tengah.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-4 mt-5 border-top">
    <p class="mb-0 fw-semibold">
      M. Jottie Ramadhan Putu Sigit A11.2024.16048 ©2025
    </p>
    <div>
      <a href="https://www.instagram.com/udinusofficial"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
      <a href="https://twitter.com/udinusofficial"><i class="bi bi-twitter-x h2 p-2 text-dark"></i></a>
      <a href="https://wa.me/+62812685577 target=" _blank"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
    </div>
  </footer>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>