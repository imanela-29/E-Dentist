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
                }
              }

                  ?>