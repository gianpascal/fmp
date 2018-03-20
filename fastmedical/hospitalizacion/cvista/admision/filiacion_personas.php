<?php
$strAfiliacion = "";
$cAfiliacion   = "";
if($cAfiliacion==''){
    $o_LCita        = new LCita();
    $arrAfiliacion  = $o_LCita->listaDatosPersonaAfiliacion($iid_persona);
    $cAfiliacion    = $arrAfiliacion[0]['cAfiliacion'];
    $strAfiliacion  = $arrAfiliacion[0]['vDescripcion'];
}
$tipo_dato	= $this->seleccionarVinculoFamiliar("0013");
$filiacionN	= $this->FiliacionesPaciente($iid_persona,$cAfiliacion);
$derHabiente    = $this->ListaDerHabienteFiliacion($iid_persona, $cAfiliacion, $strAfiliacion);
?>
<div id="cont_fil">
<table width="680" border="0" cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td colspan="3">
      <div id="fili_pac" style="height:185px;overflow:hidden;display: block;">
	<?php echo $filiacionN;?>
      </div>
      </td>
    </tr>
    <tr>
        <td colspan="3">
           <fieldset>
              <legend>DERECHO HABIENTES</legend>
              <div id="der_hab" style="height:180px; overflow:auto; border: 1px solid #CCCCCC; display:block;">
                  <!--Lista de derecho habientes-->
                  <?php echo $derHabiente;?>
              </div>
                <input name="dh_filiacion" id="dh_filiacion" type="text" size="18" value="<?php echo $cAfiliacion;?>" readonly>
            </fieldset>
        </td>
    </tr>
  </table>
</div>   