<?php
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
//$variable = 0;
?>

<input type="hidden" id="cadenaItem" />
<input type="hidden" id="hfuncionCerrar" name="hfuncionCerrar" value="<?php echo $funcionCerrar; ?>">

<div id="divContenidoFacturacionOrdenPaciente">
    <!--<div id="divTablaDatos" style="height: 20%">-->
    <div id="divTablaDatosPaciente" style="clear:both;">
        <div id="divFilaDatosPaciente" style="clear:left;width:100%">
            <div style="float:left; width:30%;">
                <label>Paciente:</label>
            </div>
            <div style="float:left; width:70%;">
                <input type="text" id="txtCodPerPacienteDeFacturacion" name="txtCodPerPacienteDeFacturacion" value="<?php echo $codPerPaciente; ?>" readonly style="width: 60px;" >
                <input type="text" id="txtTipoDocPacienteDeFacturacion" name="txtTipoDocPacienteDeFacturacion" value="<?php echo $arrayDatosPersona['0']['vTipoDocumento']; ?>" readonly style="width: 40px;">
                <input type="text" id="txtNroDocPacienteDeFacturacion" name="txtNroDocPacienteDeFacturacion" value="<?php echo $arrayDatosPersona['0']['vNumeroDocumento']; ?>" readonly style="width: 80px;">
                <input type="text" id="txtNomPerPacienteDeFacturacion" name="txtNomPerPacienteDeFacturacion" value="<?php echo $arrayDatosPersona['0']['nombreCompleto']; ?>" readonly size="40">
            </div>
            <input type="hidden" id="hdncTipoDocumento" name="hdncTipoDocumento" value="<?php echo $arrayDatosPersona['0']['cTipoDocumento']; ?>" >
            <input type="hidden" id="hdnNroOrdenCompra" name="hdnNroOrdenCompra" value="<?php echo $nroOrdenCompra; ?>">
            <input type="hidden" id="hdnCodCajaFacturacion" name="hdnCodCajaFacturacion"t value="<?php echo $codCajaFacturacion; ?>">
            <input type="hidden" id="hdnTipoIgv" name="hdnTipoIgv" value="<?php echo $tipoIgv; ?>">
            <input type="hidden" id="hdnSerie" name="hdnSerie" value="<?php echo $vSerie; ?>">
        </div>

    </div>

    <div id="divTablaDatosComprobante" style="clear:both;">
        <div style="clear:left;width:100%">
            <div style="float:left; width:30%;">
                <label>Comprobante:</label>
            </div>
            <div style="float:left; width:70%;">
                <select id="cboTipoComprobanteFacturacion" style="width: 120px;" name="cboTipoComprobanteFacturacion" onchange="actualizaNumeroSerie()" >
                    <?php echo $opcionesCboTipoComprobanteFacturacion; ?>
                </select>
                <input type="text" id="txtNroComprobanteFacturacion" style="width: 100px;"
                       name="txtNroComprobanteFacturacion" value="<?php echo $nroComprobanteFacturacion; ?>" >
            </div>
        </div>
        <div style="clear:left;width:100%">
            <div style="float:left; width:30%;">
                <label>Fecha de Emisión:</label>
            </div>
            <div style="float:left">
                <input type="text" id="txtFechaEmisionComprobanteFacturacion" style="width: 100px;"
                       name="txtFechaEmisionComprobanteFacturacion" 
                       onclick="calendarioHtmlx('txtFechaEmisionComprobanteFacturacion');" onblur="esFechaValida(this);"
                       value="<?php echo $fechaActualServidor; ?>" >
            </div>
            <div style="float:left;">
                &nbsp; &nbsp; &nbsp;
            </div>
            <div style="float:left;">
                <label>Forma de Pago:</label>
            </div>
            <div style="float:left;">
                <select id="cboFormaPagoComprobanteFacturacion" name="cboFormaPagoComprobanteFacturacion" onchange="" >
                    <?php echo $opcionesCboFormaPagoComprobanteFacturacion; ?>
                </select>
            </div>
        </div>
    </div>

    <div id="divTablaProductoServicioComprobanteFacturacion" style="overflow:auto; width:99%; height:40%; margin:0px auto;"></div>

    <div id="divInferior" style="width:99%; height:25%; clear:both;">
        <div id="divLeyendaComprobanteFacturacion" style="margin:5px; height:20px; float:left; clear:both;">
            <table class="tablaOrden" >
                <tr>
                    <td >Leyenda:</td>
                    <td style="background-color:#BDBDBD;color:#000000;">Anulado</td>
                    <td class="e5">Pendiente</td>
                    <td class="e4">Atendido -- Atendido con carta</td>
                    <td class="e2">Cancelado P. -- Pagado</td>
                    <td class="e3">Cancelado A. -- Pagado atendido</td>
                    <td style="background-color:#9FF781;color:#000000;">Nota de C.</td>
                </tr>
            </table>
        </div>
        <div style="clear:left;width:100%">
            <div style="float:left; width:25%;">
                <div style="float:left; clear:both">
                    <label>Glosa:</label>
                </div>
                <div style="float:left">
                    <textarea id="txaGlosaComprobanteFacturacion" rows="5" cols="20" style="overflow:auto;"></textarea>
                </div>
            </div>
            <div style="float:left; width:75%;">
                <div id="divFila1" style="width:100%;">
                    <div style="width: 25%; float: left;">
                        Op. Gravada
                    </div>
                    <div style="width: 25%; float: left;">
                        IGV - 18%
                    </div>
                    <div style="width: 25%; float: left;">
                       Importe Total
                    </div>
                    <div style="width: 25%; float: left;">
                        Efectivo
                    </div>
                </div>
                <div id="divFila2" style="width:100%;">
                    <div style="width: 25%; float: left;">
                        <input type="text" id="txtOperacionGravada" name="txtOperacionGravada" size="7" readonly />
                    </div>
                    <div style="width: 25%; float: left;">
                        <input type="text" id="txtIGV" name="txtIGV" style="background-color: yellow;" size="7" value="0" readonly />
                    </div>
                    <div style="width: 25%; float: left;">
                        <input type="text" id="txtImporteTotal" name="txtImporteTotal" size="7" readonly />
                    </div>
                    <div style="width: 25%; float: left;">
                        <input type="text" id="txtEfectivo" name="txtEfectivo" style="background-color: yellow;" size="7" value="0" />
                    </div>
                </div>
                <div id="divFila3" style="width:100%;">
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        Vuelto
                    </div>
                </div>
                <div id="divFila4" style="width:100%;">
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="width: 25%; float: left;">
                        <input type="text" id="txtVuelto" name="txtVuelto" style="background-color: yellow;" size="7" value="0" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="divAccionesyBotonesProdServSeleccionado" align="right" style="width: 100%; height: auto; background: white; clear:both;">
        <div style="float:right;">
            <div style="float: left;">

                <?php
                $toolbar1->SetBoton("pagarOrden", "Pagar", "btn", "onclick,onkeypress", "cancelarMontoComprobanteFacturacion()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/monedas.jpg", "", "", 1);
                $toolbar1->Mostrar();
                ?>
<!--<input type="button" id="btnCancelarMontoComprobanteFacturacion" name="btnCancelarMontoComprobanteFacturacion" value="Cancelar Monto" onclick="verificarCajaNoCerrada();">-->
            </div>
            <div style="float: left;">
                &nbsp; &nbsp; &nbsp;
            </div>
            <div style="float: left;">
                <!--<a href="javascript:salirVentanaFacturacionOrdenPaciente();">
                    Salir<img src="../../../../medifacil_front/imagen/icono/salir.gif" title="Salir" alt="Salir"/>
                </a>-->
                 <?php
                $toolbar2->SetBoton("salirPago", "Salir", "btn", "onclick,onkeypress", "salirVentanaFacturacionOrdenPaciente()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/salir.gif", "", "", 1);
                $toolbar2->Mostrar();
                ?>
                
                <!--<input type="button" id="btnSalirFacturacionOrdenPaciente" name="btnSalirFacturacionOrdenPaciente" value="Salir" onclick="salirVentanaFacturacionOrdenPaciente()">-->
            </div>
        </div>
    </div>
</div>