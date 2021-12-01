<?php
  session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
} 

include 'php/conn.php';

if( isset($_POST["valide"]) ){
    
    $date_inscription = date("Y-m-d");
    $nom = $_POST["nom"];
    $date_n = $_POST["date_naissance"];
    $cin = $_POST["cin"];
    $tel = $_POST["tel"];
    $age = $_POST["age"];
    $adresse = $_POST["adresse"];
    $fonction = $_POST["fonction"];
    $comment = $_POST["comment"];
    $email = $_POST["email"];
    $genre = $_POST["customRadio"];
    $num_d = $_POST["num_d"];
    $mutuelle = $_POST["mutuelle"];
    $maladies = $_POST["maladies"];
    $chirurg = $_POST["chirurg"];
    $medicam_reg = $_POST["medicam_reg"];
    $renseignements = $_POST["renseignements"];

    if(!is_dir($cin)){
      $target = "repertoire/".basename($cin);
      mkdir($target);
    }

    $t = [];
    foreach($maladies as $value) {
      $t[] = $value;
    }
    $f = $t;
    $m = implode(", ", $f);

    $image = $_FILES['image']['name']; //the actual name of the uploaded file
    // Get text
    $image_text = mysqli_real_escape_string($conn, $_POST['nom']);

    // image file directory
    $target = "repertoire/".$cin."/".basename($image);


    $q = "INSERT INTO patient VALUES (NULL, '$nom', '$cin', '$date_n', '$date_inscription', '$tel', '$adresse', '$fonction', '$comment', '$image', '$email', '$genre', '$num_d', '$mutuelle', '$m', '$chirurg', '$medicam_reg', '$renseignements')";
    $conn->query($q);


    $qu4 = "SELECT * FROM admin WHERE statut = 'admin'";
    $res4 = mysqli_query($conn,$qu4);
    $resChe4 = mysqli_num_rows($res4);
    if($resChe4 > 0){
      while($row4 = mysqli_fetch_assoc($res4)){
        $to1 = $row4["email"];

        $message = 
            '<html>
                <head>
                </head>
                <body>
                    
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col mb-0">
                      <label>La fiche du patient<label>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <h6 class="heading-small text-muted mb--3">Informations personnelles</h6>
                  <hr class="my-4" />
                  <div class="row">
                    <div class="col-4 text-center">
                      <img src="repertoire/'.$cin.'/'.$image.'" alt="Photo de profil" class="img-fluid" style="width: 150px; height:150px;">
                    </div>
                    <div class="col-8">
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput1">Nom et Prénom</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" name="nom" value="'.$nom.'" readonly>
                        </div>
                        <div class="form-group col-lg-2">
                          <label for="exampleFormControlInput40">Age</label>
                          <input type="text" class="form-control" id="exampleFormControlInput40" name="age" value="'.$age.'" readonly>
                        </div>
                        <div class="form-group col-lg-2">
                          <label for="exampleFormControlInput4">Genre</label>
                          <input type="text" class="form-control" id="exampleFormControlInput4" name="mdp" value="'.$genre.'" readonly>
                        </div>
                        <div class="form-group col-lg-2">
                          <label for="exampleFormControlInput3">N° Dossier</label>
                          <input type="text" class="form-control" id="exampleFormControlInput3" name="email" value="'.$num_d.'" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput5">Profession</label>
                          <input type="text" class="form-control" id="exampleFormControlInput5" name="fonction" value="'.$fonction.'" readonly>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput50">CIN</label>
                          <input type="text" class="form-control" id="exampleFormControlInput50" name="cin" value="'.$cin.'" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlInput65">Date de naissance</label>
                          <input type="date" class="form-control" id="exampleFormControlInput65" name="date_naissance" value="'.$date_n.'" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlInput60">Adresse</label>
                          <input type="text" class="form-control" id="exampleFormControlInput60" name="adresse" value="'.$adresse.'" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlSelect1">Mutuelle/Assurance</label>
                          <input type="text" class="form-control" id="exampleFormControlInput10" name="mutuelle" value="'.$mutuelle.'" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlInput7">Numéro de tel</label>
                          <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput7" name="tel" value="'.$tel.'" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlInput775">Email</label>
                          <input type="text" class="form-control" id="exampleFormControlInput775" name="email" value="'.$email.'" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="exampleFormControlInput10">Commentaire</label>
                          <input type="text" class="form-control" id="exampleFormControlInput10" name="comment" value="'.$comment.'" readonly>
                        </div> 
                      </div>
                    </div>  
                  </div>  
                  <h6 class="heading-small text-muted mb--3 mt-4">Informations médicales</h6>
                  <hr class="my-4" />
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleFormControlInput130">Présentez-vous l\'une des maladies ?</label>
                      <input type="text" class="form-control" id="exampleFormControlInput130" name="check" value="'.$m.'" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleFormControlInput111">Avez-vous déjà subi une intérvention chirurgicale récente ?</label>
                      <input type="text" class="form-control" id="exampleFormControlInput111" name="chirurg" value="'.$chirurg.'" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleFormControlInput111">Prenez-vous des médicaments régulièrement ?</label>
                      <input type="text" class="form-control" id="exampleFormControlInput111" name="medicam_reg" value="'.$medicam_reg.'" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleFormControlInput111">Renseignements complémentaires</label>
                      <input type="text" class="form-control" id="exampleFormControlInput111" name="renseignements" value="'.$renseignements.'" readonly>
                    </div>
                  </div>';
                }
              }
                '</div>
              </div>
            </div>
                </body>
            </html>'
            ;


        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: <no-reply@e-dentist.ma>' . "\r\n";
        //ini_set('SMTP','myserver');
        //ini_set('smtp_port',25);

        $subject1 = 'Nouveau patient';
        $subject1 = 'Bienvenue ' .$nom;


        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          $msg = "Image uploaded successfully";
        }else{
          $msg = "Failed to upload image";
        }

        if(mail($to1, $subject1, $message,$headers) && mail($email, $subject2, $message, $headers)){
            header('location:patient.php');
        }
        else{
            echo 'error';
        }


  }
?>