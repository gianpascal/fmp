<?php
    $hidden = $_REQUEST["p1"];
    $text = $_REQUEST["p2"];
?>
<fieldset class="examenes" style="width:800px">
    <legend>&nbsp; B&uacute;squeda &nbsp;</legend>
    Nombre Servicio:
    <input style=" width:300px; " type="text" name="txtNombreServicioCirugia" value="" id="txtNombreServicioCirugia" onkeyup='buscarServicioNombreCirugia();'>
    C&oacute;digo:
    <input style=" width:70px; " type="text" name="txtCodigoServicioCirugia" value="" id="txtCodigoServicioCirugia" onkeyup='buscarServicioCodigoCirugia();'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <!--<a href="javascript:;" onclick="javascript:agregarOtro_ActoMedico('antecedentes');">
        <img id="btn_agregarotro" src='../../../../medifacil_front/imagen/btn/btn_agregarotro.png' alt="">
    </a>-->
    <input type="hidden" id="hdnIdHidden" value="<?php echo $hidden; ?>" />
    <input type="hidden" id="hdnIdText" value="<?php echo $text; ?>" />
</fieldset>

<!--<div id="divTablaServicioCirugia" style="width:800px; height:150px; background-color:#123789;" onscroll="alert('scoll');">-->
<div id="divTablaServicioCirugia" style="width:800px; height:150px; background-color:#123789;">
    
</div>
