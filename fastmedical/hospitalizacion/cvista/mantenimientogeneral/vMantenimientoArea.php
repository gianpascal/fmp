<html>
    <head>
        <?php
        $cboEstado = array(1 => "Activar", 0 => "Desactivar");
        $toolbar0 = new ToollBar("center");
        $toolbar1 = new ToollBar("center");
        $toolbar2 = new ToollBar("right");
        $toolbar3 = new ToollBar("right");
        $toolbar4 = new ToollBar("right");
        $toolbar5 = new ToollBar("right");
        $toolbar6 = new ToollBar("right");
        $toolbar7 = new ToollBar("right");
        $toolbar8 = new ToollBar("right");
        $toolbar9 = new ToollBar("center");
        ?> 

    </head>
    <body>
        <div id="MantenimientoArea">
            <div class="titleform">
                <h1>Mantenimiento de &Aacute;reas</h1>
            </div>
            <div  id ="divInfoAreas" style=" float:left;width:34%; " align="center">
                <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
                    <div id="divLeyenda1" align="center" style="width:auto;height:auto; font-size: 12px; margin-left:15%;margin-right:15%"> <legend> &Aacute;reas Principales (Catalogo)</legend> </div>
                    <div id="divLeyenda2" style="display:none;"> <legend> &Aacute;reas por Sede</legend> </div>

                    <fieldset style="margin:20px;width:auto;height:auto;padding: 0px; font-size:14px;"> 
                        </br>
                        <div id="divComboSedes" align="center">
                            <select id="cboSede" name="cboSede" style="width: 110px;" onchange="buscarArbolArea()">
                                <option value="XX">- Seleccionar -</option>
                                <?php foreach ($comboSucursal as $i => $value) { ?>
                                    <option value="<?php echo $comboSucursal[$i][0] ?>"><?php echo utf8_encode($comboSucursal[$i][14]) ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div id="divBtnNuevaAreaCatalogo" style="width:80%;height:10px; font-size: 12px; margin-left:25%;margin-right:10%">
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][237]["NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][237]["NUEVA_AREA"] == 1)) {
                                $verBotonNuevaArea = 1;
                            } else {
                                $verBotonNuevaArea = 0;
                            }
                            if (isset($_SESSION["permiso_formulario_servicio"][237]["EDITAR_ASIGNAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][237]["EDITAR_ASIGNAR_AREA"] == 1)) {
                                $verBotonEditarAsignar = 1;
                            } else {
                                $verBotonEditarAsignar = 0;
                            }
                            $toolbar1->SetBoton("btnNuevaArea", "Nueva Área", "btn", "onclick,onkeypress", "nuevaAreaCatalogo()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/nuevo.png", "", "", $verBotonNuevaArea);
                            $toolbar1->SetBoton("btnEditarArea", "Editar/Asignación", "btn", "onclick,onkeypress", "editarAreaCatalogo()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/op_atendido.gif", "", "", $verBotonEditarAsignar);
                            $toolbar1->Mostrar();
                            ?>
                        </div>
                        </br>
                        <!--                         <div align="center" style="width:80%;height:10px; font-size: 12px; margin-left:10%;margin-right:30%">
                                                     <input type="text" id="idTxtBuscarArbol" name="idTxtBuscarArbol" value="Ingrese el área a buscar...."  onkeypress="buscarAreaArbol()" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue;" size="20"/>
                                                </div>-->


                        </br>
                    </fieldset>

                    <div id="arbolAreas" align="center" style="width: 90%;height: 430px; background: #D0E5FF;" >
                    </div>

                </fieldset>
            </div>

            <!--       ASIGNACION DE AREAS A SEDE    -->
            <div id="asignacionAreas" style=" float:right;width:65%; height:auto; display:none" align="center">
                <!--            modificado 2012/04/02 antes no tenia display none-->
                <div  id ="divInfoSedes"  >
                    <fieldset style="margin:1px;width:50%;height:auto;padding: 0px; font-size:14px">
                        <legend style="margin:4%">Asignaci&oacute;n de &Aacute;reas a Sedes</legend>
                        <div id="divCheckBoxSedes" align="left" style="margin-left:25%">
                            <form id="ckbSucursales">
                                <?php foreach ($comboSucursal as $i => $value) { ?>                            
                                    <input type="checkbox" name="<?php echo $comboSucursal[$i][14] ?>" id="<?php echo $comboSucursal[$i][0] ?>" value=0  onclick="if(this.checked){this.value=1}else{this.value=0;}" onchange="cargarIdSucursal('<?php echo $comboSucursal[$i][0] ?>',this.value)"/><?php echo utf8_encode($comboSucursal[$i][14]) ?><br>
                                <?php } ?>
                            </form>
                            <?php
                            $toolbar9->SetBoton("btnSeleccionaTodasSucurles", "Seleccionar Todas", "btn", "onclick,onkeypress", "opcionCkbSucursales(1)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/op_atendido.gif", "", "", 1);
                            $toolbar9->SetBoton("btnLimpiaCkbSucursales", "Limpiar", "btn", "onclick,onkeypress", "opcionCkbSucursales(0)", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/limpiar.png", "", "", 1);
                            $toolbar9->Mostrar();
                            ?>
                        </div>
                    </fieldset>
                </div>             
            </div>
            <!--       NUEVA AREA CATALOGO    -->
            <div id="divNuevaAreaCatalogo" style=" float:right;width:65%; height:100px;">

                <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
                    <legend style="margin-left: 2%">Informaci&oacute;n de &Aacute;reas</legend>
                    <div  id ="divTreeExamenFisico" style=" float:left;width:100%; height:150px; margin-left:10% " align="center">
                        <br>
                        <table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="15%" height="25">&Aacute;rea Padre :</td>
                                <td colspan="3"><input name="txtIdAreaPadre" type="text" id="txtIdAreaPadre" disabled value="" size="2">
                                    <input name="txtDescripcionAreaPadre" type="text" id="txtDescripcionAreaPadre" disabled value="" size="65"/>
                                    <input type="hidden" name="estadoPadre" id="estadoPadre" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Nombre &Aacute;rea :</td>
                                <td colspan="3"><input type="text" name="txtIdArea" id="txtIdArea" disabled value="" size="2">
                                    <input type="text" name="txtDescripcionArea" id="txtDescripcionArea" size="65" maxlength="100" disabled value="" onkeypress="return validar(event,1)">
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Abreviatura &Aacute;rea :</td>
                                <td colspan="1"> <input name="txtAbreviaturaArea" type="text" id="txtAbreviaturaArea" disabled value="" size="10" maxlength="50" onkeypress="return validar(event,1)"></td>
                            </tr>    
                            <tr>
                                <td height="25" colspan="1">Estado :</td>
                                <td colspan="3">
                                    <select disabled name="cboEstado" id="cboEstado" style="width: 100px">
                                        <option value="-1">Seleccionar</option>
                                        <?php foreach ($cboEstado as $k => $value) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == 1) { ?> selected <?php } ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td height="25" colspan="2"></td>
                                <td height="25" colspan="2"></td>
                            </tr>
                            <tr>
                                <td  height="25">Nivel :</td>
                                <td ><input type="text" name="txtNivel" id="txtNivel" size="5" disabled value=""></td>
                                <td height="25"><input type="text" name="txtResultados" id="txtResultados" size="5" disabled value="" style="display:none"></td>
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
                                        if (isset($_SESSION["permiso_formulario_servicio"][237]["EDITAR_AREA"]) && ($_SESSION["permiso_formulario_servicio"][237]["EDITAR_AREA"] == 1)) {
                                            $verBotonEditarArea = 1;
                                        } else {
                                            $verBotonEditarArea = 0;
                                        }
                                        $toolbar2->SetBoton("Editar", "Editar", "btn", "onclick,onkeypress", "editaArea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/editar.png", "", "", $verBotonEditarArea);
                                        $toolbar2->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divGraba" style="display: none;">
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][237]["GRABAR_NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][237]["GRABAR_NUEVA_AREA"] == 1)) {
                                            $verBotonGrabarArea = 1;
                                        } else {
                                            $verBotonGrabarArea = 0;
                                        }
                                        $toolbar3->SetBoton("GRABAR", "Grabar", "btn", "onclick,onkeypress", "nuevaArea('nuevo')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", $verBotonGrabarArea);
                                        $toolbar3->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divActualiza" style="display: none;">
                                        <?php
                                        $toolbar4->SetBoton("ACTUALIZAR", "Actualizar", "btn", "onclick,onkeypress", "nuevaArea('actualizar')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/reload3.png", "", "", 1);
                                        $toolbar4->Mostrar();
                                        ?>
                                    </div>
                                <td width="33%">
                                    <div id="divElimina" style="display: none;">
                                        <?php
                                        $toolbar5->SetBoton("ELIMINAR", "Eliminar", "btn", "onclick,onkeypress", "eliminarArea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/delete.png", "", "", 1);
                                        $toolbar5->Mostrar();
                                        ?>
                                    </div>
                                </td>
                                <td width="33%">
                                    <div id="btnAsignarArea" style="display: none;">
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][237]["ABRIR_POPPAP_ASIGNAR_AREA_A_SEDE"]) && ($_SESSION["permiso_formulario_servicio"][237]["ABRIR_POPPAP_ASIGNAR_AREA_A_SEDE"] == 1)) {
//                                          $toolbar0->SetBoton("btnAsignarArea", "Asignar Área a Sede", "btn", "onclick,onkeypress", "asignarAreaASucursal('nuevo')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/clean.png", "", "", 1);
                                            $toolbar0->SetBoton("btnAsignarArea", "Asignar Área a Sede", "btn", "onclick,onkeypress", "podpadAsignacionAreaSede", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/clean.png", "", "", 1);
                                            $toolbar0->Mostrar();
                                        }
                                        ?>
                                    </div> 
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div id="idInfoArea"></div>
                </fieldset>

                <div style="height: 10px"></div>

                <div id="divSucursalesXidArea" style="display: none">
                    <fieldset style="margin:1px;width:98%;height:150px;padding: 0px; font-size:14px">
                        <legend style="margin-left: 2%">Lista de Sedes</legend>
                        <div align="center" style="height: 5px"></div>
                        <div align="center">
                            <div id="divResultadosSucursalesXidArea" align="center" style="width:700px;height:120px; overflow:visible; padding: 0px; font-size:14px"></div>
                        </div>
                    </fieldset>
                </div>

                <div style="height: 10px"></div>

                <div id="divResultadosInsercionArea" style="display: none">
                    <fieldset style="margin:1px;width:98%;height:150px;padding: 0px; font-size:14px">
                        <legend style="margin-left: 2%">Resultados de Asignaci&oacute;n de &Aacute;rea a Sede</legend>
                        <div align="center" style="height: 5px"></div>
                        <div align="center">
                            <div id="divResultados" align="center" style="width:700px;height:120px; overflow:visible; padding: 0px; font-size:14px"></div>
                        </div>
                    </fieldset>
                </div>
            </div>  


            <!--       EDICION SEDE EMPRESA AREA    -->
            <div id="divEdicionSedeEmpresaArea" style=" float:right;width:65%; height:100px;display:none;">
                <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
                    <legend>Informaci&oacute;n de &Aacute;reas por Sede por Empresa</legend>
                    <div  id ="divFormEdicionSedeEmpresaArea" style=" float:left;width:100%; height:150px;">
                        <br>
                        <table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="15%" height="25">&Aacute;rea Padre :</td>
                                <td colspan="3"><input name="txtIdAreaPadreXSede" type="text" id="txtIdAreaPadreXSede" disabled value="" size="2">
                                    <input name="txtDescripcionAreaPadreXSede" type="text" id="txtDescripcionAreaPadreXSede" disabled value="" size="65"/>
                                    <input type="hidden" name="idSedeEmpresaArea" id="idSedeEmpresaArea"value="" />
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Nombre &Aacute;rea :</td>
                                <td colspan="3"><input type="text" name="txtIdAreaXSede" id="txtIdAreaXSede" disabled value="" size="2">
                                    <input type="text" name="txtDescripcionAreaXSede" id="txtDescripcionAreaXSede" size="65" disabled value="">
                                </td>

                            </tr>
                            <tr>
                                <td height="25" colspan="1">Abreviatura &Aacute;rea :</td>
                                <td colspan="1"> <input name="txtAbreviaturaAreaXSede" type="text" id="txtAbreviaturaAreaXSede" disabled value="" size="10"></td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Estado :</td>
                                <td colspan="3">
                                    <select disabled name="cboEstadoXSede" id="cboEstadoXSede" style="width: 100px">
                                        <option value="-1">Seleccionar</option>
                                        <?php foreach ($cboEstado as $k => $value) { ?>
                                            <option value="<?php echo $k; ?>" <?php if ($k == 1) { ?> selected <?php } ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td height="25" colspan="2"></td>
                                <td height="25" colspan="2"></td>
                            </tr>
                            <tr>
                                <td  height="25">Nivel :</td>
                                <td ><input type="text" name="txtNivelXSede" id="txtNivelXSede" size="5" disabled value=""></td>
                                <td height="25"><input type="hidden" name="txtResultadosXSede" id="txtResultadosXSede" size="5" disabled value=""></td>
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
                                    <div id="divEditaAreaXSede">
                                        <?php
                                        if (isset($_SESSION["permiso_formulario_servicio"][237]["EDITAR_AREA_X_SEDE"]) && ($_SESSION["permiso_formulario_servicio"][237]["EDITAR_AREA_X_SEDE"] == 1)) {
                                            $toolbar6->SetBoton("Editar", "Editar", "btn", "onclick,onkeypress", "editaAreaXSede()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/editar.png", "", "", 1);
                                            $toolbar6->Mostrar();
                                        }?>
                                        </div>
                                        <div id="divActualizaAreaXSede" style="display: none;">
                                            <?php
                                            $toolbar7->SetBoton("ACTUALIZAR", "Actualizar", "btn", "onclick,onkeypress", "actualizarAreaXSede", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/reload3.png", "", "", 1);
                                            $toolbar7->Mostrar();
                                            ?>
                                        </div>
                                    <td width="33%">
                                        <div id="divEliminaAreaXSede" style="display: none;">
                                            <?php
                                            $toolbar8->SetBoton("ELIMINAR", "Eliminar", "btn", "onclick,onkeypress", "eliminarAreaXSede()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/delete.png", "", "", 1);
                                            $toolbar8->Mostrar();
                                            ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div id="idInfoAreaXSede"></div>
                </fieldset>
                </br>
                <h2 style="color: green;font:bold;">Nota: si desea Ingresar un &Aacute;rea seleccione la opci&oacute;n '-seleccionar-' y proceda a asignar el &Aacute;rea a la sede</h2>
            </div>  
        </div>  
    </body>
</html>







