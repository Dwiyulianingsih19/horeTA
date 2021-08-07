<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$id_user = $_SESSION['id'];
$level = $_SESSION['level'];
if(isset($_GET['cari'])){
	if($level==1){
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE nama_proyek LIKE '%".$_GET['cari']."%'"));
	}else{
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE nama_proyek LIKE '%".$_GET['cari']."%' AND user_id='$id_user'"));
	}
}else if(isset($_GET['id'])){
	if($level==1){
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE id='$_GET[id]'"));
	}else{
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE id='$_GET[id]' AND user_id='$id_user'"));
	}
}else{
	if($level==1){
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek"));
	}else{
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek where user_id='$id_user'"));
	}
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
                        <h4 class="page-title text-uppercase font-medium font-14">Data Proyek</h4>
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
                            <h3 class="box-title">Data Proyek</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tdata"><i class="fas fa-plus"></i> Tambah Data</button>
							
							<a href="excel.php"><button type="button" class="btn btn-success" style="color: #fff"><i class="fas fa-download"></i> Download Excel</button></a>


							
							<div class="modal fade" id="tdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah Data Proyek</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										
										<form action="progress.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Proyek</label>
													<input type="text" name="nama_proyek" class="form-control" id="recipient-name" required>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">Proyek Mulai</label>
														<input type = "date" name = "mulai" class="form-control" required>  
													</div>
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">Proyek Berakhir</label>
														<input type = "date" name = "beres" class="form-control" required>  
													</div>
												</div>
												<br>
												<div class="form-group">
													<h4>Detail Proyek</h4>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Jenis Proyek</label>
													<input type="text" name="nama_barang" class="form-control" id="recipient-name" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Keterangan proyek</label>
													<input type="text" name="jumlah_barang" class="form-control" id="recipient-name" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Supplier</label>
													<input type="text" name="supplier" class="form-control" id="recipient-name" required>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Vendor</label>
													<input type="text" name="vendor" class="form-control" id="recipient-name" required>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">Estimasi Pengerjaan (Hari)</label>
														<input type = "number" name = "estimasi_pengerjaan" class="form-control" onkeypress="validate(event)" required>  
													</div>
													<div class="form-group col-md-6">
														<label for="recipient-name" class="col-form-label">Estimasi Biaya</label>
														<div class="custom-file">
															<input type="file" name="uploadestimasi" class="custom-file-input" id="customFile">
															<label class="custom-file-label" for="customFile" required>Choose file</label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Upload Laporan</label>
													<div class="custom-file">
														<input type="file" name="uploadlaporan" class="custom-file-input" id="customFile">
														<label class="custom-file-label" for="customFile" required>Choose file</label>
													</div>
												</div>
											</div>
											<input type="hidden" name="user_id" value="<?=$id_user?>">
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="tambahproyek" class="btn btn-primary">Tambah</button>
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
                                            <th class="border-top-0">Nama Proyek</th>
                                            <th class="border-top-0">Estimasi Pengerjaan</th>
                                            <th class="border-top-0">Estimasi Biaya</th>
											<th class="border-top-0">Jatuh Tempo</th>
											<th class="border-top-0">Vendor</th>
											<th class="border-top-0">Status</th>
											<th class="border-top-0">Approval Admin</th>
											<th class="border-top-0">Detail</th>
											<th class="border-top-0">Progress</th>
                                            <th class="border-top-0">Update</th>
											<th class="border-top-0">Hapus</th>
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
                                            <td><?php echo $project[1]; ?></td>
                                            <td><?php echo $project[5]; ?> Hari</td>
                                            <td><a href="uploads/<?=$project[6]?>" download>Download</a></td>
											<td><?php echo $project[8]; ?></td>
											<td><?php echo $project[13]; ?></td>
											<td><?php echo $project[11]; ?></td>
											<td><?php echo $project[14]; ?></td>
											<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $project[0]; ?>">Detail</button></td>
											<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#progress<?php echo $project[0]; ?>" <?php if($project[11] == "Selesai" || $project[14]!="Sudah diapprove") echo "disabled"; ?>>Progress</button></td>
                                            <td><button type="button" class="btn btn-success" style="color: #fff" data-toggle="modal" data-target="#update<?php echo $project[0]; ?>" <?php if($project[11] == "Selesai" || $project[14]!="Sudah diapprove") echo "disabled"; ?>>Update</button></td>
											<td><a href="progress.php?id=<?php echo $project[0]; ?>&hapus=1" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin akan menghapus proyek?');">Hapus</a></td>
											<?php
												if($project[14]!="Sudah diapprove" && $level==1){
											?>
											<td><a href="progress.php?id=<?php echo $project[0]; ?>&aprove=1" class="btn btn-info w-100">Approve</a></td>
											<?php } ?>
										</tr>
                                        <?php $no++; endforeach; ?>
										
                                    </tbody>
                                </table>
								<?php foreach($projects as $project):
								$progress = json_decode($project[9]);
								$jumlah = 0;
								foreach($progress as $atom){
									if($atom == "1") $jumlah++;
								}
								$persen = $jumlah/5*100;
								?>
								<div class="modal fade" id="detail<?php echo $project[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Detail Proyek</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<table class="table">
													<tr>
														<td>Nama Proyek</td>
														<td><?php echo $project[1]; ?></td>
													</tr>
													<tr>
														<td>Jenis Proyek</td>
														<td><?php echo $project[2]; ?></td>
													</tr>
													<tr>
														<td>Keterangan Proyek</td>
														<td><?php echo $project[3]; ?></td>
													</tr>
													<tr>
														<td>Supplier</td>
														<td><?php echo $project[4]; ?></td>
													</tr>
													<tr>
														<td>Estimasi Pekerjaan</td>
														<td><?php echo $project[5]; ?> Hari</td>
													</tr>
													<tr>
														<td>Estimasi Biaya</td>
														<td><?php echo $project[6]; ?></td>
													</tr>
													<tr>
														<td>Mulai Proyek</td>
														<td><?php echo $project[7]; ?></td>
													</tr>
													<tr>
														<td>Jatuh Tempo Proyek</td>
														<td><?php echo $project[8]; ?></td>
													</tr>
													<tr>
														<td>Vendor</td>
														<td><?php echo $project[13]; ?></td>
													</tr>
													<tr>
														<td>Progress</td>
														<td><?php echo $persen; ?>%</td>
													</tr>
												</table>
												<button type="button" class="btn btn-primary w-100" data-dismiss="modal" onclick="window.open('laporan.php?id=<?php echo $project[0]; ?>', '_blank');">Lihat Laporan</button>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<?php
									$get_persentase = mysqli_fetch_array(mysqli_query($konek, "select * from persentase where proyek_id = '$project[0]'"));
									$persentase = $get_persentase['persentase'];
									if($persentase<0){
										$persentase = 0;
									}else{
										$persentase = $get_persentase['persentase'];
									}
								?>
								<div class="modal fade" id="progress<?php echo $project[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="progress.php" method="post">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Progress Proyek</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="progress" style="height: 25px;">
														<div class="progress-bar progress-bar<?php echo $project[0]; ?>" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase; ?>%;"><?php echo $persentase; ?>%</div>
													</div>
													
													<div class="form-check">
														<!-- <input class="form-check-input progres<?php echo $project[0]; ?>" name="progress[]" type="checkbox" value="0" <?php if(json_decode($project[9])[0] == "1") echo "checked='checked'"; ?> <?php if($project[11] == "Selesai") echo "disabled" ?>> -->
														<!-- <label class="form-check-label" for="defaultCheck1"> -->
														<a href="progress_data.php?id=<?=$project[0]?>&type=1">Perencanaan</a>
														</label>
													</div>
													<div class="form-check">
														<!-- <input class="form-check-input progres<?php echo $project[0]; ?>" name="progress[]" type="checkbox" value="1" <?php if(json_decode($project[9])[1] == "1") echo "checked='checked'"; ?> <?php if($project[11] == "Selesai") echo "disabled" ?>> -->
														<!-- <label class="form-check-label" for="defaultCheck2"> -->
														<a href="progress_data.php?id=<?=$project[0]?>&type=2">Perancangan</a>
														</label>
													</div>
													<div class="form-check">
														<!-- <input class="form-check-input progres<?php echo $project[0]; ?>" name="progress[]" type="checkbox" value="2" <?php if(json_decode($project[9])[2] == "1") echo "checked='checked'"; ?> <?php if($project[11] == "Selesai") echo "disabled" ?>> -->
														<!-- <label class="form-check-label" for="defaultCheck2"> -->
														<a href="progress_data.php?id=<?=$project[0]?>&type=3">Pengadaan</a>
														</label>
													</div>
													<div class="form-check">
														<!-- <input class="form-check-input progres<?php echo $project[0]; ?>" name="progress[]" type="checkbox" value="3" <?php if(json_decode($project[9])[3] == "1") echo "checked='checked'"; ?> <?php if($project[11] == "Selesai") echo "disabled" ?>> -->
														<!-- <label class="form-check-label" for="defaultCheck2"> -->
														<a href="progress_data.php?id=<?=$project[0]?>&type=4">Pelaksanaan</a>
														</label>
													</div>
													<div class="form-check">
														<!-- <input class="form-check-input progres<?php echo $project[0]; ?>" name="progress[]" type="checkbox" value="4" <?php if(json_decode($project[9])[4] == "1") echo "checked='checked'"; ?> <?php if($project[11] == "Selesai") echo "disabled" ?>> -->
														<!-- <label class="form-check-label" for="defaultCheck2"> -->
														<a href="progress_data.php?id=<?=$project[0]?>&type=5">Pemeliharaan</a>
														</label>
													</div>
													<input type="hidden" name="id" value="<?php echo $project[0]; ?>">
													<br>
													<a href="progress.php?id=<?php echo $project[0]; ?>&progress=1" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin akan menyelesaikan proyek?');">Selesai</a>
												</div>
											
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" name="saveprogress" class="btn btn-primary">Save changes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								
								<div class="modal fade" id="update<?php echo $project[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit Data Proyek</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="progress.php" method="post" enctype="multipart/form-data">
												<div class="modal-body">
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Nama Proyek</label>
														<input type="text" name="nama_proyek" class="form-control" id="recipient-name" value="<?php echo $project[1]; ?>" required>
													</div>
													<div class="row">
														<div class="form-group col-md-6">
															<label for="recipient-name" class="col-form-label">Proyek Mulai</label>
															<input type = "date" name = "mulai" class="form-control" value="<?php echo $project[7]; ?>" required>  
														</div>
														<div class="form-group col-md-6">
															<label for="recipient-name" class="col-form-label">Proyek Berakhir</label>
															<input type = "date" name = "beres" class="form-control" value="<?php echo $project[8]; ?>" required>  
														</div>
													</div>
													<br>
													<div class="form-group">
														<h4>Detail Proyek</h4>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Jenis Proyek</label>
														<input type="text" name="nama_barang" class="form-control" id="recipient-name" value="<?php echo $project[2]; ?>" required>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Keterangan Proyek</label>
														<input type="text" name="jumlah_barang" class="form-control" id="recipient-name" value="<?php echo $project[3]; ?>" required>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Supplier</label>
														<input type="text" name="supplier" class="form-control" id="recipient-name" value="<?php echo $project[4]; ?>" required>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Vendor</label>
														<input type="text" name="vendor" class="form-control" id="recipient-name" value="<?php echo $project[13]; ?>" required>
													</div>
													<div class="row">
														<div class="form-group col-md-6">
															<label for="recipient-name" class="col-form-label">Estimasi Pengerjaan (Hari)</label>
															<input type = "number" name = "estimasi_pengerjaan" class="form-control" value="<?php echo $project[5]; ?>" onkeypress="validate(event)" required>  
														</div>
														<div class="form-group col-md-6">
															<label for="recipient-name" class="col-form-label">Estimasi Biaya</label>
															<div class="custom-file">
																<input type="file" name="uploadestimasi" class="custom-file-input" id="customFile">
																<label class="custom-file-label" for="customFile" required>Choose file</label>
															</div>
														</div>
													</div>
													<div class="form-group">
													<label for="recipient-name" class="col-form-label">Upload Laporan</label>
													<div class="custom-file">
														<input type="file" name="uploadlaporan" class="custom-file-input" id="customFile">
														<label class="custom-file-label" for="customFile" required>Choose file</label>
													</div>
												</div>
												</div>
												<input type="hidden" name="id" value="<?php echo $project[0]; ?>">
												<input type="hidden" name="user_id" value="<?php echo $project[12]; ?>">
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" name="updateproyek" class="btn btn-primary">Update</button>
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