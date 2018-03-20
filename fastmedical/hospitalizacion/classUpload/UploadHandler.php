<?php
// borrador
//  $inputName = $_GET['userfile'];
// borrador
  prin_r($inputName);

$nombreFile=$_REQUEST["nomFile"];
$opcion=$_REQUEST["opcion"];
//$nombreFile=$_REQUEST["nomFile"];
$rutaFile=$_REQUEST["rutaFile"];
echo $nombreFile.'/'.$opcion.'/'.$rutaFile;
try {
    switch ($opcion) {
        case "imagen":

            $nomFile=$_REQUEST["nomFile"];
            $id  = $_GET['sessionId'];
            $id = trim($id);
            session_name($id);
            session_start();
            $inputName = $_GET['userfile'];
            $fileName  = $_FILES[$inputName]['name'];
            $tempLoc   = $_FILES[$inputName]['tmp_name'];
            echo $_FILES[$inputName]['error'];
            $target_path = '../../../carpetaDocumentos/';

            /*
             * carpturo el nombre y la extension del file
            */

            $nombre_extension=basename($fileName);

            /*
             * carpturo la extension del file
            */

            $extension=end(explode(".", $nombre_extension));//con esto obtengo la extensión del documento

            /*
             * colocar un nuevo file
            */

            $nomFile=$nomFile.".".$extension;

            /*
             * adjuntar solo imagen
            */

            if($extension==".jpg" || $extension==".png" || $extension==".gif" || $extension==".JPG"  || $extension==".PNG" || $extension==".GIF") {
                $target_path = $target_path . $nomFile;
                if(move_uploaded_file($tempLoc,$target_path)) {
                    $_SESSION['value'] = -1;
                }
            }
            else {
                $_SESSION['value'] = "NOTFORMATO";
            }
            break;
        case "horario":
            $nomFile=$_REQUEST["nomFile"];
            $id  = $_GET['sessionId'];
            $id = trim($id);
            session_name($id);
            session_start();
            $inputName = $_GET['userfile'];
            $fileName  = $_FILES[$inputName]['name'];
            $tempLoc   = $_FILES[$inputName]['tmp_name'];
            echo $_FILES[$inputName]['error'];
            $target_path = '../../../carpetaDocumentos/';

            /*
            * carpturo el nombre y la extension del file
            */

            $nombre_extension=basename($fileName);

            /*
            * carpturo la extension del file
            */

            $extension=end(explode(".", $nombre_extension));//con esto obtengo la extensión del documento

            /*
            * colocar un nuevo file con la extesión
            */
            $nomFile=$nomFile.".".$extension;

            $target_path = $target_path . basename($nomFile);

            if(move_uploaded_file($tempLoc,$target_path)) {
                $_SESSION['value'] = -1;
            }
            break;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
?>
