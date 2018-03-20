<html>
    <body>
        <div id="divAtributoFormato"  style="margin:1px;width:90%;height:auto;padding: 0px; margin-right:5%; margin-left: 5%">
        <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px;">
            <legend>Registrar Valores del Combo</legend>
            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100%" align="center">
                        <form name="formAtributoFormato" id="formAtributoFormato" method="post" action="">
                            <table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2">
                                        <div  id ="divItemCombo" style=" float:left;width:75%; height:auto; padding-left: 20%; padding-right: 5%;">
                                            <?php
                                            $disabled='';
                                            $cantidad=1;
                                            $imagen= $disabled==''?'../../../../medifacil_front/imagen/icono/nuevo_item.png':'../../../../medifacil_front/imagen/icono/nuevo_item_black.png';
                                            $cursor= $disabled==''?'cursor:pointer;':'cursor:default;';
                                            echo "<script>$('divValorCombo').innerHTML=".$cantidad."</script>";
                                            ?>
                                            <table id='tbl_combo' width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr><td height="10" colspan="3"></td></tr>
                                                <tr>
                                                    <td width="60%"><p>Texto Combo :</p></td>
                                                    <td width="35%"> <p>Value Combo :</p></td>
                                                    <td width="5%"></td>
                                                </tr>
                                                <?php if($editarCombo=="no"){?>
                                                <tr>
                                                    <td height="25" >
                                                        <input name="txtTexto[1]" tabindex=1   type="text" style="width:100px;" id="txtTexto[1]" title="Texto Select" size="12"/>
                                                    </td>
                                                    <td height="25">
                                                        <input name='txtValue[1]' tabindex=2   type="text" id="txtValue[1]" title="Value" size="3" value="1"/>
                                                    </td>
                                                    <td height="25">
                                                        <input type="button" name="btnItemCombo[1]" id="btnItemCombo[1]" <?php echo $disabled;?>  value="" style="background:url(<?php echo $imagen;?>) no-repeat;width:18px;height:18px;border:0px; <?php echo $cursor;?>" onclick="agregaItemsCombo('tbl_combo',++kk)">
                                                    </td>
                                                </tr>
                                                <?php echo "<script>$('divValorCombo').innerHTML=1</script>";}
                                                    else if($editarCombo=="si"){
                                                    $cantidad=0;
                                                    foreach($comboAtributo as $i=>$valor){ $cantidad ++;
                                                    ?>
                                                    <tr id="<?php echo "rowMasCombo".$cantidad;?>">
                                                    <td height="25">
                                                        <input name="txtTexto[<?php echo $cantidad;?>]" tabindex=1   type="text" style="width:100px;" id="txtTexto[<?php echo $cantidad;?>]" title="Texto Select" size="12" value="<?php echo $comboAtributo[$i][1];?>"/>
                                                        <input name="hidIdComboAtributo[<?php echo $cantidad;?>]"  type="hidden" id="hidIdComboAtributo[<?php echo $cantidad;?>]" value="<?php echo $comboAtributo[$i][0];?>"/>
                                                    </td>
                                                    <td height="25">
                                                        <input name='txtValue[<?php echo $cantidad;?>]' tabindex=2   type="text"  id="txtValue[<?php echo $cantidad;?>]" title="Value" size="3" value="<?php echo $comboAtributo[$i][2];?>"/>
                                                    </td>
                                                    <td height="25">
                                                        <?php if($cantidad==1){?>
                                                        <input type="button" name="btnItemCombo[<?php echo $cantidad;?>]" id="btnItemCombo[<?php echo $cantidad;?>]" value="" style="background:url('../../../../medifacil_front/imagen/icono/nuevo_item.png') no-repeat;width:18px;height:18px;border:0px; cursor: pointer" onclick="agregaItemsCombo('tbl_combo',++kk)">
                                                        <?php }else{?>
                                                        <input type="button" name="btnItemCombo[<?php echo $cantidad;?>]" id="btnItemCombo[<?php echo $cantidad;?>]" value="" style="background:url('../../../imagen/inicio/eliminar.gif') no-repeat;width:18px;height:18px;border:0px; cursor: pointer" onclick="eliminaDbComboAtributo(<?php echo $cantidad;?>)">
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php }}?>
                                            </table>
                                            <div id="divValorCombo" style="visibility: visible"></div>
                                            <?php
                                            echo "<script>$('divValorCombo').innerHTML=".$cantidad."</script>";
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                    <td width="64%">&nbsp;</td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px;">
            <br>
            <div id="nuevoCombo" style="margin-left: 37%; margin-right: 37%;display:none;">
                <?php
                $toolbar1=new ToollBar("center");
                $toolbar1->SetBoton("Grabar","Grabar","btn","onclick,onkeypress","grabarAtributoCombo('formAtributoFormato','grabar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                $toolbar1->Mostrar();
                ?>
            </div>
            <div id="modificarCombo" style="margin-left: 37%; margin-right: 37%; display:none;">
                <?php
                $toolbar2=new ToollBar("center");
                $toolbar2->SetBoton("Modificar","Modificar","btn","onclick,onkeypress","grabarAtributoCombo('formAtributoFormato','modificar')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png","","",1);
                $toolbar2->Mostrar();
                ?>
            </div>
        </fieldset>
        </div>
    </body>
</html>