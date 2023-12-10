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

  $id = isset($_GET['id']) ? intval($_GET['id']) : 1;

  if (array_key_exists($id, $layanan)) {
    $detail_layanan = $layanan[$id];
  }

  $email_user = $_SESSION['user_email'];
  $user = query("SELECT * FROM user WHERE email = '$email_user'")[0];

  if (isset($_POST['booking'])) {
    $id_layanan = $_POST['id_layanan'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $tanggal = $_POST['tanggal'];
    $jam_temu = $_POST['jam_temu'];
    $catatan = $_POST['catatan'];
    $verifikasi = "Menunggu Diverifikasi Admin";

    $sql = "INSERT INTO booking (id_layanan, email_user, nama, nohp, tanggal, jam_temu, catatan, verifikasi)
            VALUES ('$id_layanan', '$email_user', '$nama', '$nohp', '$tanggal', '$jam_temu', '$catatan', '$verifikasi')";

    if (mysqli_query($conn, $sql)) {
      $script = "
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Booking Anda Telah Tersimpan.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  ?>

  <main>

    <section class="mt-8">
      <br><br>
      <br><br>
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <div class=" mt-6 mt-md-0">
              <h1 class="mb-1"><?= $detail_layanan['nama']; ?> </h1>
              <div class="fs-4">
                <span class="fw-bold text-dark"><?= $detail_layanan['harga_diskon']; ?></span> <span class="text-decoration-line-through text-muted"><?= $detail_layanan['harga_asli']; ?></span><span><small class="fs-6 ms-2 text-danger">
              </div>
              <form action="" method="post">
                <input type="hidden" name="id_layanan" value="<?= $id; ?>">
                <div class="mt-3 row justify-content-start g-2 align-items-center">
                  <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>" readonly required>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email_user; ?>" readonly>
                  </div>
                  <div class="col-12">
                    <label for="nohp" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="nohp" name="nohp" required>
                  </div>
                  <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="col-12">
                    <label for="jam_temu" class="form-label">Jam Temu</label>
                    <input type="time" class="form-control" id="jam_temu" name="jam_temu" required>
                  </div>
                  <div class="col-12">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="4"></textarea>
                  </div>
                  <div class="col-12 d-grid">
                    <button type="submit" name="booking" class="btn btn-primary"><i class="feather-icon icon-shopping-bag me-2"></i>Booking</button>
                  </div>
                </div>
              </form>

            </div>

          </div>
        </div>
      </div>
      </div>
    </section>


  </main>

  <br><br>

  <?php include('komponen/script.php'); ?>

  <script>
    <?php if (isset($script)) {
      echo $script;
    } ?>
  </script>



</body>

</html>