<?php
$enabled="";
$disabled="";
$readonly="";
$txt_telefono_obs='';
$txt_celular_obs="";
$txt_celular2_obs="";
$txt_nacimiento_obs="";
$txt_email_obs="";
$txt_colegio_obs="";
$txt_estudio_obs="";
$btnhabil='';
$cb_combo="";
$accion='';
$trabajador='';
$iid_persona="";
$imagen	="../../../imagen/dni/dni_fondo.gif";
//echo $cb_tipDc;
//print_t($_SESSION);
$p=array();
?>
<form id="form_detalle" name="form_detalle">
<input name="txtCodigoPersona" id="txtCodigoPersona" type="hidden"  value="<?php echo $p['iid_persona']; ?>" />
<input name="p1" id="p1" type="hidden" value="mantenimiento_persona" />
<input name="p_acc" id="p_acc" type="hidden" value="<?php echo $accion ?>" />
<input name="trabajador" id="trabajador" type="text" value="<?php echo $trabajador ?>"/>
<div class="titleform">
    <h1>Datos del Paciente</h1>
</div>
<div style="float:left;border:0px solid #000000;width:75%;height:205px;padding:0px;overflow:auto;margin:1px;">
    <table width="100%">
        <tr>
            <td width="100%">
                <fieldset>
                    <legend>Nombre</legend>
                    <table width="407" height="65" border="0" cellpadding="0" cellspacing="2" style="font-size:11px">
                        <tr bordercolor="#000000">
                            <td width="118" >Apellido Paterno * </td>
                            <td width="286"><input name="txtApellidoPat" type="text" id="txtApellidoPat" style="width:250px;"  title="Apellido Paterno" <?php echo $readonly ?>/></td>
                        </tr>
                        <tr bordercolor="#000000">
                            <td>Apellido Materno* </td>
                            <td><input name="txtApellidoMat" type="text" style="width:250px;" id="txtApellidoMat"   title="Apellido Materno" <?php echo $readonly ?>/></td>
                        </tr>
                        <tr bordercolor="#000000">
                            <td>Nombres*</td>
                            <td><input name="txtNombrePaciente" type="text" style="width:250px;" id="txtNombrePaciente" title="Nombres" <?php echo $readonly ?>/></td>
                        </tr>
                        <tr>
                            <td width="116" height="23" bordercolor="#000000" >Fecha Nacimiento * </td>
                            <td width="287"><input name="txtFechaNacimiento" type="text"  style="width:100px;" id="txtFechaNacimiento"  onkeypress="return validFormSalt('txt',this,event,'cb_tipDc')" title="Fecha Nacimiento" <?php echo $readonly ?>/>
                            <a href="#" onclick="displayCalendar(document.getElementById('txtFechaNacimiento'),'dd/mm/yyyy',document.getElementById('txtFechaNacimiento'),true);"><img src="../../../../fastmedical_front/imagen/icono/date.png" border="0" /></a>            </td>
                        </tr>
                        <tr>
                            <td height="23" bordercolor="#000000">Edad</td>
                            <td><input name="txtEdad" type="text" style="width:250px;" id="txtEdad" readonly="readonly"/></td>
                        </tr>
                        <tr>
                          <td height="23" bordercolor="#000000">Tip Doc * </td>
                          <td><select name="cb_tipDc" id="cb_tipDc" style="width:250px;" <?php echo $disabled ?>  onchange="validFormSalt('cbo',this,event,'txtNroDocIdent')" onkeypress="return validFormSalt('alf',this,event,'txtNroDocIdent')">
                              <?php echo $cb_tipDc;?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td height="23" bordercolor="#000000">Doc. Identidad * </td>
                          <td><input name="txtNroDocIdent" type="text" style="width:100px;" id="txtNroDocIdent" onkeypress="return validFormSalt('nro',this,event,'sexo')" title="Documento Identidad" <?php echo $readonly ?>/>
                          </td>
                        </tr>                                                                            
                    </table>
            </fieldset>    
            </td>
        </tr>
    </table>	
</div>
<div style="float:right;border:0px solid #000000;width:24%;height:205px;padding:0px;overflow:auto;margin:1px;">
    <fieldset style="margin:0px; padding:0px;">
        <legend>DNI</legend>
        <center>
            <div id="foto" style=" height:184px;width:153px;">
            	<img align="middle" height="184px" width="150" src="../../../imagen/dni/dni_fondo.gif" />
            </div>
        </center>
    </fieldset>  
</div>
<div style="float:left;border:0px solid #000000;width:100%;height:250px;padding:0px;overflow:auto;margin:1px;">
    <fieldset>
    <legend>Datos</legend>
        <table width="406" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px; height:110px;"> 
        <tr>
          <td height="23" bordercolor="#000000">His. Fisica</td>
          <td>
              <input name="txtNroHistoria" type="text"  style="width:100px;" id="txtNroHistoria" readonly="readonly"/>
              <input name="idCalendario" type="button" id="idCalendario" value="&gt;"  <?php echo $disabled ?> onclick="generaHistoria();"/>                              </td>
        </tr>
        <tr>
          <td width="104" height="23" >Sexo* </td>
          <td width="251" align="left">
            <select name="sexo" id="sexo" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_civil')" onkeypress="return validFormSalt('alf',this,event,'cb_civil')">
              <option>Seleccionar</option>
              <option value="1" <?php if($p['csexo']=='1') echo "selected=selected"?>>Hombre</option>
              <option value="0" <?php if($p['csexo']=='0') echo "selected=selected"?>>Mujer</option>
            </select>                              </td>
        </tr>
        <tr>
          <td height="23">Estado Civil</td>
          <td >
            <select name="cb_civil" id="cb_civil" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_sanguineo')" onkeypress="return validFormSalt('alf',this,event,'cb_sanguineo')">
              <?php echo $cb_civil;?>
            </select>
              <input type="hidden" name="txtCivil" id="txtCivil" size="15" <?php echo $readonly ?>/>                              </td>
        </tr>
        <tr>
          <td height="23"  style="width:80px;">Telefono</td>
          <td>
              <input name="txtTelefono" type="text"  style="width:100px;" id="txtTelefono"  title="Telefono" <?php echo $readonly ?>/>
              <input type="hidden" name="txtTelefonoObs" id="txtTelefonoObs" size="15" <?php echo $readonly ?>/>                                 
          </td>
        </tr>
        <tr>
          <td height="23">Celular</td>
          <td>
              <input name="txtCelular" type="text"  style="width:100px;"id="txtCelular" title="Telefono" <?php echo $readonly ?>/>
              <input type="hidden" name="txtCelularObs" id="txtCelularObs" size="15" <?php echo $readonly ?>/>
          </td>
        </tr>
          <tr>
            <td height="23">Grupo Sang.</td>
            <td><select name="cb_sanguineo" id="cb_sanguineo"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtTelefono')" onkeypress="return validFormSalt('alf',this,event,'txtTelefono')">
                <?php echo $cb_sanguineo;?>
              </select>
                <input type="hidden" name="textSanguineo" id="textSanguineo" size="15" <?php echo $readonly ?>/>                                    </td>
          </tr>
          <tr>
            <td height="23">Celular 2</td>
            <td>
                <input name="txtCelular2" type="text" style="width:100px;" id="txtCelular2"  title="Fax" <?php echo $readonly ?>/>
                <input type="hidden" name="txtCelular2Obs" id="txtCelular2Obs" size="15"  <?php echo $readonly ?>/>
            </td>
          </tr>
          <tr>
            <td height="23">Correo</td>
            <td>
                <input name="txtEmail" type="text"  style="width:250px;"  id="txtEmail"   title="Correo" <?php echo $readonly ?>/>
                <input type="hidden" name="txtEmailObs" id="txtEmailObs" size="15" <?php echo $readonly ?>/>
            </td>
          </tr>
          <tr>
            <td height="23">Lugar de Nacimiento</td>
            <td>
                <input name="txtNacimiento" type="text"  style="width:100px;" id="txtNacimiento"   title="Correo" <?php echo $readonly ?>/>
                <input type="hidden" name="txtNacimientoObs" id="txtNacimientoObs" size="15" <?php echo $readonly ?>/>
            </td>
          </tr>        
        </table>
    </fieldset> 
</div>
<div name="divComplementarios" id="divComplementarios" style="float:left;border:0px solid #000000;width:100%;height:232px;padding:0px;overflow:auto;margin:1px;">
    <fieldset>
   	 <legend>Complementarios</legend>
        <table width="412" height="65" border="0" cellpadding="0" cellspacing="1" style="font-size:11px">
      <tr>
            	<td width="131" height="23">Nombre Colegio</td>
              <td width="278" align="left">
                  <input name="txtColegio" id="txtColegio" type="text"  style="width:250px;"  title="Telefono" <?php echo $readonly ?>/>
                  <input type="hidden" name="txtColegioObs" id="txtColegioObs" size="15" <?php echo $readonly ?>/>
              </td>
          </tr>
            <tr>
    	        <td height="23">Grado de Estudio</td>
        	    <td >
                        <input name="txtEstudio" id="txtEstudio" type="text" style="width:250px;"  title="Telefono" <?php echo $readonly ?>/>
                        <input type="hidden" name="txtEstudioObs" id="txtEstudioObs" size="15" <?php echo $readonly ?>/>
                    </td>
            </tr>
            <tr>
            	<td height="23">Grado de Instruccion</td>
            	<td>
                <select name="cb_instruccion" id="cb_instruccion"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtTelefono')" onkeypress="return validFormSalt('alf',this,event,'txtTelefono')">
            		<?php echo $cb_instruccion;?>
	            </select>
    	        <input name="txtInstruccion" id="txtInstruccion" type="hidden"  style="width:100px;" title="Instruccion" <?php echo $readonly ?>/>
                </td>
            </tr>
            <tr>
        	<td height="23">Ocupacion Laboral</td>
            	<td>
                    <input name="txtOcupacion" type="text"  style="width:250px;"  id="txtOcupacion" title="Telefono" <?php echo $readonly ?>/>
                </td>
            </tr>
            <tr>
	            <td height="23">Condicion Laboral</td>
    	        <td>
                <select name="cb_condicion" id="cb_condicion"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtTelefono')" onkeypress="return validFormSalt('alf',this,event,'txtTelefono')">
        	    	<?php echo $cb_condicion;?>
	            </select>
    	        <input name="txtCondicion" type="hidden"  style="width:100px;" id="txtCondicion" title="Telefono" <?php echo $readonly ?>/>                                    </td>
            </tr>
            <tr>
        	    <td height="23">Situacion Clase Vivienda</td>
            	<td>
                	<select name="cb_vivienda" id="cb_vivienda"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtTelefono')" onkeypress="return validFormSalt('alf',this,event,'txtTelefono')">
		        	    <?php echo $cb_vivienda;?>
        		    </select>
		            <input name="txtClaseVivienda" type="hidden"  style="width:100px;" id="txtClaseVivienda" title="Telefono" <?php echo $readonly ?>/>
                </td>
            </tr>
            <tr>
	            <td height="23">Clase de raza</td>
    	        <td>
                	<select name="cb_raza" id="cb_raza"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtTelefono')" onkeypress="return validFormSalt('alf',this,event,'txtTelefono')">
			            <?php echo $cb_raza;?>
            		</select>
		            <input name="txtRaza" type="hidden"  style="width:100px;" id="txtRaza" title="Telefono" <?php echo $readonly ?>/>
               </td>
            </tr>
            <tr>
	            <td height="23">No Hijos</td>
    	        <td>
                    <input name="txtHijos" type="text"  style="width:100px;" id="txtHijos" title="Telefono" <?php echo $readonly ?>/>
                </td>
            </tr>
    </table>
    </fieldset>
</div>
<div name="divDomicilio" id="divDomicilio" style="float:left;border:0px solid #000000;width:100%;height:250px;padding:0px;overflow:auto;margin:1px;">
    <fieldset id="fsDomcilio">
        <legend>Domicilio Fiscal </legend>
        <table width="98%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">
            <tr>
            	<td colspan="3"><div id="ubigeo"> <?php echo html_entity_decode($cb_combo); ?> </div></td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td><input name="ubigeo" type="hidden" /></td>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="3">
                    <input name="txtDireccion" type="text" size="65" id="txtDireccion"  <?php echo $readonly ?>/>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div id="toolbar2">
		    <?php
                        $toolbar=new ToollBar("left");
                        $toolbar->SetBoton("btn_FILIACION","Filiacion","btn","onclick,onkeypress","ventana_filiacion()","../../../../fastmedical_front/imagen/icono/normal.png","","",true);
                        $toolbar->SetBoton("btn_DNI","Adjuntar Fotografia del DNI","btn","onclick,onkeypress","ventana_add_dni()","../../../../fastmedical_front/imagen/icono/adjunto.gif","","",true);
                        $toolbar->Mostrar();
                        ?>
                    </div>
                    <div id="toolbar">
			<?php
                        //echo "$iid_persona  $btnhabil  $btndeshabil<br>";
                        $toolbar=new ToollBar("left");
                        $toolbar->SetBoton("btn_EDITAR","Editar","btn","onclick,onkeypress","editar_persona()","../../../../fastmedical_front/imagen/icono/editar.png","","",$btnhabil);
                        $toolbar->SetBoton("btn_GRABAR","Guardar","btn","onclick,onkeypress","guardar_persona()","../../../../fastmedical_front/imagen/icono/grabar.png","","",$btnhabil);
                        $toolbar->SetBoton("btn_RESTAURAR","Restaurar","btn","onclick,onkeypress","restauraCambios()","../../../../fastmedical_front/imagen/icono/undo.png","","",false);
                        $toolbar->Mostrar();
                        ?>
                    </div>
                    <div id="Resp" style="height:15px; width:180px;"></div>
                <p>&nbsp;</p>
                </td>
            </tr>
            </table>
    </fieldset>    
</div>
</form>