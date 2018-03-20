<?php
$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$fecha = getdate(time());
$mes = $fecha['mon'];
$anio = $fecha['year'];
$anioInicial = $anio - 2;
$anioFinal = $anio + 3;

$mes = date("m");
$anio = date("Y");
$toolbar1 = new ToollBar("center");
//__construct($palign="left",$style="btns",$form="",$param =false)
$toolbar2 = new ToollBar("center");
?>
<input id="hPosicion" type="hidden" value="" />
<input id="hEstado" type="hidden" value="" />
<input id="hICodEmpCoordinador" type="hidden" value="<?php echo $iCodEmpCoordinador ?>" />
<input id="hAnnoActual" type="hidden" value="<?php echo $arrayFechaSistemaActual[0][0] ?>" />
<input id="hMesActual" type="hidden" value="<?php echo $arrayFechaSistemaActual[0][1] ?>" />
<input id="hHoraActual" type="hidden" value="<?php echo $arrayFechaSistemaActual[0][2] ?>" />
<input id="hMinutosActual" type="hidden" value="<?php echo $arrayFechaSistemaActual[0][3] ?>" />
<input id="hSegundosActual" type="hidden" value="<?php echo $arrayFechaSistemaActual[0][4] ?>" />
<input id="hNombreCoordinador" type="hidden" value="<?php echo $arrayNombreCoordinador[0][0] ?>" />
<!--<div style="width:1000px; margin:1px auto; border: #006600 solid" id="">-->
<div align="center" >
    <div style="width:100%;height:5%;background: white">
        <table>
            <tr>
                <td>
                    <div class="titleform">
                        <h1>PROGRAMACI&Oacute;N &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;PERSONAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASISTENCIAL</h1>
                    </div>  
                </td>
                <td>
                    <a href="javascript:MostrarDatosCoordinador();"> <img border="0" title="Mostrar" alt="" src="../../../../medifacil_front/imagen/icono/Download.png"/></a>
                </td>
            </tr>
        </table>

    </div>
    <div id="divOcultar">
        <table border="0" cellpadding="0" cellspacing="8" bordercolor="#000000" style="border-collapse:collapse;" >
            <tr>
                <td hidden="">
                    <div id="toolbar" style="height:auto;" >
                        <table border="0"  >
                            <?php
                            foreach ($resultadoTurnos as $k => $value) {
                                if ($k < count($resultadoTurnos) / 2) {
                                    ?>
                                    <tr  style="border-color:#666666; border-top-style: solid; border-width:2px;">
                                        <td><font size="4"><b><?php echo $resultadoTurnos[$k][0] ?></b></font></td>
                                        <td><font size="4"><b><?php echo $resultadoTurnos[$k][1] ?></b></font></td>
                                        <td hidden=""><?php echo $resultadoTurnos[$k][2] ?></td>
                                        <td hidden=""><?php echo $k ?></td>
                                        <td hidden=""><?php echo count($resultadoTurnos); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </td>
                <td>
                    <fieldset style="width: 120%">
                        <div style="width:550px;height: auto;">

                            <table cellspacing="8">
                                <tr>
                                    <td>

                                        <table width="100%" cellspacing="8" border="1"><!--  -->
                                            <tr>
                                                <td><font color="blue"><b>COORDINADOR <?php echo $iCodEmpCoordinador ?>: </b></font></td>
                                                <td colspan="5">
                                                    <b> <font style="font-size: 15px ">  <?php echo $arrayNombreCoordinador[0][0]; ?> </font></b>

                                            </tr>
                                            <tr>
                                                <td class="Estilo11"  width="20%" align="center"> <b>MES:</b></td>
                                                <td class="Estilo6" width="30%">
                                                    <select name="cboMes" id="cboMes" style="width: 100px;" onchange="reporteEmpleado();" >
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach ($cboMeses as $i => $value) { ?>
                                                            <option value="<?php echo $i + 1; ?>" <?php if ($mes == $i + 1) echo "selected"; ?>><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td class="Estilo6" width="20%" align="center"><b>A&Ntilde;O:</b></td>
                                                <td class="Estilo6" width="30%">
                                                    <select name="cboAnio" id="cboAnio" style="width: 100px;" >
                                                        <option value="">Seleccionar</option>
                                                        <?php for ($i = $anioInicial; $i < $anioFinal; $i++) { ?>
                                                            <option value="<?php echo $i; ?>" <?php if ($anio == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (isset($_SESSION["permiso_formulario_servicio"][220]["REPORTE_EMPLEADOS"]) && ($_SESSION["permiso_formulario_servicio"][220]["REPORTE_EMPLEADOS"] == 1)) {
                                                        $verBotonReporteCoordinadores = 1;
                                                    } else {
                                                        $verBotonReporteCoordinadores = 0;
                                                    }
                                                    $toolbar1->SetBoton("Refrescar", "Refrescar", "btn", "onclick,onkeypress", "reporteEmpleado()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/reload3.png", "", "", $verBotonReporteCoordinadores);
                                                    $toolbar1->Mostrar();
                                                    ?>
                                                </td>

                                                <td>
                                                    <div id="divOcultarBotonSubir" >
                                                        <a href="javascript:Ocultar();"> <img border="0" title="Ocultar" alt="" src="../../../../medifacil_front/imagen/icono/Upload.png"/></a>
            <!--                                         <a href="javascript:HorariosTurnosAreaCoordinador();"> <img border="0" title="Turno" alt="" width="22" height="22" src="../../../../medifacil_front/imagen/icono/iconoExcel1.PNG"/></a>-->
                                                    </div>
                                                </td>

                                            </tr>

                                        </table>
                                    </td>
                                    <td>
                                        <div id="divExportarExcelHorarioEmpleados">
                                            <?php
                                            if (isset($_SESSION["permiso_formulario_servicio"][220]["EXPORTAR_EXCEL_EMPLEADOS"]) && ($_SESSION["permiso_formulario_servicio"][220]["EXPORTAR_EXCEL_EMPLEADOS"] == 1)) {
                                                $verBotonReporteExportarExcelEmpleados = 1;
                                            } else {
                                                $verBotonReporteExportarExcelEmpleados = 0;
                                            }
//                                            
                                            ?>
                                            <?php if ($verBotonReporteExportarExcelEmpleados == 1) { ?>   
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:HorariosTurnosAreaCoordinador('.xls');">
                                                                <img  style="height: 30px;width: 35px" border="0" src="../../../../medifacil_front/imagen/icono/2003.jpg" alt="" title="excel2003">
                                                            </a> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:HorariosTurnosAreaCoordinador('.xlsx');">
                                                                <img style="height: 30px;width: 35px"  border="0" src="../../../../medifacil_front/imagen/icono/Excel2007.jpg" alt="" title="excel2007">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:HorariosTurnosAreaCoordinador('.ods');">
                                                                <img style="height: 30px;width: 35px" border="0" src="../../../../medifacil_front/imagen/icono/libreofficecal3.jpg" alt="" title="libreofficecal">
                                                            </a>
                                                        </td>
                                                    </tr>                                                
                                                </table>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>

                                        <select name="cboModalidadContrato" id="cboModalidadContrato"> 
                                            <option value="0">Todo</option>
                                            <?php foreach ($resulModalidadContrato as $y => $valuey) { ?>
                                                <option value="<?php echo $valuey[0] ?>"><?php echo $valuey[1] ?></option>   
                                            <?php } ?>
                                        </select> 
                                    </td>
                                </tr>
                            </table>

                        </div>

                    </fieldset>
                </td>
                <td hidden="">
                    <div id="toolbar" style="height:auto;  ">
                        <table >
                            <?php
                            foreach ($resultadoTurnos as $k => $value) {
                                if ($k >= count($resultadoTurnos) / 2) {
                                    ?>
                                    <tr>
                                        <td><font size="4"><b><?php echo $resultadoTurnos[$k][0] ?></b></font></td>
                                        <td><font size="4"><b><?php echo $resultadoTurnos[$k][1] ?></b></font></td>
                                        <td hidden=""><?php echo $resultadoTurnos[$k][2] ?></td>
                                        <td hidden=""><?php echo $k ?></td>
                                        <td hidden=""><?php echo count($resultadoTurnos); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr align="center">
                <td colspan="3" align="center">
                    <a href="javascript:agregarPersonaProgramacion();"> <img border="0" title="Ocultar" alt="" src="../../../../medifacil_front/imagen/btn/b_agregar_off.gif"/></a>
                </td>
            </tr>   
        </table>
    </div>
    <!-- <fieldset style="margin:5px;padding:5px;"> -->
    <div align="left" id="divscroll" >
        <div id="divAreaEmpleado">

        </div>

    </div>
</div>
<!-- </div> -->
