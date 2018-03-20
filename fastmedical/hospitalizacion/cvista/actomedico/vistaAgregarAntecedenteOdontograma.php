<input type="hidden" id="idAntecedenteOdontograma_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>"  value="<?php echo $datos['iIdHistoriaDiente']; ?>"/>
<input type="hidden" id="estadoAntecedenteOdontograma_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>"  value="2"/>
<fieldset id="antecedenteOdontograma_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="border:2px solid #1B843C">
    <legend>&ThinSpace;&ThinSpace; Antecedente o Procedimiento <?php echo $datos["numeroAntecedenteOdontograma"] + 1; ?>&ThinSpace;&ThinSpace;</legend>
    <form>
        <div style="float: left; width: 550px; padding: 10px; ">
            <div style=" width: 680px; float: left">
                <div style="float: left; margin-right:5px;font-size:12px; ">Practica y/o Antecedente </div>
                <div style="float: left">
                    <input id="txtAntecedenteId_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="hidden" name="" value="<?php echo $datos["idAntecedenteOdontograma"]; ?>" style="width:20px " />
                    <input id="txtAntecedenteNombre_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="text" name="" value="<?php echo $datos["nombreAntecedenteOdontograma"]; ?>" style="width:400px "disabled="false" />
                    <input type="button" onclick="ventanaDiagnosticoDiente(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" value="..." style="cursor: pointer;display:none;"  >
                </div>

            </div>
            <div style=" width: 680px; float: left; margin: 10px;">
                <div style="float: left; margin-right:5px;font-size:12px;">Diente 1 </div>
                <div style="float: left; margin-right:5px;">
                    <input type="hidden" id="txt_idDiente1_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["idDiente1"]; ?>" value="" style="width:30px " />
                    <input type="text" id="txt_binario1_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["binario1"]; ?>" value="" style="width:30px;" disabled="false" />
                </div>
                <div style="float: left; margin-right:5px;font-size:12px;">Diente 2 </div>
                <div style="float: left; margin-right:20px;">
                    <input type="hidden" id="txt_idDiente2_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["idDiente2"]; ?>" value="" style="width:30px " />
                    <input type="text" id="txt_binario2_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["binario2"]; ?>" value="" style="width:30px " disabled="false"/>

                </div>
                <div style="float: left; margin-right:5px;font-size:11px;<?php if ($datos["bEsTercero"] == 0 ){echo 'display:none;';}?>">Realizado Por Tercero</div>
                <div style="float: left; margin-right:5px;">
                    
                    <select onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" name="" id="tercero_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="font-size:14px;<?php if ($datos["bEsTercero"] == 0 ){echo 'display:none;';}?>">
                        <option value='' <?php
if ($datos["bTercero"] == '') {
    echo 'selected';
};
?> >Seleccionar</option>
                        <option value="1" <?php
                                if ($datos["bTercero"] == '1') {
                                    echo 'selected';
                                };
?> >Si</option>
                        <option value="0" <?php
                                if ($datos["bTercero"] == '0') {
                                    echo 'selected';
                                };
?> >No</option>
                    </select>
                </div>
                <div id="divEstado_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="<?php
                                if ($datos["iColorsimbolo"] != '3') {
                                    echo 'display: none;';
                                };
?>" >
                    <div style="float: left; margin-right:5px;">Estado</div>
                    <div style="float: left; margin-right:5px;">
                        <select onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" id="selectestado_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" name="" >
                            <option value="" <?php
                     if ($datos["iEstado"] == '') {
                         echo 'selected';
                     };
?>>Seleccionar</option>
                            <option value="1" <?php
                                    if ($datos["iEstado"] == '1') {
                                        echo 'selected';
                                    };
?>>Bueno</option>
                            <option value="0" <?php
                                    if ($datos["iEstado"] == '0') {
                                        echo 'selected';
                                    };
?>>Malo</option>
                        </select>
                        <input type="hidden" id="colorSimbolo_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["iColorsimbolo"]; ?>" />
                    </div>
                </div>
            </div>

            <?php
            $bit = "none";
            if ($datos["bCaras"] == 1) {
                $bit = "none";
            } else {
                $bit = "hidden";
            }
            ?>


            <fieldset style="float: left;padding:5px;visibility:<?php echo $bit; ?>;width:600px;" >
                <legend>Caras</legend>

                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px">
                        Mesial
                        <input id="Mesial<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON"  <?php
            if ($datos["mesial"] == '1' && $datos["bCaras"] == 1) {
                echo 'checked';
            };
            ?> onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)"/>

                    </fieldset>

                </div>
                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px">
                        Oclusal o Incisal
                        <input onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" id="Incisal<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON" <?php
                               if ($datos["oclusal"] == '1'&& $datos["bCaras"] == 1) {
                                   echo 'checked';
                               };
            ?> />
                    </fieldset>

                </div>
                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px">
                        Distal
                        <input  onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" id="Distal<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON" <?php
                               if ($datos["distal"] == '1'&& $datos["bCaras"] == 1) {
                                   echo 'checked';
                               };
            ?>/>
                    </fieldset>

                </div>
                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px">
                        Vestibular
                        <input  onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" id="Vestibular<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON" <?php
                                if ($datos["vestibular"] == '1'&& $datos["bCaras"] == 1) {
                                    echo 'checked';
                                };
            ?>/>
                    </fieldset>

                </div>
                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px"> 
                        Lingual
                        <input onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)"  id="Lingual<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON" <?php
                                if ($datos["lingual"] == '1'&& $datos["bCaras"] == 1) {
                                    echo 'checked';
                                };
            ?>/>
                    </fieldset>

                </div>
                <div style="float: left; margin-right:5px;padding:5px;">
                    <fieldset style="border:0px"> 
                        Palatina
                        <input onChange="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)"  id="Palatina<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" type="checkbox" name="" value="ON" <?php
                               if ($datos["palatino"] == '1'&& $datos["bCaras"] == 1) {
                                   echo 'checked';
                               };
            ?>/>
                    </fieldset>

                </div>


            </fieldset>

        </div>
        <div style="float: left; width: 20px;border:0px solid black" ><br></div>
        <div style="float: left; width: 20px;border:0px solid black" ><br></div>
        <div style="float: left; width: 20px;border:0px solid black" ><br></div>
        <div style="float: left; width: 20px;border:0px solid black" ><br></div>
        <div style="float: left; width: 120px;border:0px solid black" >
            <div style="float: left">Observaciones </div>
            <div style="float: left">
                <textarea id="observaciones_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" onBlur="grabarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>)" name="" style="height: 111px;width: 128px;" ><?php echo $datos["observacion"]; ?></textarea>


            </div>
        </div>
        <div style="float: left; width: 20px;border:0px solid black" ><br></div>
    </form>
    <?php
    if (isset($datos['urlImagen'])) {
        if ($datos['urlImagen'] != "") {
            ?>
            <div id="divContenedorUpload<?php echo $datos["numeroAntecedenteOdontograma"]; ?>"style="float: left;border:0px solid black;width:160px;">
                <div  id="button<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" onmouseout="this.style.background='#C2DB76';" onmouseover="this.style.background='yellow'" style="visibility:hidden;float: left;border: 1px solid black; width:28px; height: 23px; background: none repeat scroll 0% 0% #C2DB76; color: white;padding-top:8px;cursor:pointer " onclick="adjuntarFotoOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>);">
                    <img src="../../../../medifacil_front/imagen/icono/adjunto.gif">
                </div>
                <div id="adjuntarFotoOdontograma<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

                </div>
                <div id="Vista<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

                    <?php
                    $url = explode("/", $datos['urlImagen']);
                    $o_ActionActoMedico = new ActionActoMedico();
                    echo $o_ActionActoMedico->mostrarImagenOdontograma($url[6], $datos['urlImagen'], $datos["numeroAntecedenteOdontograma"], $datos['iVersion']);
                    //echo $url[6];
                    ?>
                </div>
            </div>
        <?php } else {
            ?>
            <div id="divContenedorUpload<?php echo $datos["numeroAntecedenteOdontograma"]; ?>"style="float: left;border:0px solid black;width:160px;">
                <div  id="button<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" onmouseout="this.style.background='#C2DB76';" onmouseover="this.style.background='yellow'" style="visibility:visible;float: left;border: 1px solid black; width:28px; height: 23px; background: none repeat scroll 0% 0% #C2DB76; color: white;padding-top:8px;cursor:pointer " onclick="adjuntarFotoOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>);">
                    <img src="../../../../medifacil_front/imagen/icono/adjunto.gif">
                </div>
                <div id="adjuntarFotoOdontograma<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

                </div>
                <div id="Vista<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

                </div>
            </div>


            <?php
        }
    } else {
        ?>
        <div id="divContenedorUpload<?php echo $datos["numeroAntecedenteOdontograma"]; ?>"style="float: left;border:0px solid black;width:160px;">
            <div  id="button<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" onmouseout="this.style.background='#C2DB76';" onmouseover="this.style.background='yellow'" style="visibility:visible;float: left;border: 1px solid black; width:28px; height: 23px; background: none repeat scroll 0% 0% #C2DB76; color: white;padding-top:8px;cursor:pointer " onclick="adjuntarFotoOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>);">
                <img src="../../../../medifacil_front/imagen/icono/adjunto.gif">
            </div>
            <div id="adjuntarFotoOdontograma<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

            </div>
            <div id="Vista<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" style="float: left;border:0px solid;width:100px;height:25px;">

            </div>
        </div>

    <?php }
    ?>



    <input type="hidden" id="idSimbolo_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["idSimboloGrafico"]; ?>" />
    <input type="hidden" id="px_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["px"]; ?>" />
    <input type="hidden" id="py_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["py"]; ?>" />
    <input type="hidden" id="ancho_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["ancho"]; ?>" />
    <input type="hidden" id="alto_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["alto"]; ?>" />
    <input type="hidden" id="dientesAfectados_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" value="<?php echo $datos["dientesAfectados"]; ?>" />


    <div style="float: right; margin-top: -15px;">
        <a onclick="javascript:cerrarAntecedenteOdontograma(<?php echo $datos["numeroAntecedenteOdontograma"]; ?>);" href="javascript:;">
            <img title="Cerrar" alt="Cerrar" src="../../../../medifacil_front/imagen/icono/borrar.png">
        </a>
    </div>
</fieldset>
<iframe style="display:none;" src="" name="iframe">
</iframe>
