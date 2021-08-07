<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$id_user = $_SESSION['id'];
$level = $_SESSION['level'];

$id_proyek = $_GET['id'];
$type = $_GET['type'];

if($type==1){
	$progres_name = 'Perencanaan';
}else if($type==2){
	$progres_name = 'Perancangan';
}else if($type==3){
	$progres_name = 'Pengadaan';
}else if($type==4){
	$progres_name = 'Pelaksanaan';
}else if($type==5){
	$progres_name = 'Pemeliharaan';
}else{
	$progres_name = 'Progres';
}

if($level==1){
	$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM progres where proyek_id='$id_proyek' AND type='$type'"));
}else{
	$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM progres where proyek_id='$id_proyek' AND type='$type' AND user_id='$id_user'"));
}
$no = 1;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Manage Proyek</title>
	<link href="css/style.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
	
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
                        <h4 class="page-title text-uppercase font-medium font-14">Data Progress</h4>
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
                            <h3 class="box-title">Task <?=$progres_name?> : Wajib memasukan 10 data</h3>
							<?php 
								if(count($projects)<=9){
							?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tdata"><i class="fas fa-plus"></i> Tambah Data</button>
							<?php
								}
								?>
							<!-- <a href="excel.php"><button type="button" class="btn btn-success" style="color: #fff"><i class="fas fa-download"></i> Download Excel</button></a> -->
							<div class="modal fade" id="tdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Task <?=$progres_name?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										
										<form action="progress.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Task</label>
													<input type="text" name="task" class="form-control" id="recipient-name" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Detail Task</label>
													<input type="text" name="detailtask" class="form-control" id="recipient-name" required>
												</div>
											</div>
											
											<input type="hidden" name="user_id" value="<?=$id_user?>">
											<input type="hidden" name="proyek_id" value="<?=$id_proyek?>">
											<input type="hidden" name="type" value="<?=$type?>">
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="tambahtask" class="btn btn-primary">Tambah</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Task</th>
                                            <th class="border-top-0">Detail Task</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Aksi</th>
											
											<?php
												if($level==1){
											?>
											<th class="border-top-0">Approval</th>
											<?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($projects as $project):
										?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $project[4]; ?></td>
                                            <td><?php echo $project[6]; ?></td>
                                            <td><?php echo $project[5]; ?></td>
											<td>
											<?php if($project[5]!='Sudah Selesai'){
												?>
											<a href="progress.php?id_task=<?php echo $project[0]; ?>&selesai=1" class="btn btn-warning">Set Selesai</a>
											<?php	
											} ?>
											
											 <a href="progress.php?id_task=<?php echo $project[0]; ?>&hapus=1" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus Task?');">Hapus</a></td>
                                            
											
										</tr>
                                        <?php $no++; endforeach; ?>
										
                                    </tbody>
                                </table>
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
	<?php foreach($projects as $project):
	?>
	<script>
		$('.progres<?php echo $project[0]; ?>').on('click', function() {
			var emptyValue = 0;
			$('.progres<?php echo $project[0]; ?>:checked').each(function() {
				emptyValue += 20;
			});
			$('.progress-bar<?php echo $project[0]; ?>').css('width', emptyValue + '%').attr('aria-valuenow', emptyValue);
			$('div.progress-bar<?php echo $project[0]; ?>').text(emptyValue+"%");

		});
	</script>
<?php endforeach; ?>
	<script>
		function validate(evt) {
			var theEvent = evt || window.event;

			if (theEvent.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
			} else {
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode(key);
			}
			var regex = /[0-9]|\./;
			if( !regex.test(key) ) {
				theEvent.returnValue = false;
				if(theEvent.preventDefault) theEvent.preventDefault();
			}
		}
	</script>
</body>

</html>
<?php }else{ header('location: login.php'); } ?>