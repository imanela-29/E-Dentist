<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';
$qu1 = "SELECT month(dated) as m, SUM(prix) as total FROM benefice WHERE ( dated >= DATE_FORMAT(NOW() ,'%Y-01-01') ) GROUP BY m ";
               
$res1 = mysqli_query($conn,$qu1);

$resChe1 = mysqli_num_rows($res1);
  if($resChe1 > 0){
    while($row1 = mysqli_fetch_assoc($res1)){
      echo '
        <tr class="text-center">
          <th scope="row">'.$row1["m"].'</th>
          <td class="text-success">'.$row1["total"].'</td>
        </tr>';  
    }
  }
  ?>