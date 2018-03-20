<?php
$toolbar1 = new ToollBar();
$toolbar2 = new ToollBar();
$toolbar3 = new ToollBar();
?> 
<form action="" id="vista_clonarPermisos" name="vista_clonarUsuarios" method="get" >
    <center><div style="width: 910px; height: 550px;">

            <div>  <img style="overflow:hidden;position:absolute;height:56;width:63;left:50%;top:50%;margin-top:-20px;margin-left:-30px; "src="../../../../medifacil_front/imagen/btn/fechaDerecha.jpg"></div>
  <!--            <div class="centrar-imagen" width="30" height="30"><img src="../../../../medifacil_front/imagen/btn/fechaDerecha.jpg"></div> 
            <img style="center:63px;width: 20px; height: 20px; vertical-align:middle;   -->


            <div style="float:left ; width: 425px; height: 550px;">
                <div id="divIzquierda" style=" float:left ; width: 410px; height: 530px;background-color: #A9D0F5;">
                    <p></p><div style="float:left">
                        <span class="blue negrita">USUARIO ORIGINAL: </span>
                        <input id="txtNombre_clonado" type="text" onkeyup="" size="25" name="nombre_formulario_perfil" value="Selecione Buscar Usuario" readonly/>
                    </div>
                    <div>
                        <?php
                        $toolbar1->SetBoton("BusquedaEmpleado", "Buscar Usuario", "btn", "onclick,onkeypress", "podpadbuscarUsuariosClonarUsuario()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                        $toolbar1->Mostrar();
                        ?>  
                    </div>

                    <fieldset style="margin:1px;width:390px;height: 450px;padding: 0px; font-size:1.2em;">
                        <br>
                        <div style="float:left">
                            <span class="blue negrita">NOMBRE: </span>
                            <input id="txtnombreclonado" type="text" onkeyup="" size="45" name="nombre_formulario_perfil" readonly/>
                        </div>
                        <div style="float:left">
                            <input id="txtcodigoPerOriginal" type="hidden" onkeyup="" size="30" name="codigoPerOriginal" readonly/>
                        </div>
                        <br></br>
                        <div style="float:left">
                            <span class="blue negrita">CODIGO: </span>
                            <input id="txtCodigo" type="text" onkeyup="" size="30" name="nombre_formulario_perfil" readonly/>
                        </div>
                        <br></br>
                        <!-- pone la tabla dentro del cuadro-->
                        <div id="div_datosPuesto" style="float:center ; width: 350px; height: 300px;background-color: #A9D0F5;">  
                        </div>
                    </fieldset>
                </div>
            </div> 

            <div style=" padding-left : 56px;float:right; width: 420px; height: 555px;">
<!--<div class="centrar-imagen" style="float:center ; width: 63px; height: 56px;" ><img src="../../../../medifacil_front/imagen/btn/fechaDerecha.jpg"></div>-->


                <div style="float:right; width: 425px; height:50px;">       
                    <div id="divDerecha" style="float:right; width: 410px; height: 530px;background-color: #A9D0F5;">
                        <p></p><div style="float:left">
                            <span class="blue negrita">USUARIO: </span>
                            <input id="txtNombre_copia" type="text" onkeyup="" size="25" name="Nombre_copia" value="Selecione Buscar Usuario" readonly/>
                        </div>
                        <div>
                            <?php
                            $toolbar2->SetBoton("UsuarioCopia", "Buscar Usuario", "btn", "onclick,onkeypress", "podpadbuscarUsuariosCopia()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                            $toolbar2->Mostrar();
                            ?>  
                        </div>
                        <fieldset style="margin:1px;width:390px;height: 450px;padding: 0px; font-size:1.2em;">
                            <br>
                            <div style="float:left">
                                <span class="blue negrita">NOMBRE: </span>
                                <input id="txtnombreCopia" type="text" onkeyup="" size="45" name="nombreCopia" readonly/>
                            </div>
                            <div style="float:left">
                                <input id="txtcodigoPerCopia" type="hidden" onkeyup="" size="30" name="codigoPerCopia" readonly/>
                            </div>
                            <br></br>
                            <div style="float:left">
                                <span class="blue negrita">CODIGO: </span>
                                <input id="txtCodigoCopia" type="text" onkeyup="" size="30" name="CodigoCopia" readonly/>
                            </div>
<!--                            este div le pertenece a la vista resetear contraseña, pero para que no salga null en el text se pone esto, pero en este form no es necesario(comparten los mismos procedimientos)-->
                            <div style="float:left">
                                <input id="txtPersona" type="hidden" onkeyup="" size="30" name="nombre_formulario_perfil">
                            </div>
                            <br></br>
                            <!-- pone la tabla dentro del cuadro-->
                            <div id="div_datosPuestoCopia" style="float:center ; width: 350px; height: 300px;background-color: #A9D0F5;">  
                            </div>
                        </fieldset>  
                    </div>
                </div>
            </div>
            <div id="divboton" style="float:center; width: 100px; height: 100px">
                <?php
                $toolbar3->SetBoton("ClonarPermisos", "Clonar Permisos", "btn", "onclick,onkeypress", "ConfirmacionClonar()", $_SESSION['path_principal'] . "../medifacil_front/imagen/icono/kopeteavailable.png", "", "", 1);
                $toolbar3->Mostrar();
                ?>  
            </div>


        </div> 

    </center>
    <br>
</form>