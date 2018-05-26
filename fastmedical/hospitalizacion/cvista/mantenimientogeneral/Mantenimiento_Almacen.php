<div style="width:900px; height: 800px; margin:5px auto; border: #006600 solid">
    <div class="titleform" style="width:900px;">
        <h1>Mantenimiento de Almacenes</h1>
    </div>
    <br>
    <div class="titleform" style="height:650px; width:900px; boorder: #006600 solid; float:inherit">
        <h1>Almacenes</h1>
        <div  id="divresultadoalmacenes" style="height:630px; width:900px;"> 
        </div>
        <br>
    </div>
    <?php
    $toolbar1 = new ToollBar();
    ?>
    <div style="width: 90px; float: inherit; padding-top: 50px; padding-left: 400px">
        <?php
        $toolbar1->SetBoton("nuevoAlmacen", "Nuevo", "btn", "onclick,onkeypress", "nuevoAlmacen()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/nuevo.png", "", "", 1);
        $toolbar1->Mostrar();
        ?> 
    </div></div>