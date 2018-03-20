<?php
require_once("../../../pholivo/Html.php");
    $oToolbarBusqueda = new ToollBar('left','btns');
    $oToolbarBusqueda->SetBoton('btnBuscarxOrden',"B. Orden",'btn','onClick,KeyPress,onDblClick','pruebaOrden()','../../../../medifacil_front/imagen/icono/kappfinder.png','','','85');
    $oToolbarBusqueda->SetBoton('btnCambioEstado',"C. Estado",'btn','onClick,KeyPress,onDblClick','alert','../../../../medifacil_front/imagen/icono/actividad3.png','','','80');
	$oToolbarBusqueda->SetBoton('btnCartas',"Cartas y Depositos",'btn','onClick,KeyPress,onDblClick','alert','../../../../medifacil_front/imagen/icono/min_mail_generic.png','','','80');
	$oToolbarBusqueda->SetBoton('btnCitas',"Citas",'btn','onClick,KeyPress,onDblClick','alert','../../../../medifacil_front/imagen/icono/eventos.png','','','80');
	$oToolbarBusqueda->SetBoton('btnNuevo',"Nuevo",'btn','onClick,KeyPress,onDblClick',"nuevaOrden()",'../../../../medifacil_front/imagen/icono/filenew.png','','','80');
	$oToolbarBusqueda->SetBoton('btnCancelar',"Cancelar",'btn','onClick,KeyPress,onDblClick','alert','../../../../medifacil_front/imagen/icono/santaRosita.png','','','80');
	$oToolbarBusqueda->SetBoton('btnDevolucion',"Devolucion",'btn','onClick,KeyPress,onDblClick','alert','../../../../medifacil_front/imagen/icono/ark2.png','','','80');
?>
<input type="text" value="0" id="auxOrden"/>

<div id="div_conten_genOrden" style="background:#cccccc">
	<div id="div_encabezado" style="width:90%; background:#aaffaa; height:120px; margin:0px auto">
    	
		<?php require_once("buscarOrdenes.php");?>
        
    </div>  
    <div id="div_result_ordenes"  style="background:#ffffff; height:300px; width:90%; margin:0px auto;">
    holas
    </div>
    <div style="height:100px; background:#cccccc; width:90%; margin:0 auto;">
    	<div style="width:70%; float:left" >
        	<div id="leyenda" style="margin:0 auto;  height:20%; background:#CCCCCC">
    			<table class="tablaOrden" >
  					<tr>
    					<td>Leyenda:</td>
    					<td class="e6">Observado</td>
    					<td class="e5">Pendiente</td>
    					<td class="e10">Atendido</td>
    					<td class="e7">Cancelado P</td>
    					<td class="e8">Cancelado A</td>
    					<td class="e3">Devoluci&oacute;n</td>
  					</tr>
				</table>
			</div>
    		<div id="toolbar" style=" height:25%; background:#00FF00;">
    		<?php 	$oToolbarBusqueda->Mostrar(); ?>
    		</div>
        </div>
        <div style="width:25% ">
        	<table border="1">
  <tr>
    <td>Pendiente</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Atendido</td>
    <td>&nbsp;</td>
  </tr>
</table>

        </div>
     </div>
</div>