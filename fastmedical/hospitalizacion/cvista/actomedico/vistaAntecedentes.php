
<fieldset class="examenes" style="width:800px">
    <legend>&nbsp; B&uacute;squeda &nbsp;</legend>
    Nombre Cie:
    <input style=" width:300px; " type="text" name="textNombreCie" value="" id="textNombreCie" onkeyup='buscarCieNombre(event);'>
    C&oacute;digo:
    <input style=" width:70px; " type="text" name="textCodigoCie" value="" id="textCodigoCie" onkeyup='buscarCieCodigo();'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:;" onclick="javascript:agregarOtro_ActoMedico('antecedentes');">
        <img id="btn_agregarotro" src='../../../../medifacil_front/imagen/btn/btn_agregarotro.png' alt="">
    </a>
</fieldset>

<div id="tablaCie" style="width:800px; height:150px; background-color:#FBFBFB;" onscroll="alert('scoll');">
   
</div>
<fieldset class="examenes" style="width:900px">
    <div style="float: right; margin-top:3px;"  >
        <a href="javascript:;" onclick="javascript:verAntecedentesAnteriores();">
            <img id="icono_abrir" src='../../../../medifacil_front/imagen/icono/abrir.png' alt="">
        </a>
    </div>
    <a href="javascript:;" onclick="javascript:verAntecedentesAnteriores();">
        <h2>Antecedentes Anteriores</h2>
    </a>
    
    <input type="hidden" id="habierto" value="0" />
    <div id="divAntecedentesAnteriores" style="height:100px; display: none; margin:3px;  ">
        hi
    </div>
</fieldset>
<input type="hidden" id="hdnCadenaIdCieAntecedentes" name="hdnCadenaIdCieAntecedentes" value="<?php echo $valorHdnCadenaIdCieAntecedentes; ?>">
<div id="divAntecedentes">


