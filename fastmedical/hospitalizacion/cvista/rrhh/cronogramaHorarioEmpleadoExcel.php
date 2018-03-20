<?php
$filename="horarios";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");
$cboMeses = Array ('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
?>

<table border="1" bgcolor="#95BB9E" >
    <tr>
        <td>Sucursal : </td>
        <td colspan="2"><?php echo $descSucursal;?></td>
        <td>&Aacute;rea : </td>
        <td colspan="3"><?php echo $descArea;?></td>
    </tr>
    <tr>
        <td>Empleado : </td>
        <td colspan="6"><?php echo $nomEmpleado;?></td>
    </tr>
    <tr>
        <td colspan="7" align="center">
            Mes : <?php echo $cboMeses[$mesx];?>
        </td>
    </tr>
</table>

<table  border="1">
    <?php echo $tablaHorarioEmpleado;?>
</table>


