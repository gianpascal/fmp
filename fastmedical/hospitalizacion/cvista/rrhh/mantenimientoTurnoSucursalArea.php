<?php
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
$toolbar1=new ToollBar("right");
$toolbar2=new ToollBar("right");
$toolbar3=new ToollBar("right");
$toolbar4=new ToollBar("right");
$toolbar5=new ToollBar("right");
$toolbar6=new ToollBar("right");
$toolbar7=new ToollBar("right");

$hdnMenuActivo="";
?>
<div style="width:900px; margin:1px auto; border: #006600 solid">
    <input id="hidIdSucursal" name="hidIdSucursal" type="hidden" value="">
    <div class="titleform">
        <h1>Mantenimiento de Turnos por Areas</h1>
        <input id="hidIdEmpresaSedeArea" name="hidIdEmpresaSedeArea" type="hidden" value="">
        <input id="hidSucursal" name="hidSucursal" type="hidden" value="">
        <input id="hidArea" name="hidArea" type="hidden" value="">
        <input id="hidCodigoEmpleado" name="hidCodigoEmpleado" type="hidden" value="">
        <input id="hidIdProgramacionPersonal" name="hidIdProgramacionPersonal" type="hidden" value="">

    </div>
    <div  id ="divMantTurnoEmpresaArea" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqMantTurnoEmpresaArea" style=" float:left;width:35%; ">
            <fieldset style="margin:1px;width:290px;height:auto;padding: 0px; font-size:12px">
                <div id="divTreeEmpresaSucursal" style="width: 290px; height: 300px;">
                </div>
            </fieldset>
        </div>
        <div  id ="divDerMantTurnoEmpresaArea" style="width:65%; float: right" align="center">
            <div align="center">
                <fieldset style="margin:10px;width:95%;height:auto;">
                    <legend>&nbsp; Asignar Turnos a &Aacute;reas &nbsp;</legend>
                    <div id="div_tab1" style="width:100%;height:auto;">
                        <h2 align="center">&Aacute;reas por Sucursal</h2>
                        <div id="tablaAreaSucursal" style="width: 490px; height: 175px;"></div><br>
                    </div>
                </fieldset>
            </div>
            <br>
            <div id="div_MantenimientoTurnoArea" style="display: none;">
                <table width="95%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td width="100px">
                            <ul id="men1">
                                <li>
                                    <div id="btn_asgPruebas">
                                        <?php
                                            $displayTabTurnosPorArea="none";
                                            if(isset($_SESSION["permiso_formulario_servicio"][221]["TAB_ASIG_TURNO_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["TAB_ASIG_TURNO_POR_AREA"]==1)){
                                                $displayTabTurnosPorArea="block";
                                                $hdnMenuActivo="men1";
                                                echo "<a href=\"#\" onclick=\"tabsMantenimietoTurnoArea('men1');\">Asignar Turnos por &Aacute;reas</a>";
                                            }
                                        ?>
                                        <!--<a href="#" onclick="tabsMantenimietoTurnoArea('men1');">Asignar Turnos por &Aacute;reas</a>-->
                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td width="100px">
                            <ul id="men2">
                                <li>
                                    <div id="btn_asgServicios">
                                        <?php
                                            $displayTabEncargadoDeProgramar="none";
                                            if(isset($_SESSION["permiso_formulario_servicio"][221]["TAB_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["TAB_ENCARGADO_REALIZAR_PROG_HOR"]==1)
                                                && !isset($_SESSION["permiso_formulario_servicio"][221]["TAB_ASIG_TURNO_POR_AREA"])){
                                                $displayTabEncargadoDeProgramar="block";
                                                $hdnMenuActivo="men2";
                                                echo "<a href=\"#\" onclick=\"tabsMantenimietoTurnoArea('men2');\">Encargado de Programar</a>";
                                            }
                                            else{
                                                if(isset($_SESSION["permiso_formulario_servicio"][221]["TAB_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["TAB_ENCARGADO_REALIZAR_PROG_HOR"]==1)
                                                    && isset($_SESSION["permiso_formulario_servicio"][221]["TAB_ASIG_TURNO_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["TAB_ASIG_TURNO_POR_AREA"]==1)){
                                                    $displayTabEncargadoDeProgramar="none";
                                                    $hdnMenuActivo="men1";
                                                    echo "<a href=\"#\" onclick=\"tabsMantenimietoTurnoArea('men2');\">Encargado de Programar</a>";
                                                }
                                            }
                                        ?>
                                        <!--<a href="#"  onclick="tabsMantenimietoTurnoArea('men2')">Encargado de Programar</a>-->
                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td colspan="2" width="45%"> </td>
                    </tr>
                </table>
                <input type="hidden" id="hdnMenuActivo" name="hdnMenuActivo" value="<?php echo $hdnMenuActivo?>"/>
                
                <div id="mrTab1" align="center" style="display:<?php echo $displayTabTurnosPorArea; ?>;"><!--<div id="mrTab1" align="center">-->
                    <fieldset style="margin:0px;width:95%;height:auto;">
                        <legend>&nbsp; Turnos por &Aacute;reas &nbsp;</legend>
                        <table align="center" border="0" cellpadding="3" cellspacing="2">
                            <tr>
                                <td>
                                    <fieldset style="margin:0px;width:auto;height:auto;">
                                        <table width="100%">
                                            <tr>
                                                <td width="60%"><div style="float: left; width: 85%"><h2 align="center">Turnos</h2></div>
                                                    <div style="width: 10%; float: right;">
                                                        <?php
                                                            if (isset($_SESSION["permiso_formulario_servicio"][221]["VER_MAS_TURNOS_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["VER_MAS_TURNOS_POR_AREA"]==1)){
                                                                $toolbar6->SetBoton("nuevoHorario","M&aacute;s Turnos","btn","onclick,onkeypress","masTurnosProgramar()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/asig_fte.gif","","",1);
                                                                $toolbar6->Mostrar();
                                                            }
                                                        ?>
                                                    </div>
                                                    <div id="tablaTurnoProgramar" style="width: 350px; height: 175px; float: left"></div>
                                                </td>
                                                <td align="center">
                                                    <input id="hidIdTurno" name="hidIdTurno" value="" type="hidden">
                                                    <div style="width: 80px;">
                                                        <?php
                                                            if (isset($_SESSION["permiso_formulario_servicio"][221]["ASIG_TURNO_POR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["ASIG_TURNO_POR_AREA"]==1)){
                                                                $toolbar5->SetBoton("AsignarTurnoArea","Asignar","btn","onclick,onkeypress","asignarTurnoArea()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/button_ok.png","","",1);
                                                                $toolbar5->Mostrar();
                                                            }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table></fieldset>
                                </td>
                            </tr>
                            <tr>
                                <td><br>
                                    <h2 align="center"> Turnos por &Aacute;reas </h2><br>
                                    <div id="tablaTurnoxArea" style="width: 555px; height: 180px;"></div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div><br>

                <div id="mrTab2" align="center" style="display:<?php echo $displayTabEncargadoDeProgramar; ?>;"><!--<div id="mrTab2" align="center">-->
                    <fieldset style="margin:10px;width:95%;height:auto;">
                        <legend>&nbsp; Encargados por &Aacute;reas &nbsp;</legend>
                        <fieldset>
                        <div style="width: 120px;" align="center">
                            <?Php
                                if (isset($_SESSION["permiso_formulario_servicio"][221]["VER_COORDINADOR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][221]["VER_COORDINADOR_AREA"]==1)){
                                    $toolbar7->SetBoton("verCoordinador","Ver Coordinador","btn","onclick,onkeypress","listaEncargadosPorArea()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/mac.png","","",1);
                                    $toolbar7->Mostrar();
                                }
                            ?>
                        </div>
      
                            <div id="tablaEncargadosxArea" style="width: 480px; height: 90px; display: none;" align="center"></div>
                        </fieldset>
                        <fieldset style="margin:10px;width:95%;height:auto;">
                            <table  width="360" border="0" align="center">
                                <tr>
                                    <td colspan="4" align="center" height="30"> <h2>Encargada de realizar la programaci&oacute;n de horarios</h2></td>
                                </tr>
                                <tr>
                                    <td>Nombres : </td>
                                    <td colspan="3"><input id="txtNombre" name="txtNombre" value="" type="text" size="45"  disabled></td>
                                </tr>
                                <tr>
                                    <td>Fecha Inicio : </td>
                                    <td><input id="txtFechIni" name="txtFechIni" value="" type="text" size="8" onclick="calendarioHtmlx('txtFechIni')"></td>
                                    <td>Fecha Final : </td>
                                    <td><input id="txtFechFin" name="txtFechFin" value="" type="text" size="8" onclick="calendarioHtmlx('txtFechFin')"></td>
                                </tr>
                                <tr>
                                    <td>Estado : </td>
                                    <td colspan="3">
                                        <select name="cboEstado" id="cboEstado" style="width: 90px;">
                                            <?php foreach ($cboEstado as $k => $value) { ?>
                                            <option value="<?php echo $k;?>"><?php echo $value;?></option>
                                                <?php }?>
                                        </select>
                                    </td>
                                </tr>
                            </table><br>
                            <div id ="botones" style=" float:left;width:100%;height:30px;" align="center">
                                <table width="200" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="center">
                                            <div id="divEdita" style="display: none;width: auto">
                                                <?php
                                                    $hayBotones=0;
                                                    if (isset($_SESSION["permiso_formulario_servicio"][221]["NUEVO_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["NUEVO_ENCARGADO_REALIZAR_PROG_HOR"]==1)){
                                                        $toolbar1->SetBoton("Nuevo","Nuevo","btn","onclick,onkeypress","nuevaPersonaEncargada()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/nuevo.png","","",1);
                                                        $hayBotones=1;
                                                    }
                                                    if (isset($_SESSION["permiso_formulario_servicio"][221]["EDITAR_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["EDITAR_ENCARGADO_REALIZAR_PROG_HOR"]==1)){
                                                        $toolbar1->SetBoton("Editar","Editar","btn","onclick,onkeypress","editarPersonaEncargada()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/editar.png","","",1);
                                                        $hayBotones=1;
                                                    }
                                                    if($hayBotones==1){
                                                        $toolbar1->Mostrar();
                                                    }
                                                ?>
                                            </div>
                                            <div id="divGraba" style="display: block; width: 100px">
                                                <?php
                                                    if (isset($_SESSION["permiso_formulario_servicio"][221]["GRABAR_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["GRABAR_ENCARGADO_REALIZAR_PROG_HOR"]==1)){
                                                        $toolbar2->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","grabarPersonaEncargada('grabar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                                        $toolbar2->Mostrar();
                                                    }
                                                ?>
                                            </div>
                                            <div id="divActualiza" style="display: none; width: 100px">
                                                <?php
                                                    if (isset($_SESSION["permiso_formulario_servicio"][221]["MODIFICAR_ENCARGADO_REALIZAR_PROG_HOR"]) && ($_SESSION["permiso_formulario_servicio"][221]["MODIFICAR_ENCARGADO_REALIZAR_PROG_HOR"]==1)){
                                                        $toolbar3->SetBoton("MODIFICAR","Modificar","btn","onclick,onkeypress","grabarPersonaEncargada('modificar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                                                        $toolbar3->Mostrar();
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>

</div>
