<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Maintenance</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      text-align: center;
      padding: 50px;
    }

    h1 {
      color: #333;
    }

    p {
      color: #666;
    }

    .logo {
      max-width: 200px;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>
  <img class="logo" src="img/brand/iconsbj.png" alt="Logo">

  <h1>Halaman Maintenance</h1>
  <p>Maaf, halaman ini sedang dalam tahap pemeliharaan.</p>
  <p>Situs kami akan kembali beroperasi dalam waktu 15 hari.</p>
  <p>Jam tayang:</p>
  <p id="countdown"></p>
  <p>Terima kasih atas kesabaran dan pengertian Anda.</p>
  <p>Salam,</p>
  <p>Tim Kami</p>
<a href="login">Login</a>
  <script>
    // Tanggal akhir pemeliharaan
    var endDate = new Date();
    endDate.setDate(endDate.getDate() + 15);

    // Fungsi hitung mundur
    function countdown() {
      var now = new Date().getTime();
      var distance = endDate - now;

      // Perhitungan waktu
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Menampilkan waktu
      document.getElementById("countdown").innerHTML = days + " hari " + hours + " jam " + minutes + " menit " + seconds + " detik ";

      // Jika waktu telah berakhir, tampilkan pesan
      if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById("countdown").innerHTML = "Waktu pemeliharaan telah berakhir";
      }
    }

    // Memanggil fungsi countdown setiap detik
    var countdownInterval = setInterval(countdown, 1000);
  </script>
</body>
</html>
