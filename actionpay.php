<?php 
include('config1.php');

if(isset($_POST['paymentid'])){
    $pymnt_id=$_POST['paymentid'];
    $amt=$_POST['amount'];
    $id=$_POST['name'];
    
	$today = date("Y-m-d");
    $payment_status="completed";
    
    mysqli_query($con,"INSERT INTO tbl_regpayment(lid,amount,pay_id,status,date)VALUES('$id','$amt','$pymnt_id','$payment_status','$today')");
    
    
}