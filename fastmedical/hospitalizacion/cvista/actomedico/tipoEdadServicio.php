<?php
$toolbar1 = new ToollBar("center");
?>

<input type="hidden" name="txtc_cod_prod" id="txtc_cod_prod" value="<?php echo $datos["c_cod_prod"] ?>"/>
<br><br>
<table>
    <tr>
        <td>
            <b>TIPO</b>
        </td>
        <td>
            <select id="cboTipoServicioCPT" >
                <?php foreach ($resultadoTipoServicioCPT as $i => $value) { ?>
                    <option value="<?php echo $value[0] ?>">
                        <?php echo utf8_encode($value[1]) ?>
                    </option> 
                <?php } ?>
            </select>
        </td>
        <td></td>
    </tr>
    <tr>
        <td><B>EDAD DE TOMA</B></td>
        <td><input name="txtnEdadToma" id="txtnEdadToma" onkeyup="validaDecimal(event,this,'')"/></td>
        <td>
            <select id="cboPeriodoEdad" >
                <?php foreach ($resultadoPeriodoEdad as $i => $value) { ?>
                    <option value="<?php echo $value[0] ?>">
                        <?php echo utf8_encode($value[1]) ?>
                    </option> 
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td> <b>Nro Atenci&oacute;n:</b></td>
        <td><input name="txtNroAtenciones" id="txtNroAtenciones" onkeyup="validaDecimal(event,this,'')" /></td>
        <td></td>
    </tr>
     <tr>
        <td> <b>iOrder</b></td>
        <td><input name="txtiOrder" id="txtiOrder" value="<?php echo $order ?>" disabled="" /></td>
        <td></td>
    </tr>
     <tr>
        <td> <b>Mensaje</b></td>
        <td><textarea name="txtMensaje" id="txtMensaje"></textarea></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td >
            <?php
            $toolbar1->SetBoton("Guardar", "Guardar", "btn", "onclick,onkeypress", "guardarServicioGrupoEtario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/grabar.png", "", "", 1);
            $toolbar1->Mostrar();
            ?>
        </td>
        <td></td>
    </tr>
</table>