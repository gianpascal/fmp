<html>
    <head>
        <style type="text/css">
            input{
                text-align:right;
                width: 100%;
                border: solid 2px blue;
                font-family: verdana;
                color:rgba(0,0,255,0.7);       
                font-size:15pt;
                font-weight:bold; 
            }
            #trTablaCB{
                width: 1200px;
                height:550px;
                background-size:1200px 550px;
                background-image: url('../../../../medifacil_front/imagen/fondo/laser_reader.jpg');
                background-position:center;
                background-repeat: no-repeat;
            }
        </style>
    </head>
    <div align="center" id="divGeneracionCodigoBarra" style="width: 1200px;height: 80%;margin: 1px auto; border: medium solid rgb(0, 102, 0);display:block;">
        <table align="center" style="width:1200px">
            <tbody style="height: 140px;background-color:rgba(255,255,0,0.2)">
                <tr style="height: 20px">
                    <td>
                        <div class="titleform" id="divCabeceraGeneracionCodigoBarra"style="width:100%;background-color: #D6E9FE; color: #770088">
                            <h1>GENERACION DE CODIGO DE BARRA</h1>
                        </div>
                    </td>
                </tr>
                <tr align="center" style="height: 100px">
                    <td>
                        <table align="center" style="width:700px;height: 130px" border="0" >
                            <tr>           
                                <td align="left"><h1><center>RANGO INICIAL:</center></h1></td>
                                <td align="left"><h1><center>RANGO FINAL:</center></h1></td>
                                <td align="left"><h1><center>ESCALA:</center></h1></td>
                            </tr>
                            <tr>           
                                <td align="right"><input type="text" id="txtRangoCodigoBarraInicio" onkeypress="return validFormSalt('nro', this, event, 'txtRangoCodigoBarraFinal')" maxlength="9" value="1"></td>
                                <td align="right"><input type="text" id="txtRangoCodigoBarraFinal" onkeypress="return validFormSalt('nro', this, event, 'txtNumerosDeColumna')" maxlength="9" value="100"></td>
                                <td><select id="ComboEscala" style="font-size:20px; ">
                                        <option value="1">Pequeño</option>
                                        <option value="2">Mediano</option>
                                        <option value="3">Grande</option>
                                    </select> </td>
                            </tr>
                            <tr align="center">
                                <td colspan="4"><img id="imgGenerarCodigoBarra" border="0" title="Generar Codigo Barra" src="../../../../medifacil_front/imagen/btn/generar.bmp" onclick="generarCodigoBarra()" ></td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr style="height: 20px">
                    <td>
                        <div class="titleform" id="divPieGeneracionCodigoBarra"style="width:100%; background-color: #D6E9FE; color: #770088">
                            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot style="width: 1200px">
                <tr id="trTablaCB" >
                    <td>
                        <table border="1" align="center" style="border-radius: 15px;width: 80%;height: 350px;margin-left: 10%;margin-right: 1%">
                            <tr align="center" style="height: 20px">
                                <td>                        
                                    <div align="" class="titleform" id="divCabeceraTablaGCB"style="width:100%;background-color: #D6E9FE; color: #770088">
                                        <h1>RANGOS GENERADOS</h1>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><div id="DivTablaRangoCodigoBarra" style="border-radius: 15px;height: 320px;background-color:rgba(255,255,255,0.5);"></div></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</html>