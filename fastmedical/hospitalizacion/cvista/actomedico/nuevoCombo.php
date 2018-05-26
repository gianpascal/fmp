<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div id="divnuevoCombo"  style="margin:1px;width:90%;height:auto;padding: 0px; margin-right:5%; margin-left: 5%">
        <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px;">
            <legend>Registrar Nuevo Combo</legend>
            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100%" align="center">
                        <form name="formNuevo" id="formNuevo" method="post" action="">
                            <table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2" height="10"><input type="hidden" id="hidnroTipoCampo" name="hidnroTipoCampo" value=""></td>
                                </tr> 
                                <tr>
                                    <td colspan="2"><input type="hidden" id="hididCombo" name="hididCombo" value="<?php echo $idCombo;?>"></td>
                                </tr>
                                <tr>
                                    <td>Nombre Combo:</td>
                                    <td><input type="text" id="txtnomCombo" name="txtnomCombo" value="<?php echo $nomCombo;?>"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div  id ="divItemCombo" style=" float:left;width:75%; height:auto; padding-left: 20%; padding-right: 5%;">
                                            <?php
                                            $disabled='';
                                            $cantidad=1;
                                            $imagen= $disabled==''?'../../../../fastmedical_front/imagen/icono/nuevo_item.png':'../../../../fastmedical_front/imagen/icono/nuevo_item_black.png';
                                            $cursor= $disabled==''?'cursor:pointer;':'cursor:default;';
                                            echo "<script>$('divValorCombo').innerHTML=".$cantidad."</script>";
                                            ?>
                                            <table id='tbl_combo' width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr><td height="10" colspan="3"></td></tr>
                                                <tr>
                                                    <td width="60%"><p>Texto Combo :</p></td>
                                                    <td width="35%"> <p>Value Combo :</p> </td>
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
                                                        <input type="button" name="btnItemCombo[1]" id="btnItemCombo[1]" <?php echo $disabled;?>  value="" style="background:url(<?php echo $imagen;?>) no-repeat;width:18px;height:18px;border:0px; <?php echo $cursor;?>" onclick="agregaMasItemsCombo('tbl_combo',++kk)">
                                                    </td>
                                                </tr>
                                                <?php echo "<script>$('divValorCombo').innerHTML=1</script>";}
                                                    else if($editarCombo=="si"){
                                                    $cantidad=0;
                                                    foreach($detalle as $i=>$valor){ $cantidad ++;
                                                    ?>
                                                    <tr id="<?php echo "rowMasCombo".$cantidad;?>">
                                                    <td height="25">
                                                        <input name="txtTexto[<?php echo $cantidad;?>]" tabindex=1   type="text" style="width:100px;" id="txtTexto[<?php echo $cantidad;?>]" title="Texto Select" size="12" value="<?php echo $detalle[$i][1];?>"/>
                                                        <input name="hidIdValCombo[<?php echo $cantidad;?>]"  type="hidden" id="hidIdValCombo[<?php echo $cantidad;?>]" value="<?php echo $detalle[$i][0];?>"/>
                                                    </td>
                                                    <td height="25">
                                                        <input name='txtValue[<?php echo $cantidad;?>]' tabindex=2   type="text"  id="txtValue[<?php echo $cantidad;?>]" title="Value" size="3" value="<?php echo $detalle[$i][2];?>"/>
                                                    </td>
                                                    <td height="25">
                                                        <?php if($cantidad==1){?>
                                                        <input type="button" name="btnItemCombo[<?php echo $cantidad;?>]" id="btnItemCombo[<?php echo $cantidad;?>]" value="" style="background:url('../../../../fastmedical_front/imagen/icono/nuevo_item.png') no-repeat;width:18px;height:18px;border:0px; cursor: pointer" onclick="agregaMasItemsCombo('tbl_combo',++kk)">
                                                        <?php }else{?>
                                                        <input type="button" name="btnItemCombo[<?php echo $cantidad;?>]" id="btnItemCombo[<?php echo $cantidad;?>]" value="" style="background:url('../../../imagen/inicio/eliminar.gif') no-repeat;width:18px;height:18px;border:0px; cursor: pointer" onclick="eliminaDbCombo(<?php echo $cantidad;?>)">
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php }}?>
                                            </table>
                                            <div id="divValorCombo" style="visibility: hidden"></div>
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
            <div id="nuevoCombo" style="float:left; margin-left: 35px; display:none">
                <?php
                $toolbarc1=new ToollBar("center");
                $toolbarc1->SetBoton("Grabar","Grabar","btn","onclick,onkeypress","grabarCombo('formNuevo','nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                $toolbarc1->Mostrar();
                ?>
            </div>
            <div id="modificarCombo" style="margin-left: 35%; margin-right: 35%; display:none">
                <?php
                $toolbar2=new ToollBar("center");
                $toolbar2->SetBoton("Modificar","Modificar","btn","onclick,onkeypress","grabarCombo('formNuevo','modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                $toolbar2->Mostrar();
                ?>
            </div>
            <div id="verCombo" style="float:right; display:none; margin-right: 35px;">
                <?php
                $toolbarc3=new ToollBar("center");
                $toolbarc3->SetBoton("Buscar","Ver Combos","btn","onclick,onkeypress","verCombo()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/kappfinder.png","","",1);
                $toolbarc3->Mostrar();
                ?>
            </div>
        </fieldset>
        </div>
        <br>
        <div id="divNota"  style="display: none; margin:1px;width:300px;height:auto; padding: 0px; margin-right:20%; margin-left: 20%">
            <p style="color: teal">Hacer doble Click para capturar Combo</p
        </div>
        <div id="divCombo"  style="display: none; margin:1px;width:200px;height:150px; padding: 0px; margin-right:28%; margin-left: 28%">
        </div>
        <br>
        <div id="divValorCombo1"  style="display: none; margin:1px;width:220px;height:150px;padding: 0px; margin-right:25%; margin-left: 25%">
        </div>
    </body>
</html>
