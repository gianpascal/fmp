<style>
    .etiqueta{
        font-weight: bold;
        font-size: 12px;
        font-family: verdana;
    }
    .inputType{
        border:1px solid #00823B; 
        background-color: #D3D2D3;
    }
    .inputType:hover{
        background-color: white;
    }
    .float{
        float:left;
    }
    .contenedorTablaPersonalRRHH{
        border:1px solid;
        width: 899px;
        height: 300px;
    }
</style>
<div class="contenedorPopudBusquedaPersonal">
    <table>
        <tr>
            <td>
                <label class="etiqueta">Apellido Paterno &nbsp;</label>
            </td>
            <td>
                <input id="vApellidoPaterno" onKeyPress="busquedaPersonalPorNombres(event)"  class="inputType" type="text" size="25"> &nbsp;
            </td>
            <td>
                <label class="etiqueta">Apellido Materno &nbsp;</label>
            </td>
            <td>
                <input id="vApellidoMaterno" onKeyPress="busquedaPersonalPorNombres(event)" class="inputType" type="text" size="20"> &nbsp;
            </td>
            <td>
                <label class="etiqueta">Nombres  &nbsp;</label>
            </td>
            <td>
                <input id="vNombre" onKeyPress="busquedaPersonalPorNombres(event)" class="inputType" type="text" size="15"> &nbsp;
            </td>
            <td>
                <label class="etiqueta">DNI &nbsp;</label>
            </td>
            <td>
                <input id="vDNI"onKeyPress="busquedaPersonalPorDNI(event)" class="inputType" type="text" size="6"> &nbsp;
            </td>
            <td></td>
        </tr>
    </table>

    <br>
    <div class="contenedorTablaPersonalRRHH" id="contenedorTablaPersonalRRHH">
    </div>
    
    <font color="red" size="4" ><b> SI NO APARECE EL PERSONAL, COMUNICARSE POR RECURSOS HUMANOS </b></font>
    <input type="hidden" id="iIdCoordinador" value="<?php echo $datos['iIdCoordinardor']; ?>">
    <input type="hidden" id="iMes" value="<?php echo $datos['iMes']; ?>">
    <input type="hidden" id="iAnio" value="<?php echo $datos['iAnio']; ?>">
</div>