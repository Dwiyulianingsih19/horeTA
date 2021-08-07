<?php
session_start();
if(isset($_SESSION['level'])){
if($_SESSION['level']=="1"){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Tambah User</title>
	<link href="css/style.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php include('includes/header.php'); ?>
		
        <?php include('includes/nav.php'); ?>
		
        <div class="page-wrapper" style="min-height: 250px;">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Tambah User</h4>
                    </div>
                </div>
            </div>
            
			 <div class="container-fluid">
				<?php if(isset($_GET['pesan'])){ ?>
				<div class="row">
                    <div class="col-md-12">
						<div class="alert alert-secondary" role="alert">
						  <?php echo base64_decode($_GET['pesan']); ?>
						</div>
					</div>
				</div>
				<?php } ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="progress.php" method="post" class="form-horizontal form-material">
									<div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" id="username" name="username" autocomplete="off" placeholder="masukkan username" class="form-control p-0 border-0" required> 
										</div>
										<div id="result"></div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="masukkan nama" name="nama" class="form-control p-0 border-0" required> 
										</div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="masukkan email" name="email" class="form-control p-0 border-0" name="example-email" id="example-email" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="" name="password" class="form-control p-0 border-0" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="masukkan no telp" name="telp" class="form-control p-0 border-0" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Level</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select name="level" class="form-control p-0 border-0">
                                                <option value="1">Admin</option>
                                                <option value="2">User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="tambahuser" class="btn btn-success">Tambah User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4">
						<div class="white-box">
							<div class="form-group">
								<a href="manageuser.php" class="btn btn-primary w-100">Manage User</a>
							</div>
                        </div>
					</div>
                </div>
            </div>
            <?php include('includes/footer.php') ?>
        </div>
    </div>   
	<script src="js/jquery.js"></script>
	
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
	<script>
	 $(document).ready(function() {
		 $('#username').keyup(function() {
			 var uname = $('#username').val();
			 if(uname == 0) {
				$('#result').text('');
			 }else {
				 $.ajax({
					 url: 'progress.php',
					 type: 'POST',
					 data: 'cekusername='+uname,
					 success: function(hasil) {
						 if(hasil > 0) {
							$('#result').text('Username tidak tersedia');
						 }else {
							$('#result').text('Username tersedia');
						 }
					 }
				 });
			 }
		 });
	 });
	</script>
</body>

</html>
<?php }else{ header('location: user.php'); } }else{ header('location: login.php'); } ?>