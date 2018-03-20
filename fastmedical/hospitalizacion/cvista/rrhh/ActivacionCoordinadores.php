<?php
$toolbar1 = new ToollBar("right");
$toolbar2 = new ToollBar("right");
$toolbar3 = new ToollBar("center");
$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$fecha = getdate(time());
$mes = $fecha['mon'];
//$mes=1;
$anio = $fecha['year'];
$anioInicial = $anio - 1;
$anioFinal = $anio + 2;
?>
<div align="center">
    <table >
        <tr>
            <td>
                <font size="4" style="border-color: blue; font-weight:bold">A&Ntilde;O</font>
            </td>
            <td>
                <select name="cboAnio" id="cboAnio" style="width: 100px;" >
                    <option value="">Seleccionar</option>
                    <?php for ($i = $anioInicial; $i < $anioFinal; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php
                    if ($anio == $i)
                        echo "selected";
                        ?>><?php echo $i; ?></option>
                        <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <font size="4" style="border-color: blue; font-weight:bold">Mes</font>
            </td>
            <td>
                <select name="cboMesCoordinador" id="cboMesCoordinador" style="width: 100px;" >
                    <option value="">Seleccionar</option>
                    <?php foreach ($cboMeses as $i => $value) { ?>
                        <option value="<?php echo $i + 1; ?>" <?php if ($mes + 1 == $i + 1) echo "selected"; ?>><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <font size="4" style="border-color: blue; font-weight:bold">Descripcion</font>
            </td>
            <td>
                <textarea name="txtDecripcion" rows="4" cols="20"  id="txtDecripcion" >
                </textarea>
            </td>
        </tr>
        <tr align="center">
            <td align="center" colspan="2">
                <table>
                    <tr>
                        <td>
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][238]["DESACTIVAR_TOTAL"]) && ($_SESSION["permiso_formulario_servicio"][238]["DESACTIVAR_TOTAL"] == 1)) {
                                $verBotonDesactivarTotal = 1;
                            } else {
                                $verBotonDesactivarTotal = 0;
                            }
                            $toolbar1->SetBoton("Desactivacion Total", "Desactivar Total", "btn", "onclick,onkeypress", "DesactivarCoordinador()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filenew.png", "", "", $verBotonDesactivarTotal);
                            $toolbar1->Mostrar();
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][238]["ACTIVAR_TOTAL"]) && ($_SESSION["permiso_formulario_servicio"][238]["ACTIVAR_TOTAL"] == 1)) {
                                $verBotonActivarTotal = 1;
                            } else {
                                $verBotonActivarTotal = 0;
                            }
                            $toolbar2->SetBoton("Activar Total", "Activar Total", "btn", "onclick,onkeypress", "ActivarCoordinador()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/filenew.png", "", "", $verBotonActivarTotal);
                            $toolbar2->Mostrar();
                            ?>
                        </td>
                        <td colspan="2" align="center">
                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][238]["REPORTE_COORDINADORES"]) && ($_SESSION["permiso_formulario_servicio"][238]["REPORTE_COORDINADORES"] == 1)) {
                                $verBotonReporte = 1;
                            } else {
                                $verBotonReporte = 0;
                            }
                            $toolbar3->SetBoton("Reporte Coordinadores", "Reporte Coordinadores", "btn", "onclick,onkeypress", "ActivarCordinadorXarea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", $verBotonReporte);
                            $toolbar3->Mostrar();
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <div style="width: 650px; height: 300px;" align="center">
                    <div id="DivReporteCoordinadoresXarea" style="width: 650px; height: 300px;" >

                    </div>
                </div>
                </div>

