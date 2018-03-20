
<h1 style="color: #C5302C"></h1>
<input id="hidPuestoEmpleadoPorArea" type="hidden" />
<input id="hidannoActual" type="hidden" value="<?php echo $anio ?>">



<div style="width:100%;height:5%;background: white">
    <div class="titleform">
        <h1>MANTENIMIENTITO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;EXAMENES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
    </div>
</div>


<!--buscador de examenes-->

<center>
<!--    <div id="cabecera" align="center" style="width: 40%;height: 15%">-->
        <table border="1" align="center" style="width: 40%;height: 15%">
            <tr>
                <td>
<!--                    <div id="cabecera"  align="center" style=" width:100%;height: 100%">-->
                        <fieldset style="width:100%;height:40%; font-size:1.2em;background-color: #D6E9FE">
                            <legend>Buscador de Examenes:</legend>
                            <input id="txtBuscadorExamenes" name="txtBuscadorExamenes" type="text" size="30" onkeyup="BuscadorExamenes();"/>
                        </fieldset>
<!--                    </div>-->
                </td>
            </tr>
<!--    </div>-->
</center>
<!--examenes-->

<div align="center">
    <table border="1" align="center" >
        <tr>
            <!--ini de la primera tabla-->          
            <td align="center" style="height:100%; width:45%">
                <table border="1" align="center">
                    <tr align="center">
                        <td>

                            <div  id ="divCabeceraExamenes" style="width:100%; height:10%;background-color: #D6E9FE; color: #0000FF">
                                <h1 >Lista de Examenes </h1>
                            </div>

                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <div id="Div_TablaListaExamenes" align="center" style="width:400px; height:130px;"></div>
                        </td>
                    </tr>
                </table>
            </td>
            <!--fin de la primera tabla-->
            <td align="center" style="height:100%; width:45%;">
                <table border="1" align="center">
                    <tr align="center">
                        <td>
                            <div id="divCabeceraPreProgramados"style="width:100%; height:10%;background-color: #D6E9FE; color: #770088">
                                <h1>Detalle por Examen</h1>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                    <div id="divFilter" style="width: 100%;font-size: medium">Nombre : <input id="txtNombreExamen" name="txtNombreExamen" type="text" size="30" onkeyup="buscarAreaModSinCoordinadoresTurnos();"/></div>
        </tr>
        <tr>
        <select name="cboTipoExamen" id="cboTipoExamen" style="width: 100px;" onchange ="">
            <option value="x">  <?php echo 'TODOS' ?> </option>
            <?php foreach ($arraySede as $i => $val) { ?>
                <option value="<?php echo $val[1] ?> " >  <?php echo $val[0] ?> </option>
            <?php } ?>
        </select>
        </tr>
        <tr align="center">
        <TEXTAREA COLS=10 ROWS=5 NAME="Texto"> 
        </TEXTAREA> 
        </tr>                     
        <tr align="center">
        <div id="divFilter" style="width: 100%;font-size: medium">Descripcion : <input id="txtNombreAreaAbuscar2" name="txtDescripcion" type="text" size="30" onkeyup="buscarAreaModSinCoordinadoresTurnos();"/></div>
        </tr>

    </table>
</td>
</tr>
</table>
</div>




