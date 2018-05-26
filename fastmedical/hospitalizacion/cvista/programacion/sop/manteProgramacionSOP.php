<?php
//////////////////////////////Recuperamos Solicitud//////////////////////////////////////
//print_r($rsDetalleProgramacionSOP);

if(isset($rsDetalleProgramacionSOP)){
    $iidProgramacionSOP=$rsDetalleProgramacionSOP[0]["iidProgramacionSOP"];

    $fechaServicio=$rsDetalleProgramacionSOP[0]["dFechaServicio"];
    $horaIngreso=$rsDetalleProgramacionSOP[0]["dFechaHoraIngreso"];
    $horaSalida=$rsDetalleProgramacionSOP[0]["dFechaHoraSalida"];

    //$nomPaciente=htmlentities($rsDetalleProgramacionSOP[0]["nomCompletoPaciente"]);
    $apellidosPaciente=htmlentities($rsDetalleProgramacionSOP[0]["apellidosPaciente"]);
    $nombrePaciente=htmlentities($rsDetalleProgramacionSOP[0]["nombrePaciente"]);


    $edad=htmlentities($rsDetalleProgramacionSOP[0]["edad"]);
    $sexo=htmlentities($rsDetalleProgramacionSOP[0]["vSexo"]);
    $filiacionActiva=htmlentities($rsDetalleProgramacionSOP[0]["vDescripcion"]);
    $centroCostoCirujano=htmlentities($rsDetalleProgramacionSOP[0]["vDescripcionCcosto"]);
    $duracion=$rsDetalleProgramacionSOP[0]["vTiempoAproximado"];

    $codAmbienteLogico=$rsDetalleProgramacionSOP[0]["cCodigoAmbienteLogico"];
    $nomAmbienteLogico=htmlentities($rsDetalleProgramacionSOP[0]["vNombreAmbienteLogico"]);



    /*$horaPropuesta=$rsDetalleSolicitudPendienteSOP[0]["vHoraPropuesta"];
    $nomPaciente=htmlentities($rsDetalleSolicitudPendienteSOP[0]["nomCompletoPaciente"]);
    $edad=htmlentities($rsDetalleSolicitudPendienteSOP[0]["edad"]);
    $centroCostoCirujano=htmlentities($rsDetalleSolicitudPendienteSOP[0]["vDescripcionCcosto"]);

    $duracion=$rsDetalleSolicitudPendienteSOP[0]["vTiempoOperatorioEstimado"];

    $hematocrito=$rsDetalleSolicitudPendienteSOP[0]["nHematocrito"];
    $hemoglobina=$rsDetalleSolicitudPendienteSOP[0]["nHemoglobina"];
    $observaciones=htmlentities($rsDetalleSolicitudPendienteSOP[0]["vObservaciones"]);*/
}
else{
    $fechaServicio="";
    $horaPropuesta="";
    $nomPaciente="";
    $edad="";
    $centroCostoCirujano="";
    $duracion="";
    $hematocrito="";
    $hemoglobina="";
    $observaciones="";
}

?>
<div>
    <!--$iidProgramacionSOP-->
    <input type="hidden" id="hdnIdProgramacionSOP" value="<?php echo $iidProgramacionSOP; ?>" />
    <div style="width:100%;height:5%;background: white">
        <div class="titleform">
            <h1>Personal M&eacute;dico</h1>
        </div>
    </div>
    <div>
        <fieldset>
            <div style="clear:left;width:100%">
                <div style="float:left; width:20%;" >
                    <label>Filiaci&oacute;n Activa:</label>
                </div>
                <div style="float:left; width:20%;"><?php echo $filiacionActiva; ?></div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">
                    <label>Sexo:</label>
                </div>
                <div style="float:left; width:20%;"><?php echo $sexo; ?></div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:20%;">
                    <label>Apellidos:</label>
                </div>
                <div style="float:left; width:20%;"><?php echo $apellidosPaciente; ?></div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">
                    <label>Edad:</label>
                </div>
                <div style="float:left; width:20%;"><?php echo $edad; ?></div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:20%;">
                    <label>Nombres:</label>
                </div>
                <div style="float:left; width:20%;"><?php echo $nombrePaciente; ?></div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
                <div style="float:left; width:20%;">&nbsp;</div>
            </div>

            <div id="divTablaAmbienteLogico">
                <div id="divFilaTablaAmbienteLogico" style="clear:left;width:100%">
                    <div style="float:left; width:22%;" >
                        <label>Ambiente</label>
                    </div>
                    <div style="float:left; width:45%;">
                        <input type="hidden" name="hdnCodAmbienteLogico" id="hdnCodAmbienteLogico" value="<?php echo $codAmbienteLogico; ?>" />
                        <input type="text" name="txtNomAmbienteLogico" id="txtNomAmbienteLogico" value="<?php echo $nomAmbienteLogico; ?>" size="50" readonly="true" />
                    </div>
                    <div style="float:left; width:11%;">
                        <a href="javascript:mostrarBuscadorAmbienteLogico('hdnCodAmbienteLogico','txtNomAmbienteLogico')">
                            <img border="0" title="Buscar Ambiente Logico" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">
                        </a>
                    </div>
                    <div style="float:left; width:11%;">
                        <label>Tipo</label>
                    </div>
                    <div style="float:left; width:11%;">
                        <select name="cboTipoProgSOP" id="cboTipoProgSOP">
                            <?php echo $opcionesCboTiposProgramacionSOP;?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Fecha Servicio</label>
                </div>
                <div style="float:left; width:45%;">
                    <!--<input type="text" name="txtFechaPropuestaSolProgSOP" id="txtFechaPropuestaSolProgSOP" onBlur="validarFechaPropuestaSolProgSOP(this.value);" />-->
                    <input type="text" name="txtFechaServicioProgSOP" id="txtFechaServicioProgSOP" size="10" readonly="true" value="<?php echo $fechaServicio;?>" />
                    (dd/mm/aaaa)
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">
                    <label>Hora Ingreso</label>
                </div>
                <div style="float:left; width:11%;">
                    <input type="text" name="txtHoraIngresoProgSOP" id="txtHoraIngresoProgSOP" size="10" readonly="true" value="<?php echo $horaIngreso;?>" />
                </div>
            </div>

            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Hora Salida</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtHoraSalidaProgSOP" id="txtHoraSalidaProgSOP" size="10" readonly="true" value="<?php echo $horaSalida;?>" />
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>
            
            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Centro de Costo</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtCentroCostoProgSOP" id="txtCentroCostoProgSOP" size="50" readonly="true" value="<?php echo $centroCostoCirujano;?>" />
                </div>
                <div style="float:left; width:11%;">
                    <!--<img border="0" title="Buscar Centro de Costo" alt="Buscar" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif">-->
                    &nbsp;
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>

            <div id="divTablaCirugiasRealizadasSOP" style="clear:left;width:100%;height:100px">
            </div>

            <div id="divTablaServiciosUtilizadosSOP" style="clear:left;width:100%;height:100px">
            </div>
            <!--
            <div style="clear:left;width:100%">
                <div style="float:left; width:22%;" >
                    <label>Duraci&oacute;n</label>
                </div>
                <div style="float:left; width:45%;">
                    <input type="text" name="txtHorasEstimadasSolProgSOP" id="txtHorasEstimadasSolProgSOP" size="10" readonly="true" value="<?php echo $duracion;?>" />
                </div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
                <div style="float:left; width:11%;">&nbsp;</div>
            </div>
            -->
        </fieldset>
    </div>
    <br/>
    <div id="Div_btnSolProgSOP" align="center" style="width: 100%;background: bottom;display: block">
        <?php //if($_SESSION["permiso_formulario_servicio"][119]["GRABAR_PROG_MED"]==1) echo "<a href=\"javascript:validarCronogramaProgramacionMedicos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php //if($_SESSION["permiso_formulario_servicio"][119]["CANCELAR_GRABAR_PROG_MED"]==1) echo "<a href=\"javascript:regresarCronogramaProgramacionMedicos()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php //echo "<a href=\"javascript:validarManteProgSOP('insertar')\"><img src=\"../../../../fastmedical_front/imagen/btn/b_grabar__on.gif\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        <?php echo "<a href=\"javascript:regresarSolicitudesPendientesSOP()\"><img src=\"../../../../fastmedical_front/imagen/icono/comment.png\"></a>";?>
        <?php echo "<a href=\"javascript:regresarSolicitudesPendientesSOP()\"><img src=\"../../../../fastmedical_front/imagen/icono/cama.jpg\"></a>";?>
        <?php echo "<a href=\"javascript:regresarSolicitudesPendientesSOP()\"><img src=\"../../../../fastmedical_front/imagen/icono/pendiente.gif\"></a>";?>
        
        <!--Si la orden no esta liquidada se muestra este boton-->
        <?php echo "<a href=\"javascript:validarManteProgramacionSOP('actualizar')\"><img src=\"../../../../fastmedical_front/imagen/btn/b_actualizardatos.gif\"></a>";?>

        <?php echo "<a href=\"javascript:regresarDeDetalleAprogramacionesSOP()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif\"></a>";?>
    </div>
</div>
