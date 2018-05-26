<?php
//@session_start();
 require_once("../../ccontrol/control/ActionAdmision.php");
if (isset($_POST['id'])) {
    $codPersona=$_POST['hdnCodPer'];
    $ruta=$_POST['hdnRuta'];
    $num=$_POST['hdnNum'];
    $ext = strrchr($_FILES[$_POST['id']]['name'],'.'); //capturo la extencion del archivo
    $nomfileupload=$codPersona.'_'.$num.$ext;  //nombre del archivo
    $uploadFile=$ruta.'/'.$nomfileupload;
//    "../admision/".$_GET['dirname']."/".$_FILES[$_POST['id']]['name'];

    if(!is_dir($ruta)) {
        echo '<script> alert("No se pudo encontrar el directorio final de carga ."+'.$ruta.');</script>';
    }
    if (!copy($_FILES[$_POST['id']]['tmp_name'], $uploadFile)) {
           echo '<script> alert("No se pudo cargar el archivo");</script>';
    }
}
else {
    $codPersona=$_GET['hdnCodPerx'];
    $ruta=$_GET['hdnRutax'];
    $num=$_GET['hdnNumx'];
    $ext = strrchr($_GET['filename'],'.'); //capturo la extencion del archivo
    $nomfileupload=$codPersona.'_'.$num.$ext;  //nombre del archivo
    $uploadFile=$ruta.'/'.$nomfileupload;
    if (file_exists($uploadFile)) {
     $o_ActionAdmision= new ActionAdmision();
     $o_ActionAdmision->actualizarFotoPersona($codPersona,$nomfileupload);
            //echo "Imagen cargada. <a href='$uploadFile'>Abir imagen</a> &nbsp;&nbsp;&nbsp; <a href='deletefile.php?filename=".$uploadFile."'>Eliminar imagen</a>";
    }
    else {
            echo "<img src='loading.gif' alt='loadingxxx...' />";
    }
}
echo "<table border='0' cellpadding='0' cellspacing='0'>".
     "<tr><td>".
     "<img src='$uploadFile' alt='DNI' width='150px' height='180px'/>".
     "</td><td>".
     //"<a href='#' onclick=\"myajax.Link('../admision/deletefile.php?filename=".$uploadFile."','foto')\">".
     //"<img src='../../../../fastmedical_front/imagen/icono/editdelete.png' title='ELIMINAR FOTO'/></a>".
     "</td></tr></table>";
?>


<?php
/*
@session_start();
if (isset($_POST['id'])) {
	$uploadFile=$_GET['dirname']."/".$_FILES[$_POST['id']]['name'];
	if(!is_dir($_GET['dirname'])) {
		echo '<script> alert("No se ha encontrado el directorio de Imagenes: "+'.$_GET['dirname'].');</script>';
	}
	if (!copy($_FILES[$_POST['id']]['tmp_name'], $_GET['dirname'].'/'.$_FILES[$_POST['id']]['name'])) {	
		echo '<script> alert("Fallo la carga de la Imagen");</script>';
	}
}
else {
	$uploadFile="../admision/".$_GET['dirname']."/".$_GET['filename'];
	if (file_exists($uploadFile)) {
	//echo "Imagen subida";
	//	echo "<img height='190' width='326' src='$uploadFile' alt='loading...' />";
	//	echo "<div id='msg_foto'>Delete File</a></div>";	
	}
	else {
		echo "<img src='loading.gif' alt='loading...' />";
	}
}
/*		echo 	
				"<table border='0' cellpadding='0' cellspacing='0'>".
				"<tr><td>".
				"<img src='$uploadFile' alt='DNI' />".
				"</td><td>".
				"<a href='#' onclick=\"myajax.Link('../admision/deletefile.php?filename=".$uploadFile."','msg_foto')\">".
				"<img src='../../../../fastmedical_front/imagen/icono/editdelete.png' title='ELIMINAR FOTO'/></a>".
				"</td></tr></table>";	
*/
?>