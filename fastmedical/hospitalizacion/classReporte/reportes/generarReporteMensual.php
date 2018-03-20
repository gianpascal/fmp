<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarReporteMensualMamografias extends TCPDF {

    function generarMYPDF_HC_Completo($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $datos, $parametros, $listaAtenciones) {


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', TRUE);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 023');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', '', 8);
        $sizeDatos = 6;
        $sizeTitulo = 9;
        $sizeSubtitulo = 6;
        $family = "helvetica";
        $styleNormal = "N";
        $styleNegrita = "B";
        $lblCabecera = array();
        $styleCL = array();
        $styleCD = array();
        $o_classGeneral = new classGeneral();
        $o_classGeneral->setLabelCabecera($labelCabecera, $atributosHC);
        $styleCL = $o_classGeneral->getStyleCL();
        $styleCD = $o_classGeneral->getStyleCD();
        $lblCabecera = $o_classGeneral->getLblCabecera();
        require_once "../../clogica/LActoMedico.php";
        $_LActo = new LActoMedico();





        $cabecera = '
            
             <table border="0" width="1000">
                    <tr>
                    <td width="100"><img src="../../../../medifacil_front/imagen/logo/HMLO.jpg" width="90"></td>
                        <td>
                                <table border="0">
                                    <tr>
                                        <td>
                                            <table  border="0"  height="30">
                                                <tr>
                                                    <td align="center"><font size="16">HOSPITAL MUNICIPAL LOS OLIVOS</font></td>
                                                </tr>
                                                 <tr>
                                                    <td align="center"><font size="16">MAMOGRAFIAS DEL '.$datos['p2'].' AL '.$datos['p3'].'</font></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                        </td>
                    </tr>
                </table>
        ';
        $pdf->SetFont($family, $styleNegrita, $sizeTitulo);
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->writeHTML($cabecera, false, false, false, false, '');
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->writeHTML('<br>', true, false, false, false, '');



        $datosmedico = "";
        $x = 0;

        foreach ($arrayHC as $i => $value) {

            $valorDatosPaciente = $_LActo->datospaciente($listaAtenciones[$x][0]);
            $datosPaciente = '';
            foreach ($valorDatosPaciente as $keyPaciente => $valuePaciente) {
                $datosPaciente.='
                 <table>
                    <tr>
                        <td>
                                <table border="0">
                                    <tr>
                                        <td>
                                             <table  border="0"  height="30">
                                                <tr>
                                                    <td width="75"><strong>Numero H.C.:</strong></td>
                                                    <td width="200">' . utf8_encode($valuePaciente[0]) . ' </td>
                                                    <td width="75"><strong>Edad: </strong></td>
                                                    <td width="90">' . utf8_encode($valuePaciente[6].'') . 'años</td>    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0">
                                    <tr>
                                        <td>
                                             <table  border="0"  height="30">
                                                <tr>
                                                    <td width="75"><strong> Paciente:</strong></td>
                                                    <td width="200">' . utf8_encode($valuePaciente[1]) . ' </td>
                                                    <td width="90"><strong>Sexo:</strong></td>
                                                    <td width="75">' . utf8_encode($valuePaciente[2]) . ' </td>  
                                                    <td width="90"><strong>Fecha Nac.:</strong></td>
                                                    <td width="75">' . utf8_encode($valuePaciente[3]) . ' </td>  
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0">
                                    <tr>
                                        <td>
                                             <table  border="0"  height="30">
                                                <tr>
                                                    <td width="75"><strong>DNI:</strong></td>
                                                    <td width="200">' . utf8_encode($valuePaciente[4]) . ' </td>
                                                    <td width="90"> <strong>Direccion:</strong> </td>
                                                    <td width="350">' . utf8_encode($valuePaciente[5]) . ' </td>  
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                        </td>
                    </tr>
                </table>
            ';
            }
            $imprimeMotCon = false;
            $imprimeTriaje = false;
            $imprimeExaMed = false;
            $imprimeDiagnostico = false;
            $imprimeTratamientos = false;
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
            $datosmedico = '
                <table width="700" border="0" cellspacing="1">
                        <tr>
                            <td width="200"><strong>Fecha Atencion: </strong>' . $fechaAtencion . '</td>
                            <td width="200"><strong>Ambiente: </strong>' . $instalacion . '</td>
                            <td width="300"><strong>Medico: </strong>' . $medico . '</td>
                        </tr>
                </table>';
            //===================================   fin   ====================================
            //================================================================================
            //==================================      Examenes      ===========================
            //================================================================================
            $cadenaExamenes = "";
            if ($examenesMedicos != null) {
                foreach ($examenesMedicos as $filaExamen) {
                    $pruebasExamenes = $filaExamen[0];
                    if ($pruebasExamenes != null) {
                        $idPruebaAux = "";
                        $numero = count($pruebasExamenes);
                        $m = 0;
                        $cadenaExamenesAux = "";
                        foreach ($pruebasExamenes as $fila) {
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
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[9] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }

                                case 2: {//varchar
                                        if ($fila[10] != "") {
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[10] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 3: {//datetime
                                        if ($fila[11] != "") {
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[11] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 4: { //decimal
                                        if ($fila[12] != "") {
                                            $cadenaExamenesAux.=' <strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[12] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 5: {//bolean
                                        if ($fila[13] == 1 || $fila[13] == 0) {
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
                                                        $cadenaAuxCombo.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $valorCbo[0] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                                    }
                                                }
                                                $cadenaExamenesAux.=$cadenaAuxCombo;
                                            }
                                        }
                                        break;
                                    }
                                case 7: { //texto
                                        if ($fila[15] != "") {
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . utf8_encode(nl2br($fila[15])) . '&nbsp;&nbsp;&nbsp;&nbsp;';
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
                foreach ($diagnosticos as $y => $valuex) {
                    $cadenaDiagnostico.='<tr><td>' . utf8_encode($diagnosticos[$y][1]) . '</td><td>' . utf8_encode($diagnosticos[$y][2]) . '</td><td>' . utf8_encode($diagnosticos[$y][6]) . '</td></tr>';
                }
                $cadenaDiagnostico.= '</table>';
                $imprimeDiagnostico = true;
            }
            //===================================   fin   ====================================
            //================================================================================






            $pdf->SetFont($family, $styleNormal, $sizeTitulo);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->writeHTML($datosPaciente, false, false, false, false, '');
            $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            $pdf->writeHTML('<br>', true, false, false, false, '');


            $pdf->SetFont($family, $styleNormal, $sizeTitulo);
            $pdf->writeHTML($datosmedico, false, false, false, false, '');
            $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            $pdf->writeHTML('<br>', true, false, false, false, '');

            if ($imprimeExaMed) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'EXAMENES MEDICOS', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 23, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaExamenes, true, false, false, false, '');
            }
            if ($imprimeDiagnostico) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->Write(0, 'DIAGNOSTICO', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', 11, '', 16, 1);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaDiagnostico, true, false, false, false, '');
            }

            if ($x <= (count($arrayHC) - 1)) {
                $x++;
            }
        }



        $pdf->Output('MamografiasMes.pdf', 'I');
    }

}

?>