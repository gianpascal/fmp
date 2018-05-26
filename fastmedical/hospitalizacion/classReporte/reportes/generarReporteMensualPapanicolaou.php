<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');

class generarReporteMensualPapanicolaou {

    function generarMYPDF_HC_Completo($listarPapanicolaum, $parametros,$datos) {
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
        require_once "../../clogica/LActoMedico.php";
        $_LActo = new LActoMedico();

        $cabecera = '
             <table border="0" width="1000">
                    <tr>
                    <td width="100"><img src="../../../../fastmedical_front/imagen/logo/HMLO.jpg" width="90"></td>
                        <td>
                                <table border="0">
                                    <tr>
                                        <td>
                                            <table  border="0"  height="30">
                                                <tr>
                                                    <td align="center"><font size="16">HOSPITAL MUNICIPAL LOS OLIVOS</font></td>
                                                </tr>
                                                 <tr>
                                                    <td align="center"><font size="16">PAPANICOLAOU DEL '.$datos['p2'].' AL '.$datos['p3'].'</font></td>
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
        $x = 0;
        foreach ($listarPapanicolaum as $key => $value) {
            $valorDatosPaciente = $_LActo->datospacientePapanicolaum($listarPapanicolaum[$x][0]);
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
                                                    <td width="90"><strong>Edad: </strong></td>
                                                    <td width="75">' . utf8_encode($valuePaciente[6] . '') . 'años</td>    
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
                                                    <td width="90"><strong>Direccion:</strong> </td>
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

            $cadenaExamenesAux = '
                    <table width="660" border="1" cellpadding="3" cellspacing="0" >
                        <tr>
                            <td height="20" bgcolor="#F8F8F8" align="center">
                        <strong>RESULTADOS - Fecha:' . $listarPapanicolaum[$x][2] . '</strong>
                            </td>
                        </tr>
                     </table>
                      <table width="660" border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <td width="160" align="center"><strong>Descripcion</strong>
                            </td>
                           
                            <td width="200" align="center"><strong>Resultado</strong>
                            </td>
                            
                            <td width="300" align="center"><strong>Observacion</strong>
                            </td>
                        </tr>
                     </table>
                     ';

            $resultadoLaboratorio = $_LActo->resultadoLaboratorio($listarPapanicolaum[$x][1]);
            $resultadoDetalle = '';
            $contadorLab = count($resultadoLaboratorio);
            //foreach ($resultadoLaboratorio as $keyResulLab => $valueResulLab) {
            for ($z = 0; $z <= $contadorLab - 1; $z++) {
                if ($z == 0) {
                    $resultadoDetalle.='
                     <table width="660" border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <td align="center"><strong>MEDICO: ' . utf8_encode($resultadoLaboratorio[$z][11]) . '
                            </strong></td>
                        </tr>
                     </table>';
                } else {
                    $resultadoDetalle.='
                     <table width="660" border="1" cellpadding="3" cellspacing="0">
                        <tr>
                            <td width="160">' . utf8_encode($resultadoLaboratorio[$z][0]) . '
                            </td>
                           
                            <td width="200">' . utf8_encode($resultadoLaboratorio[$z][2]) . '
                            </td>
                            
                            <td width="300">' . utf8_encode($resultadoLaboratorio[$z][4]) . '
                            </td>
                        </tr>
                     </table>
                     ';
                }
            }


            if ($x <= (count($listarPapanicolaum) - 1)) {
                $x++;
            }
            $pdf->SetFont($family, $styleNormal, $sizeTitulo);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->writeHTML($datosPaciente, false, false, false, false, '');
            $pdf->Image('../../../tcPDF/tcpdf/tcpdf/images/line.jpg', '', '', 190, 1);
            $pdf->writeHTML('<br>', true, false, false, false, '');

            $pdf->SetFont($family, $styleNormal, $sizeTitulo);
            $pdf->writeHTML('<br>', true, false, false, false, '');
            $pdf->writeHTML($cadenaExamenesAux, false, false, false, false, '');
            $pdf->SetFont($family, $styleNormal, $sizeDatos);
            $pdf->writeHTML($resultadoDetalle, false, false, false, false, '');
        }
        $pdf->Output('Papanicolaou.pdf', 'I');
    }

}

?>