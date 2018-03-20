<div>
    <table>
        <tr>
            <td>
                <!--<div align="right">C&oacute;digo:</div>-->
                <label>C&oacute;digo:</label>
            </td>
            <td>
                <?php //echo $codigo; ?>
                <input type="text" id="txtCodPerDeOrdenGenerada" name="txtCodPerDeOrdenGenerada" value="<?php echo $codigo; ?>" readonly size="10">
            </td>
            <td>
                <!--Documento:-->
                <label>Documento:</label>
            </td>
            <td>
                <?php //echo $documento; ?>
                <input type="text" id="txtDNIPerDeOrdenGenerada" value="<?php echo $documento; ?>" readonly>
            </td>
        </tr>
        <tr>
            <td>
                <!--Apellidos y Nombres:-->
                <label>Apellidos y Nombres:</label>
            </td>
            <td colspan="3">
                <?php //echo $nombre; ?>
                <input type="text" id="txtNomPerDeOrdenGenerada" name="txtNomPerDeOrdenGenerada" value="<?php echo $nombre; ?>" readonly size="60">
            </td>
        </tr>
        <tr>
            <td>
                <!--<div align="right">Filiaci&oacute;n:</div>-->
                <label>Filiaci&oacute;n:</label>
            </td>
            <td>
                <?php //echo $filiacion; ?>
                <input type="text" value="<?php echo $filiacion; ?>" readonly size="30" id="txtFilicacion">
            </td>
            <td>
                <!--Edad:-->
                <label>Edad:</label>
            </td>
            <td>
                <!--<div align="left">
                <?php //echo $edad; ?>
                </div>-->
                <input type="text" value="<?php echo $edad; ?>" readonly size="30" id="txtEdad">
            </td>
        </tr>
    </table>
</div>

<div id="resultadoOrdenes" style="width:700px; height:380px; float:left; overflow: auto;">
    <?php echo $o_Html->getTabla(); ?>
    <input type="hidden" id="hdnNroOrdenCompraSeleccionado" name="hdnNroOrdenCompraSeleccionado" value="">
</div>