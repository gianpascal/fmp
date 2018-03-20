<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. hidden
*/

if((trim($datos["filaTurno"])+1)<10) {
    $fechaprogramar='0'.(trim($datos["filaTurno"])+1).'/'.$datos["nomMes"].'/'.$datos["anio"];
}else {
    $fechaprogramar=(trim($datos["filaTurno"])+1).'/'.$datos["nomMes"].'/'.$datos["anio"];
}

?>

<input type="hidden" id="hidPreProgramacion" name="hidPreProgramacion" value="<?php echo trim($datos["codigoPreProgramacion"]) ?>"/>
<input type="hidden" id="hiCodTurnoAreaSedeAntuguo" name="hiCodTurnoAreaSedeAntuguo" value="<?php echo trim($datos["iCodTurnoAreaSede"]) ?>"/>
<input type="hidden" id="hnInicioTurno" name="hnInicioTurno" value=""/>
<input type="hidden" id="hnfinTurno" name="hnfinTurno" value=""/>
<input type="hidden" id="hiCodigoSedeAreaTurno" name="hiCodigoSedeAreaTurno" value=""/>
<input type="hidden" id="hnumeroFechaMes" name="hnumeroFechaMes" value="<?php echo trim($datos["filaTurno"])+1 ?>"/>
<input type="hidden" id="hAnio" name="hAnio" value="<?php echo $datos["anio"] ?>"/>
<input type="hidden" id="hnomMes" name="hnomMes" value="<?php echo $datos["nomMes"] ?>"/>
<input type="hidden" id="hiCodigoEmpleado" name="hiCodigoEmpleado" value="<?php echo trim($datos["iCodigoEmpleado"]) ?>"/>

<input type="hidden" id="hfilaArea" name="hAnio" value="<?php echo $datos["filaArea"] ?>"/>
<input type="hidden" id="hfilaEmpleado" name="hnomMes" value="<?php echo $datos["filaEmpleado"] ?>"/>
<input type="hidden" id="hfilaTurno" name="hiCodigoEmpleado" value="<?php echo $datos["filaTurno"] ?>"/>
<input type="hidden" id="hnNumeroProgramacionesXmes" name="hnNumeroProgramacionesXmes" value="<?php echo $datos["nNumeroProgramacionesXmes"] ?>"/>
<input type="hidden" id="hPuestoEmpleado" name="hPuestoEmpleado" value="<?php echo $datos["puestoEmpleado"] ?>"/>

<input type="hidden" id="hiProgramacionPersonal" name="hiProgramacionPersonal" value="<?php echo $datos["iCodProgramacionEmpleado"] ?>"/>
<div align="center">
    <fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
        <table cellspacing=0 cellpadding=0 style="border-collapse:collapse;">
            <tr>
                <td>
                    <font size="2" color="blue" style="width:90;font:10pt;font:bold;color:#0000FF"> <?php echo $datos["areaSede"] ?> </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font color="red" size="2"> <?php echo  $datos["nombreEmpleado"] ?></font>
                </td>
            </tr>
            <tr>
                <td  >
                    <font color="blue" size="2"  FACE="arial"><b> <?php echo  $datos["descripcionTurno"] ?></b></font> ---
                    <font color="blue" size="2"> <b> <?php echo $datos["descripcionTurnoRango"] ?> </b> </font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font  size="2"> <b>  Fecha: </b> </font> &nbsp;&nbsp;  <font color="blue" size="2"> <b> <?php echo  $fechaprogramar ?> </b> </font>

                </td>
            </tr>
            <tr>
                <td>
                    <select name="cboTurnoArea" id="cboTurnoArea" onchange="descripcionTurno()">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($arrayListaTurnos as $k => $value) {?>
                        <option value="<?php echo $value[0]."/".$value[3]."/".$value[4]."/".$value[5]  ?>" > <?php echo $value[2] ?> </option>
                            <?php   } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="txtTurno" type="txt" value="" disabled  size="1"
                           style=" background-color: white; font: bold; font-style: normal; font-weight: bolder; color: red;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <a href="javascript:modificarTurnoProgramadoIndividuar();"> <img border="0" title="Modificar" alt="" src="../../../../medifacil_front/imagen/btn/b_actualizar_on.gif"/></a>
                            </td>
                            <td>
                                <a href="javascript:EliminarTurnoProgramadoIndividuar();"> <img border="0" title="Eliminar" alt="" src="../../../../medifacil_front/imagen/btn/EliminarProgramacion.gif"/></a>

                            </td>
                            <td>
                                <a href="javascript:programacionPorDiaSinTurno(<?php echo $datos["filaArea"] ?>,<?php echo $datos["filaEmpleado"] ?>,<?php echo $datos["filaTurno"] ?>);"> <img border="0" title="Otro Turno" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_nuevo.gif"/></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="divErrorCruceHorarioUnSoloTurnoModificar">

                    </div>
                </td>
            </tr>
        </table>
    </fieldset>
</div>
