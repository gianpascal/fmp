<html>
    <body>
        <fieldset style="margin:1px;width:99%;height:99%;padding: 0px; font-size:14px; background-color: #F4F4F4">
            <br/>
            <div style="width:50%;height:20px;float:left; margin-left: 25%; max-height: 25%">
                <input type="text" id="txtbuscarservicio" name="txtbuscarservicio" onKeyPress="if(event.keyCode==13)busquedaarbol();" /> <a onClick="busquedaarbol()">Buscar</a>
                <div  id ="divBusCronogramaArbol" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                </div>
            </div>
            <div  id ="divAsignarPadre" style=" float:left;width:98%;height:440px;">
            </div>
            <div style="width:20%;height:25px; float:left; margin-left: 40%; max-height: 40%">
                <?php
                $toolbar=new ToollBar("right");
                $toolbar->SetBoton("CERRAR","Cerrar","btn","onclick,onkeypress","cerrarPopap","../../../../medifacil_front/imagen/icono/cerrar1.gif","","",true);
                //$toolbar->SetBoton("VER","Ver Datos","btn","onclick,onkeypress","ventana_formulario_persona('setDatosContribuyente')","../../../../medifacil_front/imagen/icono/add_user.png","","",true);
                $toolbar->Mostrar();
                ?>
            </div>
        </fieldset>
    </body>
</html>