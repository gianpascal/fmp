<div style="width:1010px; height:950px; margin:1px auto; border: #006600 solid">
    <div class="titleform">
        <h1>Temas de ayuda</h1>
    </div>
    <div  id ="divManual" style="width:99%;height:95%;margin-left:0.5%;margin-right:0.2%;overflow: hidden;">
        <div style=" float:left;width:27%;height:550px;">
            <fieldset style="margin:1px;width:100%;height:550px;padding: 0px; font-size:14px">
                <br/>
                <div style="width:78%;height:20px; margin-left: 11%; max-height: 11%">
                    <input type="text" id="txtbuscarservicio" name="txtbuscarservicio" onkeypress="if(event.keyCode==13)busquedaarbol();" /> <a onClick="busquedaarbol()">Buscar</a>
                    <div  id ="divBusCronogramaArbol" style="width:97%;height:95%;margin-left:1%;margin-right:1%;overflow: hidden;">
                    </div>
                </div>
                <br/>
                <div  id ="divOpcAyuda" style=" float:left;width:98%;height:400px;">
                </div>
                <div id ="opciones" style=" float:left;width:98%;height:60px;">
                <br/>
                <fieldset style="margin-left: 10%; margin-right: 10%; width:80%;height:27px;padding: 0px; font-size:14px">
                    <div style="width: 80%; margin-top: 4px; margin-bottom: 4px; margin-left: 5px; margin-right: 5px;">
                        <div style="width: 15%; float: left; background-color: #7CC434;" id="divBotonActivo">
                            <a onclick="" href="javascript:manualesActivos();">
                                <img border="0" alt="" src="../../../../fastmedical_front/imagen/btn/btn_ArbolActivo.gif"/></a>
                        </div>
                        <div style="width: 15%; float: right; background-color: #7CC434;" id="divBotonTodo">
                            <a onclick="tree.enableThreeStateCheckboxes(-1); " href="javascript:manualesTodos();">

                                <img border="0" alt="" src="../../../../fastmedical_front/imagen/btn/btn_ArbolTodo.gif"/></a>
                        </div>
                    </div>
                </fieldset>
                </div>
                <br/>
                <div id ="botones" style=" float:left;width:98%;height:30px;">
                    <?php
                    $toolbar=new ToollBar("right");
                    $toolbar->SetBoton("NUEVO","Nuevo","btn","onclick,onkeypress","nuevoManual()","../../../../fastmedical_front/imagen/icono/nuevo.png","","",true);
                    //$toolbar->SetBoton("VER","Ver Datos","btn","onclick,onkeypress","ventana_formulario_persona('setDatosContribuyente')","../../../../fastmedical_front/imagen/icono/add_user.png","","",true);
                    $toolbar->Mostrar();
                    ?>
                </div>
            </fieldset>
        </div>

        <div  id ="divAyuda" style=" float:right;width:72%;height:805px;">
            <? echo 'Por favor, seleccione el tema de su interés en el menú de la izquierda.'?>
        </div>
    </div>
</div>
