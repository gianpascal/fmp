<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarMYPDF_RECIBODEPAGO {

    function generarMYPDF_RECIBO($atributosRecibo, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros) {

// create new PDF document
        $pdf = new TCPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HMLO');
        $pdf->SetTitle('Recibo de Pago');
        $pdf->SetSubject('HMLO');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
// remove default header/footer
        $pdf->setPrintHeader($parametros["PRINT_HEADER"]);
        $pdf->setPrintFooter($parametros["PRINT_FOOTER"]);
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $pdf->SetMargins($parametros["PDF_MARGIN_LEFT"], $parametros["PDF_MARGIN_TOP"], $parametros["PDF_MARGIN_RIGHT"]);
        $pdf->SetHeaderMargin($parametros["PDF_MARGIN_HEADER"]);
        $pdf->SetFooterMargin($parametros["PDF_MARGIN_FOOTER"]);

//set auto page breaks
        $pdf->SetAutoPageBreak($parametros["AUTO_PAGE_BREAK"], $parametros["PDF_MARGIN_BOTTOM"]);

//set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
//        $pdf->setLanguageArray($l);
// ---------------------------------------------------------
// set font
        $pdf->SetFont('helvetica', 'B', 20);

// add a page
        $pdf->AddPage();
// define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
        //$pdf->Cell(10, 5, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
        //$pdf->write1DBarcode($parametros["CODIGO_DE_BARRAS"], 'C39',68 ,137,70,8, 0.4, $style, 'N');
//        $pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('helvetica', '', 8);
        //======================================================================================================
        $sizeDatos = 6;
        $sizeTitulo = 8;
        $sizeSubtitulo = 6;
        $family = "helvetica";
        $styleNormal = "N";
        $styleNegrita = "B";
        /* =======================================        Obs       ============================================ */
        // width->0, height->1, top->2, left->3, color->4 TipoLetra=>5 EstiloLetra=>6 TamañoLetra=>6
        /* ===================================================================================================== */
        $lblCabecera = array();
//        $lblDetalle=array();
        $lblPie = array();
        $styleCL = array();
        $styleCD = array();
//        $styleDL=array();
//        $styleDD=array();
        $stylePL = array();
        $stylePD = array();
        $o_classGeneral = new classGeneral();
        $o_classGeneral->setLabelCabecera($labelCabecera, $atributosRecibo);
        $o_classGeneral->setLabelPie($labelPie, $atributosRecibo);
        $styleCL = $o_classGeneral->getStyleCL();
        $styleCD = $o_classGeneral->getStyleCD();
        $stylePL = $o_classGeneral->getStylePL();
        $stylePD = $o_classGeneral->getStylePD();
        $lblCabecera = $o_classGeneral->getLblCabecera();
        $lblPie = $o_classGeneral->getLblPie();

        /* ===================================================================================================== */
        /* =====================================   Cabecera   =================================================== */
        if ($modo == 1) {
            foreach ($lblCabecera as $i => $value) {
                $isImg = substr($lblCabecera[$i], -4);
                if ($isImg == ".jpg" || $isImg == ".png" || $isImg == ".gif") {
                    $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/' . $lblCabecera[$i], $styleCL[$i][3], $styleCL[$i][2], $styleCL[$i][0], $styleCL[$i][1], '', '', '', false, 300);
                } else {
                    $color = $styleCL[$i][4];
                    $pdf->SetTextColor($color[0], $color[1], $color[2]);
                    $pdf->SetFont($styleCL[$i][5], $styleCL[$i][6], $styleCL[$i][7]);
                    $pdf->MultiCell($styleCL[$i][0], $styleCL[$i][1], $lblCabecera[$i], 0, 'L', 0, 1, $styleCL[$i][3], $styleCL[$i][2], true);
                }
            }
        }
        $indice = array_keys($datosCabecera);
       // print_r($datosCabecera);
        foreach ($indice as $val => $z) {
            $isImgx = substr($datosCabecera[$z], -4);
            if ($isImgx == ".jpg" || $isImgx == ".png" || $isImgx == ".gif") {
                $pdf->Image($datosCabecera[$z], $styleCD[$val][3], $styleCD[$val][2], $styleCD[$val][0], $styleCD[$val][1], '', '', '', false, 300);
            } else {
                $color = $styleCD[$val][4];
                $pdf->SetTextColor($color[0], $color[1], $color[2]);
                $pdf->SetFont($styleCD[$val][5], $styleCD[$val][6], $styleCD[$val][7]);
                $pdf->MultiCell($styleCD[$val][0], $styleCD[$val][1], $datosCabecera[$z], 0, 'L', 0, 1, $styleCD[$val][3], $styleCD[$val][2], true);
            }
        }
        /* ===================================================================================================== */
        /* =====================================   Fin Cabecera   ============================================== */

//-------------------------- espacio despues de la cabecera --------------------
        //$pdf->writeHTML("<br>", true, false, false, false, '');

 
        /* ===================================================================================================== */
        /* =====================================     Detalle     ========================================== */
        $cantidad = $datosDetalle[0][3];
        $importe = $datosDetalle[0][4];
        $detalle='';
        $cuerpoDetalle = '';
        $findetalle = '</table>';   
        $cabeceraDetalle = '<table align="center" width="230" border="0" cellspacing="1">
                                      <tr>
                                        <td width="150"><strong>Descripcion</strong></td>
                                        <td width="40"><strong>Cantidad</strong></td>
                                        <td width="40"><strong>Importe</strong></td>
                                      </tr>
                                    ';
        if (!empty($datosDetalle)) {
            foreach ($datosDetalle as $i => $value) {
                $cuerpoDetalle.='<tr>
                                        <td width="150">'.$value[0].'</td>
                                        <td width="40">'.$value[1].'</td>
                                        <td width="40">S/. '.$value[2].'</td>
                                       </tr>';
            }
            $detalle = $cabeceraDetalle.$cuerpoDetalle.$findetalle;
            $total = '<table align="center" width="230" border="0" cellspacing="1">
                                      <tr>
                                        <td width="150"></td>
                                        <td width="40">TOTAL</td>
                                        <td width="40">S/. '.$importe.'</td>
                                      </tr>
                                    ';
        }else{
            $cuerpoDetalle.='<table width="230" border="0"><tr><td align="center"><strong>No existe registro</strong></td></tr></table>';
            $detalle = $cabeceraDetalle.$findetalle.$cuerpoDetalle;
        }
        
        
        
        
        $pdf->SetFont($family, $styleNegrita, $sizeTitulo);
        //$pdf->Write(0, 'ANTECEDENTES', '', 0, 'L', true, 0, false, false, 0);
        //$pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
        //$pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->SetFont($family, $styleNormal, $sizeDatos);
        $pdf->writeHTML($detalle, true, false, false, false, 'C');
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->writeHTML($total, true, false, false, false, 'C');
        /* ===================================================================================================== */
        /* =====================================   Fin Detalle   ============================================== */        
        /* ===================================================================================================== */
        /* =====================================     Pie     =================================================== */


         if ($modo == 1) {
            foreach ($lblPie as $i => $value) {
                $isImg = substr($lblPie[$i], -4);
                if ($isImg == ".jpg" || $isImg == ".png" || $isImg == ".gif") {
                    $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/' . $lblPie[$i], $stylePL[$i][3], $stylePL[$i][2], $stylePL[$i][0], $stylePL[$i][1], '', '', '', false, 300);
                } else {
                    $color = $stylePL[$i][4];
                    $pdf->SetTextColor($color[0], $color[1], $color[2]);
                    $pdf->SetFont($stylePL[$i][5], $stylePL[$i][6], $stylePL[$i][7]);
                    $pdf->MultiCell($stylePL[$i][0], $stylePL[$i][1], $lblPie[$i], 0, 'L', 0, 1, $stylePL[$i][3], $stylePL[$i][2], true);
                }
            }
        }
        $indice = array_keys($datosPie);
       // print_r($datosCabecera);
        foreach ($indice as $val => $z) {
            $isImgx = substr($datosPie[$z], -4);
            if ($isImgx == ".jpg" || $isImgx == ".png" || $isImgx == ".gif") {
                $pdf->Image($datosPie[$z], $stylePD[$val][3], $stylePD[$val][2], $stylePD[$val][0], $stylePD[$val][1], '', '', '', false, 300);
            } else {
                $color = $stylePD[$val][4];
                $pdf->SetTextColor($color[0], $color[1], $color[2]);
                $pdf->SetFont($stylePD[$val][5], $stylePD[$val][6], $stylePD[$val][7]);
                $pdf->MultiCell($stylePD[$val][0], $stylePD[$val][1], $datosPie[$z], 0, 'L', 0, 1, $stylePD[$val][3], $stylePD[$val][2], true);
            }
        } 
        /* ===================================================================================================== */
        /* =====================================    Fin Pie    ================================================= */
// -----------------------------------------------------------------------------
//Close and output PDF document
        $pdf->Output($nombreReporte, 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
    }

}

?>
