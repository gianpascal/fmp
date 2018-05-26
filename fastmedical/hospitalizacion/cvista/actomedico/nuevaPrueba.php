<?php
    $cboEstadoPrueba= array(1 => "Activar", 0 => "Desactivar");
    $toolbar1=new ToollBar("center");
    $toolbar2=new ToollBar("right");
    $toolbar3=new ToollBar("right");
    $toolbar4=new ToollBar("right");
    ?>
<div  id ="divPrueba1" style=" float:right;width:100%; height:auto; " >
    <div  id ="divPrueba1_1" style=" width:99%; height: auto" align="center" >
        <fieldset style="margin:1px;width:98%;height:auto;padding: 0px; font-size:14px">
            <legend>Registro de Nueva Prueba</legend>
            <form id="formPrueba" name="formPrueba" action="" method="post">
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td colspan="3"><input name="hidIdPrueba" type="hidden" id="hidIdPrueba" value="<?php echo $hidIdPrueba;?>" /></td></tr>
                <tr>
                    <td width="60%"><p>Nombre de la prueba</p><input type="text" id="txtnomPrueba" name="txtnomPrueba" value="<?php echo $txtnomPrueba;?>" size="45"></td>
                    <td width="20%"><p>Orden</p><input type="text" id="txtOrden" name="txtOrden" value="<?php echo $txtOrden;?>" size="8"></td>
                    <td width="20%"><p>Estado</p>
                        <select name="cboEstadoPrueba" id="cboEstadoPrueba" style="width: 90px">
                            <option value="">Seleccionar</option>
                            <?php foreach ($cboEstadoPrueba as $k => $value) { ?>
                            <option value="<?php echo $k;?>" <?php if($k==$stdPrueba){?> selected<?php }?>><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </td>
                </tr>
            </table>
            </form>
            <br>
             <table width="34%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left: 33%; margin-right: 33%">
                   <tr>
                    <td>
                        <div id="divGrabar" style="display:block; width: 110px" align="center">
                            <?php
                            $toolbar1->SetBoton("Grabar","Grabar prueba","btn","onclick,onkeypress","grabarPrueba('nuevo')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                            $toolbar1->Mostrar();
                            ?>
                        </div> 
                        <div id="divEditar" style="display:none; width: 110px" align="center">
                           <?php
                            $toolbar2->SetBoton("Editar","Editar","btn","onclick,onkeypress","postEditarPrueba()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/editar.png","","",1);
                            $toolbar2->Mostrar();
                            ?>
                        </div>
                        <div id="divActualizar" style="display:none; width: 100px; float:left;" >
                         <?php
                            $toolbar3->SetBoton("Actualizar","Actualizar","btn","onclick,onkeypress","grabarPrueba('modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                            $toolbar3->Mostrar();
                         ?>
                        </div>
                        <div id="divRestaurar" style="display:none; width: 100px; float:right;">
                        <?php
                            $toolbar4->SetBoton("Restaurar","Restaurar","btn","onclick,onkeypress","restaurarPrueba()",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/undo.png","","",1);
                            $toolbar4->Mostrar();
                         ?>
                        </div>
                    </td>
                    </tr>
             </table>
        </fieldset>
    </div>
</div>