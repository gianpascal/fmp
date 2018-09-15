<div id="Div_AdjuntarFile" style="width:100%;float: left   ">
    <div id="Div_AdjuntarFileEncabezado" class="titleform" style="cursor: pointer;" onclick="javascript:abrirDiv('Div_AdjuntarFileCuerpo');">
        <table style="height: auto;width: 100%" class="accordion_title">
            <tr align="center">
                <td>
                    <h1>Adjuntar File o Imagen</h1>
                </td>
                <td style="width:3%">
                    <img id="Div_AdjuntarFileCuerpoicono" src='../../../../fastmedical_front/imagen/icono/plegar.png'
                         title='plegar' alt="" />
                </td>
            </tr>
        </table>
    </div>





    <div id="Div_AdjuntarFileCuerpo" style="width: 95%;height: auto;display:block">

        <fieldset>
            <legend>Adjuntar Imagen</legend>

            <table width="100%" border="0">
                <tr>
                    <td>
                        <div style="width: 80px; height: 120px; background: #dce2f3; float: left; margin: 5px;" >
                            <img src="../../../../fastmedical_front/imagen/btn/Add_Image_icon-icons.com_54218.png" alt="add"
                                 style="width: 80px; height: 120px; cursor: pointer"
                                 id="imgagenSubirFoto">
                            <input type="file" id="fileSubirFoto" style="display: none;">
                        </div>
                        <div style="width: 80px; height: 120px; background: #dce2f3; float: left; margin: 5px;" >
                            <img src="../../../../fastmedical_front/imagen/btn/file-picture-icon_34432.png" alt="add"
                                 style="width: 80px; height: 80px; cursor: pointer">
                            <div style="width: 80px; height: 40px; background: red;color: #fff; 
                                 padding: 10px; font-size: 15px; box-sizing:border-box; text-align:center" >
                                <span style="display:inline-block;vertical-align:middle;line-height:normal;
                                      cursor: pointer">
                                    Eliminar
                                </span>
                            </div>
                        </div>

                    </td>

                </tr>

            </table>


            <div id="controles">
                <button id="pausar">Pausar</button>
                <button id="reanudar">Reanudar</button>
                <button id="cancelar">Cancelar</button>
            </div>

            <div id="mensaje"></div>

            <div id="archivo">
                Archivo subido: <a href="" id="enlace">Click para ver</a>
            </div>

            <div id="divInputLoad">
                <h1>Test it uploading your own image</h1>
                <div id="divFileUpload">
                    <input id="file-upload" type="file" accept="image/*" />
                </div>
                <div id="file-preview-zone">
                </div>
            </div>
        </fieldset>





    </div>
</div>