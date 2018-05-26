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
    <tr style="display:none;"><td class="Estilo6">Localizaci&oacute;n</td><td>
            <table width="100%" align="left">
                <tr>
                    <td align="left" width="40%" style="font-family:Arial;font-size:11pt">
                        <div id="Div_ambientesfisicos">
                            <select style="font-family:Arial;font-size: 11pt" name="cb_filtro_ambientefisico" id="cb_filtro_ambientefisico" disabled>
                                <option value="0000">Seleccionar&nbsp;&nbsp;</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <?php if ($_SESSION["permiso_formulario_servicio"][119]["VER_PROG_AMB_FISICO"] == 1) echo "<a href=\"javascript:verCruces();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_ver_on.gif\"></a>" ?>
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
    <tr><td class="Estilo6">Cupos Adicionales</td><td><input id="txtcuposadicionalesxturno" name="txtcuposadicionalesxturno" value="0" type="text" maxlength="2" size="10" onkeypress="javascript: return numbersonly(this, event,'.');"/></td></tr>
    <tr><td class="Estilo6"  >Programado</td><td><input id="chkProgramado" name="chkProgramado"  type="checkbox" onclick="activarFechaProgramacion(this);"/></td></tr>
    <tr><td class="Estilo6" >Fecha </td><td><input id="txtFechaProgramacion" size="10" name="txtFechaProgramacion" disabled type="input" onclick="calendarioHtmlx('txtFechaProgramacion')"/></td></tr>
</table>
