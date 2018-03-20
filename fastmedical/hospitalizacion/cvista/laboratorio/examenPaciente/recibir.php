
<fieldset>
    <legend>Recibir</legend>

    Observaciones:
    <br/>
    <textarea id="textObservacion<?php echo $idProcesarPuntoControl; ?>" style="width: 300px; height: 100px;"></textarea>
    <?php
    $toolbar1 = new ToollBar();
    $funcionCerrar=$datos["funcionCerrar"];
    $toolbar1->SetBoton("recibirProceso", "Recibir", "btn", "onclick,onkeypress", "recibirProceso($idProcesarPuntoControl,'$funcionCerrar')", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/ark2.png", "", "", 1);
    $toolbar1->Mostrar();
    ?>
</fieldset>