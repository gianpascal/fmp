<?php
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
?>
<div id ="divConsultaP" style="width:950px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Ex&aacute;menes f&iacute;sicos</h1>
    </div>
    <div  id ="divPersonal_1" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">

        <div  id ="divIzqPersonal_1" style=" float:left;width:34%; ">
            <div  id ="divIzqSupPersonal_1" style=" width:100%;" align="center" >

            </div>
            <div  id ="divIzqInfPersonal_1" style=" width:100%;" >
                <div style=" width:98%;">

                </div>
                <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
                    <legend></legend>
                    <div  id ="divTreeExamen" style=" float:left;width:100%; height:400px;">

                    </div>
                </fieldset>
            </div>
        </div>
        <div  id ="divExamenFisico" style=" float:right;width:61%; ">
        </div>
        <div  id ="divExamenFisico" style=" float:right;width:65%; height:200px; " >
            <div  id ="divExamenFisico" style=" width:99%; height: auto" align="center" >
                <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
                    <legend>Mantenimiento de Ex&aacute;menes F&iacute;sicos</legend>
                    <div  id ="divTreeExamenFisico" style=" float:left;width:100%; height:150px;">
                        <br>
                        <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="13%" height="25">C&oacute;digo Padre :
                                    <input type="hidden" name="txtExamen" id="txtExamen" value=""></td>
                                <td colspan="3"><input name="txtPadre" type="text" id="txtPadre" disabled value="" size="5">
                                    <input name="txtDescripcionPadre" type="text" id="txtDescripcionPadre" disabled value="" />
                                    <input type="button" name="btnAsignarPadre" id="btnAsignarPadre" style="visibility:visible" value="..." onclick="padreExamenFisico()" />
                                </td>
                                <td width="16%" height="15%">C&oacute;digo Jer&aacute;rquico :</td>
                                <td height="25%" colspan="3">
                                    <input type="text" name="txtJerarquia" id="txtJerarquia" disabled value="">
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">T&iacute;tulo :</td>
                                <td colspan="3"><input type="text" name="txtTitulo" id="txtTitulo" size="35" value=""></td>
                                <td height="25" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">Estado :</td>
                                <td colspan="3"><select name="cboEstado" id="cboEstado">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($cboEstado as $k => $value) { ?>
                                        <option value="<?php echo $k;?>"><?php echo $value;?></option>
                                            <?php }?>
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
                                    <?php
                                    $toolbar1=new ToollBar("right");
                                    $toolbar2=new ToollBar("right");
                                    $toolbar3=new ToollBar("right");
                                    $toolbar4=new ToollBar("right");
                                    ?>
                                    <div id="divEdita" style="display: none;">
                                        <?php
                                        $toolbar1->SetBoton("Editar","Editar","btn","onclick,onkeypress","editaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                        $toolbar1->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divGraba" style="display: block;">
                                        <?php
                                        $toolbar2->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nue_actExamenFisico('nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                        $toolbar2->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divActualiza" style="display: none;">
                                        <?php
                                        $toolbar3->SetBoton("ACTUALIZAR","Actualizar","btn","onclick,onkeypress","nue_actExamenFisico('actualizar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/reload3.png","","",1);
                                        $toolbar3->Mostrar();
                                        ?>
                                    </div>
                                <td width="33%">
                                    <div id="divElimina" style="display: none;">
                                        <?php
                                        $toolbar4->SetBoton("ELIMINAR","Eliminar","btn","onclick,onkeypress","eliminaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/delete.png","","",1);
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

        <div  id ="divBotones" style=" float:right;width:65%; height:40px; " >
            <div id ="botones" style=" float:left;width:100%;height:40px; margin-left:35%; margin-right: 35%">
                <br>
                <table width="100" border="0" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td width="50%">
                            <?php
                            $toolbar5=new ToollBar("right");
                            $toolbar6=new ToollBar("right");
                            ?>
                            <div id="divAgregar">
                                <?php
                                $toolbar5->SetBoton("Agregar","Agregar","btn","onclick,onkeypress","editaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                $toolbar5->Mostrar();
                                ?>
                            </div>
                        <td width="50%">
                            <div id="divQuitar">
                                <?php
                                $toolbar6->SetBoton("Quitar","Quitar","btn","onclick,onkeypress","eliminaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/delete.png","","",1);
                                $toolbar6->Mostrar();
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div  id ="divGeneraCampo" style=" float:right;width:65%; height:400px; " >
            <div  id ="divGeneraCampo" style=" width:99%; height: auto" align="center" >
                <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
                    <legend>Asignar Campos a Ex&aacute;men</legend>
                    <div  id ="divTreeExamenFisico" style=" float:left;width:100%; height:150px;">
                        <br>
                        <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="13%" height="25"> :
                                    <input type="hidden" name="txtExamen" id="txtExamen" value=""></td>
                                <td colspan="3"><input name="txtPadre" type="text" id="txtPadre" disabled value="" size="5">
                                    <input name="txtDescripcionPadre" type="text" id="txtDescripcionPadre" disabled value="" />
                                    <input type="button" name="btnAsignarPadre" id="btnAsignarPadre" style="visibility:visible" value="..." onclick="padreExamenFisico()" />
                                </td>
                                <td width="16%" height="15%">C&oacute;digo Jer&aacute;rquico :</td>
                                <td height="25%" colspan="3">
                                    <input type="text" name="txtJerarquia" id="txtJerarquia" disabled value="">
                                </td>
                            </tr>
                            <tr>
                                <td height="25" colspan="1">T&iacute;tulo :</td>
                                <td colspan="3"><input type="text" name="txtTitulo" id="txtTitulo" size="35" value=""></td>
                                <td height="25" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="40" colspan="7">
                               <?php
                               require_once("../../ccontrol/control/ActionAdmision.php");
                               $actActoMed= new ActionActoMedico();
                               $html=$actActoMed->agregarMasCampos('','');
                               echo $html;
                               ?>
                                    <div id="divCampo"></div>
                               </td>
                            </tr>
                        </table>
                    </div>

                    <div id ="botones" style=" float:left;width:100%;height:30px;">
                        <table width="100" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="33%">
                                    <?php
                                    $toolbar1=new ToollBar("right");
                                    $toolbar2=new ToollBar("right");
                                    $toolbar3=new ToollBar("right");
                                    $toolbar4=new ToollBar("right");
                                    ?>
                                    <div id="divEdita" style="display: none;">
                                        <?php
                                        $toolbar1->SetBoton("Editar","Editar","btn","onclick,onkeypress","editaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                        $toolbar1->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divGraba" style="display: block;">
                                        <?php
                                        $toolbar2->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nue_actExamenFisico('nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                        $toolbar2->Mostrar();
                                        ?>
                                    </div>
                                    <div id="divActualiza" style="display: none;">
                                        <?php
                                        $toolbar3->SetBoton("ACTUALIZAR","Actualizar","btn","onclick,onkeypress","nue_actExamenFisico('actualizar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/reload3.png","","",1);
                                        $toolbar3->Mostrar();
                                        ?>
                                    </div>
                                <td width="33%">
                                    <div id="divElimina" style="display: none;">
                                        <?php
                                        $toolbar4->SetBoton("ELIMINAR","Eliminar","btn","onclick,onkeypress","eliminaExamenFisico()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/delete.png","","",1);
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
    </div>
</div>
