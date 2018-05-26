<script>
    document.getElementById("buscadorProducto").focus();
</script>
<table style="border:0px solid;width:100%;height:10%;padding:20px;">
    <tr>
        <td  style="width:5%">
            <img src="../../../../fastmedical_front/imagen/icono/tarifas.png" style="width:80px;">
        </td>
        <td  style="width:5%">

        </td>
        <td style="width:80%">
            <p style="font-size:20px;font-family: segoe ui;color:#024683;"><b>CONSULTA TARIFAS </b></p>
        </td>
        <td style="width:30%">
            <input type="text" id="idPaqueteAbajo"  name="idPaqueteAbajo" style="border:0px solid white; font-size:20px; font-family: segoe ui;color:#024683;height:20px;width:360px;background-color: white;overflow:none;"/>   
            <textarea type="text" id="nombrePaqueteAbajo"  name="nombrePaquete" style="border:0px solid white; font-size:20px; font-family: segoe ui;color:#024683;height:120px;width:360px;background-color: white;overflow:none;"></textarea>
        </td>
    </tr>
</table>
<table style="border:0px solid;width:100%;height:70%;padding:20px;">
    <tr>
        <td style="width:60%">
            <div style="height: 100%;border:0px solid">
                <table style="width:100%; height: 10%; border:0px solid;">
                    <tr>
                        <td style="width:10%">
                            <p style="font-size:16px;font-family: segoe ui;color:#024683; padding-left:15px;">Buscar...
                        </td>
                        <td style="width:95%">
                            <input type="text" id="buscadorProducto" onkeyup="filtroproductos(event)" name="buscadorProducto" style="border:1px solid #D1BD9A; font-size:16px; font-family: segoe ui;color:black;height: 25px;width: 620px;"/>
                        </td>
                    </tr>
                </table>
                <table  style="width:100%; height: 90%; border:0px solid;">
                    <tr>
                        <td>
                            <p style="font-size:14px;font-family: segoe ui;color:#024683;"><b>Productos y Servicios</b></p>
                            <div id="contenedorTablaServicios" style="width:100%; height: 90%;border:1px solid #D1BD9A">
                                <img src="../../../../fastmedical_front/imagen/fondo/almacen.jpg" style="width:100%;height: 100%">
                            </div>    
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="width:5%;"></td>
        <td style="width:30%">
            <div style="height: 100%;border:0px solid ">
                <table style="width:100%; height: 90%; border:0px solid;">
                    <tr style="width:100%; height: 40%;">
                        <td>
                            <p style="font-size:14px;font-family: segoe ui;color:#024683;"><b>Stock</b></p>
                            <div id="contenedorStock" style="width:100%; height: 100%;border:1px solid #D1BD9A">

                            </div> 
                        </td>
                    </tr>
                    <tr style="width:100%; height: 10%;">
                        <td>
                        </td>
                    </tr>
                    <tr style="width:100%; height: 40%;">
                        <td>
                            <p style="font-size:14px;font-family: segoe ui;color:#024683;"><b>Precios</b></p>
                            <div id="contenedorPrecios" style="width:100%; height: 100%;border:1px solid #D1BD9A">

                            </div>
                        </td>
                    </tr> 
                </table>
            </div>
        </td>
    </tr>
</table>
