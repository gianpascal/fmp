
<fieldset style="margin-top: 20px;margin-bottom: 20px;height: 85%">
    <table width="90%" border="0">
        <tr>
            <td width="24%"><pre>Código		:</pre></td>
            <td width="5%">&nbsp;</td>
            <td width="71%"><?php echo htmlentities($resultado["c_cod_ser_pro"]);?></td>
        </tr>
        <br/>
        <tr>
            <td><pre>Nombre		:</pre></td>
            <td>&nbsp;</td>
            <td><?php echo htmlentities($resultado["v_desc_ser_pro"]);?></td>
        </tr>
        <br/>
        <tr <?php if($resultado["iidTipoTratamiento"]==2) echo "style=\"display: none\"";?>>
            <td><pre>Presentación	:</pre></td>
            <td>&nbsp;</td>
            <td><?php echo htmlentities($resultado["descri"]);?></td>
        </tr>
        <?php if($resultado["iidTipoTratamiento"]==1) echo "<br/>";?>
        <tr <?php if($resultado["iidTipoTratamiento"]==2) echo "style=\"display: none\"";?>>
            <td><pre>Cantidad	:</pre></td>
            <td>&nbsp;</td>
            <td><?php echo htmlentities($resultado["icantidad"]);?></td>
        </tr>
        <?php if($resultado["iidTipoTratamiento"]==1) echo "<br/>";?>
        <tr>
            <td><pre>Observación	:</pre></td>
            <td>&nbsp;</td>
            <td><?php echo htmlentities($resultado["vModoAplicacion"]);?></td>
        </tr>
    </table>
</fieldset>