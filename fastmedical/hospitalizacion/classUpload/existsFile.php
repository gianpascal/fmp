<?php
$nomFile=$_REQUEST["nomFile"];
$rutaFile=$_REQUEST["rutaFile"];
$extension=$_REQUEST["extension"];
try {
    $resp="not";
    $target_path=$rutaFile.$nomFile.".".$extension;
    if(file_exists($target_path)) {
        $resp="ok";
    }
    echo $resp;
}catch (Exception $e) {
    echo "error";
}
?>
