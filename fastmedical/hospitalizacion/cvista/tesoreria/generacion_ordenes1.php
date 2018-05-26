<?php
//require_once("../../../pholivo/Html.php");
require_once("../../ccontrol/control/ActionTesoreria.php");
    $o_ActionTesoreria	= new ActionTesoreria();
require_once("../../ccontrol/control/ActionPersona.php");
    $o_ActionPersona	= new ActionPersona();
     
?>

<style type="text/css">
<!--
.Estilo5 {font-size: 14px; font-weight: bold; }
-->
</style>

<div style="float:left">
<div id="toolbar" style="height:130px">
    <form>
    
    

    <table>
  <tr>
            <td><span class="Estilo5">
              Nro Orden:            </span></td>
<td ><label>
			<input name="txtOrden" type="text"   id="txtOrden"
            onfocus="if (this.value==this.defaultValue) this.value='';" 
            onblur="if (this.value=='') this.value=this.defaultValue;"
            onkeypress="getBuscarOrdenes(event,this,'01');" value="Buscar..." size="25"/>
</label></td>
            <td><span class="Estilo5">C&oacute;digo </span></td>
            <td><label>
             <input name="txtCodigo" type="text"   id="txtCodigo"
            onfocus="if (this.value==this.defaultValue) this.value='';" 
            onblur="if (this.value=='') this.value=this.defaultValue;"
            onkeypress="getBuscarOrdenes(event,this,'02');" value="Buscar..." size="12"/>
            </label>            </td>
        </tr>
        <tr>
          <td><span class="Estilo5">Tipo Doc:</span></td>
          <td><label>
            <div align="left">
                
              <select name="select" id="select">
                <?php
              echo $o_ActionTesoreria->comboTipoDocumento('');
              ?>
              </select>
              </div>
          </label></td>
          <td><span class="Estilo5">Nro Doc:</span></td>
          <td><label>
            <div align="left">
              <input name="textfield2" type="text" id="textfield2" size="12" />
              </div>
          </label></td>
        </tr>
        <tr>
          <td><span class="Estilo5">Ape. Pat:</span></td>
          <td colspan="4"><label>
            <div align="left">
              <input name="textfield3" type="text" id="apellidoPaterno" size="40" />
            </div>
          </label></td>
        </tr>
        <tr>
          <td><span class="Estilo5">Ape. Mat:</span></td>
          <td colspan="4"><label>
            <div align="left">
              <input name="textfield4" type="text" id="apellidoMaterno" size="40" />
            </div>
          </label></td>
        </tr>
        <tr>
          <td><span class="Estilo5">Nombre:</span></td>
          <td colspan="4"><label>
            <div align="left">
              <input name="textfield5" type="text" id="nombres" size="40" />
            </div>
          </label></td>
        </tr>
        <tr>
          <td colspan="5"><div align="center"><a href="javascript:getBuscarPersonasOrden();"><img src="../../../../fastmedical_front/imagen/btn/b_buscar.gif" alt="" border="0" title="Codigo de Persona"/></a></div></td>
      </tr>
    </table>
    </form>
</div>
<div id="divResultadoBusqueda"  style="height:200px;">
 <?php
              echo $o_ActionTesoreria->obtenerPersonas('','');
 ?>
</div>
 	<div id="leyenda" style="margin:10px; height:40px">
    			<table class="tablaOrden" >
  					<tr>
    					<td rowspan="2">Leyenda:</td>
    					<td class="e1">Reservado</td>
    					<td class="e2">Pagado</td>
    					<td class="e3">Pagado Atendido</td>
   					</tr>
  					<tr>
  					  <td class="e4"><span class="e4">Atendido con Carta</span></td>
  					  <td class="e5"><span class="e5">Pendiente</span></td>
  					  <td >&nbsp;</td>
				  </tr>
				</table>
</div>
</div>
<div id="iddetalleOrden" style=" margin-left:450px;">
<?Php
	$o_ActionTesoreria->detalleOrden('','');
?>
</div>
