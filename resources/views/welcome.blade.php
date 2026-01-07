<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SBJ Ekspedisi - Jasa Pengiriman Truk Profesional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Font Awesome CDN -->
  <!-- Fancybox CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" /> --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    .img-hover-zoom {
      overflow: hidden;
      border-radius: 10px;
    }

    .img-hover-zoom img {
      transition: transform 0.4s ease;
    }

    .img-hover-zoom:hover img {
      transform: scale(1.08);
    }

    body {
      font-family: 'Segoe UI', sans-serif;
    }
    .hero {
      background: url('img/12.jpg') center/cover no-repeat;
      height: 90vh;
      color: white;
      display: flex;
      align-items: center;
    }
    .overlay {
      background: rgba(0, 0, 0, 0.6);
      padding: 60px 20px;
      width: 100%;
    }
       .bg-moving-truck {
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
      }

      .bg-moving-truck::after {
        content: "";
        background: url('img/12.jpg') repeat-x;
        position: absolute;
        bottom: 0;
        left: 0;
        height: 150px;
        width: 300%;
        animation: moveTruck 20s linear infinite;
        opacity: 0.1;
        z-index: 0;
        background-size: contain;
      }

      @keyframes moveTruck {
        from { transform: translateX(0); }
        to { transform: translateX(-66.66%); }
      }

      .testimoni-content {
        position: relative;
        z-index: 1;
      }
      .img-fluid {
        transition: transform 0.3s ease;
        cursor: pointer;
      }

      .img-fluid:hover {
        transform: scale(1.05);
      }
  </style>

   

</head>
<body>

  <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-top shadow">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SBJ Ekspedisi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
          <li class="nav-item"><a class="nav-link" href="#armada">Armada</a></li>
          <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          <li class="nav-item">
            <a class="nav-link" href="login">
              <i class="fa-solid fa-user-shield me-1"></i>
            </a>
          </li>


        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero text-center">
    <div class="overlay">
      <h1 class="display-4 fw-bold">Trusted Business Partner</h1>
      <p class="lead mb-4">Layanan cepat, aman, dan terpercaya ke seluruh Indonesia</p>
      <a href="#kontak" class="btn btn-primary btn-lg">Hubungi Kami</a>
      {{-- <a href="#kontak" class="btn btn-primary btn-lg">Hubungi Kami</a> --}}
    </div>
  </section>

  <!-- Layanan -->
 <section id="layanan" class="py-5" style="background-color: #fdfaf6;">
  <div class="container text-center">
    <h2 class="mb-4">Layanan Kami</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <i class="bi bi-truck fs-1 text-primary mb-3"></i>
        <h5>Ekspedisi Truk Box</h5>
        <p>Pengiriman barang besar dengan aman dan tepat waktu.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
        <h5>Asuransi Pengiriman</h5>
        <p>Proteksi barang dari kerusakan atau kehilangan.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
        <h5>Pengiriman Terjadwal</h5>
        <p>Jadwal fleksibel dan layanan door-to-door.</p>
      </div>
    </div>
  </div>
</section>

  <!-- Gelaeri -->
<section id="galeri" class="py-5" style="background-color: #fdfaf6;">
  <div class="container">
    <h2 class="text-center mb-5">Galeri Kegiatan</h2>
    <div class="row g-4 justify-content-center">

      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="img/11.jpg" data-fancybox="galeri" data-caption="Truk Berangkat dari Pool">
          <img src="img/11.jpg" class="img-fluid rounded shadow" alt="Galeri 1">
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="img/11.jpg" data-fancybox="galeri" data-caption="Proses Bongkar di Gudang">
          <img src="img/11.jpg" class="img-fluid rounded shadow" alt="Galeri 2">
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="img/11.jpg" data-fancybox="galeri" data-caption="Persiapan Armada">
          <img src="img/11.jpg" class="img-fluid rounded shadow" alt="Galeri 3">
        </a>
      </div>

      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="img/11.jpg" data-fancybox="galeri" data-caption="Dokumentasi Tim SBJ">
          <img src="img/11.jpg" class="img-fluid rounded shadow" alt="Galeri 4">
        </a>
      </div>

    </div>
  </div>
</section>




  <!-- Armada -->
  <section id="armada" class="py-5">
    <div class="container text-center">
      <h2 class="mb-4">Armada Kami</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow">
            <img src="img/22.jpg"  class="card-img-top" alt="Truk Kecil">
            <div class="card-body">
              <h5 class="card-title">Truk Box Kecil</h5>
              <p class="card-text">Ideal untuk distribusi ringan dan wilayah sempit.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="img/33.jpg" class="card-img-top" alt="Truk Sedang">
            <div class="card-body">
              <h5 class="card-title">Truk Box Sedang</h5>
              <p class="card-text">Pengiriman regional dengan kapasitas menengah.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <img src="img/11.jpg" class="card-img-top" alt="Truk Besar">
            <div class="card-body">
              <h5 class="card-title">Truk Box Besar</h5>
              <p class="card-text">Layanan ekspor-impor dan pengiriman massal.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section id="testimoni" class="py-5 bg-moving-truck">
  <div class="container text-center testimoni-content">
    <h2 class="mb-4">Testimoni Pelanggan</h2>
    <div class="row justify-content-center g-4">
      <div class="col-md-5">
        <blockquote class="blockquote">
          <p>Pelayanan cepat dan terpercaya. Pengiriman tepat waktu dan sopir ramah.</p>
          <footer class="blockquote-footer">Ubay, Jakarta</footer>
        </blockquote>
      </div>
      <div class="col-md-5">
        <blockquote class="blockquote">
          <p>Sudah langganan lebih dari 1 tahun. Layanan terbaik untuk logistik bisnis kami.</p>
          <footer class="blockquote-footer">Rina, Surabaya</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>


  <!-- Kontak -->
 <section id="kontak" class="py-5 position-relative text-center text-dark">
  <div class="container position-relative" style="z-index: 2;">
    <h2 class="mb-4">Hubungi Kami</h2>
    <p class="mb-4">Tim kami siap membantu kebutuhan logistik Anda.</p>
    <div class="row justify-content-center g-4">
      <div class="col-md-4">
        <i class="bi bi-envelope-fill fs-3 text-primary"></i>
        <p>sumurbandungjaya@sbj.web.id</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-telephone-fill fs-3 text-primary"></i>
        <p>Joko</p>
        <p>
          <a href="https://wa.me/6281211295799" target="_blank" class="text-decoration-none text-dark">
            0812-1129-5799
          </a>
        </p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-geo-alt-fill fs-3 text-primary"></i>
        <p>Tangerang, Indonesia</p>
      </div>
    </div>
  </div>

</section>


  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
      <small>&copy; 2025 SBJ Ekspedisi. Semua Hak Dilindungi.</small>
    </div>
  </footer>
<!-- Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
