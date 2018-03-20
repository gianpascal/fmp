<div id="divServiciosCCostos" style="width:99%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
    <div class="titleform" style="text-align: center">
        <h2></h2>
    </div>
    <div id="divIzqServiciosCCostos" style=" float:left;width:38%;height:100%">
        <!--<div id="divIzqInfServiciosCCostos" style=" width:100%;height:100%">-->
        <div style="height:10%; width:100%;">
            <input type="hidden" id="hdnCCosto" name="hdnCCosto" value="1"/>
            <!--<div style="width:100%;">-->
            <br/>
            <div style="width: 20%; float: left;" id="divLblServicio">
                <label>Servicio:</label>
            </div>
            <div style="width: 80%; float: left;" id="divTxtServicio">
                <input type="text" id="txtServicioPorActividadDeCCosto" name="txtServicioPorActividadDeCCosto" value="Buscar..." size="30" onkeypress="if(event.keyCode==13) buscarEnArbolCCostosActividadServicios();"
                       onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if (this.value=='') this.value=this.defaultValue;"/>
            </div>
            <!--</div>-->
        </div>
        <div id="divArbolCCostos" style="float:left; height:90%; width:99%;">
        </div>
        <!--</div>-->
    </div>
    <div id="divDerServiciosCCostos" style=" float:right;width:61%;height:100%">
        <div id="divDerSupServiciosCCostos" style=" width:99%; height:10%" align="center" >
            <br/>
            <fieldset style="margin:1px;width:98%;padding: 0px; font-size:14px">
                <b>Resultados de la B&uacute;squeda de Servicios</b>
            </fieldset>
        </div>
        <div id="divResultadoServiciosCCostos" style=" height:90%; width:99%; margin-left:2px;">
            <?php echo $tablaServicios;?>
        </div>
    </div>
</div>