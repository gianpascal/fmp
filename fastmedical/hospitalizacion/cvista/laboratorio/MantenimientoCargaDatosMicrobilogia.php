<style>
    .cuboxlsUno{
        float:left;
        margin: 2.5px;
        border:2px solid green;
        background-color: green;
        width: 315px;
        height: 98px;
    }
    .cuboxlsUno:hover{
        cursor:pointer;
    }
    .capaUno{
        color:white;
    }
    .capaUno:hover{
        cursor:pointer;
    }
    .cuboxlsDos{
        float:left;
        margin: 2.5px;
        border:2px solid red;
        background-color: red;
        width: 315px;
        height: 98px;
    }
    .cuboxlsDos:hover{
        cursor:pointer;
    }
    .capaDos{
        color:white;
    }
    .capaDos:hover{
        cursor:pointer;
    }


    .cuboxlsTres{
        float:left;
        margin: 2.5px;
        border:2px solid blue;
        background-color: blue;
        width: 315px;
        height: 98px;
    }
    .cuboxlsTres:hover{
        cursor:pointer;
    }
    .capaTres{
        color:white;
    }
    .capaTres:hover{
        cursor:pointer;
    }
    .titulito
    {
        width: 100%;
        height: 5%;
        font-size:22px;
    }
    .imagenOpcion{
        width:60px;
        border-radius: 100%;
    }
    .imagenOpcion:hover{
        background-color: greenyellow
    }
</style>

<?php
switch ($iOpcion) {
    case 1:

        function listar_ficheros($carpeta) {
            require_once("ActionLaboratorio.php");
            $o_ActionLaboratorio = new ActionLaboratorio();
            $resultadoComparativo = $o_ActionLaboratorio->comparaExistentesBaseDatosConDirectorio();
            if (is_dir($carpeta)) {
                $scanarray = scandir($carpeta);
                // print_r($resultadoComparativo);
                for ($i = 0; $i < count($scanarray); $i++) {
                    if ($scanarray[$i] != "." && $scanarray[$i] != "..") {
                        if (is_file($carpeta . "/" . $scanarray[$i])) {
                            $thepath = pathinfo($carpeta . "/" . $scanarray[$i]);
                            if ($thepath['extension'] == 'xls' || $thepath['extension'] == 'xlsx') {
                                for ($array = 0; $array <= count($resultadoComparativo) - 1; $array++) {
                                    if ($resultadoComparativo[$array][1] == $scanarray[$i]) {
                                        if (date("Y-m-d H:i:s", filemtime($carpeta . "/" . $scanarray[$i])) == $resultadoComparativo[$array][2]) {
                                            // echo date("Y-m-d H:i:s", fileatime($carpeta . "/" . $scanarray[$i])) . ' - ' . $resultadoComparativo[$array][2] . '<br>';
                                            $class1 = "cuboxlsUno";
                                            $class2 = "capaUno";
                                            $color = "green";
                                        } else if (date("Y-m-d H:i:s", filemtime($carpeta . "/" . $scanarray[$i])) != $resultadoComparativo[$array][2]) {
                                            $class1 = "cuboxlsDos";
                                            $class2 = "capaDos";
                                            $color = "red";
                                        }
                                        $array = count($resultadoComparativo) - 1;
                                    } else {
                                        $class1 = "cuboxlsTres";
                                        $class2 = "capaTres";
                                        $color = "blue";
                                    }
                                }
                                ?>
                                <div class="<?php echo $class1; ?>" title="Seleccionar" onClick="SeleccionarArchivo('<?php echo $scanarray[$i]; ?>','<?php echo date("Y-m-d H:i:s", filemtime($carpeta . "/" . $scanarray[$i])); ?>','<?php echo date("Y-m-d H:i:s", fileatime($carpeta . "/" . $scanarray[$i])); ?>','<?php echo $color; ?>');">
                                    <table border="0">
                                        <tr>
                                            <td valign="middle" width="25">
                                                <a title="Abrir Archivo Excel" href="<?php echo '../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo/' . $scanarray[$i] ?>"><img src="../../../../medifacil_front/imagen/icono/grid.png" style="width:25px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td>
                                                <table class="<?php echo $class2; ?>" title="Datos del Archivo">
                                                    <tr title="Nombre">
                                                        <td><b>Archivo:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo $scanarray[$i]; ?></td>
                                                    </tr>
                                                    <tr title="Extencion">
                                                        <td><b>Extencion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo $thepath['extension']; ?></td>
                                                    </tr>
                                                    <tr title="Tamaño">
                                                        <td><b>Tamaño:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo formato_tam(filesize($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                    <tr title="Fecha Creacion">
                                                        <td><b>Fecha Creacion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo date("Y-m-d H:i:s", filemtime($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                    <tr title="Fecha Modificacion">
                                                        <td><b>Fecha Modificacion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo date("Y-m-d H:i:s", fileatime($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                    }
                }
            } else {
                echo "La ruta no se encuentra...";
            }
        }

        function formato_tam($size, $precision = 0) {
            $sizes = array('Tb', 'Gb', 'Mb', 'Kb', 'bytes');
            $total = count($sizes);
            while ($total-- && $size > 1024)
                $size /= 1024;
            return round($size, $precision) . " " . $sizes[$total];
        }
        ?>
        <div CLASS="titulito">
            <center>DATOS DE MICROBIOLOGIA</center>
        </div>
        <center>
            <div style="border:0px solid;width: 1000px;height: 80%;overflow-y: auto;">
                <?php
                echo listar_ficheros("../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo");
                ?>
            </div>
        </center>
        <div id="contenedorMantenimiento" style="float:bottom;border:0px solid;height:15%;background-color: green;display:none;">

        </div>

        <?php
        break;
    case 2:

        function listar_ficherosos($carpeta, $vArchivo, $dFechaCreacion, $dFechaModificacion) {
            if (is_dir($carpeta)) {
                $scanarray = scandir($carpeta);
                for ($i = 0; $i < count($scanarray); $i++) {
                    if ($scanarray[$i] != "." && $scanarray[$i] != "..") {
                        if (is_file($carpeta . "/" . $scanarray[$i])) {
                            $thepath = pathinfo($carpeta . "/" . $scanarray[$i]);
                            if ($thepath['extension'] == 'xls' || $thepath['extension'] == 'xlsx') {
                                if ($vArchivo == $scanarray[$i]) {
                                    ?>
                                    <table style="float:left">
                                        <tr>
                                            <td>
                                                <img src="../../../../medifacil_front/imagen/icono/grid.png" style="width:100px;">
                                            </td>
                                            <td>
                                                <table style="color:white;" title="Datos del Archivo">
                                                    <tr title="Nombre">
                                                        <td><b>Archivo:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo $scanarray[$i]; ?></td>
                                                    </tr>
                                                    <tr title="Extencion">
                                                        <td><b>Extencion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo $thepath['extension']; ?></td>
                                                    </tr>
                                                    <tr title="Tamaño">
                                                        <td><b>Tamaño:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo formato_tamanio(filesize($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                    <tr title="Fecha Creacion">
                                                        <td><b>Fecha Creacion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo date("Y-m-d H:i:s", filemtime($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                    <tr title="Fecha Modificacion">
                                                        <td><b>Fecha Modificacion:&nbsp;&nbsp;</b></td>
                                                        <td><?php echo date("Y-m-d H:i:s", fileatime($carpeta . "/" . $scanarray[$i])); ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="float:right">
                                        <table heigth="40">
                                            <tr>
                                                <td style="padding-top:25px;">
                                                    <a title="Subir Datos" href="javascript:aceptarArchivoGuardarDatosEnBaseDatos('<?php echo $vArchivo; ?>','<?php echo $dFechaCreacion; ?>','<?php echo $dFechaModificacion; ?>')"><img src="../../../../medifacil_front/imagen/icono/checked.png" class="imagenOpcion"  ></a>
                                                </td>
                                                <td style="padding-top:25px;">
                                                    <a title="Cancelar" href="javascript:cancelarSeleccionarXLS()">  <img src="../../../../medifacil_front/imagen/icono/nochecked.png" class="imagenOpcion"  ></a>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                }
            } else {
                echo "La ruta no se encuentra...";
            }
        }

        function formato_tamanio($size, $precision = 0) {
            $sizes = array('Tb', 'Gb', 'Mb', 'Kb', 'bytes');
            $total = count($sizes);
            while ($total-- && $size > 1024)
                $size /= 1024;
            return round($size, $precision) . " " . $sizes[$total];
        }
        ?>
        <?php
        echo listar_ficherosos("../../../../carpetaDocumentos/materialesLaboratorio/microBilogiaActivo", $vArchivo, $dFechaCreacion, $dFechaModificacion);
        ?>
        <?php
        break;
    case 3:


        break;
}

