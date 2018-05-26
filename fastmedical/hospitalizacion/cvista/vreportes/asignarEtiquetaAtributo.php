<html>
    <body>
        <table  width="100%" border="0" align="center">
            <tr>
                <td>
                    <input id="hidIdAtributox" name="hidIdAtributox" type="hidden" value="" />
                    <input id="hidTipoAF" name="hidTipoAF" type="hidden" value="" />
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table border="0" align="center" >
                        <tr>
                            <td align="center">
                                <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px;">
                                    <div  id ="divListaAtributosx" style="float: left; width:200px; height:170px;"></div>
                                    <div  id ="divCombo" style="float: right;  width:200px; height:170px; display: none;">
                                        <br><br><p align="center">Ingrese Valor</p><br>
                                        <div id="comboAtributo" ></div>
                                        <div id="divInputText" ></div><br>
                                        <p align="center">Elija Tipo</p><br>
                                        <div>
                                            <select name="cboTipoEtiquetaAtributo" id="cboTipoEtiquetaAtributo" style="width: 90px;">
                                                <option value="">Seleccionar</option>
                                                <?php foreach ($cboTipoEtiquetaAtributo as $k => $value) { ?>
                                                <option value="<?php echo $cboTipoEtiquetaAtributo[$k][0];?>"><?php echo $cboTipoEtiquetaAtributo[$k][1];?></option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <br>
                            </td>
                        </tr>
                    </table>
                    <table border="0" align="center" >
                        <tr>
                            <td align="center">
                                <div id="divAsignarAtributos" style="width: 80px; display: block;">
                                    <?php
                                    $toolbarj1=new ToollBar("right");
                                    $toolbarj1->SetBoton("Asignar","Asignar","btn","onclick,onkeypress","grabarEtiquetaAtributo('grabar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/lassists.png","","",1);
                                    $toolbarj1->Mostrar();
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <input id="hidIdEtiquetaAtributo" name="hidIdEtiquetaAtributo" type="hidden" value=""/>
                                <div  id ="divEditarEtiquetasAtributos" style="width:450px; height:auto; display: none;">
                                    <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:12px;">
                                        <table width="100%" border="0" align="center">
                                            <tr>
                                                <td width="40%" height="30"><p> Valor : <input id="txtValor" name="txtValor" value="" type="text" size="15"/></p></td>
                                                <td width="40%"> Tipo :
                                                    <select name="cboTipoEtiquetaAtributox" id="cboTipoEtiquetaAtributox" style="width: 90px;">
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach ($cboTipoEtiquetaAtributo as $k => $value) { ?>
                                                        <option value="<?php echo $cboTipoEtiquetaAtributo[$k][0];?>"><?php echo $cboTipoEtiquetaAtributo[$k][1];?></option>
                                                            <?php }?>
                                                    </select>
                                                </td>
                                                <td><br>
                                                    <div id="divAsignarAtributos" style="width: 80px;">
                                                        <?php
                                                        $toolbarj2=new ToollBar("right");
                                                        $toolbarj2->SetBoton("ModificarValor","Modificar","btn","onclick,onkeypress","grabarEtiquetaAtributo('modificar')",$_SESSION['path_principal']."../fastmedical_front/imagen/icono/grabar.png","","",1);
                                                        $toolbarj2->Mostrar();
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                                <div  id ="divmsj" style="width:450px; height:auto;">
                                    <br><p align="center" style="color: blue">Hacer doble click para modificar valor</p>
                                </div>
                                <div  id ="divEtiquetasAtributos" style="width:450px; height:200px;"></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
