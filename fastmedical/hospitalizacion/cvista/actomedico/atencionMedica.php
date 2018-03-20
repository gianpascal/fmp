'<input type="hidden" name="hcodigoProgramacion" id="hcodigoProgramacion" value="" />
<input type="hidden" id="htxtestadoatencion" name="htxtestadoatencion" value="" />
<input type="hidden" id="htxtcodigopaciente" name="htxtcodigopaciente" value="" />
<input type="hidden" id="htxtcodigoservicio" name="htxtcodigoservicio" value="" />
<input type="hidden" name="htxtEsESSALUD" id="htxtEsESSALUD" value="" />
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../../ccontrol/control/ActionActoMedico.php");
$mes = date("m");
$anio = date("Y");
$o_ActionActoMedico = new ActionActoMedico();
$programacionMedico = array();
$programacionMedico["codigoPersona"] = $_SESSION["id_persona"];
$programacionMedico["mesprogramacion"] = $mes;
$programacionMedico["anioprogramacion"] = $anio;

//$tablacontadoresmensuales = $o_ActionActoMedico->mostrarAtencionesMensuales($mes,$anio);
?>
<div align="center" style="width:100%">
    <div id="Div_GeneralActoMedico" style="width:92%;" >
        <div style="width:100%;height:25px;background: white">
            <div class="titleform">
                <h1>AGENDA MÉDICA - CONSULTORIO</h1>
            </div>
        </div>
        <input type="hidden" name="hcodigoCronograma" id="hcodigoCronograma" value="" />
        <input type="hidden" name="hcodigoActividad" id="hcodigoActividad" value="" />
        <input type="hidden" name="hidtablacronogramas" id="hidtablacronogramas" value="" />
        <input type="hidden" name="hidtablapacientes" id="hidtablapacientes" value="" />
        <input type="hidden" name="hidtipoprogramacion" id="hidtipoprogramacion" value="" />
        <input type="hidden" name="henHora" id="henHora" value="" />
        <div style="width:100%;height: 280px;">
            <div style="width: 30%;height: 100%;float:left;background: white;border-color: green">
                <div class="titleform">
                    <h6>DATOS PERSONALES</h6>
                </div>
                <div style="height: 57%">
                    <table style="width: 100%;height: 60%" border="0">
                        <tr>
                            <td width="112">C&oacute;digo</td>
                            <td width="201"><input type="text" name="txtcodigoMedico" id="txtcodigoMedico" size="10" readonly="true" value="<?php echo $_SESSION["id_persona"]; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Puesto del Médico</td>
                        </tr>
                        <tr>
                            <td colspan="2"><div align="center">
                                    <input type="text" name="txtpuesto" id="txtpuesto" size="35" readonly/>
                                </div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Apellidos y Nombres</td>
                        </tr>
                        <tr>
                            <td colspan="2"><div align="center">
                                    <input type="text" name="txtnombrecompleto" id="txtnombrecompleto" size="35" readonly/>
                                </div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Consultorio</td>
                        </tr>
                        <tr>
                            <td colspan="2"><div align="center"><input type="text" name="txtconsultorio" id="txtconsultorio" size="35" readonly/></div></td>
                        </tr>
                        <tr>
                            <td>Mes</td>
                            <td>
                                <select class="Estilo10" name="cb_filtro_mes" id="cb_filtro_mes" onchange="mostrarprogramacionMedicosActoMedico()">
                                    <option value="01" <?php if ($mes == '01')
    echo "selected" ?>>Enero&nbsp;&nbsp;</option>
                                    <option value="02" <?php if ($mes == '02')
                                            echo "selected" ?>>Febrero&nbsp;&nbsp;</option>
                                    <option value="03" <?php if ($mes == '03')
                                            echo "selected" ?>>Marzo&nbsp;&nbsp;</option>
                                    <option value="04" <?php if ($mes == '04')
                                            echo "selected" ?>>Abril&nbsp;&nbsp;</option>
                                    <option value="05" <?php if ($mes == '05')
                                            echo "selected" ?>>Mayo&nbsp;&nbsp;</option>
                                    <option value="06" <?php if ($mes == '06')
                                            echo "selected" ?>>Junio&nbsp;&nbsp;</option>
                                    <option value="07" <?php if ($mes == '07')
                                            echo "selected" ?>>Julio&nbsp;&nbsp;</option>
                                    <option value="08" <?php if ($mes == '08')
                                            echo "selected" ?>>Agosto&nbsp;&nbsp;</option>
                                    <option value="09" <?php if ($mes == '09')
                                            echo "selected" ?>>Septiembre&nbsp;&nbsp;</option>
                                    <option value="10" <?php if ($mes == '10')
                                            echo "selected" ?>>Octubre&nbsp;&nbsp;</option>
                                    <option value="11" <?php if ($mes == '11')
                                            echo "selected" ?>>Noviembre&nbsp;&nbsp;</option>
                                    <option value="12" <?php if ($mes == '12')
                                            echo "selected" ?>>Diciembre&nbsp;&nbsp;</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Año</td>
                            <td><?php
                                        $cadena = "<select class=\"Estilo10\" id=\"cb_filtro_anio\" name=\"cb_filtro_anio\" onchange=\"mostrarprogramacionMedicosActoMedico()\">";
                                        for ($i = 2003; $i <= $anio + 1; $i++) {
                                            $cadena = $cadena . "<option value=\"" . $i . "\" ";
                                            if ($i == $anio)
                                                $cadena = $cadena . "selected";
                                            $cadena = $cadena . ">" . $i . "&nbsp;&nbsp;</option>";
                                        }
                                        $cadena = $cadena . "</select>";
                                        echo $cadena;
?></td>
                        </tr>
                    </table>
                </div>
                <br/>
                <!--                Atenciones Mensuales-->
                <!--                <div id="Div_atencionesmensuales" style="height: 37%">
                <?php //echo $tablacontadoresmensuales;?>
                                </div>-->
            </div>
            <div style="width: 70%;height: 100%;float:right">
                <div class="titleform">
                    <h6>CRONOGRAMA MÉDICO</h6>
                </div>
                <div>
                    <div id="Div_programacionMedicosActoMedico" style="width:100%;height: 75%">

                    </div>
                    Atenciones Diarias
                    <div id="Div_atencionesdiaria" style="width:100%;height: 25%">
                        <?php
                        $cadena = "<table style=\"width: 50%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
                        <tr>
                            <td bgcolor='#D2DDFB' width=\"40\"><div align=\"center\"><b>Atendidos</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"40\"><div align=\"center\"><b>Por Regularizar</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"40\"><div align=\"center\"><b>No Atendidos</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"40\"><div align=\"center\"><b>Total</b></div></td>
                        </tr>
                        <tr align=\"center\">
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input type='text' id='hatendidos' value='0' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' disabled/> </div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input type='text' id='hregularizar' value='0' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' disabled /></div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input type='text' id='hnoAtendidos' value='0' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' disabled /></div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input type='text' id='hTotal' value='0' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' disabled/></div></td>
                        </tr>
                    </table>";
                        echo $cadena;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div  style="width:100%;height:5% ">
            <div style="width: 50%;float:left">
                <table>
                    <tr style="width: 100%">
                        <td style="width: 10%;">LEYENDA</td>
                        <td style="border-style:solid; border-width:1px;   width: 25%;background-color:orange" align="center">ATENDIDO</td>
                        <td style="width: 5%;"></td>
                        <td style="border-style: solid;border-width:1px; width: 25%;background-color:#ffff" align="center">NO ATENDIDO</td>
                        <td style="width: 5%;"></td>
                        <td style="border-style:solid; border-width:1px; width: 30%;background-color:#D1FCD2" align="center">POR REGULARIZAR</td>
                    </tr>
                </table>
            </div>
            <div style="width: 50%;float:right">
                <table>
                    <tr>
                        <td>Adicionales Máximo para este cronograma&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="txtcuposadicionales" id="txtcuposadicionales" value="0" size="5" /></td>
                        <td>
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][115]["GRABAR_ADIC_MAX_PROG_MED"]) && ($_SESSION["permiso_formulario_servicio"][115]["GRABAR_ADIC_MAX_PROG_MED"] == 1)) {
                                echo "<a href=\"#\" onclick=\"javascript:actualizaradicionalesActoMedico();\"><img src=\"../../../../medifacil_front/imagen/btn/b_grabar__on.gif\" alt=\"Grabar\"></a>";
                            }
                            ?>
                            <!--<a href="#" onclick="javascript:actualizaradicionalesActoMedico();"><img src='../../../../medifacil_front/imagen/btn/b_grabar__on.gif' alt="Grabar"></a>-->
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="width:100%;height: 30%">
            <div class="titleform">
                <h6>PACIENTES PROGRAMADOS</h6>
            </div>
            <div>
                <div id="Div_pacientesprogramados" style="height:90%;">

                </div>
            </div>
        </div>
        <div style="height:2%"></div>
        <div id="Div_Generalpacientesadicionales" style="width:100%;height:23%"><!--Div_Generalpacientesadicionales x averiguar su funcion ya q no se esta utilizando-->
            <div class="titleform">
                <h6>PACIENTES ADICIONALES</h6>
            </div>
            <div id="Div_pacientesadicionales" style="height:90%">
                <?php echo $o_ActionActoMedico->mostrarPacientesAdicionales(''); ?>
            </div>
        </div>
        <div style="display: block">
            <pre>

        <font color="red" style="font-size: 12px">
            Los pacientes con estado POR REGULARIZAR no ser&aacute;n considerados en la liquidaci&oacute;n de m&eacute;dicos.
            Las historias cl&iacute;nicas de los pacientes con estado POR REGULARIZAR, ser&aacute;n revisados por Auditor&iacute;a M&eacute;dica.
        </font>
            </pre>
        </div>
    </div>
    <div id="Div_GeneralActoMedicoHC" style="width:100%;display:none ;">

        <?php //require_once ('vistaAtencionMedicaHC.php') ?>
    </div>

</div>
