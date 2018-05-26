<?php
$cboMeses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$fecha = getdate(time());
$mes = $fecha['mon'];
$anio = $fecha['year'];
$anioInicial = $anio - 1;
$anioFinal = $anio + 2;
$mes = date("m");
$anio = date("Y");
//echo 'el mes es ' . $mes . 'fin';
$iCodEmpCoordinador = $_SESSION['iCodigoEmpleado'];
//echo $iCodEmpCoordinador;
?>
<h1 style="color: #C5302C"></h1>
<input id="hidPuestoEmpleadoPorArea" type="hidden" />
<input id="hidEmpresaSedearea" type="hidden">
<input id="hidPreProgramacionPersonal" type="hidden">
<input id="hidPuestoEmpleadoPorAreaProgramado" type="hidden">
<input id="hidannoActual" type="hidden" value="<?php echo $anio ?>">
<input id="hidMes" type="hidden" value="<?php echo $mes ?>">


<div style="width:100%;height:5%;background: white">
    <div class="titleform">
        <h1>ASIGNACION &nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;EMPLEADOS&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;AREAS</h1>
    </div>
</div>
<!--
20-->
<div id="cabecera" align="center" style="width: 100%;height: 13%">
    <div id="cabecera"  align="center" style=" width:50%;height: 100%">

        <fieldset style="width:100%;height:32%; font-size:1.2em;background-color: #D6E9FE">
            <legend>Nombre del Coordinador</legend>


            <div id='fila1' style="height:100%; width:100%; color: #000000; border: 0px solid #87A57E;">

                <b><?php echo $arrayNombreCoordinador[0][0] ?></b>

            </div>
        </fieldset>
        <!--        <div id="cabecera"  align="center" style=" width:100%;height: 1% ">josecito
        
                </div>-->
        <!-- #D6E9FE-->
        <!--        inherit   3     0    -->
        <fieldset  style="width:100%;height:48%; font-size:1em;background-color: #D6E9FE">
            <legend>Seleccione: Sede, Mes, A&ntilde;o :</legend>
            <div id='fila1' style="height:10%; width:100%; color: #000000; border: 0px solid #87A57E;">
                <!--height: 0.2%;-->
                <!--background-color: #D6E9FE"-->
                <table style="width:100%; border:0">   

                    <tr  align="center">
                        <td> &nbsp;&nbsp;
                        </td>
                        <td>
                            <h4> SEDE:</h4>
                        </td>
                        <td >&nbsp;&nbsp;
                        </td>
                        <td>
                            <select name="cboSede" id="cboSede" style="width: 100px;" onchange ="CargarPersonaArea()">
                                <option value="x">  <?php echo 'TODOS' ?> </option>
                                <?php foreach ($arraySede as $i => $val) { ?>
                                    <option value="<?php echo $val[1] ?> " >  <?php echo $val[0] ?> </option>

                                <?php } ?>
                            </select>
                        </td>

                        <td > &nbsp;&nbsp;
                        </td>

                        <td>
                            <h4> AÑO:</h4>
                        </td>

                        <td > &nbsp;&nbsp;
                        </td>

<!--                        <td class="Estilo6" width="30%">-->
                        <td>    
<!--                            <select name="cboAnio" id="cboAnio" style="width: 80px;" onchange="mostrarContenidoProgramacionAsistencial()">-->
                            <select name="cboAnio" id="cboAnio" style="width: 80px;" onchange="">

                                <option value="">Seleccionar</option>
                                <?php for ($i = $anioInicial; $i < $anioFinal; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if ($anio == $i)
                                    echo "selected"; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                            </select>
                        </td>

                        <td > &nbsp;&nbsp;
                        </td>

                        <td>
                            <h4> MES:</h4>
                        </td>
                        <td > &nbsp;&nbsp;
                        </td>
                        <td>
<!--                            <select name="cboMes" id="cboMes" style="width: 80px;" onchange="mostrarContenidoProgramacionAsistencial()">-->
                            <select name="cboMes" id="cboMes" style="width: 80px;" onchange="">

                                <option value="">Seleccionar</option>
                                <?php foreach ($cboMeses as $i => $value) { ?>
                                    <option value="<?php echo $i + 1; ?>" <?php if ($mes + 1 == $i + 1)
                                    echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php } ?>
                            </select>
                        </td>  
                        <td>  &nbsp;&nbsp;
                        </td>

<!--                        <td>
    <input id="txtNombreAreaAbuscar" name="txtNombreAreaAbuscar" type="text" size="20" onkeyup="buscarAreaModCoordinadoresTurnos();"/>
<a href="javascript:buscarCoordinadoresPopap(document.getElementById('apellidoPaterno').value,document.getElementById('apellidoMaterno').value,document.getElementById('nombres').value);"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
<a href="javascript:replicarPreProgramación();"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/nbtn_buscar.gif"/></a>
</td>-->

                        <td align="center">
                            <!--                            inicio-->

                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][226]["REPLICAR_PREPROGRAMADOS_AL_SGTE_MES"]) && ($_SESSION["permiso_formulario_servicio"][226]["REPLICAR_PREPROGRAMADOS_AL_SGTE_MES"] == 1)) {


                                echo "<a href=\"javascript:replicarPreProgramación();\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/copia.jpg\" width=45px height=30px/></a>
            
                                    ";
                            } else {

                                echo "
                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/copia.jpg\" width=45px height=30px/>
            
                                    ";
                            }
                            ?>






                            <!--                            fin-->

<!--                            <a href="javascript:replicarPreProgramación();"><img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/copia.jpg" width="45px" height="30px"/></a>-->







                        </td>

                        <td>
                            <h4>AL MES SIGUIENTE: &nbsp;&nbsp;</h4>
                        </td>

                        <td> 
                        </td>



                    </tr>
                </table>
            </div>   
        </fieldset>



    </div>


</div>

<!--border="1"-->
<table width="100%" border="0"  align="center">
    <tr  align="center" >
        <td  align="center">
            <div align="center" ><h1 align="center">&Aacute;reas</h1></div>

        </td>
    </tr>
    <tr  align="center">
        <td  align="center">
            <div id="Div_TablaAreas" style="width:530px; height:180px;"  align="center"></div>

        </td>
    </tr>
</table>
<!--border="1"-->
<div align="center">
    <table border="0" align="center" >
        <tr>
            <td align="center" style="height:100%; width:45%">
                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabeceraArea" style="width:100%; height:100%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >Empleados asignados a áreas </h1>
                            </div>

                        </td>


                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_TablaEmpleadosArea" align="center" style="width:400px; height:130px;"></div>
                        </td>
                    </tr>
                </table>
            </td>

            <td style="height:100%; width:10%;">
                <table>

<!--                    <tr align="center">-->

                    <tr align=center>  
                        <td align=center style="width:180px; height:50px;">




                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][226]["ASIGNAR_PRE_PROGRAMACION"]) && ($_SESSION["permiso_formulario_servicio"][226]["ASIGNAR_PRE_PROGRAMACION"] == 1)) {


                                echo "
                                <a href=\"javascript:javascript:asignarPreProgramacion();\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_adelante.gif\" width=25px height=25px/></a>
                             ";
                            } else {

                                echo "
                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_adelante.gif\" width=25px height=25px/>
                        
                                    ";
                            }
                            ?>

                        </td>
                    </tr> 






                    <!--                    intermedio-->


                    <tr align=center>  
                        <td align=center style="width:180px; height:50px;">




                            <?php
                            if (isset($_SESSION["permiso_formulario_servicio"][226]["QUITAR_PRE_PROGRAMACION"]) && ($_SESSION["permiso_formulario_servicio"][226]["QUITAR_PRE_PROGRAMACION"] == 1)) {


                                echo "
                                <a href=\"javascript:javascript:quitarPreProgramacion();\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_atras.gif\" width=25px height=25px/></a>
                             ";
                            } else {

                                echo "
                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_atras.gif\" width=25px height=25px/>
                        
                                    ";
                            }
                            ?>

                        </td>
                    </tr> 



















                    <?php
//                    if (isset($_SESSION["permiso_formulario_servicio"][235]["QUITAR_PRE_PROGRAMACION"]) && ($_SESSION["permiso_formulario_servicio"][235]["QUITAR_PRE_PROGRAMACION"] == 1)) {
//
//
//                        echo "<tr align=center>
//                                <td align=center style=width:180px; height:50px;>
//                                    <a href=\"javascript:javascript:quitarPreProgramacion();\"><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_atras.gif\" width=25px height=25px/></a>
//                                  </td>
//                                  </tr>
//                                    ";
//                    } else {
//
//                        echo "<tr align=center>
//                                    <td align=center>
//                                    <img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/b_atras.gif\" width=25px height=25px/>
//                                    
//                                   
//                                                                       
//                                   </td>
//                                   </tr>
//                                    ";
//                    }
                    ?>
















<!--//                        <td  align="center" style="width:180px; height:50px;">
//
//                            <a href="javascript:asignarPreProgramacion();"> <img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/b_adelante.gif" width="25px" height="25px"/></a>
//
//                        </td>
//                        
//                        
//                        
//                        
//                        
//                        
//                    </tr>-->






<!--                    <tr align="center" style="width:180px; height:50px;">
    <td align="center">

        <a href="javascript:quitarPreProgramacion();"><img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/b_atras.gif" width="25px" height="25px"/></a>
    </td>
</tr>-->






                </table>
            </td>
            <td align="center" style="height:100%; width:45%;">
                <table border="1" align="center">
                    <tr align="center">
                        <td>
                            <div id="divCabeceraPreProgramados"style="width:100%; height:100%;background-color: #D6E9FE; color: #770088">
                                <h1>Empleados Pre-Programados</h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_TablaEmpleadosProgramados" align="center" style="width:400px; height:130px;"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<div style="height:3%; width:100%; color: #000000; border: 0px solid #87A57E;"></div>
<center>

    <div style=" color: #F0F8FF; ">


        <?php
        if (isset($_SESSION["permiso_formulario_servicio"][226]["LISTAR_EMPLEADOS_PREPROGRAMADOS"]) && ($_SESSION["permiso_formulario_servicio"][226]["LISTAR_EMPLEADOS_PREPROGRAMADOS"] == 1)) {


            echo "<a href=\"javascript:ListarEmpleadosPreProgramados();\">Refrescar<img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/clean_big.png\" width=40px height=40px/></a>
            
                                    ";
        } else {

            echo "
                                    <center><img  id=\"imgagenGuardar\" src=\"../../../../fastmedical_front/imagen/icono/clean_big.png\" width=40px height=40px/></center>
            
                                    ";
        }
        ?>



<!--        <a href="javascript:ListarEmpleadosPreProgramados();">Refrescar<img  id="imgagenGuardar" src="../../../../fastmedical_front/imagen/icono/clean_big.png" width="40px" height="40px"/></a>-->




    </div>

    <!--    <fieldset  style="width:50%;height:5%; font-size:1.4em">
    
    
    
    
    
    
    
    
    
    
            <div  id ="divCabeceraEmpleadoTotalProgramadosSedes1" style="width:100%; height:100%;background-color: #D6E9FE;  color: #000000;">
                <h1>Lista de Pre Programados - Todas las Sedes </h1>
            </div>
    
    
        </fieldset>-->

</center>




<!--<table border="1">-->

<!--    <div align="center">-->

<center>
<!--    <table border="0">-->
    <table border="1">
        <tr align="center">
            <td>
                <div  id ="divCabeceraEmpleadoTotalProgramadosSedes" style="width:100%; height:100%;background-color: #D6E9FE;  color: #000000;">
                    <h1>Lista de Pre Programados - Todas las Sedes </h1>
                </div> 

            </td>

        </tr>

        <tr align="center">
            <td>
                <div id="Div_TablaEmpleadoTotalProgramados" align="center" style="width:600px; height:200px;"></div>
            </td>
        </tr>
    </table>
</center>

<!--    </div>-->
<!--</table>-->
