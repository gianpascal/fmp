<div style=" width: 95%;" align="center" >
    <fieldset>
        <b> NUEVA ESPECIALIDAD </b>
    </fieldset>
</div>

<div style="margin: 10px;">
    <div style="height: 60%;">
        <div style="height: 40%; width:20%; float: left;">
            Nombre*:
        </div>
        <div style="height: 40%; width:75%; float: left;">
            <input type="text" id="txtNombre" name="txtNombre" size="12" value="" style="width:290px;" >
        </div>
       
        <div id="divProfesion" style="height: 9%;">
            Los datos con * son obligatorios
        </div>
    </div>

    <div style="height: 15%;">
        <div style="width:30%; margin:0px auto;">
             <input type="hidden" id="hNombre" name="hNombre" size="12" value="<?php echo $profesion; ?>" >
             <a href="javascript:grabarEspecialidad(document.getElementById('hNombre').value,document.getElementById('txtNombre').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
        </div>

    </div>

</div>