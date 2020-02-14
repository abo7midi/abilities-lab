<?php

require "fpdf.php";


class mypdf extends FPDF{
/*    function header(){
        $this->Image("logo.png",10,6);
        $this->SetFont("Arial","B",14);
        $this->Cell(276,5,"Eml",0,0,"C");
        $this->Ln();
        $this->SetFont("Times","",12);
        $this->Cell(276,10,"streer nvfsdklfn kjsdjfnkjsdnm",0,0,"C");
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont("Arial","",8);
        $this->Cell(0,10,"Page".$this->PageNo()."/{nb}",0,0,"C");
    }
    function  headerTable(){
        $this->SetFont("Times","B",12);
        $this->Cell(20,10,"ID",1,0,"C");
        $this->Cell(40,10,"Name",1,0,"C");
        $this->Cell(40,10,"Age",1,0,"C");
        $this->Cell(50,10,"Gender",1,0,"C");

    }*/
}

$pdf=new mypdf("L","mm","A4");
$pdf->AliasNbPages();
$pdf->addPage("L","A4",0);
$pdf->SetFont("Times");
$pdf->Image('Certificate.png',0,0,297 ,212);
$pdf->SetXY(148,105);
$pdf->Cell(20,10,"Mohammed Alhomidi",0,0,"C");
$pdf->SetXY(100,150);
$pdf->SetFont("Times","B",28);
$pdf->Cell(20,10,"Technical Support System",0,0,"C");
$pdf->SetFont("Times","",14);
$pdf->SetXY(200,179);
$pdf->Cell(20,10,date("Y-m-d"),0,0,"C");
$pdf->SetXY(91,179);
$pdf->Cell(20,10,"sana'a univercity",0,0,"C");

$pdf->Output("I","certificate.pdf");