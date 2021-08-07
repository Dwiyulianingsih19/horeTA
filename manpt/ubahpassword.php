<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$data = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM users WHERE username='$_SESSION[username]'"));

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Ubah Password</title>
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
                        <h4 class="page-title text-uppercase font-medium font-14">Ubah Password</h4>
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
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
							<div class="form-group">
								<a href="user.php" class="btn btn-primary w-100">Ubah Data</a>
							</div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="progress.php" method="post" class="form-horizontal form-material">
									
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password Lama</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" placeholder="Password Lama" name="password_lama" class="form-control p-0 border-0" required>
                                        </div>
                                    </div>
									<div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password Baru</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" placeholder="Password Baru" name="password_baru" class="form-control p-0 border-0" required>
                                        </div>
                                    </div>
									<div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Konfirmasi Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" placeholder="Konfirmasi Password" name="konfirmasi_password" class="form-control p-0 border-0" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $data['id_user']; ?>">
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="ubahpassword" class="btn btn-success">Ubah Password</button>
                                        </div>
                                    </div>
                                </form>
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
</body>

</html>
<?php }else{ header('location: login.php'); } ?>