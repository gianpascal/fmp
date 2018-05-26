<?php
require_once("../../ccontrol/control/ActionCita.php");
require_once("../../ccontrol/control/ActionCronograma.php");
require_once("../../../pholivo/Calendario.php");
require_once("../../../pholivo/Html.php");
require_once("../../ccontrol/control/ActionPersona.php");

$o_ActionPersona = new ActionPersona();
$o_actionCita = new ActionCita();
$actionCronograma = new ActionCronograma();
//$actionCronograma-> getArbolServiciosProgramados();
$fechaActuaTimeStamp = date("Y-m-d"); //Me da la fecha actual
$parametros["opcionBusqueda"] = 1; //Porque la opción de búsqueda es por fecha
$parametros["opcionFiltro"] = 1; //Esto falta asignar
$parametros["fecha"] = $fechaActuaTimeStamp; //La fecha actual
$parametros["patron"] = 1; //Esto falta asignar
$idAccion = "5"; //Se envia 5 para que muestre el mes actual
$tsFechaActual = strtotime(date("Y-m-d")); //Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.
$o_Cal01 = new Calendario('cal01', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, 'seleccionarFechaCitasInformes', 'accionCalendarioCitasInformes', '1');
if (isset($_SESSION["permiso_formulario_servicio"][325]["PAGAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][325]["PAGAR_CITA"] == 1)) {
    $permisoPagar = 1;
} else {
    $permisoPagar = 0;
}
//$permisoPagar=$_SESSION[];
//$_SESSION["permiso_formulario_servicio"]=1;
//**** COMBO FILTRO ****//
$cb_combo_sede = $o_actionCita->listaDatosSede($datos);
?>
<style type="text/css">
    <!--
    /*Modificado*/
    .Estilo6{width:120px;height:18px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo6_ReservaCita{width:140px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7{width:300px;height:15px;font-size: 14px; font-weight: bold;font-family: Arial;}
    .Estilo7_ReservaCita{width:300px;height:20px;font-size: 14px; font-weight: bold;font-family: Arial;}
    /*arriba 20*/
    .Estilo8{width:230px;height:40px;font-size: 14px; font-weight: bold;font-family: Arial;}
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

<div id="div_principal" style="width:100%;height: 100% ; float:left">

    <div id="divcronogramacitas" style="width:1220px;  height: 100%;display:block ; float:left">

        <!-- Altura: 680px-->
        <div id="divBusquedas"style="float:left;width:300px;text-align: center">
            <div style="width:300px;height:24px;background: white;text-align: center">
                <div style="width:95%;height:100%;vertical-align: middle;text-align: center">
                    <?php echo html_entity_decode($cb_combo_sede); ?>
                </div>
            </div>
            <div style="width:100%;height:165px; ">
                <fieldset style="margin:5px;padding:5px;height:150px;">
                    <!--Acá están los hidden para las búsquedas-->
                    <input type="hidden" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
                    <input type="hidden" id="hOpcionSede" name="hOpcionSede" value="" />
                    <input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
                    <input type="hidden" id="hOpcionActividad" name="hOpcionActividad" value="1" />
                    <input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />
                    <input type="hidden" id="hPermisoPagar" name="hPermisoPagar" value="<?php echo $permisoPagar; ?>" />

                    <div id="divBusCronograma" style="width:100%;height:150px;margin-left:1%;margin-right:1%;overflow: hidden;  float:left">
                        <?php
                        $calendario = $o_Cal01->getHTMLFullCalendario();
                        echo $calendario;
                        ?>
                    </div>
                </fieldset>
            </div>
            <div id="div_busquedaServicio" align="center" style="width:100%;height:170px;background: white ; float:left">
                <input type="hidden" id="hServicio" name="hServicio" />
                <input type="hidden" id="hNombreCentroCosto" name="hNombreCentroCosto" />
                <table>
                    <tr>
                        <td>Búsqueda</td>
                        <td><input id="txtbusquedaTablaServiciosProgramados" type="text" onkeyup='busquedaServicioProgramadoCitas()' value="" name="txtbusquedaTablaServiciosProgramados"
                                   onkeypress="if (event.keyCode == 13){saltarTablaEspecialidades();}"
                                   /></td>
                    </tr>
                </table>
                <div  id ="divBusCronogramaArbol" style="background: white ;width:97%;height:150px;;margin-left:1%;margin-right:1%;overflow: hidden ; float:left">

                </div>

            </div>

            <div id="div_CronogramaMedicoPrincipal" style="width:100%;height:260px;;background: white ; float:left">
                <input type="hidden" id="hCodigoPersonalSalud" name="hCodigoPersonalSalud" />
                <div id ="divBusCronogramaMedico" style="width:97%;height:320px;margin-left:1%;margin-right:1%;overflow: hidden ; float:left; " >
                    <fieldset style="margin:5px;padding:5px;height:200px;" id="fielBusCronogramaMedico">
                        <legend style="text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:17px;font-weight:bold;">Buscar M&eacute;dico</legend>
                        <?php
                        $o_ActionPersona->buscadorMedico('clickCargaMedico');
                        ?>
                    </fieldset>
                </div>
            </div>

        </div>
        <!--    Segunda Columna-->
        <div id="div_PrincipalProgramacion" style="float:left; width:920px;">
            <table style="border:0px; " >
                <!--inicio encabezado-->
                <tr style="height:70px;">                    
                    <td>
                        
                        <input type="hidden" id="hCodigoProgramacion" name="hCodigoProgramacion" value="" />
                        <input type="hidden" id="hEstadoAtencion" name="hEstadoAtencion" value="" />
                        <input type="hidden" id="hHoraProgramacion" name="hHoraProgramacion" value="" />
                        <input type="hidden" id="hTipoCita" name="hTipoCita" value="" />
                        
                        <div id="divEspecialidadoMedico" style="float:left;width:100%;font-family: Arial;font-size: 14pt;background: white;">

                        </div> 
                        <div id="divDatosMedicoInformes" align="center" style="float:right;width:100%;background: white;float:left; display: none">

                        </div> 
                        <!--width:350px-->
                        <div id="divLeyendaCitasInformes" style="width:470px;font-family: Arial;font-size: 18pt;background: white;float:left;">
                            <table>
                                <tr>
                                    <td><img alt="" src='../../../../fastmedical_front/imagen/icono/apply.png'></td>
                                    <td class="Estilo6">C. NUEVA</td>
                                    <td class="Estilo6" style="background-color:#F0F43A" align="center">RESERVADO</td>
                                    <td class="Estilo6" style="background-color:#F8A83E" align="center">PAGADO</td>
                                    <td class="Estilo6" style="background-color:#DEEDF8" align="center">ATENDIDO</td>

                                    <td class="Estilo6" style="background-color:#FFB2B2" align="center">BLOQUEADO</td>
                                </tr>
                            </table>
                        </div> 

                        <div id="Div_Actividades" style="width:300px;font-family: Arial;font-size: 18pt;background: white;display: block; float:right;">
                            <table>
                                <tr align="center">
                                    <td class="Estilo6"><input onchange="javascript:recargarTablaServicios()" type="radio" name="rbtnactividad" value="0001" checked>C. Externa</input></td>
                                    <td>&nbsp;</td>
                                    <td class="Estilo6"><input onchange="javascript:recargarTablaServicios()" type="radio" name="rbtnactividad" value="0006" >Imagenes</input></td>
                                    <td>&nbsp;</td>
                                    <td class="Estilo6"><input onchange="javascript:recargarTablaServicios()" type="radio" name="rbtnactividad" value="0003" >Emergencia</input></td>
                                </tr>
                            </table>                                    
                        </div>


                    </td>
                </tr>
                <!--fin encabezado-->
                <tr style="">
                    <td>
                        <div id="CronogramaCompleto" style="display:block;" >
                            <div id="botoneraAngel" style="display:none">
                                <div id="botones" > 
                                     <ul id="tabs">
                                        <li>
                                            <div id="btnvista1" style="display:none"><a href="#" onclick="$('btnvista1').hide();$('btnVista2').show();ocultarVistas(1);">VISTA I</a></div>
                                        </li>
                                        <li>
                                            <div id="btnVista2"><a href="#"  onclick="$('btnvista1').show();$('btnVista2').hide();ocultarVistas(2);">VISTA II</a></div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <BR><BR>
                            <table >
                                <tr style="">
                                    <td>
                                        <div id="programacioncitas" align="center" style="width:98%;height:600px;background: url(../../../../fastmedical_front/imagen/fondo/medicos.jpg) no-repeat center ;"><!--<a href="#" onclick = javascript:setCabeceraCronograma();>LUIS</a><?php //echo html_entity_decode($tablita);                                                                                                                                                                                                                                    ?>-->

                                        </div>
                                        <div id="programacioncitasEmergencia" align="center" style="display:none;width:98%;height:500px;"><!--<a href="#" onclick = javascript:setCabeceraCronograma();>LUIS</a><?php //echo html_entity_decode($tablita);                                                                                                                                                                                                                                    ?>-->
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <div style="width:100%;height:120px;background: white">
                                            <div id="Div_edicioncita" style="height:25px; display:none">
                                                <table width="100%">
                                                    <tr align="center">
                                                        <td style="width: 15%;"><input type="hidden" id="hidfilaorigen" name="hidfilaorigen" value="" /><input type="hidden" id="hidcolumnaorigen" name="hidcolumnaorigen" value="" /></td>
                                                        <td style="width: 45%;height: 15px;font-family: Arial;font-size: 12pt"><font color="blue">Elegir celda de destino</font></td>
                                                        <td align="left" style="width: 25%;height: 15px;font-family: Arial;font-size: 12pt"><a href="javascript:cancelaredicioncitas();"><img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"></a></td>
                                                        <td style="width: 15%;"><input type="hidden" id="hidfiladestino" name="hidfiladestino" value="" /><input type="hidden" id="hidcolumnadestino" name="hidcolumnadestino" value="" /></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--                    Cabecera 1-->
                                            <div style="width:100%;height:auto">
                                                <div style="width: 100%;height: 18px;">
                                                    <table style="width:100%;height: 100%">
                                                        <tr style="width:100%;height: 100%;font-family: Arial;">
                                                            <td style="width: 22%;font-size: 13pt"><font color="RED">

                                                                <div id="divNumeroOrdenGenerada1" align="left"></div> 

                                                                </font>
                                                            </td>

                                                            <td style="width: 22%;">

<!--                                        <div id="divNumeroOrdenGenerada1a" align="left">dfgfg <a href=\"javascript:ventanaVerDetalleOrden();\"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a>
                                        </div> -->
                                                                <div id="divSandy" align="left"  style="width:100%;height:20px;background: white;display: none" >
                                                                    <?php
                                                                    echo"<a href=\"javascript:ventanaVerDetalleOrden();\"><img height='18px' width='110px' src=\"../../../../fastmedical_front/imagen/icono/detallecita3.png\"></a>";
//                                   
                                                                    ?>
                                                                </div> 

                                                            </td>



                                                            <td style="width: 22%;font-size: 12pt"><font color="BLACK">
                                                                <div id="divAfiliacion" style="font-weight: bold;color: black" align="center">

                                                                </div>
                                                                </font>
                                                            </td>
                                                            <td style="width: 22%;font-size: 13pt"><font color="BLUE">
                                                                <div id="divCodigoPersona" align="left">

                                                                </div>     
                                                                </font>    
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>


                                            </div>


                                            <div style="width:100%;height:45px">

                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div id="divDescripcionCita" style="width: 100%;height:45px;" class="Estilo7">
                                                                <table width="100%" align="center" border="0">
                                                                    <tr>
                                                                        <td width="33%" align="center" class="Estilo7">Persona&nbsp;: -----</td>
                                                                        <td width="33%" align="center" class="Estilo7">Médico&nbsp;: -----</td>
                                                                        <td width="33%" align="center" class="Estilo7">Especialidad&nbsp;: -----</td>
                                                                    </tr>
                                                                </table>
                                                                <table width="100%" align="center" border="0">
                                                                    <tr>
                                                                        <td width="30%" align="center" class="Estilo7">Fecha&nbsp;: -----</td>
                                                                        <td width="40%" align="center" class="Estilo7">Ambiente&nbsp;: -----</td>
                                                                        <td width="30%" align="center" class="Estilo7">Hora&nbsp;: -----</td>
                                                                    </tr>
                                                                </table>
                                                                <table width="100%" align="center" border="0">
                                                                    <tr>
                                                                        <td width="33%" align="center">Tipo de Servicio: -----</td>
                                                                        <td width="33%" align="center" >Localización: -----</td>
                                                                        <td width="33%" align="center" >Usuario: -----</td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div style="clear: both;height: 1px"></div>
                                                        </td>

                                                    </tr>
                                                </table>

                                            </div>

                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="divAcciones" align="center"  style="width:100%;height:30px;background: white;display: block" >
                                            <?php
                                            if ($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"] == 1)
                                                echo"<a href=\"javascript:ventanaVerAtenciones();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_mostrar_atenciones.png \"></a>";
                                            ?>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="divAccionesyBotones" align="center"  style="width:100%;height:30px;background: white;display: none">

                                            <!--                    <div id="divSandy" align="left"  style="width:100%;height:15px;background: white;display: block" >
                                            <?php
                                            echo"<a href=\"javascript:ventanaVerDetalleOrden();\"><img src=\"../../../../fastmedical_front/imagen/icono/abrir.png\"></a>";
                                            ?>
                                                                </div> -->

                                            <!--                    <div title="Proxima Fecha Disponible Programada para Cita" onmouseout="this.style.background='#1B843C';" onmouseover="this.style.background='#006631'" onclick="buscarProximaCita();" style="border: 1px solid; width:80px; height: 18px; background: none repeat scroll 0% 0% rgb(27, 132, 60); color: white; padding-top: 2px;float:left;">
                                                                    <center>Siguiente Cupo</center>
                                                                </div>-->
                                            <a href="javascript:buscarProximaCita();"><img id="btnProximaCIta" src="../../../../fastmedical_front/imagen/icono/sigcupo.png" style="height:25px"></a>

                                            <?php //echo"<a href=\"javascript:editarCitaInformes()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_editar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
                                            <?php //echo"<a href=\"javascript:myajax.Link('../admision/registro_personas_busqueda.php','Contenido')\"><img src=\"../../../../fastmedical_front/imagen/btn/b_agregar_on1.gif\"></a>";?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["IMPRIMIR_TICKET_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["IMPRIMIR_TICKET_CITA"] == 1))
                                                echo"<a href=\"javascript:imprimirTicketCita();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_imprimir_on.gif\"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["MOSTRAR_ATEN_PAC"] == 1))
                                                echo"<a href=\"javascript:ventanaVerAtenciones();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_mostrar_atenciones.png \"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["PAGAR_CITA_CARTA_VIRTUAL_PAC"] == 1))
                                                echo"<a href=\"javascript:cambiarEstadoConfirmacionCita();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_pago_cvirtual.png\"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["EDITAR_CITA"] == 1))
                                                echo"<a name='btnEditarCita' href=\"javascript:validaredicionCitaInformes('0');\"><img src=\"../../../../fastmedical_front/imagen/btn/b_editar_on.gif\"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA"] == 1))
                                                echo"<a href=\"javascript:eliminarCitaInformes();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif\"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["ASIGNAR_TRIAJE"]) && ($_SESSION["permiso_formulario_servicio"][118]["ASIGNAR_TRIAJE"] == 1))
                                                echo"<a href=\"javascript:mostrarFormRegistrarTriaje();\"><img src=\"../../../../fastmedical_front/imagen/btn/b_triaje.png\"></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"]) && ($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"] == 1))
                                                echo"<a href=\"javascript:CambiarEstadoNoAtendido();\"><img src='../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif' title='Cambiar Estado' alt=''/></a>";
                                            ?>

                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][325]["PAGAR_CITA"]) && ($_SESSION["permiso_formulario_servicio"][325]["PAGAR_CITA"] == 1))
                                                echo"<a href=\"javascript:pagarCita();\"><img src='../../../../fastmedical_front/imagen/btn/cancelarPago.gif' title='Pagar Cita' alt=''/></a>";
                                            ?>
                                                 <a href="javascript:nuevacitaEmergenecia();"><img id="btnNuevoEmergencia" style="display:none" src='../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif' title='Nueva Cita de Emergencia ' alt=''/></a>
                                        </div>


                                    </td>
                                </tr>

                            </table>



                        </div> 
                        <!--fin del div CronogramaCompleto-->


                    </td>
                </tr>

            </table>

        </div>

    </div>

    <div id="ReservaciondeCita" style="width: 80%;height: 100%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:none">

        <div>
            <div id="encabezadoMedicoEspecialidad" style="display:block">
                <div style="width:100%;height:5%;background: white">
                    <div class="titleform">
                        <h1>PROGRAMACIÓN&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;CITAS</h1>
                    </div>
                </div>
                <div style="width:100%;height:4%">
                    <div id="divEspecialidadoMedico2" style="float:left;width:100%;height:auto;font-family: Arial;font-size: 14pt;background: white;">

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="hcodigocronograma" name="hcodigocronograma" value="" />
        <div style="width: 100%;height: 90%">
            <div style="width: 100%;height: auto">
                <div style="width: 45%;height:auto;background-color: #FFFFF0;float: left">
                    <div id="busqueda" style="width: 100%;height: auto;background-color: #FFFFF0">
                        <?php
                        $arrayParametros['funcion'] = "clickonFilaPersonaEncontrada";
                        $arrayParametros['alto'] = '110px';
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
                    <div>&nbsp;</div>
                    <div id="divActosMedicos" style="height: 20%;display: block; overflow: auto">
                    </div>
                    <div style ="width: 100%;position: relative;height: auto" align="left">
                        <table>
                            <tr>
                                <td class="Estilo6_ReservaCita">Tipo de Servicio</td>
                                <td class="Estilo6_ReservaCita">
                                       <input type="radio" name="grupotipocita" onclick="ocultaProcedimientos();
                                        getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);" id="rbtnconsulta" value="0001" checked/>Consultorio
                                                                       <td class="Estilo6_ReservaCita"><input type="radio" name="grupotipocita" onclick="getPrecioServicios();
                                    getVinculadosTratamientoPaciente(document.getElementById('txtcodigoPersona').value);" id="rbtnprocedimiento" value="0002" />Procedimiento
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div id="divResultadoPrecioServicios" style="display:none;height: auto">
                    </div>

                    <!--Inicio agregado 25 Enero 2012 -->
                    <input id="hid_Recetas_Procedimientos_Tratamiento" value="" type="hidden"/>
                    <input id="hid_Recetas" value="" type="hidden"/>

                    <div id="divRecetas_Procedimientos_prueba" style="display:visible;height:112px; overflow: auto;">
                        <br>

                    </div>

                    <!--Fin agregado 25 Enero 2012 -->
                </div>
                <div style="width: 55%;height:auto;background-color: #FFFFF0;float: right">
                    <div style="width: 2%;height: 85%;background-color: #FFFFF0;float: left">
                        &nbsp;
                    </div>
                    <div style="width: 93%;height: auto;background-color: #FFFFF0;float: right;">
                        <fieldset style="margin:5px;padding:5px;border-color: #000000">
                            <div style="width: 100%;height: auto;background-color: #FFFFF0">
                                <div id="divCronogramaCitasInformes" style="height:auto" align="left">

                                </div>

                                <div id="divDatosPersonaCitasInformes" style="height:auto" align="left">

                                    <input id="hiCodigoPersona" name ="hiCodigoPersona" value="" type="hidden"/>
                                    <input id="hiCodigoPaciente" type="hidden"/>
                                </div>

                            </div>
                            <input id="htipoProgramacion" type="hidden"/>

                            <div id="divProgramacionCitasInformes" style ="position: relative;height: auto" align="left">
                                <input id="hcHoraProgramada" type="hidden" value="">
                                <br/>
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
                                <fieldset style="width:95%;height:auto;margin:5px;padding:5px;border:none">
                                    <table>
                                        <tr><td class="Estilo6_ReservaCita">Precio</td><td></td></tr>
                                    </table>
                                </fieldset>
                            </div>
                            <input type="hidden" id="hcCodigoServicioProducto" name="hcCodigoServicioProducto" value="" />

                            <input type="hidden" id="hcCodigoActoMedico" name="hcCodigoActoMedico" value="SAM" />

                        </fieldset>
                    </div>
                    <div style="width:100%;height: auto">
                        <div id="divNumeroOrdenGenerada2" style="width: 100%;height: auto;font-family: Arial;font-size: 16pt;background: white;">
                            <div><font color="RED">Nro. Orden : </font></div></div>
                        <br/>
                        <div id="divGuardaryRegresar" align="center"  style="width:100%;height:auto;background: white;display: block">
                            <?php
                            if ($_SESSION["permiso_formulario_servicio"][118]["GRABAR_CITA"] == 1)
//                                echo"<a href=\"javascript:validarCitaInformes()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo"<a href=\"javascript:validarCitaInformes()\"><img src=\"../../../../fastmedical_front/imagen/btn/grabarcita.PNG\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";
                            ?>
                            <?php
                            if ($_SESSION["permiso_formulario_servicio"][118]["REGRESAR_CITA"] == 1)
//                                echo"<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_regresar_on.gif\">";
                                echo"<a href=\"javascript:regresaracronogramacitas()\"><img src=\"../../../../fastmedical_front/imagen/btn/regresar.PNG\">";
                            ?>

                        </div>
                    </div>
                    <!--                    <div>
                    <?php
                    //echo"<a href=\"javascript:PopudVincularRecetasConTratamientos();\"><img src=\"../../../../fastmedical_front/imagen/btn/regresar.PNG\">";
//                        echo"<a href=\"javascript:getVinculadosTratamientoPaciente('0469643');\"><img src=\"../../../../fastmedical_front/imagen/btn/regresar.PNG\">";
                    ?>
                                        </div>-->

                </div>
            </div>



        </div>
    </div>
</div>
<input type="hidden" id="buscarOtro" value="0">
<input type="hidden" id="fechaDes" value="0">
<input type="hidden" id="numerito" value="0">
<input type="hidden" id="fechaEncontrada" value="0">

<input type="hidden" id="FechaActual" value ="<?php echo $fechaActuaTimeStamp; ?>">

