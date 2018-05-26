<?php $fechaActual = "value=\"".date("d/m/Y")."\""; ?>
<style>
#idTableBusespecialidad{
	margin:0px;
	padding:0px;
	border:0.1em solid #DBDBDB;
	font-size:12px;
}
#idTableBusespecialidad td{
	border:inherit;
	padding:0px;
	margin:0px;
	vertical-align:middle;
}
#idTableBusespecialidad  input{
	width:95%;
}
.estiloDivArbol{
	border:solid 0.2em rgb(0,0,0);background:#FFFFFF;display:block;position:absolute;top:50px;left:50px;width:350px;height:500px;overflow-x:auto;overflow-y:auto;
	visibility:hidden;
	z-index:1;
}
</style>
<div class="estiloDivArbol" id="divContenedorArbol"></div>
<table border="0" cellpadding="0px" cellspacing="0px" id="idTableBusespecialidad" align="center" style="width:97%;margin-left:1%;margin-right:1%;-moz-border-radius:5px;">
  <tr>
    <td scope="row" nowrap="nowrap">C. Costo</td>
    <td nowrap="nowrap"><input type="text" name="txtBusProgMedCentroCosto" id="txtBusProgMedCentroCosto"></td>
  </tr>
  <tr>
    <td scope="row" nowrap="nowrap">Espec. <a name="calendario" href="#" style="display:inline;" 
onclick="CargarVentana('arbolOficina','Oficinas','../../ccontrol/control/control.php?p1=arbol_oficina','250','500',false,true,'',1,'',10,10,10,10);">
	<!-- myajax3.Request({url:'../../ccontrol/control/control.php',method: 'get',param: 'p1=arbol_oficina',onOk:cargarOficinas,onError:cargarOficinas})-->
<img src="../../../../fastmedical_front/imagen/icono/hos_especialidad.png" width="16" height="16" align="right" style="display:inline;"/></a>
</td>
    <td nowrap="nowrap">
	<input type="text" name="txtBusProgMedEspecialidad"  id="txtBusProgMedEspecialidad"></td>
  </tr>
  <tr>
    <td scope="row" nowrap="nowrap">Mes 
      <a name="especialidad" href="#" style="display:inline;" onclick="cajaTextocalendarioActiva=document.getElementById('txtBusProgMedMesAnio');p3=document.getElementById('txtBusProgMedMesAnio').value;CargarVentana('calendar01','Calendario','../../ccontrol/control/control.php?p1=calendario&p2=calendar01&p3='+p3+'&p4=5','250','250',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/icono/hos_calendar.png" width="16" height="16" align="right" /></a>
    <td nowrap="nowrap"><input type="text" name="txtBusProgMedMesAnio" id="txtBusProgMedMesAnio" <?php echo $fechaActual?> ></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap" scope="row" align="center"><a href="#" onclick="listarCronograma();"><img src="../../../../fastmedical_front/imagen/btn/b_buscar_off.gif" /></a>    </tr>
</table>
<!-- CargarVentana('arbolOficina','Oficinas','../../ccontrol/control/control.php?p1=arbol_oficina','250','500',false,true,'',1,'',10,10,10,10);-->
<!-- myajax3.Request({url:'../../ccontrol/control/control.php',method: 'post',param: 'p1=arbol_oficina',onOk:cargarOficinas,onError:errorCargarOficinas})-->