<p>Descripcion:
<br>
<input type="text" id="IdDescr" style="width: 300px;">
 <?php $toolbar = new ToollBar(); ?>
        <?php
        $toolbar->SetBoton("Guargar", "Guargar", "btn", "onclick,onkeypress", "HistoriaEstadistica()", "../../../../medifacil_front/imagen/icono/filesave.png", "", "", true);
        $toolbar->Mostrar();
?> 