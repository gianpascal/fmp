<div style=" width: 95%;" align="center" >
    <fieldset>
        <b> NUEVO DOCUMENTO </b>
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
        <div style="height: 40%; width:20%; float: left;">
            Descripción:
        </div>
        <div style="height: 40%; width:75%; float: left;">
            <textarea name="txtDescripcion" rows="1"  id="txtDescripcion" style=" width:290px; font-family: sans-serif" onfocus="" onblur="" onkeypress=""></textarea>
        </div>
        <div id="divDocumento" style="height: 9%;">
            Los datos con * son obligatorios
        </div>
    </div>

    <div style="height: 20%;">
        <div style="width:30%; margin:0px auto;">
             <a href="javascript:grabarDocumento(document.getElementById('txtNombre').value,document.getElementById('txtDescripcion').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
        </div>
    </div>

</div>