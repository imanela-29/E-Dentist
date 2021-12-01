<?php
session_start();
  $mail = $_SESSION["email"];
  include 'php/conn.php';

$qu = "SELECT * FROM employe ORDER BY id DESC LIMIT 50";
$res = mysqli_query($conn,$qu);
$resChe = mysqli_num_rows($res);
if($resChe > 0){
  while($row = mysqli_fetch_assoc($res)){
    echo '
    <tr class="text-center">';

    if( $row["nom"] == '' || $row["email"] == '' || $row["cin"] == '' || $row["tel"] == '' || $row["adresse"] == '' || $row["poste"] ){
      echo '<th scope="row"><span class="badge badge-info">'.$row["id"].'</span></th>';
    }
    else{
      echo '<th scope="row"><span class="badge badge-success">'.$row["id"].'</span></th>';
    }

     echo' <td>'.$row["nom"].'</td>
           <td>'.$row["poste"].'</td>
           <td>'.$row["date_inscription"].'</td>
     ';

      echo'
      <td>
        <a role="button" data-toggle="tooltip" data-placement="top" title="Consulter" class="btn btn-icon btn-sm btn-outline-success edit_dataa" href="#" name="edit" id="'.$row['id'].'">
          <i class="fas fa-eye"></i>
        </a>
      </td>
    </tr>
    ';
  }
}
?>