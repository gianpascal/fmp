<!doctype html>
<html>
    <head>
        <style>
            .elementoMenu{
                width:150px;
                height:45px;
                border:1px  dashed #8AB8CA;
                cursor: pointer;
                color:white;
                font-weight: bold;
                font-family: verdana;
                font-size: 12px;
                margin:5px;
            }
            .elementoMenu:hover{
                background-color: rgba(118,161,90,0.5); 
                cursor: pointer;
            }
            #cuboContenedorBotom .elementoMenu {
                display: none;
            }

            #cuboContenedorBotom:hover .elementoMenu {
                display: block;
            }
        </style>
    </head>
    <body>
       <center> <div class="elementoMenu" onclick="cargarTablaProgramacionDHTMLX.toExcel('../../../grid-excel-php/generate.php');">
            <table>
                <tr>
                    <td>
                        <img class="imgExel" src="../../../imagen/formatos/xls.png" width="40">
                    </td>
                    <td>
                <center><label>Generar Excel</label></center>
                </td>
                </tr>
            </table>
        </div></center>
        <div style="width:100%;height:520px;border:1px solid black;">
            <div id="contenedorTablitaImprimibleAngelSayes" style="width:100%;height:100%;border:0px solid black;">

            </div>
        </div>


    </body>
</html>