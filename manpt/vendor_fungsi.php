<?php 
ob_start();
date_default_timezone_set('Asia/Jakarta');
include('koneksi.php');

if(isset($_POST['tambahVendor'])){

    $namaVendor = $_POST['nama_vendor'];
    $noTelepon  = $_POST['noTelp'];
    $alamat     = $_POST['alamat_vendor'];
    $pj         = $_POST['penanggung_jawab'];

    $sqlVendorAdd = "INSERT INTO vendor (nama_vendor,no_telpon,alamat,penanggung_jawab) VALUES ('$namaVendor', '$noTelepon', '$alamat', '$pj')";
    $addVendor    = mysqli_query($konek, $sqlVendorAdd);

    if($addVendor){
        header("location: vendor.php?pesan=".base64_encode("Data Berhasil Ditambah"));
    }
}
if(isset($_POST['editVendor'])){

    $namaVendoredit = $_POST['nama_vendor_edit'];
    $noTeleponedit  = $_POST['noTelp_edit'];
    $alamatedit     = $_POST['alamat_vendor_edit'];
    $pjedit         = $_POST['penanggung_jawab_edit'];
    $idvendoredit   = $_POST['id_vendor_edit'];

    $sqlVendorEdit = "UPDATE vendor SET nama_vendor='$namaVendoredit', no_telpon ='$noTeleponedit', alamat='$alamatedit', penanggung_jawab='$pjedit' WHERE id_vendor='$idvendoredit'";
    $editVendor    = mysqli_query($konek, $sqlVendorEdit);

    if($editVendor){
        header("location: vendor.php?pesan=".base64_encode("Data Berhasil Diedit"));
    }
    
}

if(isset($_GET['hapusVendor'])){
    $deleteVendor = $_GET['hapusVendor'];

    $sqlVendorDelete = "DELETE FROM vendor WHERE id_vendor = '$deleteVendor'";
    $editVendor    = mysqli_query($konek, $sqlVendorDelete);

    if($editVendor){
        header("location: vendor.php?pesan=".base64_encode("Data Berhasil Dihapus"));
    }
}
?>