<?php
$filename = str_replace(" ", "-", "Reporte Area");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
    <tr>
        <td bgcolor="#91E391">Codigo Encargado</td>
        <td bgcolor="#91E391">Nombre Encargado</td>
        <td bgcolor="#91E391">Nombre Del Area</td>
        
    </tr>
    
        <?php foreach ($area as $i => $val) { ?>
    <tr>
            <td><?php echo $val[0] ?></td>
            <td><?php echo $val[1] ?></td>
            <td><?php echo $val[2] ?></td>
    </tr>
        <?php } ?>
   
</table>