<?php
require_once ("koneksi.php");
$idnilai = $_POST['IDNILAI'];
$query="SELECT * FROM nilai WHERE IDNILAI='$idnilai'";
$sql=mysql_query($query);
$data=array();
while ($row=mysql_fetch_assoc($sql))
{
array_push($data,$row);
}
$judul="";
$header=array(array("label"=>"IDNILAI","length"=>15,"align"=>"L"),
array("label"=>"NIP","length"=>16,"align"=>"L"),
array("label"=>"NIS","length"=>22,"align"=>"L"),
array("label"=>"MATAKULIAH","length"=>40,"align"=>"L"),
array("label"=>"NILAI","length"=>11,"align"=>"L"),
array("label"=>"TGLUJIAN","length"=>20,"align"=>"L"),
array("label"=>"KET UJIAN","length"=>9,"align"=>"L"));

require_once ("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial",'B','0');
$pdf->Cell(0,8,$judul,'0',1,'C');
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
foreach ($header as $kolom)
{
$pdf->Cell($kolom['length'],5,$kolom['label'],1,'0',$kolom['align'],true);
}
$pdf->Ln();
$pdf->SetFont('');
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$fill=false;
foreach ($data as $baris)
{
$i=0;
foreach ($baris as $cell)
{
$pdf->Cell($header[$i]['length'],5,$cell,1,'0',$kolom['align'],$fill);
$i++;
}
$fill=!$fill;
$pdf->Ln();
}
$pdf->Output();
?>
