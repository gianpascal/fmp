<?php
$toolbarc=new ToollBar("right");
$toolbarr1=new ToollBar("right");
$toolbarr2=new ToollBar("right");
$toolbarr3=new ToollBar("right");
$toolbarr4=new ToollBar("right");
$toolbare1=new ToollBar("right");
$toolbare2=new ToollBar("right");
$toolbare3=new ToollBar("right");
$toolbare4=new ToollBar("right");
$toolbara1=new ToollBar("right");
$toolbara2=new ToollBar("right");
$toolbara3=new ToollBar("right");
$toolbara4=new ToollBar("right");
$toolbarg1=new ToollBar("right");
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
$cboTipoAtributo = array(0 => "Un Valor", 1 => "Multi Valor");
?>
<div id ="divConsultaP" style="width:1000px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1> Mantenimiento de reportes </h1>
    </div>

    <div  id ="divMantenimientoReporte" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqReporte" style=" float:left;width:34%; ">
            <div  id ="divIzqReporte1" style=" width:100%;" >
                <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px;">
                    <legend>&nbsp; Reportes &nbsp;</legend>
                    <div  id ="divTreeReporte" style="float:left;width:100%; height:270px;"></div>
                </fieldset>
            </div>
        </div>
        <script type="text/javascript">
            document.onload =tabsMantenimietoReporte("men1"); //setTimeout(function(){tabsMantenimietoReporte("men1")},200);
        </script>
        <div  id ="divMantenimiento" style="float:right;width:65%; height:auto; " >
            <div  id ="divMantenimiento1" style=" width:99%; float:left; height: auto" align="center" >
                <fieldset style="margin:1px;width:99%;height:auto;padding: 0px; font-size:14px">
                    <legend> Mantenimiento de reportes </legend>
                    <br>
                    <table width="95%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="135px">
                                <ul id="men1">
                                    <li>
                                        <div id="btn_asgPruebas"><a href="#" onclick="tabsMantenimietoReporte('men1');">Mantenimiento Reportes</a></div>
                                    </li>
                                </ul>
                            </td>
                            <td width="135px">
                                <ul id="men2">
                                    <li>
                                        <div id="btn_asgServicios"><a href="#"  onclick="tabsMantenimietoReporte('men2'); listaEtiqueta('formEtiqueta');">Mantenimiento Etiquetas</a></div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul id="men3" >
                                    <li>
                                        <div id="btn_asgServicios"><a href="#"  onclick="tabsMantenimietoReporte('men3'); listaAtributos('formAtributo');">Mantenimiento Atributos</a></div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"> </td>
                        </tr>
                    </table>
                    <div id="mrTab1" style="width:98%; height:auto;">
                        <fieldset style="margin-left:14px;width:580px;height:auto;padding: 0px;float: left; font-size:14px">
                            <form id="formReporte" name="formReporte" action="" method="post" >
                                <table width="95%" cellpadding="0" cellspacing="1" border="0" align="center">
                                    <tr>
                                        <td colspan="4"><h2>Mantenimiento Reporte</h2><br/></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nombre :<input id="hidIdReporte" name="hidIdReporte" type="hidden" value="" ></td>
                                        <td width="35%"><input id="txtNomReporte" name="txtNomReporte" type="text" value="" size="25" ></td>
                                        <td width="15%">Estado : </td>
                                        <td width="35%">
                                            <select name="cboEstadoReporte" id="cboEstadoReporte">
                                                <option value="">Seleccionar</option>
                                                <?php foreach ($cboEstado as $k => $value) { ?>
                                                <option value="<?php echo $k;?>" <?php if($k==1) {?> selected <?php }?>><?php echo $value;?></option>
                                                    <?php }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="4" align="center">
                                            <br>
                                            <div id="divBtnGrabarReporte" style="width: 80px; display: block;">
                                                <?php
                                                $toolbarr1->SetBoton("GrabarReporte","Grabar","btn","onclick,onkeypress","mantenimientoReporte('formReporte','reporte','grabar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbarr1->Mostrar();
                                                ?>
                                            </div>
                                            <div id="divBtnEditarReporte" style="width: 80px; display: none;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $toolbarr2->SetBoton("EditarReporte","Editar","btn","onclick,onkeypress","mantenimientoReporte('','reporte','editar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                                            $toolbarr2->Mostrar();
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $toolbarr3->SetBoton("NuevoReporte","Nuevo","btn","onclick,onkeypress","limpiarFormulario('formReporte')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/window_new.png","","",1);
                                                            $toolbarr3->Mostrar();
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="divBtnModificarReporte" style="width: 80px; display: none;">
                                                <?php
                                                $toolbarr4->SetBoton("ModificarReporte","Modificar","btn","onclick,onkeypress","mantenimientoReporte('formReporte','reporte','modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbarr4->Mostrar();
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <br>
                        </fieldset>
                    </div>

                    <div id="mrTab2" style="width:98%; height:auto;">
                        <fieldset style="margin-left:14px;width:580px;height:auto;padding: 0px;float: left; font-size:14px">
                            <form id="formEtiqueta" name="formEtiqueta" action="" method="post" >
                                <table width="95%" cellpadding="0" cellspacing="1" border="0" align="center">
                                    <tr>
                                        <td colspan="5"><h2>Mantenimiento Etiqueta</h2><br/><input id="hidIdReporteDetalle" name="hidIdReporteDetalle" type="hidden" value="" ></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" align="center">
                                            <fieldset style="margin-left:14px;width:400px;height:auto;padding: 0px; font-size:14px">
                                                <br><p>
                                                    Esta etiqueta se ubicara en :
                                                    <select name="cboTpoReporteDetalle" id="cboTpoReporteDetalle" style="width: 100px;">
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach ($cboTpoReporteDetalle as $k => $value) { ?>
                                                        <option value="<?php echo $cboTpoReporteDetalle[$k][0];?>" <?php if($k==0) {?> selected <?php }?>><?php echo $cboTpoReporteDetalle[$k][1];?></option>
                                                            <?php }?>
                                                    </select></p><br>
                                            </fieldset>
                                            <br>                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nombre :
                                      <input id="hidIdEtiqueta" name="hidIdEtiqueta" type="hidden" value="" ></td>
                                      <td colspan="3"><input id="txtNomEtiqueta" name="txtNomEtiqueta" type="text" value="" size="40" ></td>
                                        <td width="15%" rowspan="2">
                                      <div id="divVerAtributos" style="width: 80px; display: block;">
                                                <?php
                                                $toolbarg1->SetBoton("VerAtributo","Asignar Atributos","btn","onclick,onkeypress","asignarEtiquetaAtributo()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/b_ver_on.gif","","",1);
                                                $toolbarg1->Mostrar();
                                                ?>
                                            </div></td>
                                  </tr>
                                    <tr>
                                        <td width="15%">Estado : </td>
                                        <td width="30%">
              <select name="cboEstadoEtiqueta" id="cboEstadoEtiqueta" style="width: 90px;">
                                                <option value="">Seleccionar</option>
                                                <?php foreach ($cboEstado as $k => $value) { ?>
                                                <option value="<?php echo $k;?>" <?php if($k==1) {?> selected <?php }?>><?php echo $value;?></option>
                                                    <?php }?>
                                            </select>                                        </td>
                                      <td width="10%">Orden : </td>
                                      <td width="30%"><input id="txtOrdenEtiqueta" name="txtOrdenEtiqueta" type="text" value="" size="3"></td>
                                  </tr>
                                    <tr>
                                        <td  colspan="5" align="center">
                                            <br>
                                            <div id="divBtnGrabarEtiqueta" style="width: 80px; display: block;">
                                                <?php
                                                $toolbare1->SetBoton("GrabarEtiqueta","Grabar","btn","onclick,onkeypress","mantenimientoReporte('formEtiqueta','etiqueta','grabar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbare1->Mostrar();
                                                ?>
                                            </div>
                                            <div id="divBtnEditarEtiqueta" style="width: 80px; display: none;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $toolbare2->SetBoton("EditarEtiqueta","Editar","btn","onclick,onkeypress","mantenimientoReporte('','etiqueta','editar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                                            $toolbare2->Mostrar();
                                                            ?>                                                        </td>
                                                        <td>
                                                            <?php
                                                            $toolbare3->SetBoton("NuevaEtiqueta","Nuevo","btn","onclick,onkeypress","limpiarFormulario('formEtiqueta')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/window_new.png","","",1);
                                                            $toolbare3->Mostrar();
                                                            ?>                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="divBtnModificarEtiqueta" style="width: 80px; display: none;">
                                                <?php
                                                $toolbare4->SetBoton("ModificarEtiqueta","Modificar","btn","onclick,onkeypress","mantenimientoReporte('formEtiqueta','etiqueta','modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbare4->Mostrar();
                                                ?>
                                            </div>                                        </td>
                                    </tr>
                                </table>
                        </form>
                        </fieldset>
                        <div style="float: left;width:98%; height:auto;">
                            <br>
                            <table width="100%" cellpadding="0" cellspacing="1" border="0" align="center">
                                <tr>
                                    <td align="center" colspan="4">
                                        <div  id ="divListaEtiqueta" style="width:570px; height:270px;"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div id="mrTab3" style="width:98%; height:auto;">
                        <fieldset style="margin-left:14px;width:580px;height:auto;padding: 0px;float: left; font-size:14px">
                            <form id="formAtributo" name="formAtributo" action="" method="post" >
                                <table width="95%" cellpadding="0" cellspacing="1" border="0" align="center">
                                    <tr>
                                        <td colspan="7"><h2>Mantenimiento Atributo</h2><br/></td>
                                    </tr>
                                    <tr>
                                        <td width="10%">Nombre :<input id="hidIdAtributo" name="hidIdAtributo" type="hidden" value="" ></td>
                                        <td width="30%"><input id="txtNomAtributo" name="txtNomAtributo" type="text" value="" ></td>
                                        <td width="10%">Estado : </td>
                                        <td width="15%">
                                            <select name="cboEstadoAtributo" id="cboEstadoAtributo">
                                                <option value="">Seleccionar</option>
                                                <?php foreach ($cboEstado as $k => $value) { ?>
                                                <option value="<?php echo $k;?>" <?php if($k==1) {?> selected <?php }?>><?php echo $value;?></option>
                                                    <?php }?>
                                            </select>
                                        </td>
                                        <td width="15%">Tipo : </td>
                                        <td width="15%">
                                            <select name="cboAtributo" id="cboAtributo" style="width: 80px;" onchange="abrirVentanaTipoAtributo('nuevo')">
                                                <option value="">Seleccionar</option>
                                                <?php foreach ($cboTipoAtributo as $k => $value) { ?>
                                                <option value="<?php echo $k;?>" <?php if($k==0) {?> selected <?php }?>><?php echo $value;?></option>
                                                    <?php }?>
                                            </select>
                                        </td>
                                        <td width="5%">
                                            <input id="editaAtributoFormato" name="editaAtributoFormato" type="button" value="..." title="Editar valores del Campo" style="display: none; cursor: pointer;" onclick="abrirVentanaTipoAtributo('editar')">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="7" align="center">
                                            <br>
                                            <div id="divBtnGrabarAtributo" style="width: 80px; display: block;">
                                                <?php
                                                $toolbara1->SetBoton("GrabarAtributo","Grabar","btn","onclick,onkeypress","mantenimientoReporte('formAtributo','atributo','grabar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbara1->Mostrar();
                                                ?>
                                            </div>
                                            <div id="divBtnEditarAtributo" style="width: 80px; display: none;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $toolbara2->SetBoton("EditarAtributo","Editar","btn","onclick,onkeypress","mantenimientoReporte('','atributo','editar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                                                            $toolbara2->Mostrar();
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $toolbara3->SetBoton("NuevoAtributo","Nuevo","btn","onclick,onkeypress","limpiarFormulario('formAtributo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/window_new.png","","",1);
                                                            $toolbara3->Mostrar();
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                            <div id="divBtnModificarAtributo" style="width: 80px; display: none;">
                                                <?php
                                                $toolbara4->SetBoton("ModificarAtributo","Modificar","btn","onclick,onkeypress","mantenimientoReporte('formAtributo','atributo','modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                $toolbara4->Mostrar();
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                        <div style="float: left;width:98%; height:auto;">
                            <br>
                            <table width="95%" cellpadding="0" cellspacing="1" border="0" align="center">
                                <tr>
                                    <td align="center" colspan="4">
                                        <div  id ="divListaAtributos" style="width:400px; height:270px;"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div >
        </div>
    </div>
</div>
