
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>       
        <div  style="width:99%;height:auto;margin-left:1%;margin-right:1%; ">
            <input type="hidden" id="hidMaterialLabo" name="hidMaterialLabo" value="<?php echo $idMaterialLabo; ?>" />
            <input type="hidden" id="hcodserpro" name="hcodserpro" value="<?php echo $codSerPro; ?>" />
            <input type="hidden" id="hidTipoMaterialLabo" name="hidTipoMaterialLabo" value="<?php echo $idTipoMaterialLabo; ?>" />
            <input type="hidden" id="hnombreTipoMaterialLabo" name="hnombreTipoMaterialLabo" value="<?php echo $nombreTipoMaterialLabo; ?>" />
            <input type="hidden" id="hidArchivosMaterialLabo" name="hidArchivosMaterialLabo" value="<?php echo $idArchivosMaterialLabo; ?>" />
            <input type="hidden" id="hversionArchivo" name="hversionArchivo" value="<?php echo $iVersionArchivo; ?>" />
            <input type="hidden" id="hrutaCompletaArchivo" name="hrutaCompletaArchivo" value="<?php echo $rutaCompletaArchivo; ?>" />
            <input type="hidden" id="hrutaSubida" name="hrutaSubida" value="<?php echo $rutaSubida; ?>" />

            <?php

            $uploadDirectory = $rutaSubida;         //:      ../../../../carpetaDocumentos/
            echo 'ruta' . $uploadDirectory;
//            echo '111'. $uploadDirectoryjc.'222';
            require_once("AjaxFileUploader3.php");
            $ajaxFileUploader3 = new AjaxFileuploader3($uploadDirectory);
////            //echo $ajaxFileUploader->showFileUploader('id1');
            echo $ajaxFileUploader3->showFileUploaderjc3('id2', $idMaterialLabo, $codSerPro, $idTipoMaterialLabo, $nombreTipoMaterialLabo, $idArchivosMaterialLabo, $iVersionArchivo, $rutaCompletaArchivo, $rutaSubida);
////            
            ?>
        </div>
    </body>
</html>
