<?php
require_once("ActionCronograma.php");
$o_ActionCronograma = new ActionCronograma();
$resultado = $o_ActionCronograma->traerDatosProgramacion($datos);
?>

<div style="width:100%;height: 90%">
    <fieldset style="margin:1px;padding:1px;height:100%;">
        <legend style="text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Opciones de Edición</legend>

        <table style="width:100%;height: 100%">
            <tr><td class ="Estilo9"><input type="radio" onclick="javascript:reprogramarAfiliacionesCronogramas('<?php echo $datos["codigocronograma"]; ?>');" name="groupOpcionProgramacion" value="reprogramacion" />Cambio de Afiliaciones</td></tr>
            <?php
            
            if ($_SESSION["permiso_formulario_servicio"][119]["ACT_EDITAR_ADICIONALES_PROG_MED"] == 1) {
               
                echo "<tr><td class =\"Estilo9\"><input type=\"radio\" 
                    onclick=\"reprogramarAdicionales('" . $datos["codigocronograma"] . "')\" 
                        name=\"groupOpcionProgramacion\" value=\"consulta\" />Edicion Adicionales</td></tr>";
            }
            ?>
            <?php
            if ($_SESSION["permiso_formulario_servicio"][119]["ACT_CAMBIO_TURNO_PROG_MED"] == 1) {
                echo "<tr><td class =\"Estilo9\"><input type=\"radio\" 
                    onclick=\"javascript:seleccionarTurnoProgramacionMedico(" . $datos["codigocronograma"] . ")\" 
                        name=\"groupOpcionProgramacion\" value=\"turno\" />Cambio de Turno</td></tr>";
            }
            ?>
            <?php
            if ($_SESSION["permiso_formulario_servicio"][119]["ACT_CAMBIO_LOCALIZACION_PROG_MED"] == 1) {
                echo "<tr><td class =\"Estilo9\"><input type=\"radio\" 
                    onclick=\"javascript:consultaProgramacionMedicosJorgeNuevo('" . $datos["codigocronograma"] . "','4')\"
                        name=\"groupOpcionProgramacion\" value=\"localizacion\" />Cambio de Ambiente</td></tr>";
            }
            ?>
            <tr><td class ="Estilo9"><input type="radio" onclick="javascript:reprogramarProgramacionAndFecha('<?php echo $datos["codigocronograma"]; ?>');"  value="programable" />Modificar Estado Programable y Fecha</td></tr>


            <tr><td class ="Estilo9">
                    <div id="DivMantenimientoPRogramable" align="center" style="display:none">

                        <table width="80%" align="center">
                            <tr align="left">
                                <td class="Estilo6"></td>
                                <td>
                                    <?php
                                    if ($resultado[0][0] == 1) {
                                        $check = "checked";
                                        $fecha = $resultado[0][1];
                                        $disable = "";
                                    } else {
                                        $check = "";
                                        $fecha = "";
                                        $disable = "disabled";
                                    }
                                    ?>
                                    
                                    <table width="100%" align="center">
                                        <tr><td class="Estilo6"  >Programado</td><td><input id="chkProgramadoMantenimiento" name="chkProgramadoMantenimiento" <?php echo $check; ?> type="checkbox" onclick="activarFechaProgramacionMantenimiento(this);"/></td></tr>
                                        <tr><td class="Estilo6" >Fecha </td><td><input id="txtFechaProgramacionMantenimiento" size="10" name="txtFechaProgramacionMantenimiento" <?php echo $disable;?> value="<?php echo $fecha; ?>" type="input" onclick="calendarioHtmlx('txtFechaProgramacionMantenimiento')"/></td></tr>
                                        <tr>
                                            <td>
                                        <center><button onclicK="guardarMantenimientoPRogramado(<?php echo $datos["codigocronograma"]; ?>)">Guardar</button></center>

                                </td>
                                <td>
                            <center><button onClick="cancelarMantenimientoProgramable()">Cancelar</button></center>

                            </td>
                            </tr>
                        </table>
                </td>
            </tr>
        </table>
</div>
</td>
</tr>






<tr><td class ="Estilo9"><input type="radio" onclick="javascript:reprogramacionMedicos('<?php echo $datos["codigocronograma"]; ?>');" name="groupOpcionProgramacion" value="reprogramacion" />Cambio de Personal Médico</td></tr>
<tr><td class ="Estilo9">
        <div id="Div_RePrograma" align="center" style="display:none">

            <table width="80%" align="center">
                <tr align="left">
                    <td class="Estilo6">Observaci&oacute;n</td>
                    <td>
                        <table width="100%" align="center">
                            <tr>
                                <td align="center" width="100%" style="font-family:Arial;font-size:11pt">
                                    <textarea id="txaObsCambioPersonalMedico" name="txaObsCambioPersonalMedico" cols=30 rows=2></textarea>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <a href='#' onclick="validarAutorizacionProgramacionMedicos()">
                            <img src='../../../../medifacil_front/imagen/btn/b_vbueno_on.gif' title='Verificar Autorización' alt="Validar Autorización"/>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </td>
</tr>
</table>
</fieldset>
</div>