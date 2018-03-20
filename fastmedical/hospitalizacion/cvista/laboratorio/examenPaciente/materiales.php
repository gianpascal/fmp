
<?php
$resultadoMateriales = $this->datosFraccion($iIdPacienteLaboratorioPuntoControl);
//print_r($resultadoMateriales);
//echo 'jose';
if (count($resultadoMateriales) > 0) {
    foreach ($resultadoMateriales as $valueMateriales) {
        if ($valueMateriales[7] == '') {
            $iidPacientePuntoControlMateriales = $this->aInsertaPacienteLaboratoriPuntoControl($valueMateriales[8], $valueMateriales[9], $valueMateriales[3]);
            $cantidad = $valueMateriales[6];
        } else {
            $iidPacientePuntoControlMateriales = $valueMateriales[7];
            $cantidad = $valueMateriales[3];
        }
        ?>

        <div style="padding:15px; float:left;width: 550px;">
            <fieldset>
                <legend>Materiales</legend>
                <div style="padding:15px;">
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Nombre Material:</b> 
                        </div>
                        <div class="inputMateriales">
                            <?php echo $valueMateriales[0]; ?>
                        </div>
                    </div>
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Tipo Unidad:</b> 
                        </div>
                        <div class="inputMateriales">
                            <?php echo $valueMateriales[1]; ?>
                        </div>
                    </div>
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Unidad Medida:</b> 
                        </div>
                        <div class="inputMateriales">
                            <?php echo $valueMateriales[2]; ?>
                        </div>
                    </div>
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Cantidad Minima</b> 
                        </div>
                        <div class="inputMateriales">
                            <?php echo $valueMateriales[3]; ?>
                        </div>
                    </div>
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Cantidad Máxima</b> 
                        </div>
                        <div class="inputMateriales">
                            <?php echo $valueMateriales[4]; ?>
                        </div>
                    </div>
                    <div class="filaMateriales" >
                        <div class="labelMateriales">
                            <b> Cantidad Utilizada</b> 
                        </div>
                        <div class="inputMateriales">
                            <input onkeyup='validaDecimal(event,this,"");' readonly="true" name="<?php echo $iidPacientePuntoControlMateriales; ?>" id="material_<?php echo $iidPacientePuntoControlMateriales; ?>" type="text"  value="<?php echo $valueMateriales[6]; ?>" style="width:45px;" />
                            <a href="javascript:editarMaterialPersona(<?php echo $iidPacientePuntoControlMateriales; ?>);">
                                <img id="iconoEditarMaterial_<?php echo $iidPacientePuntoControlMateriales; ?>" border="0" src="../../../../medifacil_front/imagen/icono/editar.png" alt="" title="editar" />
                            </a>
                            <a href="javascript:modificarMaterialPersona(<?php echo $iidPacientePuntoControlMateriales; ?>);">
                                <img style="display: none;" id="iconoGrabarMaterial_<?php echo $iidPacientePuntoControlMateriales; ?>" border="0" src="../../../../medifacil_front/imagen/icono/grabar.png" alt="" title="Guardar" />
                            </a>
                            <a href="javascript:cancelarMaterialPersona(<?php echo $iidPacientePuntoControlMateriales; ?>);">
                                <img style="display: none;" id="iconoCancelarMaterial_<?php echo $iidPacientePuntoControlMateriales; ?>" border="0" src="../../../../medifacil_front/imagen/icono/cancel.png" alt="" title="cancelar" />
                            </a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div style="padding:30px; float:left;width: 120px; height: 180px;">
            <fieldset> 
                <legend>Foto</legend>
                <center>
                    <img src="<?php echo $valueMateriales[5]; ?>" style="width: 100; height: 150px;">
                </center>
            </fieldset>
        </div>
        <?php
    }
}
?>
