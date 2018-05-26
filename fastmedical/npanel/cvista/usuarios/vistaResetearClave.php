<?php
$toolbar1 = new ToollBar();
$toolbar3 = new ToollBar();
?> 
<form action="" id="vista_ResetearClave" name="vista_ResetearClave" method="get" >
    <center><div style="width: 910px; height: 550px;">
            <div style="float:left ; width: 425px; height: 550px;">
                <div id="divIzquierda" style=" float:center ; width: 870px; height: 520px;background-color: #A9D0F5;">
                    <p></p><div style="float:left">
                        <br>
                        <span class="blue negrita">INGRESAR USUARIO: </span>
                        <input id="txtNombre_clonado" type="text" onkeyup="" size="20" name="nombre_formulario_perfil">
                    </div>
                    <br>
                    <div>
                        <?php
                        $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Usuario", "btn", "onclick,onkeypress", "podpadbuscarUsuariosClonarUsuario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                        $toolbar1->Mostrar();
                        ?>  
                    </div>
                    <br>
                    <fieldset style="margin:1px;width:730px;height: 390px;padding: 0px; font-size:1.2em;">
                        <br>
                        <div style="float:left">
                            <span class="blue negrita">NOMBRE: </span>
                            <input id="txtnombreclonado" type="text" onkeyup="" size="50" name="nombre_formulario_perfil">
                        </div>
                        <div style="float:left">
                            <input id="txtcodigoPerOriginal" type="hidden" onkeyup="" size="20" name="codigoPerOriginal">
                        </div>
                        <br></br>
                        <div style="float:left">
                            <input id="txtCodigo" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                        </div>
                        <div style="float:left">
                            <input id="txtPersona" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                        </div>
                        <br></br>
                        <!-- pone la tabla dentro del cuadro-->
                        <div id="div_datosPuesto" style="float:center ; width: 580px; height: 250px;background-color: #A9D0F5;">  
                        </div>
                    </fieldset>
                </div> 
            </div> 
            <br>
            <div id="divboton" style="float:center; width: 100px; height: 100px">
                <?php
                $toolbar3->SetBoton("ResetearClave", "Resetear clave", "btn", "onclick,onkeypress", "ConfirmacionResetearclave()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                $toolbar3->Mostrar();
                ?>  
            </div>  
    </center>
    <br>
</form>
