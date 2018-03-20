<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>AJAX File uploader</title>
    </head>
    <body>
        <?php
        require_once("../../ccontrol/control/ActionAdmision.php");
        $o_ActionAdmision= new ActionAdmision();
        $recRuta=$o_ActionAdmision->recuperarRuta('fotos');
        $iid_persona=$_GET['codPersona'];
        $imgFoto=$_GET['imgFoto'];
        $uploadDirectory = $recRuta[0][0];
        require_once("AjaxFileUploader.inc.php");
        $ajaxFileUploader = new AjaxFileuploader($uploadDirectory);
        //echo $ajaxFileUploader->showFileUploader('id1');
        echo $ajaxFileUploader->showFileUploader('id1',$iid_persona,$uploadDirectory,$imgFoto);
        ?>
    </body>
</html>