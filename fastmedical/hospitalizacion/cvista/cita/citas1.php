<?php
require_once("../../ccontrol/control/ActionCita.php");
require_once("../../ccontrol/control/ActionCronograma.php");
require_once("../../../pholivo/Calendario.php");
require_once("../../../pholivo/Html.php");

        $o_actionCita = new ActionCita();
        $actionCronograma = new ActionCronograma();
        $actionCronograma-> getArbolEspecialidad();
        $fechaActuaTimeStamp = date("Y-m-d");//Me da la fecha actual

        $parametros["opcionBusqueda"]=1;//Porque la opción de búsqueda es por fecha
        $parametros["opcionFiltro"]=1;//Esto falta asignar
	$parametros["fecha"]=$fechaActuaTimeStamp;//La fecha actual
        $parametros["patron"]=1;//Esto falta asignar
        $htmlCronograma = $o_actionCita->listaCronograma($parametros);
        $htmlProgramacionPaciente = $o_actionCita->listaCita("01", '-1');

        
	//$htmlCronograma = $o_actionCita->listaCronograma("01",$fechaActuaTimeStamp);
        $idAccion = "5";//Se envia 5 para que muestre el mes actual
        //($_nombreCalendario='',$_estiloAccion, $_estiloCabeceraDia='',$_estiloCasilla1='',$_estiloCasilla2='',$_fechaActual='',$_idAdicionFecha='5',$_funcionjsDia='',$_funcionjsCalendario='')
        $tsFechaActual='';//Si no se envía nada en la fecha actual la calcula el constructor
        $o_Cal01 = new Calendario('cal01','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,$idAccion,'seleccionarFecha','accionCalendario');

	///Opciones de Busqueda de Programacion de Médicos
	$_SESSION["permiso_formulario_servicio"]=1;
	$o_Toolbar = new ToollBar('left','btns');
        //SetBoton($pboton,$pbotonname,$style,$evento,$funcionjava,$image,$ancho="",$title="",$activo=true)
        //function selOpcionBusquedaProgMedicos(opcBusqueda,objeto,evento,escuchador) se llama desde citas.js
	$o_Toolbar->SetBoton('1',"Fecha",'btn','onClick,KeyPress,onDblClick','selOpcionBusquedaProgMedicos','../../../../fastmedical_front/imagen/icono/hos_calendar.png','','','48');
        $o_Toolbar->SetBoton("2","Especialidad","btn","onclick,onkeypress",'cargar_tree_ccostos',"../../../../fastmedical_front/imagen/icono/b_tree.gif");
        $o_Toolbar->SetBoton('3',"M&eacute;dico",'btn','onClick,KeyPress,onDblClick','selOpcionBusquedaProgMedicos','../../../../fastmedical_front/imagen/icono/hos_medico.png','','','48');

        //$cb_combohorariospermitidos = $o_actionCita->listaTurnosLibres('0');

        //**** COMBO FILTRO ****//
        $cb_combo = $o_actionCita->listaDatosComboFiltro('1','','0','',$fechaActuaTimeStamp,'TODOS');//El segundo '' vacio indica que el combo se cargará seleccionado "Seleccionar"
        $cb_radio = $o_actionCita->listaRadioFiltro('1','','0');
        $cb_combo_sede = $o_actionCita->listaDatosSede();
        $o_ToolbarCita = new ToollBar('left','btns');
        $o_ToolbarCita->SetBoton('4',"Nueva Cita",'btn','onClick','irnuevaCita','../../../../fastmedical_front/imagen/icono/nuevo.png','','','48');
        //$o_ToolbarCita->SetBoton('5',"Lista de Citas",'btn','onClick','irDetalleCitas','../../../../fastmedical_front/imagen/icono/demo.png','','','48');
?>

<link href="../../css/style_hosp.css"/>
<link href="../../css/style_hosp.css" rel="stylesheet" type="text/css" />

<style type="">
#contenedor-cronograma{
	width:69%;
	height:300px;
	display:block;
	float:right;
	border:solid 1px #EBEBEB;
	overflow:hidden;
}
</style>

<div id="divTotal" class="divTotalOculto"></div>

<div class="titleform">
    <h1>Programación de Citas</h1>
</div>
<div style="width:30%;height:400px;float:left">
    <div style="width:100%;height:68%;display:block;overflow:auto;margin:0px;padding:0px;">
        <fieldset style="margin:1px;padding:2px;height:90%;">
            <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Buscar Cronograma Medico</legend>
                <div id="toolbar" align="center" style="height:25px;margin:1px;padding:1px;width:97%;">
                    <!--Acá están los hidden para las búsquedas-->
                    <input type="hidden" id="hFecha" name="hFecha" value="<?php echo $fechaActuaTimeStamp ?>"/>
                    <input type="hidden" id="hOpcionFiltro" name="hOpcionFiltro" value="1" />
                    <input type="hidden" id="hOpcionBusqueda" name="hOpcionBusqueda" value="1" />
                    <!--<input type="text" id="hFecha" name="hFecha" />-->
                    <input type="hidden" id="hPatron" name="hPatron" />
                    <table border="0" cellpadding="0" cellspacing="0"><tr><td><?php echo $o_Toolbar->Mostrar(); ?></td></tr></table>
                </div>
                <div id="divBusCronograma" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                    
                    <?php
                        $calendario = $o_Cal01->getHTMLFullCalendario();
                        echo $calendario;
                        
                    ?>
                </div>
        </fieldset>

    </div>
    <div style="width:100%;height:18%;margin:0px" align="center">
         <fieldset style="margin:0px;padding:2px;height:100%;">
            <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Disponibilidad</legend>
            <div id="divDisponibilidadesCita"style="width: 240px" align="center">
                <div style="float:left;margin-left: 4px;margin-right: 4px">
                    <div id="divDisponibilidadCitas" style="border: 1px solid blue;widht:60px;height: 40px;font-size: 50px">
                        <input id="txtcitas" type="text" style="width:70px;height: 40px;font-size: 40px;text-align:center" size="3" disabled/>
                    </div>
                </div>
                <div style="float:left;margin-left: 4px;margin-right: 4px">
                    <div id="divDisponibilidadReservas" style="border: 1px solid red;widht:60px;height: 40px;font-size: 50px">
                        <input id="txtreservas" type="text" style="width:70px;height: 40px;font-size: 40px;text-align:center" size="3" disabled/>
                    </div>
                </div>
                <div style="float:left;margin-left: 4px;margin-right: 4px">
                    <div id="divDisponibilidadCupos" style="border: 1px solid green;widht:60px;height: 40px;font-size: 50px">
                        <input id="txtcupos" type="text" style="width:70px;height: 40px;font-size: 40px;text-align:center" size="3" disabled />
                    </div>
                </div>
            </div>
            <div style="width: 240px;">
                <div style="float:left;margin-left: 4px;margin-right: 4px">
                    <div style="widht:60px;" align="center">
                        <label style="width: 60px;text-align: center">CITAS</label>
                    </div>
                </div>
                <div style="float:left;margin-left: 4px;margin-right: 4px" >
                    <div style="widht:60px;" align="center">
                        <label style="width: 60px;text-align: center">RESERVAS</label>
                    </div>
                </div>
                <div style="float:left;margin-left: 4px;margin-right: 4px">
                    <div style="widht:60px;" align="center">
                        <label style="width: 60px;text-align: center">CUPOS</label>
                    </div>
                </div>
                
                <input type="hidden" id="hdIdNuevaoDetalle" value="2"/>
                <!-- hdIdNuevaoDetalle value="1" para nueva cita -->
                <!-- hdIdNuevaoDetalle value="2" para mostrar lista de citas -->
                <!-- hdIdNuevaoDetalle value="3" para editar cita -->
            </div>

        </fieldset>
    </div>
    <br/>
    <div  id="divAccionCita" style="width:100%; height:10%;font-family:Arial, Helvetica, sans-serif" align="center">
            <input name="hdIdCronograma" type="hidden" id="hdIdCronograma" value ="-1" style="display:none"/>
            
            <div align="center" style="height:25px;margin:1px;padding:1px;width:97%;">
                <table border="0" cellpadding="0" cellspacing="0"><td><tr><?php $o_ToolbarCita->Mostrar();?></tr></table>
            </div>
    </div>
</div>

<div id="contenedor-cronograma" style="width:69%;height:400px;font-family:Arial, Helvetica, sans-serif">
    <div id="divTipoBusquedaCronograma" style="width:100%;height:10%;float:right;">
    <form name="form_filtro" id="form_filtro">
        <input type="hidden" id="hFiltro" name="hFiltro"/>
        <input type="hidden" id="hDato" name="hDato"/>
        
            <div id="divFiltro" style="float:left;width:40%">
            <fieldset style="height:100%;width: 70%">
            <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Tipo de Busqueda</legend>
                <?php echo html_entity_decode($cb_combo); ?>
            </fieldset>
            </div>
        
        <div style="float:right;width:60%">
            <div id="divFiltroRadio" style="float:left;width: 60%">
            <fieldset style="height:100%;width: 100%">
            <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Seleccionar Actividad</legend>
                <input type="hidden" id="hIdFiltroRadio" name="hIdFiltroRadio" value="TODOS"/>
             <?php echo html_entity_decode($cb_radio); ?>
            </fieldset>
            </div>
            <div id="divFiltroSede" style="float:right;width: 40%">
                <div style="float:left">
                </div>
                <div style="float:right">
            <fieldset style="height:100%;width: 100%">
            <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Seleccionar Sede</legend>
                    <input type="hidden" id="hIdFiltroSede" name="hIdFiltroSede" value=""/>
             <?php echo html_entity_decode($cb_combo_sede); ?>
            </fieldset>
                </div>
            </div>
        </div>
    </form>
    </div>
    <br/><br/><br/>
    <div id="divConsulCronograma" style="overflow:auto;overflow-x:block ;width:100%; height:90%; background:#F8F8F8;display:block;float:right">
        <table class="tabla1">
            <?php echo $htmlCronograma; ?>
        </table>
    </div>
</div>

<!--<div id="divDatosCitas" style="width:100%;height:14px;display:block;position:relative;background:#F4F4F4;float:right;border:solid  #666666;border-right-width:1px;border-left-width:1px;border-top-width:0px;border-bottom-width:0px;"></div>-->
<fieldset style="margin:0px;padding:2px;height:250px;width: 100%">
    <legend style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">Gestionar Cita</legend>
    <div id="divCitaPaciente" style="display:none;width:100%; height:220px;background:#F8F8F8;position:relative;float:right;border:solid 1px #CCCCCC">
    <style type="">
        #divManCita{
                border:none;
                padding:0px;
                margin:0px;
        }
    </style>
    <form id="idGestionCita" name="idGestionCita" class="formGestionCita">
        <div id="divnuevacita" style="width:100%;font-family:Arial, Helvetica, sans-serif">
            <div style="float:left;width:70%" >
                <div style="float:left;width:49%">
                    <fieldset style="margin:1px;padding:1px">
                        <legend>Destino</legend>
                        <div id="divdestino" align="center">
                            <br/>
                            <table>
                                <tr><td>C&oacute;digo Cronograma</td><td><input id="txtcodigocronograma" name="txtcodigocronograma" title="Cronograma" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Producto / Servicio</td><td><input id="txtnombreproductoservicio" name="txtnombreproductoservicio" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Ambiente</td><td><input id="txtnombreambiente" name="txtnombreambiente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>M&eacute;dico</td><td><input id="txtnombremedico" name="txtnombremedico" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Especialidad</td><td><input id="txtnombreespecialidad" name="txtnombreespecialidad" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Turno</td><td><input id="txtturno" name="txtturno" type="text" size="30" readonly="true" /></td></tr>
                            </table>
                            <br/>
                            <br/>
                            <br/>
                        </div>
                    </fieldset>
                </div>
                        <!--<tr><td><input id="hIdServProd" type="text"/></td></tr>-->
                <div style="float:right;width:49%">
                    <fieldset style="margin:1px;padding:1px;margin-top:0px;padding-top:0px;">
                        <legend>Paciente</legend>
                        <div id="divpaciente" align="center">
                            <br/>
                            <table>
                                <tr><td>C&oacute;digo Paciente</td><td><input id="txtcodigopaciente" name="txtcodigopaciente" title="Paciente" type="text" size="19" readonly="true" />&nbsp;<input name="buscarpaciente" id="buscarpaciente" type="button" value="Buscar" width="10" onclick="ventana_busca_persona('setDatosPersonas');"/></td></tr>
                                <tr><td><input id="hIdAfiliacion" type="hidden"/></td></tr>
                                <tr><td>Filiaci&oacute;n Activa</td><td><input id="txtfiliacionactivapaciente" name="txtfiliacionactivapaciente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Nombres</td><td><input id="txtnombrespaciente" name="txtnombrespaciente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Apellido Paterno</td><td><input id="txtapellidopaternopaciente" name="txtapellidopaternopaciente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Apellido Materno</td><td><input id="txtapellidomaternopaciente" name="txtapellidomaternopaciente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>N&deg; Documento</td><td><input id="txtnumerodocumentopaciente" name="txtnumerodocumentopaciente" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Fecha Nacimiento</td><td><input id="txtfechanacimientopaciente" name="txtfechanacimientopaciente" type="text" size="30" readonly="true" /></td></tr>
                            </table>
                            <br/>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div style="float:left;widht:36%">
                <div style="widht:100%">
                    <div style="float:left;width:100%">
                        <fieldset style="margin:1px;padding:1px">
                        <legend>Cita</legend>
                        <div id="divprogramacioncita" align="center">
                            <br/>
                            <table id="tablacita">
                                <tr><td>C&oacute;digo Cita</td><td><input id="txtcodigocita" name="txtcodigocita" type="text" size="30" readonly="true" /></td></tr>
                                <tr><td>Fecha de Cita</td><td><input id="txtfechacita" name="txtfechacita" type="text" size="30" readonly="true" value="<?php echo $fechaActuaTimeStamp;?>" /></td></tr>
                                <tr>
                                    <td>Tipo de Cita</td>
                                    <td>
                                        <input type="radio" name="grupotipocita" id="rbtnconsulta" value="0001" checked/>Consultorio
                                        <input type="radio" name="grupotipocita" id="rbtnprocedimiento" value="0002" />Procedimiento
                                    </td>
                                </tr>
                                <tr><td>Observaci&oacute;n</td><td><textarea name="txtobservacioncita" rows="2" cols="30" id="txtobservacioncita" readonly></textarea></td><td><input type="button" id="btnSelAmbiente" name="btnSelAmbiente" width="5" value="..." onclick="editarObsCita();" style="visibility:hidden;"/><td/></tr>
                                <tr id="filanuevahora">
                                    <td id="colnuevahoradesc" style="display:none;">Nueva Hora</td>
                                    <td>
                                        <input id="txtnuevahora" name="nuevahora" type="text" size="1" maxlength="2" style="visibility:hidden;"/>
                                        <input id="txtnuevominutos" name="txtnuevominutos" type="text" size="1" maxlength="2" style="visibility:hidden;"/>
                                        <select id="cb_tiempo" name="cb_tiempo" style="width:50px;display:none;float:right;">
                                            <option value="am">am</option>
                                            <option value="pm">pm</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="divcombocita" align="center">
                            <table width="140">
                                <tr>
                                    <td>Turno</td><td><select id="cb_horariopermitido" name="cb_horariopermitido"><option >Seleccionar</option></select></td>
                                </tr>
                            </table>
                            <br/>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div align="center" style="width:100%">
                    <input type="button" name="btnGuardar" value="Guardar" onclick="guardar_cita();" style="cursor:pointer;margin-right:5px;margin-top:8px;"/>
                    <input type="button" name="btnCancelar" value="Cancelar" onclick="irDetalleCitas();" style="cursor:pointer;margin-left:5px;margin-top:8px;"/>
                </div>
                <input id="hIdFormato" name="hIdFormato" type="hidden" style="display: block;">
    <!--        <input id="hIdNroFormato" name="hIdNroFormato" type="text" style="display: block;"> -->
                <input id="hIdClas_Formato" name="hIdClas_Formato" type="hidden" style="display: block;">
                <input id="hIdAmbiente" name="hIdAmbiente" type="hidden" style="display: block;">
                <input id="hIdCentroCosto" name="hIdCentroCosto" type="hidden" style="display: block;">
                <input id="hIdTurno" name="hIdTurno" type="hidden" style="display: block;">
    <!--        <input id="hbPrograCita" name="hbPrograCita" type="text" style="display: block;">
            <input id="hIdComprobantePago" name="hIdComprobantePago" type="text" style="display: block;">
            <input id="hNroComprobantePago" name="hNroComprobantePago" type="text" style="display: block;"> -->
    <!--        <input id="hEstadoAtencion" name="hEstadoAtencion" type="text" style="display: block;">
    <!--        <input id="hIdCondicionLlegada" name="hIdCondicionLlegada" type="text" style="display: block;">
            <input id="hIdCieIng" name="hIdCieIng" type="text" style="display: block;">
            <input id="hcont_cama" name="hcont_cama" type="text" style="display: block;"> -->
    <!--        <input id="hNroHCPersona" name="hNroHCPersona" type="text" style="display: block;">
            <input id="hNroHCPersonaResponsable" name="hNroHCPersonaResponsable" type="text" style="display: block;"> -->
    <!--        <input id="hId_c_rs" name="hId_c_rs" type="text" style="display: block;"> -->
                <input id="hIdPersonalResponsable" name="hIdPersonalResponsable" type="hidden" style="display: block;">
                <input id="hIdEntidadPersonalResponsable" name="hIdEntidadPersonalResponsable" type="hidden" style="display: block;">
            </div>
        </div>
    </form>
    </div>
    <div id="divCitaPaciente2" style="display:block;width:100%; height:220px;background:#F8F8F8;position:relative;float:right;border:solid 1px #CCCCCC">
        <table class="tabla1">
            <?php echo $htmlProgramacionPaciente; ?>
        </table>
    </div>
</fieldset>