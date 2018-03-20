<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script type='text/javascript' src='../../../javascript/colorpicker/procolor.compressed.js'></script>
    </head>
    <body><div class='wrapper'>
            <input id="hex" style="width: 6em;" type="text" />
            <div id="colorpicker"></div>
            <div id="log"></div>
            <script type="text/javascript">
                new ProColor({
                    mode:'static',
                    parent:'colorpicker',
                    imgPath:'../../../javascript/colorpicker/img/procolor_win_',
                    input:'hex',
                    showInField: true,
                    color:'#FF0000',
                    outputFormat:'(#{RR}{GG}{BB})'
                });
               </script>
            <br/>
            <div id="modificarCombo" style="margin-left: 37%; margin-right: 37%;">
                <?php
                $toolbar1=new ToollBar("center");
                $toolbar1->SetBoton("Aceptar","Aceptar","btn","onclick,onkeypress","seleccionarColor()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/button_ok.png","","",1);
                $toolbar1->Mostrar();
                ?>
            </div>
        </div></body>
</html>
