<!--<div style="width:1050px; margin:1px auto; border: #006600 solid">-->
<div style="width:1050px; margin:1px auto; border-color: #fffff solid ">
    <div class="titleform">
        <h1>Configuraci&oacute;n de Puestos Laborales por Centro de Costos</h1>
    </div>

    <div  id ="divPuestosCCostos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqPuestosCCostos" style=" float:left;width:38%;">
            <div  id ="divIzqInfPuestosCCostos" style=" width:100%;" >

                <!--background-color: #D6E9FE -->
                <div style="height: 70px; width: 90%;" id="toolbar">
                    <input type="hidden"   id="hCcosto" name="hCcosto" value="1"/>
                    <input type="hidden"   id="hIdCentroCosto" name="hIdCentroCosto" />
                    <input type="hidden"   id="hNombreCentroCostoClickeado" name="hNombreCentroCostoClickeado" />
                    <div style="width: 100%; height: 35%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaPuesto">
                            Puesto:
                        </div>
                        <div style="width: 80%; float: left;" id="DivTextPuesto">
<!--                            <input type="text" size="30" value="" onkeypress="verPuestos2010(document.getElementById('txtPuesto').value,document.getElementById('comboEstados').value);"  id="txtPuesto" name="txtPuesto"/>-->
<!--                        <input type="text" size="30" value="" onkeypress="verPuestos2012('x',event,'detallePuestoCentro');"  id="txtPuesto" name="txtPuesto"/>-->
                            <input type="text" size="30" value="" onkeyup="busquedaPuestoxCentroCostosFiltrado();"  id="txtPuesto" name="txtPuesto"/>
                        </div>
                    </div>
                    <!--                    <div style="width: 100%; height: 35%;">
                                            <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                                                Categoria:
                                            </div>
                                            <div style="width: 80%; float: left;" id="DivSelectTipoDoc">
                                                <select name="select" id="comboCategoriaPuestos" style="width:150px; font-size:9px" >
                    <?php
//                                echo $comboHTML;
                    ?>
                                                </select>
                                            </div>
                                        </div>-->
                    <div style="width: 100%; height: 30%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                            Estado:
                        </div>
                        <div style="width: 20%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboEstados" style="width:60px; font-size:9px" >
                                <option value="x">Todos</option>
                                <option value="1">Activos</option>
                                <option value="0">Inactivos</option>
                            </select>

                        </div>
                        <div style=" width: 30%; float: left; margin-left: 20px;" id="DivBuscar" >
<!--                            <a href="javascript:verPuestos('x','','detallePuestoCentro');"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>-->
                            <!--                            /inicio-->

                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][204]["BUSQUEDA_PUESTOS_FILTRADO"]) && ($_SESSION["permiso_formulario_servicio"][204]["BUSQUEDA_PUESTOS_FILTRADO"] == 1)) {


                                echo "
                                
                        <a href=\"javascript:BuscarPuestosxEstados(document.getElementById('txtPuesto').value,document.getElementById('comboEstados').value);\"><img border=0 title=\"Codigo de Persona\"  src=\"../../../../medifacil_front/imagen/btn/nbtn_buscar.gif\"/></a>
                       
                                    ";
                            } else {

                                echo "
                                <img border=0 title=\"Codigo de Persona\"  src=\"../../../../medifacil_front/imagen/btn/nbtn_buscar.gif\"/>
                                                     
                                    ";
                            }
                            ?>                 




<!--                            <a href="javascript:BuscarPuestosxEstados(document.getElementById('txtPuesto').value,document.getElementById('comboEstados').value);"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>-->



                        </div>
                    </div>
                </div>




                <!--                INICIO-->









                <!--                FIN-->





                <div style="width: 100%; height:30px;" align="center">


<!--                    <?php
//                    if (isset($_SESSION["permiso_formulario_servicio"][204]["BUSQUEDA_ARBOL_PUESTOS_CON_ENTER"]) && ($_SESSION["permiso_formulario_servicio"][235]["BUSQUEDA_ARBOL_PUESTOS_CON_ENTER"] == 1)) {
//
//                        $busquedaArbolPuestosconEnter = "if(event.keyCode==13)busquedaArbolPuestosEnCCostos();";
//                    } else {
//
//                        $busquedaArbolPuestosconEnter = "";
//                    }
                    ?>   -->



<!--                    <input type="text" id="txtBusquedaArbolx" name="txtBusquedaArbolx" onkeypress="if(event.keyCode==13)busquedaArbolPuestosEnCCostos();" />-->
                    <input type="text" id="txtBusquedaArbolx" name="txtBusquedaArbolx" onkeypress="if(event.keyCode==13)busquedaArbolPuestosEnCCostos();" />

                    
                        
                    
                    <a onClick= "busquedaArbolPuestosEnCCostos();" style="cursor: pointer">Buscar CCostos</a>




                </div>

                <div  id ="divOpcCCostos" style=" float:left;width:99%; height:600px;"></div>
            </div>
        </div>

        <!--background-color: #D6E9FE-->
        <div  id ="divDerPuestosCCostos" style=" float:right;width:61%;">
            <div id="toolbar" style=" margin-top:15px;height:40px">
                <div id="TituloListaPuestosDeCCostos" style="height:100%;">
                    <center><h1>Puestos del Centro de Costos:</h1></center>
                </div>
            </div>
            <div style="clear: both;height: 10px"></div>

            <div id="divResultadoPuestosCCostos" style=" height:300px; width:99%; margin-left:2px; overflow: auto;">
                <?Php
//                echo $tablaPuestos;
                ?>
            </div>

            <div style="clear: both;height: 10px"></div>



            <div id="toolbar" style=" margin-top:15px;background-color: #D6E9FE;height:32px;">
                <div id="botones" style="height:32px;">
                    <?php
                    if (isset($_SESSION["permiso_formulario_servicio"][204]["EDITAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["EDITAR_PUESTO_X_CCOSTO"] == 1)) {
                        //<a href="javascript:editarDetallePuesto();"><img id="imagenEditar" style=" display: none;" src="../../../../medifacil_front/imagen/btn/b_editar_on.gif"/></a>
                        echo "<a href=\"javascript:editarDetallePuesto();\"><img id=\"imagenEditar\" style=\" ;\" src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"/></a>";
                    } else {
                        echo "<img id=\"imagenEditar\" style=\" display: none;\" src=\"../../../../medifacil_front/imagen/btn/b_editar_on.gif\"/>";
                    }

                    if (isset($_SESSION["permiso_formulario_servicio"][204]["AGREGAR_PUESTO_X_CCOSTO"]) && ($_SESSION["permiso_formulario_servicio"][204]["AGREGAR_PUESTO_X_CCOSTO"] == 1)) {
                        //<a href="javascript:agregarDetallePuesto();"><img id="imagenAgregar" src="../../../../medifacil_front/imagen/btn/b_agregar_on.gif"/></a>
                        echo "<a href=\"javascript:agregarDetallePuesto();\"><img id=\"imagenAgregar\" src=\"../../../../medifacil_front/imagen/btn/b_agregar_on.gif\"/></a>";
                    } else {
                        echo "<img id=\"imagenAgregar\" src=\"../../../../medifacil_front/imagen/btn/b_agregar_on.gif\"/>";
                    }
                    ?>



                </div>
            </div>
            <!--            982818-->




            <div  id ="iddetallePuestosCCostos" style="width:100%;height:auto;display: none">
                <?php
                require_once("../../cvista/rrhh/vDetallePuesto.php");
                ?>
            </div>








            <!--            <div  id ="divDerSupPuestosCCostos" style=" width:99%;" align="center" >
                            <fieldset style="margin:1px;width:98%;height:auto;padding: 0px;">
                                <legend>&nbsp; Asignar Puesto a una Area &nbsp;</legend>
                                <table width="100%" cellpadding="3" cellspacing="3" align="center">
                                    <tr>
                                        <td height="40">Sede : </td>
                                        <td width="30%">
                                            <select name="cboSucursal" id="cboSucursal" style="width: 140px;" onchange="cboSedeEmpresaArea()">
                                                <option value="">Seleccionar</option>
            <?php foreach ($comboSucursal as $k => $value) { ?>
                                                                                                        <option value="<?php echo $comboSucursal[$k][0]; ?>"><?php echo $comboSucursal[$k][14]; ?></option>
            <?php } ?>
                                            </select>
                                        </td>
                                        <td width="20px"></td>
                                        <td>Area : </td>
                                        <td width="50%">
                                            <div id="divSedeEmpresaArea">
                                                <select name="cboSedeEmpresaArea" id="cboSedeEmpresaArea" style="width: 140px;">
                                                    <option value="">Seleccionar</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" align="center">
                                            <div id="divAsignarPuestoArea" align="center" style="width: 100px; display: none;" >
            <?php
            if (isset($_SESSION["permiso_formulario_servicio"][204]["ASIGNAR_PUESTO_AREA"]) && ($_SESSION["permiso_formulario_servicio"][204]["ASIGNAR_PUESTO_AREA"] == 1)) {
                $toolbarz = new ToollBar("left");
                $toolbarz->SetBoton("btnAsignarPuestoSedeArea", "Asignar Puesto Área", "btn", "onclick,onkeypress", "asignarPuestoSedeArea()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/button_ok.png", "", "", 1);
                $toolbarz->Mostrar();
            }
            ?>
                                            </div>
                                            <div id="divResultado" align="center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div id="divPuestoSedeArea" style="width: 100%; height: 150px; display: none"></div>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </div>-->



        </div>
    </div>
</div>

<!--
<input type="submit" value="Pulsar" onclick="cargarArbolCentroDeCostos()" />
prueba20-->

<!--<input type="submit" value="Pulsar" onclick="pruebaArbolito()" />-->

<!--<div id="arbolAreas" align="center" style="width: 25%;height: 660px; background: white;" >

</div>-->

<!--<input type="submit" value="Hacer Click aqui" onclick="prueba20121();" />-->