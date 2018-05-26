<?php
$cboEstado = array(1 => "Activar", 0 => "Desactivar");
$toolbar1_1 = new ToollBar("right");
$toolbar1_2 = new ToollBar("right");
$toolbar1_3 = new ToollBar("right");
$toolbar1_4 = new ToollBar("right");
$toolbar1_5 = new ToollBar("right");
?>
<div  id ="divCampo1" style=" float:right;width:100%; height:auto; " >
    <div  id ="divCampo1_1" style=" width:99%; height: auto" align="center" >
        <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
            <legend>Registro de Nuevo Campo</legend>
            <div  id ="divCampo1_2" style=" float:left;width:100%; height:auto;">
                <?php
                $cantidad = 1;
                $imagen = $disabled == '' ? '../../../../fastmedical_front/imagen/icono/nuevo_item.png' : '../../../../fastmedical_front/imagen/icono/nuevo_item_black.png';
                $cursor = $disabled == '' ? 'cursor:pointer;' : 'cursor:default;';
                echo "<script>$('divCampo').innerHTML=" . $cantidad . "</script>";
                ?>
                <table  width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="3">Nombre Prueba :
                            <input name="txtDescPrueba" type="text" id="txtDescPrueba" disabled value="<?php echo $descPrueba; ?>" size="20">
                            <input name="hidIdPruebaC" type="hidden" id="hidIdPruebaC" value="<?php echo $hidIdPruebaC; ?>" />
                        </td>
                    </tr>
                    <tr><td height="10"></td></tr>
                   
                    <tr>
                        <td colspan="5">
                            <form id="formNuevoCampo" name="formNuevoCampo" action="" method="post">                   
                                <table id='tbl_doc'  width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td><p>Tipo de Campo :</p></td>
                                        <td> <p>Nombre de Dato:</p> </td>
                                        <td> <p>Orden :</p></td>
                                        <td> <p>Obligatorio :</p></td>
                                        <td> <p>Estado :</p></td>
                                        <td></td>
                                    </tr>
                                    <?php if ($camposx == "") { ?>
                                        <tr>
                                            <td width="25%">
                                                <select id="cbTipoCampo[1]" name="cbTipoCampo[1]" onchange="verficaTipo(this)" style="width:120px;">
                                                    <option value="">Seleccionar</option>
                                                    <?php foreach ($cboTipoCampo as $k => $value) {
                                                       // echo $k; ?>

                                                        <option value="<?php echo $cboTipoCampo[$k][0]; ?>"><?php echo $cboTipoCampo[$k][1]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input name="hidIdCombo[1]" type="hidden" id="hidIdCombo[1]" value="" />
                                            </td>
                                            <td  height="25">
                                                <input name="txtNombreCampo[1]" tabindex=1   type="text" style="width:100px;" id="txtNombreCampo[1]" title="Nombre del campo" size="8"/>
                                                <input name="hidIdCampo[1]" type="hidden" id="hidIdCampo[1]" value="" />
                                            </td>
                                            <td height="25">
                                                <input name='txtOrden[1]' tabindex=2    type="text" style="width:100px;" id="txtOrden[1]" title="Orden del campo" size="8"/>
                                            </td>
                                            <td height="25">
                                                <input name='bObligatorio[1]' tabindex=2   value="0"  type="checkbox" style="width:100px;" id="bObligatorio[1]" title="bObligatorio[1]" size="8"/>
                                            </td>
                                            <td  height="25">
                                                <select name="cbEstado[1]" id="cbEstado[1]" style="width:85px;">
                                                    <option value="">Seleccionar</option>
                                                    <?php foreach ($cboEstado as $k => $value) { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                               
                                               <input type="button" name="btnAgregaCampo[1]" id="btnAgregaCampo[1]"  value="" style="background:url(<?php echo $imagen; ?>) no-repeat;width:18px;height:18px;border:0px; <?php echo $cursor; ?>" onclick="agregaMasCampo('tbl_doc',++kk)">
                                            
                                               </td>
                                        </tr>
                                        <?php
                                        echo "<script>$('divCampo').innerHTML=1</script>";
                                        echo "<script>document.getElementById('divGrabar1').style.display='block'</script>";
                                        echo "<script>document.getElementById('divEditar1').style.display='none'</script>";
                                    } else {
                                        $cantidad = 0;
                                        
                                        foreach ($camposx as $i => $valor) {
           
                                            $cantidad++;
                                            $flagCombo = 0;
                                            ?>
                                            <tr id="<?php echo "rowTipoDoc" . $cantidad; ?>">
                                                <td >
                                                    <select id="cbTipoCampo[<?php echo $cantidad; ?>]" name="cbTipoCampo[<?php echo $cantidad; ?>]" onchange="verficaTipo(this)" style="width:120px;" <?php echo $disabled; ?> >
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach ($cboTipoCampo as $p => $tipoCampo) { ?>
                                                            <option value="<?php echo $cboTipoCampo[$p][0]; ?>" <?php if ($camposx[$i][1] == $cboTipoCampo[$p][0]) { ?> selected<?php } ?> ><?php echo $cboTipoCampo[$p][1]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php if ($camposx[$i][3] != "") { ?>
                                                        <input id="editaCombo[<?php echo $cantidad; ?>]" name="editaCombo[<?php echo $cantidad; ?>]" type="button" value="..." title="Editar valores del Combo" style="cursor: pointer;" onclick="editarCombo(<?php echo $cantidad; ?>)"><?php } ?>
                                                    <input name="hidIdCombo[<?php echo $cantidad; ?>]" type="hidden" id="hidIdCombo[<?php echo $cantidad; ?>]" value="<?php echo$camposx[$i][3]; ?>"/>
                                                    <input name="hidIdCampo[<?php echo $cantidad; ?>]" type="hidden" id="hidIdCampo[<?php echo $cantidad; ?>]" value="<?php echo$camposx[$i][0]; ?>" />
                                                </td>
                                                <td  height="25">
                                                    <input name="txtNombreCampo[<?php echo $cantidad; ?>]" value="<?php echo utf8_encode($camposx[$i][4]); ?>" tabindex=1   type="text" style="width:100px;" id="txtNombreCampo[<?php echo $cantidad; ?>]" title="Nombre del campo" size="8"<?php echo $disabled; ?> />
                                                </td>
                                                <td height="25">
                                                    <input name='txtOrden[<?php echo $cantidad; ?>]' value="<?php echo$camposx[$i][6]; ?>" tabindex=2 type="text" style="width:100px;" id="txtOrden[<?php echo $cantidad; ?>]" title="Orden del campo" size="8" <?php echo $disabled; ?> />
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="bObligatorio[<?php echo $cantidad; ?>]" id="bObligatorio[<?php echo $cantidad; ?>]" value="<?php echo $camposx[$i][7] ?>" <?php if ($camposx[$i][7] == 1) { echo "checked='checked'";}?> onclick="if(this.checked){this.value=1}else{this.value=0;}" <?php echo $disabled; ?>/>
                                                </td>
                                                    
                                                <td  height="25">
                                                    <select name="cbEstado[<?php echo $cantidad; ?>]" id="cbEstado[<?php echo $cantidad; ?>]"  style="width:85px;" <?php echo $disabled; ?> >
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach ($cboEstado as $k => $value) { ?>
                                                            <option value="<?php echo $k; ?>" <?php if ($camposx[$i][5] == $k) { ?> selected<?php } ?>><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="button" name="btnEliminarCampo[<?php echo $cantidad; ?>]" id="btnEliminarCampo[<?php echo $cantidad; ?>]" value=""  style="background:url('../../../imagen/inicio/eliminar.gif') no-repeat;width:18px;height:18px;border:0px; cursor:pointer;" onclick="eliminarDbCampo(<?php echo $cantidad; ?>)"> 
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    <?php
                                    echo "<script>$('divCampo').innerHTML=" . $cantidad . "</script>";
                                    ?>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
                <div id="divCampo" style="visibility: hidden"></div>
            </div>

            <div id ="botones" style=" float:left;width:100%;height:30px;">
                <table width="36%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left: 32%; margin-right: 32%">
                    <tr>
                        <td>
                            <div id="divGrabar1" style="display:none; width: 100px;float:left;" align="center">
                                <?php
                                $toolbar1_1->SetBoton("Grabar1", "Grabar campo", "btn", "onclick,onkeypress", "grabarCampo('formNuevoCampo','nuevo')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                $toolbar1_1->Mostrar();
                                ?>
                            </div>
                            <div id="divEditar1" style="display:none; width: 100px; float:left;">
                                <?php
                                $toolbar1_2->SetBoton("Editar1", "Editar", "btn", "onclick,onkeypress", "postEditarCampo()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/editar.png", "", "", 1);
                                $toolbar1_2->Mostrar();
                                ?>
                            </div>
                            <div id="divAgregar1" style="display:none; width: 80px; float:right;">
                                <?php
                                $toolbar1_3->SetBoton("Agregar1", "Agregar", "btn", "onclick,onkeypress", "agregaMasCampo('tbl_doc',++kk)", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo_item.png", "", "", 1);
                                $toolbar1_3->Mostrar();
                                ?>
                            </div>
                            <div id="divActualizar1" style="display:none; width: 100px; float:left;" >
                                <?php
                                $toolbar1_4->SetBoton("Actualizar1", "Actualizar", "btn", "onclick,onkeypress", "grabarCampo('formNuevoCampo','modificar')", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
                                $toolbar1_4->Mostrar();
                                ?>
                            </div>
                            <div id="divRestaurar1" style="display:none; width: 100px; float:right;">
                                <?php
                                $toolbar1_5->SetBoton("Restaurar1", "Restaurar", "btn", "onclick,onkeypress", "restaurarCampo()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/undo.png", "", "", 1);
                                $toolbar1_5->Mostrar();
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        </fieldset>
    </div>
</div>
