<div style="width:900px; height: 700px; margin:5px auto; border: #006600 solid">
    <div class="titleform" style="width:900px;">
        <h1>Mantenimiento de Unidades de Medida</h1>
    </div>
    <br>
    <div  style="height:450px; width:25px; float:left">
    </div>
    <div class="titleform" style="height:450px; width:400px; boorder: #006600 solid; float: left ;border-radius: 30px;">
        <h1>Tipo de Unidad de Medida</h1>
        <div  id="divTiposUnidadesMedida" style="height:425px; width:398px;"> 
        </div>
    </div>
    <div  style="height:450px; width:50px; float:left">
    </div>
    <div class="titleform" style="height:450px; width:400px; boorder: #006600 solid; float:left;border-radius: 30px;">
        <h1>Medidas</h1>
        <div  id="divUnidadesMedida" style="height:425px; width:398px;" > 
        </div>
    </div>
    <div  style="height:450px; width:25px; float:left">
    </div>
    <?php
    $toolbar1 = new ToollBar();
    ?>
    <?php
    $toolbar2 = new ToollBar();
    ?>
    <div style="width:900px; height:20px;float:left"></div>
    <div style="width:50px; height:20px;float:left"></div>
    <div style="width:380px; height:20px;float:left;">
        <div style="float:inherit; padding-left:150 ">
            <?php
            $toolbar1->SetBoton("popadTipoUnidaMedida", "Agregar", "btn", "onclick,onkeypress", "popadTipoUnidaMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/nuevo.png", "", "", 1);
            $toolbar1->Mostrar();
            ?> 
        </div>
    </div>
    <div style="width:40px; height:20px;float:left"></div>
    <div style="width:380px; height:20px;float:left">
        <div style="float:inherit; padding-left:150 ">
            <?php
            $toolbar2->SetBoton("agregarUnidadMedida", "Agregar", "btn", "onclick,onkeypress", "popadUnidaMedida()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/nuevo.png", "", "", 1);
            $toolbar2->Mostrar();
            ?> 
        </div>
    </div>
    <div style="width:50px; height:20px;float:inherit"><input type="text" id="txtNumeroEscondido" name="txtNumeroEscondido" style=" display:none ; width:20px;" value=""></div>
</div>