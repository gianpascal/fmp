<?php
$comboEstado = array(1 => "Activado", 0 => "Desactivado");
$toolbar00 = new ToollBar("right");
$toolbar01 = new ToollBar("right");
$toolbar02 = new ToollBar("right");
$toolbar03 = new ToollBar("right");
$toolbar04 = new ToollBar("right");
?>
<fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px">
    <div style="font-size: 11px;">  
    </div>
    <div align="center">
        <table width="450" align="center">
            <tr>
                <td><div id="divFilter" style="display: none; width: 100%">Nombre del Area : <input id="txtNombreArea" name="txtNombreArea" type="text" size="30" onkeypress="buscarArea('filter')"/></div></td>
                <td width="100">
                    <?php
                    if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"] == 1)) {
                        $toolbar00->SetBoton("NuevaArea", "Nueva Area", "btn", "onclick,onkeypress", "nuevoDatosArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/filenew.png", "", "", 1);
                        $toolbar00->Mostrar();
                    }
                    ?>
                </td>
            </tr>
        </table>
        <div id="divTablaAreaCont" style="display: none;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; Lista de &Aacute;reas Principales &nbsp;</legend>
                <div id="divTablaArea" style="width: 450px; height: 180px;" align="center">
                </div>
            </fieldset>
        </div>
    </div>
    <div align="center">
        <div id="divMantenimientoArea" style="width: auto;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; Agregar nueva &aacute;rea &nbsp;</legend>
                <div id="divdetalleDocumentos" style=" height:auto; width:auto; overflow: auto;" align="center">
                    <table align="center" border="0" width="450">
                        <tr>
                            <td>Descripci&oacute;n del &Aacute;rea :<input id="hidIdAreax" name="hidIdAreax" type="hidden" value="" size="40" />
                            </td>
                            <td><input id="txtDescripcionAreax" name="txtDescripcionAreax" type="text" size="40" style="text-transform: uppercase"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Abreviatura del &Aacute;rea: </td>
                            <td><input id="txtAbreviaturaAreax" name="txtAbreviaturaAreax" type="text" size="20" style="text-transform: uppercase"/>
                            </td>
                        </tr>
                        <tr><td>Estado &Aacute;rea : </td>
                            <td> <select id="txtEstadoAreax" name="txtEstadoAreax" style="width: 90px;">
                                    <?php foreach ($comboEstado as $i => $value) { ?>
                                        <option value="<?php echo$i ?>"><?php echo $value ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" height="50">
                                <div id="btnGrabar" style="width: 90px" align="center">
                                    <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][218]["GRABAR_NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["GRABAR_NUEVA_AREA"] == 1)) {
                                        $toolbar01->SetBoton("GrabarArea", "Grabar", "btn", "onclick,onkeypress", "grabarArea('grabar')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                        $toolbar01->Mostrar();
                                    }
                                    ?>
                                </div>
                                <div id="btnModificar" style="width: 90px; display: none" align="center">
                                    <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][218]["MODIFICAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["MODIFICAR_AREA"] == 1)) {
                                        $toolbar02->SetBoton("ModificarArea", "Modificar", "btn", "onclick,onkeypress", "grabarArea('modificar')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                        $toolbar02->Mostrar();
                                    }
                                    ?>
                                </div>
                            </td>
                            <td> </td>
                        </tr>

                    </table>
                </div>
            </fieldset><br><br>
        </div>
        <div id="divAsignarSede" style="width: auto; height: auto;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; Sede &nbsp;</legend>
                <table  width="100%">
                    <tr>
                        <td height="30">Seleccione Sede :</td>
                        <td>
<!--                            <select name="cboSucursal" id="cboSucursal" style="width: 120px;" onchange="editarEncargado()">-->
                            <select name="cboSucursal" id="cboSucursal" style="width: 120px;">
                                <option value="">Seleccionar</option>
                                <?php foreach ($comboSucursal as $i => $value) { ?>
                                    <option value="<?php echo $value[0]; ?>"><?php echo $value[14]; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td colspan="2" align="right" height="30">
                            <div style="width: 150px;">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][218]["ASIG_SEDE_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["ASIG_SEDE_AREA"] == 1)) {
                                    $toolbar03->SetBoton("AsignarSede", "Asignar Área a Sede", "btn", "onclick,onkeypress", " AsignarSede()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
                                    $toolbar03->Mostrar();
                                }
                                ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <div id="divResulAreaSede"></div>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div style ="display: none">
                <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                    <legend>&nbsp; Encargado de área &nbsp;</legend>
                    <table width="100%">
                        <tr>
                            <td height="30">Nombre Encargado :</td>
                            <td>
                                <input id="txtNombres" name="txtNombres" value="" size="43" disabled>
                            </td>
                            <td>
                                <input id="btnListaEmpleados" type="button" name="btnListaEmpleados" value="..." onclick="buscarEmpleadoAsignar()" style="cursor: pointer">
                                <input id="hidIdPersona" name="hidIdPersona" type="hidden" value="">
                            </td>
                            <td colspan="2" align="right" height="30">
                                <div style="width: 150px;">
                                    <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][218]["ASIG_EMP_ENCARGADO_DEL_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["ASIG_EMP_ENCARGADO_DEL_AREA"] == 1)) {
                                        $toolbar04->SetBoton("AsignarEmpleado", "Asignar Empleado", "btn", "onclick,onkeypress", " asignarEmpleadoArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
                                        $toolbar04->Mostrar();
                                    }
                                    ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                                <div id="divResulEncargado"></div>
                                <div id="divMsmResultadoEncargado" style="width: 400px;"></div>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
    <!--    <div align="center">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
            <legend>&nbsp; Lista de Subáreas &nbsp; </legend>
                <div id="divTablaSubArea" style="width: 450px; height: 180px;" align="center">
                </div>
            </fieldset>
        </div>-->
</fieldset>


