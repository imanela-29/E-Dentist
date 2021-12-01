<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
  include 'php/conn.php';

if(isset($_POST["etu"]))
{
  $output='';

  $query = "SELECT * FROM patient WHERE id = ".$_POST["etu"]."";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result)){
    $n = $row["nom"];

    $query = "SELECT start_event, CAST( start_event AS DATE ) as d FROM events WHERE title = '$n' order by start_event desc";
    $result = mysqli_query($conn, $query);
    while($roww = mysqli_fetch_array($result)){
      $s = $roww["start_event"];
      $da = $roww["d"];

      $output .= 
          '  <span class="timeline-step badge-success">
              <i class="fa fa-calendar-check"></i>  
            </span>
            <div class="timeline-content">
            <br><h4 class="text-muted font-weight-bold">'.$s.'</h4>
            </div>
              ';

    }

  }
  ?>


<?php
  echo $output;
}
?>
