<?php  
session_start();
$email= $_SESSION['email'];
$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$mondo= $_SESSION['mondo'];

$data_p = $_SESSION['datap'];
$data_r = $_SESSION['datar'];
$prezzo= $_SESSION['prezzo'];
$destinazione=$_SESSION['location'];
$data_p = $_SESSION['datap'];
$data_r = $_SESSION['datar'];

$info= $_SESSION['info'];

$nominativi_commento = $testo_pulito = str_replace(array('Array','[0]', '[1]','[2]','[3]','[4]','[5]','[6]','[7]','[8]','[9]','[10]', '(', ')', '[', ']','=','>'), '', $info);


include('fpdf/fpdf.php');

$data_ricevuta= date("d/m/o");
$ora= date("H:i:s");
$pdf = new FPDF();

// Aggiungi una pagina
$pdf->AddPage();

// Imposta il font
$pdf->SetFont('Arial', 'B', 32);

$pdf->Image('../immagini/logo.png', -50, 0, 297, 297);

// Aggiungi una cella di testo
$pdf->Cell(190, 20, "Ricevuta di acquisto Viaggio", 1, 2, 'C', false); 
$pdf->SetFont('Arial', 'I', 18);
$pdf->Cell(0,30,"",0,2,'',false);
$pdf->MultiCell(190, 15, "Grazie  $cognome $nome \nper esserti rivolto a noi per viaggiare nel $destinazione\nil team ;)\n Data ricevuta: $data_ricevuta Ore:$ora", 1, 'C', false);
$pdf->Cell(0,90,"",0,2,'',false);
$pdf->SetFont('Arial', '', 18);
$pdf->MultiCell(0, 10, "Ecco i dettagli:\nPartenza:$data_p\nRitorno:$data_r\nMONDO: $mondo\nPREZZO:$prezzo euro\nAltre info:$nominativi_commento", 0, 'L', false);

// Forza il download del PDF
$pdf->Output('D', 'Ricevuta.pdf');
exit();

?>

