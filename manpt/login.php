<?php
session_start();
include('koneksi.php');

if(isset($_SESSION['username'])){
	header('location: index.php');
}else{

if(isset($_POST['masuk'])){ 
 
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$data = mysqli_query($konek,"SELECT * FROM users WHERE username='$username' AND password='$password'");
	$get = mysqli_fetch_array($data);
	$level = $get['level'];
	$id_user = $get['id_user'];
	$nama = $get['nama'];
	$cek = mysqli_num_rows($data);
	 
	if($cek > 0){
		if($get['status'] == "1"){
			$_SESSION['username'] = $username;
			$_SESSION['level'] = $level;
			$_SESSION['id'] = $id_user;
			$_SESSION['nama'] = $nama;
			header("location:index.php");
		}else{
			echo "<script>";
			echo "alert('Akun Anda tidak aktif!')";
			echo "</script>";
		}
	}else{
		echo "<script>";
		echo "alert('Username atau password salah!')";
		echo "</script>";
	}
}
?>

<link rel="stylesheet" href="css/style.min.css">
<div class="login-page">
  <div class="form_login">
    <form class="login-form" method="post" action="">
	<img src="images/akun.png" style="margin-bottom: 20px;">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit" name="masuk">Masuk</button>
    </form>
  </div>
</div>

<?php
}
?>