<?php
require("fpdf/fpdf.php");
include("conexion2.php"); 
class PDF extends FPDF{
    //Cabecera de página
    function Header() {
        $this->Image('imagen/linkedin_banner_image_1.png',10,10,30);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,15,'Tecnologia para crear ideas',1,0,'C');
        $this->SetY(17);
        $this->SetX(-30);
        $this->Write(1, 'V.Oficial'); // (y, texto)
        $this->Ln(15);
    }
    //Pte de página
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,'Pagina : '.$this->PageNo(),1,0,'C');
    }
}

$pdf=new PDF(); //  v1ene de : c la ss PDF ext ends FPDF
$pdf->AddPage();
//Título de la pagina
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Helvetica','I',32);
$pdf->Cell(190,14,'Registro de Datos',0,1, 'C',FALSE);
$pdf->Ln(3);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(190,12,'Medicion de sensores',0,1,'C');
$pdf->Ln(3);

//Colores, ancho de línea y fuente en negrita para ancabezado de columna
$pdf->SetFillColor(200,200,200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.2);
$pdf->SetFont('Arial','B',14);

//Encabezado de las columnas
$header=array('Id','Temperat.(C)','Hume.R(%)','Rad.S.(W/m2)','C02(ppm)','fecha y hora');
$w=array(10,40,30,40,30,40);
for($i=0;$i<count($header);$i++)
$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();

//Restauración de colores y fuentes
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('helvetica','',10);

//listado de los inscritos
$result = mysqli_query($conexion, "select * from historialc order by id"); //where esp alumno = 1
while ($row = mysqli_fetch_array($result))
{
    //posicion celda, alto,contenido,bordes_ver(Left,Right,Top,Botton),0, alineacion Left/Center/Right 
    $pdf->Cell($w[0],5,$row[0],'LRTB',0,'C'); //cod
    $pdf->Cell($w[1],5,$row[1],'LRTB',0,'C'); //Apell
    $pdf->Cell($w[2],5,$row[2],'LRTB',0,'C'); //nomb
    $pdf->Cell($w[3],5,$row[3],'LRTB',0,'C'); //Especialidad
    $pdf->Cell($w[4],5,$row[4],'LRTB',0,'C'); //Especialidad
    $pdf->Cell($w[5],5,$row[5],'LRTB',0,'C'); //Especialidad
    
    $pdf->Ln();
};

//Restauración de colores y fuentes para firmas
$pdf->Ln(5);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('times','',12);
$pdf->Cell(183,15,"Tacna, 16 de diciembre del 2022",'',0,'R');
$pdf->Ln(35);
$pdf->Image('imagen/QR.jpg',9,27,31); //$pdf->Image('imagen/firma_dir.jpg',130,125,30); //('imagen', x,y,ancho)//('imagen', x,y,ancho)
 $pdf->Image('imagen/sello_dir.jpg',170,30,25);
 $pdf->Cell(80,10,"    ",'',0,'C'); $pdf->Cell(30,10,"    ",'',0,'C'); $pdf->Cell(50,10,"DIRECTOR",'T',0,'C');
 $pdf->Ln(5);
 $pdf->Cell(80,10,"    ",'',0,'C');  $pdf->Cell(30,10,"     ",'',0,'C'); $pdf->Cell(50,10,"Firma y Sello",'',0,'C');

$pdf->Output();
?>