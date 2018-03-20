<?php

@session_start();

class AjaxFileuploader3 {

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

    public function showFileUploader($uploaderId, $idDocEmp, $idDocumento, $nomDocumento, $version, $codPersona, $ruta) {
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
            return '<form id="formName' . $uploaderId . '" method="post" enctype="multipart/form-data" action="../rrhh/fileupload.php?dirname=' . $this->uploadDirectory . '" target="iframe">
                            <input type="hidden" name="id" value="' . $uploaderId . '" />
                            <input type="hidden" id="hdnIdDocEmp" name="hdnIdDocEmp" value="' . $idDocEmp . '" />
                            <input type="hidden" id="hdnIdDocumento" name="hdnIdDocumento" value="' . $idDocumento . '" />
                            <input type="hidden" id="hdnVersion" name="hdnVersion" value="' . $version . '" />
                            <input type="hidden" id="hdnCodPersona" name="hdnCodPersona" value="' . $codPersona . '" />
                            <input type="hidden" id="hdnNomDocumento" name="hdnNomDocumento" value="' . $nomDocumento . '" />
                            <input type="hidden" id="hdnRuta" name="hdnRuta" value="' . $ruta . '" />
                            <input type="hidden" id="hdnFlag" name="hdnFlag" value="' . $flag . '" />
                            <span id="uploader' . $uploaderId . '" style="font-family:verdana;font-size:10;">
                                    ADJUNTAR ARCHIVO: <input name="' . $uploaderId . '" type="file" value="' . $uploaderId . '" onchange=\'return uploadFileCV(this,"' . $this->uploadDirectory . '")\' /></span>
                            <span id="loading' . $uploaderId . '"></span>
                        </form>';
        }
    }

//creado por JCQA 1 Agosto 2012 2:40pm
//    $uploaderId='id'


    public function showFileUploaderjc3($uploaderId, $idMaterialLabo, $codSerPro, $idTipoMaterialLabo, $nombreTipoMaterialLabo, $idArchivosMaterialLabo, $iVersionArchivo, $rutaCompletaArchivo, $rutaSubida) {
//        $jose = '123';
//        echo $jose;
//$x= $this->uploadDirectory;
//echo 'Inic'.$x.'Fin';
        if (in_array($uploaderId, $this->uploaderIdArray)) {
            die($uploaderId . " already used. please choose another id.");
            return '';
        } else {
            $flag = 0;
            if (strrpos($rutaSubida, '\\')) {      //se verifica si la cadena contiene (\)
                $rutaSubida = str_replace("\\", "/", $rutaSubida); //reemplazamos la cadena (\) por (/)
                $flag = 1;
//                echo $flag;
            }
            $this->uploaderIdArray[] = $uploaderId;
            return '<form id="formName' . $uploaderId . '" method="post" enctype="multipart/form-data" action="../laboratorio/fileupload3.php?dirname=' . $this->uploadDirectory . '" target="iframe1">
                       <input type="hidden" name="id" value="' . $uploaderId . '" />
                       <input type="hidden" id="hdnMaterialLabo" name="hdnMaterialLabo" value="' . $idMaterialLabo . '" />
                       <input type="hidden" id="hdncodserpro" name="hdncodserpro" value="' . $codSerPro . '" />
                       <input type="hidden" id="hdnTipoMaterialLabo" name="hdnTipoMaterialLabo" value="' . $idTipoMaterialLabo . '" />
                       <input type="hidden" id="hdnnombreTipoMaterialLabo" name="hdnnombreTipoMaterialLabo" value="' . $nombreTipoMaterialLabo . '" />
                       <input type="hidden" id="hdnidArchivosMaterialLabo" name="hdnidArchivosMaterialLabo" value="' . $idArchivosMaterialLabo . '" />
                       <input type="hidden" id="hdnversionArchivo" name="hdnversionArchivo" value="' . $iVersionArchivo . '" />
                       <input type="hidden" id="hdnrutaCompletaArchivo" name="hdnrutaCompletaArchivo" value="' . $rutaCompletaArchivo . '" />
                       <input type="hidden" id="hdnrutaSubida" name="hdnrutaSubida" value="' . $rutaSubida . '" />      
                          
                       <input type="hidden" id="hdnFlag1" name="hdnFlag1" value="' . $flag . '" />
                       <span id="uploader' . $uploaderId . '" style="font-family:verdana;font-size:10;">
                        ADJUNTAR ARCHIVO: <input name="' . $uploaderId . '" type="file" value="' . $uploaderId . '" onchange=\'return uploadFileCVjc(this,"' . $this->uploadDirectory . '")\' /></span>
                        <span id="loading' . $uploaderId . '"></span>
                        </form>';
        }
    }

}
?>

