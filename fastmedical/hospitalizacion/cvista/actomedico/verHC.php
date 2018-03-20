<?php
$cboPor = array(0 => "Por Fechas", 1 => "Por Items");
?>
<div id="divContenedorVerHC" align ="left" style=" height: 98%; width:98%; ">
    <div id="divIzquierdaVerHC" style="height:98%; width:29%;  float: left;margin-right: 1%">
        <div id="divIzquierdaArribaVerHC" align ="center" style="height:10%; width:100%;">
            <div id="toolbar" align ="center" >
                <form>
                    Tipo de Vista:
                    <select id="cboPor" name="cboPor" style=" width: 100px;" onchange="tipoDeVista()">
                        <?php foreach ($cboPor as $k => $value) { ?>
                            <option value="<?php echo $k; ?>"><?php echo $value; ?></option><?php } ?>
                    </select>
                </form>
            </div>
        </div>
        <div id="divIzquierdaAbajoVerHC" style="height:90%; width:100%;border: solid 1px green;">
            arbol
        </div>

    </div>
    <div id="divDerechaVerHC" style="height:98%; width:70%; float: right;" class="letra16" >
    </div>
</div>