<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
$toolbar4 = new ToollBar();
?>
<fieldset style="margin:1px;width:500px;height: 196px;padding: 0px; font-size:1.2em;">
    <legend>&nbsp; Datos del Punto de Control &nbsp;</legend>
    <div style="padding: 10px;">
        <div style="height:30px; width:200px" id="fila1">
            <div style="float:left; width:50px;" id="cell11">ID:</div>
            <div style="float:right; width:100px;" id="cell12">
                <input readonly type="text"  style="width: 30px;" id="txtIdPuntoControl" name="txtIdPuntoControl" value="<?php echo $idPuntoControl; ?>">
            </div>
        </div><div style="clear: both;height: 10px"></div>

        <div style="height:30px; width:200px" id="fila1">
            <div style="float:left; width:50px;" id="cell11">Nombre:</div>
            <div style="float:right; width:100px;" id="cell12">
                <input type="text" readonly style="width: 250px;" id="txtNombre" name="txtNombre" value="<?php echo utf8_encode($arrayDatosPuntoControl[0][1]); ?>">
            </div>
        </div><div style="clear: both;height: 10px"></div>

        <div style="height:30px; width:200px" id="fila1">
            <div style="float:left; width:50px;" id="cell11">Descripción:</div>
            <div style="float:right; width:100px;" id="cell12">
                <textarea  readonly style="width: 250px;" id="textAreaDescripcion" name="textAreaDescripcion" ><?php echo $arrayDatosPuntoControl[0][2]; ?></textarea>
            </div>
        </div><div style="clear: both;height: 10px"></div>

        <div style="height:30px; width:200px" id="fila1">
            <div style="float:left; width:50px;" id="cell11">Estado:</div>
            <div style="float:right; width:100px;" id="cell12">
                <input disabled id="bEstado"  type="checkbox" name="bEstado"  <?php
if ($arrayDatosPuntoControl[0][3] == 1) {
    echo "checked";
}
;
?>/>
            </div>
            <br>
            <br>
            <div style="height:30px; width:450px" id="ContenedorTransacciones">

                <div style="width: 100px; float: left; height: 200px;"id="Transacciones1">
                    <?php
                    $toolbar1->SetBoton("agregarPuntoControl", "Nuevo", "btn", "onclick,onkeypress", "agregarPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 0);
                    $toolbar1->Mostrar();
                    ?> 
                </div>
                <div style="width: 100px; float: left; height: 100px;" id="Transacciones2">
                    <?php
                    $toolbar2->SetBoton("habilitarFormularioPuntoControl", "Editar", "btn", "onclick,onkeypress", "habilitarFormularioPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/edit2.png", "", "", 0);
                    $toolbar2->Mostrar();
                    ?>  
                </div>
                <div style="width: 100px; float: left; height: 100px;" id="Transacciones3">
                    <?php
                    $toolbar3->SetBoton("guardarPuntoControl", "Guardar", "btn", "onclick,onkeypress", "guardarPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filesave.png", "", "",0) ;
                    $toolbar3->Mostrar();
                    ?>  
                </div>    
                <div style="width: 100px; float: left; height: 100px;" id="Transacciones4">
                    <?php
                    $toolbar4->SetBoton("cancelarPuntoControl", "Cancelar", "btn", "onclick,onkeypress", "cancelarPuntoControl()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/button_cancel.png", "", "",0) ;
                    $toolbar4->Mostrar();
                    ?>  
                </div>    

            </div>

        </div>
    </div>

</fieldset>