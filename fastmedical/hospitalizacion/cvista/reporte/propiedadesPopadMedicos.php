<div style="padding-left: 10px;">
    <div style="float:left">
        <fieldset style="height:26%; padding-top: 10px; padding-left: 25px;">
            <legend>Busqueda :</legend>
            <br>
            <div style="float:left ; width: 50px;">
                <p style="font-size: 14;">Codigo:
            </div>
            <div style="float:left ; width: 150px;">
                <input type="text" id="CodPer">
            </div>
            <div style="float:left ; width: 50px;">
                <p style="font-size: 14;">DNI :
            </div>
            <div style="float:left ; width: 150px;">
                <input type="text" id="dni">
            </div>
            <div style="float:left ; width: 90px;">
                <p style="font-size: 14;">Apellido Pat.:
            </div>
            <div style="float:left ; width: 150px;">
                <input type="text" id="txtApellidoPat">
            </div>
            <br><br>
            <div style="float:left ; width: 90px;">    
                <p style="font-size: 14;">Apellido Mat.:
            </div>
            <div style="float:left ; width: 160px;">
                <input type="text" id="txtApellidoMat">
            </div>
            <div style="float:left ; width: 100px;">
                <p style="font-size: 14;">Nombres :
            </div>
            <div style="float:left ; width: 70px;">
                <input type="text" id="txtApellidoNom">
            </div>  
            <div style="float:left ; width: 70px; padding-left: 100px;">
               <?php $toolbar = new ToollBar(); ?>
                    <?php
                    $toolbar->SetBoton("Buscar", "Buscar", "btn", "onclick,onkeypress", "cargarTablaPersonal()", "../../../../medifacil_front/imagen/icono/kappfinder.png", "", "", true);
                    $toolbar->Mostrar();
                    ?> 
            </div> 
        </fieldset>
    </div>
    <br><br>
    <div style="float:left">
        <fieldset style="width: 645px;height:58%; padding: 10px;">
            <legend>Resultado :</legend>
            <div id="tablaPersonal" style="width:645px; height:94%;">

            </div>
        </fieldset>
    </div>
</div>