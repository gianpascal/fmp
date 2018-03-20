<div style="height: 380px; width: 400px;" id="toolbar">
    <form>
        <input type="hidden" id="txtAccion" value="<?php echo $datos['accion']; ?>" />
        <input type="hidden" id="txtFechaActual" value="<?php echo $fechaActual; ?>" />
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left;" id="divEtiquetaNumeroContrato">
                numero contrato:
            </div>
            <div style="float: left;" id="DivTextSueldo">
                <input type="text" style="width:80px;"  id="txtNumeroContrato" name="txtNumeroContrato" value="<?php echo $idContrato; ?>" readonly="true" />
            </div>
        </div>
        <div style="width: 100%; height: 40px; ">
            <div style="width: 150px; float: left;" id="divEtiquetaPuesto">
                Puesto:
            </div>
            <div style="float: left;" id="DivTextCodigo">
                <input readonly="true" type="text" style="width:30px;" value="<?php echo $idPuesto; ?>"  id="txtidPuesto" name="txtidPuesto"/>
                <input readonly="true" type="text" style="width:280px;"  value="<?php echo $vNombrePuesto; ?>" id="txtNombrePuesto" name="txtNombrePuesto"/>
                <?php if ($datos['accion'] == 1) { ?>
                    <input type="button" onclick="ventanaBusquedaPuesto()" value="..." style="visibility:visible; cursor: pointer;" id="btnAsignarPuesto" name="btnAsignarPuesto" />
                <?php } ?>
            </div>


        </div>
        <div style="width: 100%; height: 40px; ">
            <div style="width: 150px; float: left;" id="divEtiquetaCentroCosto">
                Centro Costo:
            </div>
            <div style="float: left;" id="DivTextCodigo">
                <input readonly="true" type="text" value="<?php echo $vNombreCentroCosto; ?>" style="width:310px;"  id="txtCentroCosto" name="txtCentroCosto"/>
            </div>
        </div>
        <div style="width: 300px; height: 30px; ">
            <div style="width: 60px; float: left;" id="divInicio">
                Inicio:
            </div>
            <div style="float: left;" id="DivTextCodigo">
                <input  type="text" style="width:80px;" <?php echo $disable; ?> value="<?php echo $inicio; ?>" id="txtInicio" name="txtInicio"  onclick="calendarioHtmlx('txtInicio');" onblur="esFechaValida(this);"/>
            </div>
            <div style="width: 60px; float: left; text-align: right;" id="divEtiquetaFin" >
                Fin:
            </div>
            <div style="float: left;" id="DivTextFin">
                <input type="text" style="width:80px;" <?php echo $disable; ?>  value="<?php echo $fin; ?>" id="txtFin" name="txtFin" onclick="calendarioHtmlx('txtFin');" onblur="esFechaValida(this);"/>
            </div>
        </div>
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left; " id="divEtiquetaTipoContratos">
                Modalidad de Contratos:
            </div>
            <div style=" float: left;" id="DivSelectTipoContrato">
                <select name="select" <?php echo $disable; ?> id="comboModalidadContrato" style="width:120px;" >
                    <?php
                    echo $comboModalidadContrato;
                    ?>
                </select>
            </div>
        </div>
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left; " id="divEtiquetaTipoContratos">
                Tipo Sueldo:
            </div>
            <div style=" float: left;" id="DivSelectTipoContrato">
                <select name="select" <?php echo $disable; ?>  id="comboTipoSueldo" style="width:120px;" >
                    <?php
                    echo $comboTipoSueldo;
                    ?>
                </select>
            </div>
        </div>
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left;" id="divEtiquetaSueldo">
                Sueldo:
            </div>
            <div style="float: left;" id="DivTextSueldo">
                <input type="text" <?php echo $disable; ?>  style="width:80px;" value="<?php echo $nSueldo; ?>" id="txtSueldo" name="txtSueldo"/>
            </div>
        </div>
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left; " id="divEtiquetaTipoContratos">
                Tipo Programación:
            </div>
            <div style=" float: left;" id="DivSelectTipoContrato">
                <select <?php echo $disable; ?>  name="select" id="comboTipoProgramacion" style="width:120px;" >
                    <?php
                    echo $comboTipoProgramacion;
                    ?>
                </select>
            </div>
        </div>
        <div style="width: 100%; height: 30px; ">
            <div style="width: 150px; float: left; " id="divEtiquetaTipoContratos">
                Estado:
            </div>
            <div style=" float: left;" id="DivSelectTipoContrato">
                <select disabled=""  name="select" id="comboEstado" style="width:120px;" >
                    <?php if ($bEstado == 1) { ?>
                        <option value="1" selected >Activo</option>
                        <option value="0" >Inactivo</option>
                    <?php } else { ?>
                        <option value="1" >Activo</option>
                        <option value="0" selected >Inactivo</option>  
                    <?php } ?>
                </select>
            </div>
        </div>
        <div id="divTextAnulacion" style="width: 100%; height: 50px; display:<?php echo $verAnulacion; ?>;  " >
            <div style="width: 150px; float: left; " id="divEtiquetaTipoContratos">
                Motivo Anuluación:
            </div>
            <div style=" float: left;" id="DivSelectTipoContrato">
                <textarea <?php echo $disable; ?> id="textMotivoAnulacion"><?php echo $vdescripcionAnulaContrato; ?></textarea>
            </div>
        </div>
        <div id="divFechaAnulacion" style="width: 300px; height: 30px; display:<?php echo $verAnulacion; ?> ; ">
            <div style="width: 150px; float: left;" id="divFechaAnulacion">
                Fecha Anulación:
            </div>
            <div style="float: left;" id="DivTextCodigo">
                <input  <?php echo $disable; ?> type="text" style="width:80px;"  value="<?php echo $dFechaAnulacionContrato; ?>" id="textFechaAnulacion" name="textFechaAnulacion"  onclick="calendarioHtmlx('textFechaAnulacion');" onblur="esFechaValida(this);"/>
            </div>

        </div>
    </form>
</div>

<div id="toolbar" style="height:30px;width: 400px; ">
    <table>
        <tr>
            <td>
                <?php
                $toolbar = new ToollBar("Center");
                if (isset($_SESSION["permiso_formulario_servicio"][121]["GRABAR_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["GRABAR_CONTRATO"] == 1)) {
                   
                    
                } else {
                    
                    $grabar=0;
                }
                $toolbar->SetBoton("grabarContrato", "grabar", "btn", "onclick,onkeypress", "grabarContrato()", "../../../../medifacil_front/imagen/icono/grabar.png", "", "", $grabar);
                $toolbar->Mostrar();
                ?>
            </td>
            <td>
                <?php
                $toolbar1 = new ToollBar("Center");
                if (isset($_SESSION["permiso_formulario_servicio"][121]["ANULAR_CONTRATO"]) && ($_SESSION["permiso_formulario_servicio"][121]["ANULAR_CONTRATO"] == 1)) {
                    
                    
                } else {
                    
                    $anular=0;
                }
                $toolbar1->SetBoton("AnularContrato", "Anular", "btn", "onclick,onkeypress", "anularContrato()", "../../../../medifacil_front/imagen/icono/nosecurity.png", "", "", $anular);
                $toolbar1->Mostrar();
                ?>
            </td>
            <td>
                <?php
                $toolbar1 = new ToollBar("Center");
                $toolbar1->SetBoton("grabarAnularContrato", "Confirmar Anulación", "btn", "onclick,onkeypress", "confirmarAnulación()", "../../../../medifacil_front/imagen/icono/nosecurity.png", "", "", false);
                $toolbar1->Mostrar();
                ?>
            </td>

        </tr>
    </table>


</div>

