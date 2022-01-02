<?php 
	include 'koneksi.php';
  
	error_reporting(0);
  
	session_start();

	if (isset($_SESSION['username'])) {
	header("Location: halaman_admin.php");
	}

	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = ($_POST['password']);

		$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		$result = mysqli_query($db, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $row['username'];
			header("Location: halaman_admin.php");
		} else {
			echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
		}
	}
?>