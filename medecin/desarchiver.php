<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

	$id=$_GET['id'];
    echo $id;
    $d=date("Y-m-d");
	$sql = "UPDATE patient SET date_inscription = '$d' WHERE id = '$id'";
	echo $sql;
	//confirmer: si oui executer ça
	$query = $conn->prepare( $sql );
	if( !$query->execute()){
		echo " not executed";
	}
	else{
		header('location:patient_archivés.php');
	}
?>