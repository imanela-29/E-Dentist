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
	$sql = "DELETE FROM fichiers WHERE id = '$id'";
	echo $sql;

		$query = "SELECT * FROM fichiers WHERE id = '$id'";
     	$result = mysqli_query($conn, $query);
      	while($row = mysqli_fetch_array($result)){
      	  $n = $row["fich"];
       	  $c = $row["cin"];

			unlink("repertoire/".$c."/".$n);

		}
	//confirmer: si oui executer ça
	$query = $conn->prepare( $sql );
	if( !$query->execute()){
		echo " not executed";
	}
	else{
		$quer = "SELECT * FROM patient WHERE cin = '$c'";
 		$resul = mysqli_query($conn, $quer);
  		while($roww = mysqli_fetch_array($resul)){
  			$p = $roww["id"];
			
			header('location:ajout.php?id='.$p.'');
		}	
	}
?>