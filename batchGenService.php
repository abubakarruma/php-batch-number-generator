<?php
session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');
$productId = $_POST['productId'];
$batchDesc = $_POST['batchDesc'];
$query = mysqli_query($con, "SELECT * from batch") or die(mysqli_error($con));
$count = mysqli_num_rows($query);
$date = date("dmy");

$batch_code = "-B".$count+1;

$code = $date.'-' .$productId.$batch_code;
$query1 = mysqli_query($con, "INSERT INTO batch (batchNo, batchDesc, batchCreatedDate, batchCreatedBy) values('$code', '$batchDesc', NOW(), '$id')") or die(mysqli_error($con));
if(mysqli_affected_rows($con)>0){
		$data['response'] = 1;
		$data['msg'] = 'Batch '.$code.' Successfully Generated';
		
	}
	echo json_encode($data);

?>
