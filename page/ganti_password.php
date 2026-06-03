<?php
session_start();
include 'koneksi.php';

$username = $_SESSION['username'];
$password_baru = $_POST['password'];

mysqli_query($koneksi, "UPDATE user 
SET password='$password_baru' 
WHERE username='$username'");

header("location:page/dashboard.php");
?>