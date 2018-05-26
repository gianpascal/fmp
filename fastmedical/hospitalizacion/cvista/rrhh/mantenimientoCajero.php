<?php
$caja=$arrayMaximoNumeroCaje[0][0];
// style="height: 0px; width: 0px; display: none;"
?>
<input type="hidden" name="htxtUsuario" value="<?php echo $arrayUsuario[0][0] ?>"  id="htxtUsuario" />
<input type="hidden" name="htxtNumeroCaja" value="<?php echo $caja ?>"  id="htxtNumeroCaja" />

<div style="width:99%; margin:1px auto; border: #006600" >
    <div class="titleform" id="divTitulo" >
    </div>
</div>
<div align="center" >
    <table>
        <tr align="center">
            <td>
                <h3> <font size="5"> Numero de Caja:</font> </h3>
            </td>
            <td>
                <input type="text" name="txtNumeroCaja" id="txtNumeroCaja"  style="font-size: 30px;color: red"
                       value="<?php echo $caja.'     '.$arrayUsuario[0][0] ?>"  disabled=""/>
            </td>
        </tr>
        <tr align="CENTER">
            <td colspan="2">
                <h3> <font size="5">TIPO COMPROBANTE</font> </h3>
            </td>
        </tr>
    </table>
</div>

<div align="center">
    <div align="center" style="width: 550px; height: auto;overflow: scroll; border: 5px ; background-color: window; border: 1px solid #963;">
        <table align="center"  id="tblTipoComprobante">
            <thead>
                <tr bgcolor="#159900">
                    <th>Nombre Comprobante</th>
                    <th>Serie Comprobante</th>
                    <th>Número Actual</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayTipoComprobante as $i => $value) {
                   
                        $class = ($i + 1) % 2 == 0 ? "jclmTbPar" : "jclmTbImpar";
                    
                    ?>

                <tr align="CENTER" class="<?php echo $class; ?>" >
                    <td align="center"  style="height: 0px; width: 0px;"><?php echo $value[0]?></td>
                    <td align="center" style="height: 0px; width: 0px;"><?php echo $value[1] ?></td>
                    <td align="center" style="height: 0px; width: 0px;"><?php echo $value[2] ?></td>
                  
                    
                    
                    <td>
                        <a href="javascript:eliminarComprobante(<?php  echo $value[3] ?>);"><img border="0" title="Editar" alt="" src="../../../../fastmedical_front/imagen/icono/cancel.png"/></a>
                    </td>
                </tr>

                    <?php   } ?>
            </tbody>
        </table>
    </div>
</div>
<div align="center">
    <a href="javascript:poppackBoletas();"><img border="0" title="Codigo de Persona" alt="" src="../../../../fastmedical_front/imagen/btn/b_agregar_off.gif"/></a>
</div>