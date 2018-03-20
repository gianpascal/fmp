<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');
try {

    class MYPDF extends TCPDF {

        public function CargarDatos($lblCabecera, $lblDetalle, $lblPie, $datosCabecera, $datosDetalle, $datosExamen, $datosExamenUni, $datosGrupo, $datosPie, $styleCL, $styleDL, $stylePL, $styleCD, $styleDD, $stylePD, $modo) {

            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(95, 17, 147);
            $family = "helvetica";
            $styleNormal = "N";
            $sizeTitulo = 8;
            if (is_array($lblCabecera) && !empty($lblCabecera) && $modo == 1) {
                foreach ($lblCabecera as $i => $value) {
                    $isImg = end(explode(".", $value));
                    if ($isImg == "jpg" || $isImg == "png" || $isImg == "gif") {
                        $filename = '../../../tcPDF/tcpdf/tcpdf/images/' . $lblCabecera[$i];
                        if (file_exists($filename))
                            $this->Image($filename, $styleCL[$i][3], $styleCL[$i][2], $styleCL[$i][0], $styleCL[$i][1], '', '', '', false, 300);
                    }
                    else {
                        $color = $styleCL[$i][4];
                        $this->SetTextColor($color[0], $color[1], $color[2]);
                        $this->SetFont($styleCL[$i][5], $styleCL[$i][6], $styleCL[$i][7]);
                        $this->MultiCell($styleCL[$i][0], $styleCL[$i][1], $lblCabecera[$i], 0, 'L', 0, 1, $styleCL[$i][3], $styleCL[$i][2], true);
                    }
                }
            }
            if (is_array($datosCabecera) && !empty($datosCabecera)) {
                $indice = array_keys($datosCabecera);
                foreach ($indice as $value => $z) {
                    $color = $styleCD[$z][4];
                    $this->SetTextColor($color[0], $color[1], $color[2]);
                    $this->SetFont($styleCD[$z][5], $styleCD[$z][6], $styleCD[$z][7]);
                    $this->MultiCell($styleCD[$z][0], $styleCD[$z][1], $datosCabecera[$z], 0, 'L', 0, 1, $styleCD[$z][3], $styleCD[$z][2], true);
                }
            }
            $cadenaPeche = '';
            foreach ($datosGrupo as $key => $value1) {
                $cadenaPeche.='<br><b>GRUPO Nro. ' . ($key + 1) . ' ' . $value1[0] . '</b><br><br>';
                $cadenaPeche.='<table border="1" CellPadding="0" cellspacing="0" width="700" align="center">
                        <tr  bgcolor="#6B7B86" color="white">
                            <td width="150" align="center"><B><font size="8">ITEM</font></B></td>
                            <td width="50" align="center"><B><font size="8">RESULT.</font></B></td>
                            <td width="100" align="center"><B><font size="8">UNIDAD</font></B></td>
                            <td width="400" align="center"><B><font size="8">RANGO</font></B></td>
                        </tr>
                        </table>';
                $cadenaPeche.='
                            <table border="1" CellPadding="0" cellspacing="0" width="400" align="center">
                                <tr>
                                <td width="150" align="center" bgcolor="white"></td>
                                <td width="50" align="center"  bgcolor="white"></td>
                                <td width="100" align="center" bgcolor="white"></td>
                                <td width="100" align="center" bgcolor="#D4D0C8"><font size="6">Edad</font></td>
                                <td width="100" align="center" bgcolor="#D4D0C8"><font size="6">Sexo</font></td>
                                <td width="100" align="center" bgcolor="#D4D0C8"><font size="6">Rango</font></td>
                                <td width="100" align="center" bgcolor="#D4D0C8"><font size="6">Significado</font></td>
                                </tr>
                            </table>';

                foreach ($datosExamenUni as $key => $value2) {
                    if ($value1[1] == $value2[2]) {
                        $rangos = ' &#60; R &#60; ';
                        $edad = ' &#60; Edad &#60; ';
                        $cadenaPeche.='
                                <table border="1" CellPadding="0" cellspacing="0" width="400" align="center">
                                <tr>
                                <td width="150" align="center"><font size="6">' . $value2[0] . '</font></td>
                                <td width="50" align="center"><font size="6">';
                        switch ($value2[4]) {
                            case '1': {
                                    $imprimirResultado = $value2[6];
                                    break;
                                }
                            case '2': {
                                    $imprimirResultado = $value2[8];
                                    break;
                                }
                            case '4': {
                                    $imprimirResultado = $value2[7];
                                    break;
                                }
                            case '5' : {
                                    $imprimirResultado = $value2[9];
                                    break;
                                }
                            case '6': {

                                    $imprimirResultado = $value2[11];
                                    break;
                                }
                        }
                        $cadenaPeche.=$imprimirResultado . '</font></td>
                                <td width="100" align="center"><font size="6">' . $value2[3] . '</font></td>
                                <td width="400" align="center"><font size="6"></font>';
                        foreach ($datosExamen as $key => $value) {
                            if ($value2[0] == $value[3]) {
                                $cadenaPeche.='<table><tr> <td width="100" align="center"><font size="6">';
                                if ($value[16] == 1) {
                                    $edades = $value[18] . $edad . $value[19];
                                }
                                $cadenaPeche.=$edades . '</font></td>
                                <td width="90" align="center"><font size="6">';
                                if ($value[15] == 1) {
                                    $sexoes = $value[17];
                                }
                                $cadenaPeche.=$sexoes . '</font></td>
                                <td width="100" align="center"><font size="6">';
                                if ($value[20] == null && $value[21] == null) {
                                    
                                } else {
                                    $rangosre = $value[20] . $rangos . $value[21];
                                }
                                $cadenaPeche.=$rangosre . '</font></td>
                                <td width="100" align="center"><font size="6">' . $value[22] . '</font></td>
                               </tr></table>';
                            }
                        }
                        $cadenaPeche.='</td>
                                </tr>
                                </table>';
                    }
                }
            }


            $firma1.='______________________';
            $firma2.='Firma y Sello';
            $this->SetFont($family, $styleNormal, $sizeTitulo);
            $this->writeHTML('<br>', true, false, false, false, '');
            $this->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 196, 1);
            $this->writeHTML('<br>', true, false, false, false, '');
            $this->writeHTML($cadenaPeche, true, false, false, false, 'center');
            $this->MultiCell(0, 0, $firma1, 0, 'L', 0, 1, 150, 260, true);
            $this->MultiCell(0, 0, $firma2, 0, 'L', 0, 1, 158, 265, true);


            if (is_array($lblPie) && !empty($lblPie) && $modo == 1) {
                foreach ($lblPie as $i => $value) {
                    $color = $stylePL[$i][4];
                    $this->SetTextColor($color[0], $color[1], $color[2]);
                    $this->SetFont($stylePL[$i][5], $stylePL[$i][6], $stylePL[$i][7]);
                    $this->MultiCell($stylePL[$i][0], $stylePL[$i][1], $lblPie[$i], 0, 'L', 0, 1, $stylePL[$i][3], $stylePL[$i][2], true);
                }
            }
            if (is_array($datosPie) && !empty($datosPie)) {
                foreach ($datosPie as $i => $value) {
                    $color = $stylePD[$i][4];
                    $this->SetTextColor($color[0], $color[1], $color[2]);
                    $this->SetFont($stylePD[$i][5], $stylePD[$i][6], $stylePD[$i][7]);
                    $this->MultiCell($stylePD[$i][0], $stylePD[$i][1], $datosPie[$i], 0, 'L', 0, 1, $stylePD[$i][3], $stylePD[$i][2], true);
                }
            }
        }

    }

    class LabPluginMYPDF {

        public function generarReporte($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosExamen, $datosExamenUni, $datosGrupo, $datosPie, $modo, $nombreReceta, $parametros) {
            $lblCabecera = array();
            $lblDetalle = array();
            $lblPie = array();
            $styleCL = array();
            $styleCD = array();
            $styleDL = array();
            $styleDD = array();
            $stylePL = array();
            $stylePD = array();
            $o_classGeneral = new classGeneral();
            $o_classGeneral->setLabelCabecera($labelCabecera, $atributosReceta);
            $styleCL = $o_classGeneral->getStyleCL();
            $styleCD = $o_classGeneral->getStyleCD();
            $lblCabecera = $o_classGeneral->getLblCabecera();
            $o_classGeneral->setLabelDetalle($labelDetalle, $atributosReceta);
            $styleDL = $o_classGeneral->getStyleDL();
            $styleDD = $o_classGeneral->getStyleDD();
            $lblDetalle = $o_classGeneral->getLblDetalle();
            $o_classGeneral->setLabelPie($labelPie, $atributosReceta);
            $stylePL = $o_classGeneral->getStylePL();
            $stylePD = $o_classGeneral->getStylePD();
            $lblPie = $o_classGeneral->getLblPie();
            $pdf = new MYPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Juan Carlos Ludeña Montesinos');
            $pdf->SetTitle('Generardor de Reportes');
            $pdf->SetSubject('Generardor de Reportes');
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->setPrintHeader($parametros["PRINT_HEADER"]);
            $pdf->setPrintFooter($parametros["PRINT_FOOTER"]);
            $pdf->SetMargins($parametros["PDF_MARGIN_LEFT"], $parametros["PDF_MARGIN_TOP"], $parametros["PDF_MARGIN_RIGHT"]);
            $pdf->SetHeaderMargin($parametros["PDF_MARGIN_HEADER"]);
            $pdf->SetFooterMargin($parametros["PDF_MARGIN_FOOTER"]);
            $pdf->SetAutoPageBreak($parametros["AUTO_PAGE_BREAK"], $parametros["PDF_MARGIN_BOTTOM"]);
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->SetFont('helvetica', '', 6);
            $pdf->AddPage();
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
            $pdf->write1DBarcode($parametros["CODIGO_DE_BARRAS"], 'C39', 75, 278, 70, 8, 0.4, $style, 'N');
            $pdf->CargarDatos($lblCabecera, $lblDetalle, $lblPie, $datosCabecera, $datosDetalle, $datosExamen, $datosExamenUni, $datosGrupo, $datosPie, $styleCL, $styleDL, $stylePL, $styleCD, $styleDD, $stylePD, $modo);
            $pdf->lastPage();
            $pdf->Output($nombreReceta, 'I');
        }

    }

} catch (Exception $e) {
    echo $e->getMessage();
}

