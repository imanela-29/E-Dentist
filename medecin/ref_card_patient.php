<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
echo ' 
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total patient</h5>';

                      
                        $qu = "SELECT COUNT(id) as idd FROM patient ";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["idd"].' patients</span>';
                          }
                        }
                      
echo '
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total non payé</h5>';

                      

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
                      
echo '
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total payé</h5>';

                      
                        $quuu = "SELECT SUM(montant) as t FROM paiement where date >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                        $resss = mysqli_query($conn,$quuu);
                        echo mysqli_error($conn);
                        $resChess = mysqli_num_rows($resss);
                        if($resChess > 0){
                          while($row = mysqli_fetch_assoc($resss)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["t"].' DHS</span>';
                          }
                        }
                      
echo '
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total estimé</h5>';

                      
                        $quu = "SELECT SUM(paiement) as t FROM consultation where date_c >= DATE_FORMAT(NOW() ,'%Y-%m-01')";
                        $ress = mysqli_query($conn,$quu);
                        $resChes = mysqli_num_rows($ress);
                        if($resChes > 0){
                          while($row = mysqli_fetch_assoc($ress)){
                            echo '<span class="h2 font-weight-bold mb-0">'.$row["t"].' DHS</span>';
                          }
                        }
                      
echo '
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
            </div>';
          
?>