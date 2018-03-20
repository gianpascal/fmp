<?php
//$filename=str_replace(" ","-",$descriSucursal)."_".$descriContrato;
$filename="horarios";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");
//******************************************************************************
$codAnterior="";
$indice=array_keys($arrayCabecera);
$color=array(0=>"#D8EBDD",1=>"#FFFFFF");
$colorx="";
$k=1;
//******************************************************************************
?>
<table border="1">
    <tr>
        <td align="center" bgcolor="#95BB9E"  height="30" colspan="<?php echo count($arrayCabecera);?>">
            Sucursal : <?php echo $descSucursal?> &nbsp;-&nbsp; Area : <?php echo $descArea;?>
        </td>
    </tr>

    <tr>
        <?php foreach ($arrayCabecera as $i => $value) {
            if($i  <2) {?>
                   <td bgcolor="#A0CDAC" height="30"><?php echo $value; ?></td>
             <?php }  ?>
        <?php if($i  >= 2 and $i < sizeof($arrayCabecera)) {  ?>
                   <td bgcolor="#A0CDAC" height="30"><?php echo substr($value, 0, 1); ?></td>
                <?php }?>
           <?php if($i == sizeof($arrayCabecera)) {  ?>
                   <td bgcolor="#A0CDAC" height="30"><?php echo $value; ?></td>
                <?php }?>
       <?php }
        ?>
    </tr>
    <tr>
        <?php foreach ($arrayCabecera as $i => $value) {
            if($i <2) {?>
        <td bgcolor="#A0CDAC" height="30"></td>
                <?php }
         }
        ?>
       <?php foreach ($arrayCabecera as $i => $value) {
            if($i >=2  and $i < sizeof($arrayCabecera)) {?>
        <td bgcolor="#A0CDAC" height="30"><?php echo substr($value, 3, 4); ?></td>
        <?php }
       }
    ?>
    </tr>

    <?php foreach ($arrayFilas as $i => $val1) {
        if($codAnterior==$val1[0]) {
            $k=($k-1)*(-1);
            $k=($k-1)*(-1);

        }else {
            $k=($k-1)*(-1);
    }
            $colorx=$color[$k];
            $codAnterior=$val1[0];
    ?>
    <tr>
    <?php  foreach ($indice as $j => $val2) {
            ?>
        <td bgcolor="<?php echo $colorx;?>" align="<?php echo $arrayAling[$j]?>"><?php echo $arrayFilas[$i][$val2];?></td>
        <?php }?>
    </tr>
    <?php }?>


</table>
<br>
<?php
$descripcion='';
$cadena='<table border="1">';
foreach ($leyendaTESA as $i => $vax) {
    $cadena.='<tr><td>'.$vax[0].'</td>';
    $cadena.='<td>'.$vax[1].'</td>';
    $cadena.='<td>'.$vax[2].'</td></tr>';
}
        $cadena.='</table>';
?>
<table border="0" align="center">
    <tr>
<?php echo $cadena;?>
    </tr>
</table>
