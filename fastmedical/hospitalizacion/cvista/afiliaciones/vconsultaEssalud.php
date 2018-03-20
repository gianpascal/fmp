<div id="divContenidoAfiliacionEssalud">
    <div id="divDatosPersonaEssalud" style="height: 12%;">
        <!--<fieldset style="margin: 1px; padding: 0px;">-->
            <legend>Datos de Paciente en HMLO</legend>
            <div style="height: 100%; overflow: auto">
                <?php echo $o_TablaPersonaEssalud; ?>
            </div>
        <!--</fieldset>-->
    </div>
    <br/>
    <br/>
    <div id="divDatosEssalud" style="height: 12%;">
        <!--<fieldset style="margin: 1px; padding: 0px;">-->
            <legend>Datos de Paciente en ESSALUD</legend>
            <div style="height: 100%; overflow: auto">
                <?php echo $o_TablaDatosEssalud; ?>
            </div>
        <!--</fieldset>-->
    </div>
    <br/>
    <br/>
    <div id="divCabeceraCartaEssalud" style="height: 12%;">
        <!--<fieldset style="margin: 1px; padding: 0px;">-->
            <legend>Carta de Paciente</legend>
            <div style="height: 100%; overflow: auto">
                <?php echo $o_TablaCabeceraCartaEssalud; ?>
            </div>
        <!--</fieldset>-->
    </div>
    <br/>
    <br/>
    <div id="divDetalleCartaEssalud" style="height: 20%;">
        <!--<fieldset style="margin: 1px; padding: 0px;">-->
            <legend>Detalle Carta de Paciente</legend>
            <div style="height: 100%; overflow: auto">
                <?php echo $o_TablaDetalleCartaEssalud; ?>
            </div>
        <!--</fieldset>-->
    </div>
    <br/>
    <br/>
    <div id="divMensajeAfiliacionEssalud" style="height: 10%;">
        <!--<fieldset style="margin: 1px; padding: 0px;">-->
            <legend>Mensaje</legend>

            <?php
                if($accionEssalud==0){
                    echo "<h2><font color=\"red\">".$msjAfiliacionEssalud."</font></h2>";
                }
                else{
                    echo "<h2><font color=\"blue\">".$msjAfiliacionEssalud."</font></h2>";
                }
            ?>

            <input type="hidden" id="hdnAccionEssalud" value="<?php echo $accionEssalud; ?>"/>
            <input type="hidden" id="hdnIdCarta" value="<?php echo $idCarta; ?>"/>
            <input type="hidden" id="hdnIdDetalleCarta" value="<?php echo $idDetalleCarta; ?>"/>
        <!--</fieldset>-->
    </div>
</div>