<div id="cabecera" align="center" style="width: 100%;height: 100%; color: #000000;">

               <table border="0" align="center">
                   
                    <tr align="center">

                        <td>

                            <div  id ="divCabeceraArea" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >Areas de <?php echo $datos["sede"] ?>  </h1>
                            </div>

                        </td>

                    </tr>
                   
                    
                     <tr align="center">
                      
                        <td>
                            <div style="width: 100%; height:50px;" align="center">
                                <input type="text" id="txtBusquedaArbolxAreas" name="txtBusquedaArbolxAreas" onkeypress="if(event.keyCode==13)busquedaAreasEnArbolPopup();" /> <a onClick="busquedaAreasEnArbolPopup()" style="cursor: pointer">Buscar Areas</a>
                            </div>


                        </td>

                    </tr>  
                    
                    
                    <tr align="center">
                        <td>
                            <div id="Div_TablaListaTurnosDisponibles" align="center" style="width:300px; height:380px;"></div>
                        </td>
                    </tr>
                </table>

</div>



