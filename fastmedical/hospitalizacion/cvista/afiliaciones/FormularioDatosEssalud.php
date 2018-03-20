<div style="width:100%;height:5%;background: white">
    <div class="titleform">
        <h1>Datos de Essalud</h1>
    </div>
</div>
<br>
<div>
    <fieldset id="fsDetalle" style="padding:5px;">
        <legend>Datos de la Persona</legend>
        <div style="float:left;width: 150px;">
            CodPer:
        </div>
        <div style="float:left;width: 150px;">
            <input id="CodPer" type="text" style="width: 70px;">
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            Codigo Autogenerado:
        </div>
        <div style="float:left;width: 150px;">
            <input id="txtCodiAuto"type="text" onChange="verificarCodAutogenerado()">
        </div>
        <br><br>
        <div style="float:left;width: 150px;">
            Ubigeo Domicilio:
        </div>
        <div style="float:left;width: 150px;">
            <input id="Ubigeo" type="text" style="width: 80px;">
        </div>
        <br><br>
        <div style="float:left;width: 150px;">
            Desde:
        </div>
        <div style="float:left;width: 180px;">
            <p> 
<!--                <input id="Desde" type="text" style="width: 80px;">-->
                <input id="Desde" type="text" onblur="esFechaValida(this);" onclick="calendarioHtmlx('Desde');" name="Desde"  value="" style="width:80px;" />
                <b>dd/mm/aaaa</b></p>
        </div>
        <br><br>
        <div style="float:left;width: 150px;">
            Hasta:
        </div>
        <div style="float:left;width: 180px;">
            <p>
<!--                <input id="Hasta" type="text" style="width: 80px;">-->
                <input id="Hasta" type="text" onblur="esFechaValida(this);" onclick="calendarioHtmlx('Hasta');" name="Hasta"  value="" style="width:80px;" />
                <b>dd/mm/aaaa</b> </p>
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            Nro Doc:
        </div>
        <div style="float:left;width: 160px;">
            <p><input id="Doc" type="text"  style="width: 110px;"> <b>DNI</b></p>
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            Apellido Paterno:
        </div>
        <div style="float:left;width: 150px;">
            <input id="ApePat" type="text">
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            Apellido Materno:
        </div>
        <div style="float:left;width: 150px;">
            <input id="ApeMat" type="text">
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            1er Nombre:
        </div>
        <div style="float:left;width: 150px;">
            <input id="Nomb1" type="text">
        </div>
        <br><br>
        <div style="float:left;width: 150px;" >
            2do Nombre:
        </div>
        <div style="float:left;width: 150px;">
            <input id="Nomb2" type="text">
        </div>
        <br><br>
        <div style="float:left;width: 150px;">
            Sexo:
        </div>
        <div style="float:left;width: 210px;">
            <p><input id="Sexo" type="text" style="width: 70px;"> <b>0: Mujer / 1: Varon</b></p>
        </div>
        <br><br>
        <div style="float:left;width: 150px;">
            Fecha Nac.:
        </div>
        <div style="float:left;width: 150px;">
<!--            <input id="FechaNac" type="text" style="width: 70px;">-->
            <input id="FechaNac" type="text" onblur="esFechaValida(this);" onclick="calendarioHtmlx('FechaNac');" name="FechaNac"  value="" style="width:80px;" />
        </div>
        <br>
        <div style="float:left;width: 150px;">
            <input id="AccionEss" type="hidden" style="width: 70px;">
        </div>
        <br><br>
    </fieldset>
    <br>
    <?php
    $toolbar1 = new ToollBar();
    $toolbar2 = new ToollBar();
    ?>
    <div style="padding-left:90px; float:left;"><?php
    $toolbar1->SetBoton("Guardar", "Guardar", "btn", "onclick,onkeypress", "GuardarDatosEssalud()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/grabar.png", "", "", 1);
    $toolbar1->Mostrar();
    ?> 
    </div>
    <div id="button4" style="float:left; width: 50px; border: 1px  solid white;"></div>
    <div style="float:left;">
        <?php
        $toolbar2->SetBoton("Link", "", "btn", "onclick,onkeypress", "abrirEssalud", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/images.jpg", "", "", 1);
        $toolbar2->Mostrar();
        ?> 
    </div>
    <br>
</div>