<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

  if (isset($_POST['valide']) && isset($_POST['id'])){

	$id = $_POST['id'];
	$titre = $_POST["titre"];
    $note = $_POST["note"];

    $q1 = "UPDATE notes set titre = '$titre', note = '$note' WHERE id = '$id'";
    $conn->query($q1);

    header('Location: dashboard1.php');

}
