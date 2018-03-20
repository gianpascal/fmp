<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarMYPDFRMECARNET {

//    function generarMYPDF_CARNET_SANIDAD($atributosReceta, $labelCabecera, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros) {
    function generarMYPDF_CARNET_SANIDAD($datosCabecera, $modo, $nombreReporte, $parametros, $labelCabecera, $atributosRecibo) {

// create new PDF document
        $pdf = new TCPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HMLO');
//        $pdf->SetTitle('Receta medica estandarizada');
        $pdf->SetSubject('HMLO');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
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
//        $pdf->write1DBarcode($parametros["CODIGO_DE_BARRAS"], 'C39', 68, 137, 70, 8, 0.4, $style, 'N');
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
//        $o_classGeneral->setLabelPie($labelPie, $atributosReceta);
        $styleCL = $o_classGeneral->getStyleCL();
        $styleCD = $o_classGeneral->getStyleCD();
        $stylePL = $o_classGeneral->getStylePL();
        $stylePD = $o_classGeneral->getStylePD();
        $lblCabecera = $o_classGeneral->getLblCabecera();
        $lblPie = $o_classGeneral->getLblPie();
        /* ===================================================================================================== */
        /* ===================================================================================================== */

        /* ===================================================================================================== */
        /* =====================================   Cabecera   =================================================== */
        if (is_array($lblCabecera) && !empty($lblCabecera) && $modo == 1) {
            foreach ($lblCabecera as $i => $value) {
                $isImg = end(explode(".", $value));
                if ($isImg == "jpg" || $isImg == "png" || $isImg == "gif") {
                    $filename = '../../../tcPDF/tcpdf/tcpdf/images/' . $lblCabecera[$i];
                    if (file_exists($filename))
                        $pdf->Image($filename, $styleCL[$i][3], $styleCL[$i][2], $styleCL[$i][0], $styleCL[$i][1], '', '', '', false, 100);
                }
                else {
                    $color = $styleCL[$i][4];
                    $pdf->SetTextColor($color[0], $color[1], $color[2]);
                    $pdf->SetFont($styleCL[$i][5], $styleCL[$i][6], $styleCL[$i][7]);
                    $pdf->MultiCell($styleCL[$i][0], $styleCL[$i][1], $lblCabecera[$i], 0, 'L', 0, 1, $styleCL[$i][3], $styleCL[$i][2], true);
                }
            }
        }
//
//         $indice = array_keys($datosCabecera);
//        foreach ($indice as $val => $i) {
////            $isImgx = substr($datosCabecera[$z], -4);
////            if ($isImgx == ".jpg" || $isImgx == ".png" || $isImgx == ".gif") {
//                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/img.png', $styleCD[$i][3], $styleCD[$i][2], $styleCD[$i][0], $styleCD[$i][1], '', '', '', false, 300);
////            }
////             else {
////                $color = $styleCD[$z][4];
////                $pdf->SetTextColor($color[0], $color[1], $color[2]);
////                $pdf->SetFont($styleCD[$z][5], $styleCD[$z][6], $styleCD[$z][7]);
////                $pdf->MultiCell($styleCD[$z][0], $styleCD[$z][1], $datosCabecera[$z], 0, 'L', 0, 1, $styleCD[$z][3], $styleCD[$z][2], true);
////            }
//        }

        /* ===================================================================================================== */
        /* =====================================   Fin Cabecera   ============================================== */

        /* ===============================    espacio despues de la cabecera    ================================ */
        //$pdf->writeHTML("<br>", true, false, false, false, '');
        /* ===================================================================================================== */

        /* ===================================================================================================== */
        /* =====================================     Antecedentes     ========================================== */
//        $RP = '<table width="700" border="0" cellpadding="4" cellspacing="0" bgcolor="#ffffff">
//            <tr>
//                <td>RP</td>
//            </tr>    
//            </table>';
//        $cadenaAntecedentes = $RP . '<table width="700" border="1" cellpadding="3" cellspacing="0" bgcolor="#ffffff">
//                                <tr>
//                                    <td rowspan="2" width="25" align="center"><strong>Nro</strong></td>
//                                    <td rowspan="2" align="center" width="290"><strong>Medicamento o Insumo</strong><br/>
//                                    <strong>( obligatorio DCI )    /   Concentración</strong></td>
//                                    <td rowspan="2" align="center" width="80"><strong>Forma Farmaceutica</strong></td>
//                                    <td rowspan="2" align="center" width="50"><strong>Cantidad Prescrito</strong></td>
//                                    <td colspan="4" align="center" width="260"><strong>INDICACIONES</strong></td>
//                                    </tr>
//                                    <tr>
//                                    <td align="center"><strong>Dosis</strong></td>
//                                    <td align="center"><strong>Frecuencia</strong></td>
//                                    <td align="center"><strong>Via Administ.</strong></td>
//                                    <td align="center"><strong>Duraci&oacute;n Tratamiento</strong></td>
//                                  </tr>';
////        $orden = 0;
////        foreach ($datosDetalle as $key => $value) {
////            $orden++;
////            $cadenaAntecedentes.='<tr>
////                                    <td><strong>' . $orden . '.</strong></td>
////                                    <td>' . utf8_encode($value[0]) . '</td>
////                                    <td>' . utf8_encode($value[1]) . '</td>
////                                    <td>' . utf8_encode($value[2]) . '</td>
////                                    <td colspan="4">' . utf8_encode($value[3]) . '</td>
////                                  </tr>';
////        }
//        $cadenaAntecedentes.='</table><br>';cellspacing="3" cellpadding="0"
        $cadenaAntecedentes.='<br><br><br><br>';
        $cadenaAntecedentes.='<table><tr><td width="80px">';
        $cadenaAntecedentes.= '<img width="80px" height="106px" align="left" src="../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/'.$datosCabecera[3].'.JPG"/>';
//         $cadenaAntecedentes.="sssssssssssssssssss"    ;                                                            
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '<td>';

        $cadenaAntecedentes.= '<br><br><br>';
        $cadenaAntecedentes.='<table border="1" >';
        $cadenaAntecedentes.='<tr><td width="120px">';
        $cadenaAntecedentes.='&nbsp;<b> '.$datosCabecera[4].'</b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.= '<tr>';
        $cadenaAntecedentes.= '<td >';
        $cadenaAntecedentes.='&nbsp;  '. $datosCabecera[5];
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.= '<tr>';
        $cadenaAntecedentes.= '<td >';
        $cadenaAntecedentes.='&nbsp; DNI:  ' . $datosCabecera[0];
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.= '<tr>';
        $cadenaAntecedentes.= '<td >';
        $cadenaAntecedentes.= '&nbsp;&nbsp; <b>'.$datosCabecera[2].'</b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.= '<tr>';
        $cadenaAntecedentes.= '<td >';

        $cadenaAntecedentes.='<table border="1" >';
        $cadenaAntecedentes.='<tr><td width="60px">';
        $cadenaAntecedentes.='<b> Vigencia: </b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '<td>';
        $cadenaAntecedentes.='<b>'.$datosCabecera[6].'</b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.='<tr><td width="60px">';
        $cadenaAntecedentes.='<b> Al: </b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '<td>';
        $cadenaAntecedentes.='<b>'.$datosCabecera[7].'</b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';
        $cadenaAntecedentes.= '</table>';

        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';



        $cadenaAntecedentes.= '</table>';

        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '<td >';
        $cadenaAntecedentes.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>' . $datosCabecera[3].'</b>';
        $cadenaAntecedentes.= '</td>';
        $cadenaAntecedentes.= '</tr>';

        $cadenaAntecedentes.= '</table>';
        //echo $cadenaAntecedentes;
        $pdf->writeHTML('<br>', true, false, false, false, '');
//        $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 100, 1);
        $pdf->SetFont($family, $styleNormal, $sizeTitulo);
        $pdf->writeHTML($cadenaAntecedentes, true, false, false, false, '');
        /* ===================================================================================================== */
        /* ===================================================================================================== */

        /* ===================================================================================================== */
        /* =====================================     Pie     =================================================== */
//        if (is_array($lblPie) && !empty($lblPie) && $modo == 1) {
//            foreach ($lblPie as $i => $value) {
//                $color = $stylePL[$i][4];
//                $pdf->SetTextColor($color[0], $color[1], $color[2]);
//                $pdf->SetFont($stylePL[$i][5], $stylePL[$i][6], $stylePL[$i][7]);
//                $pdf->MultiCell($stylePL[$i][0], $stylePL[$i][1], $lblPie[$i], 0, 'L', 0, 1, $stylePL[$i][3], $stylePL[$i][2], true);
//            }
//        }
//        if (is_array($datosPie) && !empty($datosPie)) {
//            foreach ($datosPie as $i => $value) {
//                $color = $stylePD[$i][4];
//                $pdf->SetTextColor($color[0], $color[1], $color[2]);
//                $pdf->SetFont($stylePD[$i][5], $stylePD[$i][6], $stylePD[$i][7]);
//                $pdf->MultiCell($stylePD[$i][0], $stylePD[$i][1], $datosPie[$i], 0, 'L', 0, 1, $stylePD[$i][3], $stylePD[$i][2], true);
//            }
//        }

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
