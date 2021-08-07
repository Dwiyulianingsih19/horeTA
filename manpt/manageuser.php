<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$data = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM users"));

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Ubah Data</title>
	
	<link rel="stylesheet" type="text/css" href="css/example.css">
	<link href="css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
	<style>
        .btn-circle.btn-md { 
            width: 40px; 
            height: 40px; 
            padding: 7px 10px; 
            border-radius: 25px; 
            font-size: 10px; 
            text-align: center; 
        }
    </style> 

	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#manageuser').DataTable();
		} );
	</script>
</head>

<body class="wide comments example dt-example-bootstrap4">
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
                        <h4 class="page-title text-uppercase font-medium font-14">Manage User</h4>
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
                    <div class="col-sm-12">
						<div class="white-box">	
							<a href="tambahuser.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tdata"><i class="fas fa-plus"></i> Tambah User</button></a>	<br><br>						
							<div class="fw-container">
								<div class="fw-body">
									<table id="manageuser" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
										<thead>
											<tr>
											<th>No</th>
											<th>Username</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Level</th>
											<th>Nomor Telepon</th>
											<th>Tanggal Dibuat</th>
											<th>Status</th>
											<th>Manage User</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($data as $atom): ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $atom[1]; ?></td>
												<td><?php echo $atom[2]; ?></td>
												<td><?php echo $atom[3]; ?></td>
												<td><?php echo $atom[4] == "1" ? "Admin" : "User"; ?></td>
												<td><?php echo $atom[6]; ?></td>
												<td><?php echo date("d/m/Y", $atom[7]); ?></td>
												<td><?php echo $atom[8] == "1" ? "Aktif" : "Nonaktif"; ?></td>
												<td>
													<?php if($atom[8] == "1"){ ?><a href="progress.php?nonaktif=<?php echo $atom[0] ?>" onclick="return confirm('Apakah Anda yakin akan menonaktifkan user?');"><button type="button" class="btn btn-info btn-circle btn-md"><i class="fas fa-power-off" aria-hidden="true"></i></button></a><?php }else{ ?>
													<a href="progress.php?aktif=<?php echo $atom[0] ?>" onclick="return confirm('Apakah Anda yakin akan mengaktifkan user?');"><button type="button" class="btn btn-dark btn-circle btn-md"><i class="fas fa-power-off" aria-hidden="true"></i></button></a><?php } ?>
													<a href="edituser.php?id=<?php echo $atom[0] ?>"><button type="button" class="btn btn-warning btn-circle btn-md"><i class="far fa-edit" aria-hidden="true"></i></button></a>
													<a href="progress.php?hapususer=<?php echo $atom[0] ?>" onclick="return confirm('Apakah Anda yakin akan menghapus user?');"><button type="button" class="btn btn-danger btn-circle btn-md"><i class="far fa-trash-alt" aria-hidden="true"></i></button></a>
												</td>
											</tr>
											<?php $no++; endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
			<?php include('includes/footer.php') ?>
        </div>
    </div>
	
    <script src="js/popper.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
<?php }else{ header('location: login.php'); } ?>