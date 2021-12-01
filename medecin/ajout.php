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

<?php
if(isset($_POST['submit2'])){
      $id = $_POST["idd"];

  $qu1 = "SELECT * FROM patient WHERE id = '$id'";
  $res1 = mysqli_query($conn,$qu1);
    while($row1 = mysqli_fetch_assoc($res1)){
      $nom = $row1["nom"];
      $cin = $row1["cin"];

      $q = $_POST["certificat"];
      $date = date('Y-m-d');

      $q2 = "INSERT INTO certificats values (NULL, '$nom', '$cin', '$q', '$date')";
      $conn->query($q2);
      
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);

}
?>
<?php 
if(isset($_POST['imprimer1'])){

  $qu1 = "SELECT * FROM patient WHERE id = $dd";
  $res1 = mysqli_query($conn,$qu1);
    while($row1 = mysqli_fetch_assoc($res1)){
      $nom = $row1["nom"];
      $cin = $row1["cin"];

  $nbr = $_POST["currenttt"];

      for($i=1;$i<=$nbr;$i++){

        $a = $_POST["art".$i];
        $d = $_POST["description".$i];
        $q = $_POST["qte".$i];
        $date = date('Y-m-d');

        $q1 = "INSERT INTO ordonnances values (NULL, '$nom', '$cin', '$a', '$q', '$d', '$date')";
        $conn->query($q1);
      }
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
}
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
            'Profil : ' . $row["nom"].' | Cabinet docteur';
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
              <li class="breadcrumb-item active" aria-current="page">Fichiers</li>
            </ol>
          </nav>

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
        <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h2 class="heading-small text-dark mb--3"><b>Ajouter des fichiers: </b></h2>
                <hr class="my-4 mb-4" />
                <?php
                  $qu = "SELECT * FROM patient WHERE id = $dd ";
                  $res = mysqli_query($conn,$qu);
                  $resChe = mysqli_num_rows($res);
                  if($resChe > 0){
                    while($row = mysqli_fetch_assoc($res)){
                      echo '
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-lg-12 input-group-sm">
                            <input type="text" class="form-control" name="cin" value="'.$row["cin"].'" hidden>
                            <input type="file" class="form-control" name="fichiers" required>
                          </div>
                        </div>
                        <div class="row">  
                          <div class="form-group col-lg-12 input-group-sm">
                            <input type="text" class="form-control" name="name" placeholder="Renommer le fichier" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-12">
                            <input type="submit" class="btn btn-block btn-success btn-sm" name="valide" value="Enregistrer">
                          </div>
                        </div>  
                    </form>';
                    }
                  }
                ?>  
            </div>
            <!-- Card body -->
            <div class="card-body p-0">
              <div class="col ">
                  <?php
                    $qu = "SELECT * FROM patient WHERE id = $dd ";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                            <h2 class="heading-small text-dark mb--3"><b>Les fichiers du patient: '.$row["nom"].'</b></h2>
                            <hr class="my-4" />';
                            $cin = $row["cin"];
                            $que = "SELECT * FROM fichiers WHERE cin = '$cin' ";
                            $rese = mysqli_query($conn,$que);
                            $resChee = mysqli_num_rows($rese);
                            if($resChee > 0){
                              while($rowe = mysqli_fetch_assoc($rese)){

                            $ques = "SELECT count(id) as n FROM fichiers WHERE cin = '$cin' ";
                            $reses = mysqli_query($conn,$ques);
                            $resChees = mysqli_num_rows($reses);
                            if($resChees > 0){
                              while($rowes = mysqli_fetch_assoc($reses)){
                                $n = $rowes["n"];
                                  echo '
                                  <div class="row">
                                    <div class="col-md-10">
                                      <div class="form-group">
                                        <a role="button" data-toggle="tooltip" data-placement="top" title="Consulter et Télecharger" class="btn btn-sm btn-block btn-outline-default edit_dataa" name="edit" href="#" id="'.$rowe['id'].'"> '.$rowe["fich"].'
                                        </a>
                                      </div>
                                    </div>
                                    <div class="form-group col-xl-2">
                                      <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer le fichier" class="btn btn-sm btn-outline-danger" onclick="return checkDelete()" href="delfich.php?id='.$rowe["id"].'">
                                        <i class="fas fa-trash-alt"></i>
                                      </a>
                                    </div>
                                  </div>  

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
                            }  
                          }
                      }
                    }
                  ?> 
              </div> 
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h2 class="heading-small text-dark mb--3"><b> Ordonnances </b></h2>
              <hr class="my-4 mb-4" />
              <div class="col text-center">
                <button type="button" class="btn btn-sm btn-primary ordonnance col-lg-12" data-toggle="modal" data-target="#exampleModal3">Ajouter une ordonnance</button>
              </div>

                <form method="POST">
                  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remplir les infos</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <input type="text" name="idd" value="<?php echo $dd;?>" hidden>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <div class="row">
                              <div class="table-responsive">
                                <div>
                                  <table  id="dataTable"  class="table align-items-center">
                                    <thead class="thead-light">
                                      <tr>
                                        <th class="sort" scope="col">Nom médicament</th>
                                        <th class="sort" scope="col">Description</th>
                                        <th class="sort" scope="col">Unité</th>
                                      </tr>
                                    </thead>
                                    <tbody class="list">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <input type="button" class="btn btn-sm btn-block btn-primary mt-2 col-xl-12" value="Ajouter un médicament" name="add" id="ajout" onclick="addRow('dataTable')" />
                              <input type="text" name="currenttt" id="currenttt" style="display: none;">
                              <input type="submit" name="imprimer1" value="Ajouter" class="btn mt-2 btn-sm btn-outline-success col-xl-12">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <!-- Card body -->
            <div class="card-body p-0">
              <div class="col ">
                  <?php
                    $qu = "SELECT * FROM patient WHERE id = $dd ";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                            <h2 class="heading-small text-dark mb--3 mt-4"><b>Les ordonnances du patient: '.$row["nom"].'</b></h2>
                            <hr class="my-4" />';
                            $cin = $row["cin"];
                            $que = "SELECT * FROM ordonnances WHERE cin = '$cin' group by date";
                            $rese = mysqli_query($conn,$que);
                            $resChee = mysqli_num_rows($rese);
                            if($resChee > 0){
                              while($rowe = mysqli_fetch_assoc($rese)){
                                  echo '
                                  <div class="row">
                                    <div class="col-md-10">
                                      <div class="form-group">
                                        <a role="button" data-toggle="tooltip" data-placement="top" title="Télecharger et Imprimer" class="btn btn-sm btn-block btn-outline-primary" href="ordonnance.php?id='.$rowe["date"].'"> '.$rowe["date"].'
                                        </a>
                                      </div>
                                    </div>

                                    <div class="form-group col-xl-2">
                                      <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer le fichier" class="btn btn-sm btn-outline-danger" onclick="return checkDelete()" href="delord.php?id='.$rowe["date"].'">
                                        <i class="fas fa-trash-alt"></i>
                                      </a>
                                    </div>
                                  </div>  

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
                      }
                    }
                  ?> 
              </div> 
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h2 class="heading-small text-dark mb--3"><b> Certificats </b></h2>
              <hr class="my-4 mb-4" />
              <div class="col text-center">
                <button type="button" class="btn btn-sm btn-warning col-lg-12 certificat" data-toggle="modal" data-target="#exampleModal4">Ajouter un certificat</button>
              </div>

                <form method="POST">
                  <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remplir les info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <input type="text" name="idd" value="<?php echo $dd;?>" hidden>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-xl-12 mt-2">
                              <textarea class="form-control col-xl-12" rows="6" name="certificat" placeholder="Contenu" required></textarea>
                            </div>
                            <div class="form-group col-xl-12 mt-2">
                              <input type="submit" name="submit2" value="Ajouter" class="btn btn-sm btn-outline-success col-xl-12">
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <!-- Card body -->
            <div class="card-body p-0">
              <div class="col ">
                  <?php
                    $qu = "SELECT * FROM patient WHERE id = $dd ";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        echo '
                            <h2 class="heading-small text-dark mb--3 mt-4"><b>Les certificats du patient: '.$row["nom"].'</b></h2>
                            <hr class="my-4" />';
                            $cin = $row["cin"];
                            $que = "SELECT * FROM certificats WHERE cin = '$cin' order by date_c desc";
                            $rese = mysqli_query($conn,$que);
                            $resChee = mysqli_num_rows($rese);
                            if($resChee > 0){
                              while($rowe = mysqli_fetch_assoc($rese)){

                                  echo '
                                  <div class="row">
                                    <div class="col-md-10">
                                      <div class="form-group">
                                        <a role="button" data-toggle="tooltip" data-placement="top" title="Télecharger et Imprimer" class="btn btn-sm btn-block btn-outline-warning" href="certificat.php?id='.$rowe["id"].'"> '.$rowe["date_c"].'
                                        </a>
                                      </div>
                                    </div>
                                    <div class="form-group col-xl-2">
                                      <a role="button" data-toggle="tooltip" data-placement="top" title="Supprimer" class="btn btn-sm btn-outline-danger" onclick="return checkDelete()" href="delcertif.php?id='.$rowe["id"].'">
                                        <i class="fas fa-trash-alt"></i>
                                      </a>
                                    </div>
                                  </div>  

                                     
                                    ';
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
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="assets/vendor/dropzone/dist/min/dropzone.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script type="text/javascript">
    function checkDelete(){
      return confirm("Êtes-vous sûr(e) de vouloir supprimer ?")
    }
  </script>
</body>

</html>
<script type="text/javascript">
  function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("SELECT");
    element1.id = 'art'+rowCount;
    element1.name = 'art'+rowCount;
    element1.className = 'form-control';
    <?php
      $qu = "SELECT * FROM medicaments";
      $res = mysqli_query($conn,$qu);
      $resChe = mysqli_num_rows($res);
      if($resChe > 0){
        while($row = mysqli_fetch_assoc($res)){
          $a = $row["nom"]; 
    ?>
          var a = '<?php echo $a;?>';
          var option = document.createElement("option");
          option.setAttribute("value", a);
          option.text = a;
          element1.appendChild(option);
          cell1.appendChild(element1);
          <?php
        }
      }
    ?>
    var cell2 = row.insertCell(1);
    var element2 = document.createElement("input");
    element2.name='description'+rowCount;
    element2.className = 'form-control';
    /element2.maxLength = 100;/
    cell2.appendChild(element2);


    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.type = "number";
    element3.name = 'qte'+rowCount;
    element3.className = 'form-control';
    /element3.maxLength = 50;/
    cell3.appendChild(element3);

    y = rowCount;
    document.getElementById("currenttt").value = y;
    if (document.getElementById("currenttt").value == 10){
      document.getElementById("ajout").style.display = "none";
    }


  }
</script>
<script>
  $(document).ready(function(){
      setInterval(function(){
        $("#ref_card_patient").load("ref_card_patient.php");
      },2000);
    });

  $(document).ready(function(){
   $(document).on('click', '.edit_dataa', function(){
    var etu = $(this).attr("id");
    $.ajax({
     url:"show_fich.php",
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



<?php

if(isset($_POST['valide'])){

  $c = $_POST['cin'];
  $n = $_POST['name'];

  $filename = $_FILES['fichiers']['name']; 

  $p = pathinfo($filename, PATHINFO_EXTENSION);

  $na = $n.".".$p;

  $target = "repertoire/".$c."/".$na;


  $q = "INSERT INTO fichiers values (NULL, '$na', '$c')";
  $conn->query($q);

  if (move_uploaded_file($_FILES['fichiers']['tmp_name'], $target)) {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }

?>

    <script type="text/javascript">
      window.location = "ajout.php?id=<?php echo $dd; ?>";
    </script> 
<?php
} 
?>