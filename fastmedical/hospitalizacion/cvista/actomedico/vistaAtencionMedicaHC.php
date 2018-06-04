<div id="Div_filiacionHC" align ="center" style="width:100%;border-style: solid;border-width: 1px">
    <?php
    $datosPersona = $this->obtenerDatosFiliacionActoMedico($datos);
    //print_r($datosPersona);
    ?>
</div>
<div id="Div_cuerpoHC" style="width:100%">
    <?php
    $resultadoModulosAfiliacion = $this->nsmModulosPorAfiliacion($datosPersona);
    //traeremos todos los modulos de pediatria
    $resultadoModulos = $this->nsmModulosporServicio($datosPersona);
    //var_dump('<pre>',$datos);exit();
    if ($datos['estado'] == '0004' || $datos['estado'] == '0007') {
        foreach ($resultadoModulos as $key => $value) {
            $vista = $value[1];
            //var_dump('<pre>',$vista);
            if ($vista != '') {
                //var_dump('<pre>',$resultadoModulosAfiliacion);exit();
                foreach ($resultadoModulosAfiliacion as $keyModulo => $valueModulo) {
                    //var_dump('<pre>',$valueModulo);exit();
                    if (in_array($valueModulo[2], $value)) {
                        require_once "modulosHC/$vista";
                    }
                }
            }
        }
    } else {
        ?>
        <div id="Div_HCReciente" style="width:100%; float: left" >
            <div id="divHC" style="width:100%;">
                <!--<div id="divHC_Encabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('divHC_cuerpo');cargarHC();">-->
                <div id="divHC_Encabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('divHC_cuerpo');cargarHC();">
                    <table style="height: auto;width: 100%" class="accordion_title">
                        <tr align="center">
                            <td>
                                <h1>Historia</h1>
                            </td>
                            <td style="width:3%">
                                <img id="divHC_cuerpoicono" src='../../../../fastmedical_front/imagen/icono/desplegar.png' title='desplegar' alt=""/>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="divHC_cuerpo" style="width:100%;height:550px ;display:none;border-style: solid;border-width: 1px">

                </div>
            </div>
            <div id="Div_HCRecienteEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_HCRecienteCuerpo');verHcReciente();">
                <table style="height: auto;width: 100%" class="accordion_title">
                    <tr align="center">
                        <td >
                            <h1>Historia Cl&iacute;nica Reciente</h1>
                        </td>
                        <td style="width:3%">
                            <img id="Div_HCRecienteCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="Div_HCRecienteCuerpo" style="width:100%;display:block;border-style: solid;border-width: 1px; overflow: auto">
                <br><p class="p1 letra12" align="center">Paciente Atendido</p>
                <div id="Div_HCRecienteContenido" style="width: 95%;height: auto;" class="letra12">
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<div id="Div_diagnosticoESSALUD" align="center" style="width:100%; float:left; display:none">
    <?php
    $destinocita = "lstDestinoCitaEssalud";
    $tipocita = "lstTipoCitaEssalud";
    $datos["idTipoDiagnostico"] = '';
// $datos["idTipoDiagnostico"] == '' ? $indSel = '' : $indSel = $datos["idTipoDiagnostico"];
    if ($datos["idTipoDiagnostico"] == '') {
        $indSel = '';
    } else {
        $indSel = $datos["idTipoDiagnostico"];
    }
    $cmbDestinoCita = $this->comboDestinoCitaEssalud($destinocita, $indSel);
    $cmbTipoCita = $this->comboTipoCitaEssalud($tipocita, $indSel);
    ?>
    <table width="85%">
        <tr align="center" style="width: 100%">
            <td width="33%">
                <table width="100%">
                    <tr align="center" style="width: 100%">
                        <td align="left" style="width: auto">Destino de Cita</td>
                        <td style="width: auto"><?php echo $cmbDestinoCita; ?></td>
                    </tr>
                </table>
            </td>
            <td width="33%">
                <table width="100%">
                    <tr align="center" style="width: 100%">
                        <td align="left" style="width: auto">Tipo de Consulta</td>
                        <td style="width: auto"><?php echo $cmbTipoCita; ?></td>
                    </tr>
                </table>
            </td>
            <td width="33%">
               <!-- <table width="100%">
                    <tr align="center" style="width: 100%">
                        <td align="left" style="width: auto">Consulta/Sesion(es)</td>
                        <td style="width: auto"><input id="txtCantidadCitasEssalud" type="text" name="txtCantidadCitasEssalud" value="" size="4" readonly="readonly" /></td>
                    </tr>
                </table>-->
            </td>
        </tr>
    </table>
</div>
<?php
//print_r($datos);
$arrayFechaProximaCita = $this->proximaCitaSugeridaArray($datos);
?>
<div id="Opc_proximaCita" style ="width:100%;float:left">
    <table>
        <tr>
            <td>Pr&oacute;xima Cita Sugerida </td>
            <td>&nbsp;&nbsp;(dd/mm/yyyy)</td>
            <td><input id="txtproximacita" size="10" type="text" readonly="true" onclick="javascript:calendarioHtmlx('txtproximacita')" value="<?php echo $arrayFechaProximaCita[0][0]; ?>"/></td>
<!--            <td><input id="txtproximacita" type="text" readonly="true" onclick="javascript:calendarioHtmlx('txtproximacita')"/></td>
    <td><a href="javascript:calendarioHtmlx('calendar1')"><img id="calendar1" src="../../../../fastmedical_front/imagen/icono/hos_calendar.png" alt=""></a></td>-->
        </tr>
    </table>
</div>
<div id="Div_botones" style="width:100%;height:30px ;float: left">
    <!-- <a href='javascript:;' onclick="javascript:imprimirRecetaAtencion();"><img src='../../../../fastmedical_front/imagen/btn/b_imprimir_on.gif' title='Imprimir Otra Receta' alt=""/></a> -->
<!--    <a href='javascript:;' onclick="javascript:imprimirRecetaUnicaEstandarizada();"><img id="btnImprimirRecetaUnica" src='../../../../fastmedical_front/imagen/btn/ImprimirReceta.png' title='Receta Medica Estandarizada' alt=""/></a>-->
    <a href='javascript:;' onclick="javascript:darxAtencionCompletada();"><img id="btnAtencionCompletada" src='../../../../fastmedical_front/imagen/btn/btn_darPorAtendido.gif' title='Atención Completada' alt=""/></a>
    <a href='javascript:;' onclick="javascript:cancelarAtencionMedica();"><img id="btncancelarActoMedico" src='../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif' title='Cancelar' alt=""/></a>
    <a href='javascript:;' onclick="javascript:regresarAgendaMedica();"><img id="btnregresarActoMedico" src='../../../../fastmedical_front/imagen/btn/b_regresar_on.gif' title='Regresar' alt=""/></a>
<!--    <a href='javascript:;' onclick="javascript:CambiarEstadoNoAtendido();"><img src='../../../../fastmedical_front/imagen/btn/btn_cambiarEstado.gif' title='Cambiar Estado' alt=""/></a>-->
</div>
<input type="hidden" id="hNumeroDiagnostico" name="hNumeroDiagnostico" value="0" />
