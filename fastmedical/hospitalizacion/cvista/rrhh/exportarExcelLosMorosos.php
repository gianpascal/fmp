<?php
$filename = str_replace(" ", "-", "Reporte Morosos");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<br>
<table border="1">
    <thead>

        <tr>
            <th></th>
            <th colspan="4">REPORTE DE ENCARGADOS QUE HAN CUMPLIDO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td bgcolor="#91E391">APELLIDO PATERNO</td>
            <td bgcolor="#91E391">APELLIDO MATERNO</td>
            <td bgcolor="#91E391">NOMBRE COMPLETO</td>
            <td bgcolor="#91E391">AREA</td>

        </tr>
        <?php foreach ($reportesEncargados as $i => $val) { ?>
        <tr>
            <td> </td>
            <td><?php echo $val[0] ?></td>
            <td><?php echo $val[1] ?></td>
            <td><?php echo $val[2] ?></td>
            <td><?php echo $val[3] ?></td>
        </tr>
            <?php }
        ?>
    </tbody>

</table>
<br>
<table border="1">
    <thead>
        <tr>
            <th></th>
            <th colspan="4">REPORTE DE MOROSOS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td bgcolor="#91E391">APELLIDO PATERNO</td>
            <td bgcolor="#91E391">APELLIDO MATERNO</td>
            <td bgcolor="#91E391">NOMBRE COMPLETO</td>
            <td bgcolor="#91E391">AREA</td>

        </tr>
        <?php foreach ($reportes as $i => $val) { ?>
        <tr>
            <td></td>
            <td><?php echo $val[0] ?></td>
            <td><?php echo $val[1] ?></td>
            <td><?php echo $val[2] ?></td>
            <td><?php echo $val[3] ?></td>
        </tr>
            <?php }
        ?>
    </tbody>
</table>

