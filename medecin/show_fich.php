<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

if(isset($_POST["etu"]))
{
      $output='';
      
      $query = "SELECT * FROM fichiers WHERE id = ".$_POST["etu"]."";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result)){
        $n = $row["fich"];
        $c = $row["cin"];

        $output .= 
         	'<a href="repertoire/'.$c.'/'.$n.'" download="'.$n.'">
      		  <img src="repertoire/'.$c.'/'.$n.'" width="100%" alt="LST" >
      		</a>';

      }
  echo $output;
}
?>