<?php
include 'php/conn.php';

$qu4 = "SELECT * FROM admin WHERE statut = 'admin'";
$res4 = mysqli_query($conn,$qu4);
$resChe4 = mysqli_num_rows($res4);
if($resChe4 > 0){
  while($row4 = mysqli_fetch_assoc($res4)){
	$to = $row["email"];

	$message = 
		'<h3>Aujourd\'hui:</h3>'."\n".
		'<h4>Caisse:</h4>'."\n".
		'<html>
			<head>
			</head>
			<body>
				<table class="table align-items-center table-flush">
		            <thead class="thead-light">
		              <tr class="text-center">
		                <th scope="col">CA</th>
		                <th scope="col">Charges payées</th>
		                <th scope="col">Charges non payées</th>
		                <th scope="col">Bénefice</th>
		              </tr>
		            </thead>
		            <tbody>
		                <tr class="text-center">'
		                    $qu1 = "SELECT SUM(paiement) as t FROM consultation WHERE date_c>= NOW()";
		                    $res1 = mysqli_query($conn,$qu1);
		                    $resChe1 = mysqli_num_rows($res1);
		                    if($resChe1 > 0){
		                      while($row1 = mysqli_fetch_assoc($res1)){
		                        echo '<td>'.$row1["t"].'</td>';
		                      }
		                    }

		                    $qu2 = "SELECT SUM(prix_charge) as prix FROM charge WHERE situation = 'Payé' AND (date_charge >= NOW()) ";
		                    $res2 = mysqli_query($conn,$qu2);
		                    $resChe2 = mysqli_num_rows($res2);
		                    if($resChe2 > 0){
		                      while($row2 = mysqli_fetch_assoc($res2)){
		                        echo '<td>'.$row2["prix"].'</td>';
		                      }
		                    }

		                    $qu3 = "SELECT SUM(prix_charge) as prix FROM charge WHERE situation = 'Non payé' AND (date_charge >= NOW()) ";
		                    $res3 = mysqli_query($conn,$qu3);
		                    $resChe3 = mysqli_num_rows($res3);
		                    if($resChe3 > 0){
		                      while($row3 = mysqli_fetch_assoc($res3)){
		                        echo '<td">'.$row3["prix"].' DHS</td>';
		                      }
		                    }

		                    $qu41 = "SELECT SUM(paiement) as prix1 FROM consultation WHERE date_c >= NOW() ";
		                    $qu42 = "SELECT SUM(prix_charge) as prix2 FROM charge WHERE (date_charge >= NOW()) ";
		                    $res41 = mysqli_query($conn,$qu41);
		                    $res42 = mysqli_query($conn,$qu42);
		                    $resChe41 = mysqli_num_rows($res41);
		                    $resChe42 = mysqli_num_rows($res42);
		                    if($resChe41 > 0){
		                      if($resChe42 > 0){
		                        while($row41 = mysqli_fetch_assoc($res41)){
		                          while($row42 = mysqli_fetch_assoc($res42)){
		                              echo '<td"> ' . ($row41["prix1"] - $row42["prix2"]) .' DHS </td>';
		                          }
		                        }
		                      }
		                    }

		                '</tr>
		            </tbody>
		        </table>'."\n".
				'<h4>Patients consultés:</h4>'."\n".

		       '<table class="table align-items-center table-flush">
		            <thead class="thead-light">
		              <tr class="text-center">
		                <th scope="col">Nom et Prénom</th>
		                <th scope="col">paiement</th>
		                <th scope="col">mode</th>
		                <th scope="col">Description</th>
		              </tr>
		            </thead>
		            <tbody>
		                <tr class="text-center">'
		                    $qu1 = "SELECT * FROM consultation WHERE date_c >= NOW()";
		                    $res1 = mysqli_query($conn,$qu1);
		                    $resChe1 = mysqli_num_rows($res1);
		                    if($resChe1 > 0){
		                      while($row1 = mysqli_fetch_assoc($res1)){
		                        echo '<td>'.$row1["nom"].'</td>
		                        <td>'.$row1["paiement"].'</td>
		                        <td>'.$row1["mode_paiement"].' DHS</td>
		                        <td>'.$row1["description"].' </td>';
		                      }
		                    }   
		                '</tr>
		            </tbody>
		        </table>'."\n".
				'<h3>RDV Demain:</h3>'."\n".
					
				'<table class="table align-items-center table-flush">
		            <thead class="thead-light">
		              <tr class="text-center">
		                <th scope="col">Nom et Prénom</th>
		                <th scope="col">Debut</th>
		                <th scope="col">Fin</th>
		              </tr>
		            </thead>
		            <tbody>
		                <tr class="text-center">'
		                	$d = date("Y-m-d");
						    $qu3 = "SELECT * FROM events WHERE CAST(start_event AS DATE) = CAST((NOW()+INTERVAL 1 day) AS DATE)";
						    $res3 = mysqli_query($conn,$qu3);
						    $resChe3 = mysqli_num_rows($res3);
						    if($resChe3 > 0){
						      while($row3 = mysqli_fetch_assoc($res3)){
								echo '<td>'.$row3["title"].'</td>
									  <td>'.$row3["start_event"].'</td>
									  <td>'.$row3["end_event"].'</td>';
							  }
							}
						'</tr>
					</tbody>
				</table>
			</body>
		</html>'
		;


	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: <no-reply@e-dentist.ma>' . "\r\n";
	//ini_set('SMTP','myserver');
	//ini_set('smtp_port',25);

	$subject = 'Récapitulatif';

echo '<div id="refresh_mail">';

	$date_actuelle = date('H:i:s');
	$d = date('20:05:00');
	if ($date_actuelle == $d){
		mail($to, $subject, $message,$headers);
	}
echo '</div>';
  }
}
?>

<script>
  $(document).ready(
    function(){
      setInterval(function(){
        $("#refresh_mail").load("refresh_mail.php");
      },86400000);
    });
</script>