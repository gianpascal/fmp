<?php
$quinceDias = time() + 15 * 24 * 60 * 60;
$quinceDias = date("d/m/Y", $quinceDias);
if ($datos["codigoProducto"] == '0000000') {
    $otros = 1;
} else {
    $otros = 0;
}
if ($datos["existe"] == 0) {
    ?>    

    <fieldset id="divReceta_<?php echo $datos["nroReceta"]; ?>" class="examenes" style="width: 1000px; height: auto; ">
        <legend>Receta <?php echo $datos["nroReceta"]; ?></legend>
        <div style="height: 20px">
            <div style="float: left; margin-left:50px; ">Valido Por:</div>
            <div style="float: left; "><input type="text" value="15" id="diasValidos_<?php echo $datos["nroReceta"]; ?>" style="width:30px; " onchange="javascript:calcularFechaValidez('<?php echo $datos["nroReceta"]; ?>')"  /> dias</div>
            <div style="float: left; margin-left:50px;">Valido hasta:</div>
            <div style="float: left;"><input type="text" readonly="" value="<?php echo $quinceDias; ?>" id="fechaVencimiento_<?php echo $datos["nroReceta"]; ?>"  style="width:100px; "  onclick="javascript:calendarioFechaVencimiento('<?php echo $datos["nroReceta"]; ?>')" /> </div>
            <div style=" margin-left:50px; margin-top:-6px; width: 100px; float: left; height: 20px;">
                <a href="javascript:;" onclick="javascript:duplicarReceta(<?php echo $datos["nroReceta"] ?>);">
                    <img src='../../../../medifacil_front/imagen/btn/b_duplicar_on.gif' alt="" />
                </a>
            </div>
            <div style=" margin-left:300px; margin-top:-6px;  width: 100px; float: left; height: 20px;">
                <a href="javascript:;" onclick="javascript:eliminarReceta(<?php echo $datos["nroReceta"] ; ?>);">
                    <img src='../../../../medifacil_front/imagen/btn/b_anular_on.gif' alt="" />
                </a>
            </div>


            <input id="hNumeroProductos_<?php echo $datos["nroReceta"]; ?>" type="hidden" value="1" />
            <input id="hreceta_<?php echo $datos["nroReceta"]; ?>" type="hidden" value='0' />
            <input id="hAgregados_<?php echo $datos["nroReceta"]; ?>" type="hidden" value='' />
        </div>
        <div>

            <div style=" border:solid 1px;  background-image:url(../../../estilo/imgs/dhxgrid_dhx_blue/hdr.png);font-family: Tahoma;font-size: 11px;width: 1000px;">
                <table width="1000px" border="0" style="border:solid 1px; ">
                    <tr align="center">
                        <td width="400px">Medicamento o Insumo / Concentraci&oacute;n</td>
                        <td width="140px">Presentaci&oacute;n</td>
                        <td width="100px">Cantidad Total</td>
                        <td width="300px">Dosis / Frecuencia / Via Administ. / Duracion Tratamiento</td>
                        <td width="60px">Eliminar</td>
                    </tr>
                </table>
            </div>

        </div>
    <?php } ?>
    <div id="divProducto_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" style=" height:35px;  font-family: Tahoma;font-size: 11px; border: 0.5px solid #87A57E; ">
        <div align="left"  style="float: left; width:400px; height: 35px; ">
            <input type="hidden" id="hcodigoProducto_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" value="<?php echo $datos["codigoProducto"]; ?>" />
            <input type="hidden" id="hIdTratamiento_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" value="0" />
            <?php
            if ($otros == 0) {
                echo $datos["nombreproducto"];
            } else {
                ?>
                <input  type="text" style=" width:300px; margin-top:5px; " id="hOtros_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" 
                        value="<?php echo $datos["nombreproducto"]; ?>" onchange="javascript:preguardarRectaMedica('<?php echo $datos["nroReceta"]; ?>','<?php echo $datos["numeroProducto"]; ?>')" />
                        <?php
                    }
                    ?>

        </div>
        <div style="float: left; width:140px; height: 35px; ">

            <?php
            if ($otros == 0) {
                echo $datos["presentacion"];
            } else {
                ?>
                <input type="text" style="width:100px; margin-top:5px;" id="hOtrosPresentacion_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" 
                       value="<?php echo $datos["presentacion"]; ?>" onchange="javascript:preguardarRectaMedica('<?php echo $datos["nroReceta"]; ?>','<?php echo $datos["numeroProducto"]; ?>')" />
                       <?php
                   }
                   ?>
        </div>
        <div style="float: left; width:100px; height: 35px; ">
            <input id="cantidad_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" type="text" 
                   style="width: 50px; margin-top:5px; "  onchange="javascript:preguardarRectaMedica('<?php echo $datos["nroReceta"]; ?>','<?php echo $datos["numeroProducto"]; ?>')" 
                   onkeypress="return validFormSalt('nro',this,event,'dosis_<?php echo $datos["nroReceta"] . "_" . $datos["numeroProducto"]; ?>')"  />
        </div>
        <div style="float: left; width:300px; height: 35px; ">
            <textarea id="dosis_<?php echo $datos["nroReceta"]; ?>_<?php echo $datos["numeroProducto"]; ?>" 
                      style="height:30px; width: 290px " onchange="javascript:preguardarRectaMedica('<?php echo $datos["nroReceta"]; ?>','<?php echo $datos["numeroProducto"]; ?>')"  ></textarea>
        </div>
        <div style="float: left; width:58px; height: 20px; ">
            <a href="javascript:;" onclick="javascript:eliminarMedicamentoHC(<?php echo $datos["nroReceta"] . ',' . $datos["numeroProducto"]; ?>,1);"><img src='../../../../medifacil_front/imagen/icono/borrar.png' alt=""></a>
        </div>

    </div>


    <?php if ($datos["existe"] == 0) { ?>  
    </fieldset>

<?php } ?>