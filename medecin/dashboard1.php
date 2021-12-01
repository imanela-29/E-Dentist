<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

    $qu1 = "SELECT CAST(start_event AS DATE) as d, COUNT(id) as idd FROM events where CAST(start_event AS DATE) >= DATE_FORMAT(NOW() ,'%Y-%m-01') group by CAST(start_event AS DATE)";
    $result1 = $conn->query($qu1);

     $json1 = [];
     $json2 = [];
      while ($row1 = $result1->fetch_assoc()) {
          $json1[] = $row1["d"];
          $json2[] = $row1['idd'];
              
      }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php
      $qu = "SELECT * FROM admin WHERE email = '$mail'";
      $res = mysqli_query($conn,$qu);
      $resChe = mysqli_num_rows($res);
      if($resChe > 0){
        while($row = mysqli_fetch_assoc($res)){
          echo 
             $row["nom"]." ". $row["prenom"].' | Cabinet docteur'
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
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.min.css?v=1.2.0" type="text/css">
  <style type="text/css">
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
  </style>
  <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
  <script type="text/javascript">
   
    var config2 = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($json1); ?>,
        datasets: [{
          label: 'Nbr',
          backgroundColor: window.chartColors.red,
          borderColor: window.chartColors.red,
          data: <?php echo json_encode($json2); ?> ,
          fill: false,
        }]
      },
      options: {
        responsive: true,
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: ''
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: ''
            }
          }]
        }
      }
    };


    window.onload = function() {
    
      var ctx = document.getElementById('mycanvas1').getContext('2d');
      window.myLine = new Chart(ctx, config2);
    };

  </script>
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
              <a class="nav-link active" href="dashboard1.php">
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
              <a class="nav-link " href="patient.php">
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
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                    <span class="mb-0 text-sm  font-weight-bold">
                      <?php
                        $qu = "SELECT * FROM admin WHERE email = '$mail'";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo $row["nom"]." ". $row["prenom"];
                          }
                        }
                      ?>
                    </span>
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
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(assets/img/theme/med.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Bonjour 
              <?php
                $qu = "SELECT * FROM admin WHERE email = '$mail'";
                $res = mysqli_query($conn,$qu);
                $resChe = mysqli_num_rows($res);
                if($resChe > 0){
                  while($row = mysqli_fetch_assoc($res)){
                    echo $row["nom"]." ". $row["prenom"];
                  }
                }
              ?>
            </h1>
            <p class="text-white mt-0 mb-5 ml-6">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-3 mt--6">
        </div>
        <div class="col-xl-3 mt--6">
        </div>
        <div class="col-xl-3 mt--6">
        </div>
        <div class="col-xl-3 mt--6 text-right">
          <a role="button" class="btn btn-icon btn-block btn-neutral edit_datai" href="show_info.php">Ajouter des infos</a>
        </div>
      </div>

      <div class="modal fade custom-modal bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="modal_edita" aria-hidden="true" id="modal_editadi">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
              
            <div class='modal-header'>
                <h4 class="modal-title">Plus d'informations</h4>
                <button type='button' class='close' data-dismiss='modal' style="color : #ff6600;">
                           <span aria-hidden='true'>&times;</span>
                            <span class='sr-only'>Fermer</span>
                </button>
            </div>
            <div class='modal-body' id="udpi">

            </div>
          </div>
      </div>
    </div>


      <div class="row">
        <div class="col-xl-12">
          <div class="row">
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total des patients</h5>

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
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-user-friends"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Depuis le debut</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nouveaux patients</h5>

                      <?php
                      $qu = "SELECT COUNT(id) as idd FROM patient WHERE date_inscription >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
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
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">le mois actuel</span>
                  </p>
                </div>
              </div>
            </div>  
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Caisse courante</h5>

                      <?php

                        $qu = "SELECT SUM(montant) as t FROM paiement WHERE date >= DATE_FORMAT(NOW() ,'%Y-%m-01') ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["t"].' DHS</span>';
                          }
                        }

                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">le mois actuel</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nombre des RDV</h5>

                      <?php

                        $qu = "SELECT COUNT(id) as idd FROM events WHERE CAST(start_event AS DATE) = CAST(NOW() AS DATE) ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["idd"].' rdv</span>';
                          }
                        }

                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                        <i class="ni ni-bell-55"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Aujourd'hui</span>
                  </p>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="text-uppercase mb-1"> Nombre des RDV</h4>
                  <h5 class=" mb-0">Graphe Par Mois </h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="card">
                <canvas id="mycanvas1" style="background-color: #fff;"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Notes </h5>
                </div>  
                <div class="col text-right">
                  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                </div>
              </div>

              <form method="POST" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-lg-12">
                            <input type="text" name="titre" class="form-control mb-2" placeholder="Titre"> 
                            <textarea class="form-control mb-2" rows="6" name="note" placeholder="Contenu"></textarea>
                            <input type="submit" class="form-control bt btn-block btn-sm btn-success" name="valide" value="Enregistrer">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Titre</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $qu = "SELECT * FROM notes ORDER by id desc limit 6";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                        <tr class="text-center">
                          <th scope="row">'.$row["id"].'</th>
                          <td>'.$row["titre"].'</td>
                          <td>
                            <a role="button" data-toggle="tooltip" data-placement="top" title="Voir" class="btn btn-icon btn-sm btn-outline-primary edit_dataa" href="#" name="edit" id="'.$row['id'].'"><i class="fas fa-eye"></i>
                            </a>
                          </td>
                        </tr>


                  <div class="modal fade custom-modal bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="modal_edita" aria-hidden="true" id="modal_editad">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            
                          <div class="modal-header">
                              <h4 class="modal-title">Plus d\'informations</h4>
                              <button type="button" class="close" data-dismiss="modal" style="color : #ff6600;">
                               <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Fermer</span>
                              </button>
                          </div>
                          <div class="modal-body" id="udp">

                          </div>
                        </div>
                    </div>
                  </div>
                        ';
                      }
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Liste des patients avec dossier incomplet</h3>
                </div>
              </div>
            </div>  
            <div class="table-responsive">
              <table id="tb" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">N° Dossier</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="">
                    <?php
                        $qu = "SELECT * FROM patient WHERE date_inscription <> '0000-00-00' and (cin = '' or email = '' or adresse = '' or tel = '' or genre = '' or date_naissance = '' or img = '' or mutuelle = '')  ORDER BY id DESC";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '
                              <tr class="text-center">
                                <td class="text-warning">'.$row["id"].'</td>
                                <td>'.$row["nom"].'</td>
                                <td>'.$row["dossier"].'</td>
                                <td>
                                  <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-success" href="fiche_patient.php?id='.$row['id'].'">
                                    <i class="fas fa-eye"></i>                 
                                  </a>
                                </td>
                              </tr>';
                          }    
                        }      
                    ?>  


                  <div class="modal fade custom-modal bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="modal_edita" aria-hidden="true" id="modal_editad">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            
                          <div class='modal-header'>
                              <h4 class="modal-title">Plus d'informations</h4>
                              <button type='button' class='close' data-dismiss='modal' style="color : #ff6600;">
                               <span aria-hidden='true'>&times;</span>
                                <span class='sr-only'>Fermer</span>
                              </button>
                          </div>
                          <div class='modal-body' id="udp">

                          </div>
                        </div>
                    </div>
                  </div>

                </tbody>
              </table>
            </div> 
          </div>       
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Liste des patients d'aujourd'hui</h3>
                </div>
              </div>
            </div>  
            <div class="table-responsive">
              <table id="tb" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="">
                    <?php
                        $qu = "SELECT title, id, CAST(start_event AS TIME) as t FROM events WHERE CAST(start_event AS DATE) = CAST(NOW() AS DATE) order by t";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            $n = $row["title"];
                            $quu = "SELECT * from patient where nom = '$n'";
                            $resu = mysqli_query($conn,$quu);
                            $resCheu = mysqli_num_rows($resu);
                            if($resCheu > 0){
                              while($roww = mysqli_fetch_assoc($resu)){
                            echo '
                              <tr class="text-center">
                                <td class="text-info">'.$roww["id"].'</td>
                                <td>'.$row["title"].'</td>
                                <td>'.$row["t"].'</td>
                                <td>
                                  <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-success" href="fiche_patient.php?id='.$roww['id'].'">
                                    <i class="fas fa-eye"></i>                 
                                  </a>
                                </td>
                              </tr>';
                            }
                          }  

                          }    
                        }      
                    ?> 
                </tbody>
              </table>
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.min.js?v=1.2.0"></script>

  <script type="text/javascript">
    function checkDelete(){
    return confirm("Êtes-vous sûr(e) de vouloir supprimer ?"); 
    }
    
  </script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('click', '.edit_dataa', function(){
    var etu = $(this).attr("id");
    $.ajax({
     url:"show_note.php",
     method:"POST",
     data:{etu:etu},
     success:function(data){
      $('#udp').html(data);
      $('#modal_editad').modal('show');
     }
    });
   });
  });

    $(document).ready(function(){

   $(document).on('click', '.edit_datai', function(){
    var etu = $(this).attr("id");
    $.ajax({
     url:"show_info.php",
     method:"POST",
     data:{etu:etu},
     success:function(data){
      $('#udpi').html(data);
      $('#modal_editadi').modal('show');
     }
    });
   });
  });

  
</script>

<?php
if( isset($_POST["valide"]) ){
    
    $t = $_POST["titre"];
    $nom = $_POST["note"];

    $q = "INSERT INTO notes VALUES (NULL, '$t', '$nom')";
    $conn->query($q);

    ?>
    <script type="text/javascript">
      window.location = "dashboard1.php";
    </script>
    <?php

}    
?>