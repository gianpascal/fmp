<?php
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LCronograma.php");
require_once("../../clogica/LCita.php");
include_once("../../../pholivo/Calendario.php");
$obj_Cronograma = new LCronograma();
$obj_Cita = new LCita();
$arrayTipoOrigen = $obj_Cita->getOrigenCita();
$o_ComboTipoOrigen = new Combo($arrayTipoOrigen);
$parametros[2]=96422;
$objCronograma = $obj_Cronograma->getCronogramaMedicoObjecto($parametros["p2"]);
$arrayHora = $obj_Cita->getArrayCuposDisponibles($parametros["p2"]);
//var_dump($arrayHorasDisponibles);
$o_ComboHorasDiponibles = new Combo($arrayHora);

/**
 vid_cronograma,
 profesional,
 iid_persona,   
 iid_ambiente,
 ambiente,   
 cod_oficina,
 nom_oficina,
 iid_turno,   
 hora_inicio,
 hora_fin,   
 fecha,      
 cod_art,
 producto,       
 iid_actividad,
 icupos,
 vdescripcion,
**/
?>
<style>
#divManCita{
	border:none;
	padding:0px;
	margin:0px;
}
</style>
<form id="idGestionCita" name="idGestionCita" class="formGestionCita">
<div style="width:100%;font-family:Arial, Helvetica, sans-serif">
    <div style="float:left;width:64%" >
    	<div style="float:left;width:49%">
        	<fieldset style="margin:1px;padding:1px">
            <legend>Destino</legend>
            <div align="center">
            	<table><br />
                <tr><td>C&oacute;digo</td><td><input name="txtcodigocronograma" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Producto / Servicio</td><td><input name="txtnombreproductoservicio" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Ambiente</td><td><input name="txtnombreambiente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>M&eacute;dico</td><td><input name="txtnombremedico" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Especialidad</td><td><input name="txtnombreespecialidad" type="text" size="30" readonly="true" /></td></tr>
				<br />
                </table>
            </div>
          </fieldset>
        </div>
        <div style="float:right;width:49%">
        	
            <fieldset style="margin:1px;padding:1px;margin-top:0px;padding-top:0px;">
<legend>Paciente</legend>
            <div align="center">
            	<table><br />
                <tr><td>C&oacute;digo Paciente</td><td><input name="txtcodigopaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Filiaci&oacute;n Activa</td><td><input name="txtfiliacionactivapaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Nombres</td><td><input name="txtnombrespaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Apellido Paterno</td><td><input name="txtapellidopaternopaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Apellido Materno</td><td><input name="txtapellidomaternopaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>N&deg; Documento</td><td><input name="txtnumerodocumentopaciente" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>Fecha Nacimiento</td><td><input name="txtfechanacimientopaciente" type="text" size="30" readonly="true" /></td></tr>

				<br />
                </table>
            </div>
            
          </fieldset>      
        </div>
    </div>
	<div style="float:right;widht:35%">
	       	
            <div style="width:100%">
                  <fieldset style="margin:1px;padding:1px;">
                <legend>Cita</legend>
            <table><br />
                <tr><td>C&oacute;digo Cita</td><td><input name="txtcodigocita" type="text" size="30" readonly="true" /></td></tr>
                <tr><td>HORA</td><td><input name="txtnombreambiente" type="text" size="30" readonly="true" /></td></tr>
                <tr>
                	<td>Tipo de Cita &nbsp;</td>
                    <td align="center">
                    <B>Consulta</B> &nbsp;<input name="rbtntipodecita" type="radio" value="" checked="checked"/>
                    <B>Procedimiento</B> &nbsp;<input name="rbtntipodecita" type="radio" value="" />
                    </td>
                </tr>
                
				<br />
                </table>
              </fieldset>
    </div>
    <div align="center" style="width:100%">
                          <input type="button" name="btnGuardar" value="Guardar" onclick="myajax.Request({url:'../../ccontrol/control/control.php',method:'post',param:'p1=grabar_cita&'+myajax.DataForm($('idGestionCita')),onOk:onGrabarCita,onError:onGrabarCita});" style="cursor:pointer;margin-right:5px;margin-top:8px;"/>
              <input type="button" name="btnCancelar" value="Cancelar" onclick="volverProgramacionCitas();" style="cursor:pointer;margin-left:5px;margin-top:8px;"/>

    </div>
    <div>
        
    </div>
    </div>

</div>
</form>



