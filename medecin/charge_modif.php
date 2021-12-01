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
	$query = "SELECT * FROM charge WHERE id = ".$_POST["etu"]."";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$output .= 
            '
            <form method="POST" action="update_charge.php">
              <input type="text" class="form-control" value="'.$row["id"].'" name="id_modif" hidden>
				    	<div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput1">Charge</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" value="'.$row["charge"].'" name="charge">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput2">Prix</label>
                  <input type="number" class="form-control" id="exampleFormControlInput2" value="'.$row["prix_charge"].'" name="prix">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput3">Date</label>
                  <input type="date" class="form-control" id="exampleFormControlInput3" value="'.$row["date_charge"].'" name="date">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput4">Situation</label>
                  <select class="form-control" id="exampleFormControlInput4" value="'.$row["situation"].'" name="situation">
                    <option value="" disabled selected>Choisissez</option>
                    <option value="Non payé" ' . (($row["situation"] == "Non payé" ) ? "selected"  : '') . '>Non payé</option>
                    <option value="Payé" ' . (($row["situation"] == "Payé" ) ? "selected"  : '') . '>Payé</option>
                  </select>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group col-lg-6">
                  <input type="submit" name="submit_modif" class="btn btn-sm btn-block btn-success" value="Enregister">
                </div>
                <div class="form-group col-lg-6">
                  <a role="button" class="btn btn-block btn-sm btn-danger" onclick="return checkDelete()" href="delcharge.php?id='.$row["id"].'">Supprimer
                  </a>
                </div>  
              </div>  
            </form>

';
  }
  echo $output;
}
?>

