<div id="Div_Tratamiento" style="width:100%;float: left   "  >
    <div id="Div_TratamientoEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_TratamientoCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Procedimientos Médicos y/o Interconsultas</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_TratamientoCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_TratamientoCuerpo" style="width: 95%;height: auto;display:block">
           <input type="hidden" id="hNumeroTratamientoPracticasMedicas" name="hNumeroTratamientoPracticasMedicas" value="0" />
    <div id="Div_Busqueda">
        <fieldset class="examenes" style="width: 800px">
            <legend>B&uacute;squeda</legend>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td><input id="txtbusquedaNombrePracticasMedicas" type="text" onkeyup='busquedaTratamientoPracticaNombre(event)' value="" name="txtbusquedaNombrePracticasMedicas" style="width: 300px"/></td>
                    <td>C&oacute;digo</td>
                    <td><input id="txtbusquedaCodigoPracticasMedicas" type="text" onkeyup='buscarTratamientoPracticaCodigo()' value="" name="txtbusquedaCodigoPracticasMedicas" style="width: 70px"/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="Div_TablaTratamientoPracticasMedicasHC" style="width:85%;height: 25%"></div>
    <fieldset class="examenes" style="width:85%">
        <div style="float: right; margin-top:3px;"  >
            <a href="javascript:;" onclick="javascript:verPracticasMedicasAnteriores();">
                <img id="icono_abrirPracticasMedicasAnteriores" src='../../../../fastmedical_front/imagen/icono/abrir.png' alt="">
            </a>
        </div>
        <a href="javascript:;" onclick="javascript:verPracticasMedicasAnteriores();"> 
            <h2>Procedimentos M&eacute;dicos y/o Interconsultas Anteriores</h2>
        </a>
        <input type="hidden" id="habiertoPracticasMedicasAnteriores" value="0" />
        <div id="Div_PracticasMedicasAnteriores" style="height:100px; display: none; margin:3px;  ">

        </div>
    </fieldset>
    <input type="hidden" id="htxtcodigosServicios" name="htxtcodigosServicios" value="" />
    <div id="Div_TratamientoPracticasHC" style="width:85%;height: auto">
        &nbsp;
        &nbsp;
    </div>
    </div>
</div>
<script>
    cargaTratamientosPracticasMedicasPreguardados();
</script> 