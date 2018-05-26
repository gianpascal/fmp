<input type="hidden" id="hiIdExamenesLaboratorio" name="hiIdExamenesLaboratorio"  value="">
<input type="hidden" id="hidPuntoControlExamenLab" name="hidPuntoControlExamenLab"  value="">
<input type="hidden" id="hnombrePuntoControl" name="hnombrePuntoControl"  value="">
<input type="hidden" id="hnombreExamen" name="hnombreExamen"  value="">
<input type="hidden" id="hfilaexamen" name="hfilaexamen"  value="">

<input type="hidden" id="hfilaPuntoControl" name="hfilaPuntoControl"  value="">
<input type="hidden" id="hcolumnaPuntoControl" name="hcolumnaPuntoControl"  value="">

<input type="hidden" id="hindicardorOcultar" name="hindicardorOcultar"  value="">



<div id="divContenidoPuntoControl" style="width:1300px; height:auto;  margin:1px auto; border: #006600 solid" align="center">
    <table border="1">
        <tr>

            <td> 
                <div id="div_ExamenPuntoControl">
                    <table>
                        <tr>
                            <td style="width:40px;float: center; height: auto; ">

                            </td>
                            <td>
                                <div class="titleform">
                                    <h1>MANTENIMIENTO DATOS DE EXAMENES</h1>
                                </div>
                                <div id="divPuntoControl" class="toolbar" style="width:450px;float: left; height: 280px; ">
                                    <table border="1" align="center">
                                        <tr align="center">
                                            <td colspan="2" style="width:400px;float: center; height: auto; ">
                                                <div class="titleform">
                                                    <h1>Examenes</h1>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                         <!--   <td> 
                                                <h3> <b>Buscar Examen</b></h3>
                                            </td>
                                            <td>
                                                <input type="text" id="txtNombreExamen" name="txtNombreExamen" onkeyup="buscarExamenesLaboratorio();"/>
                                            </td>
                                            -->
                                        </tr>
                                        <tr> <!-- examen -->
                                            <td colspan="2" style="width:400px;float: center; height: auto; "><!-- Tabla examen -->
                                                <div id="div_TablaExamenes" style="width:420px;float: left; height: 220px; ">
                                                </div>
                                            </td>
                                        </tr>   
                                    </table> 
                                </div>
                                </div>
                            </td>
                            <td style="width:60px;float: center; height: auto; ">
                                <div id="div_ocultarTablasExamenYpuntoControl">
                                    <a href="javascript:ocultarTablasExamenYpuntoControl();"> <img border="0" title="Nuevo" alt="" src="../../../../fastmedical_front/imagen/icono/fechaArriba.jpg"/></a>
                                </div>
                            </td>
                            <td>
                                <div class="titleform">
                                    <h1>PUNTO DE CONTROL DE LOS EXAMENES</h1>
                                </div>
                                <div id="divPuntoControl" class="toolbar" style="width:450px;float: left; height: 280px; ">
                                    <table border="1" align="center">
                                        <tr> <!-- examen -->
                                            <td colspan="2" style="width:450px;float: center; height: 140px; "><!-- Tabla examen -->
                                                <div id="div_TablaExamenesPuntoControl" style="width:450px;float: left; height: 250px; ">
                                                </div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td> 
                                                <div id="div_agregarNuevoPuntoControl">
                                                    <h3> <b>AGREGAR NUEVO PUNTO DE CONTROL</b></h3>  
                                                </div>                                
                                            </td>
                                            <td>
                                                <div id="div_agregarNuevoPuntoControlBoton">                                 
                                                    <a href="javascript:agregarNuevoPuntoControl();"> <img border="0" title="Nuevo" alt="" src="../../../../fastmedical_front/imagen/btn/b_adiciona_on.gif"/></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table> 
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <!-- ================================================================ -->
        <tr>
            <td colspan="4" style="width:10px;float: center; height: 4px; "> 
            </td>
        </tr> 

        <tr align="center">
            <td colspan="" align="center" style="width:940px;float: center; height: 100px; "> 
                <div id="div_rangoFormato" align="center">

                </div> 
            </td>
        </tr>


<!--        <tr> 
            <td colspan="4" >

                <div style="width:100%;height:5%;background: white">
                    <div class="titleform">
                        <h1>HISTORIAL DE MATERIALES</h1>
                    </div>
                </div>
            </td>


        </tr>-->

        <tr> 

            <td colspan="4" >


                <div  id ="div_MostrarMaterialesSeleccionadosXpuntoControlExamenLabo" style="width:100%;height:auto;">

                </div>
            </td>


        </tr>

        <tr> 

            <td colspan="4" >

                <div  id ="div_MostrarMuestrasSeleccionadosXpuntoControlExamenLabo" style="width:100%;height:auto;">

                </div>
            </td>


        </tr> 


        <tr> 

            <td colspan="4" >

                <div  id ="div_detalleMuestrasyLaboratorioxPuntodeControl1_prueba" style="width:100%;height:100%;">

                </div>
            </td>


        </tr> 






    </table>
</div>


