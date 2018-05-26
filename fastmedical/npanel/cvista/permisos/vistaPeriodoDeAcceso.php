<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
$toolbar4 = new ToollBar();
?> 
<form action="" id="vista_CancelarSesion" name="vista_CancelarSesion" method="get" >
    <center><div style="width: 910px; height: 550px;">
            <div style="float:left ; width: 425px; height: 550px;">
                <div id="div_datosPuesto" style=" float:center ; width: 870px; height: 520px;background-color: #FFFFFF;">
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
                                    <input id="txtnombreclonado" type="text" onkeyup="" size="50" name="nombre_formulario_perfil">
                                </div>
                            </div>

                            <div>
                                <?php
                                $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Usuario", "btn", "onclick,onkeypress", "podpadbuscarUsuariosClonarUsuario()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar1->Mostrar();
                                ?>  
                            </div>
                      
                            <br>
<!--                            <div style="float:left">
                                <div>
                                    <span class="blue negrita"> FECHA A CADUCAR: </span>
                                    <td><input type="text"  onfocus="estadoCambioFechasConsultaLaboratorio('0')" maxlength="10"  onclick="calendarioHtmlx('txtFechaIni')" size="20" id="txtFechaIni" name="txtFechaIni"></td>
                                </div>
                            </div>-->
                            <div id="divboton" style="float:center; width: 100px; height: 100px">
                               <?php
                                $toolbar2->SetBoton("CaducarSesion", "Caducar Sesion", "btn", "onclick,onkeypress", "caducarSesion()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/kopeteavailable.png", "", "", 1);
                                $toolbar2->Mostrar();
                                ?> 
                            </div>  
                        </fieldset>
                    </div>

                </div>
                <div style="float:left">
                    <input id="txtPersona" type="hidden" onkeyup="" size="20" name="estado">
                </div>

                <div style="float:left">
                    <input id="txtcodigoPerOriginal" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtnombreclonado" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtCodigo" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                <div style="float:left">
                    <input id="txtNombre_clonado" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                </div>
                </fieldset>
            </div> 

    </center>
    <br>
</form>