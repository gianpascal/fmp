<?php
$toolbar01 = new ToollBar("center");
?>
<table border="1">
    <tr align="center">
        <td style="width: 225px"></td>
        <td style="width: 225px"></td>
        <td align="center">
            <?php
            $toolbar01->SetBoton("Cerrar", "Cerrar", "btn", "onclick,onkeypress", "CerrarVentanaListaCaducidadContrato()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/agt_action_success.png", "", "", 1);
            $toolbar01->Mostrar();
            ?>  
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <div id="divTablaVistaReporte"STYLE="height:350px ;  width: auto; font-size: 12px; overflow: auto;"></div>  
        </td>
    </tr>
</table>
