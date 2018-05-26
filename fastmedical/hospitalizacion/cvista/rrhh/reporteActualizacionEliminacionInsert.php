<?php
$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$fecha = getdate(time());
$mes = $fecha['mon'];
$anio = $fecha['year'];
$anioInicial = $anio - 9;
$anioFinal = $anio + 2;
$toolbar1 = new ToollBar("left");
$toolbar2 = new ToollBar("left");
$toolbar3 = new ToollBar("left");
$toolbar4 = new ToollBar("left");
$mes = date("m");
$anio = date("Y");
?>
<div style="width: 100%;border:3px;border-color: #000000;margin-top:0px;margin-bottom:0px;margin-left: 0px;margin-right: 0px;min-height:680px;padding:0px;">
    <div class="titleform" style="width:100%;">
        <h1>REPORTE DE ACTUALIZACIONES, MODIFICACIONES E INSERCIONES</h1>
    </div>
    <div id="contenido_main" style="width:98%;height:700px;margin:0px; padding:2px; overflow: hidden; z-index:1; position:absolute;">
        <table border="1" style="width:97%;margin: 0px;padding: 0px">
            <tr>
                <td width="40%" align="center">
                    <fieldset style="margin-left:50px;height:auto;padding:5px;width: 450px; border-color: #006600; " >
                        <table width="100%">
                            <tr>
                                <td>Mes :</td>
                                <td>
                                    <select class="Estilo10" name="cboMes" id="cboMes" onchange="reportePerActElimInsert()">
                                        <option value="01" <?php if ($mes == '01') echo "selected" ?>>Enero&nbsp;&nbsp;</option>
                                        <option value="02" <?php if ($mes == '02') echo "selected" ?>>Febrero&nbsp;&nbsp;</option>
                                        <option value="03" <?php if ($mes == '03') echo "selected" ?>>Marzo&nbsp;&nbsp;</option>
                                        <option value="04" <?php if ($mes == '04') echo "selected" ?>>Abril&nbsp;&nbsp;</option>
                                        <option value="05" <?php if ($mes == '05') echo "selected" ?>>Mayo&nbsp;&nbsp;</option>
                                        <option value="06" <?php if ($mes == '06') echo "selected" ?>>Junio&nbsp;&nbsp;</option>
                                        <option value="07" <?php if ($mes == '07') echo "selected" ?>>Julio&nbsp;&nbsp;</option>
                                        <option value="08" <?php if ($mes == '08') echo "selected" ?>>Agosto&nbsp;&nbsp;</option>
                                        <option value="09" <?php if ($mes == '09') echo "selected" ?>>Septiembre&nbsp;&nbsp;</option>
                                        <option value="10" <?php if ($mes == '10') echo "selected" ?>>Octubre&nbsp;&nbsp;</option>
                                        <option value="11" <?php if ($mes == '11') echo "selected" ?>>Noviembre&nbsp;&nbsp;</option>
                                        <option value="12" <?php if ($mes == '12') echo "selected" ?>>Diciembre&nbsp;&nbsp;</option>
                                    </select>
                                </td>
                                <td>Año :</td>
                                <td>
                                    <select name="cboAnio" id="cboAnio" style="width: 100px;" onchange="reportePerActElimInsert()">
                                        <option value="">Seleccionar</option>
                                        <?php for ($i = $anioInicial; $i < $anioFinal; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if ($anio == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                        </table></fieldset>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3"><br><div style="width: 100px;" align="center">
                        <?php
                        if (isset($_SESSION["permiso_formulario_servicio"][232]["REFRESCAR_HORARIO_EMP"]) && ($_SESSION["permiso_formulario_servicio"][232]["REFRESCAR_HORARIO_EMP"] == 1)) {
                            $toolbarx = new ToollBar("right");
                            $toolbarx->SetBoton("Reporte", "Reporte", "btn", "onclick,onkeypress", "reportePerActElimInsert()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/reload3.png", "", "", 1);
                            $toolbarx->Mostrar();
                        }
                        ?></div>
                </td>
            </tr>
            <tr align="center">
                <td align="center">
                    <div id="div_reporteActElimInsert" style="width:800px;height: 400px;" align="center" ></div>
                </td>
            </tr>

        </table>
    </div>
</div>
