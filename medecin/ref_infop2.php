<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
  $dd = $_GET['id'];


                    $qu = "SELECT * FROM patient WHERE id = $dd";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        $n = $row["nom"];
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
