<?php
session_start();
if(isset($_SESSION['level'])){
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$sekarang = strtotime(date("Y-m-d"));
$id_user = $_SESSION['id'];
if($_SESSION['level']==1){
	$events = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM  proyek WHERE status='Berjalan' OR status='Akan Berjalan'"));
	$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE status='Berjalan' OR status='Akan Berjalan'"));
	
}else{
	$events = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE user_id='$id_user' AND (status='Berjalan' OR status='Akan Berjalan')"));
	$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM proyek WHERE user_id='$id_user' AND (status='Berjalan' OR status='Akan Berjalan')"));
	
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>Dashboard | Manajemen Proyek</title>
	<link href="css/style.min.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<script type="text/javascript" src="chartjs/Chart.js"></script>
</head>

<body>
	
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php include('includes/header.php'); ?>
		
        <?php include('includes/nav.php'); ?>
		
        <div class="page-wrapper" style="min-height: 250px;">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
						<small>Selamat Datang, <?= $_SESSION['username']?></small>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="white-box analytics-info">
							<h3 class="box-title">Proyek yang Akan Berjalan</h3>
							<ul class="list-inline two-part d-flex align-items-center mb-0">
								<li>
									<img src="images/chart.png">
								</li>
								<?php 
									if($_SESSION['level']==1){
								?>
								<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE status='Akan Berjalan'")); ?></span></li>
								<?php }else{ ?>
									<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE user_id='$id_user' AND status='Akan Berjalan'")); ?></span></li>		
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="white-box analytics-info">
							<h3 class="box-title">Proyek yang Sedang Berjalan</h3>
							<ul class="list-inline two-part d-flex align-items-center mb-0">
								<li>
									<img src="images/chart.png">
								</li>
								<?php 
									if($_SESSION['level']==1){
								?>
								<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE status='Berjalan'")); ?></span></li>
								<?php }else{ ?>
									<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE user_id='$id_user' AND status='Berjalan'")); ?></span></li>		
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="white-box analytics-info">
							<h3 class="box-title">Proyek Selesai</h3>
							<ul class="list-inline two-part d-flex align-items-center mb-0">
								<li>
									<img src="images/chart.png">
								</li>
								<?php 
									if($_SESSION['level']==1){
								?>
								<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE status='Selesai'")); ?></span></li>
								<?php }else{ ?>
									<li class="ml-auto"><span class="counter text-success"><?php echo mysqli_num_rows(mysqli_query($konek, "SELECT * FROM proyek WHERE user_id='$id_user' AND status='Selesai'")); ?></span></li>		
								<?php } ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="white-box">
							<div class="chart-container">
								<canvas id="myChart"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-5">
						<div class="card-header">
							<h3>Reminder Proyek</h3>
						</div>
						<?php foreach($projects as $project):
						$progress = json_decode($project[9]);
						$jumlah = 0;
						foreach($progress as $atom){
							if($atom == "1") $jumlah++;
						}
						$persen = $jumlah/5*100;
						$mulai = strtotime($project[7]);
						$beres = strtotime($project[8]);
						$selisih_beres = ($beres-$sekarang)/3600/24;
						$selisih_mulai = ($mulai-$sekarang)/3600/24;

						$progres = mysqli_fetch_array(mysqli_query($konek, "select * from persentase where proyek_id='$project[0]'"));
						$persentase = $progres['persentase'];
						if($persentase<0){
							$persentase = 0;
						}
						?>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title"><?php echo $project[1] ?><h5>
								<?php if($project[11] == "Akan Berjalan") echo "<p class='card-text'>Proyek <strong>akan dimulai</strong> pada $project[7] atau <strong>$selisih_mulai hari lagi.</strong></p>"; ?>
								<?php if($project[11] == "Berjalan") echo "<p class='card-text'>Proyek <strong>akan jatuh tempo</strong> pada $project[8] atau <strong>$selisih_beres hari lagi.</strong></p>"; ?>
								<div class="progress" style="height: 20px;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $persentase ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $persentase.'%'?></div>
								</div><br>
								
								<a href="proyek.php?id=<?php echo $project[0] ?>" class="btn btn-primary">Lihat Proyek</a>
								
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<div class="col-md-7">
						<div class="card-header">
							<h3>Kalender Jadwal Proyek</h3>
						</div>
						<div class="card">
							<div class="card-body">
								<div id="calendar" class="col-centered"></div>
							</div>
						</div>
					</div>
                </div>
            </div>
			<?php include('includes/footer.php') ?>
        </div>
    </div>   
	<script src="js/jquery.js"></script>
	
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	<script>
		$(document).ready(function() {
			
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				defaultDate: '<?php echo date("Y-m-d") ?>',
				editable: true,
				eventLimit: true,
				selectable: true,
				selectHelper: true,
				events: [
				<?php foreach($events as $event): 
					
				?>
					{
						id: '<?php echo $event[0]; ?>',
						title: '<?php echo $event[1]; ?>',
						start: '<?php echo $event[7]; ?>',
						end: '<?php echo date("Y-m-d",strtotime($event[8])+86400); ?>',
						color: '<?php echo "#0071c5"; ?>',
					},
				<?php endforeach; ?>
				]
			});
			
		});
	</script>
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Akan Berjalan", "Sedang Berjalan", "Selesai"],
				datasets: [{
					label: 'Diagram Proyek',
					data: [
					<?php 
					if($_SESSION['level']==1){
						$aberjalan = mysqli_query($konek,"select * from proyek where status='Akan Berjalan'");
					}else{
						$aberjalan = mysqli_query($konek,"select * from proyek where user_id='$id_user' AND status='Akan Berjalan'");
					}
					
					echo mysqli_num_rows($aberjalan);
					?>, 
					<?php 
					if($_SESSION['level']==1){
						$berjalan = mysqli_query($konek,"select * from proyek where status='Berjalan'");
					}else{
						$berjalan = mysqli_query($konek,"select * from proyek where user_id='$id_user' AND status='Berjalan'");
					}
					echo mysqli_num_rows($berjalan);
					?>,
					<?php 
					if($_SESSION['level']==1){
						$selesai = mysqli_query($konek,"select * from proyek where status='Selesai'");
					}else{
						$selesai = mysqli_query($konek,"select * from proyek where user_id='$id_user' AND status='Selesai'");
					}
					
					echo mysqli_num_rows($selesai);
					?>
					],
					"borderColor":"rgb(75, 192, 192)"
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
	
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
<?php }else{ header('location: login.php'); } ?>