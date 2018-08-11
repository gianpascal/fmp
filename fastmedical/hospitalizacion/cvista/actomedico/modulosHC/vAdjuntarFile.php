



<div id="Div_AdjuntarFile" style="width:100%;float: left   "  >
    <div id="Div_AdjuntarFileEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_AdjuntarFileCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Adjuntar File o Imagen</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_AdjuntarFileCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png' title='plegar' alt=""/>
                </td>
            </tr>
        </table>
    </div>


    
    <div id="Div_AdjuntarFileCuerpo" style="width: 95%;height: auto;display:block">





        <input type="file" id="campoarchivo">

        <div id="controles">
        <button id="pausar">Pausar</button>
        <button id="reanudar">Reanudar</button>
        <button id="cancelar">Cancelar</button>
        </div>

        <div id="mensaje"></div>

        <div id="archivo">
        Archivo subido: <a href="" id="enlace">Click para ver</a>
        </div>


    </div>
</div>
