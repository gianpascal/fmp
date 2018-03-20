
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>       
        <div  style="width:99%;height:auto;margin-left:1%;margin-right:1%; ">
           <input type="hidden" id="idDocEmp" name="idDocEmp" value="<?php echo $idDocEmp;?>" />
           <input type="hidden" id="version" name="version" value="<?php echo $version;?>" />
           <input type="hidden" id="nomDocumento" name="nomDocumento" value="<?php echo $nomDocumento;?>" />
           <input type="hidden" id="idDocumento" name="idDocumento" value="<?php echo $idDocumento;?>" />
           <input type="hidden" id="codPersona" name="codPersona" value="<?php echo $codPersona;?>" />
           <input type="hidden" id="rutax" name="rutax" value="<?php echo $ruta;?>" />
            <?php
            $uploadDirectory = $ruta;
            require_once("AjaxFileUploader2.php");
            $ajaxFileUploader2 = new AjaxFileuploader2($uploadDirectory);
            //echo $ajaxFileUploader->showFileUploader('id1');
            echo $ajaxFileUploader2->showFileUploader('id1',$idDocEmp,$idDocumento,$nomDocumento,$version,$codPersona,$ruta);
            ?>
        </div>
    </body>
</html>
