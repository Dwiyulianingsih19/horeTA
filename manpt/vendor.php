<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$sqlVendor = "SELECT * FROM vendor";
$data = mysqli_fetch_all(mysqli_query($konek, $sqlVendor));

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
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
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tdata"><i class="fas fa-plus"></i> Tambah Vendor</button>
						
						<div class="modal fade" id="tdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Data Vendor</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										
										<form action="vendor_fungsi.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Vendor</label>
													<input type="text" name="nama_vendor" class="form-control" id="recipient-name" required>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">No Telepon</label>
														<input type = "text" name = "noTelp" class="form-control" required>  
													</div>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Alamat</label>
													<input type="text" name="alamat_vendor" class="form-control" id="recipient-name" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Penanggung Jawab</label>
													<input type="text" name="penanggung_jawab" class="form-control" id="recipient-name" required>
												</div>
											</div>
											<input type="hidden" name="user_id" value="<?=$id_user?>">
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="tambahVendor" class="btn btn-primary">Tambah</button>
											</div>
										</form>
									</div>
								</div>
							</div>

						
						<br><br>						
							<div class="fw-container">
								<div class="fw-body">
									<table id="manageuser" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
										<thead>
											<tr>
											<th>No</th>
											<th>Nama Vendor</th>
											<th>No Telepon</th>
											<th>Alamat</th>
											<th>Penanggung Jawab</th>
											<th>Aksi</th>
											
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($data as $vendor): ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $vendor[1]; ?></td>
												<td><?php echo $vendor[2]; ?></td>
												<td><?php echo $vendor[3]; ?></td>
												<td><?php echo $vendor[4]; ?></td>
												<td>
													<button type="button" class="btn btn-warning btn-circle btn-md" data-toggle="modal" data-target="#editvendor<?php echo $vendor[0] ?>"><i class="far fa-edit" aria-hidden="true"></i></button>
													<a href="vendor_fungsi.php?hapusVendor=<?php echo $vendor[0] ?>" onclick="return confirm('Apakah Anda yakin akan menghapus user?');"><button type="button" class="btn btn-danger btn-circle btn-md"><i class="far fa-trash-alt" aria-hidden="true"></i></button></a>
												</td>
											</tr>
											<?php $no++; endforeach; ?>
										</tbody>
									</table>


									<?php foreach($data as $vendor): ?>
									<div class="modal fade" id="editvendor<?php echo $vendor[0] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Data Vendor</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										
										<form action="vendor_fungsi.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Vendor</label>
													<input type="text" name="nama_vendor_edit" class="form-control" id="recipient-name" value="<?php echo $vendor[1]; ?>" required>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">No Telepon</label>
														<input type = "text" name = "noTelp_edit" class="form-control" value="<?php echo $vendor[2]; ?>" required>  
													</div>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Alamat</label>
													<input type="text" name="alamat_vendor_edit" class="form-control" id="recipient-name" value="<?php echo $vendor[3]; ?>" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Penanggung Jawab</label>
													<input type="text" name="penanggung_jawab_edit" class="form-control" id="recipient-name" value="<?php echo $vendor[4]; ?>" required>
												</div>
											</div>
											<input type="hidden" name="id_vendor_edit" value="<?php echo $vendor[0] ?>">
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="editVendor" class="btn btn-primary">Tambah</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
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