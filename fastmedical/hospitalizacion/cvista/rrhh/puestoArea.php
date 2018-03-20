<br>
<div style="width: 100%; height: auto;" align="center">
    <fieldset style="margin-left: 25px;width:auto;height:auto; margin-right:25px;">
        <div><br>
            Categoria Puesto:
            <select name="cboCategoriaPuesto" id="cboCategoriaPuesto" style="width: 230px;" onchange="tblPuestosxCategoria('<?php echo $datos["idSedeEmpresaArea"]?>')">
                <option value="">Seleccionar</option>
                <?php foreach ($cboCategoriaPuesto as $i => $value) { ?>
                <option value="<?php echo $value[0];?>"><?php echo $value[1];?></option>
                    <?php }?>
            </select>
        </div><br>
        <div id="div_puestos_categoria" style="height: 300px;" align="center">
        </div>
    </fieldset>
</div>

