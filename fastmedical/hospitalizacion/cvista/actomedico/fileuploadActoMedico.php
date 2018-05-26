<?php
require_once("../../../pholivo/Html.php");
if (isset($_POST['id'])) {
    $numeric = $_POST['autonumerico'];
    $flag = $_POST['hdnFlagAngel'];
    $dir = $_POST['hdnRutaAngel'];
    $version = $_POST['iVersion' . $numeric];
    //$autonumerico = $_POST['autonumerico'];
    $idHIstoriaDiente =  $_POST['idHistoriaDiente'. $numeric];
    
    if ($flag == 1) {
        $dir = str_replace("/", "\\", $dir);
    }
    $ext = strrchr($_FILES[$_POST['id']]['name'], '.'); //capturo la extencion del archivo
    $versionFinal = $version + 1 ;
    $nomFile = "diente_" . $idHIstoriaDiente . "_V" . $versionFinal;
    $nomfileupload = $nomFile . $ext;  //nombre del archivo
    $uploadFile = $dir . $nomfileupload; //ruta y nombre del archivo como se va guardar
    if (!is_dir($dir)) {
        echo '<script> alert("No se pudo encontrar el directorio final de carga");</script>';
        echo '<script>clearInterval(timeInterval);</script>';
    }
    if (!copy($_FILES[$_POST['id']]['tmp_name'], $uploadFile)) {
        echo '<script> alert("No se pudo cargar el archivo");</script>';
        echo '<script>clearInterval(timeInterval);</script>';
    }
} else {
//    echo '<script> alert("entroo get'.$_GET['iddocemp1'].'");</script>';
    /* -------estos parametros bienen por el metodo get desde el javaScript uploaderCV.js */
    $flag = $_GET['hdnFlagx'];
    $dir = $_GET['hdnRutax'];
    $version = $_GET['version'];
    $numeric = $_GET['autonumerico'];
    $idHIstoriaDiente =  $_GET['idHistoriaDiente'];
    if ($flag == 1) {
        $dir = str_replace("/", "\\", $dir);
    }
   $versionFinal = $version + 1 ;
    $nomFile = "diente_" . $idHIstoriaDiente . "_V" . $versionFinal;
    $ext = strrchr($_GET['filename'], '.'); //capturo la extencion del archivo
    $nomfileupload = $nomFile . $ext;
    $uploadFile = $dir . $nomfileupload;
    if (file_exists($uploadFile)) {
        echo '<script>clearInterval(timeInterval);</script>';
    } else {
        echo "<img src='../admision/loading.gif' alt='loading...' />";
    }
}

$result = '';
$result.='<div style="border:0px solid black;padding-left:5px;width:90px;height:90px;padding-right:10px;border-radius:10px;">';
$result.= '<table style="border:0px solid;width:60px;height:60px;padding:3px;" cellpadding="0" cellspacing="0">';
$result.= '<tr>';
$result.= '<td>
<a href="../../../hospitalizacion/visorImagen/visor.php?url=../../carpetaDocumentos/imagenesOdontograma/'.$nomfileupload.' &rotacion=rot0" target="_blank"><div id="contenedorImagen' . $numeric . '"><img  src="../../../../carpetaDocumentos/imagenesOdontograma/'.$nomfileupload.'"  style="cursor: pointer;border-radius:20px;border:1px solid black;width:100px;height:100px;"></div></a></td>';
$result.= '<td><div style="border:0px solid;">
					<table>
					<tr>
					<td><button   
					onclick="volverAcargar(' . $numeric . ');" style="cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; "><img src="../../../../fastmedical_front/imagen/icono/otro.png"></button></td>
					</tr>
					<tr>
					<td></td>
					</tr>
					<tr>
					<td></td>
					</tr>
					</table></div></td>';
$result.= '</tr>';
$result.='<div style="border:0px solid;">
					</div>';
$result.= '</table>';
$result.='</div>';
$result.='<input type="hidden" id="url' . $numeric . '" value="../../../../carpetaDocumentos/imagenesOdontograma/'.$nomfileupload.'">';
$result.='<input type="hidden" id="rotacion' . $numeric . '" value="0">';
$result.='<input type="hidden" id="comidin' . $numeric . '" value="0">';
$result.='<input type="hidden" id="width' . $numeric . '" value="">';
$result.='<input type="hidden" id="version' . $numeric . '" value="'.$version.'">';
$result.='<input type="hidden" id="height' . $numeric . '" value="">';
echo $result;
?>

