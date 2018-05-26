<?php
require_once("../../../pholivo/Calendario.php");

$fechaActuaTimeStamp = date("Y-m-d"); //Me da la fecha actual
$parametros["fecha"] = $fechaActuaTimeStamp; //La fecha actual
$idAccion = "5"; //Se envia 5 para que muestre el mes actual
$tsFechaActual = strtotime(date("Y-m-d")); //Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.
$o_CalSOP = new Calendario('cal04', 'botonAccionCalendario', 'cabeceraCalendario', 'btnCalendario', 'estiloCasillaSeleccionada', $tsFechaActual, $idAccion, '', '', '1');
//($_nombreCalendario='',$_estiloAccion='', $_estiloCabeceraDia='',$_estiloCasilla1='',$_estiloCasilla2='',$_fechaActual='',$_idAdicionFecha='',$_funcionjsDia='',$_funcionjsCalendario='',$diapintado='',$_dibujarCheck=0,$_funcionjsCheckDia='')
//-------------------------------------------------------------------------------
$toolbar = new ToollBar("right");
$toolbar->SetBoton("Transferencia del Paciente", "Transferir Paciente", "btn", "onclick,onkeypress", "", "../../../../fastmedical_front/imagen/icono/reload3.png", "", "", true);
$toolbar->SetBoton("Pre-Orden Farmaceútica", "Pre-Orden Farmaceútica", "btn", "onclick,onkeypress", "mostrarPreOrdenFarmaciaSOP()", "../../../../fastmedical_front/imagen/icono/pastillas.png", "", "", true);
$toolbar->SetBoton("Solicitudes Realizadas", "Ver Solicitudes Realizadas", "btn", "onclick,onkeypress", "verSolicitudesRealizadasSOP()", "../../../../fastmedical_front/imagen/icono/contents.png", "", "", true);
$toolbar->SetBoton("Generación Reporte Operatorio SOP", "Generar Reporte Operatorio", "btn", "onclick,onkeypress", "generarReporteOperatorioSOP()", "../../../../fastmedical_front/imagen/icono/easymoblog.png", "", "", true);
$toolbar->SetBoton("Generación Solicitud Programacion SOP", "Nueva Solicitud", "btn", "onclick,onkeypress", "mostrarSolicitudProgramacionSOP()", "../../../../fastmedical_front/imagen/icono/filenew.png", "", "", true);
//-------------------------------------------------------------------------------
$toolbar1 = new ToollBar("right");
$toolbar1->SetBoton("Mostrar Solicitudes Pendientes", "Ver Solicitudes Pendientes", "btn", "onclick,onkeypress", "verSolicitudesPendientesSOP()", "../../../../fastmedical_front/imagen/icono/comment.png", "", "", true);
//-------------------------------------------------------------------------------
?>
<div align="center" style="width:100%;height: 750px">
    <div id="Div_GeneralProgramacionSOP" style="width:100%;height: 100%">
        <div style="width:100%;height:5%;background: white">
            <div class="titleform">
                <h1>PROGRAMACION - SALA DE OPERACIONES</h1>
            </div>
        </div>
        <div id="Div_Busquedas" style="width: 98%;height: 25%;">
            <table style="width: 100%;height: 100%">
                <tr style="width: 100%;height: 100%">
                    <td style="width: 40%;height: 30%">
                        <fieldset style="margin:5px;padding:5px;height:90%;width: 60%">
                            <!--Acá están los hidden para las búsquedas-->
                            <input type="hidden" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
                            <input type="hidden" id="hIdTablaProgramacionSOP" name="hIdTablaProgramacionSOP" value=""/>
                            <input type="hidden" id="hOpcionSede" name="hOpcionSede" value="" />

                            <div id="Div_CalendarioSOP" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                                <?php
                                $calendario = $o_CalSOP->getHTMLFullCalendario();
                                echo $calendario;
                                ?>
                            </div>    
                        </fieldset>
                    </td>
                    <td style="width: 30%;height: 30%">
                        <table style="width: 100%;height: 100%">
                            <tr style="width: 100%;height: 15%">
                                <td id="Td_FechaSOP"></td>
                            </tr>
                            <tr style="width: 100%;height: 25%">
                                <td style="font: 12px Arial">Anestesi&oacute;logo : </td>
                                <td style="font: 12px Arial">
                                    <input type="hidden" name="hdnCodPerAnestesiologo" id="hdnCodPerAnestesiologo" value="<?php echo $_SESSION['id_persona']; ?>" />
                                    <input type="text" name="txtNomPerAnestesiologo" id="txtNomPerAnestesiologo" size="50" readonly="true" value="<?php echo htmlentities($_SESSION['nombre']) ; ?>" />
                                </td>
                            </tr>
                            <tr style="width: 100%;height: 25%">
                                <td style="font: 12px Arial">Ambiente : </td>
                                <td style="font: 12px Arial">
                                    <select id="cboAmbLogServicioCentroQuirurgico" name="cboAmbLogServicioCentroQuirurgico">
                                        <?php echo $opcionesCboAmbientesLogicos; ?>
                                    </select>
                                </td>

                            </tr>
                            <tr style="width: 100%;height: 25%">
                                <td style="font: 12px Arial">Especialidad : </td>
                                <td style="font: 12px Arial">
                                    <select id="cboCentroCostoCirujanoSOP" name="cboCentroCostoCirujanoSOP">
                                        <?php echo $opcionesCboCentroCostoCirujanosSOP; ?>
                                    </select>                                    
                                </td>                                
                            </tr>
                        </table>
                    </td>
                    <td style="width: 30%;height: 30%;vertical-align: bottom">
                        <?php $toolbar1->Mostrar(); ?>
                    </td>
                </tr>
            </table>
        </div>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->
        <div id="Div_solicitudespendientesSOP" style="width: 98%;height: 20%;display:none">
            <table style="width: 100%;height: 100%">
                <tr style="width: 100%;height: 10%">
<!--                    <td style="font: 14px sans-serif">Solicitudes Pendientes</td>-->
                    <td>
                        <div class="titleform">
                            <h6>SOLICITUDES PENDIENTES</h6>
                        </div>
                    </td>
                </tr>
                <tr style="width: 100%;height: 90%">
                    <td style="width: 100%;height: 100%">
                        <div id="Div_TablaSolicitudesPendientesSOP" style="width: 100%;height: 100%">
                        </div>     
                    </td>
                </tr>                
            </table>
        </div>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->        
        <div id="Div_programaciones" style="width: 98%;height: 30%;">
            <table style="width: 100%;height: 100%">
                <tr style="width: 100%;height: 10%">
<!--                    <td style="font: 14px sans-serif">Programaciones</td>-->
                    <td>
                        <div class="titleform">
                            <h6>PROGRAMACIONES</h6>
                        </div>
                    </td>
                </tr>
                <tr style="width: 100%;height: 90%">
                    <td style="width: 100%;height: 100%">
                        <div id="Div_TablaProgramacionesSOP" style="width: 100%;height: 100%;">
                        </div>     
                    </td>
                </tr>                
            </table>           
        </div>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->        
        <div id="Div_botones" style="width: 98%;height: 5%;">
            <?php $toolbar->Mostrar(); ?>
        </div>
        <!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->        
        <div style="width: 98%;height: 20%;">
            <div id="Div_LeyendaProgramacionSOP" style="width: 25%;height: 70%">

            </div>
        </div>
    </div>
    <!--   ****************************************************************************************************************************************************** -->
    <div id="Div_SolicitudProgramacionSOP" style="width:70%;display:none">
        
        <?php require_once("vistaSolicitudProgramacionSOP.php");?>
    </div>
    <!--   ****************************************************************************************************************************************************** -->
    <div id="Div_PreOrdenFarmaciaSOP" style="width:70%;display:none">
        <?php require_once("vistacontrolInternoFarmaciaSOP.php");?>
    </div>    
</div>