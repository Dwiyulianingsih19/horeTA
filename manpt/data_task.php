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
		$projects = mysqli_fetch_all(mysqli_query($konek, "SELECT * FROM progres WHERE proyek_id='$_GET[id]'"));
	}
}
$no = 1;

if(isset($_POST['AddTask'])){


    // $myCek    = "SELECT * FROM order_obat_item WHERE no_order_obat ='$no_order_obat' AND kode_obat= '$kode_obat'";
    //     $pageQry	= mysql_query($myCek, $koneksidb) or die ("error paging: ".mysql_error());
    //     $cekAda 	= mysql_num_rows($pageQry);

    //     if ($cekAda > 0){

    //       $sqlAddObat = "UPDATE order_obat_item SET qty = qty+$qty , aturan_minum = '$aturan_minum' , status = $status WHERE no_order_obat = '$no_order_obat' AND (kode_obat = '$kode_obat' AND harga_obat = '0')";
    //       $dbAdd = mysql_query($sqlAddObat, $koneksidb) or die("Gagal query" . mysql_error());

    //     }else{

    //       $sqlAddObat = "INSERT INTO order_obat_item (no_order_obat, kode_obat, qty, aturan_minum, status) VALUES ('$no_order_obat','$kode_obat','$qty','$aturan_minum','$status')";
    //       $dbAdd = mysql_query($sqlAddObat, $koneksidb) or die("Gagal query" . mysql_error());

    //     }

    foreach ($_POST['id'] as $key => $value) {
      $id_task   = $_POST['id'][$key];
      $id_projek = $_POST['projek_id'][$key];
      $label     = $_POST['label'][$key];
      $hari      = $_POST['hari'][$key];
      $pre       = $_POST['pre'][$key];


        $myCek      = "SELECT * FROM task WHERE id_task ='$id_task' AND id_proyek= '$id_projek'";
        $pageQry	= mysqli_query($konek, $myCek) or die ("error paging: ".mysqli_error());
        $cekAda 	= mysqli_num_rows($pageQry);

        if($cekAda > 0){

            $sqlUpdate = "UPDATE task SET label = '$label' , hari = '$hari' , predescessor = '$pre' WHERE id_task = '$id_task' AND id_proyek= '$id_projek'";
            $dbAdd = mysqli_query($konek, $sqlUpdate) or die("Gagal query" . mysqli_error());

        } else {
            
            $sqlInsert  = "INSERT INTO task (id_task, id_proyek, label, hari, predescessor) VALUES ('$id_task','$id_projek','$label','$hari','$pre')";
            $dbAdd      = mysqli_query($konek, $sqlInsert) or die("Gagal query" . mysqli_error());
        }
    }
  }
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
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data" class="pure-form">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Nama Task</th>
                                            <th class="border-top-0">Label</th>
											<th class="border-top-0">Hari</th>
											<th class="border-top-0">Predesecor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($projects as $project):
										?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $project[4]; ?></td>
                                            <input type="text" value="<?= $project[1]; ?>" style="width:50%;" name="projek_id[]">
                                            <input type="text" value="<?= $project[0]; ?>" style="width:50%;" name="id[]">
                                            <td><input type="text" style="width:50%;" name="label[]"></td>
											<td><input type="text" style="width:50%;" name="hari[]"></td>
											<td><input type="text" style="width:50%;" name="pre[]"></td>
										</tr>
                                        <?php $no++; endforeach; ?>
										
                                    </tbody>
                                </table>
                                <button type="submit" name="AddTask" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Input</button>
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