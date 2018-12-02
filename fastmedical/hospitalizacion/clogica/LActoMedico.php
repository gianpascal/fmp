<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../../cdatos/DActoMedico.php");
require_once("LPersona.php");

class LActoMedico {

    public function __construct() {
        
    }

    public function getListaProgramacionMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayProgramacionMedico($datos);
        $resultadoArray = array();
        $dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        //$cadena = $cadena.$coma.$dias[date('w',strtotime($resultado[$indice]['dFechaServicio']))]." ".date('d',strtotime($resultado[$indice]['dFechaServicio']))." ".$meses[date('n',strtotime($resultado[$indice]['dFechaServicio']))-1]." ".date('Y',strtotime($resultado[$indice]['dFechaServicio']));
        $resultadoArray = $resultado;
        $i = 0;
        while ($i < count($resultadoArray)) {
            $resultadoArray[$i][1] = $dias[date('w', strtotime($resultadoArray[$i]['dFechaServicio']))] . " " . date('d', strtotime($resultadoArray[$i]['dFechaServicio']));
            $resultadoArray[$i]["dFechaServicio"] = $dias[date('w', strtotime($resultadoArray[$i]['dFechaServicio']))] . " " . date('d', strtotime($resultadoArray[$i]['dFechaServicio']));

            $i = $i + 1;
        }
        return $resultadoArray;
    }

    function getListaPacientesProgramados($datos) {
        $o_DActoMedico = new DActoMedico();
        $o_LPersona = new LPersona();
        $resultado = $o_DActoMedico->getArrayPacientesProgramados($datos);
        $j = 0;
        $aux = array();
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/age_bell.png ^ Llamar al Paciente";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/hos_medico.png ^ Atender";
            $imagen3 = "../../../../fastmedical_front/imagen/icono/timer.png ^ Atencion Inmediata";
//            $imagen4="../../../../fastmedical_front/imagen/icono/agt_action_fail.png ^ No Regularizado";
//            $imagen5="../../../../fastmedical_front/imagen/icono/add_user.png ^ Atender y Regularizar";
            $aux = explode("|", $resultado[$j][0]);
//            if($aux[2]=="0005") $imagen3=$imagen3;
//            if($aux[2]=="0007") $imagen3=$imagen4;
//            if($aux[2]=="0004") $imagen3=$imagen5;
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
            array_push($resultado[$j], $imagen3);
            if ($resultado[$j][3] == 'sindata') {
                $resultado[$j][3]='-';
                $resultado[$j]["edad"]='-';
            } else {
                $resultado[$j][3] = utf8_decode($o_LPersona->formatoEdad($resultado[$j][3]));
                $resultado[$j]["edad"] = utf8_decode($o_LPersona->formatoEdad($resultado[$j]["edad"]));
            }
            $j++;
        }
        return $resultado;
    }

    function lMotrarTodasAtencionesProgramados($datos) {
        $o_DActoMedico = new DActoMedico();
        $o_LPersona = new LPersona();
        $arrayCodigos = explode('|', $datos["cadenaCodigocronograma"]);
        $arrayResultado = array();
        $contador = 0;
        foreach ($arrayCodigos as $value) {
            $datosCronograma["codigocronograma"] = $value;
            $resultado = $o_DActoMedico->getArrayPacientesProgramados($datosCronograma);
            foreach ($resultado as $key => $valor) {
                $arrayResultado[$contador] = $valor;
                $contador++;
            }
        }
        $j = 0;
        $aux = array();
        foreach ($arrayResultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/age_bell.png ^ Llamar al Paciente";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/hos_medico.png ^ Atender";
            $imagen3 = "../../../../fastmedical_front/imagen/icono/timer.png ^ Atencion Inmediata";
            $aux = explode("|", $arrayResultado[$j][0]);
            array_push($arrayResultado[$j], $imagen1);
            array_push($arrayResultado[$j], $imagen2);
            array_push($arrayResultado[$j], $imagen3);
            $arrayResultado[$j][3] = utf8_decode($o_LPersona->formatoEdad($arrayResultado[$j][3]));
            $arrayResultado[$j]["edad"] = utf8_decode($o_LPersona->formatoEdad($arrayResultado[$j]["edad"]));
            $j++;
        }
        return $arrayResultado;
    }

    function getTodasListaPacientesAdicionales($datos) {
        $o_DActoMedico = new DActoMedico();
        $o_LPersona = new LPersona();
        $arrayCodigos = explode('|', $datos["cadenaCodigocronograma"]);
        $arrayResultado = array();
        $contador = 0;
        foreach ($arrayCodigos as $value) {
            $datosCronograma["codigocronograma"] = $value;
            $resultado = $o_DActoMedico->getArrayPacientesAdicionales($datosCronograma);
            foreach ($resultado as $key => $valor) {
                $arrayResultado[$contador] = $valor;
                $contador++;
            }
        }
        $j = 0;
        $aux = array();
        foreach ($arrayResultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/age_bell.png ^ Llamar al Paciente";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/hos_medico.png ^ Atender";
            $imagen3 = "../../../../fastmedical_front/imagen/icono/timer.png ^ Atencion Inmediata";
            $aux = explode("|", $arrayResultado[$j][0]);
            array_push($arrayResultado[$j], $imagen1);
            array_push($arrayResultado[$j], $imagen2);
            array_push($arrayResultado[$j], $imagen3);
            $arrayResultado[$j][3] = utf8_decode($o_LPersona->formatoEdad($arrayResultado[$j][3]));
            $arrayResultado[$j]["edad"] = utf8_decode($o_LPersona->formatoEdad($arrayResultado[$j]["edad"]));
            $j++;
        }
        return $arrayResultado;
    }

    function getListaPacientesAdicionales($datos) {
        $o_DActoMedico = new DActoMedico();
        $o_LPersona = new LPersona();
        $resultado = $o_DActoMedico->getArrayPacientesAdicionales($datos);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/age_bell.png ^ Llamar al Paciente";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/hos_medico.png ^ Atender";
            $imagen3 = "../../../../fastmedical_front/imagen/icono/timer.png ^ Atencion Inmediata";
//            $imagen4="../../../../fastmedical_front/imagen/icono/agt_action_fail.png ^ No Regularizado";
//            $imagen5="../../../../fastmedical_front/imagen/icono/add_user.png ^ Atender y Regularizar";
            $aux = explode("|", $resultado[$j][0]);
//            if($aux[2]=="0005") $imagen3=$imagen3;
//            if($aux[2]=="0007") $imagen3=$imagen4;
//            if($aux[2]=="0004") $imagen3=$imagen5;
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
            array_push($resultado[$j], $imagen3);
            $resultado[$j][3] = utf8_decode($o_LPersona->formatoEdad($resultado[$j][3]));
            $resultado[$j]["edad"] = utf8_decode($o_LPersona->formatoEdad($resultado[$j]["edad"]));
            $j++;
        }
        return $resultado;
    }

    function tablacontadoresMensualesActoMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArraycontadoresMensualesActoMedico($datos);
        $contadores = explode("|", $rs[0]["respuesta"]);
        $cadena = "<table border=\"0\" style=\"width: 100%;height: 40%\" cellpadding=\"2\" cellspacing=\"1\">
                    <tr>
                        <td width=\"93\"  ><div align=\"center\"></div></td>
                        <td width=\"62\" bgcolor='#D2DDFB'><div align=\"center\"><b>Atendidos</b></div></td>
                        <td width=\"109\" bgcolor='#D2DDFB' ><div align=\"center\"><b>No Atendidos</b></div></td>
                    </tr>
                    <tr>
                        <td bgcolor='#D2DDFB'><div align=\"center\"><b>Consultas</b></div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[1] . "</div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[0] . "</div></td>
                    </tr>
                    <tr>
                        <td bgcolor='#D2DDFB'><div align=\"center\"><b>Procedimientos<b/></div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[4] . "</div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[3] . "</div></td>
                    </tr>
                    <tr>
                        <td bgcolor='#D2DDFB'><div align=\"center\"><b>Total</b></div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[5] . "</div></td>
                        <td bgcolor='#E8EEFD'><div align=\"center\">" . $contadores[2] . "</div></td>
                    </tr>
                </table>";
        return $cadena;
    }

    function tablaCantidadAtencionDiaria($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArraycontadoresCantidadAtencionDiaria($datos);
        $contadores = explode("|", $rs[0]["contadordiario"]);
        $cadena = "<table style=\"width: 50%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
                        <tr>
                            <td bgcolor='#D2DDFB' width=\"119\"><div align=\"center\"><b>Atendidos</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"140\"><div align=\"center\"><b>Por Regularizar</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"145\"><div align=\"center\"><b>No Atendidos</b></div></td>
                            <td bgcolor='#D2DDFB' width=\"119\"><div align=\"center\"><b>Total</b></div></td>
                        </tr>
                        <tr align=\"center\">
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input disabled type='text' id='hatendidos' value='" . $contadores[0] . "' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' /> </div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input disabled type='text' id='hregularizar' value='" . $contadores[2] . "' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' /></div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input disabled type='text' id='hnoAtendidos' value='" . $contadores[1] . "' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' /></div></td>
                            <td bgcolor='#E8EEFD'><div align=\"center\"> <input disabled type='text' id='hTotal' value='" . $contadores[3] . "' style='width:60px;font-size:14px;font-family:verdana;border:0px solid #E8EEFD;background-color:#E8EEFD;' /></div></td>
                        </tr>
                    </table>";
        return $cadena;
    }

    function obtenerdatosdellamadadelPaciente($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArraydatosdellamadadelPaciente($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    function tablaLaboratorioHc($codPersona) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->tablaLaboratorioHc($codPersona);
        $j = 0;
        foreach ($resultado as $fila) {
            $resultado[$j][0] = $j;
            $j++;
        }

        //print_r($resultado);
        return $resultado;
    }

    function DetalletablaLaboratorioHc($IdResult) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DetalletablaLaboratorioHc($IdResult);
        return $resultado;
    }

    function lgrabarDestinoEssalud($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dgrabarDestinoEssalud($datos);
        return $resultado;
    }

    function lgrabarTipoCitaEssalud($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dgrabarTipoCitaEssalud($datos);
        return $resultado;
    }

    function lcargarDatosCombo($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dcargarDatosCombo($datos);
        return $resultado;
    }

    function lcargarDatosTipoCita($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dcargarDatosTipoCita($datos);
        return $resultado;
    }

    function eliminarAnterioresSeleccionados($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminarAnterioresSeleccionados($datos);
        return $resultado;
    }

    function guardarNuevaSeleccion($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->guardarNuevaSeleccion($datos);
        return $resultado;
    }

    function obtenerdatosPersonalesActoMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArraydatosPersonalesActoMedico($datos);
        return utf8_encode($rs[0]["datosmedico"]);
    }

    function actualizaradicionalesActoMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->actualizaradicionalesActoMedico($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    function arbolExamenFisico($idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->asignarPadreFisico($idversion);
        return $resultado;
    }

    function cargarTablaCentroCostosServicios($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargarTablaCentroCostosServicios($datos);
        return $resultado;
    }

//    function generarArbolEF($ruta_archivo) {
//        $o_DActoMedico = new DActoMedico();
//        $resultado = $o_DActoMedico->asignarPadreFisico();
//        if(count($resultado)>0) {
//            $this->factoryTree($resultado,$ruta_archivo);
//        }
//        return 0;
//    }
    function asignarPadreFisico($idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->asignarPadreFisico($idversion);
        return $resultado;
    }

//    function asignarPadreFisico($ruta_archivo) {
//        $o_DActoMedico = new DActoMedico();
//        $resultado = $o_DActoMedico->asignarPadreFisico();
//        if(count($resultado)>0) {
//            $this->factoryTree($resultado,$ruta_archivo);
//            return 'data';
//        }else {
//            return 'nodata'; //se sabe que $resultado es nulo
//        }
//    }
    public function capturaPadreEF($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->capturaPadreEF($datos);
        return $resultado;
    }

    public function editaExamenFisico($codigo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->editaExamenFisico($codigo);
        return $resultado;
    }

    public function eliminaExamenFisico($dato) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminaExamenFisico($dato);
        return $resultado;
    }

    public function factoryTree($resultado, $ruta_archivo) {
        //$array--> arreglo de datos para generar el arbol
        //$ruta_archivo--> Es la ruta mas el nombre del archivo sin extencion(xml) que se quiere generar ejemplo "../../../../carpetaDocumentos/arbol_manuales"
        $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $cadena.="<tree id=\"0\" radio=\"1\">\n";
        $codAnterior = '';
        $contador = 0;
        $nivel;
        foreach ($resultado as $rs => $valor) {
            if ($codAnterior == '') {
                $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                $codAnterior = strlen(trim($resultado[$rs]["jerarquia"]));
                $contador = $contador + 1;
                $nivelAnterior = $resultado[$rs]["nivel"];
            } else {
                //verificar si el anterior era de mas nivel
                if ($codAnterior < strlen(trim($resultado[$rs]["jerarquia"]))) {
                    $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"]));
                    $nivelAnterior = $resultado[$rs]["nivel"];
                    $contador = $contador + 1;
                } else {
                    if ($codAnterior > strlen(trim($resultado[$rs]["jerarquia"]))) {
                        $numCierre = $nivelAnterior - $resultado[$rs]["nivel"] + 1;
                        $contador = $contador - $numCierre + 1;
                        while ($numCierre > 0) {
                            $cadena.="</item>\n";
                            $numCierre = $numCierre - 1;
                        }
                    } else {
                        $cadena.="</item>\n";
                    }
                    $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"])); //guardo la longitud de su codjerarquico
                }
            }
        }
        for ($i = 0; $i < $contador; $i++) {
            $cadena.="</item>\n";
        }

        $cadena.="\n</tree>";
//        $archivo=basename($ruta_archivo);
        $archivo = $ruta_archivo;
        $archivo.=".xml";
        $contenido2 = $cadena;
        $ft = fopen($archivo, "w");
        fwrite($ft, $contenido2);
        fclose($ft);
    }

    function act_regExamenFisico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->act_regExamenFisico($datos);
        return $resultado;
    }

    /////////funciones de Giancarlo////////////

    public function listaCie($nombreCie, $accion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaCie($nombreCie, $accion);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen = "../../../../fastmedical_front/imagen/icono/nuevo_item.png ^ Agregar";
            array_push($resultado[$j], $imagen);
            $j++;
        }
        return $resultado;
    }

    public function listaParentesco() {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaParentesco();
        return $resultado;
    }

    public function preGrabarAntecedente($idCie, $observacion, $idProgramacion, $cadenaParentesco, $estadoAccion, $idAntecedente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->preGrabarAntecedente($idCie, $observacion, $idProgramacion, $cadenaParentesco, $estadoAccion, $idAntecedente);
        return $resultado;
    }

    public function listaAntecedentesPreguardados($codigoProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaAntecedentesPreguardados($codigoProgramacion);
        return $resultado;
    }

    public function spListaNsdAntecedentes($codigoProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->spListaNsdAntecedentes($codigoProgramacion);
        return $resultado;
    }

    public function verAntecedentesAnteriores($codigoPaciente) {
        $o_DActoMedico = new DActoMedico();
        $array = $o_DActoMedico->verAntecedentesAnteriores($codigoPaciente);
        $resultado = array();
        //print_r($resultado);
        $n = count($array);
        $j = 1;
        $parentesco = '';
        $contador = 0;
        for ($i = 0; $i < $n; $i++) {
            if (isset($array[$j])) {
                if ($array[$i][0] == $array[$j][0]) {
                    $parentesco.=', ' . $array[$i][4];
                    $j++;
                    //echo "<br>1".$array[$i][4];
                } else {
                    if ($array[$i][4] != null) {
                        $parentesco.=', ' . $array[$i][4];
                        //  echo "<br>2".$array[$i][4];
                    }
                    $resultado[$contador] = $array[$i];
                    $resultado[$contador][4] = substr($parentesco, 1);
                    $parentesco = '';
                    $contador++;
                    $j++;
                }
            } else {


                if ($array[$i][4] != null) {
                    $parentesco.=', ' . $array[$i][4];
                    //echo "<br>3".$array[$i][4];
                }
                $resultado[$contador] = $array[$i];
                $resultado[$contador][4] = substr($parentesco, 1);
                $parentesco = '';
                $contador++;
                $j++;
            }
        }
        return $resultado;
    }

    public function clonarExamenes($idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->clonarExamenes($idversion);
        return $resultado;
    }

    public function pasarProduccion($idversion) {
        $o_DActoMedico = new DActoMedico();
        $arrayResultado = $o_DActoMedico->pasarProduccion($idversion);
        return $arrayResultado;
    }

    public function listaExamenesPruebas($idVersion, $idExamen) {
        $o_DActoMedico = new DActoMedico();
        $arrayResultado = $o_DActoMedico->listaExamenesPruebas($idVersion, $idExamen);
        return $arrayResultado;
    }

    public function pruebasExamenes($idExamen, $iCodigoProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $arrayResultado = $o_DActoMedico->pruebasExamenes($idExamen, $iCodigoProgramacion);
        return $arrayResultado;
    }

    public function inactivarVersion($idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->inactivarVersion($idversion);
        return $resultado;
    }

    public function existeDesarrollo($idversion) {
        $o_DActoMedico = new DActoMedico();
        $arrayResultado = $o_DActoMedico->existeDesarrollo($idversion);
        return $arrayResultado[0][0] . "|" . $arrayResultado[0][1] . "|";
    }

    public function arrayComboExamenes($idCombo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->arrayComboExamenes($idCombo);
        return $resultado;
    }

    public function preguardarExamenes($valorCampo, $estadoCampo, $idCampoExamen, $idTipoCampo, $idCampo, $iCodigoProgramacion, $idVersion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->preguardarExamenes($valorCampo, $estadoCampo, $idCampoExamen, $idTipoCampo, $idCampo, $iCodigoProgramacion, $idVersion);
        return $resultado[0][0];
    }

    public function arbolHCFechas1($codigoPaciente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->arbolHCFechas($codigoPaciente);
        $añoaux = '';
        $mesaux = '';
        $meses[1] = 'Enero';
        $meses[2] = 'Febrero';
        $meses[3] = 'Marzo';
        $meses[4] = 'Abril';
        $meses[5] = 'Mayo';
        $meses[6] = 'Junio';
        $meses[7] = 'Julio';
        $meses[8] = 'Agosto';
        $meses[9] = 'Setiembre';
        $meses[10] = 'Octubre';
        $meses[11] = 'Noviembre';
        $meses[12] = 'Diciembre';
        $arrayArbol = array();
        $i = 0;
        $arrayArbol[$i]["id"] = 'n-';
        $arrayArbol[$i]["titulo"] = "Historia Medica";
        $arrayArbol[$i]["jerarquia"] = "01";
        $arrayArbol[$i]["nivel"] = 0;
        $i++;
        $a = 1;
        $m = 1;
        $c = 1;
        foreach ($resultado as $fila) {
            $año = $fila[1];
            $mes = $fila[2];
            $consulta = $fila[3];
            $id = $fila[0];
            if ($añoaux != $año) {
                $m = 1;
                $c = 1;
                $jaño = '01' . str_pad($a, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $i . '-';
                $arrayArbol[$i]['titulo'] = $año;
                $arrayArbol[$i]['jerarquia'] = $jaño;
                $arrayArbol[$i]['nivel'] = 1;
                $i++;
                $a++;
                ///////////////////////////////
                $jmes = $jaño . str_pad($m, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $i . '_';
                $arrayArbol[$i]['titulo'] = $meses[$mes];
                $arrayArbol[$i]['jerarquia'] = $jmes;
                $arrayArbol[$i]['nivel'] = 2;
                $m++;
                $i++;
                $jConsulta = $jmes . str_pad($c, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $id;
                $arrayArbol[$i]['titulo'] = $consulta;
                $arrayArbol[$i]['jerarquia'] = $jConsulta;
                $arrayArbol[$i]['nivel'] = 3;
                $i++;
                $c++;
                //echo 'año';
            } else {
                //$añoaux=$año;

                if ($mes != $mesaux) {
                    $c = 1;
                    $jmes = $jaño . str_pad($m, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $i . '_*';
                    $arrayArbol[$i]['titulo'] = $meses[$mes];
                    $arrayArbol[$i]['jerarquia'] = $jmes;
                    $arrayArbol[$i]['nivel'] = 2;
                    $i++;
                    $m++;

                    $jConsulta = $jmes . str_pad($c, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $id;
                    $arrayArbol[$i]['titulo'] = $consulta;
                    $arrayArbol[$i]['jerarquia'] = $jConsulta;
                    $arrayArbol[$i]['nivel'] = 3;
                    $i++;
                    $c++;

                    // echo "mes";
                } else {
                    $jConsulta = $jmes . str_pad($c, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $id;
                    $arrayArbol[$i]['titulo'] = $consulta;
                    $arrayArbol[$i]['jerarquia'] = $jConsulta;
                    $arrayArbol[$i]['nivel'] = 3;
                    $i++;
                    $c++;
                }
            }
            $añoaux = $año;
            $mesaux = $mes;
        }
        //print_r($arrayArbol);
        return $arrayArbol;
    }

    public function arbolHCFechas($codigoPaciente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->arbolHCFechas($codigoPaciente);
        $añoaux = '';
        $mesaux = '';
        $actividadAux = '';
        $meses[1] = 'Enero';
        $meses[2] = 'Febrero';
        $meses[3] = 'Marzo';
        $meses[4] = 'Abril';
        $meses[5] = 'Mayo';
        $meses[6] = 'Junio';
        $meses[7] = 'Julio';
        $meses[8] = 'Agosto';
        $meses[9] = 'Setiembre';
        $meses[10] = 'Octubre';
        $meses[11] = 'Noviembre';
        $meses[12] = 'Diciembre';
        $arrayArbol = array();
        $i = 0;
        $arrayArbol[$i]["id"] = 'n-';
        $arrayArbol[$i]["titulo"] = "Historia Medica";
        $arrayArbol[$i]["jerarquia"] = "01";
        $arrayArbol[$i]["nivel"] = 0;
        $i++;
        $a = 1;
        $m = 1;
        $c = 1;
        $act = 1;
        foreach ($resultado as $fila) {
            $año = $fila[1];
            $mes = $fila[2];
            $consulta = $fila[3];
            $id = $fila[0];
            $actividad = $fila[6];
            if ($actividadAux != $actividad) {
                $a = 1;
                $m = 1;
                $c = 1;

                $jactividad = '01' . str_pad($act, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $i . '*';
                $arrayArbol[$i]['titulo'] = $actividad;
                $arrayArbol[$i]['jerarquia'] = $jactividad;
                $arrayArbol[$i]['nivel'] = 1;
                $i++;
                $act++;
                $jaño = $jactividad . '01' . str_pad($a, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $i . '-';
                $arrayArbol[$i]['titulo'] = $año;
                $arrayArbol[$i]['jerarquia'] = $jaño;
                $arrayArbol[$i]['nivel'] = 2;
                $i++;
                $a++;
                ///////////////////////////////
//                $jmes = $jaño . str_pad($m, 2, "0", STR_PAD_LEFT);
//                $arrayArbol[$i]['id'] = $i . '_';
//                $arrayArbol[$i]['titulo'] = $meses[$mes];
//                $arrayArbol[$i]['jerarquia'] = $jmes;
//                $arrayArbol[$i]['nivel'] = 3;
//                $m++;
                //$i++;
                $jConsulta = $jaño . str_pad($c, 2, "0", STR_PAD_LEFT);
                $arrayArbol[$i]['id'] = $id;
                $arrayArbol[$i]['titulo'] = $consulta;
                $arrayArbol[$i]['jerarquia'] = $jConsulta;
                $arrayArbol[$i]['nivel'] = 3;
                $i++;
                $c++;
            } else {
                if ($añoaux != $año) {
                    $m = 1;
                    $c = 1;
                    // echo "jactividad: $jactividad";
                    $jaño = $jactividad . '01' . str_pad($a, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $i . '-';
                    $arrayArbol[$i]['titulo'] = $año;
                    $arrayArbol[$i]['jerarquia'] = $jaño;
                    $arrayArbol[$i]['nivel'] = 2;
                    $i++;
                    $a++;
                    ///////////////////////////////
//                    $jmes = $jaño . str_pad($m, 2, "0", STR_PAD_LEFT);
//                    $arrayArbol[$i]['id'] = $i . '_';
//                    $arrayArbol[$i]['titulo'] = $meses[$mes];
//                    $arrayArbol[$i]['jerarquia'] = $jmes;
//                    $arrayArbol[$i]['nivel'] = 3;
//                    $m++;
//                    $i++;
                    $jConsulta = $jaño . str_pad($c, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $id;
                    $arrayArbol[$i]['titulo'] = $consulta;
                    $arrayArbol[$i]['jerarquia'] = $jConsulta;
                    $arrayArbol[$i]['nivel'] = 3;
                    $i++;
                    $c++;
                    //echo 'año';
                } else {
                    //$añoaux=$año;
//                    if ($mes != $mesaux) {
//                        $c = 1;
//                        $jmes = $jaño . str_pad($m, 2, "0", STR_PAD_LEFT);
//                        $arrayArbol[$i]['id'] = $i . '_*';
//                        $arrayArbol[$i]['titulo'] = $meses[$mes];
//                        $arrayArbol[$i]['jerarquia'] = $jmes;
//                        $arrayArbol[$i]['nivel'] = 3;
//                        $i++;
//                        $m++;
//
//                        $jConsulta = $jmes . str_pad($c, 2, "0", STR_PAD_LEFT);
//                        $arrayArbol[$i]['id'] = $id;
//                        $arrayArbol[$i]['titulo'] = $consulta;
//                        $arrayArbol[$i]['jerarquia'] = $jConsulta;
//                        $arrayArbol[$i]['nivel'] = 4;
//                        $i++;
//                        $c++;
//
//                        // echo "mes";
//                    } else {
                    $jConsulta = $jaño . str_pad($c, 2, "0", STR_PAD_LEFT);
                    $arrayArbol[$i]['id'] = $id;
                    $arrayArbol[$i]['titulo'] = $consulta;
                    $arrayArbol[$i]['jerarquia'] = $jConsulta;
                    $arrayArbol[$i]['nivel'] = 3;
                    $i++;
                    $c++;
//                    }
                }
            }
            $actividadAux = $actividad;
            $añoaux = $año;
            $mesaux = $mes;
        }
        //print_r($arrayArbol);
        return $arrayArbol;
    }

    public function arbolHCItems() {
        $o_DActoMedico = new DActoMedico();
        $titulo = array(1 => "Historia Medica", 2 => "Motivo de Consulta", 3 => "Antecedentes", 4 => "Exámenes Médicos", 5 => "Diagnóstico", 6 => "Medicamentos", 7 => "Practicas Médicas", 8 => "Laboratorio", 9 => "Odontograma");
        $arrayArbol = array();
        for ($i = 1; $i < count($titulo) + 1; $i++) {
            $arrayArbol[$i]['id'] = $i;
            $arrayArbol[$i]['titulo'] = utf8_decode($titulo[$i]);
            if ($i == 1) {
                $arrayArbol[$i]['jerarquia'] = "01";
                $arrayArbol[$i]['nivel'] = 0;
            } else if ($i > 1 and $i < 10) {
                $arrayArbol[$i]['jerarquia'] = "010" . $i;
                $arrayArbol[$i]['nivel'] = 1;
            }
        }
        return $arrayArbol;
    }

    public function triaje($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $datos = array();
        $datos["codigoProgramacion"] = $idProgramacion;
        $resultado = $o_DActoMedico->getArrayDatosTriaje($datos);
        return $resultado;
    }

    public function historiaMotivoConsulta($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->historiaMotivoConsulta($idProgramacion);
        return $resultado;
    }

    public function obtenerCodigoPaciente($idpersona) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->obtenerCodigoPaciente($idpersona);
        return $resultado;
    }

    public function cargarTablaLaboratorio($codPersona, $opcion) {
        $o_DActoMedico = new DActoMedico();
        $datos = $o_DActoMedico->cargarTablaLaboratorio($codPersona, $opcion);
        $resultado = array();
        foreach ($datos as $i => $value) {
            $resultado[$i][0] = $datos[$i][0];
            $resultado[$i][1] = $datos[$i][1];
            $resultado[$i][2] = $datos[$i][2] . " " . $datos[$i][3] . " " . $datos[$i][4];
            $resultado[$i][3] = $datos[$i][5];  //idregd
            $resultado[$i][4] = $datos[$i][6];  //idreg
            $resultado[$i][5] = $datos[$i][7];  //idresult
            $resultado[$i][6] = $datos[$i][8];  //c_cod_per
        }
        return $resultado;
    }

    public function detalleLaboratorio($idReult) {
        $o_DActoMedico = new DActoMedico();
        $datos = $o_DActoMedico->detalleLaboratorio($idReult);
        $resultado = array();
        foreach ($datos as $i => $value) {
            $resultado[$i][0] = $datos[$i][0];
            $resultado[$i][1] = $datos[$i][1];
            $resultado[$i][2] = $datos[$i][2];
            $resultado[$i][3] = $datos[$i][3];
            $rangoRef = $datos[$i][4]; //modificar <&lt; >&gt;
            $rangoRef = str_replace("<", "&lt;", $rangoRef);
            $rangoRef = str_replace(">", "&gt;", $rangoRef);
            $resultado[$i][4] = $rangoRef;
            $resultado[$i][5] = $datos[$i][6]; //tipo
            $resultado[$i][6] = $datos[$i][7]; //orden
        }
        return $resultado;
    }

    public function historiaAntecedentes($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->historiaAntecedentes($idProgramacion);
        return $resultado;
    }

    public function historiaDiagnostico($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->historiaDiagnostico($idProgramacion);
        return $resultado;
    }

    public function hstrDiagnostico($idPaciente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->hstrDiagnostico($idPaciente);
        return $resultado;
    }

    public function hstrAntecedentes($idPaciente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->hstrAntecedentes($idPaciente);
        return $resultado;
    }

    public function hstrMotivoConsulta($idPaciente) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->hstrMotivoConsulta($idPaciente);
        return $resultado;
    }

    public function hstrTratamiento($idPaciente, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->hstrTratamiento($idPaciente, $hacer);
        foreach ($resultado as $ind => $valor) {
            if (empty($valor["c_cod_ser_pro"])) {
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $resultado[$ind]["v_desc_ser_pro"] = $arreglo[0];
                $resultado[$ind][2] = $arreglo[0];
                $resultado[$ind]["descri"] = $arreglo[1];
                $resultado[$ind][5] = $arreglo[1];
                $resultado[$ind]["icantidad"] = $arreglo[2];
                $resultado[$ind][3] = $arreglo[2];
                $resultado[$ind]["vModoAplicacion"] = $arreglo[3];
                $resultado[$ind][4] = $arreglo[3];
            }
        }
        return $resultado;
    }

    public function listaExamenesHC($idProgramacion, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaExamenesHC($idProgramacion, $hacer);
        return $resultado;
    }

    public function atencionMedico($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->atencionMedico($idProgramacion);
        return $resultado;
    }

    public function spListaDetalleCita($idProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->spListaDetalleCita($idProgramacion);
        return $resultado;
    }

    public function valoresCampos($idProgramacion, $idExamen) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->valoresCampos($idProgramacion, $idExamen);
        return $resultado;
    }

    /* public function historiaTratamientos($idProgramacion,$hacer) {
      $o_DActoMedico = new DActoMedico();
      $resultado = $o_DActoMedico->historiaTratamientos($idProgramacion,$hacer);
      foreach($resultado as $ind=>$valor) {
      if(empty($valor["c_cod_ser_pro"])){
      $arreglo = explode("|",$valor["vModoAplicacion"]);
      $resultado[$ind]["v_desc_ser_pro"] = $arreglo[0];
      $resultado[$ind][2] = $arreglo[0];
      $resultado[$ind]["descri"] = $arreglo[1];
      $resultado[$ind][5] = $arreglo[1];
      $resultado[$ind]["icantidad"] = $arreglo[2];
      $resultado[$ind][3] = $arreglo[2];
      $resultado[$ind]["vModoAplicacion"] = $arreglo[3];
      $resultado[$ind][4] = $arreglo[3];
      }
      }
      return $resultado;
      } */

    public function listaHistoriaTratamientoMedicamentoso($idProgramacion, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->historiaTratamientos($idProgramacion, $hacer);
        foreach ($resultado as $ind => $valor) {
            if (empty($valor["c_cod_ser_pro"])) {//Si c_cod_ser_pro is null es OTRO
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $resultado[$ind]["v_desc_ser_pro"] = $arreglo[0];
                $resultado[$ind][2] = $arreglo[0];
                $resultado[$ind]["descri"] = $arreglo[1];
                $resultado[$ind][5] = $arreglo[1];
                $resultado[$ind]["icantidad"] = $valor["icantidad"];
                $resultado[$ind][3] = $valor["icantidad"];
                $resultado[$ind]["vModoAplicacion"] = $arreglo[2];
                $resultado[$ind][4] = $arreglo[2];
            }
        }
        return $resultado;
    }

    public function listaHistoriaTratamientoSgtCita($idProgramacion, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->historiaTratamientos($idProgramacion, $hacer);
        foreach ($resultado as $ind => $valor) {
            if (empty($valor["c_cod_ser_pro"])) {//Si c_cod_ser_pro is null es OTRO
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $resultado[$ind]["v_desc_ser_pro"] = $arreglo[0];
                $resultado[$ind][2] = $arreglo[0];
                $resultado[$ind]["descri"] = $arreglo[1];
                $resultado[$ind][5] = $arreglo[1];
                //$resultado[$ind]["icantidad"] = $arreglo[2];
                //$resultado[$ind][3] = $arreglo[2];
                //$resultado[$ind]["vModoAplicacion"] = $arreglo[3];
                //$resultado[$ind][4] = $arreglo[3];
            }
        }
        return $resultado;
    }

    public function valorComboExamen($iCombo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->valorComboExamen($iCombo);
        return $resultado;
    }

    //////////fin de funciones de giancarlo
    //////////funciones de luis////////////////////////////////////////////////
    public function atencionInmediataActoMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->atencionInmediataActoMedico($datos);
        return $resultado;
    }

    public function listaProductosMedicamentosos($datos, $accion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayProductosMedicamentosos($datos, $accion);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/monedas.jpg ^ Precio";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/window_new.png ^ Agregar";
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
            $j++;
        }
        return $resultado;
    }

    function agregarMedicamentoRecetaMedicaHC($datos) {
//            <input type=\"text\" id=\"htxtcodigoMedicamento".$datos["numerodiv"]."\" name=\"htxtcodigoMedicamento\" value=\"".$datos["codigomedicamento"]."\" />"
        require_once '../../cvista/actomedico/recetaMedicaMultiple.php';
    }

    public function lCargarCuerpoHC($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dCargarCuerpoHC($datos);
        return $resultado;
    }

    public function eliminarMedicamentoRecetaMedicaHC($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->deleteMedicamentoRecetaMedicaHC($datos);
        return $resultado;
    }

    public function lPreguardarRectaMedica($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dPreguardarRectaMedica($datos);
        return $resultado;
    }

    public function obtenerDatosFiliacionActoMedico($datos) {
        $o_DActoMedico = new DActoMedico();
        $o_LPersonas = new LPersona();
        $resultado = $o_DActoMedico->getDatosFiliacionActoMedico($datos);
        $resultadoArray = array();
        foreach ($resultado[0] as $ind => $valor) {
            $resultadoArray[$ind] = $valor;
        }
        if ($resultadoArray["edad"]=='sindata'){
             $resultadoArray["edad"] = '-';
        }else {
          $resultadoArray["edad"] = $o_LPersonas->formatoEdadActoMedico($resultadoArray["edad"]);
        }
        
        return $resultadoArray;
    }

    public function obtenerFechaVencimientoRecetaMedica($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getFechaVencimientoRecetaMedica($datos);
        return $resultado[0]["fechavencimientoreceta"];
    }

    public function listaPracticasMedicas($datos, $accion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayPracticasMedicas($datos, $accion);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/monedas.jpg ^ Precio";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/window_new.png ^ Agregar";
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
            $j++;
        }
        return $resultado;
    }

    function listapreciosProductosServicios($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArraypreciosProductosServicios($datos);
        return $resultado;
    }
    
    function actualizarPaquetesPersona($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DActualizarGrupoEtareoPersonaConfirmado($datos);
        return $resultado;
    }
    function agregarPracticaMedicaHC($datos) {
        $o_DActoMedico = new DActoMedico();
        $bPaquete = $o_DActoMedico->DestadoPaquete($datos["idtratamiento"]);
        
        require_once '../../cvista/actomedico/practicamedica.php';
    }

    function preGrabarTratamientoMedicamentoso($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->preGrabarTratamientoMedicamentoso($datos);
        return $resultado;
    }

    function preguardarFechaVencimientoReceta($datos) {
        $o_DActoMedico = new DActoMedico();
        $arreglo = explode("/", $datos["txtfechavencimiento"]);
        $datos["txtfechavencimiento"] = $arreglo[2] . $arreglo[1] . $arreglo[0];
        $resultado = $o_DActoMedico->preguardarFechaVencimientoReceta($datos);
    }

    function preGrabarTratatamientoPracticaMedica($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->preGrabarTratatamientoPracticaMedica($datos);
        return $resultado;
    }

    function cargaTratamientosMedicamentososPreguardados($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargaTratamientosMedicamentososPreguardados($datos);
        $cadena = "";
        $data = "";
        $i = 0;
        $numeroRecetas = 0;
        $idRecetaAux = 0;
        $cantidadpreguardados = count($resultado);
        foreach ($resultado as $ind => $valor) {
            //Esto es para el caso de los otros medicamentos guardados
//            if (empty($valor["c_cod_ser_pro"])) {
//                $arreglo = explode("|", $valor["vModoAplicacion"]);
//                $valor["c_cod_ser_pro"] = '0000000';
//                $valor["v_desc_ser_pro"] = $arreglo[0];
//                $valor["descri"] = $arreglo[1]; //Tabletas, mililitro, gramos
//                $valor["icantidad"] = $arreglo[2];
//                $valor["vModoAplicacion"] = $arreglo[3]; //Modo de aplicacion del medicamento
//            }
            $idReceta = $valor["iIdReceta"];
            if ($idRecetaAux == $idReceta) {
                
            } else {
                $numeroRecetas++;
                $idRecetaAux = $idReceta;
            }
            $data = "";
            $data.=$numeroRecetas . "|";
            $data.=$valor["v_desc_ser_pro"] . "|";
            $data.=$valor["c_cod_ser_pro"] . "|";
            $data.=$valor["descri"] . "|"; //Tabletas, mililitro, gramos
            //$data.=utf8_encode($valor["v_desc_ser_pro"])."|";
            $data.=$valor["iIdReceta"] . "|";
            $data.=$valor["idTratamiento"] . "|";
            $data.=$valor["icantidad"] . "|";
            $data.=$valor["vModoAplicacion"] . "|";
            $data.=$valor["fechaVencimiento"] . "|";
            $cadena.="agregarMedicamentoHC('','','$data');";
            $i++;
        }

        return utf8_encode($cadena);
    }

    function lDuplicarReceta($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dDuplicarReceta($datos);
        $cadena = "";
        $data = "";
        $i = 0;
        $numeroRecetas = $datos['numeroReceta'];
        $idRecetaAux = 0;
        $cantidadpreguardados = count($resultado);
        foreach ($resultado as $ind => $valor) {
            $idReceta = $valor["iIdReceta"];
            if ($idRecetaAux == $idReceta) {
                
            } else {
                $numeroRecetas++;
                $idRecetaAux = $idReceta;
            }
            $data = "";
            $data.=$numeroRecetas . "|";
            $data.=$valor["v_desc_ser_pro"] . "|";
            $data.=$valor["c_cod_ser_pro"] . "|";
            $data.=$valor["descri"] . "|"; //Tabletas, mililitro, gramos
            //$data.=utf8_encode($valor["v_desc_ser_pro"])."|";
            $data.=$valor["iIdReceta"] . "|";
            $data.=$valor["idTratamiento"] . "|";
            $data.=$valor["icantidad"] . "|";
            $data.=$valor["vModoAplicacion"] . "|";
            $data.=$valor["fechaVencimiento"] . "|";
            $cadena.="agregarMedicamentoHC('','','$data');";
            $i++;
        }

        return utf8_encode($cadena);
    }

    function lCadenaRecetas($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dCadenaRecetas($datos);
        $cadena = "";
        $data = "";
        $i = 0;

        $cantidadRecetas = count($resultado);
        foreach ($resultado as $ind => $valor) {



            $data.=$valor[0] . "*" . $valor[1] . "*" . $valor[2] . "|";

            $i++;
        }

        return ($data);
    }

    function cargaTratamientosPracticasMedicasPreguardados($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargaTratamientosPracticasMedicasPreguardados($datos);
        $cadena = "";
        $data = "";
        foreach ($resultado as $ind => $valor) {
            //Esto es el caso para los otros
            if (empty($valor["c_cod_ser_pro"])) {
                $arreglo = explode("|", $valor["vModoAplicacion"]);
                $valor["c_cod_ser_pro"] = '0000000';
                $valor["v_desc_ser_pro"] = $arreglo[0];
                $valor["vModoAplicacion"] = $arreglo[1];
            }
            $data = "";
            $data.=$valor["idTratamiento"] . "|";
            $data.=$valor["c_cod_ser_pro"] . "|";
            $data.=base64_encode(utf8_encode($valor["v_desc_ser_pro"])) . "|"; //Esto falta codificar en Base 64
            $data.=base64_encode(utf8_encode($valor["vModoAplicacion"])) . "|";
            $data.=$valor["idEstadoRegistro"] . "|";
            $data.=$valor["codigosegus"];
            //$data.=base64_encode($data);
            $cadena.="agregarPracticaMedicaHC('','','$data');";
        }
        return $cadena;
    }

    function cargaTratamientosAnteriores($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayTratamientosAnteriores($datos);
        $j = 0;
        foreach ($resultado as $ind => $fila) {
            if (empty($fila["medicamento"])) {
                $arreglo = explode("|", $fila["vModoAplicacion"]);
                $resultado[$ind][4] = $arreglo[0];
                $resultado[$ind]["medicamento"] = $arreglo[0];
            }
            $imagen1 = "../../../../fastmedical_front/imagen/icono/display.png ^ Ver";
            array_push($resultado[$j], $imagen1);
            $j++;
        }
        return $resultado;
    }

    function obtenerDatosTratamientoAnterior($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayTratamientoAnterior($datos);
        $resultadoArray = array();
        foreach ($resultado as $ind => $valor) {
            $resultadoArray = $valor;
        }
        return $resultadoArray;
    }

    function agregarDiagnosticoHC($datos) {
        require_once '../../cvista/actomedico/diagnostico.php';
    }

    function agregarDiagnosticoPreguardadoHC($datos) {
        require_once '../../cvista/actomedico/diagnosticoPreguardado.php';
    }

    function agregarOtroSintoma($nombreSintoma, $accion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->spListaSintomas($nombreSintoma, $accion);
        return $resultado;
    }

    function agregarOtroDiagnosticoHC() {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayagregarOtroDiagnostico();
        return $resultado;
    }

    function comboDosificacion($nombre) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArrayDosificacion();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    function comboTipoIngreso($nombre) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArrayTipoIngreso();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    public function comboTipoDiagnostico($nombre) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArrayTipoDiagnostico();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    public function comboDestinoCitaEssalud($nombre) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArrayDestinoCitaEssalud();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    public function comboTipoCitaEssalud($nombre) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->getArrayTipoCitaEssalud();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    public function numeroSesionEssalud($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->numeroSesionEssalud($datos);
        return $resultado;
    }

    public function lAfiliacionCorrecta($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dAfiliacionCorrecta($datos);
        return $resultado;
    }

    public function preGrabarDiagnostico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->preGrabarDiagnostico($datos);
        return $resultado;
    }

    public function eliminarDiagnostico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminarDiagnostico($datos);
        return $resultado;
    }

    public function cargaDiagnosticosPreguardados($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargaDiagnosticosPreguardados($datos);
        $cadena = "";
        $data = "";
        foreach ($resultado as $ind => $valor) {
            $data = "";
            $data.=$valor["idCie"] . "|";
            $data.=$valor["cCodigoEnfermedad"] . "|";
            $data.=utf8_encode($valor["vDescripcion"]) . "|";
            $data.=$valor["idTipoDiagnostico"] . "|";
            $data.=$valor["idcDiagnostico"] . "|";
            $data.=$valor["vObservacion"] . "|";
            $data.=$valor["idCondicionIngreso"];

            $cadena.="agregarDiagnosticoPreguardadoHC('','','$data');"; //$cadena.="agregarDiagnosticoHC('','','$data');";
        }
        return $cadena;
    }

    public function cargaDiagnosticosAnteriores($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayDiagnosticosAnteriores($datos);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen1 = "../../../../fastmedical_front/imagen/icono/display.png ^ Ver";
            array_push($resultado[$j], $imagen1);
            $j++;
        }
        return $resultado;
    }

    public function obtenerDatosDiagnosticoAnterior($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayDiagnosticoAnterior($datos);
        $resultadoArray = array();
        foreach ($resultado as $ind => $valor) {
            $resultadoArray = $valor;
        }
        return $resultadoArray;
    }

    function cargaDiagnosticoAnteriorPopUp($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->getArrayDiagnosticoAnteriorPopUp($datos);
        return $resultado;
    }

    function lTablaProcedimientoOdontologico($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dTablaProcedimientoOdontologico($datos);
        ;
        return $resultado;
    }

    function lPosicionSimbolo($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dPosicionSimbolo($datos);

        return $resultado;
    }

    function lPosicionSimboloDoble($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dPosicionSimboloDoble($datos);

        return $resultado;
    }

    function guardarAtencionMedicaHC($datos) {
        $o_DActoMedico = new DActoMedico();
        $arreglo = explode("/", $datos["proximacitasugerida"]);
        $datos["proximacitasugerida"] = $arreglo[2] . $arreglo[1] . $arreglo[0];
        $resultado = $o_DActoMedico->guardarAtencionMedicaHC($datos);
        return $resultado[0]["respuesta"];
    }

    function cambiarEstadoNoAtendido($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cambiarEstadoNoAtendido($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }
    function  anularPago($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico-> anularPago($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }
    function  anularComprobantePago($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico-> anularComprobantePago($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }
   

    function lDesconfirmarCita($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dDesconfirmarCita($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }

    //////////fin de funciones de luis////////////////////////////////////////////////
    public function grabarPrueba($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->grabarPrueba($datos);
        return $resultado;
    }

    public function lPreguardarAntecedenteOdontograma($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dPreguardarAntecedenteOdontograma($datos);
        return $resultado;
    }

    public function cerrarAntecedenteOdontograma($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cerrarAntecedenteOdontograma($datos);
        return $resultado;
    }

    public function cambiaraEstadoImagenesVersionesAnteriores($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cambiaraEstadoImagenesVersionesAnteriores($datos);
        return $resultado;
    }

    public function cargarTablaAfiliaciones($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargarTablaAfiliaciones($datos);
        return $resultado;
    }

    public function grabarCombo($data) {
        $o_DActoMedico = new DActoMedico();
        $hacer = $data['hacer'];
        $idCombo = $data['idcombo'];
        $nombreCombo = $data['nomcombo'];
        $arrayTexto = $data['texto'];
        $arrayValue = $data['value'];
        //registrar combo
        $codGenerado = "";
        $resultado = $o_DActoMedico->grabarCombo($idCombo, $nombreCombo, $hacer);

        if ($hacer == "nuevo") {
            $indice = array_keys($arrayTexto);
            $codGenerado = $resultado[0][0];
            for ($k = 0; $k < count($arrayTexto); $k++) {
                $i = $indice[$k];
                $o_DActoMedico2 = new DActoMedico();
                $resultado = $o_DActoMedico2->grabarItemsCombo($codGenerado, "", $arrayTexto[$i], $arrayValue[$i], $hacer);
            }
        } else if ($hacer == "modificar") {
            $arrayIdValcombo = $data['idvalcombo'];
            $indiceEditados = array_keys($arrayIdValcombo);
            $tamanio = count($indiceEditados);
            for ($k = 0; $k < count($arrayTexto); $k++) {
                if ($k < $tamanio)
                    $p = $indiceEditados[$k];
                $i = $k + 1;
                if ($i == $p) { // aqui se modifica los valores del combo despues de haber editado
                    $o_DActoMedico = new DActoMedico();
                    $o_DActoMedico->grabarItemsCombo($idCombo, $arrayIdValcombo[$i], $arrayTexto[$i], $arrayValue[$i], $hacer);
                } else { // aqui se insertan los nuevos valores agregados del combo despues de haber editado
                    $o_DActoMedico = new DActoMedico();
                    $o_DActoMedico->grabarItemsCombo($idCombo, "", $arrayTexto[$i], $arrayValue[$i], 'nuevo');
                }
            }
        }
        return $codGenerado . "|";
    }

    public function grabarCampo($data, $hacer) {
        $idprueba = $data['idprueba'];
        $arrayIdCampo = $data['idcampo'];
        $arrayIdCombo = $data['idcombo'];
        $arrayTipoCampo = $data['tipocampo'];
        $arrayNombreCampo = $data['nombrecampo'];
        $arrayOrden = $data['orden'];
        $arrayObligatorio = $data['obligatorio'];
        $arrayEstado = $data['estado'];
        $resultado = "";
        //registrar campo
        // echo $arrayObligatorio;
        $indice = array_keys($arrayNombreCampo);
        for ($k = 0; $k < count($arrayNombreCampo); $k++) { //[$i]
            $o_DActoMedico = new DActoMedico();
            $i = $indice[$k];
            $resul = $o_DActoMedico->grabarCampo($idprueba, $arrayIdCampo[$i], $arrayIdCombo[$i], $arrayTipoCampo[$i], $arrayNombreCampo[$i], $arrayOrden[$i], $arrayEstado[$i], $arrayObligatorio[$i], $hacer);
        }
        return $resultado;
    }

    public function cargarTipoCampo() {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargarTipoCampo();
        return $resultado;
    }

    public function datosPruebas($hacer, $idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaPruebasDisponibles($hacer, $idversion);
        $resulx = array();
        foreach ($resultado as $k => $value) {
            $resulx[$k][0] = $resultado[$k][0];
            $resulx[$k][1] = $resultado[$k][1];
            $resulx[$k][2] = $resultado[$k][2];
            if ($resultado[$k][2] == 1) {
                $resulx[$k][3] = "Activado";
            } else if ($resultado[$k][2] == 0) {
                $resulx[$k][3] = "Desactivado";
            }
        }
        return $resulx;
    }

    public function listaPruebas($hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->listaPruebas($hacer, "");
        //$resulx = $this->arrayPrueba($resultado);
        $j = 0;
        foreach ($resultado as $fila) {
            //echo $resultado[$j][4];
            $Editar = "../../../../fastmedical_front/imagen/icono/edit2.png ^ Editar";
            array_push($resultado[$j], $Editar);

            if ($resultado[$j][4] == 1) {
                $Eliminar = "../../../../fastmedical_front/imagen/icono/cancel.png ^ Desactivar";
                array_push($resultado[$j], $Eliminar);
            } else {
                $Activar = "../../../../fastmedical_front/imagen/icono/agt_action_success.png ^ Activar";
                array_push($resultado[$j], $Activar);
            }
            $j++;
        }
        return $resultado;
    }

    public function buscarPrueba($nomPrueba) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->buscarPrueba($nomPrueba);
        $resulx = $this->arrayPrueba($resultado);
        return $resulx;
    }

    public function arrayPrueba($resultado) {
        $resulx = array();
        foreach ($resultado as $k => $value) {
            $resulx[$k][0] = $resultado[$k][0];
            $resulx[$k][1] = $resultado[$k][1];
            $resulx[$k][2] = $resultado[$k][2];
            $resulx[$k][3] = $resultado[$k][3];
            if ($resultado[$k][3] == 1) {
                $resulx[$k][4] = "Activado";
                $resulx[$k][6] = "../../../imagen/inicio/eliminar.gif ^ Desactivar";
            } else if ($resultado[$k][3] == 0) {
                $resulx[$k][4] = "Desactivado";
                $resulx[$k][6] = "../../../../fastmedical_front/imagen/icono/good.gif ^ Activar";
            }
            $resulx[$k][5] = "../../../../fastmedical_front/imagen/icono/editar.png ^ Agregar";
        }
        return $resulx;
    }

    public function act_desPrueba($idPrueba, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->act_desPrueba($idPrueba, $hacer);
        return $resultado;
    }

    public function act_desExamen($idExamen, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->act_desExamen($idExamen, $hacer);
        return $resultado;
    }

    public function act_desExamenPrueba($idExamenPrueba, $estado) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->act_desExamenPrueba($idExamenPrueba, $estado);
        return $resultado;
    }

    public function act_desExamenServicio($idExamenServicio, $estado) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->act_desExamenServicio($idExamenServicio, $estado);
        return $resultado;
    }

    public function editaCampos($idPrueba) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->editaCampos($idPrueba);
        return $resultado;
    }

    public function eliminarDbCampo($idCampo, $idCombo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminarDbCampo($idCampo, $idCombo);
        return $resultado;
    }

    public function editarCombo($idCombo, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->editarCombo($idCombo, $hacer);
        return $resultado;
    }

    public function eliminaDbCombo($idCombo, $idValcombo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminaDbCombo($idCombo, $idValcombo);
        return $resultado;
    }

    public function cargarTablaServicios($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cargarTablaServicios($datos);
        return $resultado;
    }

    /* public function pruebasNoAsignadas() {
      $o_DActoMedico = new DActoMedico();
      $resultado = $o_DActoMedico->pruebasNoAsignadas() ;
      return $resultado;



      /*  public function examenNoAsignado() {

      $o_DActoMedico = new DActoMedico();
      $resultado = $o_DActoMedico->examenNoAsignado() ;
      $ruta_archivo="../../../../carpetaDocumentos/arbol_examenesnoasignados";
      $this->factoryTreeActoMedico($resultado,$ruta_archivo);
      return $resultado;
      } */

    public function comboVersiones() {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->comboVersiones();
        return $resultado;
    }

    public function estadoDesarrollo($idversion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->estadoDesarrollo($idversion);
        return $resultado[0][0] . "|" . htmlentities($resultado[0][1]) . "|" . $resultado[0][2] . "|";
    }

    public function asignarExamenPrueba($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->asignarExamenPrueba($datos);
        return $resultado[0][0] . "|";
    }

    public function asignarExamenServicio($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->asignarExamenServicio($datos);
        return $resultado[0][0] . "|";
    }

    public function selectExamenPrueba($idExamen) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->selectExamenPrueba($idExamen);
        $tablaep = array();
        foreach ($resultado as $i => $value) {
            $tablaep[$i][0] = $resultado[$i][0];
            $tablaep[$i][1] = $resultado[$i][1];
            $tablaep[$i][2] = $resultado[$i][2];
            if ($resultado[$i][2] == 1) {
                $tablaep[$i][3] = "Activado";
            } else if ($resultado[$i][2] == 0) {
                $tablaep[$i][3] = "Desactivado";
            }
            $tablaep[$i][4] = "";
            $tablaep[$i][5] = $resultado[$i][3];
            $tablaep[$i][6] = $resultado[$i][4];
            $tablaep[$i][7] = $resultado[$i][5];
            if ($resultado[$i][5] == 1) {
                $tablaep[$i][8] = "Activado";
            } else if ($resultado[$i][5] == 0) {
                $tablaep[$i][8] = "Desactivado";
            }
            $tablaep[$i][9] = $resultado[$i][6];
            if ($resultado[$i][6] == 1) {
                $tablaep[$i][10] = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Desactivar";
            } else if ($resultado[$i][6] == 0) {
                $tablaep[$i][10] = "../../../../fastmedical_front/imagen/icono/good.gif ^ Activar";
            }
            $tablaep[$i][11] = $resultado[$i][7];
        }
        return $tablaep;
    }

    public function selectExamenServicio($idExamen) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->selectExamenServicio($idExamen);
        $tablaes = array();
        foreach ($resultado as $i => $value) {
            $tablaes[$i][0] = $resultado[$i][0];
            $tablaes[$i][1] = $resultado[$i][1];
            $tablaes[$i][2] = $resultado[$i][2];
            if ($resultado[$i][2] == 1) {
                $tablaes[$i][3] = "Activado";
            } else if ($resultado[$i][2] == 0) {
                $tablaes[$i][3] = "Desactivado";
            }
            $tablaes[$i][4] = "";
            $tablaes[$i][5] = $resultado[$i][3];
            $tablaes[$i][6] = $resultado[$i][4];
            $tablaes[$i][7] = $resultado[$i][5];
            if ($resultado[$i][5] == "1") {
                $tablaes[$i][8] = "Activado";
            } else if ($resultado[$i][5] == "0") {
                $tablaes[$i][8] = "Desactivado";
            }
            $tablaes[$i][9] = $resultado[$i][6];
            if ($resultado[$i][6] == 1) {
                $tablaes[$i][10] = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Desactivar";
            } else if ($resultado[$i][6] == 0) {
                $tablaes[$i][10] = "../../../../fastmedical_front/imagen/icono/good.gif ^ Activar";
            }
            $tablaes[$i][11] = $resultado[$i][7];
        }
        return $tablaes;
    }

    public function selectCombo() {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->selectCombo();
        return $resultado;
    }

    public function selectValorCombo($idCombo) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->selectValorCombo($idCombo);
        $paratabla = array();
        foreach ($resultado as $i => $value) {
            $paratabla[$i][0] = $resultado[$i][2];
            $paratabla[$i][1] = $resultado[$i][3];
        }
        return $paratabla;
    }

    /////////////////////////////////////////Funciones del PENDEX XD///////////////////////////////////////////
    public function spListaSintomas($nombreSintoma, $accion) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->spListaSintomas($nombreSintoma, $accion);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen = "../../../../fastmedical_front/imagen/icono/nuevo_item.png ^ Agregar";
            array_push($resultado[$j], $imagen);
            // $resultado[$j][2]=utf8_decode($resultado[$j][2]);
            $j++;
        }
        return $resultado;
    }

    //Datos de combo de condicion de ingreso
    public function getArrayCondicionDeIngreso($nomCondicionDeIngreso) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaCondicionDeIngreso($nomCondicionDeIngreso);
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $resultadoArray[$fila[0]] = htmlentities(trim($fila[1]));
        }
        return $resultadoArray;
    }

    /*
      public function getArrayClasificacionMotivoConsulta($nomClasificacionMotivoConsulta) {
      $o_DActoMedico = new DActoMedico();
      $rs = $o_DActoMedico->spListaClasificacionMotivoConsulta($nomClasificacionMotivoConsulta);
      $resultadoArray = array();

      foreach($rs as $fila) {
      $resultadoArray[$fila[0]]=htmlentities(trim($fila[1]));
      }
      return $resultadoArray;
      } */

    public function spManteMotivosDeConsulta($hacer, $estadoEnVista, $idMotivoConsulta, $idSintomaCie, $idEstadoRegistro, $descSintomaMotivoConsulta, $codProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spManteMotivosDeConsulta($hacer, $estadoEnVista, $idMotivoConsulta, $idSintomaCie, $idEstadoRegistro, $descSintomaMotivoConsulta, $codProgramacion);
        return $rs;
    }

    public function spEliminarMotivosDeConsulta($idMotivoConsulta) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spEliminarMotivosDeConsulta($idMotivoConsulta);
        return $rs;
    }

    public function spListaMotivoDeConsulta($accion, $codigoPaciente) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaMotivoDeConsulta($accion, $codigoPaciente);
        return $rs;
    }

    public function lObtenerPaquetesPersona($cod_per) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dObtenerPaquetesPersona($cod_per);
        return $rs;
    }

    public function spListaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo);

        foreach ($rs as $indice => $valor) {
            $arrayExamenMedico[$rs[$indice]['iIdExamen']] = $rs[$indice];
        }
        return $arrayExamenMedico;
    }

    public function lHistorialDiente($iCodigoProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dHistorialDiente($iCodigoProgramacion);
        return $rs;
    }

    public function spListaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $iCodigoProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $iCodigoProgramacion);
        foreach ($rs as $indice => $valor) {
            $arrayExamenPorServicio[$rs[$indice]['iIdExamen']] = $rs[$indice];
        }
        return $arrayExamenPorServicio;
    }

    public function spListaVersionExamenDeProduccion() {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaVersionExamenDeProduccion();
        return $rs;
    }

    public function lArregloDientes($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dArregloDientes($datos);
        return $rs;
    }

    public function lObtenerTipoDiagnostico($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dObtenerTipoDiagnostico($datos);
        return $rs;
    }

    public function lArregloCarasDientes($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dArregloCarasDientes($datos);
        return $rs;
    }

    public function AarrayImagenesSimbolos($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dArrayImagenesSimbolos($datos);
        return $rs;
    }

    public function lArraySimboloHistorial($c_cod_per) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dArraySimboloHistorial($c_cod_per);
        return $rs;
    }

    public function lHistoriaCara($c_cod_per) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->dHistoriaCara($c_cod_per);
        return $rs;
    }

    public function datosPersona($idPaciente, $hacer) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->datosPersona($idPaciente, $hacer);
        return $resultado;
    }

    public function spListaTipoDeServicio($nomTipoServicio) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->spListaTipoDeServicio($nomTipoServicio);
        //$fila[0]:iddtbl, $fila[1]:idtbl='0023', $fila[3]:descri
        foreach ($rs as $fila) {
            $combo[$fila[0]] = htmlentities(trim($fila[3]));
        }
        return $combo;
    }

    public function spListaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->spListaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio);
        $j = 0;
        foreach ($resultado as $fila) {
            $imagen = "../../../../fastmedical_front/imagen/icono/nuevo_item.png ^ Agregar";
            array_push($resultado[$j], $imagen);
            $j++;
        }
        return $resultado;
    }

    ///////////////////////////////////////Fin Funciones del PENDEX XD////////////////////////////////////////

    public function factoryTreeActoMedico($resultado, $ruta_archivo) {
        //$array--> arreglo de datos para generar el arbol
        //$ruta_archivo--> Es la ruta mas el nombre del archivo sin extencion(xml) que se quiere generar ejemplo "../../../../carpetaDocumentos/arbol_manuales"
        $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $cadena.="<tree id=\"0\" radio=\"1\">\n";
        $codAnterior = '';
        $contador = 0;
        $nivel;
        foreach ($resultado as $rs => $valor) {
            if ($codAnterior == '') {
                $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                $codAnterior = strlen(trim($resultado[$rs]["jerarquia"]));
                $contador = $contador + 1;
                $nivelAnterior = $resultado[$rs]["nivel"];
            } else {
                //verificar si el anterior era de mas nivel
                if ($codAnterior < strlen(trim($resultado[$rs]["jerarquia"]))) {
                    $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"]));
                    $nivelAnterior = $resultado[$rs]["nivel"];
                    $contador = $contador + 1;
                } else {
                    if ($codAnterior > strlen(trim($resultado[$rs]["jerarquia"]))) {
                        $numCierre = $nivelAnterior - $resultado[$rs]["nivel"] + 1;
                        $contador = $contador - $numCierre + 1;
                        while ($numCierre > 0) {
                            $cadena.="</item>\n";
                            $numCierre = $numCierre - 1;
                        }
                    } else {
                        $cadena.="</item>\n";
                    }
                    $cadena.="<item text=\"" . trim($resultado[$rs]["titulo"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["id"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["jerarquia"])); //guardo la longitud de su codjerarquico
                }
            }
        }
        for ($i = 0; $i < $contador; $i++) {
            $cadena.="</item>\n";
        }

        $cadena.="\n</tree>";
//        $archivo=basename($ruta_archivo);
        $archivo = $ruta_archivo;
        $archivo.=".xml";
        $contenido2 = $cadena;
        $ft = fopen($archivo, "w");
        fwrite($ft, $contenido2);
        fclose($ft);
    }

    /* TRIAJE */

    public function listarDatosTriaje($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->getArrayDatosTriaje($datos);
        $resultadoArray = array();
        foreach ($respuesta[0] as $indice => $valor) {
            $resultadoArray[$indice] = $valor;
        }
        return $resultadoArray;
    }

    function obtenerlistaAsignadas($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->obtenerlistaAsignadas($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function LlistarAfiliacion() {
        $o_DActoMedico = new DActoMedico();
        $respuestaAfiliacion = $o_DActoMedico->DlistarAfiliacion();
        return $respuestaAfiliacion;
    }

    public function LcargarTablaGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaGrupoEtario = $o_DActoMedico->DcargarTablaGrupoEtario($datos);

        foreach ($respuestaGrupoEtario as $k => $value) {
            if ($value[2] == 0) {
                $respuestaGrupoEtario[$k][2] = 'F';
            } else {
                $respuestaGrupoEtario[$k][2] = 'M';
            }
        }

        return $respuestaGrupoEtario;
    }

    public function LcargarTablaServicioGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaServicio = $o_DActoMedico->DcargarTablaServicioGrupoEtario($datos);
        return $respuestaServicio;
    }

    public function LserviciosSeleccionadoPorGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaServicio = $o_DActoMedico->DserviciosSeleccionadoPorGrupoEtario($datos);

        if (count($respuestaServicio) > 1) {
            foreach ($respuestaServicio as $k => $value) {
                // ../../../../fastmedical_front/imagen/icono/blank.gif
                $respuestaServicio[$k][8] = "../../../../fastmedical_front/imagen/icono/agt_upgrade_misc.png ^ Abajo";
                if ($k == 0) {
                    $respuestaServicio[$k][9] = "../../../../fastmedical_front/imagen/icono/blank.gif ^ null";
                } else {
                    $respuestaServicio[$k][9] = "../../../../fastmedical_front/imagen/icono/arribaFecha.png ^ Arriba";
                }

                $respuestaServicio[$k][10] = "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png ^ Eliminar";
                $respuestaServicio[$k][12] = "../../../../fastmedical_front/imagen/icono/editar.png ^ Eliminar";
            }
        } else {
            if (count($respuestaServicio) == 1) {
                $respuestaServicio[0][9] = "../../../../fastmedical_front/imagen/icono/blank.gif ^ null";
                $respuestaServicio[0][8] = "../../../../fastmedical_front/imagen/icono/blank.gif ^ null";
                $respuestaServicio[0][10] = "../../../../fastmedical_front/imagen/icono/i_icq_dnd.png ^ Eliminar";
                $respuestaServicio[0][12] = "../../../../fastmedical_front/imagen/icono/editar.png ^ Eliminar";
            }
        }


        return $respuestaServicio;
    }

//----------------------------------------------------------------------------------------   
//----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------


    function LCargarTablaMxserpro($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DCargarTablaMxserpro($datos);
        return $resultado;
    }

    function LbuscarTablaCPT($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DbuscarTablaCPT($datos);
        return $resultado;
    }

    function LbuscarCPTcod($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DbuscarCPTcod($datos);
        return $resultado;
    }

    public function LguardarRegistroServicio($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DguardarRegistroServicio($datos);
        return $resultado;
    }

    function LbuscarMxSerProcod($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DbuscarMxSerProcod($datos);
        return $resultado;
    }

    function cambiarEstadoServicioRelacionado($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->cambiarEstadoServicioRelacionado($datos);
        return $resultado;
    }

    function LexamenesRelacionados($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DexamenesRelacionados($datos);
        $j = 0;
        foreach ($resultado as $fila) {
            if ($fila[4] == 1) {
                $imagen = "../../../../fastmedical_front/imagen/icono/button_cancel.png ^ Desactivar";
            } else {
                $imagen = "../../../../fastmedical_front/imagen/icono/button_ok.png ^ Activar";
            }
            array_push($resultado[$j], $imagen);
            $j++;
        }
        return $resultado;
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

    public function LlistarPeriodoEdad() {
        $o_DActoMedico = new DActoMedico();
        $respuestaServicio = $o_DActoMedico->DlistarPeriodoEdad();
        return $respuestaServicio;
    }

    public function LlistarTipoServicioCPT() {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DlistarTipoServicioCPT();
        return $respuestaTipoServicioCPT;
    }

    public function LguardarServicioGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DguardarServicioGrupoEtario($datos);
        return $respuestaTipoServicioCPT;
    }

    public function LiOrderMax($iIdGrupoEtario) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DLiOrderMax($iIdGrupoEtario);
        return $respuestaTipoServicioCPT;
    }

    function obtenerlistaANoAsignadas($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->obtenerlistaANoAsignadas($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function LeliminarseleccionarServicioGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->DeliminarseleccionarServicioGrupoEtario($datos);


        return $rs;
    }

    public function LCarteraobtenerEdadPersona($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->DCarteraobtenerEdadPersona($datos);
//        foreach ($rs as $key => $value) {
//            $rs[$key][4] = utf8_encode(utf$rs[$key][4]);
//        }
        return $rs;
    }

    public function LcargarServiciosDuplicados($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DcargarServiciosDuplicados($datos);
        return $respuestaTipoServicioCPT;
    }

    public function LactualizarEstadoDeServicioGrupoEtarioPersona($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DactualizarEstadoDeServicioGrupoEtarioPersona($datos);
        return $respuestaTipoServicioCPT;
    }

    public function verificarCantidadVersionImagenXHistoriaDiente($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->verificarCantidadVersionImagenXHistoriaDiente($datos);
        return $respuesta;
    }

    public function grabarImagenHistoriaDiente($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->grabarImagenHistoriaDiente($datos);
        return $respuesta;
    }

    public function updateObsHistoriaDiente($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->updateObsHistoriaDiente($datos);
        return $respuesta;
    }

    public function updateCarasDiente($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->updateCarasDiente($datos);
        return $respuesta;
    }

    public function comboFechaAtenciones($c_cod_per) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->comboFechaAtenciones($c_cod_per);
        return $respuesta;
    }

    public function comboDientesAtenciones($c_cod_per) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->comboDientesAtenciones($c_cod_per);
        return $respuesta;
    }

    public function lVerificarPaqueteEtareo($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dVerificarPaqueteEtareo($datos);
        return $respuesta;
    }

    public function lCargarPaqueteDiagnostico($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dCargarPaqueteDiagnostico($datos);
        return $respuesta;
    }

    public function listarHistoriaOdontogramaxPersona($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listarHistoriaOdontogramaxPersona($datos);
        return $respuesta;
    }

    public function listadoHistoriaDiente($idPrograma) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listadoHistoriaDiente($idPrograma);
        return $respuesta;
    }

    public function listaImagenesOdontograma($idPrograma) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dListaImagenesOdontograma($idPrograma);
        return $respuesta;
    }

    public function LmostrarLeyenda($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DmostrarLeyenda($datos);
        return $resultado;
    }

    public function LhistoriaLeyenda($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->DhistoriaLeyenda($datos);
        return $resultado;
    }

    function obtenerlistaAsignadasAFiliacion($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->obtenerlistaAsignadasAFiliacion($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function obtenerlistaANoAsignadasAfiliacion($datos) {
        $o_DActoMedico = new DActoMedico();
        $rs = $o_DActoMedico->obtenerlistaANoAsignadasAfiliacion($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function eliminarAnterioresSeleccionadosAfiliaciones($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->eliminarAnterioresSeleccionadosAfiliaciones($datos);
        return $resultado;
    }

    function guardarNuevaSeleccionAfiliaciones($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->guardarNuevaSeleccionAfiliaciones($datos);
        return $resultado;
    }

    function arrayDatosConsultaCitaHistoria($datos) {
        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->arrayDatosConsultaCitaHistoria($datos);
        return $resultado;
    }

    function lCargarTablaProcedientosConsulta($resultadoDatos) {

        $o_DActoMedico = new DActoMedico();
        $resultado = $o_DActoMedico->dCargarTablaProcedientosConsulta($resultadoDatos);
        return $resultado;
    }

    //-------------------------------------------------------------------
    public function LmodificarServicioGrupoEtario($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DmodificarServicioGrupoEtario($datos);
        return $respuestaTipoServicioCPT;
    }

    public function LactualizarEstadoObligatorio($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuestaTipoServicioCPT = $o_DActoMedico->DactualizarEstadoObligatorio($datos);
        return $respuestaTipoServicioCPT;
    }

    public function datospaciente($iProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->datospaciente($iProgramacion);
        return $respuesta;
    }

    public function listaAtencionespapanicolaum($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->listaAtencionespapanicolaum($datos);
        return $respuesta;
    }

    public function datospacientePapanicolaum($c_cod_per) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->datospacientePapanicolaum($c_cod_per);
        return $respuesta;
    }

    public function resultadoLaboratorio($idResultado) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->resultadoLaboratorio($idResultado);
        return $respuesta;
    }

    public function grupoEtareoPersona($iProgramacion) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->grupoEtareoPersona($iProgramacion);
        return $respuesta;
    }

    public function proximaCitaSugeridaArray($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->proximaCitaSugeridaArray($datos);
        return $respuesta;
    }
      public function lProcedimientosCitaReporte($idPrograma) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dProcedimientosCitaReporte($idPrograma);
        return $respuesta;
    }
    
      public function lFirmaMedico($idPrograma) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dFirmaMedico($idPrograma);
        return $respuesta;
    }
    
    
     public function nsmModulosPorAfiliacion($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->nsmModulosPorAfiliacion($datos);
        return $respuesta;
    }
    
      public function nsmModulosporServicio($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->nsmModulosporServicio($datos);
        return $respuesta;
    }
     public function aCargarDatosPareElGraficoHistoriaTriaje($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->aCargarDatosPareElGraficoHistoriaTriaje($datos);
        return $respuesta;
    }
     public function lInsertaActualizaSintomatico($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dInsertaActualizaSintomatico($datos);
        return $respuesta;
    }
    public function lActualizarNumeroDiasSintomatico($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dActualizarNumeroDiasSintomatico($datos);
        return $respuesta;
    }
    public function lListarSintomaticos($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dListarSintomaticos($datos);
        return $respuesta;
    }
     public function lGenerarSintomaticoRespiratorio($datos) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->dGenerarSintomaticoRespiratorio($datos);
        return $respuesta;
    }
  
     public function lstListarNumeroIFExistePlaca($idPrograma) {
        $o_DActoMedico = new DActoMedico();
        $respuesta = $o_DActoMedico->lstListarNumeroIFExistePlaca($idPrograma);
        return $respuesta;
    }
  
    
    

}

?>
