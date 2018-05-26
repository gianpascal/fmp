<div id="Div_AmbFisicoGeneral" style="width: 99.5%;height: 80%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:block">
    <div>
        <div style="width:100%;height:5%;background: white">
            <div class="titleform">
                <h1>MANTENIMIENTO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;TURNOS</h1>
            </div>
        </div>
        <div style="width:100%;height:5%">
        </div>
        <div style="width:100%;height:85%">
            <center>
                <div id="contenido_detalle" style="width: 96%;height:90%;">
                </div>
            </center>
            <div style="width:100%;height:5%">
            </div>
            <center>
                <div id="botones" style="height:10%;">
                    <?php
                    if ($_SESSION["permiso_formulario_servicio"][206]["NUEVO_TURNO"] == 1) {
                        echo "<a href='#' onclick=\"cargarPopadTurnosTabla(0);\"><img src=\"../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif\" alt='Nuevo' title='Nuevo' border='0'/></a>";
                    }
                    ?>
                </div>
            </center>
        </div>
    </div>
</div>
<input type="hidden" id="var1">
<input type="hidden" id="var2">
<input type="hidden" id="var3">
<input type="hidden" id="var4">
<input type="hidden" id="var5">
<input type="hidden" id="var6">
<input type="hidden" id="var7">
<input type="hidden" id="accion">