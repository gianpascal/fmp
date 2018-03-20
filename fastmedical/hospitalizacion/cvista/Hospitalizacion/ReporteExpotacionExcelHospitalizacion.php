<?php
$filename = str_replace(" ", "-", "ReportePacienteHospitalizacion");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <tr>
        <td align="center" colspan="10" bgcolor="#30C031">
            REPORTE HOSPITALIZACION 
        </td>
    </tr>
<!--    <tr>
        <td align="center" colspan="7" bgcolor="#33CA33">
            Modalidad Contrato : < ?php echo $descriContrato;?>
        </td>
    </tr>-->
<!--    <tr>
        <td colspan="3" bgcolor="#46D046">Corte Inicial : < ?php echo $txtFechaIni;?></td>
        <td colspan="4" bgcolor="#46D046">Corte Final : < ?php echo $txtFechaFin;?></td>
    </tr>-->
    <tr>
        <td bgcolor="#91E391">Fecha Ingreso</td>
        <td bgcolor="#91E391">Fecha Salida</td>
        <td bgcolor="#91E391">Hora Ingreso</td>
        <td bgcolor="#91E391">Nombre Paciente</td>
        <td bgcolor="#91E391">Edad Paciente</td>
        <td bgcolor="#91E391">Medico Tratante</td>
        <td bgcolor="#91E391">Medico de Alta</td>
        <td bgcolor="#91E391">Ambiente Fisico</td>
        <td bgcolor="#91E391">Cama </td>
        <td bgcolor="#91E391">Destino </td>
    </tr>
    <?php foreach ($resultadosExpotarExcel as $i => $val) { ?>
        <tr>

            <td><?php echo $val[2] ?></td>
            <td><?php echo $val[3] ?></td>
            <td><?php echo $val[1] ?></td>
            <td><?php echo $val[4] ?></td>
            <td><?php echo $val[5] ?></td>
            <td><?php echo $val[6] ?></td>
            <td><?php echo $val[7] ?></td>
            <td><?php echo $val[8] ?></td>
            <td><?php echo $val[9] ?></td>
            <td><?php echo $val[10] ?></td>

        </tr>
    <?php } ?>
</table>