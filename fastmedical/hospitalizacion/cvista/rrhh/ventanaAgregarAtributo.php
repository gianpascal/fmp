<div style=" width: 95%;" align="center" >
    <fieldset>
        <b> NUEVO ATRIBUTO </b>
    </fieldset>
</div>

<div style="margin: 10px;">
    <div style="height: 80%;">
        <div style="height: 20%; width:15%; float: left;">
            Atibuto:
        </div>
        <div style="height: 20%; width:65%; float: left;">
            <input type="text" id="txtNombre" name="txtNombre" onkeypress="javascript:buscarAtributo(document.getElementById('hNombre').value,document.getElementById('txtNombre').value,this,event);" size="12" value="" style="width:290px;" >
            <input type="hidden" id="hNombre" name="hNombre" size="12" value="<?php echo $documento; ?>" >
            <input type="hidden" id="hAtributo" name="hAtributo" size="12" value="" >
        </div>
        <div style="width: 18%; height: 20%; float: left;" id="DivEtiqueta">
                             <a href="javascript:buscarAtributo(document.getElementById('hNombre').value,document.getElementById('txtNombre').value,'','');">
                             <img border="0" title="Buscador de Atributos" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
        </div>
        <div id="divAtributo" style="height: 80%;width:85%;  float:left " align="center">
            <?Php
              echo $tablaNuevoAtributo;
            ?>
        </div>
    </div>

    <div style="height: 15%;">
        <div style="width:30%; margin:0px auto;">
             <a href="javascript:grabarAtributo(document.getElementById('hNombre').value,document.getElementById('hAtributo').value);"><img  id="imgagenGuardar" src="../../../../medifacil_front/imagen/btn/b_grabar_on.gif"/></a>
        </div>

    </div>

</div>