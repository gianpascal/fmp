<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
$toolbar4 = new ToollBar();
?> 
<form action="" id="vista_CancelarSesion" name="vista_CancelarSesion" method="get" >
    <center><div style="width: 910px; height: 550px;">
            <div style="float:left ; width: 425px; height: 550px;">
                <div id="divIzquierda" style=" float:center ; width: 870px; height: 520px;background-color: #FFFFFF;">
                    <br>
                    <br>
                    <div>
                        <br>
                        <fieldset style="margin:1px;width:700px;height: 140px;padding: 0px; font-size:1.2em;">
                            <br>
                            <legend>CANCELACION SESION POR USUARIO</legend>
                            <div style="float:left">
                                <div>
                                    <span class="blue negrita"> NOMBRE: </span>
                                    <input id="txtnombreCancelar" type="text" onkeyup="" size="50" name="nombre_formulario_perfil">
                                </div>
                            </div>

                            <div>
                                <?php
                                $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Usuario", "btn", "onclick,onkeypress", "podpadbuscarUsuariosCancelarSesion()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>  
                            </div>
                            <hr/>
                            <br>
                            <div id="divboton" style="float:center; width: 100px; height: 100px">
                                <?php
                                $toolbar2->SetBoton("cancelarSesionIndividual", "Cancelar Sesion del Usuario", "btn", "onclick,onkeypress", "ConfirmacionCancelarSesionIndividual()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar2->Mostrar();
                                ?>  
                            </div>  
                        </fieldset>
                    </div>
                    <div><br>
                        <br>
                        <fieldset style="margin:1px;width:400px;height: 100px;padding: 0px; font-size:1.2em;">
                            <br>
                            <legend>CANCELACION SESION POR PERFIL</legend>

                            <div id="divboton" style="float:center; width: 100px; height: 100px">
                                <?php
                                $toolbar3->SetBoton("cancelarSesion", "Cancelar Sesion por Perfil", "btn", "onclick,onkeypress", "podpadseleccionarPerfilCancelarSesion()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar3->Mostrar();
                                ?>      
                            </div>
                        </fieldset>
                    </div>

                    <br>
                    <div><br>
                        <fieldset style="margin:1px;width:400px;height: 100px;padding: 0px; font-size:1.2em;">
                            <br>
                            <legend>CANCELACION SESION TODOS LOS USUARIOS</legend>
                            <div id="divboton" style="float:center; width: 100px; height: 100px">
                                <?php
                                $toolbar4->SetBoton("cancelarSesionTodos", "Cancelar Sesion Todos Usuarios ", "btn", "onclick,onkeypress", "ConfirmacionCancelarSesionTotal()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar4->Mostrar();
                                ?>  
                            </div>  
                        </fieldset>
                    </div>
                </div>
                <div style="float:left">
                    <input id="txtestado" type="hidden" onkeyup="" size="20" name="estado">
                </div>

                <div style="float:left">
                    <input id="txtc_cod_per" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtidusuario" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtidInt" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtidSession" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                </fieldset>
            </div> 

    </center>
    <br>
</form>