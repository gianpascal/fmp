<div style="width:880px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Busqueda de puestos por centro de costos</h1>
    </div>
    <div  id ="divPuestosCCostos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div  id ="divIzqPuestosCCostos" style=" float:left;width:38%;">

            <div  id ="divIzqInfPuestosCCostos" style=" width:100%;" >


                <div style="display: none;  height: 70px; width: 90%" id="toolbar">


                    <input type="hidden"   id="hCcosto" name="hCcosto" value="1"/>
                    <input type="hidden"   id="hfuncion" name="hfuncion" value="<?php echo $funcion; ?>"/>
                    <div style="width: 100%; height: 35%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaPuesto">
                            Puesto:
                        </div>
                        <div style="width: 80%; float: left;" id="DivTextPuesto">
                            <input type="text" size="30" value="" onkeypress="verPuestos('x',event);"  id="txtPuesto" name="txtPuesto"/>
                        </div>


                    </div>
                    <div style="width: 100%; height: 35%;">

                        <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                            Categoria:
                        </div>
                        <div style="width: 80%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboCategoriaPuestos" style="width:150px; font-size:9px" >
                                <?php

                                echo $comboHTML;
                                ?>
                            </select>

                        </div>

                    </div>


                    <div style="width: 100%; height: 30%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                            Estado:
                        </div>
                        <div style="width: 20%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboEstados" style="width:60px; font-size:9px" >
                                <option value="1">Todos</option>
                                <option value="2">Activos</option>
                                <option value="3">Inactivos</option>
                            </select>

                        </div>
                        <div style=" width: 30%; float: left; margin-left: 20px;" id="DivBuscar" >
                            <a href="javascript:verPuestos('x','','asignarPuestoEmpleado');"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>

                        </div>

                    </div>

                </div>
                <div style="width: 100%; height:30px;" align="center">
                    <input type="text" id="txtBusquedaArbolx" name="txtBusquedaArbolx" onkeypress="if(event.keyCode==13)busquedaArbol2();" /> <a onClick="busquedaArbol2()" style="cursor: pointer">Buscar</a>
                </div>
                <div  id ="divOpcCCostos" style=" float:left;width:99%; height:280px;">
                </div>
            </div>
        </div>
        <div  id ="divDerPuestosCCostos" style=" float:right;width:61%;">
            <div  id ="divDerSupPuestosCCostos" style=" width:99%;" align="center" >
                <fieldset style="margin:1px;width:98%;height:22px;padding: 0px; font-size:14px">
                    <b>Resultados de la Búsqueda de Puestos Laborales</b>
                </fieldset>
            </div>
            <div id="divResultadoPuestosCCostos" style=" height:300px; width:99%; margin-left:2px;">
                
            </div>

        </div>
    </div>
</div>