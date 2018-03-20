<div style="width: 1000px;">
    <div style="width:800px;float: left; height: 400px;background-color: #006631 ">
        <canvas id="canvaHistorial"   width="800" height="400" >

        </canvas>


    </div>
    <div id="Div_HistoriaBotones" style="width:200px;float: left; height: 400px;background-color: #ff6631 ">
<!--            <a href="javascript:;" onclick="javascript:historiaLeyenda();">
                <img src="../../../../medifacil_front/imagen/btn/b_ver_on.gif" />
            </a> -->
            <div style="border:0px solid;width: 90%;height:500px;float:left;padding:0px;">
                <div id="Div_HistoriaLeyenda" style="overflow-y:scroll;width: 200px; height:400px; background-color:#006631;  ">
                </div> 
            </div>
    </div>

    <div style="width:1000px;float: left; height: 260px;background-color: white;border:1px solid;padding-top: 10px; ">
        <?php
        //Angel
        //Angel
        $comboFechaAtenciones = $this->comboFechaAtenciones($c_cod_per);
        $comboDientesAtenciones = $this->comboDientesAtenciones($c_cod_per);
        ?>
        <table aling="left" style="width: 950px;">
            <tr>
                <td width="200"><p style="font-size:14px; font-family: verdana;">Atención: 
                        <select id="comboFechaAtenciones" style="font-size:12px; font-family: verdana;" onchange="cargarFechaAtencionOdontograma()">
                            <?php echo $comboFechaAtenciones; ?>
                        </select></p>
                </td>
                <td width="200"><p style="font-size:14px; font-family: verdana;">Diente:  
                        <select id="comboDientesAtenciones" style="font-size:12px; font-family: verdana;" onchange="cargarIdDienteOdontograma()">
                            <?php echo $comboDientesAtenciones; ?>
                        </select></p>
                </td>
                <td><input type="hidden" id="dienteSeleccionado" value="x"></td>
                <td><input type="hidden" id="programacionSeleccionado" value="x" onchange="cambiarProgramacionDiente()"></td>      
            </tr>
        </table>
        <br>
        <div id="DivContenedorHistoriaDetalle" style="border:0px solid;width: 980px;height: 150px">
            <input type="hidden" name="hCodProgramacionHistoria" id="hCodProgramacionHistoria" value="" />
            <div id="contenedorTablaHistoria" style="width:450px;height: 120px;border:1px solid;float:left;overflow: none;">

            </div>
            <div style="width:30px;height: 150px;border:0px solid;float:left;overflow: none;"><br></div>
            <div id="contenedorHistoria" style="width:400px;height: 150px;border:0px solid;float:left;overflow: none;">
                <table style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">

                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Fecha:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input  style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="fechaHistoriaDetalle" >
                        </td>
                    </tr>
                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Diagnostico:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input  style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="diagnosticoHistoriaDetalle"></label>
                        </td>
                    </tr>
                    <tr>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Diente:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input   style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="DienteHistoriaDetalle" ></label>
                        </td>
                    </tr>
                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Caras:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input   style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="carasHistoriaDiente"></label>
                        </td>
                    </tr>
                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Tercero:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="teceroHistoriaDetalle"></label>
                        </td>
                    </tr>
                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Estado:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input style="float:left;font-weight:normal;border:0px; background-color:white;width:100%"  id="estadoHistoriaDetalle"></label>
                        </td>
                    </tr>
                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Medico:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input style="float:left;font-weight:normal;border:0px; background-color:white;width:100%"  id="doctorHistoriaDetalle"></label>
                        </td>
                    </tr>

                    <tr>
                        <td  style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <p style="font-size:14px; font-family: verdana;"><b>Observacion:</b>
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <input style="float:left;font-weight:normal;border:0px; background-color:white;width:100%" id="obsHistoriaDetalle"></label>
                        </td>
                    </tr>
                    <tr>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                        </td>
                        <td style="border:inset;border-bottom: 1px; border-left:1px;border-top: 1px;border-right: 1px;">
                            <div    id="imagenHistoriaDetalle" style="border:0px solid ; width:200px;height: 40px;"></div>
                        </td>
                    </tr>



                </table>
            </div>
        </div>
    </div>
</div>
<script>
<?php
//echo "alert('$c_cod_per');";
$arrayImagenesSimbolos = $this->AarrayImagenesSimbolos('');
$arraySimbolos = $this->AarraySimboloHistorial($c_cod_per);
//echo "alert('');";
$rs = '';
$rs.='arraySimbolosHistoria=new Array();';
$indice = 0;
foreach ($arrayImagenesSimbolos as $key => $value) {
    $idSimbolo = $value['iIdSimboloGraficoDiagnostico'];
    $idDiagnosticoDiente = $value['iIdDiagnosticoDiente'];
    $vRura = $value['vRura'];
    $rs.="arraySimbolosHistoria[$indice]=new Array();";
    $rs.="arraySimbolosHistoria[$indice][0]=$idSimbolo;";
    $rs.="arraySimbolosHistoria[$indice][1]=$idDiagnosticoDiente;";
    $rs.="arraySimbolosHistoria[$indice][2]='$vRura';";
    $indice++;
}

///aramando el array :P
$iCodigoProgramacion = 0;
$iCodigoProgramacionAux = 0;
$numeroProgramacion = -1;
$numeroHistoriadiente = -1;
$iIdHistoriaDiente = 0;
$iIdHistoriaDienteAux = 0;
$rs.='arrayHistoriaDiente=new Array();';
$arrayProgramaciones = array();

foreach ($arraySimbolos as $key => $value) {
    $iCodigoProgramacion = $value['iCodigoProgramacion'];
    $iIdHistoriaDiente = $value['iIdHistoriaDiente'];
    if ($iCodigoProgramacion != $iCodigoProgramacionAux) {
        $numeroProgramacion++;
        $arrayProgramaciones[$numeroProgramacion] = $iCodigoProgramacion;
        $rs.="arrayHistoriaDiente[$numeroProgramacion]=new Array();";

        $numeroHistoriadiente = -1;
    }


    $dientesAfectados = $value['iDientesAfectados'];
    $iColor = $value['iColor'];
    $idDiagnosticoDiente = $value['iIdDiagnosticoDiente'];
    $iIdDiente = $value['iIdDiente'];
    $bInicio = $value['bInicio'];
    $bFin = $value['bFin'];
    $iDientesAfectados = $value['iDientesAfectados'];
    $iColor = $value['iColor'];
    $iIdSimboloGraficoDiagnostico = $value['iIdSimboloGraficoDiagnostico'];
    $iOrden = $value['iorden'];
    $nPosicionX = $value['nPosicionX'];
    $nPosicionY = $value['nPosicionY'];
    $nAncho = $value['nAncho'];
    $nLargo = $value['nLargo'];
    $bColor = $value['bColor'];
    $bDatos = 0;
    if ($iDientesAfectados == 1) {
        $numeroHistoriadiente++;
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente]=new Array();";
        $bDatos = 1;
    }
    if ($iDientesAfectados == 2) {
        if ($iOrden == 1 && $bInicio == 1) {
            $numeroHistoriadiente++;
            $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente]=new Array();";
            $bDatos = 1;
        }
        if ($iOrden == 2 && $bInicio == 1) {
            $numeroHistoriadiente++;
            $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente]=new Array();";
            $bDatos = 1;
        }
        if ($iOrden == 3 && $bFin == 1) {
            $numeroHistoriadiente++;
            $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente]=new Array();";
            $bDatos = 1;
        }
    }

    if ($bDatos == 1) {
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][0]=$iCodigoProgramacion;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][1]=$iIdHistoriaDiente;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][2]=$idDiagnosticoDiente;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][3]=$iIdDiente;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][4]=$bInicio;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][5]=$bInicio;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][6]=$dientesAfectados;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][7]=$iColor;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][8]=$iIdSimboloGraficoDiagnostico;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][9]=$iOrden;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][10]=$nPosicionX;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][11]=$nPosicionY;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][12]=$nAncho;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][13]=$nLargo;";
        $rs.="arrayHistoriaDiente[$numeroProgramacion][$numeroHistoriadiente][14]=$bColor;";
    }



    $iCodigoProgramacionAux = $iCodigoProgramacion;
    $iIdHistoriaDienteAux = $iIdHistoriaDiente;
}


/////////////////////////////////////////
$array = $oLActoMedico->lArregloDientes($datos);
$rs.='numeroDientesHistoria=new Array();';
$rs.='numeroDientesHistoria[0]=1;';
$rs.='arrayDientesHistoria=new Array();';

$rs.='arrayDientesHistoria[0]=new Array();';
$rs.='arrayDientesHistoria[0][0]=new Array();';
$rs.='arrayDientesHistoria[0][0][0]=0;';
$rs.='arrayDientesHistoria[0][0][1]=0;';
$rs.='arrayDatosDientesHistoria=new Array();';
$rs.='arrayDatosDientesHistoria[0]=new Array();';
$contador = 0;
$aux = 0;
foreach ($array as $key => $value) {
    $iIdDienteGraficoOdontograma = $value['iIdDienteGraficoOdontograma'];
    $iOrden = $value['iOrden'];
    $x = $value['nx'];
    $y = $value['ny'];

    if ($aux != $value['iIdDienteGraficoOdontograma']) {
        $rs.="arrayDientesHistoria[$iIdDienteGraficoOdontograma]=new Array();";
        //cargando datos del diente
        $rs.="arrayDatosDientesHistoria[$iIdDienteGraficoOdontograma]=new Array();";
        $idDiente = $value['iIdDiente'];
        $iCodigoBinario = $value['iCodigoBinario'];
        $iCuadrante = $value['iCuadrante'];

        $rs.="arrayDatosDientesHistoria[$iIdDienteGraficoOdontograma][0]=$idDiente;";
        $rs.="arrayDatosDientesHistoria[$iIdDienteGraficoOdontograma][1]=$iCodigoBinario;";
        $rs.="arrayDatosDientesHistoria[$iIdDienteGraficoOdontograma][2]=$iCuadrante;";
    }
    $rs.="arrayDientesHistoria[$iIdDienteGraficoOdontograma][$iOrden]=new Array();";
    $rs.="arrayDientesHistoria[$iIdDienteGraficoOdontograma][$iOrden][0]=$x;";
    $rs.="arrayDientesHistoria[$iIdDienteGraficoOdontograma][$iOrden][1]=$y;";

    $aux = $value['iIdDienteGraficoOdontograma'];
}
$rs.= "var n=arrayDientesHistoria.length;
            
            
            for(var k=1; k<n;k++){
                
                numero1Historia=arrayDientesHistoria[k].length;
                
                arrayDientesHistoria[k][numero1Historia]=new Array();
                 
                arrayDientesHistoria[k][numero1Historia][0]=arrayDientesHistoria[k][0][0];
                 
                arrayDientesHistoria[k][numero1Historia][1]=arrayDientesHistoria[k][0][1];
                

    } 
    ";

////////////////////////////////////////////////////////
$arrayCaras = $oLActoMedico->lArregloCarasDientes($datos);
$indice = -1;
$aux = 0;
$rs.= 'arrayCaraDientesHistoria=new Array();';
$rs.='arrayDatosDientesCaraHistoria=new Array();';

foreach ($arrayCaras as $key => $value) {
    //$idDiente = $value['iIdDienteGraficoOdontograma'];
    $iOrden = $value['iOrden'];
    $x = $value['nx'];
    $y = $value['ny'];

    if ($aux != $value['iIdCarasDiente']) {
        $indice++;
        $idDiente = $value['iIdDiente'];
        $idCaraDiente = $value['iIdCarasDiente'];
        $iArea = $value['iArea'];
        $rs.="arrayCaraDientesHistoria[$indice]=new Array();";
        $rs.="arrayDatosDientesCaraHistoria[$indice]=new Array();";
        $rs.="arrayDatosDientesCaraHistoria[$indice][0]=$idDiente;";
        $rs.="arrayDatosDientesCaraHistoria[$indice][1]=$idCaraDiente;";
        $rs.="arrayDatosDientesCaraHistoria[$indice][2]=$iArea;";
    }
    $rs.="arrayCaraDientesHistoria[$indice][$iOrden]=new Array();";
    $rs.="arrayCaraDientesHistoria[$indice][$iOrden][0]=$x;";
    $rs.="arrayCaraDientesHistoria[$indice][$iOrden][1]=$y;";

    $aux = $value['iIdCarasDiente'];
}

$rs.= "var n1=arrayCaraDientesHistoria.length;

         
            for(var k=0; k<n1;k++){
                
                numero1=arrayCaraDientesHistoria[k].length;
                
                arrayCaraDientesHistoria[k][numero1]=new Array();
                 
                arrayCaraDientesHistoria[k][numero1][0]=arrayCaraDientesHistoria[k][0][0];
                 
                arrayCaraDientesHistoria[k][numero1][1]=arrayCaraDientesHistoria[k][0][1];
                

    } 
    ";
///////historia caras/////////////////////////
$arrayHistoriaCara = $oLActoMedico->lHistoriaCara($c_cod_per);
$iCodigoProgramacion = 0;
$iCodigoProgramacionAux = 0;
$numeroProgramacion = -1;
$numeroHistoriaCara = -1;
$rs1 = '';
$rs1.='arrayHistoriaCara=new Array();';
$arrayProgramaciones;
$peche = 0;
$respuestaPeche = '';
foreach ($arrayHistoriaCara as $key => $value) {
    $iCodigoProgramacion = $value['iCodigoProgramacion'];
    if ($iCodigoProgramacion != $iCodigoProgramacionAux) {
        $respuestaPeche.="actual: " . $iCodigoProgramacion . "<br>";
        $numeroProgramacion++;
        $rs1.="arrayHistoriaCara[$numeroProgramacion]=new Array();";
        while (($arrayProgramaciones[$numeroProgramacion] != $iCodigoProgramacion) && ($peche < 5)) {
            $respuestaPeche.="numero: " . $numeroProgramacion . "<br>";
            $respuestaPeche.="prog1: " . $arrayProgramaciones[$numeroProgramacion] . "<br>";
            $respuestaPeche.="prog2: " . $iCodigoProgramacion . "<br>";
            $numeroProgramacion++;
            $rs1.="arrayHistoriaCara[$numeroProgramacion]=new Array();";
            $peche++;
        }
        $numeroHistoriaCara = -1;
    }
    $numeroHistoriaCara++;
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara]=new Array();";
    $iIdHistoriaDiente = $value['iIdHistoriaDiente'];
    $iIdDiente = $value['iIdDiente'];
    $iColor = $value['iColor'];
    $bColor = $value['bColor'];
    $iIdCarasDiente = $value['iIdCarasDiente'];
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][0]=$iCodigoProgramacion;";
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][1]=$iIdHistoriaDiente;";
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][2]=$iIdDiente;";
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][3]=$iColor;";
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][4]=$bColor;";
    $rs1.="arrayHistoriaCara[$numeroProgramacion][$numeroHistoriaCara][5]=$iIdCarasDiente;";
    $iCodigoProgramacionAux = $iCodigoProgramacion;
}
////////////////////////////////////
echo $rs . $rs1;
//echo "alert('$rs')";
?>
  
    canvasHistoria = document.getElementById('canvaHistorial');
    p1= new Processing(canvasHistoria, animacionHistoria);
</script>
<?php
//echo $respuestaPeche;
//echo $rs1;

  
?>