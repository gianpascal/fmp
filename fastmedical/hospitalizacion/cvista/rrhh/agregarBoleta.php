<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
$c_cod_per
        ?>
<div class="titleform">
    <h1>SELECCION DE COMPROBANTE</h1>
</div>
<div align="center">
    <table border="1">
        <tr>
            <td>
                <h3>  <font size="4">Serie Comprobante:</font></h3>
            </td>
            <td>
                <select name="cboSerieComprobante" id="cboSerieComprobante">
                    <option value="">Seleccionar</option>
                    <?php foreach ($arraySerieComprobante as $i => $value) { ?>
                    <option value="<?php echo $value[0] ?>"> <?php echo utf8_encode($value[2]) ?> - <?php echo utf8_encode($value[1]) ?></option>
                        <?php }?>
                </select>
            </td>
        </tr>
       
        <tr>
            <td colspan="2">
                <div align="center">
                    <a href="javascript:guardarComprobanteSerie();"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/b_agregar_off.gif"/></a>
                </div>
            </td>
        </tr>
    </table>
</div>