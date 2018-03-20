<?php
////$filename="horarios";
//header('Content-type: application/vnd.ms-excel');
//header("Content-Disposition: attachment; filename=".$nameFileGenerar.".xls");
//header("Pragma: no-cache");
//header("Expires: 0");
//
////header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
////header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
////header ("Cache-Control: no-cache, must-revalidate");
////header ("Pragma: no-cache");
////header ("Content-type: application/x-msexcel");
////header ("Content-Disposition: attachment; filename=\"prueba.xls\"" );
//
////header("Content-Type: application/vnd.ms-excel");
////header("Expires: 0");
////header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
////header("content-disposition: attachment;filename=NOMBRE.xls");
////******************************************************************************
////$codAnterior="";
////$indice=array_keys($arrayCabecera);
////$color=array(0=>"#D8EBDD",1=>"#FFFFFF");
////$colorx="";
////$k=1;
////******************************************************************************
//$numColum=count($arrayCabecera1);
//$plantilla="<table border='1'>";
//$plantilla.="<tr>";
//foreach ($arrayCabecera1 as $j => $value) {
//    $plantilla.="<td bgcolor='#95BB9E'>".$value."</td>";
//}
//$plantilla.="</tr>";
//$plantilla.="<tr>";
//foreach ($arrayCabecera2 as $j => $value) {
//    $plantilla.="<td bgcolor='#95BB9E' width='".$arrayWidth[$j]."' >".$value."</td>";
//}
//$plantilla.="</tr>";
//
//foreach ($arrayCuerpo as $i => $value) {
//    $plantilla.="<tr>";
//    for ($j = 0; $j < $numColum; $j++) {
//        $plantilla.="<td>".$value[$j]."</td>";
//    }
//    $plantilla.="</tr>";
//}
//$plantilla.="</table>";
//
//
//echo $plantilla;
?>

<?php

$assoc = array(
			array("Nombre"=>"Mattias", "IQ"=>250),
			array("Nombre"=>"Tony", "IQ"=>100),
			array("Nombre"=>"Peter", "IQ"=>100),
			array("Nombre"=>"Edvard", "IQ"=>100)
		 );
require_once("../../MSExcelStreamHandler/MSExcelStreamHandler/excel.php");
require_once("../../MSExcelStreamHandler/MSExcelStreamHandler/excel-ext.php");


createExcel("excel_mysql.xls", $assoc);
exit;
?>
