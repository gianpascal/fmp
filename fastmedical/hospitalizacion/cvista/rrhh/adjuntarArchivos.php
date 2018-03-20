<?php
/*+-------------------------------------------------------------------------------------------+
  +---------------------------- Autor Juan Carlos Ludeña Montesinos --------------------------+
  +-------------------------------------------------------------------------------------------+
  // Aquí se muestrar las pantallas de subida
*/
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(isset ($upload) && $upload=="fotoEmpleado") { ?>
        <div id="divAdjuntarFoto"></div>
            <?php }?>
        <?php if(isset ($upload) && $upload=="excelHorarios") { ?>
        <div id="divAdjuntarHorarios"> </div>
            <?php }?>
        <div id="divResultado" style="width: 90%" align="center"></div>
    </body>
</html>
