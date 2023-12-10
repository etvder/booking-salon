<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Admin | RG Beauty </title>
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/theme.min.css">
</head>

<?php
session_start();
include '../functions.php';

if (!isset($_SESSION["admin"])) {
    header("Location: ../pages/login.php");
    exit;
};


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


$sql = "SELECT * FROM booking";
$result = mysqli_query($conn, $sql);




if (isset($_POST['ubah_status'])) {
    $id = $_POST['id'];

    $query = "UPDATE booking SET verifikasi = 'Telah Diverifikasi' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        die("Query error: " . mysqli_error($conn));
    }
}

?>

<body>


    <div class="main-wrapper">


        <!-- main wrapper -->
        <main class="main-content-wrapper">
            <div class="container">
                <!-- row -->
                <div class="row mb-8">
                    <div class="col-md-12">
                        <!-- page header -->
                        <div>
                            <h3><a href="logout.php"> Logout </a><h3>
                            <h2>Selamat Datang Admin!</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item active" aria-current="page">Silahkan Melihat List Booking</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </div>
                <!-- row -->
                <section class="mb-lg-14 mb-8 mt-8">
                    <div class="container">
                        <div class="row">
                            <div class="col">

                                <div class="py-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold">Layanan</th>
                                                <th class="fw-bold">Nama Pemesan</th>
                                                <th class="fw-bold">Nomor Handphone</th>
                                                <th class="fw-bold">Tanggal / Jam</th>
                                                <th class="fw-bold">Biaya</th>
                                                <th class="fw-bold">Catatan</th>
                                                <th class="fw-bold">Verifikasi</th>
                                                <th class="fw-bold">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id_layanan = $row['id_layanan'];
                                                    $layanan_data = $layanan[$id_layanan];
                                            ?>
                                                    <tr>
                                                        <td><?= $layanan_data['nama']; ?></td>
                                                        <td><?= $row['nama']; ?></td>
                                                        <td><?= $row['nohp']; ?></td>
                                                        <td><?= $row['tanggal'] . ' / ' . $row['jam_temu']; ?></td>
                                                        <td><?= $layanan_data['harga_diskon']; ?></td>
                                                        <td><?= $row['catatan']; ?></td>
                                                        <td><?= $row['verifikasi']; ?></td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                                <button type="submit" class="btn btn-primary" name="ubah_status">Ubah Status</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>Tidak ada data booking.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </main>

    </div>


    <!-- Libs JS -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>