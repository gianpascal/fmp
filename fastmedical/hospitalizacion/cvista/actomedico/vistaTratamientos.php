<div id="Div_TratamientoMedicamentosoHCEncabezado" class="accordion_subcabecera" onclick="javascript:abrirDiv('Div_TratamientoMedicamentosoHCCuerpo');">
    <table style="height: auto;width: 100%" class="accordion_title">
        <tr align="center">
            <td style="font-size:14px; font-weight: bold">
                Receta &uacute;nica estandarizada
            </td>
            <td style="width:3%">
                <img id="Div_TratamientoMedicamentosoHCCuerpoicono" src='../../../../medifacil_front/imagen/icono/plegar.png' title='plegar' alt=""/>
            </td>
        </tr>
    </table>
</div>

<div id="Div_TratamientoMedicamentosoHCCuerpo" style="width: 100%;display:block;border-style: solid;border-width: 1px">
    <input type="hidden" id="hNumeroTratamientoMedicamentoso" name="hNumeroTratamientoMedicamentoso" value="0" />
    <div id="Div_Busqueda">
        <fieldset class="examenes" style="width: 800px">
            <legend>B&uacute;squeda</legend>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td><input id="txtbusquedaNombreTratamientoMedicamentoso" type="text" onkeyup='busquedaTratamientoMedicamentosoNombre(event)' value="" name="txtbusquedaNombre" style="width: 300px"/></td>
                    <td>C&oacute;digo</td>
                    <td><input id="txtbusquedaCodigoTratamientoMedicamentoso" type="text" onkeyup='buscarTratamientoMedicamentosoCodigo()' value="" name="txtbusquedaCodigo" style="width: 70px"/></td>
                    <td>Receta Nro:</td>
                    <td><select id="nroReceta">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <input style="width:30px" type="text" id="hcantidadRecetas" value="0" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="Div_TablaTratamientoMedicamentosoHC" style="width:85%;height: 25%"></div>
    <fieldset class="examenes" style="width:85%">
        <div style="float: right; margin-top:3px;"  >
            <a href="javascript:;" onclick="javascript:verRecetasAnteriores();">
                <img id="icono_abrirRecetasAnteriores" src='../../../../medifacil_front/imagen/icono/abrir.png' alt="abrir">
            </a>
        </div>
        <a href="javascript:;" onclick="javascript:verRecetasAnteriores();">
            <h2>Tratamientos Medicamentosos Anteriores</h2>
        </a>
        <input type="hidden" id="habiertoRecetasAnteriores" value="0" />
        <div id="Div_RecetasAnteriores" style="height:100px; display: none; margin:3px;  ">

        </div>
    </fieldset>

    <!--<div id="divAntecedentes"></div>-->

    <div id="divRecetaGeneral" style="width:1000px;height: auto">
    </div>



</div>
<div id="Div_TratamientoPracticasMedicasHCEncabezado" class="accordion_subcabecera" onclick="javascript:abrirDiv('Div_TratamientoPracticasMedicasHCCuerpo');">
    <table style="height: auto;width: 100%" class="accordion_title">
        <tr align="center">
            <td style="font-size:14px; font-weight: bold">
                Procedimientos M&eacute;dicos y/o Interconsultas
            </td>
            <td style="width:3%">
                <img id="Div_TratamientoPracticasMedicasHCCuerpoicono" src='../../../../medifacil_front/imagen/icono/plegar.png' title='plegar' alt=""/>
            </td>
        </tr>
    </table>
</div>
<div id="Div_TratamientoPracticasMedicasHCCuerpo" style="width: 100%;display:block;border-style: solid;border-width: 1px">
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
                <img id="icono_abrirPracticasMedicasAnteriores" src='../../../../medifacil_front/imagen/icono/abrir.png' alt="">
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
<script>
    cargaTratamientosMedicamentososPreguardados();
    cargaTratamientosPracticasMedicasPreguardados();
</script> 

