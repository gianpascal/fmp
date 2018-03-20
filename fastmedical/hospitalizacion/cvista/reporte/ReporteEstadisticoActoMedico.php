<style>
    .btnReportes{
        width: 130px;
        height: 25px;
        font-size:14px;
        font-family: verdana;
        color:white;
        background: green;
        border:2px solid cadetblue;
        text-align: center;
        padding-top: 5px;
    }
    .btnReportes:hover{
        background: cadetblue;
        border:2px solid green;
        cursor: pointer;
        transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -webkit-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -moz-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -o-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -ms-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
    }
    .tablaEstados{
        margin: 0px;
        border:1px solid cadetblue;
        width: 100%;
        height: 85px;
    }
    .cabeceraEstado{
        background: cadetblue;
        text-align: center;
        color:white;

    }
    .btnReportesExportar{
         font-size:14px;
        font-family: verdana;
        margin-left: 10px;
    }
    .btnReportesExportar:hover{
        transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -webkit-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -moz-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -o-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        -ms-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px); 
    }
</style>

<div style="height: 680px;width: 100%;overflow-y: scroll;overflow-x: hidden"><style>
        .img:hover{
            transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
            -webkit-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
            -moz-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
            -o-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
            -ms-transform: rotate(0deg) scale(1.056) skew(1deg) translate(0px);
        }
    </style>
    <center>
        <div id="parentId1" style="position: relative; top: 5px; left: 5px; width: 1215px; height:1750px;">
        </div>
        <div id="parentId2"  style="position: relative; top: 5px; left: 5px; width:915px; height:99%;display:none;">
        </div>
        <div id="parentId3"  style="position: relative; top: 5px; left: 5px; width:99%; height:99%;display:none;">
        </div>
        <div id="contenedorMAmbientes" style="position: relative; top: 5px; left: 5px; width:98%; height:99%;display:none;">    
        </div>
        <div id="estadosatencionprogramacion">
            <table class="tablaEstados">
                <tr class="cabeceraEstado">
                    <td>Estados</td>
                    <td>Atencion</td>
                    <td>Programacion</td>
                </tr>
                <tr style="font-size:8px;">
                    <td>
                        <p><input title="Reservado" type="checkbox" name="chkEstado_1" id="chkEstado_1" onClick="cargaraFiltro('chkEstado_1','Reservados','1')">Reserv.&nbsp;&nbsp;
                        <p><input title="Por Atender" type="checkbox" name="chkEstado_2" id="chkEstado_2" onClick="cargaraFiltro('chkEstado_2','Por Atender','1')">x Atender&nbsp;&nbsp;
                        <p><input title="Atendido" type="checkbox" name="chkEstado_3" id="chkEstado_3" onClick="cargaraFiltro('chkEstado_3','Atendidos','1')">Atendido&nbsp;&nbsp;

                    </td>
                    <td>
                        <p><input title="Consulta" type="checkbox" name="chkAtencion_1" id="chkAtencion_1" onClick="cargaraFiltro('chkAtencion_1','Consulta','2')">Consulta&nbsp;&nbsp;
                        <p><input title="Procedimiento" type="checkbox" name="chkAtencion_2" id="chkAtencion_2" onClick="cargaraFiltro('chkAtencion_2','Procedimiento','2')">Procedi.

                    </td>
                    <td>
                        <p><input title="Programado" type="checkbox" name="chkProgramacion_1" id="chkProgramacion_1" onClick="cargaraFiltro('chkProgramacion_1','Programacion','3')">Program.&nbsp;&nbsp;
                        <p><input title="Adicional" type="checkbox" name="chkProgramacion_2" id="chkProgramacion_2" onClick="cargaraFiltro('chkProgramacion_2','Adicionales','3')">Adicional&nbsp;&nbsp;
                    </td>
                </tr>
            </table>

        </div>
        <div id="contenedorEscala">
            <div id="ComboSelect" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Escala :  
                    <select id="comboEscala" style="font-size:14px;" onchange="MostrarDivDeBusqueda(this.options[this.selectedIndex].value);">
                        <option value="1">Diario</option>
                        <option value="2">Mensual</option>
                        <option value="3">Trimestral</option>
                        <option value="4">Semestral</option>
                        <option value="5">Anual</option>
                    </select>
            </div>
            <div id="Dia" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Desde :  
                    <input id="txtDia1" type="text" name="txtDia" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtDia1')" onkeypress="return validar(event,4)" maxlength="10" value="<?php echo date("d/m/Y"); ?>" onchange="ValidarFechasRangos('txtDia1','txtDia2',1)">
            </div>
            <div id="Dia2" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Hasta :  
                    <input id="txtDia2" type="text" name="txtDia2" size="9" onclick="calendarioHtmlxActoMedicoEstadistica('txtDia2')" onkeypress="return validar(event,4)" maxlength="10" value="<?php echo date("d/m/Y"); ?>" onchange="ValidarFechasRangos('txtDia2','txtDia1',2)">
            </div>
            <div id="Trimestral" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Inicio :  
                    <select id="trimestre1" style="font-size:14px;">
                        <option value="1">I Trimestre</option>
                        <option value="2">II Trimestre</option>
                        <option value="3">III Trimestre</option>
                        <option value="4">IV Trimestre</option>
                    </select>
            </div>
            <div id="YearTre" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYearTre1"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtYearTre1','txtYearTre2',1)">
            </div>
            <div id="Trimestral2" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Final :  
                    <select id="trimestre2" style="font-size:14px;">
                        <option value="1">I Trimestre</option>
                        <option value="2">II Trimestre</option>
                        <option value="3">III Trimestre</option>
                        <option value="4">IV Trimestre</option>
                    </select>
            </div>
            <div id="YearTre2" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYearTre2"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtYearTre2','txtYearTre1',2)">
            </div>
            <div id="Mes" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Inicio : 
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
            <div id="Year" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYear1"  maxlength="4" size="3" value="2013"  onchange="ValidarFechasRangos('txtYear1','txtYear2',1)">
            </div>
            <div id="Mes2" style="float:left;padding: 25px; width: 100px;">
                <p style="font-size:12px;">Final : 
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
            <div id="Year2" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYear2"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtYear2','txtYear1',2)">
            </div>
            <div id="Semestral" style="float:left;padding: 25px; width: 100px;">
                <p  style="font-size:12px;">Inicio:  
                    <select id="semestre1" style="font-size:14px;">
                        <option value="1">I Semestre</option>
                        <option value="2">II Semestre</option>
                    </select>
            </div>
            <div id="YearSe" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYearSe1"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtYearSe1','txtYearSe2',1)">
            </div>
            <div id="Semestral2" style="float:left;padding: 25px; width: 100px;">
                <p  style="font-size:12px;">Final :  
                    <select id="semestre2" style="font-size:14px;">
                        <option value="1">I Semestre</option>
                        <option value="2">II Semestre</option>
                    </select>
            </div>
            <div id="YearSe2" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Año : 
                    <input type="text" id="txtYearSe2"  maxlength="4" size="3" value="2013"  onchange="ValidarFechasRangos('txtYearSe2','txtYearSe1',2)">
            </div>
            <div id="Anual" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Inicio : 
                    <input type="text" id="txtAnual1"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtAnual1','txtAnual2',1)">
            </div>
            <div id="Anual2" style="float:left;padding: 25px; width: 50px;">
                <p style="font-size:12px;">Final: 
                    <input type="text" id="txtAnual2"  maxlength="4" size="3" value="2013" onchange="ValidarFechasRangos('txtAnual2','txtAnual1',2)">
            </div>
            <div style="float:left;width: 100px;">
                <br><br>
                <!--  <?php $toolbar = new ToollBar(); ?>
                <?php
                $toolbar->SetBoton("Buscar", "Ver Estadisticas", "btn", "onclick,onkeypress", "verGraficosEstadisticos()", "../../../../medifacil_front/imagen/icono/estadisticas.jpg", "", "", true);
                $toolbar->Mostrar();
                ?> -->
                <div class="btnReportes" onClick="verGraficosEstadisticos()">
                    Ver Estadisticas
                </div>

            </div>
        </div>



        <div id="filtros" style="">
            <fieldset id="con1" style="border:0px;background-color: white;">
                <legend>Estados:</legend>
                <div id="contenedorfiltros1" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset id="con2" style="border:0px;background-color: white;" >
                <legend>Tipo Atencion:</legend>
                <div id="contenedorfiltros2" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con3"style="border:0px;background-color: white;">
                <legend>Tipo Programacion:</legend>
                <div id="contenedorfiltros3" style="font-family:verdana;">
                </div>
            </fieldset>
            <fieldset id="con4" style="border:0px;background-color: white;">
                <legend>Medicos:</legend>
                <div id="contenedorfiltros4" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con5" style="border:0px;background-color: white;">
                <legend>Servicios:</legend>
                <div id="contenedorfiltros5" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con6" style="border:0px;background-color: white;">
                <legend>Ambientes Logicos:</legend>
                <div id="contenedorfiltros6" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con7" style="border:0px;background-color: white;">
                <legend>Afiliaciones:</legend>
                <div id="contenedorfiltros7" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con8" style="border:0px;background-color: white;">
                <legend>Sedes:</legend>
                <div id="contenedorfiltros8" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con9" style="border:0px;background-color: white;">
                <legend>Turnos:</legend>
                <div id="contenedorfiltros9" style="font-family: verdana;">
                </div>
            </fieldset>
            <fieldset  id="con11" style="border:0px;background-color: white;">
                <legend>Actividades:</legend>
                <div id="contenedorfiltros11" style="font-family: verdana;">
                </div>
            </fieldset>
            <br><br>
            <fieldset  id="con10" style="border:0px;background-color: white;">
                <legend>Tipo grafico:</legend>
                <div>
                    <div id="contenedorfiltros10" style="float:left;width:155px;height:100px;margin:20px;border:2px solid cadetblue;"></div>
                </div>
            </fieldset>
            <center>
                <div class="btnReportes" onClick="cambiarGrafico()">
                    <!-- <?php $toolbar1 = new ToollBar(); ?>
                    <?php
                    $toolbar1->SetBoton("Cambiar", "Cambiar Grafico", "btn", "onclick,onkeypress", "cambiarGrafico()", "../../../../medifacil_front/imagen/icono/Download.png", "", "", true);
                    $toolbar1->Mostrar();
                    ?> -->
                    Cambiar Grafico
                </div>
            </center>

            <br>
            <br>
            <div style="float:left;padding-left:10px;">
            </div>
            <fieldset  id="con10" style="border:0px;">
                <legend>Estadisticas Pasadas:</legend>
                <div id="HistorialGrafico" style="width:198px; height:500px;border:1px solid;font-size: 10px;"></div>
            </fieldset>
        </div>
        <div id="contenedorMedico">
            <table>
                <tr>
                    <td><p style="font-size: 10;">Codigo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><p style="font-size: 10;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI :</td>
                    <td><p style="font-size: 10;">Apellido Pat.:&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td><input onChange="cargarTablaPersonal()"  type="text" maxlength="7" id="CodPer" style="width: 60px;" value=""></td>
                    <td><input onChange="cargarTablaPersonal()" type="text" id="dni" style="width: 60px;"></td>
                    <td><input onChange="cargarTablaPersonal()" type="text" id="txtApellidoPat" style="width: 105px;"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><p style="font-size: 10;">Apellido Mat.:&nbsp;</td>
                    <td>  <p style="font-size: 10;">Nombres :&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td><input onChange="cargarTablaPersonal()" type="text" id="txtApellidoMat" style="width: 100px;"></td>
                    <td><input onChange="cargarTablaPersonal()" type="text" id="txtApellidoNom" style="width: 130px;"></td>
                </tr>
            </table>
            <center> 
            </center>
            <div style="float:left">
                <div id="tablaPersonal" style="margin-top: 5px;width:235px; height:115px;border:1px solid cadetblue;font-size: 10px;"></div>
            </div>
        </div>
        <div id="contenedorServicios">
            <table>
                <tr>
                    <td><p style="font-size: 10;">Servicio :&nbsp;&nbsp;</td>
                    <td><input type="text" id="txtServicio" onkeyup="filtrartablaservicios()"></td>
                </tr>
            </table>
            <div id="tablaServicios" style="width:220px; height:376px;border:1px solid cadetblue;">
            </div>
        </div>
        <div id="contenedorAFisicos">
        <!--    <table>
                <tr>
                    <td><p style="font-size: 14;">Ambiente :&nbsp;&nbsp;</td>
                    <td><input type="text" id="txtAmbiFisi" onkeyup="filtrartablaAmbiFi()"></td>
                </tr>
            </table>-->
            <div id="tablaAmbiFi" style="width:235px; height:99%;border:1px solid cadetblue;" >
            </div>
        </div>
        <div id="contenedorALogicos">
            <table>
                <tr>
                    <td><p style="font-size: 10;">Ambiente :&nbsp;&nbsp;</td>
                    <td><input type="text" id="txtAmbiLogi" onkeyup="filtrartablaAmbiLo()"></td>
                </tr>
            </table>
            <div id="tablaAmbiLo" style="width:235px; height:316px;border:1px solid cadetblue;">
            </div>
        </div>

        <div id="sedes">
          <!--  <center><table border="0" cellspacing="5">
                    <tr bgcolor="#66A738" style="color:#ffffff; font-family: verdana; font-size:10px;">
                        <td> <center>Sedes</center></td>
                    <td><center>&nbsp;&nbsp;&nbsp;&nbsp;Turnos&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
                    </tr>
                    <tr>
                        <td> -->
            <div id="tablaSedes" style="width:220px; height:100px; border:1px solid cadetblue">
            </div>
            <!--   </td>
               <td>
                   <p>&nbsp;&nbsp;<input type="checkbox" name="chkTurno_1" id="chkTurno_1" onClick="cargaraFiltro('chkTurno_1','Mañana','4')">&nbsp;&nbsp;Mañana
                   <p>&nbsp;&nbsp;<input type="checkbox" name="chkTurno_2" id="chkTurno_2" onClick="cargaraFiltro('chkTurno_2','Tarde','4')">&nbsp;&nbsp;Tarde
                   <p>&nbsp;&nbsp;<input type="checkbox" name="chkTurno_3" id="chkTurno_3" onClick="cargaraFiltro('chkTurno_3','Noche','4')">&nbsp;&nbsp;Noche

               </td>
           </tr>
       </table>
   </center>-->
        </div>
        <div id="contenedorMAmbientes">
        </div>
        <div id="contenedorActividad" style="width:220px; height:290px; border:1px solid cadetblue">
        </div>

        <div id="contenedormaestro">
           <!-- <p style="color:white;font-size:14px; font-family: tahoma;background-color:cadetblue;padding: 10px;text-align: center;border:1px solid #66A738;">
                Para la mejor visualizacion de los graficos se recomienda emplear rangos de 6 en 6. 
                <br> <b><i>Ejemplo: Diario: 01/01/2013 - 06/01/2013 , Mensual: Enero - Junio. </i></b> 
                <br> Podra seleccionar mas rangos si la cantidad de estados + atencion o Programacion es de 1 a 1.
                <br> <b><i>Ejemplo: Reservados , Consultas - Reservados , Programados - Atendido.</i></b>-->
            <input type="hidden" id="numeroGraficos" value=50 />
            <div id="divTodosGraficos" style="padding:10px; height:1460px;width: 646px; overflow-y: scroll;border:1px solid cadetblue ">
                <?php
                $x = 1;
                for ($x = 1; $x <= 50; $x++) {
                    echo "<table border='0' style='border:0px dotted #66A738;padding:5px;border-radius:15px;' cellspacing='0' id='" . contenedorgraficotabla . $x . "' >
                <tr><td style='font-size:24;font-family:verdana;color:cadetblue;'><b><center>Gráfico Estadístico Nº " . ((50 - $x) + 1) . "</center></b></td></tr>
                        <tr height='25'>
                <td>
                    <input type='text' id='TituloGrafico.$x' style='width:400;font-size: 16px;height:25px;'>
                    <a id='btnGuardar$x' href='javascript:guargarContenedorGrafico($x);'><img style='border:0px solid cadetblue ' width='25' title='Guardar'  src='../../../../medifacil_front/imagen/icono/guardarAngel.png' id=guargar></a> 
                    <a href='javascript:eliminarContenedorGrafico($x);'><img  title='Borrar' style='border:0px solid cadetblue ' width='25' src='../../../../medifacil_front/imagen/icono/cancelarAngel.png'  ></a>
                    <input type='button' class='btnReportesExportar' value='Exportar Reporte aExcel' onclick='aLeyenda$x.toExcel(\"../../../grid-excel-php/generate.php\");'>    
                </td>
                <td>
                </td>
                    </tr>
                    <tr>
                    <td>
                    <div id='" . contenedorGraficos . $x . "' style='float:left;width:580px;height:350px;margin:20px;border:1px solid #A4BED4;'></div>
                    </td>
                    <td>
                    <input type='hidden' id='Estados.$x'>
                    <input type='hidden' id='Atencion.$x'>
                    <input type='hidden' id='Programacion.$x'>
                    <input type='hidden' id='Medicos.$x'>
                    <input type='hidden' id='Servicios.$x'>
                    <input type='hidden' id='AmbiFi.$x'>
                    <input type='hidden' id='AmbiLo.$x'>
                    <input type='hidden' id='Sedes.$x'>
                    <input type='hidden' id='Turnos.$x'>
                    <input type='hidden' id='grafico.$x'>
                    
                     <input type='hidden' id='ComboEscala$x'>
                    <input type='hidden' id='DiaInicio$x'>
                    <input type='hidden' id='DiaFin$x'>
                    <input type='hidden' id='MesInicio$x'>
                    <input type='hidden' id='MesFin$x'>
                    <input type='hidden' id='TrimestreInicio$x'>
                    <input type='hidden' id='TrimestreFin$x'>
                    <input type='hidden' id='SemestreInicio$x'>
                    <input type='hidden' id='SemestreFin$x'>
                    <input type='hidden' id='AnioInicio$x'>
                    <input type='hidden' id='AnioFin$x'>
                        <input type='hidden' id='Actividad$x'>
                    </td>
                    </tr>
                    
                    <tr><td>
                    <div id=" . contenedorTablaLeyenda . $x . " width='620'height='100' style='border:1px solid #66A738;'></div>
                    <br>
                    </td>
                    </tr>
                    </table>";
                }
                ?>
            </div>
        </div>

        <div><input type="hidden" id="validacionFechas" value=0></div>
        <div><input type="hidden" id="grafico"></div>


        <div><input type="hidden" id="Estados"></div>
        <div><input type="hidden" id="Atencion"></div>
        <div><input type="hidden" id="Programacion"></div>
        <div><input type="hidden" id="Medicos"></div>
        <div><input type="hidden" id="Servicios"></div>
        <div><input type="hidden" id="AmbiFi"></div>
        <div><input type="hidden" id="AmbiLo"></div>
        <div><input type="hidden" id="Sedes"></div>
        <div><input type="hidden" id="Turnos"></div>
        <div><input type="hidden" id="Afiliaciones"></div>
        <div><input type="hidden" id="Actividades"></div>


        <div><input type="hidden" id="ContadorMedicos" value=0></div>
        <div><input type="hidden" id="ContadorServicios" value=0></div>
        <div><input type="hidden" id="ContadorAmbientesLo" value=0></div>
        <div><input type="hidden" id="ContadorAfiliaciones" value=0></div>
        <div><input type="hidden" id="IdEstadisticaHistoria" value=""></div>


    </center>
</div>

