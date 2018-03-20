<div align="center">
    <table border="1" style="width: 400px;height: 300px">
        <tr>
            <td colspan="3" align="center"> 
                <h1 style="background-color: #D6E9FE; color: #000000">RECEPCION DE MUESTRA</h1> 
            </td>
        </tr>
        <tr>
            <td align="right">Tipo de Muestra:&nbsp;</td>
            <td colspan="2"><input type="text" name="txtTipoMuestra" id="txtTipoMuestra"  style="width:100%;color: blue;font-weight: bold" disabled /></td>
        </tr>
        <tr>
            <td align="right">Procedencia:&nbsp; </td>
            <td style="width:100%"><input type="text" name="txtProcedencia" id="txtProcedencia"  style="width:100%;color: blue;font-weight: bold" disabled /></td>
            <td rowspan="4"><img border="0" id="imgEntregaFrasco" title="Codigo de Persona" style="width: 80px;height:80px "></td>
        </tr>
        <tr>
            <td align="right">Fecha:&nbsp;</td>
            <td><input type="text" name="txtFecha" id="txtFecha"  style="width:100%;color: blue;font-weight: bold" disabled /></td>
        </tr>
        <tr>
            <td align="right">Hora:&nbsp;</td>
            <td><input type="text" name="txtHora" id="txtHora"  style="width:100%;color: blue;font-weight: bold" disabled  /></td>
        </tr>
        <tr>
            <td align="right">Teléfono:&nbsp;</td>
            <td><input type="text" name="txtTelefono" id="txtTelefono"  style="width:100%;color: blue;font-weight: bold" /></td>
        </tr>
        <tr>
            <td align="right">Entregado por:&nbsp;</td>
            <td colspan="2"><input type="text" name="txtEntregadoPor" id="txtEntregadoPor"  style="width:100%;color: blue;font-weight: bold" disabled /></td>
        </tr>
        <tr>
            <td align="right">Usuario:&nbsp;</td>
            <td colspan="2"><input type="text" name="txtUsuario" id="txtUsuario"  style="width:100%;color: blue;font-weight: bold" disabled /></td>
        </tr>
        <tr>
            <td align="right">Observaciones:&nbsp;</td>
            <td colspan="2"><TEXTAREA NAME="txtAreaObservaciones" id="txtAreaObservaciones" COLS=40 ROWS=3 style="width:100%"></TEXTAREA></td>
        </tr>
        <tr>
            <td align="right">Codigo Barras:&nbsp;</td>
            <td colspan="2"><input type="text" name="txtCodigoBarra" id="txtCodigoBarra"  style="width:100%;color: blue;font-weight: bold"/></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <table>
                    <tr>
                        <td><img border="0" src="../../../../medifacil_front/imagen/btn/recibir.bmp" title="Recibir" id="imgEntregaFrasco" onclick="recepcionarFrasco()"></td>
                        <td><img border="0" src="../../../../medifacil_front/imagen/btn/cancelar.bmp" title="Cancelar" id="imgEntregaFrasco" onclick="cerrarPopudRecepcionFrasco()" ></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>