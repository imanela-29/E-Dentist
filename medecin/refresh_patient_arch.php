<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

                    if( isset($_POST["submit_recherche"]) ){

                      if( $_POST["name_recherche"] != '' && $_POST["num_recherche"] == ''  && $_POST["cin_recherche"] == '' ){
                        $name = $_POST["name_recherche"];

                        $qu = "SELECT * FROM patient WHERE nom like '%$name%' and date_inscription = 0000-00-00 ORDER BY id DESC";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '
                            <tr class="text-center">';

                            if( $row["nom"] == '' || $row["cin"] == '' || $row["tel"] == '' || $row["adresse"] == '' || $row["fonction"] == '' || $row["date_naissance"] == '' || $row["mutuelle"] == '' || $row["genre"] == '' || $row["dossier"] == '' || $row["maladies"] == '' || $row["chirurgie"] == '' || $row["medicaments"] == '' ){
                              echo '<th scope="row"><span class="badge badge-warning">'.$row["id"].'</span></th>';
                            }
                            else{
                              echo '<th scope="row"><span class="badge badge-success">'.$row["id"].'</span></th>';
                            }

                          
                             echo' <td>'.$row["dossier"].'</td>
                                   <td>'.$row["nom"].'</td>
                                   <td>'.$row["cin"].'</td>
                                   <td>'.$row["date_naissance"].'</td>
                                                    
                              <td>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-info" href="fiche_patient.php?id='.$row['id'].'">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Archiver le patient" class="btn btn-sm btn-success" href="desarchiver.php?id='.$dd.'">
                                  <i class="fas fa-archive"></i> 
                                </a>
                              </td>
                            </tr>
                            ';
                          }
                        }

                      }

                      elseif( $_POST["name_recherche"] == '' && $_POST["num_recherche"] != ''  && $_POST["cin_recherche"] == '' ){
                        $cas = $_POST["num_recherche"];

                        $qu = "SELECT * FROM patient WHERE dossier = '$cas' and date_inscription = 0000-00-00 ORDER BY id DESC";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '
                            <tr class="text-center">';

                            if( $row["nom"] == '' || $row["cin"] == '' || $row["tel"] == '' || $row["adresse"] == '' || $row["fonction"] == '' || $row["date_naissance"] == '' || $row["mutuelle"] == '' || $row["genre"] == '' || $row["dossier"] == '' || $row["maladies"] == '' || $row["chirurgie"] == '' || $row["medicaments"] == ''  ){
                              echo '<th scope="row"><span class="badge badge-warning">'.$row["id"].'</span></th>';
                            }
                            else{
                              echo '<th scope="row"><span class="badge badge-success">'.$row["id"].'</span></th>';
                            }

                          
                             echo' <td>'.$row["dossier"].'</td>
                                   <td>'.$row["nom"].'</td>
                                   <td>'.$row["cin"].'</td>
                                   <td>'.$row["date_naissance"].'</td>
                                                    
                              <td>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-info" href="fiche_patient.php?id='.$row['id'].'">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Archiver le patient" class="btn btn-sm btn-success" href="desarchiver.php?id='.$dd.'">
                                  <i class="fas fa-archive"></i> 
                                </a>
                              </td>
                            </tr>
                            ';
                          }
                        }

                      }

                      elseif( $_POST["name_recherche"] == '' && $_POST["num_recherche"] == ''  && $_POST["cin_recherche"] != ''){
                        $ref = $_POST["cin_recherche"];

                        $qu = "SELECT * FROM patient WHERE cin = '$cin' and date_inscription = 0000-00-00 ORDER BY id DESC";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '
                            <tr class="text-center">';

                            if( $row["nom"] == '' || $row["cin"] == '' || $row["tel"] == '' || $row["adresse"] == '' || $row["fonction"] == '' || $row["date_naissance"] == '' || $row["mutuelle"] == '' || $row["genre"] == '' || $row["dossier"] == '' || $row["maladies"] == '' || $row["chirurgie"] == '' || $row["medicaments"] == ''  ){
                              echo '<th scope="row"><span class="badge badge-warning">'.$row["id"].'</span></th>';
                            }
                            else{
                              echo '<th scope="row"><span class="badge badge-success">'.$row["id"].'</span></th>';
                            }

                          
                            echo' <td>'.$row["dossier"].'</td>
                                   <td>'.$row["nom"].'</td>
                                   <td>'.$row["cin"].'</td>
                                   <td>'.$row["date_naissance"].'</td>
                                                    
                              <td>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-info" href="fiche_patient.php?id='.$row['id'].'">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Archiver le patient" class="btn btn-sm btn-success" href="desarchiver.php?id='.$dd.'">
                                  <i class="fas fa-archive"></i> 
                                </a>
                              </td>
                            </tr>
                            ';
                          }
                        }

                      }

                    }



                      else{

                        $qu = "SELECT * FROM patient WHERE date_inscription = 0000-00-00 ORDER BY id DESC";
                        $res = mysqli_query($conn,$qu);
                        $resChe = mysqli_num_rows($res);
                        if($resChe > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            echo '
                            <tr class="text-center">';

                            if( $row["nom"] == '' || $row["cin"] == '' || $row["tel"] == '' || $row["adresse"] == '' || $row["fonction"] == '' || $row["date_naissance"] == '' || $row["mutuelle"] == '' || $row["genre"] == '' || $row["dossier"] == '' || $row["maladies"] == '' || $row["chirurgie"] == '' || $row["medicaments"] == ''  ){
                              echo '<th scope="row"><span class="badge badge-warning">'.$row["id"].'</span></th>';
                            }
                            else{
                              echo '<th scope="row"><span class="badge badge-success">'.$row["id"].'</span></th>';
                            }

                          
                             echo' <td>'.$row["dossier"].'</td>
                                   <td>'.$row["nom"].'</td>
                                   <td>'.$row["cin"].'</td>
                                   <td>'.$row["date_naissance"].'</td>
                                                    
                              <td>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Fiche du patient" class="btn btn-sm btn-outline-info" href="fiche_patient.php?id='.$row['id'].'">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a role="button" data-toggle="tooltip" data-placement="top" title="Archiver le patient" class="btn btn-sm btn-success" href="desarchiver.php?id='.$dd.'">
                                  <i class="fas fa-archive"></i> 
                                </a>
                              </td>
                            </tr>
                            ';
                          }
                        }

                      }
?>