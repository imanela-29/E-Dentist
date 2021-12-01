<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}

include 'php/conn.php';
  
if( isset($_POST["valide"]) ){


    $dd = $_POST["dd"];
    $nom = $_POST["nom"];
    $date = $_POST["date"];
    $cin = $_POST["cin"];
    $description = $_POST["description"];
    $p = $_POST["paiement"];
    $ben = $_POST["ben"];
    $mode = $_POST["mode_paiement"];

    $q = "INSERT INTO paiement values (null, '$nom', '$cin', '$date', '$mode', '$p', '$description')";
    $conn->query($q);

    $query = "INSERT INTO benefice VALUES (NULL, '$date', '$ben', '$nom', '$cin')";
    $conn->query($query);

    $qu4 = "SELECT * FROM admin WHERE statut = 'admin'";
    $res4 = mysqli_query($conn,$qu4);
    $resChe4 = mysqli_num_rows($res4);
    if($resChe4 > 0){
      while($row4 = mysqli_fetch_assoc($res4)){
         $to1 = $row4["email"];

        $message = 
            '<html>
                <head>
                </head>
                <body>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th scope="col" style="border: 1px solid #dddddd;">Date</th>
                        <th scope="col" style="border: 1px solid #dddddd;">Montant</th>
                        <th scope="col" style="border: 1px solid #dddddd;">Type</th>
                        <th scope="col" style="border: 1px solid #dddddd;">Commentaire</th>
                      </tr>
                    </thead>
                    <tbody id="">
                        <tr class="text-center">
                            <td style="border: 1px solid #dddddd;">'.$date.'</td>
                            <td style="border: 1px solid #dddddd;">'.$p.'</td>
                            <td style="border: 1px solid #dddddd;">'.$mode.'</td>
                            <td style="border: 1px solid #dddddd;">'.$description.'</td>
                        </tr>';
                      echo '
                    </tbody>
                  </table>
                </div>
                </body>
            </html>'
            ;


        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: <no-reply@e-dentist.ma>' . "\r\n";
        //ini_set('SMTP','myserver');
        //ini_set('smtp_port',25);

        $subject = 'Nouveau Paiement';

        $qu3 = "SELECT * FROM patient WHERE nom = '$nom' and cin = '$cin'";
        $res3 = mysqli_query($conn,$qu3);
        echo mysqli_error($conn);
        $resChe3 = mysqli_num_rows($res3);
        if($resChe3 > 0){
          while($row3 = mysqli_fetch_assoc($res3)){
            $to2 = $row3["email"];
            if(mail($to1, $subject, $message,$headers) && mail($to2, $subject, $message, $headers)){
                header('location:paiement.php?id='.$dd.'');
            }
            else{
                echo 'error';
            }    
          }
        }

      }
    }  

}
?>