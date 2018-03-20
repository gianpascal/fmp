<?php
// jorge
//require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
//require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
//require_once('classGeneral.php');

require_once('../../../tcPDF/tcpdf/tcpdf/config/lang/eng.php');
require_once('../../../tcPDF/tcpdf/tcpdf/tcpdf.php');
require_once('classGeneral.php');
class generarMYPDF_RECIBODEPAGO {

    function generarMYPDF_RECIBO($atributosRecibo, $labelCabecera, $labelDetalle, $labelPie, $datosCabecera, $datosDetalle, $datosPie, $modo, $nombreReporte, $parametros) {

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //   $pdf = new MYPDF($parametros["PDF_PAGE_ORIENTATION"], PDF_UNIT,$parametros["PDF_PAGE_FORMAT"], true, 'UTF-8', false);
// set document information
        // $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('');

// set default header data
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//       $pdf->setLanguageArray($l);
        //$pdf->setFontSubsetting(true);
        //   $pdf->SetFont('dejavusans', '', 10);

        $pdf->AddPage();
//        $pdf-> extractCSSproperties();

        if (!empty($datosDetalle)) {
            $cadena='';
            $total='';
            foreach ($datosDetalle as $i => $value) {
                if($cadena=='') {
                    $cadena=  ' <tr>
            <td width="120" height="10" align="CENTER">'.$value[5].'</td>
            <td width="200" height="10" align="left">'.$value[0].'</td>
            <td width="80" height="10" align="CENTER">'.$value[1].'</td>
            <td width="80" height="10" align="CENTER">'.$value[2].'</td>
            <td width="80" height="10" align="CENTER">'.($value[2]*$value[1]).'</td>
        </tr> ';
                    $total=$value[2]*$value[1];
                }else {
                    $cadena=  ' <tr>
            <td width="120" height="10" align="CENTER">'.$value[5].'</td>
            <td width="200" height="10" align="left">'.$value[0].'</td>
            <td width="80" height="10" align="CENTER">'.$value[1].'</td>
            <td width="80" height="10" align="CENTER">'.$value[2].'</td>
            <td width="80" height="10" align="CENTER">'.($value[2]*$value[1]).'</td>
        </tr>  '.$cadena;
                    $total=$total+$value[2]*$value[1];
                }
            }
            $cadena1 =  '  <tr>
            <td width="120" height="10"></td>
            <td width="200" height="10"></td>
             <td width="80" height="10"></td>
            <td width="80" height="10" align="CENTER">TOTAL:</td>
             <td width="80" height="10" align="CENTER">'.$total.'</td>
            
        </tr>
    </tbody>
</table>       
';

        }

        
        $firma='<br><br><br><br><table>
              <tr>
                  <td width="280" height="10">           </td>
                  <td width="150" height="10"> __________________________</td>
                  <td width="50" height="10">           </td>
                  <td width="150" height="10">         </td>
              </tr>
               <tr>
                  <td width="280" height="10">           </td>
                  <td width="150" height="10" align="CENTER"> <font style=" font-size: 6"
                                       color="">Firma y Sello</font> <br> <font style=" font-size: 6"
                                       color="">Caja</font></td>
                  <td width="50" height="10">           </td>
                  <td width="50" height="10">           </td>
              </tr>
               <tr>
                  <td width="280" height="10">           </td>
                  <td width="100" height="10"> </td>
                  <td width="50" height="10">           </td>
                  <td width="150" height="10"> Usuario: '.$datosPie[4].'       </td>
              </tr>
           </table>';

        $piesPaguina='<table>
                    <tr>
                      <td bgcolor="Black" align="center" width="280" height="10"><font style="font-weight: bold; font-size: 6"
                                       color="White">Esperamos haberlo atendido bien....</font><br>
                           <font style="font-weight: bold; font-size: 6"
                                       color="White">Juntos cuidemos la salud</font></td>
                      <td bgcolor="Black" align="center" width="280" height="10"><font style="font-weight: bold; font-size: 6"
                                       color="White">
                      Cualquier reclamo por pagos de procesimientos que no se hayan </font><br>
                        <font style="font-weight: bold; font-size: 6"
                                       color="White"> efectuado en caja, no es de nuestra responsabilidad</font></td>     
                    </tr>
                 </table>';
        $html = '<table  cellspacing="3" cellpadding="4">
	<tr>
	       <th width="70" height="10">
                  <table>
                   <tr>
                   <td>
                   <img src="../../../../medifacil_front/imagen/logo/Escudo_municipalidad_lima.JPG" alt="test alt attribute" width="50" height="50" border="0" />
                   </td>
                   </tr>
                   <tr>
                   <td>
                <font size="4" color="Silver">MAGDALENA DEL MAR</font>
                   </td>
                   </tr>
                   </table>
                </th>
		<th width="300" height="50" align="CENTER"><font style=" font-size: 10"
                                       color="">MUNICIPALIDAD METROPOLITANA DE LIMA</font> 
                                             <font style="font-weight: bold; font-size: 10"
                                       color=""><br><br>HOSPITAL DE LA SOLIDARIDAD</font><br>
                                             <table>
                                                  <tr>
                                                      <td width="150" height="20">
                                                         <font size="6" color="">Fecha de emisiòn</font> 
                                                         <font size="6" color="Silver"><u>'.$datosCabecera[13].'</u></font>
                                                       </td>
                                                       <td>
                                                            <font size="6" color="">Especialidad:</font>  
                                                            <font size="6" color="Silver"><u>'.$datosDetalle[0][0].' </u></font> 
                                                        </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="150" height="20"><font size="6" color="">Señor (es):</font>  
                                                           <font size="6" color="Silver"><u>'.$datosCabecera[9].'</u></font> 
                                                      </td>
                                                      <td> <font size="6" color="">Edad:</font> 
                                                           <font size="6" color="Silver"><u>'.$datosCabecera[12].'</u></font> 
                                                       </td>
                                                  </tr>
                                             </table>                                            
                  </th>
		<th align="left" width="180" height="50"><table border="1">
                                     <tr>
                                       <td bgcolor="Black" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White"><BR>RECIBO DE CAJA</font> </td>
                                     </tr>
                                     <tr>
                                      <td> <BR>  COD. '.'$datosCabecera[14]'.' Nº '.  $datosCabecera[7].'  <BR> </TD>
                                     </tr>
                                </table></th>
	</tr>
</table>

 <table border="1">
    <thead>
        <tr bgcolor="Black" width="500" height="10">
            <th width="120" height="10" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White">Codigo</font></th>
            <th width="200" height="10" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White">Descripción</font></th>
            <th width="80" height="10" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White">Cant</font></th>
            <th width="80" height="10" align="center" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White">Precio Unit.</font></th>
            <th width="80" height="10" align="center"><font style="font-weight: bold; font-size: 10"
                                       color="White">Total</font></th>
        </tr>
    </thead>
    <tbody>  '.$cadena . $cadena1.$firma.$piesPaguina;     

//        /* ===================================================================================================== */
//            if (!empty($datosDetalle)) {

//        /* =====================================    Fin Pie    ================================================= */
//// -----------------------------------------------------------------------------
////Close and output PDF document
        $pdf->writeHTML($html, true  , true ,true, true, true);
//      $pdf->Output($nombreReporte, 'I');
// reset pointer to the last page
//$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
// add a page
//$pdf->AddPage();

        $pdf->Output('Factura.pdf', 'I');
//============================================================+
// END OF FILE                                                
//============================================================+
    }

}

?>
