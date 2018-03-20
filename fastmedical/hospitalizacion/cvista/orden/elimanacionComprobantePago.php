<?php echo $_SESSION["c_id_caja"] ?>

<input type="hidden" id="cadenaItem" />
<input type="hidden" id="hfuncionCerrar" name="hfuncionCerrar" value="<?php echo $funcionCerrar; ?>">


<!--<div id="divTablaDatos" style="height: 20%">-->
<div id="divTablaDatosPaciente" style="clear:both;">
    <div id="divFilaDatosPaciente" style="clear:left;width:100%">
        <div style="float:left; width:50%;">
            <label>Paciente:</label>
        </div>
        <div style="float:left; width:50%;">
            <input type="text" id="txtCodPerPacienteDeFacturacion" name="txtCodPerPacienteDeFacturacion" value="<?php echo $datos["codigoEmpleado"]; ?>" readonly size="10">
            <input type="text" id="txtNomPerPacienteDeFacturacion" name="txtNomPerPacienteDeFacturacion" value="<?php echo $datos["nomPerDeOrdenGenerada"] ; ?>" readonly size="40">
        </div>
        <input type="hidden" id="hdnNroOrdenCompra" name="hdnNroOrdenCompra" value="<?php echo $nroOrdenCompra; ?>">
        <input type="hidden" id="hdnCodCajaFacturacion" name="hdnCodCajaFacturacion" value="<?php echo $codCajaFacturacion; ?>">
        <input type="hidden" id="hNumeroComprobante" name="hNumeroComprobante" value="<?php echo  $datos["numeroComprobante"]; ?>">
    </div>
    <div id="divFilaDatosDNI" style="clear:left;width:100%">
        <div style="float:left; width:50%;">
            <!--<label>DNI:</label>-->
            <label>Documento:</label>
        </div>
        <div style="float:left; width:50%;">
            <input type="text" id="txtNroDNIPacienteDeFacturacion" name="txtNroDNIPacienteDeFacturacion" value="<?php echo $datos["dniPaciente"]; ?>" readonly size="10">
        </div>
    </div>
</div>

<div id="divTablaDatosComprobante" style="clear:both;">
    <div style="clear:left;width:100%">
        <div style="float:left; width:50%;">
            <label>Comprobante:</label>
        </div>
        <div style="float:left; width:50%;">
            <select id="cboTipoComprobanteFacturacion" name="cboTipoComprobanteFacturacion" onchange="" disabled>
                <?php echo $opcionesCboTipoComprobanteFacturacion; ?>
            </select>
            <input type="text" id="txtCodSerieComprobanteFacturacion" name="txtCodSerieComprobanteFacturacion" value="<?php echo $codSerieComprobanteFacturacion; ?>" readonly size="5">
            <input type="text" id="txtNroComprobanteFacturacion" name="txtNroComprobanteFacturacion" value="<?php echo $nroComprobanteFacturacion; ?>" readonly size="10">
        </div>
    </div>
    <div style="clear:left;width:100%">
        <div style="float:left; width:50%;">
            <label>Fecha de Emisi&oacute;n:</label>
        </div>
        <div style="float:left">
            <input type="text" id="txtFechaEmisionComprobanteFacturacion" name="txtFechaEmisionComprobanteFacturacion" value="<?php echo $fechaActualServidor; ?>" readonly size="10">
        </div>
        <div style="float:left;">
            &nbsp; &nbsp; &nbsp;
        </div>
        <div style="float:left;">
            <label>Forma de Pago:</label>
        </div>
        <div style="float:left;">
            <select id="cboFormaPagoComprobanteFacturacion" name="cboFormaPagoComprobanteFacturacion" onchange="" disabled>
                <?php echo $opcionesCboFormaPagoComprobanteFacturacion; ?>
            </select>
        </div>
    </div>
    <DIV style="clear:inherit;width:100%">
        <table border="1">
            <tr>
                <td>
                    <label>NUMERO COMPROBANTE:</label>
                </td>
                <td><font size="4" style="color: red"><?php echo $datos["numeroComprobante"] ?> </font></td>
                <td><font size="4" style="color: red"><?php echo $res[0][1] ?> </font></td>
            </tr>
        </table>

    </DIV>
</div>


<div id="divTablaProductoServicioComprobanteFacturacionx" style="overflow:auto; width:99%; height:40%; margin:0px auto;"></div>

<div align="right">
    <table>
        <tr>
            <td>
                <font size="4" style="color: red">TOTAL:&nbsp;&nbsp; </font>
            </td>
            <td><font size="4" style="color: blue"><?php echo $res[0][0] ?> </font></td>
            <td>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</td>
        </tr>
    </table>
</div>


<div id="divInferior" style="width:99%; height:25%; clear:both;">

    <div id="divAccionesyBotonesProdServSeleccionadox" align="right" style="width: 100%; height: auto; background: white; clear:both;">
        <div style="float:right;">
            <div style="float: left;">
                <a href="javascript:anularComprobanteDePago(<?php echo $datos["numeroComprobante"] ?>,<?php echo $datos["codigoEmpleado"].''; ?>);"
                   style="border: red; border-color: red;background-color: red;background: red">
                    <img src="../../../../medifacil_front/imagen/icono/anularComprobante.png" title="Anular" alt="Anular" border="1" 
                         style="border: red;border-bottom-color: red; background-color: red;background-image: inherit;color: red
                         ;background-image: url" />
                </a>
            </div>
            <div style="float: left;">
                &nbsp; &nbsp; &nbsp;
            </div>
            <div style="float: left;">
                <a href="javascript:imprimirComprobante('<?php echo $datos["numeroComprobante"] ?>','<?php echo $datos["codigoEmpleado"]; ?>');">
                    <img src="../../../../medifacil_front/imagen/btn/Imprimir Receta.gif" title="Imprimir" alt="Imprimir"/>
                </a>
            </div>
            <div style="float: left;">
                <a href="javascript:salirVentanaAnulacionResibo();">
                    <img src="../../../../medifacil_front/imagen/btn/b_Salir.gif" title="Salir" alt="Salir"/>
                </a>
            </div>
            <div style="float: left;">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            </div>

        </div>
    </div>
</div>