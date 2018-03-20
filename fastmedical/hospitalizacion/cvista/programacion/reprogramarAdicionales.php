<style>
    input[type='button']:focus {
        border:2px solid #000000;
    }

    input[type='button']:active {
        border:2px inset #000000;
    }

    input[type='button']:active ~ .span{
        display:none;
    }

    input[type='button'] {
        width:50px;
        height:31px;
        border:2px solid #BABABA;
        padding-left: 5px;
        padding-right: 5px;
        background-color: #27813D;
        color:#ffffff;
        text-transform: capitalize;
    }

    .titleButton:hover > .span{
        margin:50px 0px 0px 0px;
        display:block;  

    }

    .titleButton > span{
        height: auto;
        width:auto;
    }

    .span{
        display:none;
        position:absolute;
        border:2px solid #000000;
        background-color: #ffffff;
        padding: 5px 5px 4px 5px;
        font-size:12px;
        font-family: fuentejma ,verdana;
        margin:14px 5px 5px 5px;
        height: 16px;

    }
    input[type='text']{
        height:25px;
        width:250px;
        border:2px solid #BABABA;
        padding-left: 5px;
        padding-right: 5px;
        font-family: fuentejma ,verdana;
        margin: 10px 10px 10px 10px;
    }

    input[type='text']:focus {
        border:2px solid #000000;
    }
</style>
<input type="hidden" value="<?php echo $datos["iCodigoCronograma"]; ?>" id="txtiCodigoCronogramaModificarAdicionales"> 
<?php

?>

<table>
    <tr>
        <td>
            <label>Numero de Adicionales</label>
        </td>
        <td>
            <input type="text" value="<?php echo $cantidadAdionales[0][0];?>" id="txtNumeroAdicionales" onkeyup="validaInteger(event,this)"> 
        </td>
        <td>
            <div class="titleButton" style="border:0px solid black;height:31px;width:100px;float:left;margin-right: 5px;">
                <input onClick="guardarCambiosLogADicionales()" type="button"  value="Guardar"  style="width:100px;float:left;margin-right: 5px;" onClick="cargarVistaNuevoFormulario();">
                <span class="span">Guardar Cambios</span>
            </div>
        </td>
    </tr>
</table>