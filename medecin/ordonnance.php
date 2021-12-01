<?php
session_start();

if(!isset($_SESSION["email"])){
  header('location:index.php');
}
else{
  $mail = $_SESSION["email"];
}  
    $datee = date("Y-m-d");
 	include 'php/conn.php';

	require('FPDF/fpdf.php');

	$pdf = new FPDF();

	$id = $_GET["id"];

	    $query = "SELECT * FROM ordonnances WHERE date = '$id' ";
	    $result = mysqli_query($conn, $query);
	  	$row = mysqli_fetch_array($result);


  	$pdf->SetTitle('Ordonnance : '.$row["nom"]);
	$pdf->SetMargins(3, 2, 3);
	$pdf->AddPage('P', 'A5');
	$pdf->SetFont("Helvetica","B", 17);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFillColor(204, 217, 255);

	$pdf->SetFont('Helvetica','', 14);
	$pdf->Cell(7, 30, utf8_decode(''), 0, 1, 'L');
	$pdf->Cell(7, 10, utf8_decode(''), 0, 0, 'L');
	$pdf->setXY(30, 50);
	$pdf->Cell(130, 10, utf8_decode("Nom et Prénom: {$row["nom"]}"), 0, 'L', False);

	$pdf->SetFont('Helvetica','', 14);
	$pdf->Cell(7, 20, utf8_decode(''), 0, 1, 'L');


	$qu = "SELECT * FROM ordonnances WHERE date = '$id' ";
    $res = mysqli_query($conn,$qu);
    $resChe = mysqli_num_rows($res);
    if($resChe > 0){
      while($rowe = mysqli_fetch_assoc($res)){
		$pdf->Cell(7, 10, utf8_decode(''), 0, 0, 'L');
		$pdf->MultiCell(130, 7, utf8_decode("*Médicament {}: {$rowe["medicaments"]}, {$rowe["description"]}, {$rowe["unites"]}"), 0, 'L', False);
		$pdf->Cell(7, 2, utf8_decode(''), 0, 1, 'L');

}}

	$pdf->Cell(7, 10, utf8_decode(""), 0, 1, 'L');
	$pdf->Cell(80, 10, utf8_decode(""), 0, 0, 'L');
	$pdf->Cell(50, 10, utf8_decode("Oujda, le $datee"), 0, 1, 'L');

	$pdf->output('I', 'Ordonnance '.$row["nom"].'.pdf', true);

?>