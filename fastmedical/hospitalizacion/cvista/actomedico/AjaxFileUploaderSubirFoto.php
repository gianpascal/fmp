<?php

@session_start();

class AjaxFileUploaderSubirFoto {

    private $uploadDirectory = '';
    private $uploaderIdArray = array();

    public function AjaxFileuploader($uploadDirectory) {
        if (trim($uploadDirectory) != '' && is_dir($uploadDirectory)) {
            $this->uploadDirectory = trim($uploadDirectory);
        } else {
            die("<b>ERROR:</b> Failed to open Directory: $uploadDirectory");
        }
    }

    public function getAllUploadedFiles() {
        $returnArray = array();
        $allFiles = $this->scanUploadedDirectory();
        return $returnArray;
    }

    private function scanUploadedDirectory() {
        $returnArray = array();
        if ($handle = opendir($this->uploadDirectory)) {
            while (false !== ($file = readdir($handle))) {
                if (is_file($this->uploadDirectory . "/" . $file)) {
                    $returnArray[] = $file;
                }
            }
            closedir($handle);
        } else {
            die("<b>ERROR: </b> Could not read directory: " . $this->uploadDirectory);
        }
        return $returnArray;
    }

    public function showFileUploader($uploaderId, $ruta,$datos) {
        if (in_array($uploaderId, $this->uploaderIdArray)) {
            die($uploaderId . " already used. please choose another id.");
            return '';
        } else {
            $flag = 0;
            if (strrpos($ruta, '\\')) {      //se verifica si la cadena contiene (\)
                $ruta = str_replace("\\", "/", $ruta); //reemplazamos la cadena (\) por (/)
                $flag = 1;
//                echo $flag;
            }
            $this->uploaderIdArray[] = $uploaderId;

            
            return '<form id="formNameAngel' . $uploaderId . '" method="post" enctype="multipart/form-data" action="../actomedico/fileuploadActoMedico.php?dirname=' . $this->uploadDirectory . '" target="iframe">
                            <input type="hidden" name="id" value="' . $uploaderId . '" />
                              <input type="hidden" name="autonumerico" value="' . $datos . '" />  
                            <input type="hidden" id="hdnRutaAngel" name="hdnRutaAngel" value="' . $ruta . '" />
                            <input type="hidden" id="hdnFlagAngel" name="hdnFlagAngel" value="' . $flag . '" />
                                <input type="hidden" id="iVersion'.$datos.'" name="iVersion'.$datos.'" value="" />
                                     <input type="hidden" id="idHistoriaDiente'.$datos.'" name="idHistoriaDiente'.$datos.'" value="" />
                            <span id="uploaderAngel' . $uploaderId . '" style="font-family:verdana;font-size:10;">
                                   <input  name="' . $uploaderId . '" type="file" value="' . $uploaderId . '" onchange=\'return subirFotoProcimientoDiente('.$datos.',this,"' . $this->uploadDirectory . '")\' /></span>
                                    <span id="loadingAngel' . $uploaderId . '"></span>
                        </form>';
        }
    }

}
?>

