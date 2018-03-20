<?php
require_once("../../../pholivo/Html.php");
require_once("../../ccontrol/control/ActionRrhh.php");
//$dir='\\\\192.168.31.232\\carpetaDocumentos\\';
if (isset($_POST['id'])) {
//echo '<script> alert("entro post'.$_POST['iddocemp1'].'");</script>';
    $flag=$_POST['hdnFlag'];
    $dir=$_POST['hdnRuta'];
    
    if($flag==1){
        $dir = str_replace("/","\\",$dir);
    }
    $ext = strrchr($_FILES[$_POST['id']]['name'],'.'); //capturo la extencion del archivo
    $idDocumentoEmpleado=$_POST['hdnIdDocEmp'];
    $idDocumento=$_POST['hdnIdDocumento'];
    $version=$_POST['hdnVersion']+1;
    $codPersona=$_POST['hdnCodPersona'];
    $nomFile = $codPersona."_".$idDocumentoEmpleado."_V".$version;
    $nomfileupload=$nomFile.$ext;  //nombre del archivo
    $uploadFile=$dir.$nomfileupload; //ruta y nombre del archivo como se va guardar
// print_r($uploadFile);
    if(!is_dir($dir)) {
        echo '<script> alert("No se pudo encontrar el directorio final de carga");</script>';
         echo '<script>clearInterval(timeInterval);</script>';
    }
    if (!copy($_FILES[$_POST['id']]['tmp_name'], $uploadFile)) {
        echo '<script> alert("No se pudo cargar el archivo");</script>';
         echo '<script>clearInterval(timeInterval);</script>';
    }
}
else {
//    echo '<script> alert("entroo get'.$_GET['iddocemp1'].'");</script>';
    /*-------estos parametros bienen por el metodo get desde el javaScript uploaderCV.js*/
    $flag=$_GET['hdnFlagx'];
    $dir=$_GET['hdnRutax'];
     if($flag==1){
        $dir = str_replace("/","\\",$dir);
    }
    $idDocumentoEmpleado=$_GET['hdnIdDocEmpx'];
    $idDocumento=$_GET['hdnIdDocumentox'];
    $version=$_GET['hdnVersionx']+1;
    $codPersonax=$_GET['hdnCodPersonax'];
    $nomFile = $codPersonax."_".$idDocumentoEmpleado."_V".$version;
    $ext = strrchr($_GET['filename'],'.'); //capturo la extencion del archivo
    $nomfileupload=$nomFile.$ext;
    $uploadFile=$dir.$nomfileupload;
// print_r($uploadFile);
    if (file_exists($uploadFile)) {
        echo '<script>clearInterval(timeInterval);</script>';
//        $nomDocumento=$_GET['hdnNomDocumentox'];
            $o_ActionRrhh= new ActionRrhh();
            $respuesta=$o_ActionRrhh->guardarAtributoDocumentoEmpledo($idDocumentoEmpleado,$nomfileupload);
    }
    else {
        echo "<img src='../admision/loading.gif' alt='loading...' />";
    }
}
echo "<table border='0' cellpadding='0' cellspacing='0'>".
        "<tr><td>";
    echo "<ul>";
//    echo "<li><a href=\"../../../../../../../\\\\192.168.31.232\archivos\pruebita.txt\">pruebita</a></li>\n";
            echo "<li><a href=\"".$uploadFile."\">Se ha adjuntado el archivo (".$nomfileupload.")</a></li>\n";
    echo "</ul>";
echo '</td>
      </tr></table>';
?>

