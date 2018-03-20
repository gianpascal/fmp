<?php
$toolbar66 = new ToollBar("center");
$toolbar67 = new ToollBar("center");
$toolbar68 = new ToollBar("center");
$toolbar70 = new ToollBar("center");
$toolbar71 = new ToollBar("left");
//$variable = 0;
?>
<form id="form_detalle" name="form_detalle" action="">
    <div style="width:99%; margin:1px auto; border: #006600" >
        <div class="titleform" id="divTitulo" >
        </div>
    </div>
    <input id="hidExistePuesto" name="hidExistePuesto" value="<?php echo $existePuesto; ?>" type="hidden">   
    <input id="hidExisteUsuario" name="hidExisteUsuario" value="<?php echo $existeUsuario; ?>" type="hidden">    
    <input id="hidActividad" name="hidExisteActividad" value="<?php echo $existeActividad; ?>" type="hidden">  
    <div  id ="divFrmUsuario" style="width:99%;margin-left:1%;margin-right:1%;" align="center">
        <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
            <legend>&nbsp;   Registro de Usuario  &nbsp;</legend>
            <div style="margin-left: 15%;" align="center">
                <table border="0" width="100%" cellpadding="2" cellspacing="3">

                    <tr>
                        <td colspan="4" align="center" height="40">
                            <div id="btnCrearUsuario" style="width: 90px;"  align="center">
                                <?php
                                $toolbar66->SetBoton("crearUsuario", "Generar Usuario", "btn", "onclick,onkeypress", "crearUsuario()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/add_user.png", "", "", 1);
                                $toolbar66->Mostrar();
                                ?>
                            </div>
                        </td>
                    </tr>

                </table>
                <div id="divSubFrmUsuario" >
                    <table>    
                        <tr> 
                            <td class="lt14">Usuario : </td>
                            <td class="lt14" colspan="3">
                                <select name="comboUsuario" id="comboUsuario" style="width: 140px;" <?php echo $disabled ?>>
                                    <?php
                                    if ($existeUsuario == 1)
                                        echo "<option>Seleccionar</option>"
                                        ?>
                                    <?php foreach ($comboUsuario as $k => $value) { ?>
                                        <option><?php echo $comboUsuario[$k][1]; ?></option>
                                    <?php } ?>
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td class="lt14">Perfil :</td>
                            <td class="lt14" colspan="3">
                                <select name="comboPerfil" id="comboPerfil" style="width: 300px;">
                                    <option value="-1">Seleccionar</option>
                                    <?php foreach ($comboPerfil as $k => $value) { ?>
                                        <option value="<?php echo $comboPerfil[$k][1]; ?>"><?php echo utf8_encode($comboPerfil[$k][2]); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table> 
                </div>    
                <table>   
                    <tr>
                        <td colspan="4" align="center" height="40">
                            <div id="btnGrabarUsuario" style="width: 90px;" align="center">
                                <?php
                                $toolbar67->SetBoton("Guardar", "Guardar Usario", "btn", "onclick,onkeypress", "guardarUsuario()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", 1);
                                $toolbar67->Mostrar();
                                ?>

                            </div>
                            <div id="btnEditarUsuario" style="width: 90px;display: none;" align="center">
                                <?php
                                $toolbar70->SetBoton("EditarUsuario", "Editar Perfil", "btn", "onclick,onkeypress", "editarUsuario()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/editar.png", "", "", 1);
                                $toolbar70->Mostrar();
                                ?>
                            </div>
                            <br>
                    </tr>    
                    <tr>
                        <td class="lt14">Actividad :</td>
                        <td class="lt14" colspan="3">
                            <select name="comboActividad" id="comboActividad" style="width: 300px;">
                                <option value="-1">Seleccionar</option>

                                <?php foreach ($comboActividad as $k => $value) { ?>
                                    <option value="<?php echo $comboActividad[$k][0]; ?>"
                                    <?php
                                    if ($actividadPersona == $comboActividad[$k][0]) {
                                        echo " selected='selected' ";
                                    }
                                    ?>
                                            >
                                        <?php echo utf8_encode($comboActividad[$k][1]); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <div id="btnModificarUsuario" style="width: 90px; display: none;" align="center">
                        <?php
                        $toolbar68->SetBoton("ModificarUsuario", "Modificar", "btn", "onclick,onkeypress", "modificarUsuario()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/add_user.png", "", "", 1);
                        $toolbar68->Mostrar();
                        ?>
                        <!--                                btnModificar-->
                    </div>   
                    </td> 
                    </tr>
                </table>


                <div id="btnGrabarActividad" style="width: 90px; " align="left">
                    <?php
                    $toolbar71->SetBoton("GrabarActividad", "Grabar Actividad", "btn", "onclick,onkeypress", "GrabarActividad()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/add_user.png", "", "", 1);
                    $toolbar71->Mostrar();
                    ?>
                </div> 

                <br>
            </div>
            <div id="divInfoRegistroUsuario" align="left" style="margin-left:2%">
            </div>
        </fieldset>
        <div style="height:10px"></div>
        <div id="divContenedorInfoPerfil">
            <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
                <legend>&nbsp;   Informaci&oacute;n de Perfil  &nbsp;</legend>
                <div id="divTablaPerfilesXUuario" align="center" style="width:auto;height:100px; overflow:visible; padding: 0px; font-size:14px"></div>
            </fieldset>
        </div>    
        <div style="height:10px"></div>
        <div id="divContenedorInfoFormularios" style="display:none">
            <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">    
                <legend>&nbsp;   Informaci&oacute;n de Formularios por Perfil &nbsp;</legend>
                <div id="divTablaFormulariosXPerfilXUsuario" align="center" style="width:auto;height:150px; overflow:visible; padding: 0px; font-size:14px"></div>
            </fieldset> 
        </div>  
        <div style="height:10px"></div>
        <div id="divContenedorInfoServicios" style="display:none">
            <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">    
                <legend>&nbsp;   Informaci&oacute;n de Servicios por Formulario&nbsp;</legend>           
                <div id="divTablaServiciosXFormulariosXPerfilXUsuario" align="center" style="width:auto;height:150px; overflow:visible; padding: 0px; font-size:14px"></div>
            </fieldset>  
        </div>  
    </div>
</form>


<!--                <input id="hidIdEmpModCon" name="hidIdEmpModCon" value="" type="hidden" >-->
<!--                <input id="hidIdEmpleado" name="hidIdEmpleado" value="< ?php echo $iidEmpleado; ?>" type="hidden">-->