<fieldset class="examenes" style="width:800px">
    <legend>&nbsp; B&uacute;squeda &nbsp;</legend>
    Nombre Ambiente:
    <input style=" width:300px; " type="text" name="txtNombreAmbienteLogico" id="txtNombreAmbienteLogico" onkeyup='buscarAmbienteLogicoPorNombre();'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="hidden" id="hdnIdHidden" value="<?php echo $hidden; ?>" />
    <input type="hidden" id="hdnIdText" value="<?php echo $text; ?>" />
</fieldset>

<div id="divTablaAmbientesLogicosEncontrados" style="width:800px; height:150px; background-color:#123789;"></div>
