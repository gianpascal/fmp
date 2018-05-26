<?php
$existe = 0;
if ($arrayDatos[0]['iIdHistoriaImagen'] > 0) {
    $existe = 1;
}

?>
<input type="hidden" id="hiIdHistorialImagen" value="<?php echo $arrayDatos[0]['iIdHistoriaImagen'] ?>" />
<div style="height: 90px;width:660px; margin: 0 auto;  ">
    <div class="toolbar" style="height:80px;width:640px; float: left; ">
        <div style="height: 20px;width:80px; margin: 0 auto; float: left">
            <b>Codigo</b>
        </div>
        <div style="height: 20px;width:120px; margin: 0 auto; float: left">
            <input readonly="true" style="width:70px;" value="<?php echo $arrayDatos[0]['c_cod_per'] ?>" />
        </div>
        <div style="height: 20px;width:80px; margin: 0 auto; float: left">
            <b><?php echo $arrayDatos[0]['vTipoDocumento'] ?></b>
        </div>
        <div style="height: 20px;width:330px; margin: 0 auto; float: left">
            <input readonly="true" style="width:100px;" value="<?php echo $arrayDatos[0]['vNumeroDocumento'] ?>" />
        </div>
        <div style="height: 20px;width:80px; margin: 0 auto; float: left">
            <b>Nombre</b>
        </div>
        <div style="height: 20px;width:500px; margin: 0 auto; float: left">
            <input readonly="true" style="width:500px;" value="<?php echo utf8_encode($arrayDatos[0]['vApellidoPaterno'] . ' ' . $arrayDatos[0]['vApellidoMaterno'] . ', ' . $arrayDatos[0]['vNombre']) ?>" />
        </div>
        <table class="tablaDiagnostico" border="0" style="margin: 0 auto;">
            <tr >
                <td bgcolor="#E8EEFD" ><b>Código</b> </td>
                <td bgcolor="#E8EEFD"> <b>Examen</b></td>
            </tr>

            <?php foreach ($arrayDatos as $key => $value) { ?>
                <tr>
                    <td> <?php echo $value['c_cod_ser_pro']; ?> </td>
                    <td><?php echo utf8_encode($value['v_desc_ser_pro']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<div style="height: 110px;width:660px; margin: 0 auto;  ">
    <div class="toolbar" style="height: 80px;width:340px; float: left">

        <div style="height: 30px;width:80px; margin: 0 auto; float: left" >
            Nro de Placa
        </div>
        <div style="height: 30px;width:260px; margin: 0 auto; float: left">
            <input <?php
            if ($existe == 1) {
                echo 'readonly="true"';
            }
            ?> id="inputNroPlaca" type="text" name="" value="<?php echo $arrayDatos[0]['vNumero'] ?>" />
        </div>
        <div style="height: 50px;width:80px; margin: 0 auto; float: left" >
            Observacion
        </div>
        <div style="height: 50px;width:260px; margin: 0 auto; float: left">
            <textarea <?php
                if ($existe == 1) {
                    echo 'disabled="true"';
                }
            ?>  id="textAreaObservacion" name="" rows="2" cols="20" style="width: 260px; height: 40px;" ><?php echo $arrayDatos[0]['vObservacion'] ?></textarea>
        </div>


    </div>
    <div class="toolbar" style="height: 80px;width:200px; float: left">
        <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
            usuario
        </div>
        <div style="height: 20px;width:100px; margin: 0 auto; float: left">
            <input readonly="true" name="" value="<?php echo $arrayDatos[0]['vUsuario'] ?>" />
        </div>
        <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
            Host
        </div>
        <div style="height: 20px;width:100px; margin: 0 auto; float: left">
            <input readonly="true" name="" value="<?php echo $arrayDatos[0]['vHost'] ?>" />
        </div>
        <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
            fecha
        </div>
        <div style="height: 20px;width:100px; margin: 0 auto; float: left">
            <input readonly="true" type="text" name="" value="<?php echo $arrayDatos[0]['fecha'] ?>" />
        </div>
        <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
            Hora
        </div>
        <div style="height: 20px;width:100px; margin: 0 auto; float: left">
            <input readonly="true" type="text" name="" value="<?php echo $arrayDatos[0]['hora'] ?>" />
        </div>
    </div>
    <div class="toolbar" style="height: 80px;width:65px;float: left">
        <div id="botonEditarPlaca" style="<?php
                if ($existe == 0) {
                    echo 'display:none;';
                }
            ?>">
            <a href="javascript:editarNumeroPlaca();">
                <img src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif"/>
            </a>

        </div>
        <div id="botonGrabarPlaca" style="<?php
             if ($existe == 1) {
                 echo 'display:none;';
             }
            ?>">
            <?php if ($_SESSION["permiso_formulario_servicio"][118]["guardarNroPlaca_citas"] == 1) { ?>
            <a href="javascript:guardarNroPlaca();">
                <img src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/>
            </a>
            <?php } ?>
        </div>
        <div id="botonCancelarGrabarPlaca" style="<?php
             if ($existe == 1) {
                 echo 'display:none;';
             }
            ?>">
            <?php if ($_SESSION["permiso_formulario_servicio"][118]["b_cancelar_on_Citas"] == 1) { ?>
            <a href="javascript:cancelarGuardarNroPlaca();">
                <img src="../../../../fastmedical_front/imagen/btn/b_cancelar_on.gif"/>
            </a>
              <?php } ?>
        </div>
    </div>
</div>

<?php foreach ($arrayHistorialUbicaciones as $key => $valueHistoria) { ?>
    <div class="toolbar" style="height: 60px;width:640px; margin: 0 auto;  ">
        <div style="height: 20px;width:200px; margin: 0 auto; float: left" >
            <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
                Ubicación
            </div>

            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <select disabled="true"  style="width: 100px;" >

                    <option>seleccionar...</option>
                    <?php foreach ($arrayUbicaciones as $k => $value) { ?>
                        <option value="<?php echo $arrayUbicaciones[$k][0]; ?>"
                        <?php
                        if ($valueHistoria[1] == $arrayUbicaciones[$k][0]) {
                            echo " selected='selected' ";
                        }
                        ?> >
                                    <?php echo utf8_encode($arrayUbicaciones[$k][1]); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
                Observación
            </div>
            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <textarea disabled="true"  name="" rows="2" cols="20" style="width: 120px; height: 40px;" ><?php echo utf8_encode($valueHistoria['vObservaciones']); ?></textarea>
            </div>

        </div>
        <div style="height: 20px;width:180px; margin: 0 auto; float: left" >
            <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
                Usuario
            </div>
            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($valueHistoria['vUsuario']); ?>" />
            </div>
            <div style="height: 20px;width:60px; margin: 0 auto; float: left" >
                Host
            </div>
            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($valueHistoria['vHost']); ?>" />
            </div>
        </div>
        <div style="height: 20px;width:170px; margin: 0 auto; float: left" >
            <div style="height: 20px;width:50px; margin: 0 auto; float: left" >
                Fecha
            </div>
            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <input readonly="true" style="width: 100px;"  type="text" name="" value="<?php echo utf8_encode($valueHistoria['fecha']); ?>" />
            </div>
            <div style="height: 20px;width:50px; margin: 0 auto; float: left" >
                Hora
            </div>
            <div style="height: 20px;width:120px; margin: 0 auto; float: left">
                <input style="width: 60px;"  readonly="true" type="text" name="" value="<?php echo utf8_encode($valueHistoria['hora']); ?>" />
            </div>
        </div>
        <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
            <div id="" style="float:left">
                <a href="javascript:imprimirUbicacion(<?php echo utf8_encode($valueHistoria[0]); ?>);">
                    <img src="../../../../fastmedical_front/imagen/btn/b_imprimir_on.gif"/>
                </a>
            </div>
        </div>

    </div>

<?php } ?>


<div class="toolbar" style="height: 60px;width:640px; margin: 0 auto;  ">
    <div style="height: 20px;width:200px; margin: 0 auto; float: left" >
        <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
            Ubicación
        </div>

        <div style="height: 20px;width:120px; margin: 0 auto; float: left">
            <select id='comboUbicaciones' style="width: 100px;" >
             
                <?php foreach ($arrayUbicaciones as $k => $value) { ?>
                    <option value="<?php echo $arrayUbicaciones[$k][0]; ?>"
                    <?php
                    if ($actividadPersona == $arrayUbicaciones[$k][0]) {
                        echo " selected='selected' ";
                    }
                    ?> >
                                <?php echo utf8_encode($arrayUbicaciones[$k][1]); ?>
                    </option>
                <?php } ?>
            </select>
        </div>


    </div>
    <div style="height: 20px;width:200px; margin: 0 auto; float: left" >
        <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
            Observación
        </div>
        <div style="height: 20px;width:120px; margin: 0 auto; float: left">
            <textarea  id="textAreaObservacionUbicacion" name="" rows="2" cols="20" style="width: 120px; height: 40px;" ></textarea>
        </div>
    </div>

    <div style="height: 20px;width:80px; margin: 0 auto; float: left" >
        <div id="" style=" float: left">
            <?php if ($_SESSION["permiso_formulario_servicio"][118]["grabarUbicacionImagenes_Citas"] == 1) { ?>
                <a href="javascript:grabarUbicacionImagenes();">
                    <img src="../../../../fastmedical_front/imagen/btn/b_grabar__on.gif"/>
                </a>
            <?php } ?>
        </div>

    </div>

</div>

