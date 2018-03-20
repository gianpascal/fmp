<div id="parentId1_laboratorioclinico" style="position: relative; top: 5px; left: 5px; width: 1215px; height:185%;">
</div>
<!--175-->
<div id="parentId2_laboratorioclinico"  style="position: relative; top: 5px; left: 5px; width:915px; height:120%;display:none;">
</div>

<!--99-->
<div id="contenedorEscalaLaboratorioClinico">
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
    <div style="float:left;width: 100px;">
        <br><br>
        <?php $toolbar = new ToollBar(); ?>
        <?php
        $toolbar->SetBoton("Buscar", "Ver Estadisticas", "btn", "onclick,onkeypress", "verGraficosEstadisticosLaboratorioClinico()", "../../../../medifacil_front/imagen/icono/estadisticas.jpg", "", "", true);
        $toolbar->Mostrar();
        ?> 
    </div>
</div>

<div id="contenedorExamenes_LaboratorioClinico">
    <div style="float:left">
        <div id="div_tablaExamenesIndicadores_LaboratorioClinico" style="width:260px; height:250px;border:1px solid;font-size: 10px;"></div>
    </div>
</div>

<div id="contenedorPuntoControlExamenes_LaboratorioClinico">

    <div style="float:left">
        <div id="div_tablaPuntoControlExamenesIndicadores_LaboratorioClinico" style="width:260px; height:250px;border:1px solid;font-size: 10px;"></div>
    </div>
</div>


<div id="div_SedesEmpresas">

    <div id="div_ListadoSedesEmpresas" style="width:250px; height:150px;border:1px solid;">
    </div>
</div>
<div id="div_Procedencia">

    <div id="div_ListadoProcedencia" style="width:250px; height:175px;border:1px solid;">
    </div>
</div>

<div id="div_Afiliaciones">

    <div id="div_ListadoAfiliaciones" style="width:250px; height:300px;border:1px solid;">
    </div>
</div>
<div id="div_MaterialesLaboratorio">

    <div id="div_ListadoMaterialesLaboratorio" style="width:250px; height:200px;border:1px solid;">
    </div>
</div>

<div id="div_UnidadesUtilizadasMaterialesLaboratorio">
    <div id="div_UnidadesUtilizadasMaterialesLaboratorio_tabla" style="width:250px; height:250px;border:1px solid;">
    </div>
</div>


<div id="filtros_laboratorioClinico" style=" overflow:auto ;position: relative;padding-left: 8px; top: 5px; left: 5px; width:99%; height:99%;">
    <fieldset id="con1lc" style="border:0px;">
        <legend>Examen:</legend>
        <div id="contenedorfiltros1lb" style="font-family: verdana;">
        </div>
    </fieldset>
    <!--    agregado-->
    <fieldset id="con1lc_jc" style="border:0px;">
        <legend>Punto de Control:</legend>
        <div id="contenedorfiltros1lb_jc" style="font-family: verdana;">
        </div>
    </fieldset>


    <fieldset id="con2lc" style="border:0px;" >
        <legend>Sede:</legend>
        <div id="contenedorfiltros2lb" style="font-family: verdana;">
        </div>
    </fieldset>
    <fieldset  id="con3lc"style="border:0px;">
        <legend>Procedencia:</legend>
        <div id="contenedorfiltros3lb" style="font-family:verdana;">
        </div>
    </fieldset>
    <fieldset id="con4lc" style="border:0px;">
        <legend>Afiliaciones:</legend>
        <div id="contenedorfiltros4lb" style="font-family: verdana;">
        </div>
    </fieldset>
    <fieldset id="con5lc" style="border:0px;">
        <legend>Materiales:</legend>
        <div id="contenedorfiltros5lb" style="font-family: verdana;">
        </div>
    </fieldset>

    <fieldset id="con5lc_UM" style="border:0px;">
        <legend>Unidad Medida:</legend>
        <div id="contenedorfiltros5lb_UM" style="font-family: verdana;">
        </div>
    </fieldset>

    <fieldset  id="con10lc" style="border:0px;">
        <legend>Tipo grafico:</legend>
        <div>
            <div id="contenedorfiltros10lb" style="float:left;width:150;height:100;margin:20px;border:1px solid #A4BED4;"></div>
        </div>
        <div style="padding-left:15%;">
            <?php $toolbar1 = new ToollBar(); ?>
            <?php
            $toolbar1->SetBoton("Cambiar", "Cambiar Grafico", "btn", "onclick,onkeypress", "cambiarGraficoLaboratorioClinico()", "../../../../medifacil_front/imagen/icono/Download.png", "", "", true);
            $toolbar1->Mostrar();
            ?> 
        </div>
    </fieldset>
    <br><br>
    <div style="float:left;padding-left:10px;">
        <table border="0" cellspaing="0">
            <tr>
                <td style="background-color:#66A738;widht:100px;"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Activos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
            <td style="background-color:#C8E38B"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inactivos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
            </tr>
        </table>
    </div>
    <fieldset  id="con10lc" style="border:0px;">
        <legend>Estadisticas Pasadas Labo:</legend>
        <div id="HistorialGrafico" style="width:188px; height:500px;border:1px solid;font-size: 10px;"></div>
    </fieldset>

</div>






<div id="contenedormaestro_laboratorioClinico">
    <input type="hidden" id="numeroGraficos" value="50" />
    <div id="divTodosGraficos" style="padding:15px; height:1160px;width: 640px; overflow:auto">
        <?php
        $x = 1;
        for ($x = 1; $x <= 50; $x++) {
            echo "<table border='0' cellspacing='0' id='" . contenedorgraficotabla . $x . "' >
                <tr>
                <td>
                    <a href='javascript:eliminarContenedorGrafico($x);'><img src='../../../../medifacil_front/imagen/icono/btn_cerrar_layer.png'></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='javascript:guargarContenedorGrafico($x);'><img src='../../../../medifacil_front/imagen/icono/filesave-48.png' id=guargar></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' id='TituloGrafico.$x' style='width:400;font-size: 16px;'>
                    </td>
                <td>
                </td>
                    </tr>
                    <tr>
                    <td>
                    <div id='" . contenedorGraficos . $x . "' style='float:left;width:600px;height:300px;margin:20px;border:1px solid #A4BED4;'></div>
                    </td>
                    <td>
                    <input type='hidden' id='Examenes.$x'>
                    <input type='hidden' id='Sede.$x'>
                    <input type='hidden' id='Procedencia.$x'>
                    <input type='hidden' id='Afiliaciones.$x'>
                    <input type='hidden' id='Materiales.$x'>
                    <input type='hidden' id='PuntoControl.$x'>
                    <input type='hidden' id='UnidadMedida.$x'>
                    
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
                    </td>
                    </tr>
                      <tr><td>
                    <div id=" . contenedorTablaLeyenda . $x . " width='650'></div>
                    </td>
                    </tr>
                    </table>";
        }
        ?>


    </div>
</div>


<div><input type="hidden" id="validacionFechas" value=0></div>
<div><input type="text" id="grafico"></div>
<div><input type="hidden" id="Examenes"></div>
<div><input type="hidden" id="Sede"></div>
<div><input type="hidden" id="Procedencia"></div>
<div><input type="hidden" id="Afiliaciones"></div>
<div><input type="hidden" id="Materiales"></div>
<div><input type="hidden" id="PuntoControl"></div>
<div><input type="hidden" id="UnidadMedida"></div>

<div><input type="hidden" id="ContadorPuntoControl" value=0></div>
<div><input type="hidden" id="ContadorExamen" value=0></div>
<div><input type="hidden" id="ContadorSede" value=0></div>
<div><input type="hidden" id="ContadorProcedencia" value=0></div>
<div><input type="hidden" id="ContadorAfiliacion" value=0></div>
<div><input type="hidden" id="ContadorMateriales" value=0></div>
<div><input type="hidden" id="ContadorUnidadMedida" value=0></div>

<div><input type="hidden" id="IdEstadisticaHistoriaLaboClinico" value=""></div>

<!--

<div style="float:left;width: 100px;">
    <br><br>
<?php // $toolbar = new ToollBar(); ?>
<?php
// $toolbar->SetBoton("Buscarrr", "Ver Estadisticas", "btn", "onclick,onkeypress", "cargarArbolodontologia()", "../../../../medifacil_front/imagen/icono/estadisticas.jpg", "", "", true);
// $toolbar->Mostrar();
?> 
</div>

<div>
    <div id="arbolOdontologia" style="float:left;width:900;height:1000;margin:20px;border:1px solid #A4BED4;"></div>
</div>-->