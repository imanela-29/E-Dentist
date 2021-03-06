<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
  $dd = $_GET["id"];
  
  

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php
      $qu = "SELECT * FROM patient WHERE id = $dd";
      $res = mysqli_query($conn,$qu);
      $resChe = mysqli_num_rows($res);
      if($resChe > 0){
        while($row = mysqli_fetch_assoc($res)){
          echo 
            'Profil : ' . $row["nom"].' | Cabinet docteur'
          ;
        }
      }
    ?>
  </title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
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
         
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="patient.php">Liste patients</a></li>
              <li class="breadcrumb-item"><a href="fiche_patient.php?id=<?php echo $dd;?>">Fiche patient</a></li>
              <li class="breadcrumb-item active" aria-current="page">Modifier fiche</li>
            </ol>
          </nav>

          <!-- Navbar links -->
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total non pay??</h5>

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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total pay??</h5>

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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total estim??</h5>

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


                  <?php
                    $qu = "SELECT * FROM patient WHERE id = $dd";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                          <label>Modifer le profil : <span class="h3">'.$row["nom"].'</span><label>
                        ';
                      }
                    }
                  ?>

                </div>
                <?php
                  $qu = "SELECT * FROM patient WHERE id = $dd";
                  $res = mysqli_query($conn,$qu);
                  $resChe = mysqli_num_rows($res);
                  if($resChe > 0){
                    while($row = mysqli_fetch_assoc($res)){
                      echo '
                <div class="col text-right">
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Modifier photo" class="btn btn-sm btn-outline-default" href="ajout_photo.php?id='.$dd.'"><i class="fas fa-image"></i>
                  </a>
                  <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer le patient" class="btn btn-sm btn-outline-danger" href="deluser.php?id='.$row["id"].'" onclick="return checkDelete()"><i class="far fa-trash-alt"></i>
                  </a>
                </div>  
              </div>
            </div>
            <form method="POST" enctype="multipart/form-data">
            <div class="card-body">
              <h6 class="heading-small text-muted mb--3">Informations personnelles</h6>
              <hr class="my-4" />
              <div class="row">
                <div class="col-4 text-center">
                  <img src="repertoire/'.$row["cin"].'/'.$row["img"].'" alt="Photo de profil" class="img-fluid" style="width: 150px;">
                </div>
                <div class="col-8">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleFormControlInput1">Nom et Pr??nom</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" name="nom" value="'.$row["nom"].'">
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleFormControlInput40">Age</label>';
                      $d = $row["date_naissance"];
                      $now = date("Y-m-d");
                      $age = date_diff(date_create($d), date_create($now));
                      echo '
                     <input type="text" class="form-control" id="exampleFormControlInput40" name="age" value="'.$age->format('%y').' ans">
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleFormControlInput4">Genre</label>
                      <input type="text" class="form-control" id="exampleFormControlInput4" name="genre" value="'.$row["genre"].'">
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleFormControlInput3">N?? Dossier</label>
                      <input type="text" class="form-control" id="exampleFormControlInput3" name="num_d" value="'.$row["dossier"].'">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleFormControlInput5">Profession</label>
                      <input type="text" class="form-control" id="exampleFormControlInput5" name="fonction" value="'.$row["fonction"].'">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleFormControlInput50">CIN</label>
                      <input type="text" class="form-control" id="exampleFormControlInput50" name="cin" value="'.$row["cin"].'">
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlInput65">Date de naissance</label>
                      <input type="date" class="form-control" id="exampleFormControlInput65" name="date_naissance" value="'.$row["date_naissance"].'" >
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlInput60">Adresse</label>
                      <input type="text" class="form-control" id="exampleFormControlInput60" name="adresse" value="'.$row["adresse"].'" >
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlSelect1">Mutuelle/Assurance</label>
                      <input type="text" class="form-control" id="exampleFormControlInput10" name="mutuelle" value="'.$row["mutuelle"].'" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlInput7">Num??ro de tel</label>
                      <input type="tel" maxlength="10" class="form-control" id="exampleFormControlInput7" name="tel" value="'.$row["tel"].'" >
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlInput775">Email</label>
                      <input type="text" class="form-control" id="exampleFormControlInput775" name="email" value="'.$row["email"].'" >
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleFormControlInput10">Commentaire</label>
                      <input type="text" class="form-control" id="exampleFormControlInput10" name="comment" value="'.$row["comment"].'" >
                    </div> 
                  </div>
                </div> 
              </div>  
              <h6 class="heading-small text-muted mb--3 mt-4">Informations m??dicales</h6>
              <hr class="my-4" />
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput130">Pr??sentez-vous l\'une des maladies ?</label>
                  <input type="text" class="form-control" id="exampleFormControlInput130" name="check" value="'.$row["maladies"].'">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput111">Avez-vous d??j?? subi une int??rvention chirurgicale r??cente ?</label>
                  <input type="text" class="form-control" id="exampleFormControlInput111" name="chirurg" value="'.$row["chirurgie"].'">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput111">Prenez-vous des m??dicaments r??guli??rement ?</label>
                  <input type="text" class="form-control" id="exampleFormControlInput111" name="medicam_reg" value="'.$row["medicaments"].'">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-12">
                  <label for="exampleFormControlInput111">Renseignements compl??mentaires</label>
                  <input type="text" class="form-control" id="exampleFormControlInput111" name="renseignements" value="'.$row["renseignement"].'">
                </div>
              </div>
              <div class="row">                            
                <div class="form-group col-lg-12">
                  <input type="submit" class="form-control bt btn-block btn-sm btn-success" name="enregistrer" value="Enregistrer">
                </div>
              </div>';
            }
          }
          ?>
            </div> 
            </form>
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>

  <script type="text/javascript">
    function checkDelete(){
    return confirm("??tes-vous s??r(e) de vouloir supprimer ?"); 
    }
    
  </script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_card_patient").load("ref_card_patient.php");
      },500);
    });
</script>

<?php

  if( isset($_POST["enregistrer"]) ){

    $nom = $_POST["nom"];
    $date_naissance = $_POST["date_naissance"];
    $cin = $_POST["cin"];
    $tel = $_POST["tel"];
    $adresse = $_POST["adresse"];
    $fonction = $_POST["fonction"];
    $comment = $_POST["comment"];
    $email = $_POST["email"];
    $genre = $_POST["genre"];
    $num_d = $_POST["num_d"];
    $mutuelle = $_POST["mutuelle"];
    $maladies = $_POST["check"];
    $chirurg = $_POST["chirurg"];
    $medicam_reg = $_POST["medicam_reg"];
    $renseignements = $_POST["renseignements"];

    $a = "UPDATE patient SET nom = '$nom', cin = '$cin', adresse = '$adresse', tel = '$tel', fonction = '$fonction', comment = '$comment', genre = '$genre', date_naissance = '$date_naissance', email = '$email', dossier = '$num_d', mutuelle = '$mutuelle', maladies = '$maladies', chirurgie = '$chirurg', medicaments = '$medicam_reg', renseignement = '$renseignements' WHERE id = $dd ";
    $conn->query($a);
  
?>

    <script type="text/javascript">
      window.location = "fiche_patient.php?id=<?php echo $dd; ?>";
    </script>
<?php
  }
?>