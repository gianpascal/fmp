<?php
$toolbar1 = new ToollBar("center");
?>

<input type="hidden" name="txtc_cod_prod" id="txtc_cod_prod" value="<?php echo $datos["c_cod_prod"] ?>"/>
<input type="hidden" name="txtiIdServicioGrupoEtareo" id="txtiIdServicioGrupoEtareo" value="<?php echo $datos["iIdServicioGrupoEtareo"] ?>"/>

<br><br>
<table>
    <tr>
        <td>
            <b>TIPO</b>
        </td>
        <td>
            <select id="cboTipoServicioCPT" >
                <?php foreach ($resultadoTipoServicioCPT1 as $i => $value) { ?>
                    <option value="<?php echo $value[0] ?>"
                            <?php if ($value[0] == $datos["iIdTipoServicioCPT"]) { ?> selected<?php } ?>
                            >
                                <?php echo utf8_encode($value[1]) ?>
                    </option> 
                <?php } ?>
            </select>
        </td>
        <td></td>
    </tr>
    <tr>
        <td><B>EDAD DE TOMA</B></td>
        <td><input name="txtnEdadToma" id="txtnEdadToma" onkeyup="validaDecimal(event,this,'')"
                   value="<?php echo $datos["edad"] ?>" />
        </td>
        <td>
            <select id="cboPeriodoEdad" >
                <?php foreach ($resultadoPeriodoEdad1 as $i => $value) { ?>
                    <option value="<?php echo $value[0] ?>" 
                            <?php if ($value[0] == $datos["iIdPeriodoEdad"]) { ?> selected<?php } ?>>
                                <?php echo utf8_encode($value[1]) ?>
                    </option> 
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td> <b>Nro Atenci&oacute;n:</b></td>
        <td><input name="txtNroAtenciones" id="txtNroAtenciones" onkeyup="validaDecimal(event,this,'')" 
                   value="<?php echo $datos["nroAtencion"] ?>" />
        </td>
        <td></td>
    </tr>
    <tr>
        <td> <b>iOrder</b></td>
        <td><input name="txtiOrder" id="txtiOrder" value="<?php echo $datos["iorden"] ?>" /></td>
        <td></td>
    </tr>
    <tr>
        <td> <b>Mensaje</b></td>
        <td><textarea name="txtMensaje" id="txtMensaje"><?php echo $datos["vMensaje"] ?></textarea></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td >
            <?php
            $toolbar1->SetBoton("Editar", "Editar", "btn", "onclick,onkeypress", "modificarServicioGrupoEtario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/editar.png", "", "", 1);
            $toolbar1->Mostrar();
            ?>
        </td>
        <td></td>
    </tr>
</table>