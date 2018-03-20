<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarMYPDFHC extends TCPDF {

    function generarMYPDF_HC($atributosHC, $labelCabecera, $datosCabecera, $datosPie, $antecedentes, $arrayHC, $modo, $nombreReporte, $parametros, $historiaOdontograma, $nroPlaca,$idPrograma) {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', TRUE);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Angel Augusto Sayes');
        $pdf->SetTitle('Historia Clinica Atención');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, 20);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('HelveticaB', 'B', 20);

        $pdf->AddPage();

        $pdf->SetFont('Helvetica', '', 12);
        $sizeDatos = 12;
        $sizeTitulo = 12;
        $sizeSubtitulo = 12;
        $family = "Helvetica";
        $styleNormal = "N";
        $styleNegrita = "B";


        ///////////////////////////////////INICIO CABECERA///////////////////////////////////     
        $cabeceraReporte.='
                 <table>
                    <tr>
                        <td>
                                <table border="0">
                                    <tr>
                                        <td>
                                             <table  border="0"  height="30">
                                                <tr>
   
                                                    <td width="80"><strong>Paciente:</strong></td>
                                                    <td width="290">' . utf8_encode($datosCabecera[2]) . ' </td>
                                                    
                                                   
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
                                                    <td width="100"><strong>Número H.C.:</strong></td>
                                                    <td width="100">' . utf8_encode($datosCabecera[4]) . ' </td>
                                                    
                                                    
                                                   
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
                                                      <td width="120"><strong>Hora Atencion:</strong></td>
                                                    <td width="100">' . utf8_encode($datosCabecera[10]) . '</td>
                                                        <td width="50"><strong>Edad: </strong></td>
                                                    <td width="150">' . ($datosCabecera[3] . '') . '</td>
                                                     <td width="80"><strong>Afiliacion:</strong></td>
                                                    <td width="200">' . utf8_encode($datosCabecera[11]) . '</td>
                                                    
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
                                                    <td width="80"><strong>Servicio:</strong> </td>
                                                    <td width="500">' . utf8_encode($datosCabecera[6]) . " - " . utf8_encode($datosCabecera[5]) . ' </td>  
                                                      
                                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                        </td>
                    </tr>
                </table>
            ';


        /////////////////////////////////// FIN CABECERA///////////////////////////////////
        /////////////////////////////////// IMPRESION REPORTE ////////////////////////////
       // $pdf->Image('../../../../medifacil_front/imagen/logo/membrete.jpg', '', '', 190, "auto");
        $pdf->writeHTML('<br><br><br><br><br><br><br><br>', true, true, true, true, 'a');
        $pdf->writeHTML($cabeceraReporte, true, true, true, true, 'a');





        $medicoFIrma = $datosCabecera[8];

        // print_r($historiaOdontograma);
		
        if ($historiaOdontograma) {
            $pdf->writeHTML('<br><br>', true, false, false, false, '');
            $pdf->Write(0, 'ODONTOGRAMA', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            $ancho = 180;
            $alto = 90;
            $xPrincipal = 15;
            $yPrincipal = 60;
		    
           // $pdf->Image('../../../../medifacil_front/imagen/odontograma/odontograma.png', $xPrincipal, $yPrincipal, $ancho, $alto, '', '', '', true, 100);
         //   $pdf->writeHTML('<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>', true, false, false, false, '');
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->SetFont($family, $styleNormal, $sizeDatos);
            $contador = count($historiaOdontograma);
            $cadenHistoriaOdontograma = '';
            for ($x = 0; $x <= $contador - 1; $x++) {
                $cadenHistoriaOdontograma.='
                <br><table style="border-bottom:1px inset;" width="660" cellpadding="0" cellspacing="0">
                        <tr>
                            <td bgcolor="#F8F8F8"><font size="10"><b>' . utf8_encode($historiaOdontograma[$x][0]) . ' :</b></font></td>
                        </tr>      
                </table>';
                $cadena = '';
                for ($y = 3; $y <= 8; $y++) {
                    $cadena.= $historiaOdontograma[$x][$y] . ' ';
                }


                if ($historiaOdontograma[$x][12] != 'Sin Imagen') {
                    $imagen = "Con Imagen";
                } else {
                    $imagen = $historiaOdontograma[$x][12];
                }
                $cadenHistoriaOdontograma.='
                <br><table border="0" width="675" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><font size="8"><b>Diente 1: </b><table border="1" width="60" align="center"><tr><td>' . utf8_encode($historiaOdontograma[$x][1]) . '</td></tr></table></font></td>
                            <td><font size="8"><b>Tercero: </b><table border="1" width="60" align="center"><tr><td>' . utf8_encode($historiaOdontograma[$x][10]) . '</td></tr></table></font></td>
                            <td><font size="8"><b>Caras: </b></font>' . utf8_encode($cadena) . '</td> 
                        </tr>
                         <tr>
                            <td><font size="8"><b>Diente 2: </b><table border="1" width="60" align="center"><tr><td>' . utf8_encode($historiaOdontograma[$x][2]) . '</td></tr></table></font></td>
                            <td><font size="8"><b>Estado: </b><table border="1" width="60" align="center"><tr><td>' . utf8_encode($historiaOdontograma[$x][11]) . '</td></tr></table></font></td>
                         <td><font size="8"><b>Observacion: </b></font>' . utf8_encode($historiaOdontograma[$x][9]) . '</td> 
                        </tr>
                </table>';
            }
			
            $pdf->writeHTML($cadenHistoriaOdontograma, true, false, false, false, '');
            $pdf->writeHTML('<br>', true, false, false, false, '');
        }

       
        

        if ($nroPlaca[0][9]) {
            $cadenaPlaca.='
                <table width="200" border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <td bgcolor="#F8F8F8" align="center" height="20"><strong>Placa</strong></td>
                            <td bgcolor="#F8F8F8" align="center" height="20"><strong>' . $nroPlaca[0][9] . '</strong></td>
                        </tr>
                        ';


            $cadenaPlaca.='</table>';
            $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->Write(0, 'NRO. PLACA', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->SetFont($family, $styleNormal, $sizeDatos);
            $pdf->writeHTML($cadenaPlaca, true, false, false, false, '');
        }

        if (utf8_decode($datosCabecera[12]) == '0002') {
            require_once "../../clogica/LActoMedico.php";
            $_LActo = new LActoMedico();
            $respuestaProcedimientos = $_LActo->lProcedimientosCitaReporte($idPrograma);
      //      print_r($respuestaProcedimientos);
            $cadenaProcedimientos.='
                <table width="675" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="20" bgcolor="#F8F8F8" width="100" align="center"><strong>Codigo</strong></td><td bgcolor="#F8F8F8" align="center" width="600" height="20"><strong>Descripcion Servicio</strong></td>
                        </tr>';
            foreach ($respuestaProcedimientos as $key => $value) {

                $cadenaProcedimientos.='
                        <tr>
                            <td>' .utf8_decode($value[1]) . '</td>
                            <td>' . utf8_decode($value[2]) . '</td>
                        </tr>';
            }

            $cadenaProcedimientos.='</table>';
            $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->Write(0, 'PROCEDIMIENTOS', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
            //$pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->SetFont($family, $styleNormal, $sizeDatos);
            $pdf->writeHTML($cadenaProcedimientos, true, false, false, false, '');
        }


 /* ===================================================================================================== */
        /* =====================================     Antecedentes     ========================================== */
        if ($antecedentes) {
            $fechaAnterior = "";
            $numAntecedente = 0;
            $contadorAntecedentes = count($antecedentes);

            for ($xx = 0; $xx <= $contadorAntecedentes - 1; $xx++) {
                if ($antecedentes[$xx][2] != $antecedentes[$xx + 1][2]) {
                    $cadenaAntecedentes.='<table width="700" border="0" cellspacing="1">';

                    $cadenaAntecedentes.='<tr colspan="2">';
                    $cadenaAntecedentes.='<td width="600" align="left" >';
                    $cadenaAntecedentes.='<strong>' . utf8_decode($antecedentes[$xx][2]) . ' - ' . utf8_decode($antecedentes[$xx][3]) . '</strong>';
                    $cadenaAntecedentes.='</td>';
                    $cadenaAntecedentes.='</tr>';

                    $cadenaAntecedentes.='<tr>';
                    $cadenaAntecedentes.='<td width="50" align="left">';
                    $cadenaAntecedentes.='</td>';

                    $cadenaAntecedentes.='<td>';
                    $cadenaAntecedentes.='<strong>Observación: </strong>';
                    $cadenaAntecedentes.='</td>';
                    $cadenaAntecedentes.='</tr>';

                    $cadenaAntecedentes.='<tr>';
                    $cadenaAntecedentes.='<td width="50" align="left">';
                    $cadenaAntecedentes.='</td>';

                    $cadenaAntecedentes.='<td border="0">';
                    $cadenaAntecedentes.=utf8_decode($antecedentes[$xx][4]);
                    $cadenaAntecedentes.='</td>';
                    $cadenaAntecedentes.='</tr>';

                    $cadenaAntecedentes.='<tr>';
                    $cadenaAntecedentes.='<td width="50" align="left">';
                    $cadenaAntecedentes.='</td>';

                    $cadenaAntecedentes.='<td border="0">';
                    $cadenaAntecedentes.='<ul><li><strong>Parentesco: </strong>';
                    foreach ($antecedentes as $key => $value) {
                        if ($value[2] == $antecedentes[$xx][2]) {
                            $cadenaAntecedentes.='' . $value[7] . ',';
                        }
                    }
                    $cadenaAntecedentes.='</li></ul>';
                    $cadenaAntecedentes.='</td>';
                    $cadenaAntecedentes.='</tr>';

                    $cadenaAntecedentes.='</table>';
                    $cadenaAntecedentes.='<br>';
                }
            }
                    $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->Write(0, 'ANTECEDENTES', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
        $pdf->writeHTML('<br>', true, false, false, false, '');
        $pdf->SetFont($family, $styleNormal, $sizeDatos);
        $pdf->writeHTML($cadenaAntecedentes, true, false, false, false, '');
        } 






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
            //$datosMed = $arrayHC[$i][5];
            // $fechaAtencion = $arrayHC[$i][6];
            // $instalacion = $datosMed[0][8] . " - " . $datosMed[0][7] . " - " . $datosMed[0][6];
            // $medico = $datosMed[0][2] . " " . $datosMed[0][3] . " " . $datosMed[0][4];
            $datosmedico = '<table width="700" border="0" cellspacing="1"><tr><td width="100">' . $fechaAtencion . '</td> <td width="300">' . $instalacion . '</td><td width="300">' . $medico . '</td></tr></table>';

            //================================================================================
            //==================================  Motivo Consulta  ===========================
            //================================================================================
            $numMotConsulta = 0;
            $cadenaMotCon = "";
            if ($motivoConsulta != null) {
                foreach ($motivoConsulta as $x => $valuex) {
                    $numMotConsulta++;
                    $cadenaMotCon.='<table width="675" border="0"><tr><td><table width="650" border="0" cellspacing="3">
                                      <tr><td width="20"><strong>' . $numMotConsulta . '.</strong></td><td width="55"><strong>Sintoma :</strong></td><td width="580">' . $motivoConsulta[$x][2] . ' - ' . $motivoConsulta[$x][3] . '</td> </tr>
                                      <tr><td></td><td><strong>Descripci&oacute;n:</strong></td><td>' . $motivoConsulta[$x][4] . '</td></tr>
                                    </table></td></tr></table>';
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
                $cadenaTriaje.= '<table width="660" border="0" cellspacing="0">
                                  <tr>
                                    <td><strong>Peso (Kg.) : </strong>' . $triaje[0]["nPeso"] . '</td>
                                    <td><strong>Talla (m.) : </strong>' . $triaje[0]["nTalla"] . '</td>
                                    <td><strong>Temp. (ºC) : </strong>' . $triaje[0]["nTemperatura"] . '</td>
                                    <td><strong>Frec. Cardiaca (min) : </strong>' . $triaje[0]["iFrecuenciaCardiaca"] . '</td>
                                  </tr>
                                  <tr>
                                    <td><strong>Pres. Arterial (mmHg) : </strong>' . $triaje[0]["vPresionArterial"] . '</td>
                                    <td><strong>Frec. Respiratoria (min) : </strong>' . $triaje[0]["iFrecuenciaRespiratoria"] . '</td>
                                    <td><strong>Sat. O2(%) : </strong>' . $triaje[0]["nSaturacionOxigeno"] . '</td>
                                    <td><strong>IMC : </strong>' . round($triaje[0]["nPeso"] / pow(2, ($triaje[0]["nTalla"] / 100)), 2) . '</td>
                                  </tr>
                                </table>';
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
                            $m++;
                            $idPrueba = $fila[1];
//                            echo $idPrueba.'<br>';
                            $nombreCampo = $fila[4];
                            $iiDCombo = $fila[8];
                            if (!($idPrueba == $idPruebaAux)) {
                                $nombrePrueba = $fila[2];
                                if ($m == 1)
                                    $cadenaExamenesAux.='<table width="675" border="0" cellpadding="3" cellspacing="0" ><tr><td>';
                               // $cadenaExamenesAux.='<table width="675" border="0" cellpadding="3" cellspacing="0" ><tr><td height="20" bgcolor="#F8F8F8" align="center"><strong>' . utf8_encode($nombrePrueba) . '</strong></td></tr><tr><td>';
                            }
                            $iIdTipoDato = $fila[5];
                            switch ($iIdTipoDato) {
                                case 1: { //integer
                                        if ($fila[9] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[9] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[9] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }

                                case 2: {//varchar
                                        if ($fila[10] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[10] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[10] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 3: {//datetime
                                        if ($fila[11] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[11] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.='<strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[11] . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        break;
                                    }
                                case 4: { //decimal
                                        if ($fila[12] != "") {
//                                            $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="150"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="500">' . $fila[12] . '</td></tr>
//                                                    </table>';
                                            $cadenaExamenesAux.=' <strong>' . utf8_encode($nombreCampo) . ' : </strong>' . $fila[12] . '&nbsp;&nbsp;&nbsp;&nbsp;';
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
//                                        $cadenaExamenesAux.='<table width="650" border="0" cellpadding="3" cellspacing="0">
//                                                    <tr><td width="100"><strong>' . utf8_encode($nombreCampo) . ':</strong></td>
//                                                    <td width="550">' . utf8_encode($fila[15]) . '</td></tr>
//                                                    </table>';
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
                $cadenaDiagnostico.='<table width="675" border="0" cellpadding="3" cellspacing="0">
                       <tr><td height="20" width="100" bgcolor="#F8F8F8"><strong>C&oacute;digo Cie</strong></td><td width="400" bgcolor="#F8F8F8" align="center"><strong>Descripci&oacute;n</strong></td><td width="175" bgcolor="#F8F8F8" align="center"><strong>Tipo Diagn&oacute;stico</strong></td></tr>';
                foreach ($diagnosticos as $x => $valuex) {
                    $cadenaDiagnostico.='<tr><td>' . utf8_encode($diagnosticos[$x][1]) . '</td><td>' . utf8_encode($diagnosticos[$x][2]) . '</td><td>' . utf8_encode($diagnosticos[$x][6]) . '</td></tr>';
                }
                
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
                $cadenaMedicamentoso.='<table width="675" border="0" cellpadding="0" cellspacing="0"><tr><td>
                                        <table width="675" cellpadding="3" cellspacing="0"><tr><td height="20" bgcolor="#F8F8F8" align="center">
                                        <strong>Receta médica</strong></td></tr></table></td></tr><tr><td>';
                $cadenaMedicamentoso.='<table width="675" border="1" cellpadding="3" cellspacing="0">
                                       <tr>
                                            <td width="25" bgcolor="#F8F8F8" align="center"><strong> Nro</strong></td>
                                            <td width="205"  bgcolor="#F8F8F8" align="center"><strong>Nombre </strong></td>
                                            <td width="100" bgcolor="#F8F8F8" align="center"><strong>Presentaci&oacute;n </strong></td>
                                            <td width="70" bgcolor="#F8F8F8" align="center"><strong>Cantidad </strong></td>
                                            <td width="275" bgcolor="#F8F8F8" align="center"><strong>Observaci&oacute;n </strong></td>
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
                $cadenaPracticaMedica.='<table width="675" border="0" cellpadding="0" cellspacing="0"><tr><td>
                 <table width="675" cellpadding="3" cellspacing="0"><tr><td height="20" bgcolor="#F8F8F8" align="center">
                 <strong>Procedimientos médicos</strong></td></tr></table></td></tr><tr><td>';
                $cadenaPracticaMedica.='<table width="675" border="1" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td width="25" bgcolor="#F8F8F8" align="center"><strong>Nro</strong></td>
                                            <td width="205" bgcolor="#F8F8F8" align="center"><strong>Nombre </strong></td>
                                            <td width="80"bgcolor="#F8F8F8" align="center"><strong>Codigo Seg </strong></td>
                                            <td width="365" bgcolor="#F8F8F8" align="center"><strong>Observaci&oacute;n </strong></td>
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
                $cadenaTratamientos.=$cadenaMedicamentoso . $cadenaPracticaMedica;
            else if ($cadenaMedicamentoso != '')
                $cadenaTratamientos.=$cadenaPracticaMedica;
            else if ($cadenaPracticaMedica != '')
                $cadenaTratamientos.=$cadenaMedicamentoso;

            //===================================   fin   ====================================
            //================================================================================
            //--------------------------------------------------------------------------------
            $pdf->SetFont($family, $styleNegrita, $sizeTitulo);
            $pdf->writeHTML($datosmedico, false, false, false, false, '');
            //$pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            //$pdf->writeHTML('<br>', true, false, false, false, '');
            //--------------------------------------------------------------------------------
            if ($imprimeMotCon) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->Write(0, 'MOTIVO DE CONSULTA', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaMotCon, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeTriaje) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->Write(0, 'TRIAJE', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaTriaje, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeExaMed) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                //$pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->Write(0, 'EXAMENES MEDICOS', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaExamenes, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeDiagnostico) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->Write(0, 'DIAGNOSTICO', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaDiagnostico, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //--------------------------------------------------------------------------------
            if ($imprimeTratamientos) {
                $pdf->SetFont($family, $styleNegrita, $sizeSubtitulo);
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->Write(0, 'TRATAMIENTOS', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Image('../../../../medifacil_front/imagen/logo/linea.jpg', '', '', 190, "auto");
                $pdf->writeHTML('<br>', true, false, false, false, '');
                $pdf->SetFont($family, $styleNormal, $sizeDatos);
                $pdf->writeHTML($cadenaTratamientos, true, false, false, false, '');
//            $pdf->writeHTML('<br>', true, false, false, false, '');
            }
            //$contadorLinea = count($medicoFIrma);
            require_once "../../clogica/LActoMedico.php";
            $_LActo = new LActoMedico();
            $respuestaFirma = $_LActo->lFirmaMedico($idPrograma);
            
            $cadenaFirma = '
                <table>
                <tr>
                <td></td>
                <td>';
            for ($x = 0; $x <= (strlen($medicoFIrma) - 1) + 6; $x++) {
                $cadenaFirma.='_';
            }
            $cadenaFirma.='</td>
                </tr>
                 <tr>
                <td></td>
                
                <td><B>' . utf8_encode($respuestaFirma[0][1]) . '</B></td>
                </tr>
                <TR>
                <td></td>
                    <td><B>RNE:</B>' . utf8_encode($respuestaFirma[0][3]) . ' - <B>CMP:</B>' . utf8_encode($respuestaFirma[0][2]) . '</td>
</TR>
                 
 
                </table>';
           // $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
           // $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
           // $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
           // $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
          //  $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
            $pdf->writeHTML($cadenaFirma, true, false, false, false, 'C');
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