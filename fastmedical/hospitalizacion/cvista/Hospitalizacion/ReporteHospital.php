<DIV id="div_demo" style="OVERFLOW: scroll; WIDTH: 1220px; HEIGHT: 450px; BACKGROUND-COLOR:#DBDBDB">
    <!--    <fieldset  style="margin:auto;width:auto;height:auto; "> -->
    <table id="tblHospitalizacion" border="0" style="width: 1200px ; height: 10px ; font-family:  Arial; font-size: 12px;font-weight: bold " cellspacing="1">
        <thead class="jclmTbHtml">
            <tr>

                <th hidden="">CodigoHosipitalizacion--0</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Hora Ingreso</th>
                <th>Paciente</th>
                <th>Edad</th>
                <th>Medico Tratante</th>
                <th style='width:0px;'>Medico Alta</th>
                <th>Ambiente Fisico</th>
                <th>Cama</th>
                <th hidden="">Cod Amb logic</th>
                <th colspan="2">Destino</th>
                <th colspan="3">Accion</th>
                <th hidden="">Codigo Destino--16</th>
                <th hidden="">Sexo--17</th>
                <th hidden="">id Persona Pac--18</th>
                <th hidden="">id Paciente--19</th>
                <th hidden="">DiagEntrada--20</th>
                <th hidden="">DiagSalida--21</th>
                <th hidden="">DNI--22</th>
                <th hidden="">cod Amb Fisico--23</th>
                <th hidden="">CodigoHospitalizacio siguiente</th>
                <th hidden="">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $i => $value) {

//               $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar"; 

                if ($value[15] == 1) {
                    $class = "jclmTbEstadoPen";
                }
                if ($value[15] == 2) {
                    $class = "jclmTbEstadoHospi";
                }
                if ($value[15] == 3) {
                    $class = "jclmTbEstadoTranfExte";
                }
                if ($value[15] == 4) {
                    $class = "jclmTbEstadoTranfInter";
                }
                if ($value[15] == 5) {
                    $class = "jclmTbEstadoAlta";
                }
                ?>
                <tr class="<?php echo $class; ?>">

                    <td hidden=""><?php echo $value[0]; ?></td>
                    <td><?php echo $value[17] ?></td>
                    <td><?php echo $value[18] ?></td>
                    <td ><?php echo $value[16]; ?></td>
                    <td style="width: 190px"><?php echo htmlentities($value[2]); ?></td>
                    <td ><?php echo htmlentities($value[3]); ?></td>
                    <td style="width: 190px"><?php echo htmlentities($value[4]); ?></td>
                    <td style="width: 190px"><?php echo trim(htmlentities(trim($value[5]))); ?></td>

                    <td style='width:60px;'>
                        <?php foreach ($value[22] as $m => $valuem) { ?>
                            <?php echo $valuem[1]; ?>
                        <?php } ?> 
                    </td>
                    <td>

                        <select name="" id="comboCama[<?php echo $i; ?>]" disabled="">
                            <?php foreach ($value[20] as $n => $valuen) { ?>
                                <option  <?php if ($value[7] == $valuen[0])
                            echo ' selected';
                                ?>
                                    value="<?php echo $valuen[0]; ?>">
                                <?php echo $valuen[1]; ?>
                                </option>                                                 
    <?php } ?> 
                        </select>

                    </td>
        <!--                                                <td >< ?php echo htmlentities($value[7]); ?></td>-->
                    <td hidden=""><?php echo htmlentities($value[9]); ?></td>
                    <td >
    <!--                        <table>
                            <tr>
                                <td>-->
                        <select name="" id="comboDestino[<?php echo $i; ?>]" disabled="" style="width: 100px; ">
                            <option>Seleccionar Destino</option>
                            <?php foreach ($value[21] as $a => $valuea) { ?>
                                <option value="<?php echo $valuea[0]; ?>"
                                        <?php if ($value[10] == $valuea[0])
                                            echo ' selected';
                                        ?>>
                                <?php echo $valuea[1]; ?>
                                </option>                                                 
    <?php } ?> 
                        </select>
                        <!--                                </td>-->
                                <!--                            <td>
                                                            <input id="txtfiliacion" name="txtfiliacion" type="text"  style="border: 0 ; "/>
                                                        </td>-->
                        <!--                            </tr>
                                                </table>-->

                    </td>
                    <td></td>

                    <td id="Editar[<?php echo $i; ?>]">
                        <a href="javascript:EditaHospitalizacion(<?php echo $i; ?>);">
                            <img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/icono/editar.png"/></a>                                              
                    </td>
                    <td id="Guardar[<?php echo $i; ?>]" style="display: none">
                        <a href="javascript:GuardarHospitalizacion(<?php echo $i; ?>);">
                            <img border="0" title="Guardar" alt="" src="../../../../fastmedical_front/imagen/icono/adicionar.png"/></a>                                              
                    </td>
                    <td>
                        <a href="javascript:BorrarHospitalizacion(<?php echo $i; ?>);">
                            <img border="0" title="Eliminar" alt="" src="../../../../fastmedical_front/imagen/icono/borrar.png"/></a>
        <!--                            <img border="0" src="../../../../fastmedical_front/imagen/icono/editar.png" title=" Editar"></img>-->
                    </td>
                    <td>
                        <a href="javascript:VistaDetallePaciente(<?php echo $i; ?>);">
                            <img border="0" title="Visualizar Paciente" alt="" src="../../../../fastmedical_front/imagen/icono/b_ver_on.gif"/></a>
        <!--                            <img border="0" src="../../../../fastmedical_front/imagen/icono/editar.png" title=" Editar"></img>-->
                    </td>
                    <td hidden=""><?php echo $value[10]; ?></td>
                    <td hidden=""><?php echo $value[11]; ?></td>
                    <td hidden=""><?php echo $value[13]; ?></td>
                    <td hidden=""><?php echo $value[12]; ?></td>
                    <td hidden=""><?php echo $value[14]; ?></td>
                    <td hidden=""><?php echo $value[15]; ?></td>
                    <td hidden=""></td>
                    <td hidden=""><?php echo $value[8]; ?></td>
                    <td hidden=""><?php echo $value[19]; ?></td>
                    <td hidden=""><?php echo $value[15]; ?></td>
                </tr>
<?php } ?> 


        </tbody>
    </table>
    <!--    </fieldset > -->
</div>

<div align="center">
    <table align="center">  

        <tr>
            <td>

            </td>
        </tr>
        <tr>
            <td><br><br><br><br>
                <?php
                $toolbar3 = new ToollBar("left");
                $toolbar3->SetBoton("", "Nuevo", "btn", "onclick,onkeypress", "NuevoPaciente()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/edit2.png");
                $toolbar3->Mostrar();
                ?> </td>
            <td><br><br><br><br>

                <a href="javascript:ExpotarExcelHospitalizacion();">     
                    <img border="0" title="Exportar a Excel" alt="" src="../../../../fastmedical_front/imagen/btn/b_exportarexcel_on.gif"/></a> 

            </td>
            <td><br><br><br><br>

                <?php
                $toolbar3 = new ToollBar("left");
                $toolbar3->SetBoton("", "Imprimir", "btn", "onclick,onkeypress", "refrescarTablaPaciente()", $_SESSION['path_principal'] . "../fastmedical_front/imagen/icono/imprimir.png");
                $toolbar3->Mostrar();
                ?>                  

            </td

        </tr>
    </table>
</div>


<div align="center">
    <table  align="center" width="30%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" height="20%">
        <thead>
            <tr align="center">
                <th colspan="2" style="background:#00CED1" width="40%"><font style="font-size: smaller">LEYENDA</font></th>

            </tr>
            <tr align="center" style="font-weight:bold;background:#AFEEEE">
                <th width="15%"><font style="font-size: smaller">Color</font></th>  
                <th width="40%"><font style="font-size: smaller">Estado</font></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td  width="15%" align="center" style="background:#00FA9A;" >IIIIIIII</td>
                <td width="40%"><?php echo $estadosHospitalizacion[0][1] ?></td>
            </tr>
            <tr  >
                <td width="15%" align="center" style="background:#66CDAA;">IIIIIIII</td>
                <td width="40%"><?php echo $estadosHospitalizacion[1][1] ?></td>
            </tr>
            <tr>
                <td width="15%" align="center" style="background:#8FBC8F;" >IIIIIIII</td>
                <td width="40%"><?php echo $estadosHospitalizacion[2][1] ?></td>
            </tr>
            <tr> 
                <td width="15%" align="center" style="background:#20B2AA;">IIIIIIII</td>
                <td width="40%"><?php echo $estadosHospitalizacion[3][1] ?></td>
            </tr>
            <tr>
                <td width="15%" align="center" style="background:#8FBC8F;">IIIIIIII</td> 
                <td width="40%"><?php echo $estadosHospitalizacion[4][1] ?></td>
            </tr>

        </tbody>
    </table>
</div>