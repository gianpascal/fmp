<form name="frmBusqueda"  action="">
    <input name="textfield3" type="hidden" id="hiddenFuncion" size="40" value="<?php echo $funcion ?>"   />
    <div style="width: 96%;height:80px ; float:left" >
        <div style="width:100% ; float:left" align="center">
            <div style="width: 100%;float:left;" align="center">
                <table width="90%" align="center">
                    <tr align="center"><td style="font-family: Arial;font-size: 12px;font-weight: bold">A.paterno:</td><td><input class="textPatronNombre" name="textPatronAPaterno" type="text" size="7" id="txtApellidoPaterno" size="3" onkeypress="if (event.keyCode == 13)
                                getMedicos('01',this,event);"/></td></tr>
                    <tr align="center"><td style="font-family: Arial;font-size: 12px;font-weight: bold">A.Materno:</td><td><input class="textPatronNombre" name="textPatronAMaterno" type="text" id="txtApellidoMaterno" onkeypress="if (event.keyCode == 13)
                                getMedicos('01',this,event);"/></td></tr>
                    <tr align="center"><td style="font-family: Arial;font-size: 12px;font-weight: bold">Nombres:</td><td><input class="textPatronNombre" name="textPatronNombres" type="text" id="txtNombres" onkeypress="if (event.keyCode == 13)
                                getMedicos('01',this,event);"/></td></tr>
                    
                </table>

            </div>


        </div>       
    </div>
    <div id="divResultadoBusquedaMedicos" style="width: 295px; height:130px; border: 0px solid #CCCCCC; overflow: auto; float:left">
        <?php echo $obtenerMedicos; ?>
    </div>

    <input type="hidden"  name="hOpcBusquedaPersona" id="hOpcBusquedaPersona" value="1"/>
</form>
