<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
       
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nouveau Patient | Cabinet docteur</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
      <link rel="stylesheet" href="assets/css/style.css">

  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>



  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="..." >
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard1.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Accueil</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rdv.php">
                <i class="ni ni-bullet-list-67 text-purple"></i>
                <span class="nav-link-text">RDV</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="patient.php">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Patient</span>
              </a>
            </li>
            <?php
            $qu = "SELECT * FROM admin where email = '$mail' ";
            $res = mysqli_query($conn,$qu);
            $resChe = mysqli_num_rows($res);
            if($resChe > 0){
              while($row = mysqli_fetch_assoc($res)){
                if ($row["statut"] == 'admin'){
                echo '
                <li class="nav-item">
                  <a class="nav-link" href="caisse.php">
                    <i class="ni ni-money-coins text-danger"></i>
                    <span class="nav-link-text">Caisse</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="employe.php">
                    <i class="fas fa-user-friends text-default"></i>                    
                    <span class="nav-link-text">Personnel</span>
                  </a>
                </li>';
                }
              }
            }    
            ?>
          </ul>  
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
           <!--Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>          

          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="assets/img/theme/team-4.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">

                    <?php
                      $qu = "SELECT * FROM admin WHERE email = '$mail'";
                      $res = mysqli_query($conn,$qu);
                      $resChe = mysqli_num_rows($res);
                      if($resChe > 0){
                        while($row = mysqli_fetch_assoc($res)){
                          echo '<span class="mb-0 text-sm font-weight-bold">'.$row["nom"].' '.$row["prenom"].'</span>';
                        }
                      }
                    ?>

                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="dashboard1.php" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <!-- links -->
          </div>
          <!-- Card stats -->
          <div class="row" id="ref_card_patient">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total patient</h5>

                      <?php
                        $qu = "SELECT COUNT(id) as idd FROM patient ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["idd"].' patients</span>';
                          }
                        }
                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Depuis le debut</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total non payé</h5>

                      <?php

                      $quu = "SELECT SUM(paiement) as idd FROM consultation where date_c >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                      $ress = mysqli_query($conn,$quu);
                      echo mysqli_error($conn);
                      $resChes = mysqli_num_rows($ress);
                      if($resChes > 0){
                        while($roww = mysqli_fetch_assoc($ress)){
                          $p1 = $roww["idd"];

                          $quuu = "SELECT SUM(montant) as p2 FROM paiement where date >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                          $resss = mysqli_query($conn,$quuu);
                          echo mysqli_error($conn);
                          $resChess = mysqli_num_rows($resss);
                          if($resChess > 0){
                            while($rowww = mysqli_fetch_assoc($resss)){
                              $p2 = $rowww["p2"];
                              $p = $p1-$p2;
                              if ($p >= 0){
                                echo '<span class="h2 font-weight-bold mb-0">'.$p.' DHS</span>';
                              }
                              else{
                              echo '<span class="h2 font-weight-bold mb-0">0 DHS</span>';
                              }
                            }
                          }
                        }
                      }    
                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Depuis le debut</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total payé</h5>

                      <?php
                        $quuu = "SELECT SUM(montant) as t FROM paiement where date >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                        $resss = mysqli_query($conn,$quuu);
                        echo mysqli_error($conn);
                        $resChess = mysqli_num_rows($resss);
                        if($resChess > 0){
                          while($row = mysqli_fetch_assoc($resss)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["t"].' DHS</span>';
                          }
                        }
                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-money-check"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">le mois actuel</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total estimé</h5>

                      <?php
                        $quu = "SELECT SUM(paiement) as t FROM consultation where date_c >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                        $ress = mysqli_query($conn,$quu);
                        $resChes = mysqli_num_rows($ress);
                        if($resChes > 0){
                          while($row = mysqli_fetch_assoc($ress)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["t"].' DHS</span>';
                          }
                        }
                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">le mois actuel</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>


    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="mb-4">Ajouter un nouveau patient</h2>
                </div>
              </div>  
              <div class="card-body">
                <div class="wrapper">
                  <form action="enregistrer_nv_pat.php" id="wizard" method="POST" enctype="multipart/form-data">
                    <!-- SECTION 1 -->
                    <h4></h4>
                    <section>
                      <div class="row mt-4">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput5">Genre</label>
                          <div class="row">
                            <div class="custom-control custom-radio mb-3 ml-4">
                              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="Femme">
                              <label class="custom-control-label" for="customRadio1">Femme</label>
                            </div>
                            <div class="custom-control custom-radio ml-6">
                              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="Homme">
                              <label class="custom-control-label" for="customRadio2">Homme</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput80">Photo de profil</label>
                          <input type="file" class="form-control" id="exampleFormControlInput80" accept="image/*" name="image">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput605">Numéro Dossier</label>
                          <input type="text" class="form-control" id="exampleFormControlInput605" name="num_d">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput1">Nom et Prénom</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" name="nom" required>
                        </div>
                      </div>
                    </section>

                    <!-- SECTION 2 -->
                    <h4></h4>
                    <section>
                      <h3 class="mb-4"></h3>
                      <div class="row mt-4">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput55">CIN </label>
                          <input type="text" class="form-control" id="exampleFormControlInput55" name="cin">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput6">Adresse</label>
                          <input type="text" class="form-control" id="exampleFormControlInput6" name="adresse">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput7">Profession</label>
                          <input type="text" class="form-control" id="exampleFormControlInput7" name="fonction">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput775">Email</label>
                          <input type="text" class="form-control" id="exampleFormControlInput775" name="email">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput9">Numéro de tel</label>
                          <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput9" name="tel">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlSelect1">Mutuelle/Assurance</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="mutuelle">
                            <option value="" selected disabled>Choisissez</option>
                            <option value="Aucune">Aucune</option>
                            <?php
                            $qu = "SELECT * FROM mutuelles";
                            $res = mysqli_query($conn,$qu);
                            $resChe = mysqli_num_rows($res);
                            if($resChe > 0){
                              while($row = mysqli_fetch_assoc($res)){
                                echo '<option value="'.$row["nom"].'">'.$row["nom"].'</option>';
                              }
                            }
                            ?>  
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="dateNaissance">Date de naissance</label>
                          <input type="date" class="form-control" id="dateNaissance" name="date_naissance" oninput="calculerAge()" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="exampleFormControlInput65">Commentaire</label>
                          <input type="text" class="form-control" id="exampleFormControlInput65" name="comment">
                        </div>
                      </div>
                      <input type="text" class="form-control" id="ageComplet" name="age" hidden>
                    </section>

                    <!-- SECTION 3 -->
                    <h4></h4>
                    <section>
                      <div class="row mt-4">
                        <div class="form-group col-lg-12">
                          <label for="exampleFormControlInput130">Présentez-vous l'une des maladies ?</label>
                          <select multiple class="form-control" id="exampleFormControlSelect1" name="maladies[]">
                            <option value="" selected disabled>Choisissez</option>
                            <option value="Aucune">Aucune</option>
                            <?php
                            $qu = "SELECT * FROM maladies";
                            $res = mysqli_query($conn,$qu);
                            $resChe = mysqli_num_rows($res);
                            if($resChe > 0){
                              while($row = mysqli_fetch_assoc($res)){
                                echo '<option value="'.$row["nom"].'">'.$row["nom"].'</option>';
                              }
                            }
                            ?>  
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-12">
                          <label for="exampleFormControlInput111">Avez-vous déjà subi une intérvention chirurgicale récente ?</label>
                          <input type="text" class="form-control" id="exampleFormControlInput111" name="chirurg" placeholder="Oui, laquelle?">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-12">
                          <label for="exampleFormControlInput111">Prenez-vous des médicaments régulièrement ?</label>
                          <input type="text" class="form-control" id="exampleFormControlInput111" name="medicam_reg" placeholder="Oui, lesquels?">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-12">
                          <label for="exampleFormControlInput111">Renseignements complémentaires</label>
                          <input type="text" class="form-control" id="exampleFormControlInput111" name="renseignements" placeholder="Fumeur, Enceinte, allaitement, allergie, ...">
                        </div>
                      </div>
                    </section>

                    <!-- SECTION 4 -->
                    <h4></h4>
                    <section>
                      <div class="row mt-8">
                        <div class="form-group col-lg-4">
                        </div>
                        <div class="form-group col-lg-4">
                          <input type="submit" class="form-control btn btn-sm btn-info" name="valide" value="Confirmer l'ajout du patient">
                        </div>
                        <div class="form-group col-lg-4">
                        </div>
                      </div>
                    </section>
                  </form>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="#" class="font-weight-bold ml-1" target="_blank">Eva Factory</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Eva Factory</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Eva License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/select2/dist/js/select2.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/quill/dist/quill.min.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="assets/js/jquery.steps.js"></script>

  <script src="assets/js/main.js"></script>
  <!-- Optional JS -->
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>

  <script type="text/javascript"> 
    function calculerAge() {
      var td = new Date(); //date aujourd'hui
      var dtn = document.getElementById('dateNaissance').value;
      var an = dtn.substr(0,4); // l'année (les quatre premiers caractères de la chaîne à partir de 0 puisque la date est sous la forme yyyy-mm-dd)
      var mois = dtn.substr(5,2);// On selectionne le mois de la date de naissance
      var day =  dtn.substr(8,2); // On selectionne le jour de la date de naissance       
      var age = td.getFullYear()-an; // l'âge

      var nbrJours = td.getDate()-day; // On calcul  le mois de la date - le mois de la date de naissance
      var nbrMois = td.getMonth()+1; // On calcul le mois de la date de naissance(0-11)

      if(nbrJours < 0) // s'il est strictement inferieur a 0
      {
        nbrMois = nbrMois-1; // On enléve 1 du mois
        nbrJours = (td.getDate()+30)-day;
      }   
      
      var lesMois = nbrMois-mois; // On calcul  le mois de la date - le mois de la date de naissance   
      if(lesMois <=  0) // s'il est inferieur ou égal a 0
      {
        lesMois = (nbrMois+12)-mois;
        age = age-1; // On enléve 1 ans a l'age
      }  
      //Traitement de la date complet
      var dateComplet;
      if(nbrJours == 0 && lesMois == 0)
      {
        dateComplet = age+ ' ans ';
      }
      if(nbrJours == 0 && lesMois != 0)
      {
        dateComplet = age+ ' ans '+lesMois + ' mois ';
      }
      if(nbrJours != 0 && lesMois == 0)
      {
        dateComplet = age+ ' ans '+nbrJours+' jours ';
      }
      if(nbrJours != 0 && lesMois != 0)
      {
        dateComplet = age+ ' ans '+lesMois + ' mois '+nbrJours+' jours ';
      }
      if(nbrJours != 0 && lesMois == 12)
      {
      age = age+1;
        dateComplet = age+ ' ans '+nbrJours+' jours ';
      }
      if(nbrJours == 0 && lesMois == 12)
      {
      age = age+1;
        dateComplet = age+ ' ans ';
      }
      document.getElementById('ageComplet').value = dateComplet;
    }
  </script> 
  <script type="text/javascript">
    function checkDelete(){
      return confirm("Êtes-vous sûr(e) de vouloir supprimer ?")
    }
    //script pour désactiver touche clavier entrée du clavier sur tt la page
    (function(n) {
      var f = function(e) {
        var c = e.which || e.keyCode;
        if (c == 13) {
          e.preventDefault();
          return false;
        }
      };
      window.noPressEnter = function(a, b) {
        b = (typeof b === 'boolean') ? b : true;
        if (b) {
          a.addEventListener(n, f);
        } else {
          a.removeEventListener(n, f);
        }
        return a;
      };
    })('keydown');
    noPressEnter(document.body);

  </script>

</body>
</html>

<script>
  $(document).ready(
    function(){
      setInterval(function(){
        $(".refresh_patient_arch").load("refresh_patient_arch.php");
      },500);
    });

  $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_card_patient").load("ref_card_patient.php");
      },500);
    });

</script>