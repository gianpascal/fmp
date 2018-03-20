
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>       
        <div  style="width:99%;height:auto;margin-left:1%;margin-right:1%; ">
            <?php
            $uploadDirectory = '../../../../carpetaDocumentos/imagenesOdontograma/';
            require_once("AjaxFileUploaderSubirFoto.php");
            $ajaxFileUploaderActoMedico = new AjaxFileUploaderSubirFoto();
          $cadena= 'id1'.$datos["Id"];
            echo $ajaxFileUploaderActoMedico->showFileUploader($cadena,$uploadDirectory,$datos["Id"]);
            ?>
        </div>
    </body>
</html>