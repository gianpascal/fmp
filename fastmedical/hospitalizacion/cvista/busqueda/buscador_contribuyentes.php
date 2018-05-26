<?php
    $arrayCabecera = array('0'=>"COD.CONTRIB.","1"=>"NOMBRE","2"=>"SITUACION");
    $arrayFilas=array();
    $oTabla = new Tabla1($arrayCabecera,20,$arrayFilas,'tablaOrden','fila2','fila2','filaSeleccionada','ondblclick',$parametros["funcionJSEjecutar"],0);
    $oTabla->setColumnasOrdenar(array("0","1","9"));
    $oToolbarBusqueda = new ToollBar('left','btns');
    $oToolbarBusqueda->SetBoton('btnEditarPersona',"Editar Datos",'btn','onClick,KeyPress,onDblClick','alert','../../../../fastmedical_front/imagen/icono/hos_calendar.png','','','85');
    $oToolbarBusqueda->SetBoton('btnCancelar',"Cancelar",'btn','onClick,KeyPress,onDblClick','alert','../../../../fastmedical_front/imagen/icono/hos_calendar.png','','','80');
?>
<form name="frmBusqueda"  action="">
<div id="toolbar" style="height:20px;">
  <table cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top"><a href="javascript:formateaOpcionBusqueda('nombre');"><img src="../../../../fastmedical_front/imagen/btn/btn_nombres_persona.gif" title="Nombres y Apellidos" border="0"/></a></td>
      <td valign="top"><a href="javascript:formateaOpcionBusqueda('documento');"><img src="../../../../fastmedical_front/imagen/btn/btn_dni_persona.gif" title="Documento de Identidad" border="0"/></a></td>
      <td valign="top"><a href="javascript:formateaOpcionBusqueda('codigo');"><img src="../../../../fastmedical_front/imagen/btn/btn_cod_persona.gif" title="Codigo de Persona" border="0"/></a></td>
      <td>
      
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td width="85" align="right">
      <span id="lblEtiquetaBusqueda" style=" height:auto; font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; font-weight:bolder; font-size:10px;">
NOMBRE:</span></td>
      <td width="297">
          <input class="textPatronNombre" name="txtPatronBusquedaPacientes" type="text" id="txtPatronBusquedaPacientes" onkeypress="buscarDatosContribuyenteListar(event,this);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" value="Buscar..." />
          <input type="text" id="nada" name="nada" style="width:2px;visibility:hidden;" />
      </td>
      </tr></table>
      
     </td> 
    </tr>
    </table>
   </div>
<div id="divResultadoBusquedaPersonas" style="width:99%; height:310px;border:solid #F0F0F0 3px;-moz-border-radius:10px;">
      	<?php echo $oTabla->getTabla();?>
</div>
  <input type="text" name="hFuncionJSEjecutar" id="hFuncionJSEjecutar" <?php echo "value=\"{$parametros["funcionJSEjecutar"]}\"";?> />
  <input type="text"  name="hOpcBusquedaPersona" id="hOpcBusquedaPersona" value="1"/>
</form>
<div style="width:99%; height:25px;border:solid #F0F0F0 3px;-moz-border-radius:10px;">
	<div style="float:right;display:block;"><?php 	$oToolbarBusqueda->Mostrar(); ?></div>
</div>