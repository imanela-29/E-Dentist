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
	$sql = "DELETE FROM patient WHERE id = '$id'";
	echo $sql;

	$quer = "SELECT * FROM patient WHERE id = '$id'";
	$resul = mysqli_query($conn, $quer);
	while($roww = mysqli_fetch_array($resul)){
		$c = $roww["cin"];
		$n = $roww["nom"];

		$que = "SELECT * FROM fichiers WHERE cin = '$c' and nom = '$n'";
     	$result = mysqli_query($conn, $que);
      	while($row = mysqli_fetch_array($result)){
      	  $n = $row["fich"];
			unlink("repertoire/".$c."/".$n);
      	}

      	$quee = "SELECT * FROM patient WHERE cin = '$c' and nom = '$n'";
     	$resultt = mysqli_query($conn, $quee);
      	while($rowww = mysqli_fetch_array($resultt)){
      	  $i = $rowww["img"];
			unlink("repertoire/".$c."/".$i);
      	}
	}
	rmdir("repertoire/".$c);
	
	//confirmer: si oui executer ça
	$query = $conn->prepare( $sql );
	if( !$query->execute()){
		echo " not executed";
	}
	else{
		header('location:patient.php');
	}
?>