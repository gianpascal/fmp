<?php 
//session_start();
require_once("../../ccontrol/control/ActionLaboratorio.php");
require_once("../../../pholivo/Html.php");
//$cadena=base64_decode($c);
//$o_ActionLaboratorio	= new ActionLaboratorio();
//$listaDetResLab = $o_ActionLaboratorio->getArrayDetResLab($cadena);
$nuevo01=new ToollBar("left");				  
//$nuevo01->SetBoton("IMPRIMIR","Imprimir","btn","onclick,onkeypress","window.open('../laboratorio/impresion_resultados.php?'+myajax.DataForm($('form_resultados')),'Reporte Analisis','height=750,width=600,location=1,menubar=no,toolbar=no,scrollbars=yes,directories=no,resizable=yes,status=no')","../../../../fastmedical_front/imagen/icono/printer.png");
$nuevo01->SetBoton("IMPRIMIR","Vista Previa","btn","onclick,onkeypress","CargarVistaImpresion('grid_AddListResulLablm','Vista Previa Resultados','../laboratorio/impresion_resultados.php?'+myajax.DataForm($('form_resultados')),'580','630',false,true,'','','',10,10,80,10)","../../../../fastmedical_front/imagen/icono/printer.png");
?>
<div style="min-height:350px;" align="left">
	<div class="titleform">
	  <h1>Resultados de An&aacute;lisis de Laboratorio123 </h1>
	</div>	
    <table width="100%">
    <tr>
        <td rowspan="2">
            <form name="form_resultados" id="form_resultados" onSubmit="return false;" style="margin:0; padding:0" method="post">
            <fieldset>
            <legend>Analisis del Paciente</legend>
                <div>
                    <div id="cont_res" style="height:320px; width:100%; margin:1px; padding:2px; overflow:auto; float:left;">
                        <table cellpadding='0' cellspacing='1px' class='grid' width="100%">
                            <tbody><tr onmouseout="className=''" onmouseover="className=''" class="">
                            <td colspan="4"><b>PACIENTE:</b></td>
                            </tr>
                            <tr onmouseout="className=''" onmouseover="className='filaEncima'" class="" onclick="('');" id="">
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            </tbody>
                            <tr class='filaCabecera'>
                                <td nowrap="nowrap">Fecha</td>
                                <td nowrap="nowrap">Medico</td>
                                <td nowrap="nowrap">Ex&aacute;men</td>
                                <td nowrap="nowrap">Accion</td>
                            </tr>
                        </table>
                     </div>
                    <div id="toolbar" style="float:right;"><?php $nuevo01->Mostrar();?></div>
                </div>
            </fieldset>
            </form>
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    </table>      
</div>	