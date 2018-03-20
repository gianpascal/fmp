<?php
$trabajador="v";
$readonly='';
$dni_fondo="dni_fondo";
$p['csexo']='h';
?>
<form id="form_detalle" name="form_detalle" action="">
<table width="100%" >
  <tr>
      <td width="98%" height="328" colspan="2" align="left" valign="top"><table width="100%" border="0">
        <tr>
          <td width="41%" align="left" valign="top"><table width="78%" border="0">
              <tr>
                <td>
                <input name="txtCodigoPersona" type="text" id="txtCodigoPersona" value="" />
                <input name="p1" type="text" id="p1" value="mantenimiento_persona" />
                <input name="p_acc" type="text" id="p_acc" value="" />
                <input name="p_aubi" type="text" id="p_aubi" value="" />
                <input name="hBuscadorModulo" id="hBuscadorModulo" type="hidden" value="buscar_personas_admision"/>
                <input name="trabajador" id="trabajador" type="text" value="<?php echo $trabajador ?>"/>                
                <fieldset>
                  <legend>Nombre </legend>
                  <div id="idNombrePersona">
                    <table width="319" height="75" border="0" cellpadding="0" cellspacing="1" style="font-size:11px">
                      <tr bordercolor="#000000">
                        <td width="134">Apellido Paterno * </td>
                        <td width="182" align="left"><input name="txtApellidoPat" type="text" id="txtApellidoPat" value="" size="22" onkeyup="javascript:if(lee_tecla(event,13)==1){this.form.txtApellidoMat.focus();}else {return setupper(this); } "/>
                        </td>
                      </tr>
                      <tr bordercolor="#000000">
                        <td width="134">Apellido Materno* </td>
                        <td align="left"><input name="txtApellidoMat" type="text" size="22" id="txtApellidoMat" value="" onkeyup="javascript:if(lee_tecla(event,13)==1){this.form.txtNombrePaciente.focus();}else {return setupper(this); } "/></td>
                      </tr>
                      <tr bordercolor="#000000">
                        <td width="134">Nombres*</td>
                        <td align="left"><input name="txtNombrePaciente" type="text" size="22" id="txtNombrePaciente" value="" onkeyup="javascript:if(lee_tecla(event,13)==1){this.form.txtFechaNacimiento.focus();}else {return setupper(this); } "/></td>
                      </tr>
                    </table>
                  </div>
                </fieldset></td>
              </tr>
              <tr>
                <td><fieldset>
                  <legend>Datos </legend>
                  <div id="idDivDatosPersonas">
                    <table width="317"  border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">
                      <tr>
                        <td width="131" bordercolor="#000000">Fecha Nacimiento * </td>
                        <td width="183" align="left"><input name="txtFechaNacimiento" type="text" size="18" id="txtFechaNacimiento" value="" onkeyup="javascript:if(lee_tecla(event,13)==1){this.form.txtNroDocIdent.focus();}else {return setupper(this); } "/>
                          <a href="#" onclick="cajaTextocalendarioActiva=document.getElementById('txtFechaNacimiento');p3=document.getElementById('txtFechaNacimiento').value;CargarVentana('calendar01','Calendario','../../ccontrol/control/control.php?p1=calendario&amp;p2=calendar01&amp;p3='+p3+'&amp;p4=5','250','250',false,true,'',1,'',10,10,10,10);"><img src="../../../../medifacil_front/imagen/icono/date.png" border="0" /></a> </td>
                      </tr>
                      <tr>
                        <td bordercolor="#000000" width="131" >Edad</td>
                        <td align="left"><input name="txtEdad" type="text" size="22" id="txtEdad" value="" /></td>
                      </tr>
                      <tr>
                        <td bordercolor="#000000" width="131" >Doc. Identidad * </td>
                        <td align="left"><input name="txtNroDocIdent" type="text" size="22" id="txtNroDocIdent" value="" onkeypress="javascript: if(lee_tecla(event,13)==1){this.form.txtTelefono.focus();}else {return numbersonly(this, event,'.');}"/>
                        </td>
                      </tr>
                      <tr>
                        <td bordercolor="#000000" width="131" >His. Fisica </td>
                        <td align="left"><input name="txtNroHistoria" type="text" size="16" id="txtNroHistoria" />
                            <input name="idCalendario" type="button" id="idCalendario" value="&gt;" /></td>
                      </tr>
                    </table>
                  </div>
                </fieldset></td>
              </tr>
          </table></td>
          <td width="59%" align="left" valign="top"><fieldset style="margin:0px; padding:0px;">
            <legend>DNI</legend>
            <center>
              <div id="foto" style=" height:222px;"> <img align="middle" height="190" width="326" src="../../../imagen/dni/<?php  echo $dni_fondo ?>.gif" /> </div>
            </center>
          </fieldset></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="78%" border="0" cellpadding="0" cellspacing="1">
              <tr>
                <td><fieldset>
                  <legend>Adicionales</legend>
                  <div id="idDatosAdicinales">
                    <table width="318" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">
                      <tr>
                        <td height="23">Sexo*</td>
                        <td align="left"><select name="sexo2" id="sexo2" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_civil')" onkeypress="return validFormSalt('alf',this,event,'cb_civil')">
                            <option>Seleccionar</option>
                            <option value="h" <?php if($p['csexo']=='h') echo "selected=selected"?>>Hombre</option>
                            <option value="m" <?php if($p['csexo']=='m') echo "selected=selected"?>>Mujer</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="23">Estado Civil</td>
                        <td align="left"><select name="sexo3" id="sexo3" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_civil')" onkeypress="return validFormSalt('alf',this,event,'cb_civil')">
                            <option>Seleccionar</option>
                            <option value="h" <?php if($p['csexo']=='h') echo "selected=selected"?>>Hombre</option>
                            <option value="m" <?php if($p['csexo']=='m') echo "selected=selected"?>>Mujer</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="23">Grupo Sang.</td>
                        <td align="left"><select name="sexo4" id="sexo4" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_civil')" onkeypress="return validFormSalt('alf',this,event,'cb_civil')">
                            <option>Seleccionar</option>
                            <option value="h" <?php if($p['csexo']=='h') echo "selected=selected"?>>Hombre</option>
                            <option value="m" <?php if($p['csexo']=='m') echo "selected=selected"?>>Mujer</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td width="134" height="23">Telefono</td>
                        <td width="181" align="left"><input name="txtTelefono" type="text" style="width:100px;" id="txtTelefono" value=""
            onkeypress="javascript: if(lee_tecla(event,13)==1){this.form.txtCelular.focus();}else {return numbersonly(this, event,'.');}"/></td>
                      </tr>
                      <tr>
                        <td height="23">Celular</td>
                        <td align="left"><input name="txtCelular" type="text" style="width:100px;" id="txtCelular" value="" onkeypress="javascript:if(lee_tecla(event,13)==1){this.form.txtEmail.focus();}else {return numbersonly(this, event,'.');} "/></td>
                      </tr>
                      <tr>
                        <td height="23">Correo</td>
                        <td align="left"><input name="txtEmail" type="text" style="width:100px;" id="txtEmail"  value="" onkeyup="javascript:if(lee_tecla(event,13)==1){this.form.txtFax.focus();} "/></td>
                      </tr>
                      <tr>
                        <td height="23">Fax</td>
                        <td align="left"><input name="txtFax" type="text" style="width:100px;" id="txtFax"  value="" onkeypress="javascript:if(lee_tecla(event,13)==1){this.form.txtDireccion.focus();}else {return numbersonly(this, event,'.');}"/></td>
                      </tr>
                    </table>
                  </div>
                </fieldset></td>
              </tr>
          </table></td>
          <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1">
              <tr>
                <td><fieldset>
                  <legend>Complementarios</legend>
                  <table width="291" height="65" border="0" cellpadding="0" cellspacing="1" style="font-size:11px">
                    <tr>
                      <td width="131" height="23">Nombre Colegio</td>
                      <td width="157" align="left"><input name="txtTelefono3" type="text"  style="width:100px;" id="txtTelefono3" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Grado de Estudio</td>
                      <td ><input name="txtTelefono4" type="text"  style="width:100px;" id="txtTelefono4" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Grado de Instruccion</td>
                      <td><input name="txtTelefono5" type="text"  style="width:100px;" id="txtTelefono5" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Lugar de Nacimiento</td>
                      <td><input name="txtTelefono" type="text"  style="width:100px;" id="txtTelefono" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Ocupacion Laboral</td>
                      <td><input name="txtTelefono6" type="text"  style="width:100px;" id="txtTelefono6" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Condicion Laboral</td>
                      <td><input name="txtTelefono7" type="text"  style="width:100px;" id="txtTelefono7" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                    <tr>
                      <td height="23">Situacion Clase Vivienda</td>
                      <td><input name="txtTelefono8" type="text"  style="width:100px;" id="txtTelefono8" value=""
                                                                   onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" <?php echo $readonly ?>/></td>
                    </tr>
                  </table>
                </fieldset></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="top">
          <td></td>
          <td></td>
        </tr>
      </table></td>
  </tr>
  
  <div id="complementarios" style="visibility:hidden;display: none;">  </div>
  <tr>
    <td height="90" colspan="2">
    <fieldset id="fsDomcilio">
        <legend>Domicilio Fiscal </legend>
        <div id="divDomicilioFiscal">
        <input name="ubigeo" type="hidden" value="<?php echo $p23; ?>" />
        <input name="anio_ubigeo" type="hidden" value="<?php echo $p24; ?>" />
        <table border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">

		<tr>
        <td colspan="3">
        <div id="ubigeo">        </div>        </td>
        <tr>
        <td>Direccion</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">
                <input name="txtDireccion" type="text" size="65" id="txtDireccion"  value=""/>            </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        </table>
        </div>
        </fieldset>    </td>
  </tr>
  <tr>
    <td height="120" colspan="2" align="right" valign="top">
<div id="toolbar">
<table border="0" cellpadding="0" cellspacing="0" style="font-size:11px">
    <tr>
    	<td>        </td>
        <td></td>
        <td width="20">        </td>
        <td></td>
        <td>
        <a href="#" onclick="CargarVentana('grid_caja2','Registro de Filiaciones del Paciente','../admision/filiacion_personas.php?iid_persona='+document.form_detalle.txtCodigoPersona.value,'750','500',false,true,'',1,'',10,10,10,10);"><img src="../../../../medifacil_front/imagen/btn/b_filiacion.gif" width="61" height="24" /></a>        </td>
        <td>
        <a href="#" onclick="CargarVentana('grid_caja3','Adjuntar Fotografia del DNI','../admision/upload_dni.php','500','300',true,true,'','','',10,10,80,10);">
        <img src="../../../../medifacil_front/imagen/btn/btn_dni_adjuntar.gif" />		</a>        </td>
    </tr>
</table>
</div>
<div id="toolbar">
<table border="0" cellpadding="0" cellspacing="0" style="font-size:11px">
    <tr>
    	<td><div id="Resp" style="height:15px; width:180px;"></div></td>
        <td></td>
        <td width="20"></td>
        <td>&nbsp;</td>
        <td><a href="#" onclick="myajax.Link('../admision/registro_personas.php','datos_persona')"><img src="../../../../medifacil_front/imagen/btn/b_nuevo_on.gif" width="61" height="24" /></a></td>
        <td>
        <a href="#" onclick="javascript: myajax.Link('../../ccontrol/control/control.php?'+myajax.DataForm($('form_detalle')),'Resp')">
        <img src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif" width="61" height="24" />        </a>        </td>
    </tr>
</table>
</div></td>
  </tr>
</table>
</form>