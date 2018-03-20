<div id="divContenidoAperturaDeDocumentos">
    <!--<div id="divTablaDatos" style="height: 20%">-->
    <!--<div>&nbsp;</div>-->
    <div id="divTablaDatos" style="height: 30%">
        <div id="divFilaDatosCodigoCajero" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>C&oacute;digo:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtCodPerCajero" name="txtCodPerCajero" value="<?php echo $codPerCajero; ?>" readonly size="10">
            </div>
        </div>

        <div id="divFilaDatosNombreCajero" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Nombre:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtNomCompletoCajero" name="txtNomCompletoCajero" value="<?php echo $nomCompletoCajero; ?>" readonly size="30">
            </div>
        </div>

        <div id="divFilaDatosCodigoCaja" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Caja:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtCodCaja" name="txtCodCaja" value="<?php echo $codCaja; ?>" readonly size="2">
            </div>
        </div>
        
        <div id="divFilaDatosFechaAperturaDocumento" style="clear:left;width:100%">
            <div style="float:left; width:50%;">
                <label>Fecha:</label>
            </div>
            <div style="float:left; width:50%;">
                <input type="text" id="txtFechaActualServidorEnCaja" name="txtFechaActualServidorEnCaja" value="<?php echo $fechaActualServidor; ?>" readonly size="30">
            </div>
        </div>
    </div>
    
    <div id="divFilaDatosComprobante" style="height: 10%">
        <div id="divFilaDatosComprobante" style="clear:left;width:100%;">
            <div style="float:left; width:25%;">
                <label>Comprobante:</label>
            </div>
            <div id="divTipoComprobante" style="float:left; width:25%;">
                <select id="cboTipoComprobante" name="cboTipoComprobante" onchange="cargarDatosCboSerieComprobante();">
                    <?php echo $opcionesCboTipoComprobante; ?>
                </select>
            </div>
            <div style="float:left;">
                <label>Serie:</label>
            </div>
            <div id="divSerieComprobante" style="float:left;">
                <select id="cboSerieComprobante" name="cboSerieComprobante">
                    <?php //echo $opcionesCboSerieComprobante; ?>
                    <option value="00" selected>Seleccionar</option>
                </select>
            </div>
            <div style="float:left;">
                &nbsp; &nbsp; &nbsp;
            </div>
            <div style="float:left;">
                <a href="javascript:agregarTipoComprobante();"><img src="../../../../medifacil_front/imagen/icono/abrir16.png" title="Agregar" alt="Agregar"/></a>
            </div>
            <div style="float:left;">
                &nbsp; &nbsp; &nbsp;
            </div>
            <div id="divRptAgregarTipoComprobante" style="float:left; font-style: italic">Mensajito</div>
        </div>
    </div>
    
    <div id="divTablaTipoComprobantesAperturados" style="overflow:auto; width:99%; height:40%; margin:0px auto;"></div>
    
    <div id="divAccionesyBotonesAperturaDeDocumentos" align="right" style="width: 100%; height: 50px; background: white">
        <div style="float:right;">
            <a href="javascript:salirVentanaTesoreriaAperturaDeDocumentos();">
                <img src="../../../../medifacil_front/imagen/btn/b_Salir.gif" title="Salir" alt="Salir"/>
            </a>
        </div>
    </div>
</div>