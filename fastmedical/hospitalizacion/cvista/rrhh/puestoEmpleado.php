<?php
$toolbar0 = new ToollBar("right");
$toolbar1 = new ToollBar("left");
$toolbar2 = new ToollBar("right");
$toolbar3 = new ToollBar("right");
?>
<form id="form_detalle" name="form_detalle" action="">
    <div style="width:99%; margin:1px auto; border: #006600" >
        <div class="titleform" id="divTitulo" >
        </div>
    </div>
    <input id="hidIdArea" name="hidIdArea" value="" type="hidden"/>
    <div  id ="divPuesto" style="width:99%;margin-left:1%;margin-right:1%;" align="center">
        <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
            <legend>&nbsp; Registrar Modalidad Contrato &nbsp;</legend>
    <!--           <input id="hidFilaTablaArea" name="hidFilaTablaArea" type="hidden" value="">  -->
            <div style="margin-left: 5px;">
                <input id="hidIdEmpModCon" name="hidIdEmpModCon" value="" type="hidden" >
                <input id="hidIdEmpleado" name="hidIdEmpleado" value="<?php echo $iidEmpleado; ?>" type="hidden">
    <!--              <input id="hidIdPEMC" name="hidIdPEMC" value="" type="hidden" >  -->
                <table border="0" width="100%" cellpadding="2" cellspacing="3">
                    <tr>
                        <td class="lt14">Modalidad Contrata : </td>
                        <td class="lt14" colspan="3">
                            <select name="cboModContrato" id="cboModContrato" style="width: 140px;">
                                <option value="">Seleccionar</option>
                                <?php foreach ($comboContrato as $k => $value) { ?>
                                    <option value="<?php echo $comboContrato[$k][0]; ?>"><?php echo $comboContrato[$k][1]; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lt14">Tipo Sueldo :</td>
                        <td>
                            <select name="cboTipoSueldo" id="cboTipoSueldo" style="width: 140px;" onchange="verUnidadTipoSueldo()">
                                <option value="">Seleccionar</option>
                                <?php foreach ($tipoSueldo as $k => $value) { ?>
                                    <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                                    <option value="<?php echo $value[0] . "__"; ?>" style="display: none"><?php echo $value[2]; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="lt14">Sueldo :</td>
                        <td class="lt14"><input id="txtSueldo" name="txtSueldo" value="" size="10" maxlength="7" > <div id="div_unidTipoSueldo" class="letraBolAzul" style="width: 150px; float: right;"></div></td>
                    </tr>
                    <tr><td colspan="4" class="lt14" align="center"><h2>Periodo de contrato</h2></td></tr>
                    <tr>
                        <td class="lt14" width="20%">Fecha Inicio :</td>
                        <td class="lt14" width="30%"><input id="txtFechaIni" name="txtFechaIni" type="text" onclick="calendarioHtmlx('txtFechaIni')"></td>
                        <td class="lt14" width="10%">Fecha Fin :</td>
                        <td class="lt14" width="40%"><input id="txtFechaFin" name="txtFechaFin" type="text" onclick="calendarioHtmlx('txtFechaFin')"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" height="40">
                            <div id="btnGrabar" style="width: 90px;" align="center">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][121]["GRABAR_MODALIDAD_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["GRABAR_MODALIDAD_CONTRATO"] == 1)) {
                                    $toolbar0->SetBoton("GrabarContrato", "Grabar", "btn", "onclick,onkeypress", "grabarContrato()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                    $toolbar0->Mostrar();
                                }
                                ?>
                            </div>
                            <div id="btnEditar" style="width: 350px;display: none;" align="center">
                                <?php
                                $hayBotones = 0;
                                $toolbar1->SetBoton("Reecontratacion", "Reecontratacion Personal", "btn", "onclick,onkeypress", "reecontratacionPersonal()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo.png", "", "", 1);
                                $hayBotones = 1;


                                if (isset($_SESSION["permiso_formulario_servicio"][121]["NUEVA_MODALIDAD_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["NUEVA_MODALIDAD_CONTRATO"] == 1)) {
                                    $toolbar1->SetBoton("NuevoContrato", "Nuevo Contrato", "btn", "onclick,onkeypress", "nuevoContrato()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo.png", "", "", 1);
                                    $hayBotones = 1;
                                }
                                if (isset($_SESSION["permiso_formulario_servicio"][121]["EDITAR_MODALIDAD_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["EDITAR_MODALIDAD_CONTRATO"] == 1)) {
                                    $toolbar1->SetBoton("EditarContrato", "Editar", "btn", "onclick,onkeypress", "editarContrato()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/editar.png", "", "", 1);
                                    $hayBotones = 1;
                                }
//                                $toolbar1->Mostrar();
                                if ($hayBotones == 1) {
                                    $toolbar1->Mostrar();
                                }
                                ?>
                            </div>
                            <div id="btnModificar" style="width: 90px; display: none;" align="center">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][121]["MODIFICAR_MODALIDAD_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["MODIFICAR_MODALIDAD_CONTRATO"] == 1)) {
                                    $toolbar2->SetBoton("ModificarContrato", "Modificar", "btn", "onclick,onkeypress", "modificarContrato()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                    $toolbar2->Mostrar();
                                }
                                ?>
<!--                                btnModificar-->
                            </div>
                                    <div id="btnModificarFecha" style="width: 90px; display: none;" align="center">
                                <?php
                                $toolbar3->SetBoton("ModificarContratoxx", "Modificar Solo Fecha Contrato", "btn", "onclick,onkeypress", "modificarContratoSoloFecha()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                $toolbar3->Mostrar();
                                ?>
<!--                                btnModificar-->
                            </div>
                        </td>
                    </tr>
                </table></div>
        </fieldset><br>
        <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
            <legend>&nbsp; PUESTOS HMLO &nbsp;</legend>
            <div style="width: 630px;" align="center">
                <fieldset>
                    <table width="95%">
                        <tr>
                            <td class="lt14" width="10%">Sede :</td>
                            <td class="lt14" width="30%">
                                <select name="cboSucursal" id="cboSucursal" style="width: 140px;" >
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($comboSucursal as $k => $value) { ?>
                                        <option value="<?php echo $comboSucursal[$k][0]; ?>" <?php if ($comboSucursal[$k][0] == '0000000001')
                                        echo 'selected' ?>><?php echo $comboSucursal[$k][14]; ?></option>
                                            <?php } ?>
                                </select>
                            </td>
                            <td class="lt14" width="10%">&Aacute;rea :<input id="hidIdSedeEmpresaArea" name="hidIdSedeEmpresaArea" value="" type="hidden"/>

                            </td>
                            <td colspan="2" width="50%"><input id="txtSedeEmpresaArea" name="txtSedeEmpresaArea" value="" size="40" disabled>&nbsp;&nbsp;
                                <input id="btnSedeEA" name="btnSedeEA" type="button" onclick="btnSetSedeEmpresaArea()" value="..." style="cursor: pointer;"/>
                            </td>
                        </tr>
                    </table></fieldset>
            </div>
            <div  id ="divBotonesPuestoEmpleado" style="width:99%;margin-left:1%;margin-right:1%; " align="center">
                <!--<fieldset style="margin:1px;width:50%;height:27px;padding: 0px;">-->
                <div style="margin:1px;width:50%;height:27px;padding: 0px;">
                    <div  id ="DivEliminar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(3);">
                            <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif"/></a>
                    </div>
                    <div  id ="DivAgregar" style=" float:right;width:33%;" align="center">
                        <?php
                        //121:Formulario de registro de personal - 212:Formulario de datos de usuario
                        //if($_SESSION['permiso_formulario'][121]['iid_formulario']==121 && $_SESSION['permiso_formulario'][211]['iid_formulario']==211)
                        if (isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                            if ($_SESSION["permiso_formulario_servicio"][121]["AGREGAR_PUESTO_EMP"] == 1)
                                echo "<a href=\"javascript:agregarPuestoEmpleado();\"><img border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on.gif\"/></a>";
                        }
                        else {
                            if (!isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                                if ($_SESSION["permiso_formulario_servicio"][212]["AGREGAR_PUESTO_EMP"] == 1)
                                    echo "<a href=\"javascript:agregarPuestoEmpleado();\"><img border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on.gif\"/></a>";
                            }
                            else {
                                if (isset($_SESSION['permiso_formulario'][121]) && !isset($_SESSION['permiso_formulario'][212])) {
                                    if ($_SESSION["permiso_formulario_servicio"][121]["AGREGAR_PUESTO_EMP"] == 1)
                                        echo "<a href=\"javascript:agregarPuestoEmpleado();\"><img border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on.gif\"/></a>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <div  id ="DivEditar" style=" float:right;width:33%; visibility: hidden;" align="center">
                        <a href="javascript:enableAccion(1);">
                            <img border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/></a>
                    </div>
                </div>
                <!--</fieldset>-->
            </div>
            <div  id ="divDatosPuesto" style="width: 630px;height:200px;margin-left:5px;">
                <?php
                echo $tablaPuestosEmpleados;
                ?>
            </div>
            <div  id ="divResultadoPuesto" style="width:99%;height:auto;margin-left:1%;margin-right:1%;">
                <fieldset style="margin:1px;width:95%;height:250px;padding: 0px; font-size:1.2em">

                    <legend>Detalle</legend>
                    <div id='fila1' style="height:10%; width:100%">
                        <div id='cell11' style="float:left; width:25%;" >Puesto:</div>
                        <div id='cell12' style="float:left; width:75%;">
                            <input name="txtNombrePuesto" type="text" id="txtNombrePuesto" size="50"  readonly="readonly" />
                        </div>
                    </div>
                    <div id='fila2' style=" width:100%; height:10%">
                        <div id='cell21' style="float:left; width:25%;">Centro de Costos:</div>
                        <div id='cell22' style="float:left; width:75%;">
                            <input name="txtCentroCostos" type="text" id="txtCentroCostos" size="50"  readonly="readonly" />
                        </div>
                    </div>
                    <div id='fila3' style=" width:100%; height:10%">
                        <div id='cell31' style="float:left; width:25%;">Categoria de Puesto:</div>
                        <div id='cell32' style="float:left; width:75%;">
                            <select name="select" id="selectCategoriaPuestos" style="width:150px; font-size:9px"  disabled="true" >
                                <?php echo $comboHTML; ?>
                            </select>
                        </div>
                    </div>
                    <div id='fila4' style="width:100%;height:10%">
                        <div id='cell41' style="float:left; width:25%;">Activo:</div>
                        <div id='cell42' style="float:left; width:75%;">
                            <input type="checkbox" name="chkEstado" id="chkEstado" disabled="true" onclick="if(this.checked){this.value=1}else{this.value=0;}" value="0">
                        </div>
                    </div>
                    <div id='fila5' style="width:100%;height:50%">
                        <div id='cell51' style="float:left; width:25%;">
                            <div>Periodos:</div>
                            <div style=" padding: 30px; ">
                                <input type="hidden" id="hIdPuestoEmpleado" value=""/><input type="hidden" id="hIdSedeEmpresaArea" value=""/>
                                <?php
                                //121:Formulario de registro de personal - 212:Formulario de datos de usuario
                                if (isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                                    if ($_SESSION["permiso_formulario_servicio"][121]["CAMBIAR_ESTADO_PUESTO_EMP"] == 1)
                                        echo "<a href=\"javascript:ventanaCambiarEstadoPuestoEmpleado('cambioEstado');\"><img id=\"btnCambiarEstado\" style=\"display: none;\" border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif\"/></a>";
                                }
                                else {
                                    if (!isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                                        if ($_SESSION["permiso_formulario_servicio"][212]["CAMBIAR_ESTADO_PUESTO_EMP"] == 1)
                                            echo "<a href=\"javascript:ventanaCambiarEstadoPuestoEmpleado('cambioEstado');\"><img id=\"btnCambiarEstado\" style=\"display: none;\" border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif\"/></a>";
                                    }
                                    else {
                                        if (isset($_SESSION['permiso_formulario'][121]) && !isset($_SESSION['permiso_formulario'][212])) {
                                            if ($_SESSION["permiso_formulario_servicio"][121]["CAMBIAR_ESTADO_PUESTO_EMP"] == 1)
                                                echo "<a href=\"javascript:ventanaCambiarEstadoPuestoEmpleado('cambioEstado');\"><img id=\"btnCambiarEstado\" style=\"display: none;\" border=\"0\" src=\"../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif\"/></a>";
                                        }
                                    }
                                }
                                ?>
                                <!--<a href="javascript:ventanaCambiarEstadoPuestoEmpleado('cambioEstado');">
                                    <img id="btnCambiarEstado" style=" display: none;" border="0" title="" alt="" src="../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif"/>
                                </a>-->
                            </div>
                        </div>
                        <div id='cell52' style="float:left; width:75%; overflow: auto;">
                            <?php echo $tablaPeriodos; ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </fieldset>
    </div>
</form>
