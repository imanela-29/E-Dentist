<?php
session_start();
    $mail = $_SESSION["email"];
  include 'php/conn.php';

  if(isset($_GET["acte"])){
  	$a = $_GET["acte"];

		  $qu = "SELECT * FROM actes where nom = '$a'";
			$res = mysqli_query($conn,$qu);
			while($row = mysqli_fetch_assoc($res)){
				echo '
				<option value="'.$row["prix"].'">'.$row["prix"].'</option>';
			}
  }
?>  	