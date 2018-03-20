
<div id="toolbar" style="height: 70px; ">
    <div style="width: 100%; height: 30px; ">
        <div style="width: 50px; float: left; " id="divEtiquetaTipoContratos">
            Sede:
        </div>
        <div style=" float: left;" id="DivSelectTipoContrato">
            <select id="cboSede" name="cboSede" style="width: 110px;" onchange="cargarArbolHMLORegularizar(1)">
                
                <?php foreach ($comboSucursal as $i => $value) { ?>
                    <option value="<?php echo $comboSucursal[$i][0] ?>"><?php echo utf8_encode($comboSucursal[$i][14]) ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div style="width: 100%; height: 30px; ">
        <div style="width: 50px; float: left;" id="divEtiquetaSueldo">
            Area:
        </div>
        <div style="float: left;" id="DivTextSueldo">
            <input onKeyPress="if(event.keyCode==13)busquedaarbolAreaRRHH();" type="text"   style="width:150px;" value="<?php //echo $nSueldo;  ?>" id="txtSueldo" name="txtSueldo"/>
        </div>
    </div>
</div>
<div id="toolbar" style="height:350px;  ">
    <div id="divArbolAreasSedes" style="height:350px;  ">

    </div>
</div>
