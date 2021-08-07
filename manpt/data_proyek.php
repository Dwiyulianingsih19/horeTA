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
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE aproval_admin = 'Sudah diapprove'"));
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
                            <h3 class="box-title">Data Proyek (Untuk Critical Path)</h3>
							
							<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Nama Proyek</th>
                                            <th class="border-top-0">Estimasi Pengerjaan</th>
											<th class="border-top-0">Jatuh Tempo</th>
											<th class="border-top-0">Vendor</th>
											<th class="border-top-0">Status</th>
											<th class="border-top-0">Data Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($projects as $project):
										?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $project[1]; ?></td>
                                            <td><?php echo $project[5]; ?> Hari</td>
											<td><?php echo $project[8]; ?></td>
											<td><?php echo $project[13]; ?></td>
											<td><?php echo $project[11]; ?></td>
											<td><a href="data_task.php?id=<?php echo $project[0]; ?>" class="btn btn-primary">Data Task</a></td>
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
								
								<?php
									$get_persentase = mysqli_fetch_array(mysqli_query($konek, "select * from persentase where proyek_id = '$project[0]'"));
									$persentase = $get_persentase['persentase'];
									if($persentase<0){
										$persentase = 0;
									}else{
										$persentase = $get_persentase['persentase'];
									}
								?>
								
								
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