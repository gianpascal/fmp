<?php
$resultado = $this->datosMuestra($datos["idPacienteLaboratorio"]);

?>
<div style="padding:15px;">
    <fieldset>
        <legend> Datos Muestra del Paciente</legend>
        <div style="padding:15px;">
            <div class="filaMuestra" >
                <div class="labelMuestra">
                    <b> Tipo Muestra:</b> 
                </div>
                <div class="inputMuestra">
                    <?php echo $resultado[0][0]; ?>
                </div>
            </div>
            <div class="filaMuestra" >
                <div class="labelMuestra">
                    <b> Tipo Unidad Medida: </b>
                </div>
                <div class="inputMuestra">
                    <?php echo $resultado[0][1]; ?>
                </div>
            </div>
            <div class="filaMuestra" >
                <div class="labelMuestra">
                    <b>Unidad Medida: </b>
                </div>
                <div class="inputMuestra">
                    <?php echo $resultado[0][2]; ?>
                </div>
            </div>
            <div class="filaMuestra" >
                <div class="labelMuestra">
                    <b> Cantidad Mínima:</b> 
                </div>
                <div class="inputMuestra">
                    <?php echo $resultado[0][3] . " " . $resultado[0][2]; ?>
                </div>
            </div>
            <div class="filaMuestra" >
                <div class="labelMuestra">
                    <b>Cantidad Máxim 0: </b>
                </div>
                <div class="inputMuestra">
                    <?php echo $resultado[0][4] . " " . $resultado[0][2]; ?>
                </div>
            </div>
        </div>
    </fieldset>
</div>