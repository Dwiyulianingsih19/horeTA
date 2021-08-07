<?php
ob_start();
date_default_timezone_set('Asia/Jakarta');
include('koneksi.php');

if(isset($_POST['saveprogress'])){
	$progress = $_POST['progress'];
	$new_array = array(null, null, null, null, null);
	$null = array(null, null, null, null, null);

	$loop = count($progress);
	for($i=0; $i<5-$loop; $i++) array_push($progress, $null[$i]);
		
	$beres = 0;
	for($i=0; $i<5; $i++){
		for($j=0; $j<$loop; $j++){
			if($progress[$j] == $i){
				$new_array[$i] = "1";
				$beres++;
			}elseif($new_array[$i] == null){
				$new_array[$i] = "0";
			}
		}
	}

	$progress = json_encode($new_array);
	if($beres == 5){
		$proses = mysqli_query($konek, "UPDATE proyek SET progress='$progress', status = 'Selesai' WHERE id='$_POST[id]'");
		if($proses) header("location: proyek.php?pesan=".base64_encode("Progress Berhasil Diubah"));
	}else if($beres >0 && $beres<=4){
		$proses = mysqli_query($konek, "UPDATE proyek SET progress='$progress', status = 'Berjalan' WHERE id='$_POST[id]'");
		if($proses) header("location: proyek.php?pesan=".base64_encode("Progress Berhasil Diubah"));
	}else{
		$proses = mysqli_query($konek, "UPDATE proyek SET progress='$progress', status = 'Akan Berjalan' WHERE id='$_POST[id]'");
		if($proses) header("location: proyek.php?pesan=".base64_encode("Progress Berhasil Diubah"));
	}
}

if(isset($_GET['id']) && isset($_GET['progress'])){
	$beres = '["1","1","1","1","1"]';
	$proses = mysqli_query($konek, "UPDATE proyek SET progress='$beres', status = 'Selesai' WHERE id='$_GET[id]'");
	if($proses) header("location: proyek.php?pesan=".base64_encode("Progress Berhasil Diubah"));
}
if(isset($_GET['id']) && isset($_GET['hapus'])){
	$proses = mysqli_query($konek, "DELETE FROM proyek WHERE id='$_GET[id]'");
	if($proses) header("location: proyek.php?pesan=".base64_encode("Proyek Berhasil Dihapus"));
}
if(isset($_GET['id']) && isset($_GET['aprove'])){
	$proses = mysqli_query($konek, "UPDATE proyek SET aproval_admin='Sudah diapprove' WHERE id='$_GET[id]'");
	if($proses) header("location: proyek.php?pesan=".base64_encode("Proyek diapprove"));
}
if(isset($_GET['id_task']) && isset($_GET['selesai'])){

	$proses = mysqli_query($konek, "UPDATE progres SET status='Sudah Selesai' WHERE id='$_GET[id_task]'");
	$get = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM progres where id='$_GET[id_task]'"));
	$proyek = $get['proyek_id'];
	$type = $get['type'];

	$get_progres = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM persentase where proyek_id='$proyek'"));
	if($get_progres>0){
		$persentase_update = $get_progres['persentase'] + 2;
		$sql = mysqli_query($konek, "UPDATE persentase set persentase = '$persentase_update' where proyek_id='$proyek'");
	}else{
		$sql = mysqli_query($konek, "INSERT INTO persentase values('','$proyek','2')");
	}
	if($proses) header("location: progress_data.php?id=".$proyek."&type=".$type."&pesan=".base64_encode("Task Selesai"));
}
if(isset($_GET['id_task']) && isset($_GET['hapus'])){
	$get = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM progres where id='$_GET[id_task]'"));
	$proyek = $get['proyek_id'];
	$type = $get['type'];
	$status = $get['status'];
	$proses = mysqli_query($konek, "DELETE FROM progres WHERE id='$_GET[id_task]'");

	$get_progress = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM persentase where proyek_id='$proyek'"));
	$persentase = $get_progress['persentase'];
	if($status=='Sudah Selesai'){
		
		$persentase_update = $persentase - 2;	
	}else{
		$persentase_update = $persentase;
	}
	
	$sql = mysqli_query($konek, "UPDATE persentase SET persentase='$persentase_update' where proyek_id='$proyek'");

	if($proses) header("location: progress_data.php?id=".$proyek."&type=".$type."&pesan=".base64_encode("Task dihapus"));
}

if(isset($_POST['updateproyek'])){
	function tanggal_proyek($tanggal){
		$pecah = explode('-',$tanggal);
		return $pecah[0]."-".$pecah[1]."-".$pecah[2];
	}
	$progress = json_encode(array(0,0,0,0,0));
	$mulai = tanggal_proyek($_POST['mulai']);
	$beres = tanggal_proyek($_POST['beres']);

	$data = mysqli_query($konek,"select * from proyek where id='$_POST[id]'");
	$get = mysqli_fetch_array($data);
	$estimasi_before = $get['estimasi_biaya'];
	
	$estimasi = $_FILES['uploadestimasi']['name'];
	if(!empty($estimasi)){
		$estimasi_tmp = $_FILES['uploadestimasi']['tmp_name'];
		$x = explode('.', $estimasi);
		$ekstensi = strtolower(end($x));
		$estimasi_biaya = 'estimasi'.$_POST['id'].'.'.$ekstensi;

		move_uploaded_file($estimasi_tmp, 'uploads/'.$estimasi_biaya);

	}else{
		$estimasi_biaya = $estimasi_before;
	}
	
	$masuk_data = mysqli_query($konek, "UPDATE proyek SET nama_proyek='$_POST[nama_proyek]', nama_barang='$_POST[nama_barang]', 
	jumlah_barang='$_POST[jumlah_barang]', supplier='$_POST[supplier]', estimasi_pengerjaan='$_POST[estimasi_pengerjaan]', 
	estimasi_biaya='$estimasi_biaya', start='$mulai', end='$beres', progress='$progress', vendor='$_POST[vendor]', aproval_admin='Belum Diapprove(Edit Data)' WHERE id='$_POST[id]'");
	if($masuk_data) header("location: proyek.php?pesan=".base64_encode("Data Proyek Berhasil Diubah"));

	if(($masuk_data) AND ($_FILES['uploadlaporan']['name'] != "")){
		$errors= array();
		  
		  $file_size =$_FILES['uploadlaporan']['size'];
		  $file_tmp =$_FILES['uploadlaporan']['tmp_name'];
		  $file_type=$_FILES['uploadlaporan']['type'];
		  $tmp = explode('.',$_FILES['uploadlaporan']['name']);
		  $file_ext=strtolower(end($tmp));
		  $file_name = "laporan".$_POST['id'].".".$file_ext;
		  
		  $extensions= array("pdf");
		  
		  if(in_array($file_ext,$extensions)=== false) $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"uploads/".$file_name);
			 if(mysqli_query($konek, "UPDATE proyek SET laporan = '$file_name' WHERE id = '$$_POST[id]'")) header("location: proyek.php?pesan=".base64_encode("Data Proyek Berhasil Diubah"));
		  }else print_r($errors);
	}
}

if(isset($_POST['tambahproyek'])){
	
	function tanggal_proyek($tanggal){
		$pecah = explode('-',$tanggal);
		return $pecah[0]."-".$pecah[1]."-".$pecah[2];
	}
	$progress = json_encode(array(0,0,0,0,0));
	$mulai = tanggal_proyek($_POST['mulai']);
	$beres = tanggal_proyek($_POST['beres']);
	$sekarang = strtotime(date("Y-m-d"));

	$get_lastest_id = implode(" ", mysqli_fetch_assoc(mysqli_query($konek, "SELECT id FROM proyek ORDER BY id DESC LIMIT 1")));
	$new_id = $get_lastest_id + 1;
	$estimasi = $_FILES['uploadestimasi']['name'];
	$estimasi_tmp = $_FILES['uploadestimasi']['tmp_name'];
	$x = explode('.', $estimasi);
	$ekstensi = strtolower(end($x));
	$estimasi_biaya = 'estimasi'.$new_id.'.'.$ekstensi;

	move_uploaded_file($estimasi_tmp, 'uploads/'.$estimasi_biaya);

	if($sekarang < strtotime($mulai)) $status ="Akan Berjalan"; else $status="Berjalan";
	$masuk_data = mysqli_query($konek, "INSERT INTO proyek (id,nama_proyek,nama_barang,jumlah_barang,supplier,estimasi_pengerjaan,estimasi_biaya,start,
	end,progress,laporan,status,user_id,vendor,aproval_admin) 
	VALUES('$new_id','$_POST[nama_proyek]','$_POST[nama_barang]','$_POST[jumlah_barang]','$_POST[supplier]','$_POST[estimasi_pengerjaan]',
	'$estimasi_biaya','$mulai','$beres','$progress','','$status','$_POST[user_id]','$_POST[vendor]','Belum Diapprove(Tambah Data)')");

	$insert_persentase = mysqli_query($konek, "INSERT INTO persentase VALUES('','$new_id',0)");

	if($masuk_data){ 
		$idakhir = implode(" ", mysqli_fetch_assoc(mysqli_query($konek, "SELECT id FROM proyek ORDER BY id DESC LIMIT 1")));
		$errors= array();
		  
		  $file_size =$_FILES['uploadlaporan']['size'];
		  $file_tmp =$_FILES['uploadlaporan']['tmp_name'];
		  $file_type=$_FILES['uploadlaporan']['type'];
		  $tmp = explode('.',$_FILES['uploadlaporan']['name']);
		  $file_ext=strtolower(end($tmp));
		  $file_name = "laporan".$idakhir.".".$file_ext;
		  
		  $extensions= array("pdf");
		  
		  if(in_array($file_ext,$extensions)=== false) $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"uploads/".$file_name);
			 if(mysqli_query($konek, "UPDATE proyek SET laporan = '$file_name' WHERE id = '$idakhir'")) header("location: proyek.php?pesan=".base64_encode("Proyek Berhasil Ditambahkan"));
		  }else print_r($errors);
	}else{
		echo 'error';
	}
}

if(isset($_POST['edituser'])){
	if(mysqli_query($konek, "UPDATE users SET nama='$_POST[nama]', email='$_POST[email]', telp='$_POST[telp]', level='$_POST[level]' WHERE id_user='$_POST[id]'")){
		if($_POST['edit']){
			header("location: manageuser.php?pesan=".base64_encode("Data Berhasil Diubah"));
		}else{
			header("location: user.php?pesan=".base64_encode("Data Berhasil Diubah"));
		}
	}else{
		if($_POST['edit']){ 
			header("location: manageuser.php?pesan=".base64_encode("Data Gagal Diubah"));
		}else{
			header("location: user.php?pesan=".base64_encode("Data Gagal Diubah"));
		}
	}
}

if(isset($_POST['cekusername'])){
	echo mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(*) AS hitung FROM users WHERE username = '$_POST[cekusername]'"))['hitung'];
}

if(isset($_POST['tambahuser'])){
	if(mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(*) AS hitung FROM users WHERE username = '$_POST[username]'"))['hitung'] <= 0){
		$sekarang = strtotime("now");
		$password = md5($_POST['password']);
		if(mysqli_query($konek, "INSERT INTO users (username,nama,email,level,password,telp,tanggal_gabung) VALUES('$_POST[username]','$_POST[nama]','$_POST[email]','$_POST[level]','$password','$_POST[telp]','$sekarang')")) header("location: tambahuser.php?pesan=".base64_encode("User Berhasil Ditambahkan"));
	}else{
		header("location: tambahuser.php?pesan=".base64_encode("Username Sudah Ada"));
	}
}

if(isset($_POST['ubahpassword'])){
	if(md5($_POST['password_baru']) == md5($_POST['konfirmasi_password'])){
		$password_lama = mysqli_fetch_array(mysqli_query($konek, "SELECT password FROM users WHERE id_user='$_POST[id]'"));
		$password = md5($_POST['password_baru']);
		if(md5($_POST['password_lama']) === $password_lama['password']){
			if(mysqli_query($konek, "UPDATE users SET password='$password' WHERE id_user='$_POST[id]'")) header("location: ubahpassword.php?pesan=".base64_encode("Password Berhasil Diubah"));
		}else{
			header("location: ubahpassword.php?pesan=".base64_encode("Password Lama Salah"));
		}
	}else{
		header("location: ubahpassword.php?pesan=".base64_encode("Password Tidak Cocok"));
	}

}
if(isset($_GET['nonaktif'])){
	if(mysqli_query($konek, "UPDATE users SET status='0' WHERE id_user='$_GET[nonaktif]'")) header("location: manageuser.php?pesan=".base64_encode("User Berhasil Dinonaktifkan"));
}
if(isset($_GET['aktif'])){
	if(mysqli_query($konek, "UPDATE users SET status='1' WHERE id_user='$_GET[aktif]'")) header("location: manageuser.php?pesan=".base64_encode("User Berhasil Diaktifkan"));
}
if(isset($_GET['hapususer'])){
	if(mysqli_query($konek, "DELETE FROM users WHERE id_user='$_GET[hapususer]'")) header("location: manageuser.php?pesan=".base64_encode("User Berhasil Dihapus"));
}

// tambah Task
if(isset($_POST['tambahtask'])){
	$insert = mysqli_query($konek, "INSERT INTO progres VALUES('','$_POST[proyek_id]','$_POST[type]','$_POST[user_id]','$_POST[task]','Belum Selesai','$_POST[detailtask]')");
	if($insert){
		header("location: progress_data.php?id=".$_POST['proyek_id']."&type=".$_POST['type']."&pesan=".base64_encode("Task Berhasil Ditambahkan"));
	}
}
?>