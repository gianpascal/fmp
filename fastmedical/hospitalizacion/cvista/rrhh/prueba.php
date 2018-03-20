 <?php
//require_once("../../ccontrol/control/ActionCita.php");
//require_once("../../ccontrol/control/ActionCronograma.php");
require_once("../../../pholivo/Calendario.php");
//require_once("../../../pholivo/Html.php");
//require_once("../../ccontrol/control/ActionPersona.php");

//$o_ActionPersona = new ActionPersona();
//$o_actionCita = new ActionCita();
//$actionCronograma = new ActionCronograma();
//$actionCronograma-> getArbolServiciosProgramados();
$fechaActuaTimeStamp = date("Y-m-d");//Me da la fecha actual
//$parametros["opcionBusqueda"]=1;//Porque la opción de búsqueda es por fecha
//$parametros["opcionFiltro"]=1;//Esto falta asignar
$parametros["fecha"]=$fechaActuaTimeStamp;//La fecha actual
//$parametros["patron"]=1;//Esto falta asignar
$idAccion = "5";//Se envia 5 para que muestre el mes actual
$tsFechaActual=strtotime(date("Y-m-d"));//Si no se envía nada en la fecha actual la calcula el constructor y el dia no se pinta.
$o_Cal01 = new Calendario('cal01','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,$idAccion,'seleccionarFechaCitasInformes','accionCalendarioCitasInformes','1');


//$_SESSION["permiso_formulario_servicio"]=1;
//**** COMBO FILTRO ****//
//$cb_combo_sede = $o_actionCita->listaDatosSede();
?>
    <fieldset style="margin:5px;padding:5px;height:auto;width:auto;">
                    <!--Acá están los hidden para las búsquedas-->
                    <input type="text" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
                    <input type="hidden" id="hOpcionSede" name="hOpcionSede" value="0000000001" />
                    <input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="" />
                    <input type="hidden" id="hOpcionActividad" name="hOpcionActividad" value="1" />
                    <input type="hidden" id="hPatronBusqueda" name="hPatronBusqueda" />

                    <div id="divBusCronogra" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                        <?php
                        $calendario = $o_Cal01->getHTMLFullCalendarioLargo();
                        echo $calendario;
                 
                        ?>
                    </div>
                </fieldset>