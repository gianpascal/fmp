<?php
require_once("../../ccontrol/control/ActionMantenimientoGeneral.php");
require_once("../../../pholivo/Html.php");
$o_ActionMantenimientoGeneral = new ActionMantenimientoGeneral();
//$_SESSION["permiso_formulario_servicio"]=1;

?>
<style type="text/css">
    <!--
    .Estilo6{width:220px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7{width:300px;height:20px;font-size: 14px; font-family: Arial;}
    .Estilo8{width:300px;height:60px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo9{text-decoration: underline;font-weight: bold;font-family: Arial;font-size: 14px;}
    -->

</style>

<div style="width:100%;height: 650px;">
    <div id="Div_AmbLogicosGeneral" style="width: 85%;height: 95%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:block">
        <div>
            <div id="encabezadoMedicoEspecialidad" style="display:block">
                <div style="width:100%;height:5%;background: white">
                    <div class="titleform">
                        <h1>MANTENIMIENTO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;AMBIENTES&nbsp;&nbsp;&nbsp;LÓGICOS</h1>
                    </div>
                </div>
                <div style="width:100%;height:95%">
                    <div id="Div_centroCostos" style="float:left;width: 40%;height: 100%;"></div>
                    <div id="Div_AmbientesLogicos" style="float:right;width: 60%;height: 100%">
                        <div id="Div_DatosAmbientesLogicos" style="position:relative;top: 5%;height: 50%;left: 5%;width: 90%">
                            <div align="center" style="width:100%;height:5%;"><font color="00028F" class="Estilo9">Datos del Ambiente Lógico</font></div>
                            <div align="center" style="width:100%;height:70%;">
                                <fieldset style="margin:5px;padding:5px;border:none">
                                    <table>
                                        <tr>&nbsp;</tr>
                                        <input  id="hidcentrocosto" name="hidcentrocosto" type="hidden" value=""/>
                                        <input  id="hcodigoambientelogico" name="hcodigoambientelogico" type="hidden" value=""/>
                                        <tr><td class="Estilo6">Código Centro Costo</td><td><input class="Estilo7"  id="txtcodigocentrocosto" name="txtcodigocentrocosto" type="text" size="30" readonly="true" value=""/></td></tr>
                                        <tr><td class="Estilo6">Nombre Centro Costo</td><td><input class="Estilo7"  id="txtnombrecentrocosto" name="txtnombrecentrocosto" type="text" size="30" readonly="true" /></td></tr>
                                        <tr><td class="Estilo6">Nombre de Ambiente Lógico</td><td><input class="Estilo7"  id="txtnombreambientelogico" name="txtnombreambientelogico" type="text" size="30" readonly="true"/></td></tr>
                                        <tr><td class="Estilo6">Descripci&oacute;n</td><td><textarea class="Estilo8" id="txtdescripcionambientelogico" name="txtdescripcionambientelogico" rows="2" cols="30" readonly="true"></textarea></td></tr>
                                        <tr><td class="Estilo6">Habilitado</td><td><input type="checkbox" id="checkhabilitarAmbienteLogicos" name="checkhabilitarAmbienteLogicos" disabled="true" checked/></td></tr>
                                    </table>
                                </fieldset>
                            </div>
                            <div id="divNuevo" align="center"  style="width:100%;height:5%;display: block">
                                <?php if($_SESSION["permiso_formulario_servicio"][201]["NUEVO_AMB_LOGICO"]==1) echo"<a href=\"javascript:nuevoAmbienteLogico()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_adiciona_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
                            </div>
                            <div id="divGuardaryRegresar" align="center"  style="width:100%;height:5%;display: none">
                                <?php if($_SESSION["permiso_formulario_servicio"][201]["GRABAR_AMB_LOGICO"]==1) echo"<a href=\"javascript:grabarAmbienteLogico()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
                                <?php if($_SESSION["permiso_formulario_servicio"][201]["LIMPIAR_AMB_LOGICO"]==1) echo"<a href=\"javascript:limpiarDatosAmbienteLogico()\"><img src=\"../../../../fastmedical_front/imagen/btn/btn_limpiar.gif\">";?>
                            </div>
                        </div>
                        <div id="Div_TablaAmbientesLogicos" align="center" style="width:100%;height:50%; overflow: auto;">
                            <div style="width:90%;height:90%">
                                <?php echo $o_ActionMantenimientoGeneral->listadoAmbientesLogicos('');?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
