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

  $query = "SELECT * FROM patient WHERE id = ".$_POST["etu"]."";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result)){
    $output .= 
            '
          <div class="row">
            <div class="col-4 text-center">
              <img src="repertoire/'.$row["cin"].'/'.$row["img"].'" alt="Photo de profil" class="img-fluid" style="width: 150px;">
            </div>
            <div class="col-8">
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput1">Nom et Prénom</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" value="'.$row["nom"].'" readonly name="nom">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput5">CIN</label>
                  <input type="text" class="form-control" id="exampleFormControlInput5" value="'.$row["cin"].'" readonly name="cin">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput5">Fonction</label>
                  <input type="text" class="form-control" id="exampleFormControlInput5" value="'.$row["fonction"].'" readonly name="fonction">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput7">Numéro de tel</label>
                  <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput7" value="'.$row["tel"].'" readonly name="tel">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput11">Prix</label>
                  <input type="text" class="form-control" id="exampleFormControlInput11" value="'.$row["prix"].'" readonly name="prix">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput300">Email</label>
                  <input type="text" class="form-control" id="exampleFormControlInput300" value="'.$row["email"].'" readonly name="email">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput100">Cas de maladie</label>
                  <input type="text" class="form-control" id="exampleFormControlInput100" readonly name="cas" value="'.$row["cas_maladie"].'">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput10">Commentaire</label>
                  <input type="text" class="form-control" id="exampleFormControlInput10" readonly name="comment" value="'.$row["comment"].'">
                </div>
              </div>
            </div>
              </div>
              <div class="row">
                <div class="form-group col-xl-3">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Modifier les info" class="btn btn-sm btn-block btn-outline-default" href="modifier.php?id='.$row['id'].'">
                    <i class="fas fa-edit"></i>  Modifier
                  </a>
                </div>
                <div class="form-group col-xl-3">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Archiver le patient" class="btn btn-sm btn-block btn-outline-success" href="archiver.php?id='.$row['id'].'">
                    <i class="fas fa-archive"></i>  Archiver
                  </a>
                </div>
                <div class="form-group col-xl-3">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Consultations" class="btn btn-block btn-sm btn-outline-primary" href="consultations.php?id='.$row['id'].'">
                    <i class="fas fa-file-medical-alt"></i> Consultation
                  </a>
                </div>
                <div class="form-group col-xl-3">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Ajouter fichier" class="btn btn-sm btn-block btn-outline-info" href="ajout.php?id='.$row['id'].'">
                    <i class="fas fa-file"></i>  Fichiers
                  </a>
                </div>
              </div>
          </div>

          ';

  }
  ?>


<?php
  echo $output;
}
?>
