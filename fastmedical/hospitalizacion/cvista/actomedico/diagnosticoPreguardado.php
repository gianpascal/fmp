<?php
require_once("../../ccontrol/control/ActionActoMedico.php");
$o_ActionActoMedico = new ActionActoMedico();
$nombretipodiagnostico = "lstTipoDiagnostico_".$datos["numerodivDiagnostico"];
$nombretipoingreso = "lstTipoIngreso_".$datos["numerodivDiagnostico"];
$datos["idTipoDiagnostico"]==''?$indSelTipoDiagnostico = '':$indSelTipoDiagnostico = $datos["idTipoDiagnostico"];
$datos["idTipoIngreso"]==''?$indSelTipoIngreso = '':$indSelTipoIngreso = $datos["idTipoIngreso"];
$disabledTipoDiagnostico=0;
$disabledTipoIngreso=0;
$tipodiagnostico = $o_ActionActoMedico->comboTipoDiagnostico($nombretipodiagnostico,$indSelTipoDiagnostico,$disabledTipoDiagnostico);
$tipoingreso = $o_ActionActoMedico->comboTipoIngreso($nombretipoingreso,$indSelTipoIngreso,$disabledTipoIngreso);
?>
<!--<input type="text" id="hEstadoAgregarDiagnostico_<?php echo $datos["numerodivDiagnostico"]; ?>" value="<?php echo $datos["estadoregistroDiagnostico"]; ?>" >-->
<!--<input type="text" id="hIdDiagnostico_<?php echo $datos["numerodivDiagnostico"]; ?>" value="<?php echo $datos["idDiagnosticoCIE"]; ?>" >-->
<input type="hidden" id="hcodigoDiagnostico_<?php echo $datos["numerodivDiagnostico"]; ?>" value="<?php echo $datos["codigointernoCIE"];?>" >
<table width="95%" border="0">
    <tr>
        <td width="12%"><div id="divCodCieDiagnostico_<?php echo $datos["numerodivDiagnostico"]; ?>" align="center"><?php echo $datos["codigoCIE"];?></div></td>
        <td width="40%"><div id="divNombreCieDiagnostico_<?php echo $datos["numerodivDiagnostico"]; ?>" align="center"><?php echo $datos["nombreCIE"];?></div></td>
        <td width="16%"><div align="center"><?php echo $tipodiagnostico;?></div></td>
        <td width="16%"><div align="center"><?php echo $tipoingreso;?></div></td>
        <td width="16%">
            <div align="center">
               <a href="javascript:;" onclick="javascript:eliminarDiagnostico(<?php echo $datos["numerodivDiagnostico"].",'".$datos["codigointernoCIE"]."'"; ?>);">
                    <img src='../../../../fastmedical_front/imagen/icono/borrar.png' alt="Eliminar">
                </a>
            </div>
        </td>
    </tr>
</table>
<br/>