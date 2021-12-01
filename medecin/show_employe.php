<?php
session_start();
    $mail = $_SESSION["email"];
  include 'php/conn.php';

if(isset($_POST["etu"]))
{
  $output='';
  $query = "SELECT * FROM employe WHERE id = ".$_POST["etu"]."";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result)){
    $output .= 
            '
          <div class="row">
            <div class="col-4 text-center">
              <img src="photo_employe/'.$row["img"].'" alt="Photo de profil" class="img-fluid rounded shadow-lg " style="width: 150px;">
            </div>
            <div class="col-8">
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput1">Nom et Prénom</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" value="'.$row["nom"].'" readonly name="nom">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput5">CIN / CNE</label>
                  <input type="text" class="form-control" id="exampleFormControlInput5" value="'.$row["cin"].'" readonly name="cin">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput6">Adresse</label>
                  <input type="text" class="form-control" id="exampleFormControlInput6" value="'.$row["adresse"].'" readonly name="adresse">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput50">Compte Bancaire</label>
                  <input type="text" class="form-control" id="exampleFormControlInput50" value="'.$row["CB"].'" readonly name="cb">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput3">Email</label>
                  <input type="text" class="form-control" id="exampleFormControlInput3" value="'.$row["email"].'" readonly name="email">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput7">Numéro de tel</label>
                  <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput7" value="'.$row["tel"].'" readonly name="tel">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput61">Paiement</label>
                  <input type="text" class="form-control" id="exampleFormControlInput61" value="'.$row["prix"].'" readonly name="prix">
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleFormControlInput610">Poste</label>
                  <input type="text" class="form-control" id="exampleFormControlInput610" value="'.$row["poste"].'" readonly name="poste">
                </div>
              </div>  
              <div class="row">
                <div class="form-group col-xl-6">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Modifier" class="btn btn-block btn-sm btn-outline-default" href="modifier_employe.php?id='.$row['id'].'">
                    <i class="fa fa-edit"></i>  Modifier
                  </a>
                </div>
                <div class="form-group col-xl-6">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer" class="btn btn-block btn-sm btn-outline-danger" onclick="return checkDelete()" href="delemploye.php?id='.$row["id"].'">
                    <i class="fas fa-trash-alt"></i>  Supprimer
                  </a>
                </div>
            </div>
          </div>
        </div>    
              ';

              ?>

<?php

  }
  echo $output;
}



?>
