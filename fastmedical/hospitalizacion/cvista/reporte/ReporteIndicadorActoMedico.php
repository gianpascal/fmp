<center>
    <div style="height: 2080px; width: 1200px; border:1px solid rgba(0,0,0,0.5);background-color:#E5F2C6;">
        <div style="padding-left:15px; padding-right: 15px;border:1px  rgba(0,0,0,0.5);float:left;background-color:#E5F2C6; width: 322px;height: 2052px;display:inline;">
            <br>
            <fieldset style="height: 230px;  padding-top: 10px;width: 330">
                <legend>Filtro Por:</legend>
                <table border="1" cellSpacing="0" width="300" style="">
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px;  font-family: Andale Mono, monospace;">Estados</td>
                        <td id="1"><center><a href="javascript:abrirPopapOpciones('1')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Tipo Atención</td>
                        <td id="8"><center><a href="javascript:abrirPopapOpciones('8')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Tipo Programacion</td>
                        <td id="9"><center><a href="javascript:abrirPopapOpciones('9')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Médicos</td>
                        <td id="2"><center><a href="javascript:abrirPopapOpciones('2')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Servicios</td>
                        <td id="3"><center><a href="javascript:abrirPopapOpciones('3')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Ambientes L.</td>
                        <td id="4"><center><a href="javascript:abrirPopapOpciones('4')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Ambientes F.</td>
                        <td id="5"><center><a href="javascript:abrirPopapOpciones('5')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Sedes</td>
                        <td id="6"><center><a href="javascript:abrirPopapOpciones('6')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                    <tr onMouseOver='this.style.background="#CDE596";'onMouseOut='this.style.background="white";'>
                        <td style="padding-left: 15px;font-size:16px; font-family: Andale Mono, monospace;">Turno</td>
                        <td id="7"><center><a href="javascript:abrirPopapOpciones('7')"><img src="../../../../fastmedical_front/imagen/icono/abrir.png"></a></center></td>
                    </tr>
                </table>
            </fieldset>
            <div><input type="text" id="oculto"></div>
            <div><input type="text" id="oculto2"></div>
             <div><input type="text" id="cont"></div>
            <br>
            <fieldset style="height: 1768px; padding: 15px;  background-image:url('../../../imagen/graficos/fondo.jpg');">
                <legend>Filtros:</legend>

                <fieldset id="con1" style="border:0px;">
                    <legend>Estados:</legend>
                    <div id="contenedorfiltros1" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset id="con2" style="border:0px;" >
                    <legend>Tipo Atencion:</legend>
                    <div id="contenedorfiltros2" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con3"style="border:0px;">
                    <legend>Tipo Programacion:</legend>
                    <div id="contenedorfiltros3" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset id="con4" style="border:0px;">
                    <legend>Medicos:</legend>
                    <div id="contenedorfiltros4" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con5" style="border:0px;">
                    <legend>Servicios:</legend>
                    <div id="contenedorfiltros5" style="border:1px solid rgba(0,100,255,0.2) ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con6" style="border:0px;">
                    <legend>Ambientes Logicos:</legend>
                    <div id="contenedorfiltros6" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con7" style="border:0px;">
                    <legend>Ambientes Fisicos:</legend>
                    <div id="contenedorfiltros7" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con8" style="border:0px;">
                    <legend>Sedes:</legend>
                    <div id="contenedorfiltros8" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;">
                    </div>
                </fieldset>
                <fieldset  id="con9" style="border:0px;">
                    <legend>Turnos:</legend>
                    <div id="contenedorfiltros9" style="border:1px solid rgba(0,100,255,0.2)  ;font-family: Andale Mono, monospace;"">
                </div>
            </fieldset>
            <fieldset  id="con10" style="border:0px;">
                <legend>Tipo grafico:</legend>
                <div>
                    <div id="contenedorfiltros10" style="float:left;width:300;height:200;margin:20px;border:1px solid #A4BED4;"></div>
                </div>
                <div style="padding-left: 30%;">
                    <?php $toolbar1 = new ToollBar(); ?>
                    <?php
                    $toolbar1->SetBoton("Cambiar", "Cambiar Grafico", "btn", "onclick,onkeypress", "cambiarGrafico()", "../../../../fastmedical_front/imagen/icono/Download.png", "", "", true);
                    $toolbar1->Mostrar();
                    ?> 
                </div>
            </fieldset>
        </fieldset>
        <br>
    </div>
    <div style="border:1px  rgba(0,0,0,0.5);float:left;background-color:#E5F2C6; width:845px;height: 175px;">
        <div style="padding-left:40px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>Busqueda:</legend>
                <div id="ComboSelect" style="float:left;padding: 25px; width: 120px;">
                    <p style="font-size:14px;">Escala :  
                        <select id="comboEscala" style="font-size:14px;" onchange="MostrarDivDeBusqueda(this.options[this.selectedIndex].value);">
                            <option value="1">Diario</option>
                            <option value="2">Mensual</option>
                            <option value="3">Trimestral</option>
                            <option value="4">Semestral</option>
                            <option value="5">Anual</option>
                        </select>
                </div>
                <div id="Dia" style="float:left;padding: 25px; width: 107px;">
                    <p style="font-size:14px;">Desde :  
                        <input id="txtDia1" type="text" name="txtDia" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtDia1')" onkeypress="return validar(event,4)" maxlength="10" value="01/01/2012" onchange="ValidarFechasRangos('txtDia1','txtDia2',1)">
                </div>
                <div id="Dia2" style="float:left;padding: 25px; width: 107px;">
                    <p style="font-size:14px;">Hasta :  
                        <input id="txtDia2" type="text" name="txtDia2" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtDia2')" onkeypress="return validar(event,4)" maxlength="10" value="01/01/2012" onchange="ValidarFechasRangos('txtDia2','txtDia1',2)">
                </div>
                <div id="Trimestral" style="float:left;padding: 25px; width: 133px;">
                    <p style="font-size:14px;">Trimestre Inicio :  
                        <select id="trimestre1" style="font-size:14px;">
                            <option value="1">I Trimestre</option>
                            <option value="2">II Trimestre</option>
                            <option value="3">III Trimestre</option>
                            <option value="4">IV Trimestre</option>
                        </select>
                </div>
                <div id="YearTre" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYearTre1"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtYearTre1','txtYearTre2',1)">
                </div>
                <div id="Trimestral2" style="float:left;padding: 25px; width: 133px;">
                    <p style="font-size:14px;">Trimestre Fin :  
                        <select id="trimestre2" style="font-size:14px;">
                            <option value="1">I Trimestre</option>
                            <option value="2">II Trimestre</option>
                            <option value="3">III Trimestre</option>
                            <option value="4">IV Trimestre</option>
                        </select>
                </div>
                <div id="YearTre2" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYearTre2"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtYearTre2','txtYearTre1',2)">
                </div>
                <div id="Mes" style="float:left;padding: 25px; width: 100px;">
                    <p style="font-size:14px;">Mes Inicio : 
                        <select id="cbxMes1" style="font-size:14px;">
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                </div>
                <div id="Year" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYear1"  maxlength="4" size="3" value="2012"  onchange="ValidarFechasRangos('txtYear1','txtYear2',1)">
                </div>
                <div id="Mes2" style="float:left;padding: 25px; width: 100px;">
                    <p style="font-size:14px;">Mes Fin : 
                        <select id="cbxMes2" style="font-size:14px;">
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                </div>
                <div id="Year2" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYear2"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtYear2','txtYear1',2)">
                </div>
                <div id="Semestral" style="float:left;padding: 25px; width: 100px;">
                    <p  style="font-size:14px;">Semestral Inicio:  
                        <select id="semestre1" style="font-size:14px;">
                            <option value="1">I Semestre</option>
                            <option value="2">II Semestre</option>
                        </select>
                </div>
                <div id="YearSe" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYearSe1"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtYearSe1','txtYearSe2',1)">
                </div>
                <div id="Semestral2" style="float:left;padding: 25px; width: 100px;">
                    <p  style="font-size:14px;">Semestral Fin :  
                        <select id="semestre2" style="font-size:14px;">
                            <option value="1">I Semestre</option>
                            <option value="2">II Semestre</option>
                        </select>
                </div>
                <div id="YearSe2" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año : 
                        <input type="text" id="txtYearSe2"  maxlength="4" size="3" value="2012"  onchange="ValidarFechasRangos('txtYearSe2','txtYearSe1',2)">
                </div>
                <div id="Anual" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año Inicio : 
                        <input type="text" id="txtAnual1"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtAnual1','txtAnual2',1)">
                </div>
                <div id="Anual2" style="float:left;padding: 25px; width: 70px;">
                    <p style="font-size:14px;">Año Fin: 
                        <input type="text" id="txtAnual2"  maxlength="4" size="3" value="2012" onchange="ValidarFechasRangos('txtAnual2','txtAnual1',2)">
                </div>
            </fieldset>
            <div style="float:left;width: 400px; padding-left: 42%;">
                <br>
                <?php $toolbar = new ToollBar(); ?>
                <?php
                $toolbar->SetBoton("Buscar", "Ver Estadisticas", "btn", "onclick,onkeypress", "verGraficosEstadisticos()", "../../../../fastmedical_front/imagen/icono/estadisticas.jpg", "", "", true);
                $toolbar->Mostrar();
                ?> 
            </div>
        </div>
    </div>
    <div style="float:left; width: 42px"><br></div>
    <div style="border:1px solid rgba(0,0,0,0.5);float:left; width:790px;height:1900px;display:inline;background-color:white;">
        <div style="padding:15px;">
            <h1 style="color:black; font-size:21px;color:green;"> G r á f i c o &nbsp;&nbsp;&nbsp;&nbsp; E s t a d í s t i c o s</h1>
            <br>
            <br>
            <input type="hidden" id="numeroGraficos" value="1" />
            <div id="divTodosGraficos" style="padding:15px; height:700px;width: 700px; overflow: auto ">

            </div>

        </div>
    </div>

</div>
</center>