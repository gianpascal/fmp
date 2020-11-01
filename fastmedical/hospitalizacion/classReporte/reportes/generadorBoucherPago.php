<?php

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');

class generarMYPDF_BoucherPago {

    function generarPDFBoucher($parametros, $datosPersona,$arrayOrdenes) {
        $pdf = new TCPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT, $parametros["PDF_PAGE_FORMAT"], false, 'UTF-8', true);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Fasmedical');
        $pdf->SetTitle('Boucher de pago');

        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0);

        
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 25);
        $etiqueta['titulo'] = "FASTMEDICAL";
        $pdf->writeHTML($etiqueta['titulo'], TRUE, true, true, true, 'C');
        
        
        $pdf->SetFont('times', '', 8);
        $etiqueta['direccion'] = "Av. Enrique Canaval y Moreyra Nro. 425 Int. 93";
        $pdf->writeHTML($etiqueta['direccion'], true, true, true, true, 'C');
        
        $pdf->SetFont('times', '', 8);
        $etiqueta['RUC'] = "R.U.C.: 20508316985";
        $pdf->writeHTML($etiqueta['RUC'], true, true, true, true, 'C');
        
        $pdf->SetFont('times', '', 10);
        $etiqueta['tipo_doc'] = "<br/><br/>BOLETA DE VENTA: ".$arrayOrdenes[0]['vSerie']." - ".$arrayOrdenes[0]['vNumeroComprobante'];;
        $pdf->writeHTML($etiqueta['tipo_doc'], true, true, true, true, 'C');
        
        
        
        
        
        $pdf->SetFont('times', '', 8);
        $cliente='<br/><br/><table>
                <tr>
                <td style=" width: 27%;"> CLIENTE</td><td style=" width: 3%;">:</td>
                <td style=" width: 70%;">'.$datosPersona[0]['vNombre']." ".$datosPersona[0]['vApellidoPaterno']." ".$datosPersona[0]['vApellidoMaterno'].'</td>
                </tr>
                </table>';
        $etiqueta['cliente'] = $cliente;//"Cliente:".$datosPersona[0]['vNombre'];
        $pdf->writeHTML($etiqueta['cliente'], true, true, true, true, 'L');
        
        $docIdentidad='<br/><br/><table>
                <tr>
                <td style=" width: 27%;">DOC. IDENT.</td><td style=" width: 3%;">:</td>
                <td style=" width: 70%;">'.$datosPersona[0]['DocumentoIdentificacion'].'</td>
                </tr>
                </table>';
        $etiqueta['docIdentidad'] = $docIdentidad;//"Cliente:".$datosPersona[0]['vNombre'];
        $pdf->writeHTML($etiqueta['docIdentidad'], true, true, true, true, 'L');
        
        
        
        
        
        $productos='<br/><br/><table>';

foreach ($arrayOrdenes as $key => $value) {
    $productos.='<tr>
    <td style=" width: 25%;">'.$value['c_cod_ser_pro'].'</td>
    <td style=" width: 55%;">'.$value['v_desc_ser_pro'].'</td>
    <td style=" width: 5%;">'.intval($value['n_canti']).'</td>
    <td style=" width: 15%;text-align: right">'.$value['n_total'].'</td>
    </tr>';
}
$productos.='<tr>
    <td style=" width: 25%;"></td>
    <td style=" width: 55%;"></td>
    <td style=" width: 5%;"></td>
    <td style=" width: 15%;"></td>
    </tr>';
        $productos.='<tr>
    <td style=" width: 25%;"></td>
    <td style=" width: 55%;"><b>BASE IMPONIBLE</b></td>
    <td style=" width: 5%;"></td>
    <td style=" width: 15%; text-align: right">'.$value['nBaseImponible'].'</td>
    </tr>';
        $productos.='<tr>
    <td style=" width: 25%;"></td>
    <td style=" width: 55%;"><b>IGV</b></td>
    <td style=" width: 5%;"></td>
    <td style=" width: 15%; text-align: right">'.$value['nIgv'].'</td>
    </tr>';
        $productos.='<tr>
    <td style=" width: 25%;"></td>
    <td style=" width: 55%;"><b>IMPORTE TOTAL</b></td>
    <td style=" width: 5%;"></td>
    <td style=" width: 15%; text-align: right">'.$value['nTotal'].'</td>
    </tr>';
        $productos.='</table>';
       
        
        $pdf->SetFont('times', '', 8);
        $etiqueta['productos'] = $productos;
        $pdf->writeHTML($etiqueta['productos'], true, true, true, true, 'L');
        $pdf->Output('boucher.pdf', 'I');
    }

}
