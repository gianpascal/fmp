<?php
    $id = $_POST['sessionId'];
    $id = trim($id);
    session_name($id);
    session_start();
    echo $_SESSION['value'];
    if($_SESSION['value']==-1)
    {
        session_destroy();
    }
    else if($_SESSION['value']=="NOTFORMATO"){
        session_destroy();
    }
    else if($_SESSION['value']=="EXISTE"){
        session_destroy();
    }
?>

