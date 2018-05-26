<div id="Div_UbicacionPlaca" style="width:100%;float: left">
    <div id="Div_UbicacionPlacaEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_UbicacionPlacaCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td >
                    <h1>Ubicacion Placa</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_UbicacionPlacaCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>
    <div id="Div_UbicacionPlacaCuerpo" style="width:100%;display:block;border-style: solid;border-width: 0px">
        <?php
        $datos['iCodigoProgramacion'] = $datos['codigoProgramacion'];
        require_once("../../clogica/LCita.php");
        $o_LCita = new LCita();
        $arrayDatos = $o_LCita->lDatosNumeroPlaca($datos);
        $arrayUbicaciones = $o_LCita->lUbicacionesImagenes();
        $arrayHistorialUbicaciones = $o_LCita->lHistorialUbicacionesImagenes($datos);
        $contador = count($arrayHistorialUbicaciones);
        ?>
        <center><div style="height: 100px;width:1000px;">
            <div class="toolbar" style="height: 80px;width:520px; float: left;">
                <table style="float: left;">
                    <tr>
                        <td>
                            Nro de Placa
                        </td>
                        <td>
                            <input id="inputNroPlaca" type="text" readonly="true" name="" value="<?php echo $arrayDatos[0]['vNumero'] ?>"  style="float:left;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Observacion
                        </td>
                        <td>
                            <textarea  id="textAreaObservacion" name="" disabled="true" rows="2" cols="20" style="width: 200px; height: 40px;" ><?php echo $arrayDatos[0]['vObservacion'] ?></textarea>
                        </td>
                    </tr>
                </table>
                <table style="float: left;margin-left: 50px;">
                    <tr>
                        <td>
                            usuario
                        </td>
                        <td>
                            <input readonly="true" name="" value="<?php echo $arrayDatos[0]['vUsuario'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Host   
                        </td>
                        <td>
                            <input readonly="true" name="" value="<?php echo $arrayDatos[0]['vHost'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            fecha    
                        </td>
                        <td>
                            <input readonly="true" type="text" name="" value="<?php echo $arrayDatos[0]['fecha'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hora     
                        </td>
                        <td>
                            <input readonly="true" type="text" name="" value="<?php echo $arrayDatos[0]['hora'] ?>" /> 
                        </td>
                    </tr>
                </table>
            </div>
            <div class="toolbar" style="height: 80px;width:430px; float: left  ">
                <table style="float: left;">
                    <tr>
                        <td>
                            Ubicación
                        </td>
                        <td>
                            <?php
                            foreach ($arrayUbicaciones as $key => $value) {
                                if (utf8_encode($arrayHistorialUbicaciones[$contador - 1]['iIdUbicacionesImagenes']) == $value[0]) {
                                    ?>
                                    <input readonly="true" style="width: 150px;"  type="text" name="" value="<?php echo utf8_encode($value[1]); ?>" />
                                    <?php
                                }
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Observación   
                        </td>
                        <td>
                            <textarea disabled="true"  name="" rows="2" cols="20" style="width: 120px; height: 40px;" ><?php echo utf8_encode($arrayHistorialUbicaciones[$contador - 1]['vObservaciones']); ?></textarea>    
                        </td>
                    </tr>
                </table>
                <table style="float: left;margin-left: 50px;">
                    <tr>
                        <td>
                            usuario
                        </td>
                        <td>
                            <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($arrayHistorialUbicaciones[$contador - 1]['vUsuario']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Host   
                        </td>
                        <td>
                            <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($arrayHistorialUbicaciones[$contador - 1]['vHost']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            fecha    
                        </td>
                        <td>
                            <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($arrayHistorialUbicaciones[$contador - 1]['fecha']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hora     
                        </td>
                        <td>
                            <input style="width: 60px;"  readonly="true" type="text" name="" value="<?php echo utf8_encode($arrayHistorialUbicaciones[$contador - 1]['hora']); ?>" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </center>
    </div>
</div>

