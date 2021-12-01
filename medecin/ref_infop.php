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
?>      