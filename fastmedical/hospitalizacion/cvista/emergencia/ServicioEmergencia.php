<?php
require_once("../../../pholivo/Calendario.php");
require_once("../../../pholivo/Html.php");

$idAccion = "5"; //Se envia 5 para que muestre el mes actual 
$tsFechaActual = strtotime(date("Y-m-d")); //Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.
$o_Cal01 = new Calendario('cal03', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaEmergencia', 'accionCalendarioCitasInformesEmergencia', '1');
?>

<input value="" id="hFechaSeleccionada" type="txt" hidden="false" />
<input type="hidden" id="hOpcionSede" name="hOpcionSede" value="0000000001" />
<input type="hidden" id="cb_filtroSede" name="cb_filtroSede" value="0000000001" />
<input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />
<input type="hidden" id="hServicio" name="hServicio" />
<input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />
<input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
<input type="hidden" id="hFechasAProgramar" name="hFechasAProgramar" size="60"/>
<input type="hidden" id="hOpcionSede" name="hOpcionSede" value="0000000001" />
<input type="hidden" id="hFecha" name="hFecha"  />
<input value="" id="hfechaSelecionada" type="txt" hidden="false" />
<input value="hNombrePaciente" id="hNombrePaciente" type="txt" hidden="false" />
<input value="hApelledoPaterno" id="hApelledoPaterno" type="txt" hidden="false" />
<input value="hApelledoMaterno" id="hApelledoMaterno" type="txt" hidden="false" />
<input value="hCodigoCentroCosto" id="hCodigoCentroCosto" type="txt" hidden="false" />
<input value="hCodigoDoctorPersona" id="hCodigoDoctorPersona" type="txt" hidden="false" />


<fieldset  style="margin:auto;width:auto;height:auto; "> 
    <legend align="center">&nbsp;<h1> EMERGENCIA</h1> &nbsp;</legend>
    <table border ="1">
<!--        <tr>
            <td>
                SEDE:  <select name="cboSucursal" id="cboSucursal" style="width: 120px;" onchange="cargarCboMedico()">
                    <option value="">Seleccionar</option>
                    <//?php foreach ($comboSucursal as $i => $value) { ?>
                        <option value="<//?php echo $value[0]; ?>"><?php echo $value[14]; ?></option>
                    <//?//php } ?>
                </select>
            </td>
        </tr>-->
        <tr >
            <td valign="top">
                <table >
                    <tr>
                        <td>
                            <fieldset style="margin:5px;padding:10px;height:90%;">
                                <!--Acá están los hidden para las búsquedas-->
                            <!--    <input type="hidden" id="hFecha" name="hFecha" value="//<//?php echo $fechaActuaTimeStamp ?>"/>
                                <input type="hidden" id="hOpcionSede" name="hOpcionSede" value="" />
                                <input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
                                <input type="hidden" id="hOpcionActividad" name="hOpcionActividad" value="1" />
                                <input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />-->

                                <div id="divBusCronograma" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                                    <?php
                                    $calendario = $o_Cal01->getHTMLFullCalendario();
                                    echo $calendario;
                                    ?>
                                </div>
                            </fieldset><br>
                        </td> 
                    </tr>
                    <tr>
                        <td>
                            <fieldset align="center" style="margin:5px;padding:10px;height:90%;"> 
                                <table align="center" border="0" >
                                    <tr>
                                        
                                        <td colspan="3">
                                             Ape. Pat Paciente:
                                            
                                        </td>
                                         <td></td>
                                         <td></td>
                                         <td align="right">
                                            <input name="txtPaterno" type="text" id="txtPaterno" value="" style="text-transform: uppercase;" size="17"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="3" >
                                            Ape. Mat Paciente:
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td align="right">
                                            <input name="txtMaterno" type="text" id="txtMaterno" value="" style="text-transform: uppercase;" size="17"/>
                                        </td>
                                    </tr>
                                    <tr>
                                         
                                        <td colspan="3">
                                            Nombre Paciente: 
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td align="right">
                                            <input name="txtNombre" type="text" id="txtNombre" value="" style="text-transform: uppercase;" size="17" />
                                        </td>
                                        
                                    </tr>

                                    <tr  align="center">
                                        <td><font color='#FFFFFF'  >------------------------ </font></td>
                                             <td></td>
                                          <td></td>
                                       <td   align="center" colspan="4" >
                                            <a href="javascript:BusquedaPersonaPaciente();">
                                                <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/b_buscar_on.gif"/></a>                                                                               
                                            <a href="javascript:LimpiarPersonaPaciente();">
                                                <img border="0" title="Buscar" alt="" src="../../../../medifacil_front/imagen/btn/btn_limpiar.gif"/></a>
                                        </td> 
                                     

                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <fieldset style="margin:5px;padding:5px;height:90%;">
                    <div id="divServiciosEmergencia">

                    </div>
                </fieldset>
            </td>
        </tr>
    </table>
</fieldset >

<!-- <fieldset  style="margin:auto;width:40%;height:40%; "> -->
<!--                    <legend>&nbsp; Reporte Regularizacion &nbsp;</legend>-->
<!--<select id="cboSucursal"  name="cboSucursal" style="width: 120px;">


<div id="divMostrarDato">
    
</div>-->