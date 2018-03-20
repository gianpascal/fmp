<input type="hidden" id="idsistema" name="idsistema" value="<?php echo $_REQUEST['idsistema'] ?>">

<div style="height:570px;">
    <div id="div_opcion01" style="width:50%; height:570px; float:left;">
        <fieldset>
            <div id="div_arbol" style="width:100%; height:570px; overflow:auto; overflow-x:hidden;"></div>
        </fieldset>
    </div>
    <div id="div_opcion02" style="width:50%; height:570px; float:left;">
        <form id="form_padre" name="form_padre" action="">
            <div id="div_con_arb"></div>
        </form>
        <form id="form_hijo" name="form_hijo" action="">
            <div id="div_edt_arb"></div>
        </form>
    </div>
</div>