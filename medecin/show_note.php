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

  $query = "SELECT * FROM notes WHERE id = ".$_POST["etu"]."";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result)){
    $output .= 
            '
            <form method="post" action="editNote.php">
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput7">Titre</label>
                  <input type="text" class="form-control" id="exampleFormControlInput7" value="'.$row["titre"].'" name="titre" >
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput100">Note</label>
                  <textarea rows="6" class="form-control col-lg-12" name="note" >'.$row["note"].'</textarea>
                </div>
              </div>
              <div class="row mt-4">
                <div class="form-group col-xl-6">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer" class="btn btn-block btn-outline-danger" href="delnote.php?id='.$row["id"].'">  Supprimer
                  </a>
                </div>
                <div class="form-group col-xl-6">
                  <input type="submit" class="form-control bt btn-block btn-sm btn-outline-success" name="valide" value="Enregistrer">
                </div>
                <input type="hidden" name="id" class="form-control" id="id" value="'.$row["id"].'">
              </div>
            </form>  
          ';

  }
  ?>


<?php
  echo $output;
}
?>

