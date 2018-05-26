<form name="frmBusqueda"  action="">
   <!--<input name="textfield3" type="hidden" id="hiddenFuncion" size="40" value="<?php echo $funcion ?>"   />-->
    <div style="width: 96%;height:35%" >
        <div style="width:100%" align="center">
            <div style="width: 100%;float:left;" align="center">
                <table width="100%" align="center">
                    <tr align="center"><td>A.paterno:</td><td><input class="textPatronNombre" name="textPatronAPaterno" type="text" id="txtApellidoPaterno" onkeypress="if(event.keyCode==13)getMedicosdhtmlx(event,this);"/></td></tr>
                    <tr align="center"><td>A.Materno:</td><td><input class="textPatronNombre" name="textPatronAMaterno" type="text" id="txtApellidoMaterno" onkeypress="if(event.keyCode==13)getMedicosdhtmlx(event,this);"/></td></tr>
                    <tr align="center"><td>Nombres:</td><td><input class="textPatronNombre" name="textPatronNombres" type="text" id="txtNombres" onkeypress="if(event.keyCode==13)getMedicosdhtmlx(event,this);"/></td></tr>
                    <tr align="center"><td colspan="2" nowrap="nowrap" scope="row" align="center"><a href="#" onclick="getMedicosdhtmlx(event,this);"><img alt="" src="../../../../fastmedical_front/imagen/btn/b_buscar_off.gif" /></a></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div id="divResultadoBusquedaMedicos" style="width:94%; height:45%; border: 1px solid #CCCCCC;">
       
    </div>
<!--<input type="hidden"  name="hOpcBusquedaPersona" id="hOpcBusquedaPersona" value="1"/>-->
</form>
