<fieldset style="height:100; width: 980px; float: left; margin-right:20px; ">
    <legend>Dientes</legend>
    <div  style="width: 980px;height:100px;  float: left;  ">
<!--            <img src="../../../../fastmedical_front/imagen/odontograma/odontograma.png" width="800" height="400" usemap="#Map"/>-->
        <canvas id="canvaDientesSeleccionados"   width="980px" height="80px" >

        </canvas>

    </div>
</fieldset>
<fieldset style="float: left;" id="antecedenteOdontograma_<?php echo $datos["numeroAntecedenteOdontograma"]; ?>">
    <legend>Antecedente o Procedimiento</legend>
    <form>
        <div style="float: left; width: 600px; padding: 10px; ">
            <div style=" width: 680px; float: left">
                <div style="float: left; margin-right:5px; ">Practica y/o Antecedente </div>
                <div style="float: left">
                    <input id="txtAntecedenteId_ventana" type="hidden" name="" value="" style="width:20px " />
                    <input id="txtAntecedenteNombre_ventana" type="text" name="" value="" style="width:400px " />
                    <input type="button" onclick="ventanaDiagnosticoDiente('')" value="..." style="cursor: pointer;"  >
                </div>

            </div>
            <div style=" width: 680px; float: left; margin: 10px;">
                <div id="divTercero_ventana" style="display: none;" >
                    <div style="float: left; margin-right:5px;">Realizado Por Tercero</div>
                    <div style="float: left; margin-right:5px;">
                        <select id="selectTercero_ventana" name="" >
                            <option value="">Seleccionar</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div id="divEstado_ventana" style="display: none;" >
                    <div style="float: left; margin-right:5px;">Estado</div>
                    <div style="float: left; margin-right:5px;">
                        <select id="selectestado_ventana" name="" >
                            <option value="">Seleccionar</option>
                            <option value="1">Bueno</option>
                            <option value="0">Malo</option>
                        </select>
                        <input type="hidden" id="colorSimbolo_ventana" value="1" />
                        <input type="hidden" id="dientesAfectados_ventana" value="1" />
                    </div>
                </div>
            </div>

        </div>
        <div style="float: left; width: 280px;" >
            <div style="float: left">Observaciones </div>
            <div style="float: left"><textarea id="texArea_ventana" name="" style="height: 100px;" ></textarea></div>

        </div>
        </div>
        <div id="btns" class="btns">
            <a onclick="javascript:agregarDiagnosticosDientes();" href="javascript:;">
                <img src="../../../../fastmedical_front/imagen/btn/b_agregar_on.gif">
            </a>
            <a onclick="javascript:cancelarDiagnosticoDientes();" href="javascript:;">
                <img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif">
            </a>
            
        </div>
        <input type="hidden" id="divTerceroBit">
        <input type="hidden" id="divEstadoBit">
        <input type="hidden" id="divCarasBit">


    </form>

</fieldset>