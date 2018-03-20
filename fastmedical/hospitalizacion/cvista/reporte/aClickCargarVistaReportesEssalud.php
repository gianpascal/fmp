<!doctype html>
<html>
    <head>
        <style>
            .btnGenerarReporteEssalud{
                height: 35px;
                border:1px solid #087F37;
                cursor: pointer;
                background-color: #087F37;
                color:white;
                font-weight: bold;
                font-family: verdana;
                font-size: 14px;
                padding:12px 6px 0px 6px;
            }
            .btnGenerarReporteEssalud:hover{
                background-color: #8AB8CA;  

            }
        </style>



    </head>
    <body>
        <?php
        if ($datos['p1'] == 1) {
            $vPatron  = 'historiasMamografias';
            $hiddenAr='';
            $hiddenAb='style="display:none;"';
        }
         if ($datos['p1'] == 2) {
            $vPatron  = 'historiasPapanicolaou';
            $hiddenAr='';
            $hiddenAb='style="display:none;"';
        }
         if ($datos['p1'] == 3) {
             $vPatron  = 'historiasPreventivas';
            $hiddenAr  = 'style="display:none;"';
            $hiddenAb='';
        }
        
        ?>
        <div class="titleform">
            <h1><?php echo $datos['p2'] ?></h1>
        </div>

        <br>
        <table border="0"style="margin-left: 50px;">
            <tr <?php echo $hiddenAr;?>>
                <td>
                    Feha Inicio:
                </td>
                <td>
                    <input size="15" type="text" name="txtFechaMesFin" id="txtFechaMesInicio" size="20" onclick="calendarioHtmlx('txtFechaMesInicio')" maxlength="10">
                </td>
                <td rowspan="2">
                    <div class="btnGenerarReporteEssalud" onClick="generarReporteModuloEssalud();">  
                        Generar
                    </div>
                </td>
            </tr>
            <tr <?php echo $hiddenAr;?>>
                <td>
                    Feha Fin:
                </td>
                <td>
                    <input size="15" type="text" name="txtFechaMesFin" id="txtFechaMesFin" size="20" onclick="calendarioHtmlx('txtFechaMesFin')" maxlength="10">
                </td>
            </tr>
            <tr>
                <td colspan="2" <?php echo $hiddenAb;?>>
                    <div id="divContenedorCalendar" style="whidh:100%;height: 100%;">
                        
                    </div>
                </td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $vPatron;?>" id="txtPatroModulo">
    </body>
    
    
</html>
