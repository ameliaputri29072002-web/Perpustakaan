
<?php
session_start();

if (isset($_SESSION["ssLoginPOS"])){
  header("location: ../dashboard.php");
  exit();
}

require "../config/config.php";

if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $queryLogin = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if (mysqli_num_rows($queryLogin) === 1){
        $row    = mysqli_fetch_assoc ($queryLogin);
        if (password_verify($password, $row['password'] )) {
            // set session
            $_SESSION["ssLoginPOS"]   = true;
            $_SESSION["ssUserPOS"]    = $username;
            header("location:../dashboard.php");
            exit();
        } else {
            echo "<script>alert ('Password salah..');</script>";
        }
    } else {
            echo "<script>alert ('Username tidak terdaftar..');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
      /* Light blue background color for login page */
      body {
          background: url('https://awsimages.detik.net.id/community/media/visual/2024/09/03/1498878143_169.jpeg?w=1200') no-repeat center center fixed;
          background-size: cover;
      }

      .login-box {
          background: rgba(173, 216, 230, 0.9); /* Light Blue background with transparency */
          border-radius: 8px;
          padding: 20px;
          box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
      }

      .login-logo a {
          color: #1E90FF; /* Light Blue */
          font-size: 2rem;
      }

      /* Style for input fields */
      .input-group .form-control {
          border: 1px solid #1E90FF;
      }

      .input-group .input-group-text {
          background-color: #1E90FF;
          color: white;
      }

      /* Style for the login button */
      .btn-primary {
          background-color: #1E90FF;
          border-color: #1E90FF;
      }

      .btn-primary:hover {
          background-color: #4682B4;
          border-color: #4682B4;
      }

      /* Error message style */
      .alert-danger {
          background-color: #FFB6C1; /* Light pink */
          border-color: #FF4500;
      }

      .login-box-msg {
          color: #1E90FF; /* Light Blue Text */
      }
  </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>SISTEM INFORMASI</b></a>
                <a href="#" class="h2"><b>KATALOG PERPUSTAKAAN</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- AdminLTE Script -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
