<?php
$toolbarx=new ToollBar("center");
$toolbary=new ToollBar("center");
$toolbarz=new ToollBar("center");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%" valign="top" align="center">
                        <fieldset>
                            <br>
                            <fieldset>
                                <legend>&nbsp; Registrar Sub Areas &nbsp;</legend>
                                <form id="fromSubAreas" method="post" action="">
                                    <table cellpadding="3" cellspacing="3" align="center">
                                        <tr>
                                            <td colspan="2"><p>Sede :</p>
                                                <select name="cboSucursalx" id="cboSucursalx" style="width: 110px;" onchange="cargarCboSedeArea(this,'div_sede_areax','cboAreax','cargarTablaSubareasxx()')">
                                                    <option value="">Seleccionar</option>
                                                    <?php foreach ($comboSucursal as $i => $value) { ?>
                                                    <option value="<?php echo $value[0];?>"><?php echo $value[14];?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                            <td colspan="2">
                                                <p>&Aacute;rea :</p>
                                                <div id="div_sede_areax">
                                                    <select style="width: 200px;" disabled><option value="">- Seleccionar -</option></select>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Nombre sub Area :</td>
                                            <td colspan="3"><input id="txtNombre" name="txtNombre" size="30"> <input id="hidIdSubArea" name="hidIdSubArea" type="hidden" value=""></td>
                                        </tr>

                                        <tr>
                                            <td>Descripci&oacute;n :</td>
                                            <td colspan="3"><input id="txtDescripcion" name="txtDescripcion" size="40"> </td>
                                        </tr>
                                        <tr>
                                            <td>Estado :</td>
                                            <td colspan="3"><select id="cboEstadox" name="cboEstadox"><option value="0">Desactivado</option><option value="1" selected>Activado</option> </select> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="center">
                                                <div id="btnGrabar" style="width: 50px;">
                                                    <?php
                                                        if (isset($_SESSION["permiso_formulario_servicio"][226]["GRABAR_SUBAREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["GRABAR_SUBAREA"]==1)){
                                                            $toolbarx->SetBoton("grabarSubAreas","Grabar","btn","onclick,onkeypress","grabarSubArea('grabar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                                            $toolbarx->Mostrar();
                                                        }
                                                    ?>
                                                </div>
                                                <div id="btnModificar" style="width: 50px;display: none;">
                                                    <?php
                                                        if (isset($_SESSION["permiso_formulario_servicio"][226]["MODIFICAR_SUBAREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["MODIFICAR_SUBAREA"]==1)){
                                                            $toolbarz->SetBoton("modificarSubAreas","Modificar","btn","onclick,onkeypress","grabarSubArea('modificar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                                            $toolbarz->Mostrar();
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
                            <br>
                            <div id="listaSubAreas" style="width: 400px; height: 240px"></div>
                        </fieldset>
                    </td>
                    <td width="50%" valign="top" align="center">
                        <fieldset>
                            <br>
                            <fieldset>
                                <legend>&nbsp; Categorias por &Aacute;reas &nbsp;</legend>
                                <form id="fromCategoriaSubArea" method="post" action="">
                                    <table cellpadding="3" cellspacing="3" align="center">
                                        <tr>
                                            <td><p>Sede :</p></td>
                                            <td>
                                                <select name="cboSucursaly" id="cboSucursaly" style="width: 110px;" onchange="cargarCboSedeArea(this,'div_sede_areay','cboAreay','comboSubAreas()')">
                                                    <option value="">Seleccionar</option>
                                                    <?php foreach ($comboSucursal as $i => $value) { ?>
                                                    <option value="<?php echo $value[0];?>"><?php echo $value[14];?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                            <td><p>&Aacute;rea :</p></td>
                                            <td>
                                                <div id="div_sede_areay">
                                                    <select style="width: 200px;" disabled><option value="">- Seleccionar -</option></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><p>Sub &Aacute;rea :</p></td>
                                            <td colspan="3">
                                                <div id="div_cboSubAreas">
                                                    <select style="width: 150px;" disabled><option value="">- Seleccionar -</option></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><p>__________________________________________________________________</p><br></td></tr>
                                        <tr>
                                            <td><p>Categor&iacute;a :</p></td>
                                            <td colspan="3">
                                                <div id="div_cboCategoriaSubArea">
                                                    <select name="cboCategoriaPuesto" id="cboCategoriaPuesto">
                                                        <?php echo $cboCategoriaPuesto;?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="center">
                                                <div style="width: 50px;">
                                                    <?php
                                                        if (isset($_SESSION["permiso_formulario_servicio"][226]["GRABAR_CAT_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][226]["GRABAR_CAT_POR_AREA"]==1)){
                                                            $toolbary->SetBoton("grabarCategoriaSubArea","Grabar","btn","onclick,onkeypress","grabarCategoriaSubArea()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                                            $toolbary->Mostrar();
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
                            <br>
                            <div id="listaCategoriaArea" style="width: 400px; height: 243px"></div>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
