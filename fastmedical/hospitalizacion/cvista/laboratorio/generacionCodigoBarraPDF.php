<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');

// create new PDF document

$rangoIni = $_REQUEST["p1"];
$rangoFin = $_REQUEST["p2"];
$tipoContenedor = $_REQUEST["p3"];

$lala = '<table><tr><td>' . (int) $rangoIni . '</td><td>' . (int) $rangoFin . '</td></tr></table>';


$parametros = array();

$parametros["PDF_PAGE_ORIENTATION"] = "P";
$parametros["PDF_PAGE_FORMAT"] = "A4";

$parametros["PDF_MARGIN_LEFT"] = 5;
$parametros["PDF_MARGIN_RIGHT"] = 5;


$parametros["PRINT_HEADER"] = false;
$parametros["PRINT_FOOTER"] = false;


//$parametros["PDF_MARGIN_HEADER"] = 5;
$parametros["PDF_MARGIN_FOOTER"] = 5;

//salto de pagina
$parametros["AUTO_PAGE_BREAK"] = true;

$parametros["PDF_MARGIN_TOP"] = 10;
$parametros["PDF_MARGIN_BOTTOM"] = 10;



$pdf = new TCPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);





// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jose Carlos, Delgado');
$pdf->SetTitle('Generador de Código de Barras');
$pdf->SetSubject('Generador de Código de Barras');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 027', PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins($parametros["PDF_MARGIN_LEFT"], $parametros["PDF_MARGIN_TOP"], $parametros["PDF_MARGIN_RIGHT"]);


//$pdf->SetHeaderMargin($parametros["PDF_MARGIN_HEADER"]);
$pdf->SetFooterMargin($parametros["PDF_MARGIN_FOOTER"]);

$pdf->setPrintHeader($parametros["PRINT_HEADER"]);
$pdf->setPrintFooter($parametros["PRINT_FOOTER"]);


//set auto page breaks
$pdf->SetAutoPageBreak($parametros["AUTO_PAGE_BREAK"], $parametros["PDF_MARGIN_BOTTOM"]);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set a barcode on the page footer
//$pdf->setBarcode(date('Y-m-d H:i:s'));
// set font
$pdf->SetFont('helvetica', '', 0);

// add a page
$pdf->AddPage();

//$pdf->writeHTML($lala, true, 0, true, 0);
//$dataTest = array('letal', '2', '3', '4', '5', '6', 'g','h','a','b','c','d','a','b','c','d','a','b','c','d');

$rangoIni = (int) $rangoIni;
$rangoFin = (int) $rangoFin;
$iCB = 0;
for ($a = $rangoIni; $a <= $rangoFin; $a++) {
    $dataTest[$iCB] = str_pad($a, 9, '0', STR_PAD_LEFT);
    $iCB++;
}


$counter = 0;
$numTablas = 0;
$b = 0;
//$c = 0;

$total = count($dataTest);
$numTablas = (int) ($total / 16);



if ($total % 16 != 0) {
    $numTablas++;
}



switch ($tipoContenedor) {
    case 1:
        $columna = 7;
        $anchoTotal = 700;
        $altura = 8;
        $largo = 0.25;
        $separador = $largo * 100;
        $anchoColumna = $anchoTotal / $columna;
        $tamañoLetra = 3;
        $tamañoImagen = 10;
        $tamañoLetraLaboratorio = 6;
        break;
    case 2:
        $columna = 7;
        $anchoTotal = 700;
        $altura = 8;
        $largo = 0.25;
        $separador = $largo * 100;
        $anchoColumna = $anchoTotal / $columna;
        $tamañoLetra = 4;
        $tamañoImagen = 10;
        $tamañoLetraLaboratorio = 6;
        break;
    case 3:
        $columna = 3;
        $anchoTotal = 545;
        $altura = 20;
        $largo = 0.48;
        $separador = $largo * 100;
        $anchoColumna = $anchoTotal / $columna;
        $tamañoLetra = 5;
        $tamañoImagen = 16;
        $tamañoLetraLaboratorio = 10;
        break;
}


$table.='<table border="1" width="' . $anchoTotal . '">';
$contador = 0;
foreach ($dataTest as $value) {
    $resto = $contador % $columna;
    if ($resto == 0) {
        $table.='<tr>';
    }
    $params = $pdf->serializeTCPDFtagParameters(array($dataTest[$contador], 'C39', '', '', $separador, $altura, $largo, array('position' => 'l', 'border' => false, 'padding' => 1, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => $tamañoLetra, 'stretchtext' => 4), 'N'));
        $table.='<td width="' . $anchoColumna . '">&nbsp;&nbsp;<img src="../../../../fastmedical_front/imagen/logo/logo.jpg" width="' . $tamañoImagen . '"> &nbsp;&nbsp;<B><font size="' . $tamañoLetraLaboratorio . '">LABORATORIO</font></B><br>&nbsp;&nbsp;<tcpdf method="write1DBarcode" params="' . $params . '" /></td>';
    if ($resto == ($columna - 1)) {
        $table.='</tr>';
    }
    $contador++;
}
if ($resto != ($columna - 1)) {
    $table.='</tr>';
}
$table.='</table>';
$pdf->writeHTML($table, true, 0, true, 0);






// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('LETAL.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+