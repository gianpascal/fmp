<input id="numeroAntecedenteOdontogramaSeleccionado" type="hidden" value="<?php echo $datos["numeroAntecedenteOdontograma"]; ?>" />
<fieldset style="height:380px; width: 400px; float: left; margin-right:20px; ">
    <legend>
        Arbol antecedentes o Procedimientos
    </legend>
    <div id="" style="height:30px; width: 320px; float: left; ">
        Buscar:
        <input type="text" id="textoBusquedaArbol" value="" style="width:250px; " onkeypress="if(event.keyCode==13)buscarArbolDiagnosticoOdontolograma();"/>

    </div>
    <div style="float: left; width:40px;">
        <?php
        $toolbar1 = new ToollBar("Left");
        $toolbar1->SetBoton("siguiente", "Next", "btn", "onclick,onkeypress", "buscarArbolDiagnosticoOdontolograma()", "../../../../medifacil_front/imagen/icono/b_adelante.gif", "", "", true);
        $toolbar1->Mostrar();
        ?>
    </div>
    <div id="arbolOdontologia" style="height:320px; width: 380px; ">
    </div>
</fieldset>
<fieldset style="height:380px; width: 560px; float: left; ">
    <legend>
        Tabla antecedentes o Procedimientos
    </legend>
    <div id="" style="height:30; width: 320px; float: left; ">
        Buscar:
        <input type="text" id="textoBusquedaTabla" value="" style="width:250px; " onkeypress="buscarTablaOdontologia(event);"/>

    </div>
    <div id="tablaOdontologia" style="height:345; width: 480px; border-color: #003db8; float: left ">
        
    </div>

</fieldset>