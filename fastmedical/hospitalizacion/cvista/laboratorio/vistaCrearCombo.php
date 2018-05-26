<?php
$toolbar = new ToollBar("center");
$toolbar1 = new ToollBar("center");
$toolbar2 = new ToollBar("center");
?>
<input type="hidden" id="hidDatosPuntoControl" name="hidDatosPuntoControl"  value="<?php echo $datos["idDatosPuntoControl"] ?>">
<input type="hidden" id="hidCombo" name="hidCombo"  value="<?php echo $arrayIten[0][1] ?>">
<input type="hidden" id="hiTemMax" name="hiTemMax"  value="<?php echo $arrayIten[0][5] ?>">
<input type="hidden" id="hfilakcombo" name="hfilakcombo"  value="<?php echo $datos["filak"] ?>">
<input type="hidden" id="hfilaycombo" name="hfilaycombo"  value="<?php echo $datos["filay"] ?>">

<div class="titleform" >
    <h1>CONFIGURACI&Oacute;N DEL COMBO</h1>
</div>

<fieldset style="margin:5px;padding:5px;height:auto;width:auto;">

    <div align="center">
        <table align="center"  BORDER="1">
            <tr>
                <td colspan="2" align="center">
                    <div id="div_ItemCombo" class="toolbar" style="width:450px;float: left; height: 120px;" >
                      
                    </div>
                    <div id="div_ItemCombo1">

                    </div>
                </td>
            </tr>
            <tr>
                <td hidden="">
                    id item
                </td>
                <td>
                    <input type="hidden" id="txtidItem" name="txtidItem"  value="">
                </td>
            </tr>
            <tr>
                <td hidden="">
                    Descripcion Antigua
                </td>
                <td>
                    <input type="hidden" id="txtNombreItemAntiguo" name="txtNombreItemAntiguo"  value="">
                </td>
            </tr>
            <tr>
                <td>
                    Nombre: 
                </td>
                <td>
                    <input type="txt" id="txtNombreItem" name="txtNombreItem"  value="">
                </td>
            </tr>
            <tr>
                <td>
                    Orden:
                </td>
                <td>
                    <input type="txt" id="txtOrdenItem" name="txtOrdenItem"  value="<?php echo ($arrayIten[0][5] + 1) ?>" disabled="true">
                </td>
            </tr>
            <tr hidden>
                <td>
                    Valor:
                </td>
                <td>
                    <input type="txt" id="txtfilak" name="txtfilak"  value="">
                </td>
            </tr>
            <tr hidden>
                <td>
                    Valor:
                </td>
                <td>
                    <input type="txt" id="txtValor" name="txtValor"  value="">
                </td>
            </tr>
            <tr>
                <td align="center">
                    <div id="div_guardarItemCombo">
                        <?php
                        $toolbar->SetBoton("Guardar Item Combo", "Guardar", "btn", "onclick,onkeypress", "guardarItemCombo()", "../../../../fastmedical_front/imagen/icono/grabar.png", "", "", true);
                        $toolbar->Mostrar();
                        ?>
                    </div>
                    <div id="div_modificarItemCombo">
                        <?php
                        $toolbar2->SetBoton("Nuevo Item Combo", "Modificar", "btn", "onclick,onkeypress", "ModificarItemCombo()", "../../../../fastmedical_front/imagen/icono/nuevo.png", "", "", true);
                        $toolbar2->Mostrar();
                        ?>
                    </div>
                </td>
                <td colspan="2" align="center">
                    <?php
                    $toolbar1->SetBoton("Cancelar combo", "Cancelar", "btn", "onclick,onkeypress", "cancelarCombo()", "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png", "", "", true);
                    $toolbar1->Mostrar();
                    ?>
                </td>
            </tr>
        </table>
    </div>
</fieldset>