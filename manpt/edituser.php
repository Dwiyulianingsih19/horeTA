<?php
session_start();
if(isset($_SESSION['level'])){
if($_SESSION['level']=="1"){
if(isset($_GET['id'])){
include('koneksi.php');
$data = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM users WHERE id_user='$_GET[id]'"));

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Ubah Data</title>
	<link href="css/style.min.css" rel="stylesheet">
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
                        <h4 class="page-title text-uppercase font-medium font-14">Edit Data</h4>
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
							<div class="card-header">
								<h3>Form Edit User</h3>
							</div>
                            <div class="card-body">
                                <form action="progress.php" method="post" class="form-horizontal form-material">
									<div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Johnathan Doe" class="form-control p-0 border-0" value="<?php echo $data['username']; ?>" disabled> 
										</div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Johnathan Doe" class="form-control p-0 border-0" name="nama" value="<?php echo $data['nama']; ?>"> 
										</div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="johnathan@admin.com" class="form-control p-0 border-0" name="email" id="example-email" value="<?php echo $data['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="123 456 7890" class="form-control p-0 border-0" name="telp" value="<?php echo $data['telp']; ?>">
                                        </div>
                                    </div>
									<div class="form-group mb-4">
                                        <label class="col-sm-12">Level</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select name="level" class="form-control p-0 border-0">
                                                <option value="1" <?php if ($data['level'] == "1") echo "selected" ?>>Admin</option>
                                                <option value="2" <?php if ($data['level'] == "2") echo "selected" ?>>User</option>
                                            </select>
                                        </div>
                                    </div>
									<input type="hidden" name="id" value="<?php echo $data['id_user']; ?>">
									<input type="hidden" name="edit" value="1">
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="edituser" class="btn btn-success">Ubah Data</button>
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
</body>

</html>
<?php }else{ header("location:manageuser.php"); } } }else{ header('location: login.php'); } ?>