<?php
require_once("../../ccontrol/control/ActionActoMedico.php");
$o_ActionActoMedico = new ActionActoMedico();
$nombre = "lstTipoDosis_" . $datos["numerodivmedicamento"];
$datos["idtipodosis"] == '' ? $indSel = '' : $indSel = $datos["idtipodosis"];
//$respuesta = $o_ActionActoMedico->comboDosificacion($nombre,$indSel,$datos["numerodivmedicamento"]);
?>
<input type="hidden" id="hEstadoAgregarTratamientoMedicamentoso_<?php echo $datos["numerodivmedicamento"]; ?>" value="<?php echo $datos["estadoregistroMedicamentoso"]; ?>" >
<input type="hidden" id="hIdTratamientoMedicamentoso_<?php echo $datos["numerodivmedicamento"]; ?>" value="<?php echo $datos["idtratamiento"]; ?>" >
<input type="hidden" id="hcodigoMedicamento_<?php echo $datos["numerodivmedicamento"]; ?>" value="<?php echo $datos["codigomedicamento"]; ?>" >
<table id ="<?php echo "Table_IndicacionesReceta" . $datos["numerodivmedicamento"]; ?>" width="100%" border="0">
    <tr align="center">
        <td width="25%" id="<?php echo $datos["codigomedicamento"]; ?>"><?php
if ($datos["codigomedicamento"] == '0000000') {
    ?>
                <input id="otromedicamentonombre_<?php echo $datos["numerodivmedicamento"]; ?>" type="text" value="<?php echo htmlentities($datos["nombreproducto"]); ?>"/>
                <?php
            } else {
                echo ($datos["nombreproducto"]);
            }
            ?></td>
        <td width="14%"><?php
            if ($datos["codigomedicamento"] == '0000000') {
                ?>
                <input id="otromedicamentopresentacion_<?php echo $datos["numerodivmedicamento"]; ?>" type="text" value="<?php echo htmlentities($datos["presentacion"]); ?>" size="15"/>
                <?php
            } else {
                echo $datos["presentacion"];
            }
            ?></td>
        <td width="10%"><input id="txtcantidadmedicamento_<?php echo $datos["numerodivmedicamento"]; ?>" onkeypress="return validFormSalt('nro',this,event,'lstTipoDosis_<?php echo $datos["numerodivmedicamento"]; ?>')" name="txtcantidadmedicamento_<?php echo $datos["numerodivmedicamento"]; ?>" type="text" onchange="<?php echo "cambiarEstadoTratamientoMedicamentoso('" . $datos["numerodivmedicamento"] . "')"; ?>" onkeyup="validaIntegers(event,this,'')" value="<?php echo $datos["icantidad"]; ?>" maxlength="6" size="4"/></td>
<!--        <td width="15%"><?php echo $respuesta; ?></td>-->
        <td width="30%"><textarea id="<?php echo "txtareaObservacionMedicamento_" . $datos["numerodivmedicamento"]; ?>" name="<?php echo "txtareaObservacionMedicamento_" . $datos["numerodivmedicamento"]; ?>" onchange="<?php echo "cambiarEstadoTratamientoMedicamentoso('" . $datos["numerodivmedicamento"] . "')"; ?>" rows="1" style="width: 100%"><?php echo htmlentities($datos["modoaplicacion"]); ?></textarea></td>
        <td width="6%"><a href="javascript:;" onclick="javascript:eliminarMedicamentoHC(<?php echo "'Div_Receta" . $datos["numerodivmedicamento"] . "','" . $datos["codigomedicamento"] . "'"; ?>);"><img src='../../../../medifacil_front/imagen/icono/borrar.png' alt=""></a></td>
    </tr>
</table>
<br/>


