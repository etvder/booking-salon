<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('komponen/head.php'); ?>
</head>

<body>

  <?php include('komponen/navbar.php'); ?>

  <?php

  $layanan = array(
    1 => array(
      'nama' => 'Potong Rambut',
      'harga_diskon' => 'Rp 50,000',
      'harga_asli' => 'Rp 75,000',
    ),
    2 => array(
      'nama' => 'Manicure',
      'harga_diskon' => 'Rp 60,000',
      'harga_asli' => 'Rp 80,000',
    ),
    3 => array(
      'nama' => 'Pijat Relax',
      'harga_diskon' => 'Rp 70,000',
      'harga_asli' => 'Rp 90,000',
    ),
    4 => array(
      'nama' => 'Facial Treatment',
      'harga_diskon' => 'Rp 80,000',
      'harga_asli' => 'Rp 100,000',
    ),
    5 => array(
      'nama' => 'Hair Coloring',
      'harga_diskon' => 'Rp 175,000',
      'harga_asli' => 'Rp 200,000',
    ),
  );

  $email_user = $_SESSION['user_email'];

  $sql = "SELECT * FROM booking WHERE email_user = '$email_user'";
  $result = mysqli_query($conn, $sql);

  ?>

  <main>
    <section class="mb-lg-14 mb-8 mt-8">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card py-1 border-0 mb-8">
              <div>
                <h1 class="fw-bold">Riwayat Booking</h1>
                <p class="mb-0">Data ini disesuaikan khusus untuk riwayat booking : <b><?= $_SESSION['user_email']; ?></b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">

            <div class="py-3">
              <div class="alert alert-success p-2" role="alert">
                Pastikan datang tepat waktu atau sebelum waktu perjanjian, agar hasil layanan kami yang <a href="#!" class="alert-link">memuaskan!</a>
              </div>
              <?php

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_layanan = $row['id_layanan'];

                  $layanan_data = $layanan[$id_layanan];

                  echo '<ul class="list-group list-group-flush">';
                  echo '<li class="list-group-item py-3 py-lg-0 px-0 border-top">';
                  echo '<div class="pt-5 row align-items-center">';
                  echo '<div class="col-4 col-md-5">';
                  echo '<a href="" class="text-inherit">';
                  echo '<h6 class="mb-0">Layanan : <br>' . $layanan_data['nama'] . '</h6>';
                  echo '</a>';
                  echo '</div>';
                  echo '<div class="col-3 col-md-3 col-lg-2">';
                  echo '<span class="fw-bold">Tanggal / Jam : <br>' . $row['tanggal'] . ' / ' . $row['jam_temu'] . '</span>';
                  echo '</div>';
                  echo '<div class="col-2 text-lg-end text-start text-md-end col-md-2">';
                  echo '<span class="fw-bold">Biaya : <br> ' . $layanan_data['harga_diskon'] . '</span>';
                  echo '</div>';
                  echo '<div class="col-2 text-lg-end text-start text-md-end col-md-2">';
                  echo '<span class="fw-bold">Catatan : <br> ' . $row['catatan'] . '</span>';
                  echo '</div>';
                  echo '</div>';
                  echo '</li>';
                  echo '</ul>';
                }
              } else {
                echo "Tidak ada data booking.";
              }


              ?>


            </div>
          </div>


        </div>
      </div>
    </section>


  </main>


  <?php include('komponen/script.php'); ?>


</body>

</html>