<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>amel-simperpus.com</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #d0e7ff; /* biru soft lebih terang */
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background-color: white;
      border-radius: 16px;
      padding: 20px;  /* Mengurangi padding */
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 600px;  /* Mengurangi max-width */
      width: 90%;
    }

    .logo-container {
      display: flex;
      justify-content: center;
      gap: 20px;  /* Mengurangi jarak antar logo */
      margin-bottom: 20px;
    }

    .logo-container img {
      height: 60px;  /* Mengurangi ukuran logo */
    }

    h1 {
      font-size: 28px;  /* Menurunkan ukuran font */
      color: #000;
      margin: 0;
    }

    p {
      font-size: 16px;  /* Menurunkan ukuran font */
      color: #333;
      margin: 20px 0;
    }

    .cta-button {
      background-color: #1e90ff;
      color: white;
      font-size: 16px;  /* Menurunkan ukuran font button */
      padding: 10px 20px;  /* Mengurangi padding */
      border: none;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      display: inline-block;
      margin-top: 20px;
    }

    .cta-button:hover {
      background-color: #187bcd;
    }

    footer {
      margin-top: 30px;
      font-size: 14px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="<?= $main_url ?>katalog/asset/image/unp.jpeg" alt="Logo UNP" style="opacity: .8; width: 69px; height: auto;">
       <img src="<?= $main_url ?>katalog/asset/image/fip.jpeg" alt="Logo UNP" style="opacity: .8;">
      <img src="<?= $main_url ?>katalog/asset/image/ebook.png" alt="Logo Buku" style="opacity: .8;">
    </div>

    <h1>Selamat Datang di Sistem Informasi</h1>
    <h1>Katalog Perpustakaan</h1>

   <p style="text-align: justify;">
   Sistem berbasis website ini dirancang untuk mendukung pengelolaan koleksi perpustakaan secara efisien, terstruktur, dan sistematis. Website ini juga memudahkan pengguna dalam melakukan pencarian koleksi perpustakaan yang dibutuhkan secara cepat dan akurat.
</p>
<p style="text-align: justify;">
   Silakan klik tautan di bawah ini untuk mengakses berbagai koleksi perpustakaan yang tersedia
</p>

       <a class="cta-button" href="https://amel-simperpus.com/katalog/">amel-simperpus.com</a>

    <footer>
      Dikembangkan oleh Amelia Putri | 2025
    </footer>
  </div>
</body>
</html>
