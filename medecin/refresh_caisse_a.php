<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
    
  $qu = "SELECT month(date) as m, SUM(montant) as prix1 FROM paiement WHERE date >= DATE_FORMAT(NOW() ,'%Y-01-01') group by m";
  $res = mysqli_query($conn,$qu);
  $resChe = mysqli_num_rows($res);
  if($resChe > 0){
    while($row = mysqli_fetch_assoc($res)){
      echo '
      <tr class="text-center">
        <th scope="row">'.$row["m"].'</th>';

        if ( $row["prix1"] <= 4999 ){
          echo '<td class="text-danger">'.$row["prix1"].'</td>';
        }
        else{
          echo '<td class="text-success">'.$row["prix1"].'</td>';
        }

      echo '</tr>';
    }
  }
?>