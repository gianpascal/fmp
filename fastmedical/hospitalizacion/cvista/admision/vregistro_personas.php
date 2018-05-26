<div style="width: 99%">


    <form id="form_detalle" name="form_detalle" action="">
        <input name="txtCodigoPersona" id="txtCodigoPersona" type="hidden"  value="<?php echo $iid_persona; ?>" />
        <input name="dh_filiacion" id="txtAfiliacionPersona" type="hidden"  value="<?php echo $afiliacionPersona; ?>" />

        <input name="p1" id="p1" type="hidden" value="mantenimiento_persona" />
        <input name="hExisteDocumento" id="hExisteDocumento" type="hidden" value="si"  />
        <input name="p_acc" id="p_acc" type="hidden" value="<?php echo $accion; ?>" />
        <input name="funcionJSEjecutar" id="funcionJSEjecutar" type="hidden" value="<?php echo $funcion; ?>" />
        <div class="titleform" style="border: 0px solid #000000;width:100%;" id="divTitulo">
            <h1><?php ($accion == 'INSERTED' ? '' : '-') ?> <?php echo "&nbsp;&nbsp;" . htmlentities($vapellido_pat) . " " . htmlentities($vapellido_mat) . " " . htmlentities($vnombre) . " - " . htmlentities($iid_persona) . " - " . "NºHC : " . htmlentities($nro_historia_clinica); ?></h1>
            <?php $cod = htmlentities($iid_persona); ?>
        </div>

        <div id="botones" style="<?php echo $displayBotones; ?>">
            <ul id="tabs">
                <li>
                    <div id="btn_PERSONALES" style="<?php echo $btnPrincipal; ?>"><a href="#" onclick="$('tab1').show();
                        $('tab2').hide();
                        $('tab3').show();
                        $('tab4').hide();
                        $('tab5').show();
                        $('tab6').show();
                        $('tab7').hide();
                        $('tab8').hide();
                        $('txtApellidoPat').focus();" accesskey="3">PERSONALES</a></div>
                </li>
                <li>
                    <div id="btn_DATOS" style="<?php echo $btnPrincipal; ?>"><a href="#"  onclick="$('tab1').hide();
                        $('tab2').show();
                        $('tab3').hide();
                        $('tab4').hide();
                        $('tab5').show();
                        $('tab6').hide();
                        $('tab7').hide();
                        $('tab8').hide();
                        $('cb_civil').focus();">DATOS</a></div>
                </li>
                <li>
                    <div id="btn_FILIACIONES" style="<?php echo $btnSecundaria; //echo $btnOpcional;       ?>"><a href="#" onclick="$('tab1').hide();
                        $('tab2').hide();
                        $('tab3').hide();
                        $('tab4').show();
                        $('tab5').hide();
                        $('tab6').hide();
                        $('tab7').hide();
                        $('tab8').hide();
                        cargarTablaAfiliacionesPersona('<?php echo $cod; ?>')">AFILIACIONES</a></div>
                </li>
                <li>
                    <div id="btn_ATENCIONES" style="<?php echo $btnSecundaria; ?>"><a href="#" onclick="$('tab1').hide();
                        $('tab2').hide();
                        $('tab3').hide();
                        $('tab4').hide();
                        $('tab5').hide();
                        $('tab6').hide();
                        $('tab7').show();
                        $('tab8').hide();
                        myajax.Link('../../ccontrol/control/control.php?p1=ListaPersonaCitas&p2=' + $('txtCodigoPersona').value, 'citas_pac');">ATENCIONES</a></div>
                </li>
                <li>
                    <div id="btn_PARENTESCO" style="<?php echo $btnSecundaria; ?>"><a href="#" onclick="$('tab1').hide();
                        $('tab2').hide();
                        $('tab3').hide();
                        $('tab4').hide();
                        $('tab5').hide();
                        $('tab6').hide();
                        $('tab7').hide();
                        $('tab8').show();
                        listaParentescoPaciente();">PARENTESCO</a></div>
                </li>
                <!--            <li>
                                <div id="btn_HISTORIAS" style="<?php echo $btnSecundaria; ?>"><a href="#" onclick="$('tab1').hide();$('tab2').hide();$('tab3').hide();$('tab4').hide();$('tab5').hide();$('tab6').hide();$('tab7').hide();$('tab8').show(); obtenerCodigoPaciente();">HISTORIAS</a></div>
                            </li>-->
            </ul>
        </div>
        <div id="tab1">

            <fieldset style="margin:1px;width:100%;height:auto;padding:5px;">
                <legend>Nombre</legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-size:11px">
                    <tr>

                        <?php echo $documentosIdentidad; ?>


                    <div id='divDNI' style="display:none;position: absolute;color: #000000;background:#ffffff;border:#000000 1px solid; width:10%;"></div>

                    </tr>
                    <tr>
                        <td  >Apellido Paterno * </td>
                        <td >
                            <input tabindex=2 name="txtApellidoPat" class="textPatronNombre" type="text" id="txtApellidoPat" value="<?php echo utf8_encode(trim($vapellido_pat)); ?>" style="width:250px;" onkeypress="return validFormSalt('txt', this, event, 'txtApellidoMat')" onblur="buscar_personasxApellidos();" title="Apellido Paterno" <?php echo $readonly ?>/>

                        </td>
                        <td >Apellido Materno* </td>
                        <td ><input tabindex=3 name="txtApellidoMat" class="textPatronNombre" type="text" style="width:250px;" id="txtApellidoMat" value="<?php echo utf8_encode(trim($vapellido_mat)); ?>" onkeypress="return validFormSalt('txt', this, event, 'txtNombrePaciente')" onblur="buscar_personasxApellidos();" title="Apellido Materno" <?php echo $readonly ?>/></td>
                    </tr>

                    <tr>
                        <td >Nombres*</td>
                        <td >
                            <input tabindex=4 name="txtNombrePaciente" class="textPatronNombre" type="text" style="width:250px;" id="txtNombrePaciente" value="<?php echo utf8_encode(trim($vnombre)); ?>" onkeypress="$('divNombrePaciente').hide();
                                    return validFormSalt('txt', this, event, 'txtFechaNacimiento')" onblur="valida_nombre_persona(this);"  title="Nombres" <?php echo $readonly; ?>/>
                            <div id='divNombrePaciente' onmouseover="$('divNombrePaciente').show();" onmouseout="$('divNombrePaciente').hide();" style="display:none;position: absolute;color: #FFFFFF;background:#ffffff;border:#D8D8D8 1px solid;overflow: scroll;height: 200px;width: auto;"></div>
                        </td>
                        <td  height="23">Fecha Nacimiento * </td>
                        <td >
                            <input tabindex=5 name="txtFechaNacimiento" type="text" style="width:100px; font-size:12px;" id="txtFechaNacimiento"  value="<?php echo trim($fecha_nacimiento); ?>" onkeypress="return validFormSalt('alf', this, event, 'sexo');" title="Fecha Nacimiento"  onBlur="esFechaValida(this);"  <?php echo $readonly; ?>>

                        </td>
                    </tr>

                    <tr>
                        <td  height="23">Edad</td>
                        <td ><input name="txtEdad" type="text" style="width:250px;" id="txtEdad" value="<?php echo trim($edadpaciente); ?>" onkeypress="return validFormSalt('cbo', this, event, 'sexo');" readonly="readonly"/></td>
                        <td  height="23" >Sexo* </td>
                        <td align="left">
                            <select tabindex=6 name="sexo" id="sexo" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cb_civil');" onkeypress="return validFormSalt('cbo', this, event, 'cb_civil')" title="Sexo">
                                <option value="">Seleccionar</option>
                                <option value="1" <?php if ($sexo == '1') echo "selected=selected" ?>>Hombre</option>
                                <option value="0" <?php if ($sexo == '0') echo "selected=selected" ?>>Mujer</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td  height="23" >Estado Civil </td>
                        <td align="left">
                            <select tabindex=7 name="cb_civil" id="cb_civil" style="width:100px;" <?php echo $disabled ?> onchange="validFormSalt('txt', this, event, 'txtTelefono');" onkeypress="return validFormSalt('txt', this, event, 'txtTelefono')">
                                <?php echo $cb_civil; ?>
                            </select>
                        </td>
                        <td height="23" >Telef /Cel1 /Cel2</td>
                        <td  align="left">
                            <input tabindex=8 name="txtTelefono" type="text"  style="width:80px;" id="txtTelefono" value="<?php echo trim($telefono); ?>"  onkeypress="return validFormSalt('nro', this, event, 'txtCelular')" title="Telefono" <?php echo $readonly; ?>/>
                            <input tabindex=9 name="txtCelular" type="text"  style="width:80px;"id="txtCelular" value="<?php echo trim($celular); ?>" onkeypress="return validFormSalt('nro', this, event, 'txtCelular2')" title="Celular" <?php echo $readonly ?>/>
                            <input tabindex=10 name="txtCelular2" type="text" style="width:80px;" id="txtCelular2"  value="<?php echo trim($celular2); ?>"  onkeypress="return validFormSalt('nro', this, event, 'txtEmail')"  title="Celular 2" <?php echo $readonly ?>/>
                        </td>
                    </tr>

                    <tr>
                        <td  height="23" >Correo</td>
                        <td  align="left">
                            <input tabindex=11 name="txtEmail" type="text"  style="width:250px;"  id="txtEmail"  value="<?php echo trim($email); ?>" onkeypress="return validFormSalt('alf', this, event, 'cb_medio_contacto')"  title="Correo" <?php echo $readonly ?>/>
                        </td>
                        <td  height="23">Medio de Contacto</td>
                        <td  align="left">
                            <select tabindex=12 name="cb_medio_contacto" id="cb_medio_contacto"  style="width:180px;" <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'txtObservaciones');" onkeypress="validFormSalt('cbo', this, event, 'cb_departamento')">
                                <?php echo $cb_medios_contacto; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td  height="23">Por regularizar</td>
                        <td  valign="middle"><input type="checkbox" <?php echo $disabled; ?> name="chkValida" id="chkValida" onclick="if (this.checked) {
                                    this.value = 1
                                } else {
                                    this.value = 0;
                                }" value="0" <?php if ($chkRegularizar == 0) echo ""; ?>></td>
                    </tr>
                </table>

            </fieldset>



        </div>
        <div id="tab2" style="float:left;border:0px solid #000000;width:100%;padding:0px;margin:1px;display: none;">
            <fieldset style="padding:5px;height:70">
                <legend>Datos</legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px;">
                    <tr>
                        <td height="23" width="15%">Historia Fisica</td>
                        <td colspan="3">
                            <input name="txtNroHistoria" type="text"  style="width:100px;" id="txtNroHistoria" readonly="readonly" value="<?php echo htmlentities(trim($nro_historia_clinica)); ?>" onkeypress="return validFormSalt('nro', this, event, 'cb_raza')"/>
                            <input name="idHistoria" type="button" id="idHistoria" value="&gt;"  <?php echo $disabled ?> onclick="generaHistoria();"/>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">Clase de raza</td>
                        <td colspan="3">
                            <select name="cb_raza" id="cb_raza"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cbNac_departamento');" onkeypress="return validFormSalt('cbo', this, event, 'cbNac_departamento')">
                                <?php echo $cb_raza; ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
            </fieldset>
            <fieldset style="padding:5px;height:70">
                <legend>Lugar de nacimiento</legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px;">
                    <tr>
                        <td>
                            <div id="ubigeo2"> <?php echo html_entity_decode($cb_nacimiento); ?> </div>
                        </td>
                    </tr>
                </table><br>
            </fieldset>
            <fieldset style="padding:5px;height:50">
                <legend>Ocupacion Laboral</legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px;">
                    <tr>
                        <td colspan="4"><div id="ocupaciones"><?php echo $cb_ocupacion; ?></div></td>
                    </tr>
                </table><br>
            </fieldset>
            <fieldset style="padding:5px; height: 230px;">
                <legend>Situacion Laboral</legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px;">
                    <tr>
                        <td height="23" width="15%">Condicion Laboral</td>
                        <td colspan="3">
                            <select name="cb_condicion" id="cb_condicion"  style="width:180px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cb_instruccion');" onkeypress="return validFormSalt('cbo', this, event, 'cb_instruccion')">
                                <?php echo $cb_condicion; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">Grado de Instruccion</td>
                        <td colspan="3">
                            <select name="cb_instruccion" id="cb_instruccion"  style="width:180px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cb_tipoInstEduc');" onkeypress="return validFormSalt('cbo', this, event, 'cb_tipoInstEduc')">
                                <?php echo $cb_instruccion; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%" height="23">Tipo de Institucion educativa</td>
                        <td align="left" colspan="3">
                            <select name="cb_tipoInstEduc" id="cb_tipoInstEduc"  style="width:180px;"  <?php echo $disabled ?> onchange="cargar_nombreInstitucion();
                                validFormSalt('cbo', this, event, 'cb_InstEduc');" onkeypress="return validFormSalt('cbo', this, event, 'cb_InstEduc')">
                                        <?php echo $cb_tipoInstEduc; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%" height="23">Nombre de Institucion educativa</td>
                        <td align="left" colspan="3">
                            <div id="inst_educativa">
                                <select name="cb_InstEduc" id="cb_InstEduc"  style="width:180px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cb_grado_estudio');" onkeypress="return validFormSalt('cbo', this, event, 'cb_grado_estudio')">
                                    <?php echo $cb_InstEduc; ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">Grado de Estudio</td>
                        <td colspan="3">
                            <div id="grado_estudio">
                                <select name="cb_grado_estudio" id="cb_grado_estudio"  style="width:180px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'cb_vivienda');" onkeypress="return validFormSalt('cbo', this, event, 'cb_vivienda')">
                                    <?php echo $cb_grado_estudio; ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">Situacion Clase Vivienda</td>
                        <td colspan="3">
                            <select name="cb_vivienda" id="cb_vivienda"  style="width:100px;"  <?php echo $disabled ?> onchange="validFormSalt('cbo', this, event, 'txtHijos');" onkeypress="return validFormSalt('cbo', this, event, 'txtHijos')">
                                <?php echo $cb_vivienda; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">No Hijos</td>
                        <td colspan="3">
                            <input  name="txtHijos" class="textPatronNombre" type="text"  style="width:100px;" id="txtHijos" value="<?php echo trim($txt_hijos); ?>" onkeypress="return validFormSalt('nro', this, event, 'txtNroDeHijo');" title="Hijos" <?php echo $readonly ?>/>
                        </td>
                    </tr>
                    <tr>
                        <td height="23" width="15%">Numero de hijo</td>
                        <td colspan="3">
                            <input  name="txtNroDeHijo" id="txtNroDeHijo"  class="textPatronNombre" type="text"  style="width:100px;" value="<?php echo trim($txtNroHijos); ?>" onkeypress="return validFormSalt('nro', this, event, '');" title="Hijos" <?php echo $readonly ?>/>
                        </td>
                    </tr>
                </table><br>
            </fieldset>
        </div>
        <div id="tab3" >
            <fieldset id="fsDomcilio" style="padding:5px; width:100%">
                <legend>Domicilio Fiscal </legend>
                <table width="100%" border="0" cellpadding="0" cellspacing="0"  style="font-size:10px">


                    <tr>
                        <td></td>
                        <td colspan="2" style="width:90px;">
                            <div id="ubigeo"> <?php echo html_entity_decode($cb_combo); ?> </div> 
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Via:</td>
                        <td>
                            <select tabindex=16 name="cb_via" id="cb_via"  style="width:90px;"  <?php echo $disabled ?> onchange="validFormSalt('txt', this, event, 'txtNombreTipoVia');" onkeypress="return validFormSalt('txt', this, event, 'txtNombreTipoVia')">
                                <?php echo $cb_via; ?>
                            </select>
                        </td>
                        <td><input tabindex=17 type="text" name="txtNombreTipoVia" id="txtNombreTipoVia" <?php echo $readonly; ?> style="width:230px" value="<?php echo $nombre_tipo_via; ?>" onkeypress="return validFormSalt('alf', this, event, 'txtNumero')"/></td>
                        <td>Numero:
                            <input tabindex=18 type="text" name="txtNumero" id="txtNumero" <?php echo $readonly; ?> style="width:47px" onkeypress="return validFormSalt('nro', this, event, 'txtKm')" value="<?php echo trim($numero); ?>"></td>
                        <td>km:
                            <input tabindex=19 type="text" name="txtKm" id="txtKm" <?php echo $readonly; ?> style="width:47px" onkeypress="return validFormSalt('nro', this, event, 'cb_cpo')" value="<?php echo trim($kilometro); ?>"></td>
                    </tr>
                    <tr>
                        <td>Centro poblado:</td>
                        <td>
                            <select tabindex=20 name="cb_cpo" id="cb_cpo"  style="width:90px;"  <?php echo $disabled ?> onchange="validFormSalt('txt', this, event, 'txtTipoCentroPoblado');"  onkeypress="return validFormSalt('txt', this, event, 'txtTipoCentroPoblado')">
                                <?php echo $cb_cpo; ?>
                            </select>                </td>
                        <td><input tabindex=21 type="text" name="txtTipoCentroPoblado" id="txtTipoCentroPoblado" <?php echo $readonly; ?> style="width:230px" onkeypress="return validFormSalt('alf', this, event, 'txtManzana')" value="<?php echo trim($nombre_tipo_centro_poblado); ?>">                </td>
                        <td>Manzana:<input tabindex=22 type="text" name="txtManzana" id="txtManzana" <?php echo $readonly; ?> style="width:47px" onkeypress="return validFormSalt('alf', this, event, 'txtLote')" value="<?php echo trim($manzana); ?>">                </td>
                        <td>
                            Lote:<input tabindex=23 type="text" name="txtLote" id="txtLote" <?php echo $readonly; ?> style="width:47px" onkeypress="return validFormSalt('alf', this, event, 'vReferencia')" value="<?php echo trim($lote); ?>">               </td>
                    </tr>
                    <tr>
                        <td>
                            Referencia:                </td>
                        <td colspan="5">

                            <textarea tabindex=24 id="vReferencia" name="vReferencia" style="width:320px; font-family:Arial, Helvetica, sans-serif; font-size:12px ; height: 20px;"  cols="80" rows="1" onkeypress="return validFormSalt('alf', this, event, 'txtObservaciones')" <?php echo $readonly; ?> ><?php echo utf8_encode($vReferencia); ?></textarea>                </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <div id="toolbar2"></div>
                            <div id="Resp" style="height:15px; width:180px;display: none;"></div>                </td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div id="tab4" style="float:left;border:0px solid #000000;width:100%;height:550px;padding:0px;overflow:auto;margin:1px;display: none;">
            <?php
            //require_once("filiacion_personas.php");
            require_once("ActionPersona.php");
            $o_ActionAfiliaciones = new ActionAfiliaciones();
            $datos = array();
            $datos["codigoPersona"] = $iid_persona;
            $o_ActionAfiliaciones->cambiarAfiliacionGeneral($datos);
            ?>
        </div>
        <div id="tab6" >
            <fieldset id="fsDomcilio" style="width:100%;">
                <legend>Observaciones</legend>
                <table width="100%"   style="font-size:11px">
                    <tr>

                        <td>
                            <textarea tabindex=25 id="txtObservaciones" name="txtObservaciones" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px;  height: 20px;" cols="80" rows="1" onkeypress="return validFormSalt('alf', this, event, 'btn_DATOS')" <?php echo $readonly; ?> ><?php echo $observaciones; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div id="tab7" style="float:left;border:0px solid #000000;width:100%;height:408px;padding:0px;overflow:auto;margin:1px;display: none;">
            <?php require_once("citas_personas.php"); ?>
        </div>
        <div id="tab5" style="float:left;width:100%;height:40px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="1"  style="font-size:11px">
                <tr>
                    <td colspan="3">
                        <div id="toolbar" style="padding-left:230px;">
                            <?php
                            $toolbar = new ToollBar();
                            if (isset($_SESSION["permiso_formulario_servicio"][110]["EDITAR_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["EDITAR_PAC"] == 1)
                                $toolbar->SetBoton("EDITAR", "Editar", "btn", "onclick,onkeypress", "editar_persona()", "../../../../fastmedical_front/imagen/icono/editar.png", "", "", $btnhabil);
                            if (isset($_SESSION["permiso_formulario_servicio"][110]["GUARDAR_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["GUARDAR_PAC"] == 1)
                                $toolbar->SetBoton("GRABAR", "Guardar", "btn", "onclick,onkeypress", "guardar_persona()", "../../../../fastmedical_front/imagen/icono/grabar.png", "", "", $btndeshabil);
                            if (isset($_SESSION["permiso_formulario_servicio"][110]["REST_PAC"]) && $_SESSION["permiso_formulario_servicio"][110]["REST_PAC"] == 1)
                                $toolbar->SetBoton("RESTAURAR", "Restaurar", "btn", "onclick,onkeypress", "restauraCambios()", "../../../../fastmedical_front/imagen/icono/undo.png", "", "", ($accion == 'inserted' ? 0 : $btndeshabil));
                            if (isset($_SESSION["permiso_formulario_servicio"][110]["IMPRIMIR_HC"]) && $_SESSION["permiso_formulario_servicio"][110]["IMPRIMIR_HC"] == 1)
                                $toolbar->SetBoton("IMPRIMIRHC", "Imprimir HC", "btn", "onclick,onkeypress", "mostrarHistoriaClinica()", "../../../../fastmedical_front/imagen/icono/printer.png", "", "", 1);
                            if (isset($_SESSION["permiso_formulario_servicio"][110]["CONSULTAR_HC"]) && $_SESSION["permiso_formulario_servicio"][110]["CONSULTAR_HC"] == 1)
                                $toolbar->SetBoton("CONSULTARHC", "Consultar HC", "btn", "onclick,onkeypress", "mostrarVentanaHistoriaClinica()", "../../../../fastmedical_front/imagen/icono/historial.png", "", "", 1);
                            $toolbar->Mostrar();
                            ?>
                        </div>
                        <div id="Resp" style=" width:280px;border:0px solid #000000;" ></div>

                    </td>
                </tr>
            </table>
        </div>
        <div id="tab8" style="float:left;border:0px solid #000000;width:100%;height:408px;padding:0px;overflow:auto;margin:1px;display: none;">
            <?php require_once("parentescoPersona.php"); ?>
        </div>

    </form>

</div>