<?php
    /*session_name("PANEL");
    session_start();
    session_register('sess');
    session_unregister('sess');
    $arreglo=parse_url($HTTP_REFERER);
    session_unset();
    session_destroy();
    session_write_close();*/
	
    session_name("PANEL");
    session_start();
    session_register('sess');
    session_unregister('sess');
    session_unset();
    session_destroy();
    session_write_close();
    header("Location: ../../index.php");
?>