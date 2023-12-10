<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>RG Beauty Salon </title>
  <link href="../assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
  <link href="../assets/libs/slick-carousel/slick/slick.css" rel="stylesheet" />
  <link href="../assets/libs/slick-carousel/slick/slick-theme.css" rel="stylesheet" />
  <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
  <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/theme.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php

session_start();
include '../functions.php';

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $script = "
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Lengkapi semua isian.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
  } else {
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $hashed_password = $row['password'];

      if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user'] = true;
        header("Location: index.php");
        exit();
      } else {
        $script = "
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password Salah.',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                ";
      }
    } else {
      $query = "SELECT * FROM admin WHERE username = '$email'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
          session_start();
          $_SESSION['admin_email'] = $email;
          $_SESSION['admin'] = true;
          header("Location: ../admin/");
          exit();
        } else {
          $script = "
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Password Salah.',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    ";
        }
      } else {
        // Jika tidak ditemukan di kedua tabel
        $script = "
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Email tidak ditemukan, silahkan melakukan registrasi.',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                ";
      }
    }
  }
}

?>

<body>


  <main>
    <div style="margin-top:120px;"></div>
    <center>
      <h2>RG BEAUTY SALON</h2>
    </center>
    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
            <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid">
          </div>
          <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
            <div class="mb-lg-9 mb-5">
              <h1 class="mb-1 h2 fw-bold">Login</h1>
            </div>

            <form action="" method="post">
              <div class="row g-3">
                <div class="col-12">
                  <input type="text" class="form-control" id="inputEmail4" placeholder="Email / Username" name="email" required>
                </div>
                <div class="col-12">
                  <div class="password-field position-relative">
                    <input type="password" id="fakePassword" placeholder=" Password" class="form-control" name="password" required>
                    <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  </div>

                </div>
                <div class="col-12 d-grid"> <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
                <small>Belum mempunyai akun? <a href="daftar.php"> Daftar disini</a></small>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../assets/js/theme.min.js"></script>
  <script src="../assets/js/vendors/password.js"></script>

  <script>
    <?php if (isset($script)) {
      echo $script;
    } ?>
  </script>


</body>

</html>