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
<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform" id="divTitulo" >
    </div>
</div>
<div align="center">
    <table>
        <tr>
            <td>
                <table align="center" border="1">
                    <tr>
                        <td class="Estilo6" width="30%">
                            <select name="cboAnio" id="cboAnio" style="width: 100px;" >
                                <option value="">Seleccionar</option>
                                <?php for ($i = $anioInicial; $i < $anioFinal; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if ($anio == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="Estilo6" width="30%">
                            <select name="cboMesRRHH" id="cboMesRRHH" style="width: 100px;" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cboMeses as $i => $value) { ?>
                                    <option value="<?php echo $i + 1; ?>" <?php if ($mes == $i + 1) echo "selected"; ?>><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <?php
                            $toolbar1->SetBoton("Reporte Empleado", "Reporte Empleado", "btn", "onclick,onkeypress", "reporteEmpleadoRRHH()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                            $toolbar1->Mostrar();
                            ?>
                        </td>

                    </tr>
                </table> 
            </td>
        </tr>
        <tr>
            <td>
                <div  id="div_DesrrolloRRHH" style="overflow:scroll;width:600px;height:400px;" >
                    <table border="1"  style="width: 600px ; height: 10px ; font-family:  Arial; font-size: 12px;font-weight: bold " cellspacing="1">
                        <thead>
                            <tr>
                                <th bgcolor="#D4E7FF">iCodigo Empleado</th>
                                <th bgcolor="#D4E7FF" hidden=""> Codigo Programacion</th>
                                <th bgcolor="#D4E7FF">Fecha</th>
                                <th bgcolor="#D4E7FF"> Nomenclatura</th>
                                <th bgcolor="#D4E7FF"> Ingreso </th>
                                <th bgcolor="#D4E7FF">Salida</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 0; $i < count($arrayHorarios); $i++) {
                                $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                                ?>
                                <tr align="center" class="<?php echo $class; ?>">
                                    <?php
                                    for ($j = 0; $j < 6; $j++) {
                                        if ($j == 1) {
                                            ?>
                                            <td align="center"  hidden="">
                                                <?php echo $arrayHorarios[$i][$j] ?>
                                            </td>
                                        <?php } else { ?>
                                            <td align="center">
                                                <?php echo $arrayHorarios[$i][$j] ?>
                                            </td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>

</div>




