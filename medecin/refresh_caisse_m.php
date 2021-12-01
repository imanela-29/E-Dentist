<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
 $qu = "SELECT date, SUM(montant) as total FROM paiement WHERE date >= DATE_FORMAT(NOW() ,'%Y-%m-01') GROUP BY date ORDER BY date DESC";
$res = mysqli_query($conn,$qu);
$resChe = mysqli_num_rows($res);
if($resChe > 0){
  while($row = mysqli_fetch_assoc($res)){
    echo '
    <tr class="text-center">
      <td>'.$row["date"].'</th>
      ';

    echo '<td class="text-success">'.$row["total"].'</td>
    </tr>';
  }
}
  ?>