<?php
$toolbar = new ToollBar("right");
$toolbar->SetBoton("Cancelar Operacion", "Cancelar", "btn", "onclick,onkeypress", "", "../../../../fastmedical_front/imagen/icono/borrar.png", "", "", true);
$toolbar->SetBoton("Cargar Medicamentos", "Cargar Paquete", "btn", "onclick,onkeypress", "cargarPaqueteMedicamentosalPacienteFarmaciaCISOP()", "../../../../fastmedical_front/imagen/icono/inbox.png", "", "", true);

?>
<div id="Div_TablaPaquetesFarmaceuticosCISOP" style="width: 90%;height:80%">

</div>
<div id="botonesPaquetesFarmaceuticosCISOP" style="width: 90%;height:10%">
    <?php $toolbar->Mostrar();?>
</div>