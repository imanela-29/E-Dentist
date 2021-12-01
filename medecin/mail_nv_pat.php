<?php
	include 'php/conn.php';

	$qu4 = "SELECT * FROM admin WHERE statut = 'admin'";
	$res4 = mysqli_query($conn,$qu4);
	$resChe4 = mysqli_num_rows($res4);
	if($resChe4 > 0){
	  while($row4 = mysqli_fetch_assoc($res4)){
		$to = $row["email"];

		$message = 
			'<h3>Aujourd\'hui:</h3>'."\n".
			'<h4>Caisse:</h4>'."\n".
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
	              <div class="row">';
	                  $qu = "SELECT * FROM patient WHERE id = $dd";
	                  $res = mysqli_query($conn,$qu);
	                  $resChe = mysqli_num_rows($res);
	                  if($resChe > 0){
	                    while($row = mysqli_fetch_assoc($res)){
	                '<div class="col-4 text-center">
	                  <img src="repertoire/'.$row["cin"].'/'.$row["img"].'" alt="Photo de profil" class="img-fluid" style="width: 150px; height:150px;">
	                </div>
	                <div class="col-8">
	                  <div class="row">
	                    <div class="form-group col-lg-6">
	                      <label for="exampleFormControlInput1">Nom et Prénom</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput1" name="nom" value="'.$row["nom"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-2">
	                      <label for="exampleFormControlInput40">Age</label>';
	                      $d = $row["date_naissance"];
	                      $now = date("Y-m-d");
	                      $age = date_diff(date_create($d), date_create($now));
	                      echo '
	                     <input type="text" class="form-control" id="exampleFormControlInput40" name="age" value="'.$age->format('%y').' ans" readonly>
	                    </div>
	                    <div class="form-group col-lg-2">
	                      <label for="exampleFormControlInput4">Genre</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput4" name="mdp" value="'.$row["genre"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-2">
	                      <label for="exampleFormControlInput3">N° Dossier</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput3" name="email" value="'.$row["dossier"].'" readonly>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="form-group col-lg-6">
	                      <label for="exampleFormControlInput5">Profession</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput5" name="fonction" value="'.$row["fonction"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-6">
	                      <label for="exampleFormControlInput50">CIN</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput50" name="cin" value="'.$row["cin"].'" readonly>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-12">
	                  <div class="row">
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlInput65">Date de naissance</label>
	                      <input type="date" class="form-control" id="exampleFormControlInput65" name="date_naissance" value="'.$row["date_naissance"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlInput60">Adresse</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput60" name="adresse" value="'.$row["adresse"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlSelect1">Mutuelle/Assurance</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput10" name="mutuelle" value="'.$row["mutuelle"].'" readonly>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlInput7">Numéro de tel</label>
	                      <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput7" name="tel" value="'.$row["tel"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlInput775">Email</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput775" name="email" value="'.$row["email"].'" readonly>
	                    </div>
	                    <div class="form-group col-lg-4">
	                      <label for="exampleFormControlInput10">Commentaire</label>
	                      <input type="text" class="form-control" id="exampleFormControlInput10" name="comment" value="'.$row["comment"].'" readonly>
	                    </div> 
	                  </div>
	                </div>  
	              </div>  
	              <h6 class="heading-small text-muted mb--3 mt-4">Informations médicales</h6>
	              <hr class="my-4" />
	              <div class="row">
	                <div class="form-group col-lg-12">
	                  <label for="exampleFormControlInput130">Présentez-vous l\'une des maladies ?</label>
	                  <input type="text" class="form-control" id="exampleFormControlInput130" name="check" value="'.$row["maladies"].'" readonly>
	                </div>
	              </div>
	              <div class="row">
	                <div class="form-group col-lg-12">
	                  <label for="exampleFormControlInput111">Avez-vous déjà subi une intérvention chirurgicale récente ?</label>
	                  <input type="text" class="form-control" id="exampleFormControlInput111" name="chirurg" value="'.$row["chirurgie"].'" readonly>
	                </div>
	              </div>
	              <div class="row">
	                <div class="form-group col-lg-12">
	                  <label for="exampleFormControlInput111">Prenez-vous des médicaments régulièrement ?</label>
	                  <input type="text" class="form-control" id="exampleFormControlInput111" name="medicam_reg" value="'.$row["medicaments"].'" readonly>
	                </div>
	              </div>
	              <div class="row">
	                <div class="form-group col-lg-12">
	                  <label for="exampleFormControlInput111">Renseignements complémentaires</label>
	                  <input type="text" class="form-control" id="exampleFormControlInput111" name="renseignements" value="'.$row["renseignement"].'" readonly>
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

		$subject = 'Nouveau patient';

		mail($to, $subject, $message,$headers);

	  }
	}
?>
