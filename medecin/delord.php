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


		$que = "SELECT * FROM ordonnances WHERE date = '$id'";
 		$resu = mysqli_query($conn, $que);
  		while($row = mysqli_fetch_array($resu)){
  			$c = $row["cin"];

  			
	$sql = "DELETE FROM ordonnances WHERE date = '$id'";
	echo $sql;
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
	}
?>