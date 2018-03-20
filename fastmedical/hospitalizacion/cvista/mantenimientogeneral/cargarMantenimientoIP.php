<center>
    <table style="border:0px solid;width:1000px;height: 70%;padding: 5px;">
        <tr>
        <div class="titleform">Mantenimiento de IP</div>
        </tr>
        <tr>

            <td>
                <div style="float:left;width:350px;border:0px solid;height: 100%;" id="izquierda">
                    <div style="width:100%;border:1px solid green;height: 30%;border-radius: 15px;padding:15px;">
                        <table>
                            <tr>
                                <td>
                                    <p style="font-size:20px;color:green">IP: 
                                </td>
                                <td>
                                    <input type="text" style="border:1px solid;font-size:22px;width:167px;" id="textIP"> 
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size:20px;color:green">Nombre:
                                </td>
                                <td>
                                    <input type="text" style="border:1px solid;font-size:22px;width:180px;" id="textPC" > 
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size:20px;color:green">Ambiente:
                                </td>
                                <td>
                                    <input type="text" style="border:1px solid;font-size:22px;width:210px;" id="textAmbiente" > 
                                    <div id="buscar" style="border:2px solid green;width:24px;height:24px;background-color:green;float:left;" onmouseout="this.style.background='#1B843C';" onmouseover="this.style.background='#006631';" onClick="this.style.background='lightgreen'; $('ambientesDiv').show();cargarTablaAmbientes();">
                                        <center><p style="font-size:18px;color:white;">...</center>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <table border="0">
                            <tr>
                                <td style="width: 120px;">

                                </td>
                                <td>
                                    <div id="nuevo" style="border:2px solid green;width:90px;height:25px;background-color:green;" onmouseout="this.style.background='#1B843C';" onmouseover="this.style.background='#006631';" onClick="this.style.background='lightgreen';$('guardar').show();$('buscar').show(); $('nuevo').hide(); $('textIP').disabled=false;$('textPC').disabled=false;$('textIP').focus(); ">
                                        <center><p style="font-size:18px;color:white;">Nuevo</center>
                                    </div>
                                    <div id="guardar" style="border:2px solid green;width:90px;height:25px;background-color:green;" onmouseout="this.style.background='#1B843C';" onmouseover="this.style.background='#006631';" onClick="this.style.background='lightgreen';guardarMantenimientoIp();">
                                        <center><p style="font-size:18px;color:white;">Guardar</center>
                                    </div>
                                    <div id="actualizar" style="border:2px solid green;width:90px;height:25px;background-color:green;" onmouseout="this.style.background='#1B843C';" onmouseover="this.style.background='#006631';" onClick="this.style.background='lightgreen';actualizarMantenimiento();">
                                        <center><p style="font-size:18px;color:white;">Actualizar</center>
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                        <br><br><br>
                        <div id="ambientesDiv"style="width:90%;border:1px solid green;height:150%;border-radius: 15px;padding:15px;">
                            <div id="contenedorTablaAmbientes" style="width:98%;height: 98%;border:1px solid"> 
                            </div>
                        </div>
                    </div>
                </div> 
                <div style="border:0px solid;float:left;width:100px;height: 100%;"></div>
                <div  style="width:100%;border:1px solid green;height: 25%;border-radius: 15px;padding:15px;float:left;width:500px;height: 80%;">
                    <div id="contenedorTablaIP" style="width:490px;height: 98%;border:1px solid"> 
                    </div>


                </div>
            </td>
        </tr>
    </table>
</center>
<input type="hidden" style="border:0px solid;font-size:22px;width:180px;" id="textID" > 
<input type="hidden" style="border:0px solid;font-size:22px;width:180px;" id="textIDAmbiente" > 