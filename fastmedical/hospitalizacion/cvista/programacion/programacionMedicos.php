<?php
require_once("ActionCita.php");
require_once("../../../pholivo/Calendario.php");
require_once("../../../pholivo/Html.php");
require_once("../../ccontrol/control/ActionPersona.php");
require_once("../../ccontrol/control/ActionCronograma.php");

$o_ActionPersona = new ActionPersona();
$o_ActionCita = new ActionCita();
$o_ActionCronograma = new ActionCronograma();

//$_SESSION["permiso_formulario_servicio"]=1;
//**** COMBO FILTRO ****//

$datos["codigoCentroCosto"] = '';
$cb_combo_sede = $o_ActionCita->listaDatosSede($datos);
$cb_combo_actividad = $o_ActionCita->listaDatosActividad();
$cb_combo_afiliacionesnoasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesNOAsignadas();
$cb_combo_afiliacionesasignadas = $o_ActionCronograma->obtenerlistaAfiliacionesAsignadas();
//$cb_combo_ambiente = $o_ActionCronograma->SeleccionAmbientes();
//$cb_combo_turno = $o_ActionCronograma->listaDatosTurno();
//*****Tablas******//
//*****Calendario****//
$fechaActualTimeStamp = date("Y-m-d"); //Me da la fecha actual
$idAccion = "5"; //Se envia 5 para que muestre el mes actual
$tsFechaActual = ''; //Si no se envía nada en la fecha actual la calcula el constructor
$diapintado = "0"; //1 pinta el unico dia y 0 no pinta y multi seleccion
//($_nombreCalendario='',$_estiloAccion='', $_estiloCabeceraDia='',$_estiloCasilla1='',$_estiloCasilla2='',$_fechaActual='',$_idAdicionFecha='',$_funcionjsDia='',$_funcionjsCalendario='',$diapintado='')
$o_Cal01 = new Calendario('cal02', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaProgramacionMedicos', 'accionCalendarioProgramacionMedicos', '0', '1', 'seleccionarFechasPorDia');
//****Fecha Actual****//
$fechaActual = date("Y-m-d"); //Me da la fecha actual
$mes = date("m");
$anio = date("Y");

//["permiso_formulario_servicio"][118]
?>
<style type="text/css">
    .Estilo6{width:140px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7{width:300px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo8{width:230px;height:40px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo9{font-weight: bold;font-family: Arial;font-size: 14px;}
    .Estilo10{font-family: Arial;font-size: 12px;}
    .Estilo11{font-family: Arial;font-size: 14px;font-weight: bold;}
</style>
<div align="center" style="height: 750px">
    <div style="width:100%;height:5%;background: white">
        <div class="titleform" style="width:100%;height:90%;">
            <h1>PROGRAMACIÓN&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;MÉDICOS</h1>
        </div>
    </div>
    <div id="divGeneralProgramacionMedicos1" style="width:98%;height: 96%;display:block;border: 1px solid black;display:block">
        <div id="divBusquedasProgramacionMedicos" style="float:left;width:35%;height: 96%;text-align: center;">
            <div align="center" style="width:100%;height:5%;background: white;text-align: center">
                <!--<input type="text" id="hOpcionSede" name="hOpcionSede" value="0000000001" />-->
                <div align="left" style="width:90%;height:100%;vertical-align: middle;text-align: center;margin-left: auto;margin-right: auto">
                    <?php //echo html_entity_decode($cb_combo_sede); ?>
                </div>
                <!--<input type="text" id="hOpcionSede" name="hOpcionActividad" value="0001" />-->
            </div>
            <div style="width:100%;height:55%;background: white">
<!--                    <input type="text" id="hServicio" name="hCentroCosto" />
                    <input type="text" id="hNombreCentroCosto" name="hNombreCentroCosto" />-->
                    <input type="text" id="txtbuscarservicio" name="txtbuscarservicio" onkeypress="if(event.keyCode==13)busquedaarbol();" /> <a onClick="busquedaarbol()">Buscar</a>
                <div  id ="Div_centroCostos" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;border:1px solid black;">
                </div>
            </div>
            <div style="width:100%;height:40%;background: white">
                <!--<input type="text" id="hCodigoPersonalSalud" name="hCodigoPersonalSalud" />-->  
                <div id ="divBusCronogramaMedico" style="width:95%;height:96%;margin-left:1%;margin-right:1%;overflow: hidden;" >
                    <fieldset style="margin:5px;padding:5px;height:92%;">
                        <legend style="text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Buscar M&eacute;dico</legend>
                        <?php
                        $o_ActionPersona->buscadorMedicoGeneral();
                        ?>
                    </fieldset>
                </div>
            </div>
        </div>
        <div style="float:right;width:65%;height: 100%">
            <div id="divFondoProgramacionMedicos" style="width:100%;height:auto;display: block">
                <div id="programacioncitas" style="width:100%;height:auto;"><!--<a href="#" onclick = javascript:setCabeceraCronograma();>LUIS</a><?php //echo html_entity_decode($tablita);    ?>-->
                    <input type="hidden" id="hidcentrocosto" name="hidcentrocosto" value="" />
                    <div id="Div_nombrecentrocosto" align="center" style="width: 100%;height: 5%"><font style="font-family: arial;font-size: 24px;font-weight: bold"></font></div>
                    <div id="Div_datosEmpleadoMedicos" style="width: 96%;height: 30%; overflow: auto; border:1px solid black;"></div>
                    <BR>
                    <div style="width: 96%;height: 50%">
                        <input type="hidden" id="hnombrepersona" name="hnombrepersona" value="" />
                        <div style="height:27%;">
                            <fieldset style="height: 100%;">
                                <legend>Datos Estadísticos Mensuales</legend>
                                <div id="Div_estadisticaMensual">

                                </div>
                            </fieldset>
                        </div>
                        <div id="Div_nombreMedico" align="center" style="width: 100%;height: auto"><font style="font-family: arial;font-size: 24px;font-weight: bold"></font></div>
                        <br/>
                        <div align="center" style="width: 100%;height: auto;background: white">
                            <table>
                                <tr>
                                    <td class="Estilo11" align="center">MES</td>
                                    <td class="Estilo6" align="center">
                                        <select class="Estilo10" name="cb_filtro_mes" id="cb_filtro_mes" onchange="filtrobusquedasfechasProgramacionMedicos()">
                                            <option value="01" <?php if ($mes == '01') echo "selected" ?>>Enero&nbsp;&nbsp;</option>
                                            <option value="02" <?php if ($mes == '02') echo "selected" ?>>Febrero&nbsp;&nbsp;</option>
                                            <option value="03" <?php if ($mes == '03') echo "selected" ?>>Marzo&nbsp;&nbsp;</option>
                                            <option value="04" <?php if ($mes == '04') echo "selected" ?>>Abril&nbsp;&nbsp;</option>
                                            <option value="05" <?php if ($mes == '05') echo "selected" ?>>Mayo&nbsp;&nbsp;</option>
                                            <option value="06" <?php if ($mes == '06') echo "selected" ?>>Junio&nbsp;&nbsp;</option>
                                            <option value="07" <?php if ($mes == '07') echo "selected" ?>>Julio&nbsp;&nbsp;</option>
                                            <option value="08" <?php if ($mes == '08') echo "selected" ?>>Agosto&nbsp;&nbsp;</option>
                                            <option value="09" <?php if ($mes == '09') echo "selected" ?>>Septiembre&nbsp;&nbsp;</option>
                                            <option value="10" <?php if ($mes == '10') echo "selected" ?>>Octubre&nbsp;&nbsp;</option>
                                            <option value="11" <?php if ($mes == '11') echo "selected" ?>>Noviembre&nbsp;&nbsp;</option>
                                            <option value="12" <?php if ($mes == '12') echo "selected" ?>>Diciembre&nbsp;&nbsp;</option>
                                        </select></td>
                                    <td class="Estilo11" align="center">--</td>
                                    <td class="Estilo6" align="center">AÑO</td>
                                    <td class="Estilo6" align="left">
                                        <?php
                                        $cadena = "<select class=\"Estilo10\" id=\"cb_filtro_anio\" name=\"cb_filtro_anio\" onchange=\"filtrobusquedasfechasProgramacionMedicos()\">";
                                        for ($i = 2003; $i <= $anio + 1; $i++) {
                                            $cadena = $cadena . "<option value=\"" . $i . "\" ";
                                            if ($i == $anio)
                                                $cadena = $cadena . "selected";
                                            $cadena = $cadena . ">" . $i . "&nbsp;&nbsp;</option>";
                                        }
                                        $cadena = $cadena . "</select>";
                                        echo $cadena;
                                        ?>
                                    </td>
                                    <td>
                                        <label>
                                            <a href="javascript:abrirPopudReporteMensualCronograma()">Reporte Mensual Log Cronograma</a>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br/>
                        <div id="Div_ProgramacionMedicoMensual" style="width: 100%;height: 55%; overflow: auto; border:1px solid black;"></div>
                        <br>
                        <table  cellspasing="0" style="width:100%;border:1px solid">
                            <tr>
                                <td bgcolor="#DBDBDB"><center>Pasadas</center></td> 
                                <td bgcolor="#FFAEFA"><center>Eliminadas</center></td>
                                <td bgcolor="#82D33F"><center>Activas</center></td>
                            </tr>
                        </table>
                        <div style="width: 100%;height: 10%">
                            <?php if ($_SESSION["permiso_formulario_servicio"][119]["NUEVA_PROG_MED"] == 1) echo"<a href=\"javascript:nuevaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_nuevo_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div id="divGeneralProgramacionMedicos2" style="width:96%;height: 98%;display:none;">
        <div>
            <div id="Div_nombreMedico2" align="center" style="width: 100%;height: 7%"><font style="font-family: arial;font-size: 24px;font-weight: bold"></font></div>
            <div id="divProgramacionMedicos" style="width:100%;height:95%;display: none">
                <div style="width: 100%;height: 68%">
                    <!--campo oculto--> <input type="hidden" name="hcodigoverificacion" id ="hcodigoverificacion" value="" />
                    <!--campo oculto--> <input type="hidden" name="hcodigopersona" id ="hcodigopersona" value="" />
                    <!--campo oculto--> <input type="hidden" name="hcodigocronograma" id ="hcodigocronograma" value="" />
                                        <!--<div align="center" style="width: 100%;height: 7%;background: white"><?php echo"<a href=\"javascript:accionNuevaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_nuevo_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?></div>-->
                    <div id="calendario"style="width: 100%;height: 53%">
                        <div id="divProgramacionMedicos" style="float: left;width: 40%;height: 100%">
                            <input type="hidden" id="hFechaSeleccionada" name="hFechaSeleccionada" value="<?php echo $fechaActualTimeStamp ?>"/>
                            <!--campo oculto-->         <input type="hidden" id="hFechasAProgramar" name="hFechasAProgramar" size="60"/>
                            <fieldset style="margin:5px;padding:5px;height:90%;">
                                <!--<fieldset style="margin:10px;padding:20px;">-->
                                <div id="divCalendario" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                                    <?php
                                    $calendario = $o_Cal01->getHTMLFullCalendario();
                                    echo $calendario;
                                    ?>
                                </div>
                            </fieldset>
                        </div>
                        <div id="Div_CronogramaxAfiliacion" align="center" style="float: right;width: 60%;height: 100%">
                            <table style="width:90%;height: 100%">
                                <tr>
                                    <td width="45%" height="100%">
                                        <table style="width:100%;height: 100%">
                                            <tr style="width:100%;height: 10%"><td align="center" width="100%">No Seleccionadas</td></tr>
                                            <tr style="width:100%;height: 90%"><td width="100%">
                                                    <div id="Div_afiliacionesnoasignadas"><?php echo html_entity_decode($cb_combo_afiliacionesnoasignadas); ?></div>
                                                </td></tr>
                                        </table>
                                        <!--campo oculto-->                 <input type="hidden" id="hafiliacionesnoasignadas" name="hafiliacionesnoasignadas" value="" />
                                    </td>

                                    <td align="center" width="10%" height="100%">
                                        <div>&nbsp;</div>
                                        <div><?php
                                            if ($_SESSION["permiso_formulario_servicio"][119]["SELEC_AFIL"] == 1) {
                                                echo "<a href=\"javascript:agregarAfiliaciones()\"><img src=\"../../../../medifacil_front/imagen/icono/b_adelante.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                                            }
                                            ?>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div><?php
                                            if ($_SESSION["permiso_formulario_servicio"][119]["DESELEC_AFIL"] == 1) {

                                                echo "<a href=\"javascript:quitarAfiliaciones()\"><img src=\"../../../../medifacil_front/imagen/icono/b_atras.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                                            }
                                            ?>
                                        </div>
                                        <div>&nbsp;</div>
                                    </td>
                                    <td width="45%" height="100%">
                                        <table style="width:100%;height: 100%">
                                            <tr style="width:100%;height: 10%"><td align="center" width="100%">Seleccionadas</td></tr>
                                            <tr style="width:100%;height: 90%">
                                                <td width="100%">
                                                    <div id="Div_afiliacionesasignadas"><?php echo html_entity_decode($cb_combo_afiliacionesasignadas); ?></div>
                                                </td></tr>
                                        </table>
                                        <!--campo oculto-->                 <input type="hidden" id="hafiliacionesasignadas" name="hafiliacionesasignadas" value="" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <input type="hidden" name="hhorainicio" id="hhorainicio" value="" />
                    <input type="hidden" name="hhorafinal" id="hhorafinal" value="" />
                    <input type="hidden" name="hdnCodAmbLogico" id="hdnCodAmbLogico" value="" />
                    <input type="hidden" name="hcodigoambientefisico" id="hcodigoambientefisico" value="" />
                    <div id="Div_selecciones" align="center" style="width: 100%">
                        <?php
                        require_once("ActionCita.php");
                        $o_ActionCita = new ActionCita();
                        $datos["ip"] = $_SESSION["ip"];
                        $datos["codigoCentroCosto"] = '';
                        $cb_combo_sede = $o_ActionCita->listaDatosSedeSolo($datos);
                        ?>
                        <div id="divcodigoCita" style="display:none"></div>
                        <table>

                            <tr><td class="Estilo6">Puesto</td><td>
                                    <table width="100%" align="left"><tr>
                                            <td align="left" width="100%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_puestos"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_puestos" id="cb_filtro_puestos" disabled>
                                                        <option>Seleccionar&nbsp;&nbsp;</option></select></div></td></tr>
                                    </table>

                                </td></tr>
                            <tr><td class="Estilo6">Actividad</td><td>
                                    <table width="100%" align="left"><tr>
                                            <td align="left" width="100%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_actividad"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_actividad" id="cb_filtro_actividad" disabled>
                                                        <option>Seleccionar&nbsp;&nbsp;</option></select></div></td></tr>
                                    </table>

                                </td></tr>
                            <tr><td class="Estilo6">Servicio</td><td>
                                    <table width="100%" align="left"><tr>
                                            <td align="left" width="100%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_servicios"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_servicios" id="cb_filtro_servicios" disabled>
                                                        <option>Seleccionar&nbsp;&nbsp;</option></select></div></td></tr>
                                    </table>

                                </td></tr>
                            <tr>
                                <td class="Estilo6">
                                    Sede
                                </td>
                                <td>
                                    <div id="Div_sedes">
                                        <?php echo html_entity_decode($cb_combo_sede); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr><td class="Estilo6">Ambiente</td><td>
                                    <table width="100%" align="left"><tr>
                                            <td align="left" width="100%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_ambienteslogicos"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_ambienteslogicos" id="cb_filtro_ambienteslogicos" disabled>
                                                        <option>Seleccionar&nbsp;&nbsp;</option></select></div></td></tr>
                                    </table>

                                </td></tr>
                            <tr><td class="Estilo6">Localizaci&oacute;n</td><td>
                                    <table width="100%" align="left">
                                        <tr>
                                            <td align="left" width="40%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_ambientesfisicos"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_ambientefisico" id="cb_filtro_ambientefisico" disabled>
                                                        <option value="0000">Seleccionar&nbsp;&nbsp;</option></select></div>

                                            </td>
                                            <td>
                                                <?php if ($_SESSION["permiso_formulario_servicio"][119]["VER_PROG_AMB_FISICO"] == 1) echo "<a href=\"javascript:verCruces();\"><img src=\"../../../../medifacil_front/imagen/btn/b_ver_on.gif\"></a>" ?>
                                            </td>

                                        </tr>
                                    </table>

                                </td></tr>
                            <!--campo oculto-->         <input type="hidden" id="hcodigoturno" name="hcodigoturno" value="" />
                            <tr><td class="Estilo6">Turno</td><td>
                                    <table width="100%" align="left">
                                        <tr>
                                            <td align="left" width="50%" style="font-family:Arial;font-size:11pt">
                                                <div id="Div_turnoinicio" style="float:left"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_turnoinicio" id="cb_filtro_turnoinicio" disabled>
                                                        <option>Inicio&nbsp;&nbsp;</option></select></div>
                                                &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;
                                                <div id="Div_turnofinal" style="float:right"><select style="font-family:Arial;font-size: 11pt" name="cb_filtro_turnofinal" id="cb_filtro_turnofinal" disabled>
                                                        <option>Final&nbsp;&nbsp;</option></select></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td></tr>
                            <tr><td class="Estilo6">Tiempo de Atenci&oacute;n</td><td><input type="text" id="txttiempoatencion" name="txttiempoatencion" value="" readonly ="true"/></td></tr>
                            <tr><td class="Estilo6">Cupos</td><td><input id="txtcuposxturno" name="txtcuposxturno" type="text" value="5" size="10" readonly="true"/></td></tr>
                            <tr><td class="Estilo6">Cupos Adicionales</td><td><input id="txtcuposadicionalesxturno" name="txtcuposadicionalesxturno" value="0" type="text" maxlength="2" size="10" onkeypress="javascript: return numbersonly(this, event, '.');"/></td></tr>
                            <tr style="visibility: hidden"><td class="Estilo6"  >Programado</td><td><input id="chkProgramado" name="chkProgramado"  type="checkbox" onclick="activarFechaProgramacion(this);"/></td></tr>
                            <tr style="visibility: hidden"><td class="Estilo6" >Fecha </td><td><input id="txtFechaProgramacion" size="10" name="txtFechaProgramacion" disabled type="input" onclick="calendarioHtmlx('txtFechaProgramacion')"/></td></tr>

                        </table>

                    </div>
                    <br/>
                    <div id="Div_grabar" align="center" style="width: 100%;background: bottom;display: block">
                        <?php if ($_SESSION["permiso_formulario_servicio"][119]["GRABAR_PROG_MED"] == 1) echo "<a href=\"javascript:validarCronogramaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                        <?php if ($_SESSION["permiso_formulario_servicio"][119]["CANCELAR_GRABAR_PROG_MED"] == 1) echo "<a href=\"javascript:regresarCronogramaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_cancelar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                    </div>
                    <!--campo oculto--> <input type="hidden" name="hTipoActualizacion" id="hTipoActualizacion" value="" />
                    <div id="Div_actualizar" align="center" style="width: 100%;background: bottom;display: none">
                        <?php echo"<a href=\"javascript:validarCronogramaReProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_actualizar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                        <?php echo"<a href=\"javascript:regresarCronogramaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_cancelar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                    </div>
                    <div id="Div_regresar" align="center" style="width: 100%;background: bottom;display: none">
                        <?php echo"<a href=\"javascript:regresarCronogramaProgramacionMedicos()\"><img src=\"../../../../medifacil_front/imagen/btn/b_regresar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden"  id="var1">
    <input type="hidden"  id="var2">
    <input type="hidden"  id="var3">
    <input type="hidden"  id="var4">


</div>