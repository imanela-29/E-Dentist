<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

  $date_actuelle = date('H:i:s');
	$d = date('20:15:00');
	if ($date_actuelle == $d){
		mail($to, $subject, $message,$headers);
	}

?>