<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
       
     $stmt = "SELECT date_charge, SUM(prix_charge) as total FROM charge WHERE date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01') GROUP BY date_charge";
     $result = $conn->query($stmt);
     $json1 = [];
     $json2 = [];
      while ($row = $result->fetch_assoc()) {     
        $json1[] = $row["date_charge"];
        $json2[] = $row['total'];     
      }
?>

 <?php  
  if( isset($_POST["submit"]) ){

    $c = $_POST["charge"];
    $p = $_POST["prix"];
    $d = $_POST["date_cha"];
    $s = $_POST["situation"];

    $q = "INSERT INTO charge VALUES (NULL, '$c', '$p', '$d', '$s')";
    $conn->query($q);
   
    header('location:graphe_charge_m.php');
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Graphe charge /mois | Cabinet docteur</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <style type="text/css">
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
  </style>


  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
  <script type="text/javascript">
   
    var config2 = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($json1); ?>,
        datasets: [{
          label: 'Charge',
          backgroundColor: window.chartColors.red,
          borderColor: window.chartColors.red,
          data: <?php echo json_encode($json2); ?> ,
          fill: false,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Graphe Charge'
        },
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
                  <a class="nav-link active" href="caisse.php">
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
          <div class="row" id="refresh_card_caisse">
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
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
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
                      <h5 class="card-title text-uppercase text-muted mb-0">total Charges non payées</h5>
                      
                      <?php

                        $qu = "SELECT SUM(prix_charge) as prix FROM charge WHERE situation = 'Non payé' AND (date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01')) ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["prix"].' DHS</span>';
                          }
                        }

                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
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
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">total Charges payées</h5>
                      
                      <?php

                        $qu = "SELECT SUM(prix_charge) as prix FROM charge WHERE situation = 'Payé' AND (date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01')) ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["prix"].' DHS</span>';
                          }
                        }

                      ?>

                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
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
            <div class="col-xl-3 col-md-3">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Bénefices du mois</h5>

                      <?php
                        $qu1 = "SELECT SUM(montant) as prix1 FROM paiement WHERE date >= DATE_FORMAT(NOW() ,'%Y-%m-01') ";
                        $qu2 = "SELECT SUM(prix_charge) as prix2 FROM charge WHERE (date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01')) ";

                        $res1 = mysqli_query($conn,$qu1);
                        $res2 = mysqli_query($conn,$qu2);
                        
                        $resChe1 = mysqli_num_rows($res1);
                        $resChe2 = mysqli_num_rows($res2);
                        
                        if($resChe1 > 0){
                          if($resChe2 > 0){
                            while($row1 = mysqli_fetch_assoc($res1)){
                              while($row2 = mysqli_fetch_assoc($res2)){
                                  echo '<span class="h2 font-weight-bold mb-0"> ' . ($row1["prix1"] - $row2["prix2"]) .' DHS </span>';
                              }
                            }
                          }
                        }
                      ?>


                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
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
                  <h3 class="mb-0">Liste des charges</h3>
                </div>
                <div class="col text-right">
                  <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#exampleModal">Ajouter</button>
                </div>
                <!-- Début Modal d'ajout -->
                <form method="POST" enctype="multipart/form-data">
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ajouter une charge</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-lg-6">
                              <label for="exampleFormControlInput1">Nom de la charge</label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" name="charge" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="exampleFormControlInput2">Prix de la charge</label>
                              <input type="number" step="any" class="form-control" id="exampleFormControlInput2" name="prix" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-6">
                              <label for="exampleFormControlInput3">Date de la charge</label>
                              <input type="date" class="form-control" id="exampleFormControlInput3" name="date_cha" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="exampleFormControlInput4">Situation</label>
                              <select class="form-control" id="exampleFormControlInput4" name="situation" required>
                                <option value="">Choisissez</option>
                                <option value="Non payé">Non payé</option>
                                <option value="Payé">Payé</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input class="btn btn-success" type="submit" name="submit" value="Enregister">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- Fin modal d'ajout -->
              </div>
            </div>
            <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="dt-buttons btn-group flex-wrap"> 
              </div>

              <table class="table table-flush dataTable" id="datatable-buttons" role="grid">
                <thead class="thead-light">
                  <tr role="" class="text-center">
                    <th scope="col">Charge</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Situation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="">

                  <?php
                    $qu = "SELECT * FROM charge WHERE date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01') ORDER BY id DESC";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                        <tr class="text-center">
                          <td>'.$row["charge"].'</td>
                          <td>'.$row["date_charge"].'</td>
                          <td class="text-danger">'.$row["prix_charge"].'</td>';

                          if ( $row["situation"] == 'Non payé' ){
                            echo '
                              <td class="text-warning">'.$row["situation"].'</td>
                              <td>
                              <a role="button" data-placement="top" data-toggle="tooltip" title="Modifier" class="btn btn-sm btn-outline-primary edit_charge" href="#" name="edit" id="'.$row["id"].'">
                                <i class="fas fa-edit"></i>
                              </a>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Valider" class="btn btn-icon btn-sm btn-outline-success" href="valcharge.php?id='.$row["id"].'">
                                  <i class="fas fa-check"></i>
                                </a>
                              </td>
                            ';
                          }
                          elseif ( $row["situation"] == 'Payé' ){
                            echo '
                            <td class="text-success">'.$row["situation"].'</td>
                            <td>
                              <a role="button" data-placement="top" data-toggle="tooltip" title="Modifier" class="btn btn-sm btn-outline-primary edit_charge" href="#" name="edit" id="'.$row["id"].'">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            ';
                          }
                          elseif ( $row["situation"] == '' ){
                            echo '
                            <td class="text-success">Aucune opération</td>
                            <td>
                              <a role="button" data-placement="top" data-toggle="tooltip" title="Modifier" class="btn btn-sm btn-outline-primary edit_charge" href="#" name="edit" id="'.$row["id"].'">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a role="button" data-toggle="tooltip" data-placement="top" title="Valider" class="btn btn-icon btn-sm btn-outline-success" href="valcharge.php?id='.$row["id"].'">
                                <i class="fas fa-check"></i>
                              </a>
                            </td>
                            ';
                          }
                          echo'</tr>';
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
      </div>
      <div class="row"> 
        <div class="col-xl-12">
          <div class="card" id="">
            <canvas id="mycanvas1" style="background-color: #fff;"></canvas>
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
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script type="text/javascript">
    function checkDelete(){
      return confirm("Êtes-vous sûr(e) de vouloir supprimer ?")
    }
  </script>
</body>

</html>

<script>

$(document).ready(
    function(){
      setInterval(function(){
        $("#refresh_card_caisse").load("refresh_card_caisse.php");
      },1000);
    });

$(document).ready(function(){

   $(document).on('click', '.edit_charge', function(){
    var etu = $(this).attr("id");
    $.ajax({
     url:"charge_modif.php",
     method:"POST",
     data:{etu:etu},
     success:function(data){
      $('#udp').html(data);
      $('#modal_editad').modal('show');
     }
    });
   });
  });
  </script>

 