<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');
try {

// extend TCPF with custom functions
    class MYPDF extends TCPDF {

        // Colored table
        public function ColoredTable($lblCabecera, $lblDetalle, $lblPie, $datosCabecera, $datosDetalle, $datosPie, $styleCL, $styleDL, $stylePL, $styleCD, $styleDD, $stylePD, $modo) {

            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(95, 17, 147);


            /* ===================================================================================================== */
            /* =====================================   Cabecera   =================================================== */
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
                foreach ($indice as $val => $z) {
                    $color = $styleCD[$z][4];
                    $this->SetTextColor($color[0], $color[1], $color[2]);
                    $this->SetFont($styleCD[$z][5], $styleCD[$z][6], $styleCD[$z][7]);
                    $this->MultiCell($styleCD[$z][0], $styleCD[$z][1], $datosCabecera[$z], 0, 'L', 0, 1, $styleCD[$z][3], $styleCD[$z][2], true);
                }
            }
            /* ===================================================================================================== */
            /* =====================================   Fin Cabecera   ============================================== */


            /* ===================================================================================================== */
            /* =====================================   Detalle   =================================================== */

           

            if (is_array($datosDetalle) && !empty($datosDetalle)) {
                $numLabel = count($datosDetalle[0]); //calcula el numero de columnas de la matriz $datosDetalle
                foreach ($datosDetalle as $i => $value) {

                    if (is_array($lblDetalle) && !empty($lblDetalle) && $modo == 1) {
                        foreach ($lblDetalle as $j => $value) {
                            $color = $styleDL[$i][4];
                            $this->SetTextColor($color[0], $color[1], $color[2]);
                            $this->SetFont($styleDL[$j][5], $styleDL[$j][6], $styleDL[$j][7]);
                            $this->MultiCell($styleDL[$j][0], $styleDL[$j][1], $lblDetalle[$j], 0, 'L', 0, 1, $styleDL[$j][3], $styleDL[$j][2] + $y, true);
                        }
                    }
                    for ($k = 0; $k < $numLabel; $k++) {
                        $color = $styleDD[$k][4];
                        $this->SetTextColor($color[0], $color[1], $color[2]);
                        $this->SetFont($styleDD[$k][5], $styleDD[$k][6], $styleDD[$k][7]);
                        $this->MultiCell($styleDD[$k][0], $styleDD[$k][1], $datosDetalle[$i][$k], 0, 'L', 0, 1, $styleDD[$k][3], $styleDD[$k][2] + $y, true,2);
                    }
                    $y = $y + 10;
                }

            }

            /* ===================================================================================================== */
            /* =====================================  Fin Detalle  ================================================= */

            /* ===================================================================================================== */
            /* =====================================     Pie     =================================================== */
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

    class PluginMYPDF {

        public function generarMYPDF($atributosReceta, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReceta, $parametros) {
            /* =======================================        Obs       ============================================ */
            // width->0, height->1, top->2, left->3, color->4 TipoLetra=>5 EstiloLetra=>6 TamañoLetra=>6
            /* ===================================================================================================== */
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
            /* ====================================================================================================== */

            // create new PDF document  //PDF_PAGE_ORIENTATION(P,L)
            $pdf = new MYPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Juan Carlos Ludeña Montesinos');
            $pdf->SetTitle('Generardor de Reportes');
            $pdf->SetSubject('Generardor de Reportes');
            //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            // set default header data
            //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            // remove default header/footer
            $pdf->setPrintHeader($parametros["PRINT_HEADER"]);
            $pdf->setPrintFooter($parametros["PRINT_FOOTER"]);
            //set margins
            $pdf->SetMargins($parametros["PDF_MARGIN_LEFT"], $parametros["PDF_MARGIN_TOP"], $parametros["PDF_MARGIN_RIGHT"]);
            $pdf->SetHeaderMargin($parametros["PDF_MARGIN_HEADER"]);
            $pdf->SetFooterMargin($parametros["PDF_MARGIN_FOOTER"]);

            //set auto page breaks
            $pdf->SetAutoPageBreak($parametros["AUTO_PAGE_BREAK"], $parametros["PDF_MARGIN_BOTTOM"]);

            //set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //set some language-dependent strings
            //$pdf->setLanguageArray($l);
            // ---------------------------------------------------------
            // set font
            $pdf->SetFont('helvetica', '', 6);

            // add a page
            $pdf->AddPage();
            //Data loading
            // print colored table

            $pdf->ColoredTable($lblCabecera, $lblDetalle, $lblPie, $datosCabecera, $datosDetalle, $datosPie, $styleCL, $styleDL, $stylePL, $styleCD, $styleDD, $stylePD, $modo);

            $pdf->lastPage();
            // ---------------------------------------------------------
            //Close and output PDF document
            $pdf->Output($nombreReceta, 'I');
            //$pdf->extractCSSproperties();
            //============================================================+
            // END OF FILE
            //============================================================+
        }

    }

} catch (Exception $e) {
    echo $e->getMessage();
}

