<?php if ($numero != 0) { ?>
    <div id="Div_Antecedente_<?php echo $numero; ?>" style="width:85%">

        <fieldset class="examenes" style=" margin:5px; ">
            <legend>Antecedente:</legend>
            <input type="hidden" id="hEstadoAgregar_<?php echo $numero; ?>" value="<?php echo $estadoAntecedente; ?>" >
            <input type="hidden" id="hIdAntecedente_<?php echo $numero; ?>" value="<?php echo $idAntecedente; ?>" >
            <div style="float: right; margin-top: -15px;"  >
                <a href="javascript:;" onclick="javascript:cerrarAntecedente(<?php echo $numero; ?>);">
                    <img src='../../../../fastmedical_front/imagen/icono/borrar.png' alt="Cerrar antecedente">
                </a>
            </div>
            <fieldset style="margin:5px; ">
                <div align="left" style=" margin:2px; ">
                    <b><input id="hcie_<?php echo $numero; ?>" type="hidden" value="<?php echo $idCie; ?>"/> <?php echo $nombreCie; ?></b>
                </div>
            </fieldset>
            <fieldset class="subExamenes" style="margin:5px;">
                <legend>Parentesco:</legend>
                <div align="left" style=" margin:2px; ">
                    <?php
                    //print_r($arrayParentesco);
                    $i = 0;
                    foreach ($arrayParentesco as $fila) {
                        if (count($fila) != 1) {
                            //print_r($fila);
                            ?>
                            <div style=" margin-right:10px; float: left; ">
                                <fieldset style="margin:2px; padding:2px; " >


                                    <input onchange="cambiarAntecedente('<?php echo $numero; ?>');" TYPE=CHECKBOX id="checkParentesco_<?php echo $numero; ?>_<?php echo $fila[0]; ?>" value="<?php echo $fila[2]; ?>" <?php
                if ($fila[2] == 1) {
                    echo 'checked';
                };
                            ?> onclick='if(this.checked){this.value=1}else{this.value=0;}'/>
                                           <?php
                                           echo $fila[1];
                                           if ($i > 0) {
                                               ?>  <input style=" display:none; " onchange="cambiarAntecedente('<?php echo $numero; ?>');" TYPE=CHECKBOX id="checkVive_<?php echo $numero; ?>_<?php echo $fila[0]; ?>" value="<?php echo $fila[3]; ?>" <?php
                        if ($fila[3] == 1) {
                            echo 'checked';
                        };
                                               ?>  onclick='if(this.checked){this.value=1}else{this.value=0;}'/>
                                        <!--                                    vive?-->
                                    <?php } else { ?>
                                        <input onchange="cambiarAntecedente('<?php echo $numero; ?>');" TYPE=hidden id="checkVive_<?php echo $numero; ?>_<?php echo $fila[0]; ?>" value="1" />
                                    <?php } ?>
                                </fieldset>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </fieldset>
            <fieldset class="subExamenes" style="margin:5px; ">
                <legend>Observaci&oacute;n:</legend>
                <div align="left" style=" margin:3px; ">
                    <textarea onchange="cambiarAntecedente('<?php echo $numero; ?>');" id="textObservacion_<?php echo $numero; ?>" style="width:100%; height: 30px;"><?php echo htmlentities(trim($vObservacion)); ?></textarea>
                </div>
            </fieldset>
        </fieldset>

    </div>
    <?php if ($ultimo == 'si') { ?>
        </div>


        <input type="hidden" id="hNumeroAntecedentes" value="<?php echo $numero; ?>" />
    <?php } ?>
<?php } else { ?>
    </div>

    <input type="hidden" id="hNumeroAntecedentes" value="<?php echo $numero; ?>" />
<?php } ?>
