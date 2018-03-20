<?php
	$fechaActual = "value=\"".date("d/m/Y")."\"";
        
?>
<!--<style>
#idTableBusMedico{
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
</style>
-->
<?php
require_once("../../../pholivo/Html.php");
?>
<form name="frmBusqueda"  action="">
    <div style="width: 96%;height:35%" >
        <div style="width:100%" align="center">
            <div style="width: 100%;float:left;" align="center">
                <table width="100%" align="center">
                    <tr align="center"><td>A.paterno:</td><td><input class="textPatronNombre" name="textPatronAPaterno" type="text" id="textPatronAPaterno" onkeypress="if(event.keyCode==13)getBusquedaPersonalSalud(event,this);"/></td></tr>
                    <tr align="center"><td>A.Materno:</td><td><input class="textPatronNombre" name="textPatronAMaterno" type="text" id="textPatronAMaterno" onkeypress="if(event.keyCode==13)getBusquedaPersonalSalud(event,this);"/></td></tr>
                    <tr align="center"><td>Nombres:</td><td><input class="textPatronNombre" name="textPatronNombres" type="text" id="textPatronNombres" onkeypress="if(event.keyCode==13)getBusquedaPersonalSalud(event,this);"/></td></tr>
                    <tr align="center"><td colspan="2" nowrap="nowrap" scope="row" align="center"><a href="#" onclick="getBusquedaPersonalSalud(event,this);"><img alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_off.gif" /></a></td></tr>
                </table>

            </div>


        </div>       
    </div>
    <div id="divResultadoBusquedaMedicos" style="width:100%; height:45%; border: 1px solid #CCCCCC; overflow: auto;">

    </div>

<input type="hidden"  name="hOpcBusquedaPersona" id="hOpcBusquedaPersona" value="1"/>
</form>



































<!--<table width="37%" border="0" cellpadding="0px" cellspacing="0px" id="idTableBusMedico" style="width:98%;margin-left:1%;margin-right:1%;-moz-border-radius: 5px;">
  <tr>
    <td scope="row">Prof.<a name="calendario" href="#" style="display:inline;"><img src="../../../../medifacil_front/imagen/icono/hos_especialidad.png" width="16" height="16" align="right" style="display:inline;" /></a></td>
    <td><input type="text" name="txtBusProgMedIdMedico" id="txtBusProgMedIdMedico"></td>
  </tr>
  <tr>
    <td scope="row">Espec.</td>
    <td><input type="text" name="txtBusProgMedEspecialidad" id="txtBusProgMedEspecialidad"></td>
  </tr>
  <tr>
    <td scope="row">Mes <a href="#" name="especialidad" id="especialidad" style="display:inline;" onclick="cajaTextocalendarioActiva=document.getElementById('txtBusProgMedMesAnio');p3=document.getElementById('txtBusProgMedMesAnio').value;CargarVentana('calendar01','Calendario','../../ccontrol/control/control.php?p1=calendario&p2=calendar01&p3='+p3+'&p4=5','250','250',false,true,'',1,'',10,10,10,10);"><img src="../../../../medifacil_front/imagen/icono/hos_calendar.png" width="16" height="16" align="right" /></a>
    <td><input type="text" name="txtBusProgMedMesAnio" id="txtBusProgMedMesAnio" <?php echo $fechaActual?> ></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center"><a href="#" onclick="listarCronograma();"><img src="../../../../medifacil_front/imagen/btn/b_buscar_off.gif" /></a>     </tr>
</table>
-->