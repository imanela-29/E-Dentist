<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
    $datee = date("Y-m-d");
 	include 'php/conn.php';

  if( isset($_POST["submit_modif"]) ){

    $c = $_POST["charge"];
    $p = $_POST["prix"];
    $d = $_POST["date"];
    $s = $_POST["situation"];

    $q = "UPDATE charge set charge = '$c', prix_charge = '$p', date_charge = '$d', situation = '$s'";
    $conn->query($q);
   
    header('location:graphe_charge_m.php');
  }

?> 	