<?php
require_once("../../../pholivo/Calendario.php");
require_once("../../ccontrol/control/ActionPersona.php");
require_once("../../ccontrol/control/ActionCita.php");
require_once("../../ccontrol/control/ActionUsuario.php");
$o_ActionPersona = new ActionPersona();
$o_actionCita = new ActionCita();
$fechaActuaTimeStamp = date("Y-m-d"); //Me da la fecha actual
$idAccion = "5"; //Se envia 5 para que muestre el mes actual
$tsFechaActual = strtotime(date("Y-m-d")); //Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.
$o_Cal01 = new Calendario('cal01', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaCitasInformes', 'accionCalendarioCitasInformes', '1');

if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA"] == 1)) {

    $permisoPagar = 1;
} else {
    $permisoPagar = 0;
}
$cb_combo_sede = $o_actionCita->listaDatosSedeSolo($datos);

$o_LUsuario = new LUsuario();
$comboActividad = $o_LUsuario->comboActividad();
$arrayActividadPersona = $o_LUsuario->LlistaExisteActividad($_SESSION['id_persona']);
$actividadPersona = trim($arrayActividadPersona[0][1]);
$vistaDefecto = '';
switch ($actividadPersona) {
    case '0000':
        $vistaDefecto = 'matriz';
        break;
    case '0001':
        $vistaDefecto = 'matriz';
        break;
    case '0002':
        $vistaDefecto = 'matriz';
        break;
    case '0003':
        $vistaDefecto = 'detalle';
        break;
    case '0004':
        $vistaDefecto = 'matriz';
        break;
    case '0005':
        $vistaDefecto = 'matriz';
        break;
    case '0006':
        $vistaDefecto = 'detalle';
        break;
    default:
        $vistaDefecto = 'matriz';
        break;
}
?>
<style type="text/css">
    <!--
    /*Modificado*/
    .Estilo6{width:60px;height:18px;font-size: 12px; font-weight: bold;font-family: Arial;}
    .Estilo6_ReservaCita{width:110px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7{width:300px;height:15px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7_ReservaCita{width:300px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    /*arriba 20*/
    .Estilo8{width:230px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo9{text-decoration: underline;font-weight: bold;font-family: Arial;font-size: 14px;}
    -->
    .btnAngelSayes{
        border:2px solid #BBE796;
        width: 90px;
        height:22px;
        margin:3px;
        font-family: verdana;
        font-size: 14px;
        float:left;
        padding-top: 3px;
    }
    .btnAngelSayes:hover{
        background-color: #BBE796;
        cursor:pointer;
    }
</style>
<input type="hidden" id="hCadenaiNumeroPlaca" name="hCadenaiNumeroPlaca" value="" />
<input type="hidden" id="hCadenaCodigoProgramacion" name="hCadenaCodigoProgramacion" value="" />
<input type="hidden" id="hCadenaCodigoProgramacionNombre" name="hCadenaCodigoProgramacionNombre" value="" />
<input type="hidden" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
<input type="hidden" id="hOpcionActividad" name="hOpcionActividad" value="0001" />
<input type="hidden" id="hVista" name="hOpcionActividad" value="" />
<input type="hidden" id="hCodigoPersonalSalud" name="hCodigoPersonalSalud" />
<input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
<input type="hidden" id="hServicio" name="hServicio" />
<input type="hidden" id="hNombreCentroCosto" name="hNombreCentroCosto" />
<input type="hidden" id="hOpcionSede" name="hOpcionSede" value="" />
<input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />
<input type="hidden" id="hPermisoPagar" name="hPermisoPagar" value="<?php echo $permisoPagar; ?>" />
<input type="hidden" id="hEstadoAtencion" name="hEstadoAtencion" value="" />
<input type="hidden" id="hCodigoProgramacion" name="hCodigoProgramacion" value="" />
<input type="hidden" id="FechaActual" value ="<?php echo $fechaActuaTimeStamp; ?>">
<input type="hidden" id="hHoraProgramacion" name="hHoraProgramacion" value="" />
<input type="hidden" id="hTipoCita" name="hTipoCita" value="" />
<input type="hidden" id="hcodigocronograma" name="hcodigocronograma" value="" />
<input id="hid_Recetas_Procedimientos_Tratamiento" value="" type="hidden"/>
<input id="hid_Recetas" value="" type="hidden"/>
<input id="htipoProgramacion" type="hidden"/>
<input type="hidden" id="hcCodigoServicioProducto" name="hcCodigoServicioProducto" value="" />
<input type="hidden" id="hcCodigoActoMedico" name="hcCodigoActoMedico" value="SAM" />
<input id="hColorSeleccionado" type="hidden"/>
<input id="hMododeejecucion" value="0" type="hidden"/>
<input id="buscarOtro" value="0" type="hidden">
<input id="fechaEncontrada" value="<?php echo $fechaActuaTimeStamp; ?>" type="hidden">
<div id="divcronogramacitas" style="height: <?php echo $datos['alto']; ?>px; width: <?php echo $datos['ancho']; ?>px; ">
    <div style="float:left; height: <?php echo $datos['alto']; ?>px; width: 300px; ">
        <div align="center" style="float:left; height: 25px; width: 300px;" >
            <b>Sede  :</b> 
            <?php echo html_entity_decode($cb_combo_sede); ?>
        </div>
        <fieldset style="margin:2px;padding:2px;height:160px;width: 290px;">
            <div id="divBusCronograma" style="float:left; height: 146px; width: 290px;">

                <?php
                $calendario = $o_Cal01->getHTMLFullCalendario();
                echo $calendario;
                ?>


            </div>
        </fieldset>
        <div align="center" style="float:left; height: 20px; width: 300px; ">
            Busqueda: 
            <input id="txtbusquedaTablaServiciosProgramados" type="text" onkeyup='busquedaServicioProgramadoCitas()' value="" name="txtbusquedaTablaServiciosProgramados"
                   onkeypress="if (event.keyCode == 13) {
                               saltarTablaEspecialidades();
                           }" />
        </div>
        <div id ="divBusCronogramaArbol"  style="float:left; height: 165px; width: 300px; background-color:#748512">
            medicos: 
        </div>
        <div style="float:left; height: 240px; width: 300px;">


            <fieldset style="margin:2px;padding:2px;height:236px;" id="fielBusCronogramaMedico">
                <legend style="text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:bold;">Buscar Médico</legend>
                <?php
                $o_ActionPersona->buscadorMedico('clickCargaMedico');
                ?>
            </fieldset>

        </div>


    </div>
    <div style="float:left; height: <?php echo $datos['alto']; ?>px; width: <?php echo $datos['ancho'] - 300; ?>px; ">
        <div style="float:left; height: 35px; width: <?php echo $datos['ancho'] - 300; ?>px;">
            <div id="divEspecialidadoMedico"  style="font-size: 12pt;float:left; height: 35px; width: <?php echo $datos['ancho'] - 450; ?>px; ">
            </div>
            <div id="divDatosMedicoInformes" align="center" style="width:<?php echo $datos['ancho'] - 300; ?>px;background: white;float:left; display:none; ">

            </div> 
            <div id="botoneraAngel" style="width:150px; float: left;">
                Vista
                <?php if ($vistaDefecto == 'matriz') { ?>
                    <select name="selectVista" id="selectVista">
                        <option value="1" selected='selected' >Matriz</option>
                        <option value="2">Detalle</option>
                    </select>
                <?php } else { ?>
                    <select name="selectVista" id="selectVista">
                        <option value="1" >Matriz</option>
                        <option value="2" selected='selected' >Detalle</option>
                    </select>
                <?php } ?>


            </div>
        </div> 
        <div id="divLeyendaCitasInformes" style="float:left; height: 35px; width: <?php echo $datos['ancho'] - 500; ?>px;">
            <table>
                <tr>
                    <td><img alt="" src='../../../../medifacil_front/imagen/icono/apply.png'></td>
                    <td class="Estilo6">C. NUEVA</td>
                    <td class="Estilo6" style="background-color:#F0F43A" align="center">RESERVADO</td>
                    <td class="Estilo6" style="background-color:#F8A83E" align="center">PAGADO</td>
                    <td class="Estilo6" style="background-color:#DEEDF8" align="center">ATENDIDO</td>

                    <td class="Estilo6" style="background-color:#FFB2B2" align="center">BLOQUEADO</td>
                </tr>
            </table>

        </div> 
        <div id="Div_Actividades" style="float:left; height: 35px; width: 200px; ">
            <select id="selectActividades" onchange="javascript:recargarTablaServicios();">
                <?php foreach ($comboActividad as $k => $value) { ?>
                    <option value="<?php echo $comboActividad[$k][0]; ?>"
                    <?php
                    if ($actividadPersona == $comboActividad[$k][0]) {
                        echo " selected='selected' ";
                    }
                    ?>
                            >
                        <?php echo utf8_encode($comboActividad[$k][1]); ?></option>
                <?php } ?>
            </select>
        </div> 

        <div id="CronogramaCompleto"  style="float:left; height: <?php echo $datos['alto'] - 215; ?>px; width: <?php echo $datos['ancho'] - 300; ?>px; background: url(../../../../medifacil_front/imagen/fondo/medicos.jpg) no-repeat center ;">
            <div id="programacioncitas"  style="float:left; height: <?php echo $datos['alto'] - 215; ?>px; width: <?php echo $datos['ancho'] - 300; ?>px; background: url(../../../../medifacil_front/imagen/fondo/medicos.jpg) no-repeat center ;">

            </div>  
            <div id="programacioncitasEmergencia"  style="display:none;float:left; height: <?php echo $datos['alto'] - 215; ?>px; width: <?php echo $datos['ancho'] - 300; ?>px;">
                <div id="contenedorTablaCronogramaAtenciones" style="width:<?php echo $datos['ancho'] - 300; ?>px;height:<?php echo intval(0.4 * ($datos['alto'] - 275)); ?>px;">

                </div>
                <div id="contenedorLeyendaCronograma" style="width:<?php echo $datos['ancho'] - 300; ?>px;height:25px;border:1px solid black;background-color:white;">
                </div>
                <div id="contenedorTablaCronogramaPacientes" style="width:<?php echo $datos['ancho'] - 300; ?>px;height:<?php echo intval(0.6 * (($datos['alto'] - 215))); ?>px;">

                </div>
            </div>  

        </div> 

        <div style="float:left; min-height: 150px; width: <?php echo $datos['ancho'] - 300; ?>px; ">
            <font color="BLUE">
            <div id="Div_edicioncita" style="height:25px; display:none">
                <table width="100%">
                    <tr align="center">
                        <td style="width: 15%;"><input type="hidden" id="hidfilaorigen" name="hidfilaorigen" value="" /><input type="hidden" id="hidcolumnaorigen" name="hidcolumnaorigen" value="" /></td>
                        <td style="width: 45%;height: 15px;font-family: Arial;font-size: 12pt"><font color="blue">Elegir celda de destino</font></td>
                        <td align="left" style="width: 25%;height: 15px;font-family: Arial;font-size: 12pt"><a href="javascript:cancelaredicioncitas();"><img src="../../../../medifacil_front/imagen/btn/b_cancelar_on.gif"></a></td>
                        <td style="width: 15%;"><input type="hidden" id="hidfiladestino" name="hidfiladestino" value="" /><input type="hidden" id="hidcolumnadestino" name="hidcolumnadestino" value="" /></td>
                    </tr>
                </table>
            </div>
            </font>
            <div style=" margin-top: 5px; float:left; height: 20px; width: <?php echo $datos['ancho'] - 300; ?>px; ">

                <div id="divNumeroOrdenGenerada1" align="left" style="font-size:14px; color: red; float:left; width: 230px; "></div> 
                <div id="divSandy" align="left"  style="width:130px;height:20px; float:left;display: none" >
                    <?php
                    echo"<a href=\"javascript:ventanaVerDetalleOrden();\"><img height='18px' width='110px' src=\"../../../../medifacil_front/imagen/icono/detallecita3.png\"></a>";
//                                   
                    ?>
                </div> 
                <div id="divAfiliacion" style="float:left; font-weight: bold;color: black" align="center"></div>
                <div id="divCodigoPersona" style="float:right;color:blue; font-size:14px;  " align="left"></div>     

            </div>
            <div id="divDescripcionCita" style="float:left; min-height: 60px; width: <?php echo $datos['ancho'] - 300; ?>px; ">

            </div>    
            <div id="divAcciones" align="center"  style="float:left; height: 30px; width: <?php echo $datos['ancho'] - 300; ?>px; ;display: block" >
                <?php
                if ($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"] == 1)
                    echo"<a href=\"javascript:ventanaVerAtenciones();\"><img src=\"../../../../medifacil_front/imagen/btn/b_mostrar_atenciones.png \"></a>";
                ?>
            </div>
            <div id="divAccionesyBotones" align="center"  style="float:left; height: 30px; width: <?php echo $datos['ancho'] - 300; ?>px;  display: none">
                <a href="javascript:buscarProximaCita();"><img id="btnProximaCIta" src="../../../../medifacil_front/imagen/icono/sigcupo.png" style="height:25px"></a>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["IMPRIMIR_TICKET_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["IMPRIMIR_TICKET_CITA"] == 1))
                    echo"<a href=\"javascript:imprimirTicketCita();\"><img src=\"../../../../medifacil_front/imagen/btn/b_imprimir_on.gif\"></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"] == 1))
                    echo"<a href=\"javascript:ventanaVerAtenciones();\"><img src=\"../../../../medifacil_front/imagen/btn/b_mostrar_atenciones.png \"></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"] == 1))
                    echo"<a href=\"javascript:cambiarEstadoConfirmacionCita();\"><img src=\"../../../../medifacil_front/imagen/btn/b_pago_cvirtual.png\"></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA"] == 1))
                    echo"<a name='btnEditarCita' href=\"javascript:validaredicionCitaInformes('0');\"><img src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"></a>";
                ?>
                <?php
                //if (isset($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"] == 1))
                echo"<a href=\"javascript:eliminarCitaInformes();\"><img src=\"../../../../medifacil_front/imagen/btn/b_eliminar_on.gif\"></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["ASIGNAR_TRIAJE"]) && ($_SESSION["permiso_formulario_servicio"][118]["ASIGNAR_TRIAJE"] == 1))
                    echo"<a href=\"javascript:mostrarFormRegistrarTriaje();\"><img src=\"../../../../medifacil_front/imagen/btn/b_triaje.png\"></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"]) && ($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"] == 1))
                    echo"<a href=\"javascript:CambiarEstadoNoAtendido();\"><img src='../../../../medifacil_front/imagen/btn/btn_cambiarEstado.gif' title='Cambiar Estado' alt=''/></a>";
                ?>
                <?php
                if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA"] == 1))
                    echo"<a href=\"javascript:pagarCita();\"><img src='../../../../medifacil_front/imagen/btn/cancelarPago.gif' title='Pagar Cita' alt=''/></a>";
                ?>

                <a href="javascript:nuevacitaEmergenecia();"><img id="btnNuevoEmergencia" style="display:none" src='../../../../medifacil_front/imagen/btn/b_nuevo_on.gif' title='Nueva Cita de Emergencia ' alt=''/></a>              
                <?php if ($_SESSION["permiso_formulario_servicio"][118]["ubicacionImagenes_Citas"] == 1) { ?>
                    <a href="javascript:ubicacionImagenes();"><img id="btnUbicacionImagenes"  src='../../../../medifacil_front/imagen/btn/ubicacion.png' title='ubicacion ' alt=''/></a>
                <?php } ?>
                <?php if ($_SESSION["permiso_formulario_servicio"][118]["Asignar_Medicos"] == 1) { ?>
                    <a href="javascript:pupapAsignacionMedico();"><img id="btnEvioMedico"  src='../../../../medifacil_front/imagen/btn/citas12.png' title='ubicacion ' alt=''/></a>
                <?php } ?>
                <?php if ($_SESSION["permiso_formulario_servicio"][118]["derivarMasivamente"] == 1) { ?>
                    <a href="javascript:popupDerivarMasivamente();"><img id="btnDerivarMasivamente"  src='../../../../medifacil_front/imagen/btn/derivar.png' title='derivar masivamente' alt=''/></a>
                <?php } ?>

                <?php if ($_SESSION["permiso_formulario_servicio"][118]["ANULAR_PAGO"] == 1) { ?>
                    <a href="javascript:anularPago();"><img id="btnAnularPago"  src='../../../../medifacil_front/imagen/btn/b_anular_pago.png' title='Anular comprobante' alt=''/></a>
                <?php } ?>

            </div>
        </div> 
    </div>
</div>
<div id="ReservaciondeCita" style="height: <?php echo $datos['alto']; ?>px; width: 900px; margin: 0px auto; display:none">
    <div id="encabezadoMedicoEspecialidad" style="display:block">
        <div style="width:100%;height:20px;background: white">
            <div class="titleform">
                <h1>PROGRAMACIÓN DE CITAS</h1>
            </div>
        </div>

    </div>
    <div style="width: 440px;height: 600px; float: left; ">
        <div id="divEspecialidadoMedico2" style="float:left;width:100%;height:20px;font-family: Arial;font-size: 12pt;background: white;">

        </div>
        <div id="busqueda" style="width: 100%;height: auto;background-color: #FFFFF0">
            <?php
            $arrayParametros['funcion'] = "clickonFilaPersonaEncontrada";
            $arrayParametros['alto'] = '135px';
            $arrayParametros['nroOrden'] = false;
            $arrayParametros['codigo'] = true;
            $arrayParametros['documento'] = true;
            $arrayParametros['apellidoPaterno'] = true;
            $arrayParametros['apellidoMaterno'] = true;
            $arrayParametros['nombre'] = true;
            if ($_SESSION["permiso_formulario_servicio"][118]["BUSCAR_PAC"] == 1)
                $arrayParametros['bbuscar'] = true;
            else
                $arrayParametros['bbuscar'] = false;
            if ($_SESSION["permiso_formulario_servicio"][118]["LIMPIAR_PAC"] == 1)
                $arrayParametros['blimpiar'] = true;
            else
                $arrayParametros['blimpiar'] = false;
            if ($_SESSION["permiso_formulario_servicio"][118]["NUEVO_PAC"] == 1)
                $arrayParametros['bnuevo'] = true;
            else
                $arrayParametros['bnuevo'] = false;
            $arrayParametros['editar'] = 'editar'; //editar: agrega el boton editar, otro valor no lo muestra
            $o_ActionPersona->buscadorPersona($arrayParametros);
            ?>
        </div>
        <div id="divActosMedicos" style="height:80px; width:100%; float: left; overflow: auto;display:none ">
        </div>
        <div style ="width: 100%;height:20px; float: left;" align="left">
            <table>
                <tr>
                    <td class="Estilo6_ReservaCita" style="width:140px; ">Tipo de Servicio</td>
                    <td class="Estilo6_ReservaCita" style="width:140px; ">
                        <input type="radio" name="grupotipocita" onclick="ocultaProcedimientos();
                                if (!document.getElementById('txtcodigoPersona')) {
                                    alert('Seleccione una Persona.');
                                } else {
                                    getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);
                                }
                                ;" id="rbtnconsulta" value="0001" checked/>Consultorio
                    </td>                                     
                    <td class="Estilo6_ReservaCita" style="width:140px; "><input type="radio"  name="grupotipocita" onclick="getPrecioServicios();
                            if (!document.getElementById('txtcodigoPersona')) {
                                alert('Seleccione una Persona.');
                            } else {
                                getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);
                            }
                            ;" id="rbtnprocedimiento" value="0002" />Procedimiento
                    </td>
                </tr>
            </table>
        </div>
        <div id="divRecetas_Procedimientos_prueba" style="width: 100%;float:left;height:80px; overflow: auto;">
            Resetas...

        </div>
        <div id="divResultadoPrecioServicios" style="width: 100%;float:left;height:100px; overflow: auto; display:none;" >
        </div>
    </div>
    <div style="width: 10px;height: 200px; float: left; ">
    </div>
    <div style="width: 450px;height: 510px; float: left; ">
        <div id="divCronogramaCitasInformes" style="height:auto" align="left">

        </div>
        <div id="divDatosPersonaCitasInformes" style="height:auto" align="left">

            <input id="hiCodigoPersona" name ="hiCodigoPersona" value="" type="hidden"/>
            <input id="hiCodigoPaciente" type="hidden"/>
        </div>
        <div id="divProgramacionCitasInformes" style ="position: relative;height: auto" align="left">
            <input id="hcHoraProgramada" type="hidden" value="">
            <fieldset style="margin:5px;padding:5px;border:none">
                <table>
                    <div id="divcodigoCita" style="display:none"></div>
                    <tr><td class="Estilo6_ReservaCita">Fecha de Servicio</td><td><input class="Estilo7_ReservaCita"  id="txtfechaservicio" name="txtfechaservicio" type="text" size="30" readonly="true" value="<?php echo $fechaActuaTimeStamp; ?>" /></td></tr>
                    <tr><td class="Estilo6_ReservaCita">Hora de Servicio</td><td><input class="Estilo7_ReservaCita"  id="txthoraservicio" name="txthoraservicio" type="text" size="30" readonly="true" /></td></tr>
                    <div id="divProcedimientoCita" style="display:none"></div>
                    <tr><td class="Estilo6_ReservaCita">Costo de Servicio</td><td><div id="divCostoCita" style="display:block">-----</div></td></tr>
                    <br/>
                    <tr><td class="Estilo6_ReservaCita">Observaci&oacute;n</td><td><textarea class="Estilo8" name="txtobservacioncita" rows="2" cols="30" id="txtobservacioncita"></textarea></td><td><input type="button" id="btnSelAmbiente" name="btnSelAmbiente" width="5" value="..." onclick="editarObsCita();" style="visibility:hidden;"/><td/></tr>
                </table>
            </fieldset>
        </div>
        <div id="divPrecioServicio" align="left" style ="position: relative;height: auto;display: block">
        </div>
        <div id="divNumeroOrdenGenerada2" style="width: 100%;height: auto;font-family: Arial;font-size: 16pt;background: white;">
            <div><font color="RED">Nro. Orden : </font></div>
        </div>
        <div id="divGuardaryRegresar" align="center"  style="width:100%;height:auto;background: white;display: block">
            <?php
            if ($_SESSION["permiso_formulario_servicio"][118]["GRABAR_CITA"] == 1)
                echo"<a href=\"javascript:validarCitaInformes()\"><img src=\"../../../../medifacil_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            ?>
            <?php
            if ($_SESSION["permiso_formulario_servicio"][118]["REGRESAR_CITA"] == 1)
                echo"<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../medifacil_front/imagen/btn/b_regresar_on.gif\">";
            ?>
        </div>
    </div>
</div>
