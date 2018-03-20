<div id="divPuestosCCostos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
    <div class="titleform" style="text-align: center">
        <h2></h2>
    </div>
    <div id="divIzqPuestosCCostos" style=" float:left;width:38%;">
        <div id="divIzqInfPuestosCCostos" style=" width:100%;">
            <div style="height: 70px; width: 90%" id="toolbar">
                <input type="hidden" id="hCcosto" name="hCcosto" value="1"/>
                    <div style="width: 100%; height: 35%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaPuesto">
                            Puesto:
                        <div style="width: 80%; float: left;" id="DivTextPuesto">
                            <input type="text" size="30" value="" onkeypress="verPuestos('x',event,'mostrarFormularioDePerfil');" id="txtPuesto" name="txtPuesto"/>
                        </div>
                    </div>
                    <div style="width: 100%; height: 35%;">
                        <div style="width: 20%; float: left;" id="divEtiquetaNroOrden">
                            Categoria:
                        </div>
                        <div style="width: 80%; float: left;" id="DivSelectTipoDoc">
                            <select name="select" id="comboCategoriaPuestos" style="width:150px; font-size:9px">
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
                            <select name="select" id="comboEstados" style="width:60px; font-size:9px">
                                <option value="1">Todos</option>
                                <option value="2">Activos</option>
                                <option value="3">Inactivos</option>
                            </select>
                        </div>
                        <div style=" width: 30%; float: left; margin-left: 20px;" id="DivBuscar">
                            <a href="javascript:verPuestos('x','','mostrarFormularioDePerfil');"><img border="0" title="Codigo de Persona" alt="" src="../../../../medifacil_front/imagen/btn/nbtn_buscar.gif"/></a>
                        </div>
                    </div>
            </div>
            <div id="divOpcCCostos" style="float:left;width:99%; height: 310px;">
            </div>
        </div>
    </div>
    <div id="divDerPuestosCCostos" style="float:right;width:61%;">
        <div id="divDerSupPuestosCCostos" style="width:250%;" align="center">
            <fieldset style="margin:1px;width:98%;height:22px;padding: 0px; font-size:14px">
                <b>Resultados de la B&uacute;squeda de Puestos Laborales</b>
            </fieldset>
        </div>
        <div id="divResultadoPuestosCCostos" style=" height: 355px; width:250%; margin-left:2px; overflow: auto">
            <?php
                echo $tablaPuestos;
            ?>
        </div>
    </div>
</div>