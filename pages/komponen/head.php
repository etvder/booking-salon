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

<?php

session_start();
include '../functions.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}; ?>