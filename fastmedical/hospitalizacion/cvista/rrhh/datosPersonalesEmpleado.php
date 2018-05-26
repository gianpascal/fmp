<form id="form_detalle" name="form_detalle" action="">

  <div class="titleform">
    <h1>-</h1>
  </div>
<div id="botones" >
    <ul id="tabs">
        <li>
            <div id="btn_PERSONALES" ><a href="#"  accesskey="3">PERSONALES</a></div>
        </li>
        <li>
            <div id="btn_DATOS" ><a href="#"  >DATOS</a></div>
        </li>
        <li>
            <div id="btn_FILIACIONES" ><a href="#" >AFILIACIONES</a></div>
        </li>
        <li>
            <div id="btn_ATENCIONES" ><a href="#" >ATENCIONES</a></div>
        </li>
    </ul>
</div>
<div id="tab1">
<div style="float:left;border:0px solid #000000;width:72%;height:310px;padding:0px;overflow:auto;margin:1px;">
    <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
        <legend>Nombre</legend>
        <table width="95%" border="0" cellpadding="0" cellspacing="2" style="font-size:11px">
            <tr>
              <td height="23" valign="top" colspan="2">                  
                  <div id='divDNI' style="display:none;position: absolute;color: #000000;background:#ffffff;border:#000000 1px solid;"></div>
              </td>
            </tr>
            <tr>
                <td width="30%" >Apellido Paterno * </td>
                <td width="70%">
                    <input tabindex=2 name="txtApellidoPat" class="textPatronNombre" type="text" id="txtApellidoPat" value="" style="width:250px;" onkeypress="return validFormSalt('txt',this,event,'txtApellidoMat')" onblur="buscar_personasxApellidos();" title="Apellido Paterno" />
                    <!--<a href="#" onclick="acredita_essalud();">Acreditar con Esalud</a>-->
                </td>
            </tr>
            <tr>
                <td width="30%">Apellido Materno* </td>
                <td width="70%"><input tabindex=3 name="txtApellidoMat" class="textPatronNombre" type="text" style="width:250px;" id="txtApellidoMat" value="" onkeypress="return validFormSalt('txt',this,event,'txtNombrePaciente')" onblur="buscar_personasxApellidos();" title="Apellido Materno" /></td>
            </tr>
            <tr>
                <td width="30%">Nombres*</td>
                <td width="70%">
                    <input tabindex=4 name="txtNombrePaciente" class="textPatronNombre" type="text" style="width:250px;" id="txtNombrePaciente" value="" onkeypress="$('divNombrePaciente').hide();return validFormSalt('txt',this,event,'txtFechaNacimiento')" onblur="valida_nombre_persona(this);"  title="Nombres" />
                    <div id='divNombrePaciente' onmouseover="$('divNombrePaciente').show();" onmouseout="$('divNombrePaciente').hide();" style="display:none;position: absolute;color: #FFFFFF;background:#ffffff;border:#D8D8D8 1px solid;overflow: scroll;height: 200px;width: auto;"></div>
                </td>
            </tr>
            <tr>
                <td width="30%" height="23">Fecha Nacimiento * </td>
                <td width="70%">
                    <input tabindex=5 name="txtFechaNacimiento" type="text" style="width:100px; font-size:12px;" id="txtFechaNacimiento"  value="" onkeypress="return validFormSalt('cbo',this,event,'sexo');" title="Fecha Nacimiento" onclick="calendarioHtmlx('txtFechaNacimiento');" onfocus="calendarioHtmlx('txtFechaNacimiento');"  readonly="true">

                </td>
            </tr>
            <tr>
                <td width="30%" height="23">Edad</td>
                <td width="70%"><input name="txtEdad" type="text" style="width:250px;" id="txtEdad" value="" onkeypress="return validFormSalt('cbo',this,event,'sexo');" readonly="readonly"/></td>
            </tr>
            <tr>
              <td width="30%" height="23" >Sexo* </td>
              <td width="70%" align="left">
                  <select tabindex=6 name="sexo" id="sexo" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'cb_civil');" onkeypress="return validFormSalt('cbo',this,event,'cb_civil')" title="Sexo">
                  <option value="">Seleccionar</option>
                  <option value="1" <?php if($sexo=='1') echo "selected=selected"?>>Hombre</option>
                  <option value="0" <?php if($sexo=='0') echo "selected=selected"?>>Mujer</option>
                </select>
              </td>
            </tr>
            <tr>
              <td width="30%" height="23" >Estado Civil </td>
              <td width="70%" align="left">
                  <select tabindex=7 name="cb_civil" id="cb_civil" style="width:100px;"  onchange="validFormSalt('txt',this,event,'txtTelefono');" onkeypress="return validFormSalt('txt',this,event,'txtTelefono')">
                    
                  </select>
              </td>
            </tr>
            <tr>
              <td width="30%" height="23" >Telef /Cel1 /Cel2</td>
              <td width="70%" align="left">
                <input tabindex=8 name="txtTelefono" type="text"  style="width:80px;" id="txtTelefono" value="<?php echo trim($telefono); ?>"  onkeypress="return validFormSalt('nro',this,event,'txtCelular')" title="Telefono" />
                <input tabindex=9 name="txtCelular" type="text"  style="width:80px;"id="txtCelular" value="<?php echo trim($celular); ?>" onkeypress="return validFormSalt('nro',this,event,'txtCelular2')" title="Celular" />
                <input tabindex=10 name="txtCelular2" type="text" style="width:80px;" id="txtCelular2"  value="<?php echo trim($celular2);?>"  onkeypress="return validFormSalt('nro',this,event,'txtEmail')"  title="Celular 2" />
              </td>
            </tr>
            <tr>
              <td width="30%" height="23" >Correo</td>
              <td width="70%" align="left">
                <input tabindex=11 name="txtEmail" type="text"  style="width:250px;"  id="txtEmail"  value="<?php echo trim($email); ?>" onkeypress="return validFormSalt('alf',this,event,'cb_medio_contacto')"  title="Correo" />
              </td>
            </tr>
            <tr>
	        <td width="30%" height="23">Medio de Contacto</td>
                <td width="70%" align="left">
                    <select tabindex=12 name="cb_medio_contacto" id="cb_medio_contacto"  style="width:180px;" <?php echo $disabled ?> onchange="validFormSalt('cbo',this,event,'txtObservaciones');" onkeypress="validFormSalt('cbo',this,event,'cb_departamento')">
                        
                    </select>
                </td>
            </tr>
        </table>
    </fieldset>
</div>
<div style="float:right;border:0px solid #000000;width:27%;height:300px;padding:0px;overflow:auto;margin:1px;">
    <fieldset style="margin:0px; padding:0px;height: 215px">
        <legend>Fotografia</legend>
        <center>
            <div id="foto" style=" height:159px;width:120px;">
            	<img align="middle" alt="Fotografia personal" height="159px" width="120" src="../../../imagen/pacientes/<?php  echo $dni_fondo;?>" />
            </div>
            <?php
            $toolbar1=new ToollBar("center");
            $toolbar1->SetBoton("DNI","Adjuntar Fotografia","btn","onclick,onkeypress","ventana_add_dni()","../../../../fastmedical_front/imagen/icono/adjunto.gif","","",$btndeshabil);
            $toolbar1->Mostrar();
            ?>
            <input type="hidden" name="txtFotografia" id="txtFotografia" style="width:90px;" value="<?php echo $dni_fondo;?>"/>
        </center>
    </fieldset><br>
    <fieldset style="margin:0px; padding:0px;height:20px;">
        <center>
            <table width="95%" border="0">
            <tr>
                <td  valign="middle"><input type="checkbox" <?php echo $disabled;?> name="chkValida" id="chkValida" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="0"></td>
                <td>Por regularizar</td>
            </tr>
        </table>
        </center>
    </fieldset>
    <fieldset style="margin:0px; padding:0px;height:50px;display: none;">
        <legend>Huella Digital</legend>
        <center>
        <table>
            <tr>
                <td  valign="middle"><input type="checkbox" name="chkHuella" id="chkHuella" value="1"></td>
                <td  valign="bottom">
                    <?php
                    $toolbar3=new ToollBar("center");
                    $toolbar3->SetBoton("HUELLA","Adjuntar","btn","onclick,onkeypress","ventana_add_dni()","../../../../fastmedical_front/imagen/icono/adjunto.gif","","",$btndeshabil);
                    $toolbar3->Mostrar();
                    ?>
                </td>
            </tr>
        </table>
        </center>
    </fieldset>
</div>
</div>

<div id="tab3" style="float:left;border:0px solid #000000;width:100%;height:145px;padding:0px;overflow:auto;margin:1px;">
    <fieldset id="fsDomcilio">
        <legend>Domicilio Fiscal </legend>
        <table width="100%" border="0" cellpadding="0" cellspacing="2"  style="font-size:10px">
            <tr>
            	<td colspan="3">
                    <div id="ubigeo"> <?php echo html_entity_decode($cb_combo); ?> </div>
                </td>
            </tr>
             <tr>
                 <td style="width:115px;">Tipo de via:</td>
                <td style="width:100px;">
                    <select tabindex=16 name="cb_via" id="cb_via"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('txt',this,event,'txtNombreTipoVia');" onkeypress="return validFormSalt('txt',this,event,'txtNombreTipoVia')">
                        <?php echo $cb_via;?>
                    </select>
                </td>
                <td><input tabindex=17 type="text" name="txtNombreTipoVia" id="txtNombreTipoVia" <?php echo $readonly;?> style="width:250px" value="<?php echo $nombre_tipo_via;?>" onkeypress="return validFormSalt('alf',this,event,'txtNumero')"/></td>
                <td>Numero:<input tabindex=18 type="text" name="txtNumero" id="txtNumero" <?php echo $readonly;?> style="width:50px" onkeypress="return validFormSalt('nro',this,event,'txtKm')" value="<?php echo trim($numero);?>"></td>
                <td>km:<input tabindex=19 type="text" name="txtKm" id="txtKm" <?php echo $readonly;?> style="width:50px" onkeypress="return validFormSalt('nro',this,event,'cb_cpo')" value="<?php echo trim($kilometro);?>"></td>
            </tr>
             <tr>
                <td>Tipo de centro poblado:</td>
                <td>
                    <select tabindex=20 name="cb_cpo" id="cb_cpo"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('txt',this,event,'txtTipoCentroPoblado');"  onkeypress="return validFormSalt('txt',this,event,'txtTipoCentroPoblado')">
                        <?php echo $cb_cpo;?>
                    </select>
                </td>
                <td><input tabindex=21 type="text" name="txtTipoCentroPoblado" id="txtTipoCentroPoblado" <?php echo $readonly;?> style="width:250px" onkeypress="return validFormSalt('alf',this,event,'txtManzana')" value="<?php echo trim($nombre_tipo_centro_poblado);?>">
                </td>
                <td>Manzana:<input tabindex=22 type="text" name="txtManzana" id="txtManzana" <?php echo $readonly;?> style="width:50px" onkeypress="return validFormSalt('alf',this,event,'txtLote')" value="<?php echo trim($manzana);?>">
                </td>
               <td>
                    Lote:<input tabindex=23 type="text" name="txtLote" id="txtLote" <?php echo $readonly;?> style="width:50px" onkeypress="return validFormSalt('alf',this,event,'vReferencia')" value="<?php echo trim($lote);?>">
               </td>


            </tr>
            <tr>
                <td>
                    Referencia:
                </td>
                <td colspan="5">
                    <textarea tabindex=24 id="vReferencia" name="vReferencia" cols="80" rows="1" onkeypress="return validFormSalt('alf',this,event,'txtObservaciones')" <?php echo $readonly;?> ><?php echo $vReferencia ;?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div id="toolbar2"></div>
                    <div id="Resp" style="height:15px; width:180px;display: none;"></div>
                </td>
            </tr>
            </table>
    </fieldset>
</div>

<div id="tab6" style="float:left;border:0px solid #000000;width:100%;height:95px;padding:0px;overflow:auto;margin:1px;">
    <fieldset id="fsDomcilio">
        <legend>Observaciones</legend>
        <table width="100%" border="0" cellpadding="2" cellspacing="3"  style="font-size:11px">
            <tr>
                <td width="15%">&nbsp;</td>
                <td>
                    <textarea tabindex=25 id="txtObservaciones" name="txtObservaciones" cols="80" rows="2" onkeypress="return validFormSalt('alf',this,event,'btn_DATOS')" <?php echo $readonly;?> ><?php echo $observaciones;?></textarea>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </fieldset>
</div>

<div id="tab5" style="float:left;border:0px solid #000000;width:100%;height:50px;padding:0px;overflow:auto;margin:1px;">
    <table width="90%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">
        <tr>
            <td colspan="3">
                <div id="toolbar">
                    <?php
                    $toolbar=new ToollBar("left");
                    $toolbar->SetBoton("EDITAR","Editar","btn","onclick,onkeypress","editar_persona()","../../../../fastmedical_front/imagen/icono/editar.png","","",$btnhabil);
                    $toolbar->SetBoton("GRABAR","Guardar","btn","onclick,onkeypress","guardar_persona()","../../../../fastmedical_front/imagen/icono/grabar.png","","",$btndeshabil);
                    $toolbar->SetBoton("RESTAURAR","Restaurar","btn","onclick,onkeypress","restauraCambios()","../../../../fastmedical_front/imagen/icono/undo.png","","",($accion=='inserted'?0:$btndeshabil));
                    $toolbar->Mostrar();
                    ?>
                </div>
                <div id="Resp" style=" width:280px;border:0px solid #000000;" ></div>

            </td>
        </tr>
    </table>
</div>
</form>