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

<body onload="upd()">
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
            <li class="breadcrumb-item active" aria-current="page">Régler paiement</li>
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

   
    </script>
    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col-xl-8">
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
                        $n = $row["nom"];
                        $ci = $row["cin"];
                        echo '
                          <h3>Régler le paiement du patient:  <span class="text-muted">'.$n.'</span> <h3>
                        ';
                    echo '
                </div>
                <div class="col text-right">
                  
                  <button type="button" class="btn btn-default btn-sm mt-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                </div>';


              $qu = "SELECT SUM(prix_charge) as prix FROM charge WHERE situation = 'Non payé' AND (date_charge >= DATE_FORMAT(NOW() ,'%Y-%m-01')) ";
              $res = mysqli_query($conn,$qu);
              $resChe = mysqli_num_rows($res);
              if($resChe > 0){
                while($row1 = mysqli_fetch_assoc($res)){
                  echo '<input type="text" value="'.$row1["prix"].'" id="charge" name="charge" hidden>';
                }
              }
              $qu = "SELECT SUM(montant) as t FROM paiement WHERE date>= DATE_FORMAT(NOW() ,'%Y-%m-01') ";
              $res = mysqli_query($conn,$qu);
              $resChe = mysqli_num_rows($res);
              if($resChe > 0){
                while($row2 = mysqli_fetch_assoc($res)){
                  echo '<input type="text" value="'.$row2["t"].'" id="ca" name="ca" hidden>';
                }
              }
              echo '
                <form method="POST" enctype="multipart/form-data" action="enregistrer_nv_paiement.php">
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ajouter un paiement </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <input type="text" value="" id="ben" name="ben" hidden>
                            <input type="text" value="'.$dd.'" id="dd" name="dd" hidden>
                            <div class="form-group col-xl-6">
                              <label for="exampleFormControlInput1">Nom</label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" name="nom" value="'.$row["nom"].'" readonly>
                            </div>
                            <div class="form-group col-xl-6">
                              <label for="exampleFormControlInput2">CIN</label>
                              <input type="text" class="form-control" id="exampleFormControlInput2" name="cin" value="'.$row["cin"].'" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-xl-4"> 
                              <label for="exampleFormControlInput3">Date de paiement</label> 
                              <input type="date" class="form-control" id="exampleFormControlInput3" name="date" required>
                            </div>
                            <div class="form-group col-xl-4">
                              <label for="prix_ins">Montant</label>
                              <input type="number" class="form-control" id="prix_ins" name="paiement" oninput="upd()">
                            </div>
                            <div class="form-group col-xl-4">
                              <label for="mode_paiement">Type de paiement</label>
                              <select class="form-control" name="mode_paiement" >
                                <option value="" selected disabled>Choisissez</option>
                                <option value="Chèque">Chèque</option>
                                <option value="Espèce">Espèce</option>
                                <option value="Virement">Virement</option>
                                <option value="Carte">Carte</option>
                              </select>
                            </div>
                          </div>  
                          <div class="row">
                            <div class="form-group col-xl-12">
                              <label for="exampleFormControlInput5">Commentaire</label>
                              <textarea rows="3" class="form-control" id="exampleFormControlInput5" name="description"></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-12">
                              <input type="submit" class="form-control bt btn-block btn-sm btn-success" name="valide" value="Enregistrer">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>';
            echo '
              <div class="card-body">
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th scope="col">Date</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Type</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="ref_infop">';
                        $quu = "SELECT * FROM paiement WHERE nom = '$n' order by id desc";
                        $ress = mysqli_query($conn,$quu);
                        echo mysqli_error($conn);
                        $resChee = mysqli_num_rows($ress);
                        if($resChee > 0){
                          while($roww = mysqli_fetch_assoc($ress)){
                            echo '
                            <tr class="text-center">
                              <td>'.$roww["date"].'</td>';
                              if ($roww["montant"] != ''){
                                echo '<td class="text-primary">'.$roww["montant"].'</td>';
                              }
                              else {
                                echo '<td>'.$roww["montant"].'</td>';
                              }
                            echo '
                              <td>'.$roww["type"].'</td>
                              <td>'.$roww["comment"].'</td>
                              <td>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Modifier" class="btn btn-sm btn-secondary" href="modifier_p.php?id='.$roww['id'].'">
                                  <i class="fas fa-edit"></i>
                                </a>
                              </td>
                            </tr>';
                            }
                          }
                        }
                      }
                      echo '
                    </tbody>
                  </table>
                </div>
              </div>';
            ?>
          </div>
        </div>

        <div class="col-xl-4" id="">
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
                        <h4>Etat de paiement du patient: &nbsp;<b class="text-uppercase">'.$row["nom"].'</b></h4>';
                      }
                    }
                  ?>
                </div>  
              </div>
            </div>
            <div class="card-body" id="ref_infop2">


                  <?php
                  $quu = "SELECT SUM(paiement) as idd FROM consultation WHERE nom = '$n'";
                  $ress = mysqli_query($conn,$quu);
                  echo mysqli_error($conn);
                  $resChes = mysqli_num_rows($ress);
                  if($resChes > 0){
                    while($roww = mysqli_fetch_assoc($ress)){
                      $quuu = "SELECT SUM(montant) as idd FROM paiement WHERE nom = '$n'";
                      $resss = mysqli_query($conn,$quuu);
                      echo mysqli_error($conn);
                      $resChess = mysqli_num_rows($resss);
                      if($resChess > 0){
                        while($rowww = mysqli_fetch_assoc($resss)){
                          $estime = $roww["idd"];
                          $paye = $rowww["idd"];
                  ?>
                          
              <div class="progress-wrapper">
                <div class="progress-info" id="">
                  <div class="progress-label">
                    <span>Progression</span>
                  </div>
                  <div class="progress-percentage">
                    <?php
                    if($paye == ''){
                      echo '<span>0%</span>';
                    }
                    else if($paye <= ((10*$estime)/100)){
                      echo '<span>10%</span>';
                    }
                    else if($paye <= ((20*$estime)/100)){
                      echo '<span>20%</span>';
                    } 
                    else if($paye <= ((30*$estime)/100)){
                      echo '<span>30%</span>';
                    } 
                    else if($paye <= ((40*$estime)/100)){
                      echo '<span>40%</span>';
                    } 
                    else if($paye <= ((50*$estime)/100)){
                      echo '<span>50%</span>';
                    } 
                    else if($paye <= ((60*$estime)/100)){
                      echo '<span>60%</span>';
                    } 
                    else if($paye <= ((70*$estime)/100)){
                      echo '<span>70%</span>';
                    } 
                    else if($paye <= ((80*$estime)/100)){
                      echo '<span>80%</span>';
                    } 
                    else if($paye <= ((90*$estime)/100)){
                      echo '<span>90%</span>';
                    } 
                    else if($paye <= ((100*$estime)/100)){
                      echo '<span>100%</span>';
                    } 
                    ?>
                  </div>
                </div>
                <div class="progress">
                  <?php
                  if($paye == ''){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                          </div>';
                  }
                  else if($paye <= ((10*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                          </div>';
                  }
                  else if($paye <= ((20*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                          </div>';
                  }
                  else if($paye <= ((30*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                          </div>';
                  }
                  else if($paye <= ((40*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                          </div>';
                  }
                  else if($paye <= ((50*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                          </div>';
                  }
                  else if($paye <= ((60*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                          </div>';
                  }
                  else if($paye <= ((70*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                          </div>';
                  }
                  else if($paye <= ((80*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                          </div>';
                  }
                  else if($paye <= ((90*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                          </div>';
                  }
                  else if($paye <= ((100*$estime)/100)){
                    echo '<div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          </div>';
                  }
                  ?>
                </div>
              </div>

              <?php
                      }
                    }
                  }
                }
                ?>

              <div id="">
                <?php
                  $quu = "SELECT SUM(paiement) as idd FROM consultation WHERE nom = '$n'";
                  $ress = mysqli_query($conn,$quu);
                  echo mysqli_error($conn);
                  $resChes = mysqli_num_rows($ress);
                  if($resChes > 0){
                    while($roww = mysqli_fetch_assoc($ress)){
                      if($roww["idd"] == ''){
                        $roww["idd"] = "0";
                      }
                      echo '<button type="button" class="btn btn-md btn-outline-warning col-md-12 mb-2" data-toggle="modal" data-target="#exampleeModalz" disabled>Total éstimé : '.$roww["idd"].' DHS</button>';

                      $quuu = "SELECT SUM(montant) as idd FROM paiement WHERE nom = '$n'";
                      $resss = mysqli_query($conn,$quuu);
                      echo mysqli_error($conn);
                      $resChess = mysqli_num_rows($resss);
                      if($resChess > 0){
                        while($rowww = mysqli_fetch_assoc($resss)){
                          if($rowww["idd"] == ''){
                            $rowww["idd"] = "0";
                          }
                          echo '<button type="button" class="btn btn-md btn-outline-success col-md-12 mb-2" data-toggle="modal" data-target="#exampleeModalz" disabled>Total payé : '.$rowww["idd"].' DHS</button>

                            <button type="button" class="btn btn-md btn-outline-danger col-md-12 mb-2" data-toggle="modal" data-target="#exampleeModalz" disabled>Total non payé : ';

                              if (($roww["idd"]-$rowww["idd"]) >= 0){
                                echo ($roww["idd"]-$rowww["idd"]). 'DHS';
                              }
                              else{
                              echo '0 DHS';
                              }
                              echo '
                            </button>';
                        }
                      }
                    }
                  }
                ?>
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
</body>
</html>

<script type="text/javascript">
  function upd(){
    document.getElementById("ben").value = Number(document.getElementById("prix_ins").value) + Number(document.getElementById("ca").value) - Number(document.getElementById("charge").value) ;
  }
</script>

<script type="text/javascript">
  $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_card_patient").load("ref_card_patient.php");
      },500);
    });

  $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_infop").load("ref_infop.php?id=<?php echo $dd; ?>");
      },2000);
    });
 
 $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_infop1").load("ref_infop1.php?id=<?php echo $dd; ?>");
      },2000);
    });

 $(document).ready(
    function(){
      setInterval(function(){
        $("#ref_infop2").load("ref_infop2.php?id=<?php echo $dd; ?>");
      },2000);
    });
</script>