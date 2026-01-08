<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];

  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

  //prepared statement
  $stmt = $conn->prepare("SELECT user 
                          FROM user 
                          WHERE user=? AND password=?");

  //parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string

  //database executes the statement
  $stmt->execute();

  //menampung hasil eksekusi
  $hasil = $stmt->get_result();

  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['user'];
    //check jika sudah ada user yang login arahkan ke halaman admin
    if (isset($_SESSION['username'])) {
      header("location:admin.php");
    }
    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
    //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

  //menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | My Daily Journal</title>
    <link rel="icon" href="img/logo.webp" type="image/webp" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">
  </head>

  <body class="d-flex justify-content-center align-items-center" style="
  min-height: 100vh;
  background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
  font-family: 'Poppins', sans-serif;
">

    <div class="card shadow-lg border-0 rounded-4 p-4" style="width: 420px; background-color: rgba(255, 255, 255, 0.95);">
      <div class="text-center mb-3">
        <i class="bi bi-person-circle display-3 text-dark"></i>
        <h4 class="mt-2 fw-bold">My Daily Journal</h4>
        <h4 class="mt-2 fw-bold">Login Dashboard</h4>
      </div>
      <hr>

      <form action="" method="post">
        <input type="text" name="user" class="form-control form-control-lg rounded-4 mb-3" placeholder="Username"
          required>
        <input type="password" name="pass" class="form-control form-control-lg rounded-4 mb-4" placeholder="Password"
          required>

        <button type="submit" class="btn btn-danger w-100 rounded-4 py-2 fw-semibold">
          Login
        </button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
  <?php
}
?>