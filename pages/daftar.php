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
include '../functions.php';

if (isset($_POST['register'])) {
  $nama = $_POST['nama'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validasi data
  if (empty($nama) || empty($tanggal_lahir) || empty($email) || empty($password)) {
    $script = "
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Mohon lengkapi semua isian.',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    ";
  } else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (nama, tanggal_lahir, email, password) VALUES ('$nama', '$tanggal_lahir', '$email', '$hashed_password')";

    if (mysqli_query($conn, $query)) {
      $script = "
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Pendaftaran akun berhasil, Selamat Datang.',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    ";
    } else {
      $script = "
          Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Silahkan coba beberapa saat lagi.',
              timer: 3000,
              timerProgressBar: true,
              showConfirmButton: false
          });
      ";
    }
  }
}
?>


<body>

  <main>
    <div style="margin-top:200px;"></div>

    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
            <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid">
          </div>
          <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
            <div class="mb-lg-9 mb-5">
              <h1 class="mb-1 h2 fw-bold">Daftar Akun</h1>
              <p>Mohon mengisi data dengan benar dan lengkap yaa.</p>
            </div>
            <form action="" method="post">
              <div class="row g-3">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Nama Lengkap" name="nama" required>
                </div>
                <div class="col">
                  <input type="date" class="form-control" placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" name="tanggal_lahir" required>
                </div>
                <div class="col-12">

                  <input type="email" class="form-control" placeholder="Alamat Email" name="email" required>
                </div>
                <div class="col-12">

                  <div class="password-field position-relative">
                    <input type="password" id="fakePassword" placeholder="Password" name="password" class="form-control" required>
                    <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  </div>
                </div>
                <div class="col-12 d-grid"> <button type="submit" name="register" class="btn btn-primary">Register</button>
                </div>

                <p><small>Sudah mempunyai akun? Login <a href="login.php">dsini</a></small></p>
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const registerForm = document.querySelector("form");

      registerForm.addEventListener("submit", function(event) {
        const tanggalLahirField = document.querySelector('input[name="tanggal_lahir"]');
        const tanggalLahirValue = tanggalLahirField.value;

        const today = new Date();
        const birthday = new Date(tanggalLahirValue);
        const age = today.getFullYear() - birthday.getFullYear();

        // Periksa usia minimal 15 tahun
        if (age < 15) {
          event.preventDefault(); // Hentikan pengiriman formulir
          alert("Anda harus berusia minimal 15 tahun untuk mendaftar.");
        }
      });
    });
  </script>



</body>

</html>