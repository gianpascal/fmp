<?php

require_once("../../../pholivo/Calendario.php");

$fechaActuaTimeStamp = date("Y-m-d");//Me da la fecha actual
$parametros["fecha"]=$fechaActuaTimeStamp;//La fecha actual
$idAccion = "5";//Se envia 3 para que muestre el mes siguiente
//$tsFechaActual=strtotime(date("Y-m-d"));//Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.


$tsFechaActual=strtotime($datos["cboAnio"]."-".$datos["cboMes"]."-01");
echo $datos["cboAnio"]."-0".$datos["cboMes"]."-01";
//$o_Cal01 = new Calendario('cal01','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,$idAccion,'seleccionarFechaCitasInformes','accionCalendarioCitasInformes','1');
$o_Cal01 = new Calendario('cal02','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,$idAccion,'seleccionarFechaProgramacionEmpleado','accionCalendarioProgramacionEmpleados','0','1','seleccionarFechasPorDiaEmpleado');
?>
<input type="hidden" id="hFechaSeleccionada" name="hFechaSeleccionada" value="<?php echo $fechaActuaTimeStamp ?>"/>
<input type="hidden" id="hFechasAProgramar" name="hFechasAProgramar" size="60"/>
<input type="hidden" id="hPuestoEmpleado" name="hPuestoEmpleado" value="<?php echo trim($datos["puestoEmpleado"]) ?>"/>
<input type="hidden" id="hiCodigoEmpleado" name="hiCodigoEmpleado" value="<?php echo trim($datos["iCodigoEmpleado"]) ?>"/>
<input type="hidden" id="hnInicioTurno" name="hnInicioTurno" value=""/>
<input type="hidden" id="hnfinTurno" name="hnfinTurno" value=""/>
<input type="hidden" id="hnNumeroProgramacionesXmes" name="hnNumeroProgramacionesXmes" value="<?php echo trim($datos["nNumeroProgramacionesXmes"]) ?>"/>
<input type="hidden" id="hcodigoSedeEmpresaArea" name="hcodigoSedeEmpresaArea" value="<?php echo trim($datos["codigoSedeEmpresaArea"]) ?>"/>
<input type="hidden" id="hiCodigoSedeAreaTurno" name="hiCodigoSedeAreaTurno" value=""/>
<div align="center">
<fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
    <!--Acá están los hidden para las búsquedas-->
    <input type="hidden" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
    <input type="hidden" id="hOpcionSede" name="hOpcionSede" value="0000000001" />
    <input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
    <input type="hidden" id="hOpcionActividad" name="hOpcionActividad" value="1" />
    <input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />
    <input type="hidden" id="hPreprogramacionPersonal" name="hPreprogramacionPersonal" />
    <input type="hidden" id="hTurnoAreaSede" name="hTurnoAreaSede" />
   

    <table border="1">
        <tr>
            <td>
                <div id="divCalendario" style="width:250px;height:280px;margin-left:1%;margin-right:1%;overflow: hidden;">
                    <?php
                    $calendario = $o_Cal01->getHTMLFullCalendario();
                    echo $calendario;

                    ?>
                </div>
            </td>
            <td style="width: 680px" align="center">
                <table>
                    <tr align="center" >
                        <td >
                           <b>   <font size="3" color="blue" style="width:450px;font:10pt;font:bold;color:#0000FF">
                           <?php echo $datos["nombreAreaSede"] ?> </font></b><br><br>
                        </td>
                    </tr>
                    <tr >
                        <td >
                            <b>  <font size="2">  <?php echo $datos["nombreEmpleado"] ?> </font></b><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="cboTurnoArea" id="cboTurnoArea" onchange="descripcionTurno()">
                                <option value="0/0/0/0">Seleccionar</option>
                                <?php foreach ($arrayListaTurnos as $k => $value) {?>
                                <option value="<?php echo $value[0]."/".$value[3]."/".$value[4]."/".$value[5]  ?>" > <?php echo $value[2] ?> </option>
                                    <?php   } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="txtTurno" type="txt" value="" disabled size="1"
                                   style=" background-color: white; font: bold; font-style: normal; font-weight: bolder; color: blue  "/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="javascript:guardarTurnoProgramadoGrupo();"> <img border="0" title="Turno" alt="" src="../../../../fastmedical_front/imagen/btn/b_grabar_on.gif"/></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="divMensajeCruce"></div>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>


</fieldset>

</div>
