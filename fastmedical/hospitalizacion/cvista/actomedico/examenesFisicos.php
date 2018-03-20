<?php
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
?>
<div id ="divConsultaP" style="width:1000px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Ex&aacute;menes f&iacute;sicos</h1>
    </div>
    <?php
    $toolbar0 = new ToollBar("left");
    $toolbar1 = new ToollBar("right");
    $toolbar2 = new ToollBar("right");
    $toolbar3 = new ToollBar("right");
    $toolbar4 = new ToollBar("right");
    $toolbar5 = new ToollBar("left");
    $toolbar6 = new ToollBar("right"); ///clonar para nueva version
    $toolbar7 = new ToollBar("left");  ///Pasar a producción
    $k;
    $toolbar8 = new ToollBar("left");
    $toolbar10 = new ToollBar("right"); //para acciones
    $toolbar11 = new ToollBar("left"); //para contadores
    $toolbar12 = new ToollBar("left"); //para otros servicios que no sean de consulta externa
    ?>
    <div  id ="divPersonal_1" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqPersonal_1" style=" float:left;width:34%; ">
            <div  id ="divIzqInfPersonal_2" style=" width:100%;" >
                <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
                    <legend>&nbsp; Examenes &nbsp;</legend>
                    <div id="toolbar">
                        <div style=" float: left;">
                            Versi&oacute;n:
                        </div>
                        <div style="margin-left:10px; float: left; ">
                            <select name="cboVersion" id="cboVersion" style="width: 150px" onchange="cambiarVersion();">
                                <?php foreach ($cboVersiones as $k => $value) { ?>
                                    <option value="<?php echo $cboVersiones[$k][0]; ?>"><?php echo $cboVersiones[$k][1]; ?></option>
                                <?php } ?>
                            </select>
                            <input id="hidFechCreacionVersion" name="hidFechCreacionVersion" value="" type="hidden"/>
                        </div>
                        <div id="divAcciones" style="display: block;  float: right;">
                            <?php
                            $toolbar10->SetBoton("Acciones", "Acciones", "btn", "onclick,onkeypress", "accionesExamenes()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/generar.png", "", "", 1);
                            $toolbar10->Mostrar();
                            ?>
                        </div>

                    </div>
                    <h1> <div  id ="stdDesarrollo" style="width:68%; margin-left: 30%; margin-right: 2%">Estado Desarrollo</div></h1>
                    <div  id ="divTreeExamen" style="float:left;width:100%; height:270px;"></div>
                    <div id="divBtnNuevo" style="display: block; float: left;">
                        <?php
                        $toolbar0->SetBoton("Nuevo", "Nuevo Examen", "btn", "onclick,onkeypress", "nuevoExamen()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/nuevo.png", "", "", 1);
                        $toolbar0->Mostrar();
                        ?>
                    </div>
                    <div id="vistaPrevia" style="display: block;  float: left;">
                        <?php
                        //$toolbar6->SetBoton("Nueva Versión","Nueva Versión","btn","onclick,onkeypress","clonarExamenes()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/wizard.png","","",1);
                        //$toolbar6->Mostrar();
                        $toolbar11->SetBoton("Vista Previa", "Vista Previa", "btn", "onclick,onkeypress", "vistaPreviaExamenes()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/mac.png", "", "", 1);
                        $toolbar11->Mostrar();
                        ?>
                    </div>

                </fieldset>
            </div>
        </div>

        <div  id ="divExamenFisico" style=" float:right;width:65%; height:200px; " >
            <div  id ="divExamenFisico" style=" width:99%; height: auto" align="center" >
                <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
                    <legend>Mantenimiento de Ex&aacute;menes F&iacute;sicos</legend>
                    <div  id ="divTreeExamenFisico" style=" float:left;width:100%; height:150px;">
                        <br>
                        <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="15%" height="25">Ex&aacute;men Padre :</td>
                                <td colspan="3"><input name="txtPadre" type="text" id="txtPadre" disabled value="" size="5">
                                    <input name="txtDescripcionPadre" type="text" id="txtDescripcionPadre" disabled value="" size="25"/>
                                    <input type="button" name="btnAsignarPadre" id="btnAsignarPadre" style="visibility:visible; cursor: pointer;" value="..." onclick="padreExamenFisico()"/>
                                </td>
                                <td width="16%" height="15%">C&oacute;digo Jer&aacute;rquico :</td>
                                <td height="24%" colspan="3">
                                    <input type="text" name="txtJerarquia" id="txtJerarquia" value="" size="10">
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Nombre Ex&aacute;men :</td>
                                <td colspan="3"><input type="text" name="hidIdExamen" id="hidIdExamen" disabled value="" size="5">
                                    <input type="text" name="txtTitulo" id="txtTitulo" size="25" value=""></td>
                                <td height="25" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Estado :</td>
                                <td colspan="3"><select name="cboEstado" id="cboEstado">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($cboEstado as $k => $value) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == 1) { ?> selected <?php } ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td height="25" colspan="2"></td>
                                <td height="25" colspan="2"></td>
                            </tr>
                            <tr>
                                <td height="25">Orden :</td>
                                <td ><input type="text" name="txtOrden" id="txtOrden" size="5" value=""></td>
                                <td  height="25">Nivel :</td>
                                <td ><input type="text" name="txtNivel" id="txtNivel" size="5" disabled value=""></td>
                                <td height="25"></td>
                                <td ></td>
                                <td height="25"></td>
                                <td height="25"></td>
                            </tr>
                        </table>
                    </div>
                    <div id ="botones" style=" float:left;width:100%;height:30px;">
                        <table width="100" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="33%">
                                    <div id="divEdita" style="display: none;">
                                        <?php
                                        $toolbar1->SetBoton("Editar", "Editar", "btn", "onclick,onkeypress", "editaExamenFisico()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/editar.png", "", "", 1);
                                        $toolbar1->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divGraba" style="display: block;">
                                        <?php
                                        $toolbar2->SetBoton("GRABAR", "Grabar", "btn", "onclick,onkeypress", "nue_actExamenFisico('nuevo')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", 1);
                                        $toolbar2->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divActualiza" style="display: none;">
                                        <?php
                                        $toolbar3->SetBoton("ACTUALIZAR", "Actualizar", "btn", "onclick,onkeypress", "nue_actExamenFisico('actualizar')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/reload3.png", "", "", 1);
                                        $toolbar3->Mostrar();
                                        ?>
                                    </div>
                                <td width="33%">
                                    <div id="divElimina" style="display: none;">
                                        <?php
                                        $toolbar4->SetBoton("ELIMINAR", "Eliminar", "btn", "onclick,onkeypress", "eliminaExamenFisico()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/delete.png", "", "", 1);
                                        $toolbar4->Mostrar();
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                </fieldset>
            </div>
        </div>
        <div style=" float:right;width:65%; height:10px; " ></div>

        <div  id ="divExamenPrueba" style="display:none; float:right;width:65%; height:auto; " >
            <div  id ="divExamenPrueba_1" style=" width:99%; float:left; height: auto" align="center" >
                <fieldset style="margin:1px;width:99%;height:auto;padding: 0px; font-size:14px">
                    <legend> &nbsp; Asignar Pruebas y/o Ex&aacute;menes a Servicios &nbsp; </legend>
                    <br>
                    <table width="95%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="105px">
                                <ul id="ultab1" class="tabs_1">
                                    <li>
                                        <div id="btn_asgPruebas"><a href="#" onclick="$('tab1').show();$('tab2').hide();$('ultab1').className='tabs_1';$('ultab2').className='tabs_2';">Asignar Pruebas</a></div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul id="ultab2" class="tabs_2">
                                    <li>
                                        <div id="btn_asgServicios"><a href="#"  onclick="$('tab1').hide();$('tab2').show();$('ultab1').className='tabs_2';$('ultab2').className='tabs_1';Asignaciones();">Asignar Servicios</a></div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" id="hidFlagTab1" name="hidFlagTab1" value="0"/>
                                <input type="hidden" id="hidFlagTab2" name="hidFlagTab2" value="0"/>
                            </td>
                        </tr>
                    </table>
                    <div id="tab1" style="display:block; width:98%; height:auto;">
                        <fieldset style="margin-left:14px;width:auto;height:auto;padding: 0px;float: left; font-size:14px">
                            <table width="90%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <div id="tr_prueba" style="width: 100%">
                                            <table width="100%" border="0">
                                                <tr><td colspan="2" height="30"><h2 style="margin-left: 20px">Pruebas para Asignar</h2></td></tr>
                                                <tr>
                                                    <td align="right" width="70%">
                                                        <input id="hidIdPrueba" name="hidIdPrueba" type="hidden" value=""/>
                                                        <input id="hidNomPrueba" name="hidNomPrueba" type="hidden" value=""/>
                                                        <div id ="divtbl_pruebas" style=" width:290px; height: 200px; margin-left:1px; margin-right: 1px" align="center"></div>
                                                    </td>
                                                    <td align="left" width="30%">
                                                        <div id="divAsignar">
                                                            <?php
                                                            $toolbar5->SetBoton("Asignar", "Asignar", "btn", "onclick,onkeypress", "asignarExamenPrueba()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/lassists.png", "", "", 1);
                                                            $toolbar5->Mostrar();
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <tr><td colspan="2" height="30"><h2 style="margin-left: 20px">Pruebas Asignadas</h2></td></tr>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div  id ="divtablaExamenPrueba" style=" width:580px; height: 200px; margin-left:3px; margin-right: 3px" align="center" ></div>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        </fieldset>
                    </div>

                    <div id="tab2" style="display:none; width:98%; height:auto;">
                        <fieldset style="margin-right:14px;width:auto;height:auto;padding: 0px; float:  right; font-size:14px;">
                            <table width="90%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <div id="tr_servicio" style="width: 100%">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td colspan="2" height="30">
                                                        <h2 style="margin-left: 20px">
                                                            Servicios para Asignar
                                                        </h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="90%" style="padding-left:120px;">
                                                        <input type="text" name="buscadorCampo1" value="Buscar..." id="buscadorCampo1" onkeyup='mygridw.filterBy(1,document.getElementById("buscadorCampo1").value);' onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;">                                               
                                                        <input id="hidIdServicio" name="hidIdServicio" type="hidden" value=""/>
                                                        <input id="hidNomServicio" name="hidNomServicio" type="hidden" value=""/>

                                                        <div id ="divServicios" style=" width:290px; height: 200px; margin-left:1px; margin-right: 1px" align="center"></div>
                                                    </td>
                                                    <td align="left" width="30%">
                                                        <div id="divXXX">
                                                            <?php
                                                            $toolbar12->SetBoton("Otros Servicios", "Otros Servicios", "btn", "onclick,onkeypress", "mostrarServiciosPorCCostos()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/lassists.png", "", "", 1);
                                                            $toolbar12->Mostrar();
                                                            ?>
                                                        </div>
                                                        <div id="divAsignar">
                                                            <?php
                                                            $toolbar8->SetBoton("Asignar", "Asignar", "btn", "onclick,onkeypress", "asignarExamenServicio()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/lassists.png", "", "", 1);
                                                            $toolbar8->Mostrar();
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" height="30"><h2 style="margin-left: 20px;">Servicios Asignados</h2>
                                        <input type="text" name="buscadorCampo2" value="Buscar..." id="buscadorCampo2" onkeyup='mygridL.filterBy(6,document.getElementById("buscadorCampo2").value);' onfocus="if (this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;">                                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div  id ="divtablaExamenServicio" style=" width:580px; height: 200px; margin-left:3px; margin-right: 3px" align="center" ></div>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        </fieldset>
                    </div>
                </fieldset>
            </div >
        </div>
    </div>
</div>
