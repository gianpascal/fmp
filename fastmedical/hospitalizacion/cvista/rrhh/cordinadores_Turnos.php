
<?php
//$iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];
//echo 'El Cod. del Coordinador: ' . $iCodEmpCoordinador . '<br>';
//echo 'El Nombre del Coordinador: ' . $arrayNombreCoordinador[0][0];
//phpinfo();
?>

<!--<div style="width:100%;height:5%;background: lightgreen">-->


<div style="width:100%;height:5%;background-color:white ">    
    <div class="titleform">
        <h1>Coordinadores &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;Turnos&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;AREAS</h1>
    </div>
</div>

<center>
    <!--    <div id="cabecera" align="center" style="width: 50%;height: 11%">-->
    <div id="cabecera" align="center" style="width: 50%;height: 50px">

        <!--        <fieldset style="width:90%;height:34%; font-size:1.2em;background-color: #D6E9FE">
                    <legend>Nombre del Super Coordinador</legend>
        
        
                    <div id='fila1' style="height:100%; width:100%; color: #000000; border: 0px solid #87A57E;">
        
                        <b><?php echo $arrayNombreCoordinador[0][0] ?></b>
        
                    </div>
                </fieldset>-->


        <fieldset  style="width:35%;height:100%; font-size:1.4em;background-color: #D6E9FE">
            <legend style="font-size:medium ">Seleccione: Sede :</legend>
            <div id='fila1' style="height:10%; width:100%; ">

                <table style="width:100%; border:0">   

                    <tr  align="center">
                        <td> &nbsp;&nbsp;
                        </td>
                        <td>
                            <div style="width: 20%; float: left;font-size: medium" id="divEtiquetaNombre">
                                Sede:
                            </div>

                        </td>
                        <td >&nbsp;&nbsp;
                        </td>
                        <td>
                            <select name="cboSede" id="cboSede" style="width: 100px;" onchange ="CargarTotalCoordinadores()">
                                <option value="x">  <?php echo 'TODOS' ?> </option>
                                <?php foreach ($arrayTotalSedes as $i => $val) { ?>
                                    <option value="<?php echo $val[1] ?> " >  <?php echo $val[0] ?> </option>

                                <?php } ?>
                            </select>
                        </td>

                        <td > &nbsp;&nbsp;
                        </td>

                    </tr>
                </table>
            </div>   
        </fieldset>



    </div>

</center>

<!--espacio-->
<center>
    <div id="cabecera" align="center" style="width: 70%;height: 10px; color: #000000;">

    </div>     

</center>




<center>
    <!--    <div id="cabecera" align="center" style="width: 100%;height: 10%; color: #000000;">-->
    <div id="cabecera" align="center" style="width: 100%;height: 50px; color: #000000;">

        <fieldset style="margin:1px;width:30%;height:100%;padding: 0px; font-size:14px;background-color: #dff1ff">
            <legend style="font-size:medium " >Buscar Areas con Coordinador:</legend>
            <div style="font-size: 11px;">
            </div>
            <div align="center">
                <table style="width: 100%" align="center">
                    <tr>
<!--                        <td><div id="divFilter" style="width: 100%;font-size: medium">Nombre del Area : <input id="txtNombreAreaAbuscar" name="txtNombreAreaAbuscar" type="text" size="30" onkeypress="buscarAreaModCoordinadoresTurnos('filter')"/></div></td>-->
                        <td><div id="divFilter" style="width: 100%;font-size: medium">Nombre del Area : <input id="txtNombreAreaAbuscar" name="txtNombreAreaAbuscar" type="text" size="30" onkeyup="buscarAreaModCoordinadoresTurnos();"/></div>
                        </td>

                        <td align="center">

                            &nbsp;&nbsp;
                        </td>
                        <!-- fin                       -->



                        <?php
                        if (isset($_SESSION["permiso_formulario_servicio"][235]["BUSQUEDA_ARBOL_AREAS_CON_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BUSQUEDA_ARBOL_AREAS_CON_COORDINADOR"] == 1)) {


                            echo "<td align=center>
                                    <a href=\"javascript:PopPupArbolAreasConCoordinador('conCordi');\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/folder.png\" width=30px height=25px/></a>
                                     </td>
                                    ";
                        } else {

                            echo "
                                    <td align=center>
                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/folder.png\" width=30px height=25px/>
                                    
                                     </td>
                                    ";
                        }
                        ?>                 


                        <!--BUSQUEDA_ARBOL_AREAS_SIN_COORDINADOR-->



                        <!--inicio-->
<!--                        <td align="center">

                            <a href="javascript:PopPupArbolAreasConCoordinador('conCordi');"><img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/folder.png" width="30px" height="25px"/></a>



                        </td>-->



                    </tr>
                </table>

            </div> 
        </fieldset>


        </td>

    </div>
</center>



<center>
    <!--      <div id="cabecera" align="center" style="width: 70%;height: 30%; color: #000000;">-->
    <div id="cabecera" align="center" style="width: 70%;height: 300px; color: #000000;">

        <table border="0" align="center" style="width: 100%;height: 100%">

            <tr>

                <td>

                    <div  id ="divCabecera1" style="width:100%; height:5%;background-color: #D6E9FE; ">
                        <center> <h1 >&Aacute;reas con Coordinadores Asignados </h1></center>
                    </div>

                </td>
            </tr>
            <tr>


                <td>
                    <div id="Div_listadoTodosCordinadores" align="center" style="width:100%; height:95%;"></div>
                </td>
            </tr>
        </table>

    </div>     
</center>


<center>
    <div id="cabecera" align="center" style="width: 70%;height: 10px; color: #000000;">

    </div>     

</center>




<center>
    <!--     <div id="cabecera" align="center" style="width: 100%;height: 10%; color: #000000;">-->
    <div id="cabecera" align="center" style="width: 100%;height: 50px; color: #000000;">


        <!--        <fieldset style="margin:1px;width:auto;height:auto;padding: 0px; font-size:14px">-->
        <fieldset style="margin:1px;width:30%;height:100%;padding: 0px; font-size:14px;background-color: #dff1ff">
            <legend style="font-size:medium ">Buscar Areas sin Coordinador:</legend>
            <div style="font-size: 11px;">
            </div>
            <div align="center">
                <table style="width: 100%" align="center">
                    <tr>
<!--                        <td><div id="divFilter" style="width: 100%;font-size: medium">Nombre del Area : <input id="txtNombreAreaAbuscar2" name="txtNombreAreaAbuscar2" type="text" size="30" onkeypress="buscarAreaModSinCoordinadoresTurnos('filter')"/></div></td>-->
                        <td><div id="divFilter" style="width: 100%;font-size: medium">Nombre del Area : <input id="txtNombreAreaAbuscar2" name="txtNombreAreaAbuscar2" type="text" size="30" onkeyup="buscarAreaModSinCoordinadoresTurnos();"/></div>

                        </td>

                        <td align="center">
                            &nbsp;&nbsp;
                        </td>

                        <!--                        inicio-->

                        <?php
                        if (isset($_SESSION["permiso_formulario_servicio"][235]["BUSQUEDA_ARBOL_AREAS_CON_COORDINADOR"]) && ($_SESSION["permiso_formulario_servicio"][235]["BUSQUEDA_ARBOL_AREAS_CON_COORDINADOR"] == 1)) {


                            echo "<td align=center>
                                    <a href=\"javascript:PopPupArbolAreasConCoordinador('sinCordi');\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/folder.png\" width=30px height=25px/></a>
                                     </td>
                                    ";
                        } else {

                            echo "
                                    <td align=center>
                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/folder.png\" width=30px height=25px/>
                                    
                                     </td>
                                    ";
                        }
                        ?>   






                        <!--                       fin -->
<!--                        <td align="center">

                            <a href="javascript:PopPupArbolAreasConCoordinador('sinCordi');"><img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/folder.png" width="30px" height="25px"/></a>
                        </td>-->


                    </tr>
                </table>

            </div> 
        </fieldset>





        </td>


    </div>
</center>


<!--      <div id="cabecera" align="center" style="width: 70%;height: 30%; color: #000000;">-->
<center>
    <div id="cabecera" align="center" style="width: 50%;height: 300px; color: #000000;">

        <table border="0" align="center" style="width: 100%;height: 100%">

            <tr>

                <td>

                    <div  id ="divCabecera2" style="width:100%; height:10%;background-color: #D6E9FE; color: #0000FF">
                        <center> <h1 >&Aacute;reas sin Coordinador Asignado </h1></center>
                    </div>

                </td>
            </tr>
            <tr>


                <td>
                    <div id="Div_listadoTodasAreasSinCoordinador" align="center" style="width:600px; height:90%;"></div>
                </td>
            </tr>
        </table>

    </div>     
</center>
