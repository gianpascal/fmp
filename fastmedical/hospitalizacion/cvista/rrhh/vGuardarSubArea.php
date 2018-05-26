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
                <td><div id="divFilter" style="display: none; width: 100%">Nombre de Subarea : <input id="txtNombreSubArea" name="txtNombreSubArea" type="text" size="30" onkeypress="buscarSubarea('filter')"/></div></td>
                <td width="100">
                    <?php
                    if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"] == 1)) {
                        $toolbar00->SetBoton("NuevaSubArea", "Nueva Sub Area", "btn", "onclick,onkeypress", "nuevoDatosSubArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/filenew.png", "", "", 1);
                        $toolbar00->Mostrar();
                    }
                    ?>
                </td>
            </tr>
        </table>
        <div id="divTablaSubAreaCont" style="display: none;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; Lista de Subareas Principales &nbsp;</legend>
                <div id="divTablaSubArea" style="width: 450px; height: 180px;" align="center">
                </div>
            </fieldset>
        </div>
    </div>
    <div align="center">
        <div id="divMantenimientoSubArea" style="width: auto;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; Agregar nueva SubArea &nbsp;</legend>
                <div id="divdetalleDocumentos" style=" height:auto; width:auto; overflow: auto;" align="center">
                    <table align="center" border="0" width="450">
                        <tr>
                            <td>Descripci&oacute;n de la SubArea :<input id="hidIdSubAreax" name="hidIdSubAreax" type="hidden" value="" size="40" />
                            </td>
                            <td><input id="txtDescripcionSubAreax" name="txtDescripcionSubAreax" type="text" size="40" style="text-transform: uppercase"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Abreviatura de la SubArea: </td>
                            <td><input id="txtAbreviaturaSubAreax" name="txtAbreviaturaSubAreax" type="text" size="20" style="text-transform: uppercase"/>
                            </td>
                        </tr>
                        <tr><td>Estado de la SubArea : </td>
                            <td> <select id="txtEstadoSubAreax" name="txtEstadoAreax" style="width: 90px;">
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
                                        $toolbar01->SetBoton("GrabarSubArea", "Grabar", "btn", "onclick,onkeypress", "grabarSubArea('grabar')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                        $toolbar01->Mostrar();
                                    }
                                    ?>
                                </div>
                                <div id="btnModificar" style="width: 90px; display: none" align="center">
                                    <?php
                                    if (isset($_SESSION["permiso_formulario_servicio"][218]["MODIFICAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["MODIFICAR_AREA"] == 1)) {
                                        $toolbar02->SetBoton("ModificarSubArea", "Modificar", "btn", "onclick,onkeypress", "grabarSubArea('modificar')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
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
        <div id="divAsignarSubArea" style="width: auto; height: auto;">
            <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                <legend>&nbsp; &Aacute;rea &nbsp;</legend>
                <table  width="100%">
                    <tr>
                        <td height="30">Sede : <input type="hidden" id="hIdSedeEmpresaArea" name="hIdSedeEmpresaArea" value="" size="40"/></td>
                    <td><input id="txtDescripcionSede" name="txtDescripcionSede" type="text" size="40" style="text-transform: uppercase;" readonly="true"/>
                            </td>
                    </tr>
                    <tr>
                        <td height="30">Area :</td>
                        <td> <input id="txtDescripcionAreax" name="txtDescripcionAreax" type="text" size="40" style="text-transform: uppercase; " readonly="true" />
                            </td>
                    </tr>
                    </tr>
                    <tr>  
                        <td colspan="2" align="center" height="30">
                            <div style="width: 150px;">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][218]["ASIG_SEDE_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["ASIG_SEDE_AREA"] == 1)) {
                                    $toolbar03->SetBoton("AsignarSubArea", "Asignar Sub Área", "btn", "onclick,onkeypress", " AsignarSubArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
                                    $toolbar03->Mostrar();
                                    //asignarSede
                                }
                                ?></div>
                        </td>
                    </tr>

                </table>
            </fieldset>

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


