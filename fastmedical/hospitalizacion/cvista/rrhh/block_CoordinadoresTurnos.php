<?php
//$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
//$fecha = getdate(time());
//$mes = $fecha['mon'];
//$anio = $fecha['year'];
//$anioInicial = $anio - 1;
//$anioFinal = $anio + 2;
//$mes = date("m");
//$anio = date("Y");
//echo 'el mes es ' . $mes;
$iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];
echo 'El Cod. del Coordinador: ' . $iCodEmpCoordinador . '<br>';
echo 'El Nombre del Coordinador: ' . $arrayNombreCoordinador[0][0];
?>


<div style="width:100%;height:5%;background: white">
    <div class="titleform">
        <h1>Coordinadores &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;Turnos&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;AREAS</h1>
    </div>
</div>


<div id="cabecera" align="center" style="width: 100%;height: 11%">
    <div id="cabecera"  align="center" style=" width:50%;height: 100%">
        <!--100%-->
        <fieldset style="width:90%;height:34%; font-size:1.2em;background-color: #D6E9FE">
            <legend>Nombre del Super Coordinador</legend>


            <div id='fila1' style="height:100%; width:100%; color: #000000; border: 0px solid #87A57E;">

                <b><?php echo $arrayNombreCoordinador[0][0] ?></b>

            </div>
        </fieldset>


        <fieldset  style="width:50%;height:66%; font-size:1.4em;background-color: #D6E9FE">
            <legend style="font-size:large ">Seleccione: Sede :</legend>
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

</div>

<div id="cabecera" align="center" style="width: 100%;height: 26%; color: #000000;">

    <table border="1" align="center" style="width: 100%;height: 100%">
        <tr>
            <td align="center" style="height:100%; width:47%">


                <!--                <fieldset  style="width:80%;height:60%; font-size:1.4em;background-color: #D6E9FE">   
                                    <legend style="font-size:large ">Buscador por Area:</legend>    
                                    <table border="1">
                                        <div style="height: 100px; width: 70%; " id="toolbar ">
                
                                            <form>
                
                <?php
                echo $comboTipoDocumentos;
                ?>
                                                </select>
                                        </div>
                                        
                                        <div style="width: 20%; float: left;" id="divEtiquetaNroDoc">
                                            Area:
                                        </div>
                                        <div style="width: 30%; float: left;" id="DivTextDoc">
                                            <input type="text" size="12" value="Buscar..."
                                                   onkeypress="limpiaBusquedas('03',this,event);"
                                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                                        </div>
                
                
                                        <div style="width: 100%; height: 25%;">
                
                                            <div style="width: 20%; float: left;font-size: medium" id="divEtiquetaNombre">
                                                Nombre:
                                            </div>
                                            <div style="width: 30%; float: left;" id="DivtextNombre">
                                                <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                                            </div>
                
                
                                            <div  id ="divEtiquetaBuscar" style=" float:left;width:16%;" align="center">
                                                <a href="javascript:ListadoFiltradoAreas(document.getElementById('nombres').value);"><img id="imgbusqueda" border="0"  title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
                                            </div>
                
                
                
                
                                            <div  id ="divEtiquetaLimpiar" style=" float:left;width:16%;" align="center">
                                                <a href="javascript:limpiaBusquedas('0','','');"><img border="0" title="Limpia" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>
                                            </div>    
                                        </div>
                
                                     
                                    </table>
                
                                </fieldset> -->



<!--
                <div align="center">
                    <table width="450" align="center">
                        <tr>
                            <td><div id="divFilter" style="display: none; width: 100%">Nombre del Area : <input id="txtNombreArea" name="txtNombreArea" type="text" size="30" onkeypress="buscarArea('filter')"/></div></td>
                            <td width="100">
                                <?php
                                if (isset($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"]) && ($_SESSION["permiso_formulario_servicio"][218]["NUEVA_AREA"] == 1)) {
                                    $toolbar00->SetBoton("NuevaArea", "Nueva Area", "btn", "onclick,onkeypress", "nuevoDatosArea()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/filenew.png", "", "", 1);
                                    $toolbar00->Mostrar();
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <div id="divTablaAreaCont" style="display: none;">
                        <fieldset style="margin:1px;width:94%;height:auto;padding: 0px; font-size:14px;">
                            <legend>&nbsp; Lista de &Aacute;reas &nbsp;</legend>
                            <div id="divTablaArea" style="width: 450px; height: 180px;" align="center">
                            </div>
                        </fieldset>
                    </div>
                </div>-->




            </td>

<!--            <td align="center" style="height:100%; width:6%">
                espacio



            </td>

            <td align="center" style="height:100%; width:47%">


                <fieldset  style="width:80%;height:60%; font-size:1.4em;background-color: #D6E9FE">   
                    <legend style="font-size:large ">Buscador por Coordinador:</legend>    
                    <table border="1">
                        <div style="height: 100px; width: 70%; " id="toolbar ">

                            <form>


                                <div style="width: 100%; height: 25%;background: #D6E9FE">

                                    <div style="width: 20%; float: left;font-size: medium" id="divEtiquetaApePat">
                                        Ape. Pat:
                                    </div>
                                    <div style="width: 30%; float: left;" id="DivtextApePat">
                                        <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                                    </div>
                                    <div style="width: 20%; float: left;" id="divEtiquetaApeMat">
                                        Ape. Mat:
                                    </div>
                                    <div style="width: 30%; float: left;font-size: medium" id="DivTextapeMat">
                                        <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                                    </div>
                                </div>


                                <div style="width: 100%; height: 25%;">

                                    <div style="width: 20%; float: left;font-size: medium" id="divEtiquetaNombre">
                                        Nombre:
                                    </div>
                                    <div style="width: 30%; float: left;" id="DivtextNombre">
                                        <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                                    </div>


                                    <div  id ="divEtiquetaBuscar" style=" float:left;width:16%;" align="center">
                                        <a href="javascript:buscarEmpleados(document.getElementById('txtCodigo').value,document.getElementById('comboTipoEstados').value,document.getElementById('comboTipoDocumentos').value,document.getElementById('nroDoc').value,document.getElementById('apellidoPaterno').value,document.getElementById('apellidoMaterno').value,document.getElementById('nombres').value);"><img id="imgbusqueda" border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
                                    </div>
                                    <div  id ="divEtiquetaLimpiar" style=" float:left;width:16%;" align="center">
                                        <a href="javascript:limpiaBusquedas('0','','');"><img border="0" title="Limpia" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>
                                    </div>    
                                </div>

                            </form>
                        </div>
                    </table>

                </fieldset> 




            </td>-->


        </tr>
    </table>
</div>

<div id="cabecera" align="center" style="width: 100%;height: 8%; color: #000000;">
    TITULO CENTRAL
</div>

<div id="cabecera" align="center" style="width: 100%;height: 50%; color: #000000;">

    <table border="1" align="center" style="width: 100%;height: 100%">
        //////
        <tr>
            <td align="center" style="height:45%; width:45%">

                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabecera1" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >&Aacute;reas con Coordinadores Asignados </h1>
                            </div>

                        </td>


                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_listadoTodosCordinadores" align="center" style="width:600px; height:300px;"></div>
                        </td>
                    </tr>
                </table>


            </td>


        </tr>

        <tr>

            <td align="center" style="height:10%; width:10%">
                space
            </td>

        </tr>

        <tr>


            <td align="center" style="height:45%; width:45%">

                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabecera2" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >&Aacute;reas sin Coordinador Asignado </h1>
                            </div>

                        </td>


                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_listadoTodasAreasSinCoordinador" align="center" style="width:520px; height:300px;"></div>
                        </td>
                    </tr>
                </table>



            </td>

        </tr>


    </table>
</div>


<!--************************************************************************************

<div id="cabecera" align="center" style="width: 100%;height: 10%; color: #000000;">
    <table border="1" align="center" style="width: 100%;height: 100%">
    <table width="100%" border="0"  align="center">


        <tr  align="center" >
            <td  align="center">
                <div align="center" ><h1 align="center">&Aacute;reas con Coordinadores Asignados</h1></div>

            </td>
        </tr>

        <tr  align="center">
            <td  align="center">
                <div id="Div_listadoTodosCordinadores" style="width:820px; height:100px;"  align="center"></div>

            </td>
        </tr>
        1111



        22222
        <tr  align="center" >
            <td  align="center">
                <div align="center" ><h1 align="center">&Aacute;reas sin Coordinador Asignado</h1></div>

            </td>
        </tr>

        <tr  align="center">
            <td  align="center">
                <div id="Div_listadoTodasAreasSinCoordinador" style="width:820px; height:100px;"  align="center"></div>

            </td>
        </tr>


        222222
        <tr  align="center" >
            <td  align="center">
                <div align="center" ><h1 align="center">Filtrado por Area</h1></div>

            </td>
        </tr>

        <tr  align="center">
            <td  align="center">
                <div id="Div_BusquedaxArea" style="width:820px; height:500px; "  align="center"></div>

            </td>
        </tr>


        <tr  align="center" >
            <td  align="center">
                <div align="center" ><h1 align="center">Filtrado por Coordinador</h1></div>

            </td>
        </tr>
        <tr  align="center">
            <td  align="center">
                <div id="Div_BusquedaxCoordinador" style="width:820px; height:500px;"  align="center"></div>

            </td>
        </tr>


    </table>
</DIV>
************************************************************************************-->