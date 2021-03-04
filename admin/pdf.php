<?php
include('database.php');
$database = new Database();
$result = $database->runQuery("SELECT username,vehicle_name, price, date_taken, due_date FROM payments");
$header = $database->runQuery("SELECT UCASE(`COLUMN_NAME`)

FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='rental' 
AND `TABLE_NAME`='payments'
and `COLUMN_NAME` in ('username','vehicle_name', 'price', 'date_taken', 'due_date')");

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',13);

foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(38,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(38,12,$column,1);
}
$pdf->Output();
?>