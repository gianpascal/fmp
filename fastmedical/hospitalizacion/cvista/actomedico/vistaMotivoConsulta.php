<fieldset class="examenes" style="width:800px;  ">
    <legend></legend>
    S&iacute;ntomas:
    <input style="width:300px;" type="text" name="txtNombreSintoma" value="" id="txtNombreSintoma" onkeyup='buscarSintomaNombre(event);'>
    C&oacute;digo:
    <input style="width:70px;" type="text" name="txtCodigoSintoma" value="" id="txtCodigoSintoma" onkeyup='buscarSintomaCodigo();'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <!--<a href="javascript:;" onclick="javascript:agregarOtro_ActoMedico('motivoconsulta');">-->
    <a href="javascript:;" onclick="javascript:agregarOtroMotivoDeConsultaDesdeBoton();">
        <img id="btn_agregarotro" src='../../../../fastmedical_front/imagen/btn/btn_agregarotro.png' alt="Agregar otro sintoma">
    </a>
</fieldset>

<div id="divTblSintomas" style="width:800px; height:150px; background-color:#FBFBFB;" onscroll="alert('scoll');">
</div>
<fieldset class="examenes" style="width:900px">
    <div style="float:right; margin-top:3px;"  >
        <a href="javascript:;" onclick="javascript:verMotivoConsultaAnteriores();">
            <img id="icono_abrirMotivoConsultaAnteriores" src='../../../../fastmedical_front/imagen/icono/abrir.png' alt="Abrir">
        </a>
    </div>
    <a href="javascript:;" onclick="javascript:verMotivoConsultaAnteriores();">
        <h2>Motivos de Consulta Anteriores</h2>
    </a>

    <input type="hidden" id="hdnAbiertoMotivoConsultaAnteriores" value="0"/>
    <div id="divMotivoConsultaAnteriores" style="height:100px; display: none; margin:3px;">

    </div>
</fieldset>
<input type="hidden" id="hdnCadenaIdCieSintomas" name="hdnCadenaIdCieSintomas" value="<?php echo $valorHdnCadenaIdCieSintomas; ?>">
<div id="Div_sintomas">