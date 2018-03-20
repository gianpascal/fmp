<div style=" width: 95%;" align="center" >
    <fieldset>
        <b> EDICION DE ESPECIALIDAD </b>
    </fieldset>
</div>

<div style="margin: 10px;">    
        <div style="height: 30%; width:20%; float: left;">
            Nombre*:
        </div>
        <div style="height: 30%; width:75%; float: left;">
            <input type="text" id="txtNombre" name="txtNombre" size="12" value="<?php echo $nombre; ?>" style="width:290px;" >
        </div>  

    <div style="height: 15%;">
        <div style="width:30%; margin:0px auto;">
             <input type="hidden" id="hNombre" name="hNombre" size="12" value="<?php echo $especialidad; ?>" >
             <input type="text" id="hProf" name="hProf" size="12" value="<?php echo $profesion; ?>" >
             <a href="javascript:editarEspecialidad(document.getElementById('hNombre').value,document.getElementById('txtNombre').value,document.getElementById('hProf').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
        </div>

    </div>

</div>