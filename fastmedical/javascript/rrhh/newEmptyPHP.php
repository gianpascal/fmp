<?php
$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$fecha = getdate(time());
$mes = $fecha['mon'];
$anio = $fecha['year'];
$anioInicial = $anio - 1;
$anioFinal = $anio + 2;
$mes = date("m");
$anio = date("Y");
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
        <!--        <div id="cabecera"  align="center" style=" width:100%;height: 1% ">josecito
        
                </div>-->
        <!-- #D6E9FE-->
        <!--        inherit   3     0    -->



        <!--primero-->

        <center>
            /////////////
            //////////////////


            <div align="center">
                <table border="1" align="center" >
                    <tr>
                        <td align="center" style="height:100%; width:45%">
                            df
<!--                            <table border="1" align="center">


                            </table>-->
                        </td>

                        <td align="center" style="height:100%; width:10%">
dfd


                        </td>
                        
                        <td align="center" style="height:100%; width:45%">

dfdf

                        </td>


                    </tr>
                </table>
            </div>


            /////////////////
            <table border="1" >
                <tr>
                    <td>a



                    </td>


                    <td>b</td>
                </tr>
            </table>      

        </center>  


        <!--        <fieldset  style="width:100%;height:32%; font-size:1em;background-color: #D6E9FE">
                    <legend>Buscador por Area:</legend>
                    <div id='fila1' style="height:8%; width:100%; color: #000000; border: 0px solid #87A57E;">
                        height: 0.2%;
                        background-color: #D6E9FE"
                        <table style="width:100%; border:0">   
        
                            <tr  align="center">
        
                                <td>
                                    <h4> Area a Buscarrrrrr:</h4>
                                </td>
                                <td >&nbsp;&nbsp;
                                </td>
        
                            </tr>
                        </table>
                    </div>   
                </fieldset>-->




    </div>


</div>



<!--primero-->

<center>

    <fieldset  style="width:50%;height:18%; font-size:1em;background-color: #D6E9FE">   
        <legend>Buscador por Area:</legend>    
        <table border="1">
            <div style="height: 100px; width: 70%; " id="toolbar ">

                <form>
                    <div style="width: 100%; height: 25%;background: #D6E9FE">
                        <div style="width: 20%; float: left;" id="divEtiquetaCodigo">
                            Código:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextCodigo">
                            <input type="text" size="12" value="Buscaaar..." onkeypress="limpiaBusquedas('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaEstado">
                            Estado:
                        </div>
                        <div style="width: 30%; float: left;" id="DivSelectEstado">
                            <select  style="width: 80px; font-size: 9px;" id="comboTipoEstados" name="selectE">
                                <option value="0000">Seleccionar</option>
                                <option  value="0001" >Todos</option>
                                <option selected="selected" value="0002" onclick="limpiaBusquedas('02');">Activos</option>
                                <option value="0003" onclick="limpiaBusquedas('02');">Inactivos</option>
                            </select>
                        </div>
                    </div>
                    <div style="width: 100%; height: 25%;">

                        <div style="width: 20%; float: left; " id="divEtiquetaTipoDoc">
                            Tipo Doc:
                        </div>
                        <div style="width: 30%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboTipoDocumentos" style="width:80px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                                <?php
                                echo $comboTipoDocumentos;
                                ?>
                            </select>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaNroDoc">
                            Nro Doc:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextDoc">
                            <input type="text" size="12" value="Buscar..."
                                   onkeypress="limpiaBusquedas('03',this,event);"
                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                        </div>
                    </div>


                    <div style="width: 100%; height: 25%;background: #D6E9FE">

                        <div style="width: 20%; float: left;" id="divEtiquetaApePat">
                            Ape. Pat:
                        </div>
                        <div style="width: 30%; float: left;" id="DivtextApePat">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaApeMat">
                            Ape. Mat:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextapeMat">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                        </div>
                    </div>


                    <div style="width: 100%; height: 25%;">

                        <div style="width: 20%; float: left;" id="divEtiquetaNombre">
                            Nombre:
                        </div>
                        <div style="width: 30%; float: left;" id="DivtextNombre">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                        </div>

                        <!--<div style="width: 16%; float: left;" id="DivLimpiar" align="center">
                                <a href="javascript:limpiaBusquedas('0');"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>
                        </div>-->
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

</center>





<!--prueba-->







<!--segundo-->

<center>

    <fieldset  style="width:50%;height:18%; font-size:1em;background-color: #D6E9FE">   
        <legend>Buscador por Coordinador:</legend>    
        <table border="1">
            <div style="height: 100px; width: 70%; " id="toolbar ">

                <form>
                    <div style="width: 100%; height: 25%;background: #D6E9FE">
                        <div style="width: 20%; float: left;" id="divEtiquetaCodigo">
                            Código:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextCodigo">
                            <input type="text" size="12" value="Buscaaar..." onkeypress="limpiaBusquedas('01',this,event);return validFormSalt('nro', this, event, 'imgbusqueda');" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" maxlength="7" id="txtCodigo" name="txtCodigo"/>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaEstado">
                            Estado:
                        </div>
                        <div style="width: 30%; float: left;" id="DivSelectEstado">
                            <select  style="width: 80px; font-size: 9px;" id="comboTipoEstados" name="selectE">
                                <option value="0000">Seleccionar</option>
                                <option  value="0001" >Todos</option>
                                <option selected="selected" value="0002" onclick="limpiaBusquedas('02');">Activos</option>
                                <option value="0003" onclick="limpiaBusquedas('02');">Inactivos</option>
                            </select>
                        </div>
                    </div>
                    <div style="width: 100%; height: 25%;">

                        <div style="width: 20%; float: left; " id="divEtiquetaTipoDoc">
                            Tipo Doc:
                        </div>
                        <div style="width: 30%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboTipoDocumentos" style="width:80px; font-size:9px" onchange="validaTxtNroDocBuscar();">
                                <?php
                                echo $comboTipoDocumentos;
                                ?>
                            </select>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaNroDoc">
                            Nro Doc:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextDoc">
                            <input type="text" size="12" value="Buscar..."
                                   onkeypress="limpiaBusquedas('03',this,event);"
                                   onblur="if (this.value=='') this.value=this.defaultValue;"
                                   onfocus="if (this.value==this.defaultValue) this.value='';" id="nroDoc" maxlength="8" name="txtDoc"/>
                        </div>
                    </div>


                    <div style="width: 100%; height: 25%;background: #D6E9FE">

                        <div style="width: 20%; float: left;" id="divEtiquetaApePat">
                            Ape. Pat:
                        </div>
                        <div style="width: 30%; float: left;" id="DivtextApePat">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoPaterno" name="textfield3"/>
                        </div>
                        <div style="width: 20%; float: left;" id="divEtiquetaApeMat">
                            Ape. Mat:
                        </div>
                        <div style="width: 30%; float: left;" id="DivTextapeMat">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="apellidoMaterno" name="textfield4"/>
                        </div>
                    </div>


                    <div style="width: 100%; height: 25%;">

                        <div style="width: 20%; float: left;" id="divEtiquetaNombre">
                            Nombre:
                        </div>
                        <div style="width: 30%; float: left;" id="DivtextNombre">
                            <input type="text" size="12" value="" onkeypress="limpiaBusquedas('04',this,event);" onblur="if (this.value=='') this.value=this.defaultValue;" onfocus="if (this.value==this.defaultValue) this.value='';" class="textPatronNombreBusqueda" id="nombres" name="textfield5"/>
                        </div>

                        <!--<div style="width: 16%; float: left;" id="DivLimpiar" align="center">
                                <a href="javascript:limpiaBusquedas('0');"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/btn_limpiar.gif"/></a>
                        </div>-->
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

</center>






















<!--prueba-->








<table width="100%" border="0"  align="center">
    <tr  align="center" >
        <td  align="center">
            <div align="center" ><h1 align="center">&Aacute;reas</h1></div>

        </td>
    </tr>
    <tr  align="center">
        <td  align="center">
            <div id="Div_listadoTodosCordinadores" style="width:700px; height:300px;"  align="center"></div>

        </td>
    </tr>
</table>