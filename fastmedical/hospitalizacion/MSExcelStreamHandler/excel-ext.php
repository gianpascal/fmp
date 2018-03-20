<?php
function createExcel($filename, $arrydata) {
    $excelfile = "xlsfile://tmp/".$filename;
//    $excelfile = "xlsfile://".$filename;
    /*+----------------------------------------+*/
//    $rutax=sys_get_temp_dir();
//    $rutax=$rutax."/".$filename;
//    if(file_exists($rutax)) {
////            if(unlink("/tmp/".$filename))
////            print_r("El archivo fue borrado");
//    }else
//        print_r("nooooooooooooo".$rutax);
    /*+----------------------------------------+*/
    $fp = fopen($excelfile, "wb");
//    $fp = fopen($excelfile, "wb");
    if (!is_resource($fp)) {
        die("Error al crear $excelfile");
    }
    fwrite($fp, serialize($arrydata));
    fclose($fp);
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"" . $filename . "\"" );
    readfile($excelfile);
}
?>