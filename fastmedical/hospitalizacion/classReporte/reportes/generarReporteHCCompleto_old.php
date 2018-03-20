<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarMYPDFHCCompleto_old {

    function generarMYPDF_HC_Completo_old($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $nombreReporte, $parametros) {

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Consultoría y Asesoría en Tecnología - CONASTEC');
        $pdf->SetTitle($datosCabecera[8] . '_Historia_Clínica');
        $pdf->SetSubject('Historia Clínica');
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
//        $pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('helvetica', '', 8);
        //======================================================================================================
        $sizeDatos = 6;
        $sizeTitulo = 9;
        $sizeSubtitulo = 6;
        $family = "helvetica";
        $styleNormal = "N";
        $styleNegrita = "B";



        /* =======================================        Obs       ============================================ */
        // width->0, height->1, top->2, left->3, color->4 TipoLetra=>5 EstiloLetra=>6 TamañoLetra=>6
        /* ===================================================================================================== */
        $lblCabecera = array();
//        $lblDetalle=array();
//        $lblPie=array();
        $styleCL = array();
        $styleCD = array();
//        $styleDL=array();
//        $styleDD=array();
//        $stylePL=array();
//        $stylePD=array();

        $o_classGeneral = new classGeneral();
        $o_classGeneral->setLabelCabecera($labelCabecera, $atributosHC);
        $styleCL = $o_classGeneral->getStyleCL();
        $styleCD = $o_classGeneral->getStyleCD();
        $lblCabecera = $o_classGeneral->getLblCabecera();
        /* ===================================================================================================== */
        /* ===================================================================================================== */


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
        foreach ($indice as $val => $z) {
            $isImgx = substr($datosCabecera[$z], -4);
            if ($isImgx == ".jpg" || $isImgx == ".png" || $isImgx == ".gif") {
                $pdf->Image($datosCabecera[$z], $styleCD[$i][3], $styleCD[$i][2], $styleCD[$i][0], $styleCD[$i][1], '', '', '', false, 300);
            } else {
                $color = $styleCD[$z][4];
                $pdf->SetTextColor($color[0], $color[1], $color[2]);
                $pdf->SetFont($styleCD[$z][5], $styleCD[$z][6], $styleCD[$z][7]);
                $pdf->MultiCell($styleCD[$z][0], $styleCD[$z][1], $datosCabecera[$z], 0, 'L', 0, 1, $styleCD[$z][3], $styleCD[$z][2], true);
            }
        }
        /* ===================================================================================================== */
        /* =====================================   Fin Cabecera   ============================================== */

//-------------------------- espacio despues de la cabecera --------------------
        $pdf->writeHTML("<br>", true, false, false, false, '');

// -----------------------------------------------------------------------------
        /* ===================================================================================================== */
        /* =====================================     Antecedentes     ========================================== */
        $cadenaAntecedentes = "";
        if ($antecedentes) {
            $fechaAnterior = "";
            $numAntecedente = 0;
            foreach ($antecedentes as $i => $value) {
                $numAntecedente++;
                if ($antecedentes[$i][5] == 1)
                    $vive = "Si";
                else if ($antecedentes[$i][5] == 0)
                    $vive = "No";

                $cadenaAntecedentes.='<table width="700" border="0" cellspacing="1">
                                      <tr>
                                        <td width="40"><strong>' . $numAntecedente . '.</strong></td>
                                        <td width="210"><strong>Parentesco : </strong>' . $antecedentes[$i][7] . '</td>
                                        <td width="80"><strong>Vive : </strong>' . $vive . '</td>
                                        <td width="370"><strong>Sintoma : </strong>' . $antecedentes[$i][2] . ' - ' . $antecedentes[$i][3] . '</td>
                                      </tr>
                                      <tr><td>&nbsp;</td><td colspan="3"><strong>Descripci&oacute;n : </strong>' . utf8_decode($antecedentes[$i][4]) . '</td></tr>
                                    </table>';
            }
        }else
            $cadenaAntecedentes.='<table width="700" border="0" cellspacing="1"><tr><td align="center"><strong>No existe registro de antecedentes</strong></td></tr></table>';

        $pdf->SetFont($family, $styleNegrita, $sizeTitulo);
        $pdf->Write(0, 'ANTECEDENTES', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->SetFont($family, $styleNormal, $sizeDatos);
        $pdf->writeHTML($cadenaAntecedentes, true, false, false, false, '');
        $pdf->writeHTML('<br>', true, false, false, false, '');
        /* ===================================================================================================== */
        /* ===================================================================================================== */

        /* ===================================================================================================== */
        /* =====================================           HC            ======================================= */
        $datosmedico = "";
        foreach ($arrayHC as $i => $value) {
            //----------------------------
            $imprimeMotCon = false;
            $imprimeTriaje = false;
            $imprimeExaMed = false;
            $imprimeDiagnostico = false;
            $imprimeTratamientos = false;
            //----------------------------
            $medicamentoso = null;
            $practicaMedica = null;
            $motivoConsulta = $arrayHC[$i][0];
            $triaje = $arrayHC[$i][1];
            $examenesMedicos = $arrayHC[$i][2];
            $diagnosticos = $arrayHC[$i][3];
            $tratamientos = $arrayHC[$i][4];
            if ($tratamientos != null) {
                $medicamentoso = $tratamientos[0][0];
                $practicaMedica = $tratamientos[0][1];
            }
            $datosMed = $arrayHC[$i][5];
            $fechaAtencion = $arrayHC[$i][6];
            $instalacion = $datosMed[0][8] . " - " . $datosMed[0][7] . " - " . $datosMed[0][6];
            $medico = $datosMed[0][2] . " " . $datosMed[0][3] . " " . $datosMed[0][4];
            $datosmedico = '<table width="700" border="0" cellspacing="1"><tr><td width="100">' . $fechaAtencion . '</td> <td width="300">' . $instalacion . '</td><td width="300">' . $medico . '</td></tr></table>';

            //================================================================================
            //==================================  Motivo Consulta  ===========================
            //================================================================================
            $numMotConsulta = 0;
            $cadenaMotCon = "";
            if ($motivoConsulta != null) {
                foreach ($motivoConsulta as $x => $valuex) {
                    $numMotConsulta++;
                    $cadenaMotCon.='<table width="660" border="0"><tr><td><table width="650" border="0" cellspacing="3">
                                      <tr><td width="15"><strong>' . $numMotConsulta . '.</strong></td><td width="55"><strong>Sintoma :</strong></td><td width="580">' . $motivoConsulta[$x][2] . ' - ' . $motivoConsulta[$x][3] . '</td> </tr>
                                      <tr><td></td><td><strong>Descripci&oacute;n :</strong></td><td>' . $motivoConsulta[$x][4] . '</td></tr>
                                    </table></td></tr></table><br>';
                }
                $imprimeMotCon = true;
            }
            //===================================   fin   ====================================
            //================================================================================
            //================================================================================
            //==================================      Triaje       ===========================
            //================================================================================
            $cadenaTriaje = "";
            if ($triaje != null) {
                $cadenaTriaje.= '<table width="960" border="0" cellspacing="3"><tr><td width="70"></td><td width="860">
                                  <table width="860" border="0" cellspacing="7">
                                  <tr>
                                    <td width="60"><strong>Peso (Kg.) : </strong>' . $triaje[0]["nPeso"] . '</td>
                                    <td width="60"><strong>Talla (m.) : </strong>' . $triaje[0]["nTalla"] . '</td>
                                 
                                    <td width="60"><strong>Temp. (ºC) : </strong>' . $triaje[0]["nTemperatura"] . '</td>
                                    <td width="100"><strong>Frec. Cardiaca (min) : </strong>' . $triaje[0]["iFrecuenciaCardiaca"] . '</td>
                                
                                    <td width="100"><strong>Pres. Arterial (mmHg) : </strong>' . $triaje[0]["vPresionArterial"] . '</td>
                                    <td width="100"><strong>Frec. Respiratoria (min) : </strong>' . $triaje[0]["iFrecuenciaRespiratoria"] . '</td>
                                  <td width="90"><strong>Sat. O2(%) : </strong>' . $triaje[0]["nSaturacionOxigeno"] . '</td><td></td>
                                  </tr>
                                </table>
                                </td><td width="150"></td></tr></table>';
                $imprimeTriaje = true;
            }

            //===================================   fin   ====================================
            //================================================================================
            //================================================================================
            //==================================      Examenes      ===========================
            //================================================================================
            $cadenaExamenes = "";
            if ($examenesMedicos != null) {
                foreach ($examenesMedicos as $filaExamen) {
                    $pruebasExamenes = $filaExamen[0]; //$filaExamen[0]=$datosExamenes
//                    echo $idPrueba.'<br>';
                    //--------------------------------------------------------------------------------------
                    if ($pruebasExamenes != null) {
                        $idPruebaAux = "";
                        $numero = count($pruebasExamenes);
                        $m = 0;
                        $cadenaExamenesAux = "";
                        foreach ($pruebasExamenes as $fila) {
                            //var_dump('<pre>',$fila);
                            $m++;
                            $idPrueba = $fila[1];
//                            echo $idPrueba.'<br>';
                            $nombreCampo = $fila[4];
                            $iiDCombo = $fila[8];
                            if (!($idPrueba == $idPruebaAux)) {
                                $nombrePrueba = $fila[2];
                                if ($m == 1)
                                    $cadenaExamenesAux.='<table width="660" border="1" cellpadding="3" cellspacing="0" ><tr><td height="20" bgcolor="#F8F8F8" align="center"><strong>' . utf8_encode($nombrePrueba) . '</strong></td></tr><tr><td>';
                            }
                            $iIdTipoDato = $fila[5];
                            switch ($iIdTipoDato) {
                                case 1: { //integer
                                        if ($fila[9] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[9] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>'.$fila[9].'&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }

                                case 2: {//varchar
                                        if ($fila[10] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[10] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>'.$fila[10].'&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 3: {//datetime
                                        if ($fila[11] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[11] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>'. $fila[11].'&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 4: { //decimal
                                        if ($fila[12] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[12] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.=' <strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[12].'&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 5: {//bolean
                                        if ($fila[13] == 1 || $fila[13] == 0) {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . '</strong></td>
//                                                    <td width="500">';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>';
                                            if ($fila[13] == '1') {
                                                $cadenaExamenesAux.="si";
                                            } else {
                                                if ($fila[13] == '0') {
                                                    $cadenaExamenesAux.="no";
                                                } else {
                                                    $cadenaExamenesAux.="null";
                                                }
                                            }
                                              $cadenaExamenesAux.='&nbsp;&nbsp;&nbsp;&nbsp;';
//                                            $cadenaExamenesAux.='</td></tr></table>';
                                        }
                                        break;
                                    }
                                case 6: { //combo
                                        require_once "../../clogica/LActoMedico.php";
                                        $_LActo = new LActoMedico();
                                        $iCombo = $fila[14];
                                        if ($iCombo != "") {
                                            $valorCombo = $_LActo->valorComboExamen($iCombo);
                                            $cadenaAuxCombo = "";
                                            if ($valorCombo) {
                                                foreach ($valorCombo as $v => $valorCbo) {
                                                    if ($valorCbo[0] != "") {
//                                                    $cadenaAuxCombo.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $valorCbo[0] . '</td></tr>
//                                                    </table>';
                                                    $cadenaAuxCombo.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>'.$valorCbo[0].'&nbsp;&nbsp;&nbsp;&nbsp;';
                                                    }
                                                }
                                                $cadenaExamenesAux.=$cadenaAuxCombo;
                                            }
                                        }
                                        break;
                                    }
                                case 7: { //texto
                                        if ($fila[15] != "") {
//                                        $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="100"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="550">' . utf8_encode($fila[15]) . '</td></tr>
//                                                    </table>';
                                        $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>'.utf8_encode($fila[15]).'&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                            }

                            if ($m == $numero) {
                                $cadenaExamenesAux.='</td></tr></table>';
                            }
                            $idPruebaAux = $fila[1];
                        }
                        $cadenaExamenes.=$cadenaExamenesAux;
                        //--------------------------------------------------------------------------------------
                    }
                }
                $imprimeExaMed = true;
            }

            //===================================   fin   ====================================
            //================================================================================
            //================================================================================
            //==================================    Diagnóstico    ===========================
            //================================================================================
            $numDiagnostico = 0;
            $cadenaDiagnostico = "";
            if ($diagnosticos != null) { //660
                $cadenaDiagnostico.='<table width="660" border="1" cellpadding="3" cellspacing="0">
                       <tr><td height="20" width="100" bgcolor="#F8F8F8"><strong>C&oacute;digo Cie</strong></td><td width="400" bgcolor="#F8F8F8" align="center"><strong>Descripci&oacute;n</strong></td><td width="160" bgcolor="#F8F8F8" align="center"><strong>Tipo Diagn&oacute;stico</strong></td></tr>';
                foreach ($diagnosticos as $x => $valuex) {
                    $cadenaDiagnostico.='<tr><td>' . utf8_encode($diagnosticos[$x][1]) . '</td><td>' . utf8_encode($diagnosticos[$x][2]) . '</td><td>' . utf8_encode($diagnosticos[$x][6]) . '</td></tr>';
                }
                $cadenaDiagnostico.='<tr><td colspan="3">
                                      <table width="650" border="0">
                                      <tr>
                                      <td width="60"><strong>Observaci&oacute;n :</strong></td>
                                      <td width="590">' . utf8_encode($diagnosticos[0][5]) . '</td>
                                      </tr>
                                      </table></td></tr>';
                $cadenaDiagnostico.= '</table>';
                $imprimeDiagnostico = true;
            }

            //===================================   fin   ====================================
            //================================================================================
            //=============================================================================
            //==================================    Tratamientos    ==========================
            //================================================================================
            $numMedicamentoso = 0;
            $cadenaTratamientos = '';
            $cadenaMedicamentoso = '';
            if ($medicamentoso != null) {
                $cadenaMedicamentoso.='<table width="660" border="1" cellpadding="0" cellspacing="0"><tr><td>
                                        <table width="660" cellpadding="3" cellspacing="0"><tr><td height="20" bgcolor="#F8F8F8" align="center">
                                        <strong>Receta médica</strong></td></tr></table></td></tr><tr><td>';
                $cadenaMedicamentoso.='<table width="660" border="1" cellpadding="3" cellspacing="0">
                                       <tr>
                                            <td width="25" bgcolor="#F8F8F8" align="center"><strong> Nro. </strong></td>
                                            <td width="205"  bgcolor="#F8F8F8" align="center"><strong>Nombre </strong></td>
                                            <td width="100" bgcolor="#F8F8F8" align="center"><strong>Presentaci&oacute;n </strong></td>
                                            <td width="70" bgcolor="#F8F8F8" align="center"><strong>Cantidad </strong></td>
                                            <td width="260" bgcolor="#F8F8F8" align="center"><strong>Observaci&oacute;n </strong></td>
                                       </tr>';
                foreach ($medicamentoso as $x => $valuex) {
                    $numMedicamentoso++;
                    $cadenaMedicamentoso.='<tr>
                                            <td><strong>' . $numMedicamentoso . '.</strong></td>
                                            <td>' . utf8_encode($medicamentoso[$x][2]) . '</td>
                                            <td>' . utf8_encode($medicamentoso[$x][5]) . '</td>
                                            <td align="center">' . utf8_encode($medicamentoso[$x][3]) . '</td>
                                            <td>' . utf8_encode($medicamentoso[$x][4]) . '</td>
                                          </tr>';
                }
                $cadenaMedicamentoso.='</table>';
                $cadenaMedicamentoso.='</td></tr></table>';
                $imprimeTratamientos = true;
            }

            $numPracticaMedica = 0;
            $cadenaPracticaMedica = '';
            if ($practicaMedica != null) {
                $cadenaPracticaMedica.='<table width="660" border="1" cellpadding="0" cellspacing="0"><tr><td>
                 <table width="660" cellpadding="3" cellspacing="0"><tr><td height="20" bgcolor="#F8F8F8" align="center">
                 <strong>Procedimientos médicos</strong></td></tr></table></td></tr><tr><td>';
                $cadenaPracticaMedica.='<table width="660" border="1" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td width="25" bgcolor="#F8F8F8" align="center"><strong> Nro. </strong></td>
                                            <td width="205" bgcolor="#F8F8F8" align="center"><strong>Nombre </strong></td>
                                            <td width="80"bgcolor="#F8F8F8" align="center"><strong>Codigo Seg </strong></td>
                                            <td width="350" bgcolor="#F8F8F8" align="center"><strong>Observaci&oacute;n </strong></td>
                                        </tr>';
                foreach ($practicaMedica as $x => $valuex) {
                    $numPracticaMedica++;
//                    $cadenaPracticaMedica.='<table width="660" border="0" cellpadding="0" cellspacing="0"><tr><td>';
//                    $cadenaPracticaMedica.='<table width="660" border="0" cellpadding="0" cellspacing="3">
                    $cadenaPracticaMedica.='<tr>
                                                <td><strong>' . $numPracticaMedica . '.</strong></td>
                                                <td>' . utf8_encode($practicaMedica[$x][2]) . '</td>
                                                <td>' . utf8_encode($practicaMedica[$x][5]) . '</td>
                                                <td>' . utf8_encode($practicaMedica[$x][3]) . '</td>
                                              </tr>';
//                                        </table>';
//                    $cadenaPracticaMedica.='</td></tr></table>';
                }
                $cadenaPracticaMedica.='</table>';
                $cadenaPracticaMedica.='</td></tr></table>';
                $imprimeTratamientos = true;
            }
            if ($cadenaMedicamentoso != '' || $cadenaPracticaMedica != '')
                $cadenaTratamientos.=$cadenaMedicamentoso . '<br><br>' . $cadenaPracticaMedica;
            else if ($cadenaMedicamentoso != '')
                $cadenaTratamientos.=$cadenaPracticaMedica;
            else if ($cadenaPracticaMedica != '')
                $cadenaTratamientos.=$cadenaMedicamentoso;

            //===================================   fin   ====================================
            //================================================================================
            //--------------------------------------------------------------------------------
            $pdf->SetFont($family, $styleNegrita, $sizeTitulo);
            $pdf->writeHTML($datosmedico, false, false, false, false, '');
            $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            //--------------------------------------------------------------------------------
            if ($imprimeMotCon) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'MOTIVO DE CONSULTA', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 25, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaMotCon, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeTriaje) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'TRIAJE', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 8, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaTriaje, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeExaMed) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'EXAMENES MEDICOS', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 23, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaExamenes, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeDiagnostico) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'DIAGNOSTICO', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 16, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaDiagnostico, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeTratamientos) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'TRATAMIENTOS', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 18, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaTratamientos, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
        }

        /* ===================================================================================================== */
        /* ===================================================================================================== */

// -----------------------------------------------------------------------------
//Close and output PDF document
        $pdf->Output($nombreReporte, 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
    }

}

?>