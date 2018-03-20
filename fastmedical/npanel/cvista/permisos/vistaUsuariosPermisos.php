<form action="" id="vista_usuario" name="form_vistaUsuario" method="get" >
    <center><div style="width: 900px; height: 550px;">
            <div style="float:left ; width: 435px; height: 550px;">
                <div id="divIzquierda" style="float:left ; width: 435px; height: 550px;">

                </div>
            </div>        
            <div style=" padding-left: 25px;float:left; width: 435px; height: 550px;">
                <div style="float:left; width: 435px; height:50px;">
                    <p style="float:left"> <input id="bEstado" type="checkbox" name="bEstado" onchange="listarUsuariosPermisos()" onclick="if(this.checked){this.value=1}else{this.value=0;}" checked=""> Con Permiso
                        <br>
                    <div id="divDerecha" style="float:left; width: 435px; height: 510px;background-color: #AEF9C7;">

                    </div>
                </div>

            </div>
    </center>
    <br>
    <input type="text" id="txtNumSinPermiso" name="txtNumSinPermiso" value="" style="display:none" >


</form>