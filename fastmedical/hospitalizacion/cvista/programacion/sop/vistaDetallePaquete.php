<div id="divContenidoDetallePaquete">

    <div id="divResultadoDetallePaquete" style="overflow:auto; width:99%; height:250px; margin: 0px auto;"></div>

    <div style="overflow:auto; width:99%; height:50px; margin: 0px auto;">
        <div style="float:left;">
            <div style="float:left;">
                <input type="radio" name="radTipoAfiliacion" value="0001" onclick="mostrarDetallePaquetePorAfiliacion()" checked>
            </div>
            <div style="float:left;">
                <label>Normal</label>
            </div>
        </div>
        <div style="float:left;">
            <div style="float:left;">
                <input type="radio" name="radTipoAfiliacion" value="0002" onclick="mostrarDetallePaquetePorAfiliacion()">
            </div>
            <div style="float:left;">
                <label>Contribuyente Puntual</label>
            </div>
        </div>
        <div style="float:right;">
            <div style="float:left;">
                <label>Total:</label>
            </div>
            <div style="float:left;">
                <input type="text" id="txtPrecioTotalPaquete" name="txtPrecioTotalPaquete" value="" readonly/>
            </div>
        </div>
    </div>

    <input type="hidden" name="hdnCodSerPro" id="hdnCodSerPro" value="<?php echo $valorHdnCodSerPro; ?>"/>
    <input type="hidden" name="hdnCodTipoAfil" id="hdnCodTipoAfil" value="<?php echo $valorHdnCodTipoAfil; ?>"/>
</div>