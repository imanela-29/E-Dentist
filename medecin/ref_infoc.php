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


                    $qu = "SELECT * FROM patient WHERE id = '$dd'";
                    $res = mysqli_query($conn,$qu);
                    $resChe = mysqli_num_rows($res);
                    if($resChe > 0){
                      while($row = mysqli_fetch_assoc($res)){
                          echo '

                              <tr class="text-center">';
                                $n = $row["nom"];
                                $ci = $row["cin"];
                                $quu = "SELECT count(id) as idd FROM consultation WHERE nom = '$n' and cin = '$ci'";
                                $ress = mysqli_query($conn,$quu);
                                echo mysqli_error($conn);
                                $resChee = mysqli_num_rows($ress);
                                if($resChee > 0){
                                  while($roww = mysqli_fetch_assoc($ress)){
                                    echo '
                                    <td>'.$roww["idd"].'</td>';
                                  }
                                }
                                $quu = "SELECT sum(paiement) as p FROM consultation WHERE nom = '$n' and cin = '$ci'";
                                $ress = mysqli_query($conn,$quu);
                                echo mysqli_error($conn);
                                $resChee = mysqli_num_rows($ress);
                                if($resChee > 0){
                                  while($roww = mysqli_fetch_assoc($ress)){
                                    echo '
                                    <td>'.$roww["p"].'</td>';
                                  }
                                }
                                $quu = "SELECT prix FROM patient WHERE nom = '$n' and cin = '$ci'";
                                $ress = mysqli_query($conn,$quu);
                                echo mysqli_error($conn);
                                $resChee = mysqli_num_rows($ress);
                                if($resChee > 0){
                                  while($roww = mysqli_fetch_assoc($ress)){
                                    echo '
                                    <td>'.$roww["prix"].'</td>';

                                $qu = "SELECT sum(paiement) as p FROM consultation WHERE nom = '$n' and cin = '$ci'";
                                $res = mysqli_query($conn,$qu);
                                echo mysqli_error($conn);
                                $resChe = mysqli_num_rows($res);
                                if($resChe > 0){
                                  while($rowww = mysqli_fetch_assoc($res)){
                                  $p1 = $rowww["p"];
                                  $p2 = $roww["prix"];
                                  if ($p1 >= $p2){
                                    echo '
                                    <td>
                                    <span class="badge badge-dot mr-4">
                                      <i class="bg-success"></i>
                                      <span class="status">complété</span>
                                    </span>
                                    </td>';
                                  }
                                  else {
                                    echo '
                                    <td>
                                    <span class="badge badge-dot mr-4">
                                      <i class="bg-warning"></i>
                                      <span class="status">en cours</span>
                                    </span>
                                    <td>';
                                  }
                                 }
                                } 
                                  }
                                }
                              echo '
                              </tr>';
                            }}
                              ?>