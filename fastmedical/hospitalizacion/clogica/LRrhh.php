<?php

require_once ("../../cdatos/DRrhh.php");
require_once ("../../cdatos/DMantenimientoGeneral.php");

class LRrhh {

    public function datosPersonal($codigoPersona, $parametro) {
        $o_DRrhh = new DRrhh();
        $auxp = '05';
        if ($parametro == '01') {
            $auxp = '07';
        }
        if ($parametro == '02') {
            $auxp = '05';
        }

        $rs = $o_DRrhh->getArrayDatosPersonal($codigoPersona, $auxp);

        return $rs;
    }

    public function seleccionarCategoria() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarCategoria();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function comboModalidadContrato() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->listaModalidadContrato();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function comboTipoSueldo() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->listaTipoSueldo();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function comboTipoProgramacion() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->listaTipoProgramacion();
        $resultadoArray = array();

        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function categoriaPuesto() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarCategoria();
        return $rs;
    }

    public function getListaPuestos($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getListaPuestos($datos);
        return $resultado;
    }

    public function getListaPuestosConcatenado($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getListaPuestosConcatenado($datos);
        $i = 0;
        foreach ($rs as $ind => $valor) {
            $rs[$i]["0"] = htmlentities($rs[$i]["0"]);
            $rs[$i]["parametro"] = htmlentities($rs[$i]["parametro"]);
//            foreach($valor as $ind2 => $valor2){
//                $resultado[$ind][$ind2] = utf8_encode($valor2);
//            }
            $i++;
        }
        return $rs;
    }

    public function detallePuestoCentroCosto($id) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->detallePuestoCentroCosto($id);
        return $rs;
    }

    public function lcargarTablaContratos($iCodigoEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dcargarTablaContratos($iCodigoEmpleado);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/xcf.png ^ Descansos");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar");
        }
        return $rs;
    }

    public function lcargarTablaAreaPuestoEmpleado($idPuestoEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dcargarTablaAreaPuestoEmpleado($idPuestoEmpleado);
        foreach ($rs as $key => $value) {
            if ($value[3] == 0) {
                array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/Thumb Up.png ^ Aplicar");
            } else {
                array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/agt_action_fail.png ^ Eliminar");
            }
        }
        return $rs;
    }

    public function grabarDetallePuesto($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarDetallePuesto($datos);
        return $rs;
    }

    //jcqa 12 Abril 2012 4:30pm
    public function grabarDetallePuestoaCentroCosto($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarDetallePuestoaCentroCosto($datos);
        return $rs;
    }

    public function seleccionarCentroCostoPuesto($id) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarCentroCostoPuesto($id);
        $centrocosto = $rs[0][0] . " - " . $rs[0][1];
        return $centrocosto;
    }

    public function seleccionarCentroCostoPuestoDelArbol($id) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarCentroCostoPuestoDelArbol($id);
        $centrocosto = $rs[0][0] . " - " . $rs[0][1];
        return $centrocosto;
    }

    /*     * **************************** REGISTRO DE NUEVO PERSONAL ***************************************** */
    /* ---------------------- MUESTRA RESULTADOS DE BUSQEUDA --------------------------------- */
    /* ---------------------- MUESTRA RESULTADOS DE BUSQEUDA --------------------------------- */

    public function getListaEmpleadosAutorizados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_DRrhh = new DRrhh();
        if ($estado == '') {
            
        }
        if ($cod != '' && $nDoc == '' && $apPat == '') {
            $rs = $o_DRrhh->getListaEmpleadosXCodAutorizados($cod);
        }
        if ($nDoc != "Buscar..." && $nDoc != '') {
            $rs = $o_DRrhh->getListaEmpleadosXDocAutorizados($tipoDoc, $nDoc);
        }
        if ($apPat != '' || $apMat != '' || $nombre != '') {
            $rs = $o_DRrhh->getListaEmpleadosXNombreAutorizados($apPat, $apMat, $nombre, $estado);
        }
//        if($estado!='') {
//            $rs = $o_DRrhh->getListaEmpleadosXEstado($estado);
//        }

        return $rs;
    }

    public function getListaEmpleados($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_DRrhh = new DRrhh();
        if ($estado == '') {
            
        }
        if ($cod != '' && $nDoc == '' && $apPat == '') {
            $rs = $o_DRrhh->getListaEmpleadosXCod($cod);
        }
        if ($nDoc != "Buscar..." && $nDoc != '') {
            $rs = $o_DRrhh->getListaEmpleadosXDoc($tipoDoc, $nDoc);
        }
        if ($apPat != '' || $apMat != '' || $nombre != '') {
            $rs = $o_DRrhh->getListaEmpleadosXNombre($apPat, $apMat, $nombre, $estado);
        }
//        if($estado!='') {
//            $rs = $o_DRrhh->getListaEmpleadosXEstado($estado);
//        }
        $array = $this->filasEmpleados($rs);
        return $array;
    }

    public function busquedaEmpleadosCentroCostosFiltrado($puesto, $estado) {
        $o_DRrhh = new DRrhh();
//        if ($estado == '') {
//
//        }
//        if ($cod != '' && $nDoc == '' && $apPat == '') {
        $rs = $o_DRrhh->busquedaEmpleadosCentroCostosFiltrado($puesto, $estado);
//        }
//        if ($nDoc != "Buscar..." && $nDoc != '') {
//            $rs = $o_DRrhh->getListaEmpleadosXDoc($tipoDoc, $nDoc);
//        }
//        if ($apPat != '' || $apMat != '' || $nombre != '') {
//            $rs = $o_DRrhh->getListaEmpleadosXNombre($apPat, $apMat, $nombre, $estado);
//        }
//        if($estado!='') {
//            $rs = $o_DRrhh->getListaEmpleadosXEstado($estado);
//        }
//        $array = $this->filasEmpleados($rs);
//        return $array;
        return $rs;
    }

    //busqueda de empleados centro costos peche
    public function lBusquedaEmpleadosCentroCostos($idCentroCostos, $estado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dBusquedaEmpleadosCentroCostos($idCentroCostos, $estado);
        return $rs;
    }

    public function lBusquedaEmpleadosAreas($idCentroCostos, $estado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dBusquedaEmpleadosArea($idCentroCostos, $estado);
        return $rs;
    }

    public function buscarCoordinadoresPopap($apPat, $apMat, $nombre) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarCoordinadoresPopap($apPat, $apMat, $nombre);
        return $rs;
    }

    public function ListadoFiltradoAreas($nombre) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->ListadoFiltradoAreas($nombre);
        $array = $this->filasFiltradoAreas($rs);
        return $array;
    }

    public function getListaEmpleadosCCostos($cod, $estado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getListaEmpleadosXCCosto($cod, $estado);
        $array = $this->filasEmpleados($rs);
        return $array;
    }

    public function getListaEmpleadosPuestos($idPuesto, $estado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getListaEmpleadosPuesto($idPuesto, $estado);
        $array = $this->filasEmpleados($rs);
        return $array;
    }

    public function lGetDetalleContrato($idContrato, $idPuestoEmpleado) {
        //creado por peche 07 de mayo 2012
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dGetDetalleContrato($idContrato, $idPuestoEmpleado);
        return $rs[0];
    }

    public function lAsignarPuestoEmpleadoArea($datos) {
        //creado por peche 11 de mayo
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dAsignarPuestoEmpleadoArea($datos);
        //print_r($rs);
        return $rs[0][0];
    }

    public function lEliminarPuestoEmpleadoArea($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dEliminarPuestoEmpleadoArea($datos);
        return $rs[0][0];
    }

    public function listaPuestosEmpleado($iidEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->listapuestosEmpleado($iidEmpleado);
        $array = $rs;
        $j = 0;

        foreach ($array as $fila) {
            // $array[$j][4]=$estado[$array[$j][0]];
            $array[$j][8] = $array[$j][7];
            $array[$j][0] = $array[$j][0] . "|" . $array[$j][6];
            $array[$j][6] = $j + 1;
            If ($array[$j][5] == '1') {
                $array[$j][7] = "ACTIVO";
            } else {
                $array[$j][7] = "INACTIVO";
            }
            ////
            // alert($array[$j][5]);
            If ($rs[$j][2] != '1') {
                $array[$j][7] = "<a href='#' onclick=\"desactivarEmpleadoArea('" . $fila[8] . "','" . $fila[9] . "');\">ACTIVO</a>";
                //$array[$j][8] = '1';
            } else {
                $array[$j][7] = "<a href='#' onclick=\"desactivarEmpleadoArea('" . $fila[8] . "','1');\">INACTIVO</a>";
                //$array[$j][8] = '0';
            }
            ///
            $j++;
        }
        return $array;
    }

    public function filasEmpleados($rs) {
        $array = array();
        $j = 0;

        foreach ($rs as $fila) {
            // $array[$j][4]=$estado[$array[$j][0]];
            /* -------------------------------------- */
            $array[$j][0] = $rs[$j][0];
            $array[$j][1] = $rs[$j][1];


            /* -------------------------------------- */

            If ($rs[$j][3] == '1') {
                $array[$j][3] = "ACTIVO";
                //$array[$j][6] = '1';
            } else {
                $array[$j][3] = "INACTIVO";
                //$array[$j][6] = '0';
            }
            $array[$j][2] = $rs[$j][2];
            $array[$j][4] = $rs[$j][4];
            // $array[$j][7] = "";

            $j++;
        }

        return $array;
    }

    public function filasFiltradoAreas($rs) {
//        $array = array();
//        $j = 0;
//
//        foreach ($rs as $fila) {
//            // $array[$j][4]=$estado[$array[$j][0]];
//            /* -------------------------------------- */
//            $array[$j][0] = $rs[$j][0];
//            $array[$j][1] = $rs[$j][1];
//            $array[$j][3] = $rs[$j][3];
//            $array[$j][4] = $rs[$j][4];
//            /* -------------------------------------- */
//            If ($rs[$j][5] == '1') {
//                $array[$j][5] = "ACTIVO";
//            } else {
//                $array[$j][5] = "INACTIVO";
//            }
//            If ($rs[$j][2] == '1') {
//                $array[$j][2] = "<a href='#' onclick=\"cambiarEstadoEmpleado('" . $fila[0] . "','0');\">ACTIVO</a>";
//                $array[$j][6] = '1';
//            } else {
//                $array[$j][2] = "<a href='#' onclick=\"cambiarEstadoEmpleado('" . $fila[0] . "','1');\">INACTIVO</a>";
//                $array[$j][6] = '0';
//            }
//            $array[$j][7] = "";
//
//            $j++;
//        }
        //return $array;

        return $rs;
    }

    /* ---------------------- MUESTRA ID DE EMPELADO --------------------------- */

    public function getIdEmpleado($cod) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getIdEmpleado($cod);
        return $rs;
    }

    /* ------ LISTA Y MUESTRA DETALLES DE LAS CATEGORIAS DE DATOS DEL EMPLADO ------ */

    public function getExpLaboral($cod, $opc, $vista) {
        $o_DRrhh = new DRrhh();
        if (2 == $opc) {
            $rs = $o_DRrhh->getExpLaboral($cod);
        }
        if (3 == $opc) {
            $rs = $o_DRrhh->getEstSup($cod);
        }
        if (4 == $opc) {
            $rs = $o_DRrhh->getIdioma($cod);
        }
        if (5 == $opc) {
            $rs = $o_DRrhh->getConocimientos($cod);
        }
        if (6 == $opc) {
            $rs = $o_DRrhh->getInvestigaciones($cod);
        }
        if (7 == $opc) {
            $rs = $o_DRrhh->getLogros($cod);
        }
        if (8 == $opc) {
            $rs = $o_DRrhh->getReferencias($cod);
        }
        if (9 == $opc) {
            $rs = $o_DRrhh->getLegajo($cod);
            $array = $rs;

            //print_r($array);
            $j = 0;
            //TRATAR DE COPAIR CUANDO TIENEN 0 Y 1 IGUALES
            foreach ($array as $fila) {
                $array[$j][5] = $j + 1; //Id
                $array[$j][9] = $array[$j][6]; //paso de los Id de puestos
                $array[$j][10] = $array[$j][7]; //pas ode los Id de documento
                $array[$j][7] = $array[$j][5]; //paso de los Id de la tabla
                $array[$j][5] = '';
                $array[$j][6] = '';
                $array[$j][11] = $array[$j][8];
                //$array[$j][7]='';

                $array[$j][8] = $array[$j][4]; //legalizable
                $array[$j][4] = '';
                If ($array[$j][2] == 'Requerido') {
                    $array[$j][2] = $array[$j][3];
                } else {
                    If ($array[$j][2] == 'Legalizable') {
                        $array[$j][4] = $array[$j][3];
                    } else {
                        If ($array[$j][2] == 'Legalizado') {
                            $array[$j][5] = $array[$j][3];
                        } else {
                            If ($array[$j][2] == 'Vencimiento') {
                                $array[$j][6] = $array[$j][3];
                            }
                        }
                    }
                }


                if ($array[$j][2] != '1' && $array[$j][2] != '0') {
                    $array[$j][2] = '';
                }
                if ($array[$j][3] != '1' && $array[$j][3] != '0') {
                    $array[$j][3] = '';
                }
                if ($array[$j][6] == '1' || $array[$j][6] == '0') {
                    $array[$j][6] = '';
                }
                //hasta aqui muestra las filas repetidas
                $z = 1;
                while ($z < 4) {
                    if ($j >= 1 && $j - $z > -1) { //a partir del segundo elemento
                        if ($array[$j][0] == $array[$j - $z][0] && $array[$j][1] == $array[$j - $z][1]) {
                            //$jota[$j-1][0]=1;
                            $array[$j - $z][0] = 'borrado';
                            //                  echo 'EN 1: '.($j-$z).'*';
                            //                    if($array[$j-1][2]=='1' || ($array[$j-1][2]=='0' && $array[$j][2]=='')){
                            //                        $array[$j][2]=$array[$j-1][2];
                            //                    }
                            if ($array[$j - $z][2] == '1') {
                                $array[$j][2] = '1';
                            } else {
                                if ($array[$j][2] != '1' && $array[$j - $z][2] != '') {
                                    $array[$j][2] = '0';
                                }
                            }


                            if ($array[$j - $z][4] == '1') {
                                $array[$j][4] = '1';
                            } else {
                                if ($array[$j][4] != '1' && $array[$j - $z][4] != '') {
                                    $array[$j][4] = '0';
                                }
                            }


                            if ($array[$j - $z][5] == '1') {
                                $array[$j][5] = '1';
                            } else {
                                if ($array[$j][5] != '1' && $array[$j - $z][5] != '') {
                                    $array[$j][5] = '0';
                                }
                            }

                            if ($array[$j - $z][6] != '') {
                                $array[$j][6] = $array[$j - $z][6];
                            }
                        }
                    }
                    $z++;
                }

                $j++;
            }
            $j = 0;
            $e = 0; //contador de elementos borrados
            foreach ($array as $fila) {
                if ($array[$j - $e][0] == 'borrado') {
                    array_splice($array, $j - $e, 1);
                    $e++;
                    //echo '*//EIMINANDO DEL ARRAY: '.$j.'///////*';
                }
                $j++;
            }
            $rs = $this->muestraLegajo($array, $vista);
        }
        return $rs;
    }

    public function muestraLegajo($array, $vista) {
        $j = 0;
        if ($vista == 1) {
            foreach ($array as $fila) {
                $f = 2;
                while ($f < 11) {
                    if ($array[$j][$f] == '1') {
                        $array[$j][$f] = 'SI';
                    } else {
                        if ($array[$j][$f] == '0') {
                            $array[$j][$f] = 'NO';
                        } else {
                            if ($array[$j][$f] == '') {
                                $array[$j][$f] = '--';
                            }
                        }
                    }
                    $f++;
                    if ($f == 7) {
                        $f++;
                    }
                }
                $j++;
            }
        } else {
            if ($vista == 2) {
                foreach ($array as $fila) {
                    $f = 2;
                    while ($f < 11) {
                        if ($array[$j][$f] == '1') {
                            $array[$j][$f] = "<input onclick='javascript:accionAtributos(3," . $f . "," . $array[$j][9] . "," . $array[$j][10] . ");' id=\"check\" type=\"checkbox\" name=\"radioActoMedico\" value='" . '01' . "' checked=\"true\"/>";
                        } else {
                            if ($array[$j][$f] == '0') {
                                $array[$j][$f] = "<input onclick='javascript:accionAtributos(2," . $f . "," . $array[$j][9] . "," . $array[$j][10] . ");' id=\"check\" type=\"checkbox\" name=\"radioActoMedico\" value='" . '01' . "' />";
                            } else {
                                if ($array[$j][$f] == '') {
                                    $array[$j][$f] = 'No aplica';
                                }
                            }
                        }
                        $f++;
                        if ($f == 7) {
                            $f++;
                        }
                    }
                    $j++;
                }
            }
        }
        return $array;
    }

    public function vistaLegajoDetalle($idDocumentoEmpleado) {
        $o_DRrhh = new DRrhh();

        return $o_DRrhh->vistaLegajoDetalle($idDocumentoEmpleado);
    }

    public function agregarDocumentoEmpleado($iCodigoEmpleado, $iIdDocumento) {
        $o_DRrhh = new DRrhh();

        return $o_DRrhh->agregarDocumentoEmpleado($iCodigoEmpleado, $iIdDocumento);
    }

    /* ----------------------- RECARGA DE COMBOS------------------------ */

    public function seleccionarTipoEstudio() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarTipoEstudio();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarInstitucion($opc) {
        $o_DRrhh = new DRrhh();
//        if($opc==1){
        $rs = $o_DRrhh->seleccionarInstitucion($opc);
//        }
//        else{
//            $rs = $o_DRrhh->seleccionarInstituto();
//        }

        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarProfesion() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarProfesion();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarEstadoEstudio() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarEstadoEstudio();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarTipoNivel() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarTipoNivel();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarEspecialidad($opc) {
        $o_DRrhh = new DRrhh();
//        if($opc==1){
        $rs = $o_DRrhh->seleccionarEspecialidad($opc);
//        }
//        else{
//            $rs = $o_DRrhh->seleccionarIdioma();
//        }

        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function seleccionarAprendizaje() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarAprendizaje();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    /* ----------------------- DETALLES ------------------------- */

    public function detalleExpLaboral($cod, $opc) { //permtie mostrar el formulario
        $o_DRrhh = new DRrhh();
        if ($opc == 2) {
            $rs = $o_DRrhh->getDetalExpLaboral($cod);
        }
        if ($opc == 3) {
            $rs = $o_DRrhh->getDetalEstSup($cod);
        }
        if ($opc == 4) {
            $rs = $o_DRrhh->getDetalIdioma($cod);
        }
        if ($opc == 5) {
            $rs = $o_DRrhh->getDetalConocimientos($cod);
        }
        if ($opc == 6) {
            $rs = $o_DRrhh->getDetalInvestigaciones($cod);
        }
        if ($opc == 7) {
            $rs = $o_DRrhh->getDetalLogros($cod);
        }
        if ($opc == 8) {
            $rs = $o_DRrhh->getDetalReferencias($cod);
        }
        if ($opc == 9) {
            $rs = $o_DRrhh->getDetalLegajo($cod);
        }
        return $rs;
    }

    /* ---------------------- ACCIONES ----------------------------- */

    public function accionExpLaboral($cat, $opc, $codigo, $id, $desde, $hasta, $instit, $cargo, $func, $tipoestudio, $esp, $estado, $nivel, $tiponivel) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->accionExpLaboral($cat, $opc, $codigo, $id, $desde, $hasta, $instit, $cargo, $func, $tipoestudio, $esp, $estado, $nivel, $tiponivel);
        return $rs;
    }

    public function accionLegajo($accion, $codigo, $columna, $puesto, $documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->accionLegajo($accion, $codigo, $columna, $puesto, $documento, '');
        return $rs;
    }

    public function getFechaEntrega($codigo, $documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getFechaEntrega($codigo, $documento);
        return $rs;
    }

    public function actualizarFechaDocumento($fecha, $idDocumentoEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->actualizarFechaDocumento($fecha, $idDocumentoEmpleado);
        return $rs;
    }

    public function guardarAtributoDocumentoEmpledo($iddocEmpleado, $dirCompleto) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->guardarAtributoDocumentoEmpledo($iddocEmpleado, $dirCompleto);
        return $rs;
    }

    public function preMostrarCV($idDocEmp) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->preMostrarCV($idDocEmp);
        return $rs;
    }

    public function recDatosDocumentoEmpleado($idDocEmp) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->recDatosDocumentoEmpleado($idDocEmp);
        return $rs;
    }

    public function mantemientoAtributosDocumentoEmpleados($valores, $tipos, $idAtributoDocumentoEmpleado, $atributoDocumento, $idDocumentoEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->mantemientoAtributosDocumentoEmpleados($valores, $tipos, $idAtributoDocumentoEmpleado, $atributoDocumento, $idDocumentoEmpleado);
        return $rs;
    }

    public function grabarEntregaDocumento($accion, $codigo, $puesto, $documento, $fecha) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->accionLegajo($accion, $codigo, '', $puesto, $documento, $fecha);
        return $rs;
    }

    /* ---------------------- ESTUDISO SUPERIORES ---------------------------- */

    public function accionEstSup($codigo, $institucion, $cargo, $desde, $hasta, $funciones, $id, $opc) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->accionEstSup($codigo, $institucion, $cargo, $desde, $hasta, $funciones, $id, $opc);
        return $rs;
    }

    ///////////// FIN MANTENIMIENOT RRHH /////////////////////////
    /*     * ***********************MANTENIMIENTO PROFESIONES RRHH ************************* */
    //Para listar los PROFESIONES por nombre
    public function buscarProfesiones($profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarProfesiones($profesion);
        $array = $rs;
        $j = 0;

        foreach ($array as $fila) {
            $array[$j][3] = $array[$j][2];
            $array[$j][3] = $j + 1;
            If ($array[$j][1] == '1') {
                $array[$j][1] = "ACTIVO";
                $array[$j][4] = "<a onclick='javascript:desactivarProfesion(" . $array[$j][2] . ");'><img border='0' title='Desactivar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            } else {
                $array[$j][1] = "INACTIVO";
                $array[$j][4] = "<a onclick='javascript:activarProfesion(" . $array[$j][2] . ");'><img border='0' title='Activar' src='../../../../fastmedical_front/imagen/icono/op_atendido.gif'/></a>";
            }
            $j++;
        }
        return $array;
    }

    //Mostrar los atributos principales de la profesion
    public function profesionDetalle($codigo) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->profesionDetalle($codigo);
        return $rs;
    }

    //Mostrar la tabla de especialidades de la profesion
    public function buscarEspecialidades($profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarEspecialidades($profesion);
        $array = $rs;
        $j = 0;
        $filas = count($array);
        $filas--;
        foreach ($array as $fila) {
            $array[$j][3] = $array[$j][0];
            $array[$j][3] = $j + 1;
            //$name=(string)$array[$j][1];
            $array[$j][4] = "<a onclick='javascript:eliminarEspecialidad(" . $array[$j][0] . ");'><img border='0' title='Eliminar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            $array[$j][2] = "<a onclick='javascript:editaEspecialidad(" . $array[$j][0] . ", " . "\"" . $array[$j][1] . "\" );'><img border='0' title='Editar' src='../../../../fastmedical_front/imagen/icono/editar.png'/></a>";
            $j++;
            //"id='".$orden."' onclick='seleccionaOrden(this,\"".$orden."\")' />"
        }
        return $array;
    }

    //Aumentar una profesion
    public function grabarProfesion($profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarProfesion($profesion);
        return $rs;
    }

    //Registrar la relacion entre la especialidad y la profesion
    public function grabarEspecialidad($especialidad, $profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarEspecialidad($especialidad, $profesion);
        return $rs;
    }

    //Eliminar la relacion entre la especialidad y la profesion
    public function eliminarEspecialidad($especialidad, $profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->eliminarEspecialidad($especialidad, $profesion);
        return $rs;
    }

    //Cambiar el nombre de la especialidad
    public function editarEspecialidad($especialidad, $descripcion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->editarEspecialidad($especialidad, $descripcion);
        return $rs;
    }

    //Editar el nombre de la profesion
    public function editarProfesion($profesion, $descripcion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->editarProfesion($profesion, $descripcion);
        return $rs;
    }

    //Desactivar una profesion
    public function desactivarProfesion($profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->desactivarProfesion($profesion);
        return $rs;
    }

    //Activar una profesion
    public function activarProfesion($profesion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->activarProfesion($profesion);
        return $rs;
    }

    /////inicioo
    public function desactivarCoordinadorAlArea($hiIdEncargadoProgramacionPersonal) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->desactivarCoordinadorAlArea($hiIdEncargadoProgramacionPersonal);
        return $rs;
    }

    public function actualizarDescripcionCeseCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->actualizarDescripcionCeseCoordinador($datos);
        return $rs;
    }

    /////finn
    public function asignarNuevoCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->asignarNuevoCoordinador($datos);
        return $rs;
    }

    /*     * *********************** FIN MANTENIMIENTO PROFESIONES RRHH ************************* */
    /*     * ***********************MANTENIMIENTO DOCUMENTOS POR PUESTO RRHH ************************* */

    //Para mostrar la tabla con los puestos
    public function getListaPuestosDoc($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getListaPuestos($datos);
        $array = $rs;
        $j = 0;
        foreach ($array as $fila) {
            $array[$j][2] = $array[$j][0] . '|' . $array[$j][1] . '|';
            $j++;
        }
        return $array;
    }

    //Para listar los documentos por puesto
    public function puestoDocumento($puesto) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->puestoDocumento($puesto);
        $array = $rs;
        $j = 0;
        foreach ($array as $fila) {
            $array[$j][4] = $array[$j][0];
            $array[$j][4] = $j + 1;
            // $array[$j][3]=$array[$j][2];
            $array[$j][3] = '';
            $array[$j][2] = "<a onclick='javascript:eliminarDocumentoPto(" . $array[$j][3] . ");'><img border='0' title='Eliminar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            $j++;
        }
        return $array;
    }

    //Para inactivar la relacion entre el documento y el puesto
    public function eliminarDocumentoPto($documentoPto) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->eliminarDocumentoPto($documentoPto);
        return $rs;
    }

    //listar los documentos no asigandos al puesto
    public function agregarDocumentoPuesto($puesto) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->agregarDocumentoPuesto($puesto);
        $array = $rs;
        $j = 0;
        foreach ($array as $fila) {
            $array[$j][4] = $array[$j][0];
            $array[$j][4] = $j + 1;
            //$array[$j][3]=$array[$j][1];
            $array[$j][2] = "<a onclick='javascript:grabarDocumentoPto(" . $array[$j][0] . ");'><img border='0' title='Asignar documento' src='../../../../fastmedical_front/imagen/icono/nuevo_item.png'/></a>";
            $j++;
        }
        return $array;
    }

    //activar o insertar una nueva relacion entre documento y puesto
    public function grabarDocumentoPto($puesto, $documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarDocumentoPto($puesto, $documento);
        return $rs;
    }

    /*     * ***********************FIN MANTENIMIENTO PUESTO DOCUMENTOS RRHH ************************* */
    /*     * ***********************MANTENIMIENTO DOCUMENTOS RRHH ************************* */

    //Para listar los documentos por nombre
    public function buscarDocumentos($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarDocumentos($documento);
        $array = $rs;
        $j = 0;

        foreach ($array as $fila) {
            $array[$j][3] = $array[$j][2];
            $array[$j][3] = $j + 1;
            If ($array[$j][1] == '1') {
                $array[$j][1] = "ACTIVO";
                $array[$j][4] = "<a onclick='javascript:eliminarDocumento(" . $array[$j][2] . ");'><img border='0' title='Desactivar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            } else {
                $array[$j][1] = "INACTIVO";
                $array[$j][4] = "<a onclick='javascript:activarDocumento(" . $array[$j][2] . ");'><img border='0' title='Activar' src='../../../../fastmedical_front/imagen/icono/op_atendido.gif'/></a>";
            }
            $j++;
        }
        return $array;
    }

    //Mostrar los atributos principales del documento
    public function documentoDetalle($codigo) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->documentoDetalle($codigo);
        return $rs;
    }

    //Mostrar la tabla de atricutos del documento
    public function buscarAtributos($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarAtributos($documento);
        $array = $rs;
        $j = 0;
        $filas = count($array);
        $filas--;
        foreach ($array as $fila) {
            $array[$j][5] = $array[$j][3];
            $array[$j][5] = $j + 1;
            $array[$j][8] = $array[$j][4];
            if ($j == 0 && $filas > 1) {
                $array[$j][6] = "<img border='0' src='../../../../fastmedical_front/imagen/btn/blank.png'/>" . "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",1," . $array[$j][0] . ");'><img border='0' title='Bajar' src='../../../../fastmedical_front/imagen/btn/c_down.png'/></a>";
            } else {
                if ($j < $filas) {
                    $array[$j][6] = "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",0," . $array[$j][0] . ");'><img border='0' title='Subir' src='../../../../fastmedical_front/imagen/btn/c_up.png'/></a>" . "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",1," . $array[$j][0] . ");'><img border='0' title='Bajar' src='../../../../fastmedical_front/imagen/btn/c_down.png'/></a>";
                } else {
                    if ($filas > 1) {
                        $array[$j][6] = "<a onclick='javascript:ordenarAtributo(" . $array[$j][4] . ",0," . $array[$j][0] . ");'><img border='0' title='Subir' src='../../../../fastmedical_front/imagen/btn/c_up.png'/></a>";
                    }
                }
            }
            $array[$j][7] = "<a onclick='javascript:eliminarAtributo(" . $array[$j][3] . ");'><img border='0' title='Eliminar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            $j++;
        }
        return $array;
    }

    //Aumentar un documento
    public function grabarDocumento($documento, $descripcion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarDocumento($documento, $descripcion);
        return $rs;
    }

    //Listar los atributos que no posee el documento
    public function buscarAtributo($documento, $atributo) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->buscarAtributo($documento, $atributo);
        return $rs;
    }

    //Registrar la relacion entre el atributo y el documento
    public function grabarAtributo($atributo, $documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->grabarAtributo($atributo, $documento);
        return $rs;
    }

    //Eliminar la relacion entre el atributo y el documento
    public function eliminarAtributo($atributo, $documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->eliminarAtributo($atributo, $documento);
        return $rs;
    }

    //cambiar el nº de orden del atributo
    public function ordenarAtributo($documento, $direccion, $orden, $atributo) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->ordenarAtributo($documento, $direccion, $orden, $atributo);
        return $rs;
    }

    //Editar un documento
    public function editarDocumento($documento, $descripcion) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->editarDocumento($documento, $descripcion);
        return $rs;
    }

    //Desactivar un documento
    public function eliminarDocumento($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->eliminarDocumento($documento);
        return $rs;
    }

    //Activar un documento
    public function activarDocumento($documento) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->activarDocumento($documento);
        return $rs;
    }

    /*     * ************************ FIN MANTENIMIENTO DOCUMENTOS RRHH ************************* */

    /*     * **************Asignacion de Servicios a Puestos de trabajo****************** */

    function getListaServiciosAsignados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getListasServiciosAsignados($datos);
        $resultadoArray = array();
        foreach ($resultado as $fila) {
            if ($fila[3] == '1') {
                if ($_SESSION["permiso_formulario_servicio"][205]["DESACTIVAR_SERVICIO_X_PUESTO"] == 1) {
                    $fila[4] = "<a href='#' onclick=\"irActivaryDesactivarAsignacionxPuesto('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' title='Desactivar'/></a>";
                } else {
                    $fila[4] = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' title='Activado'/>";
                }
            } else {
                if ($_SESSION["permiso_formulario_servicio"][205]["ACTIVAR_SERVICIO_X_PUESTO"] == 1) {
                    $fila[4] = "<a href='#' onclick=\"irActivaryDesactivarAsignacionxPuesto('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' title='Activar'/></a>";
                } else {
                    $fila[4] = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' title='Desactivado'/>";
                }
            }
            if ($_SESSION["permiso_formulario_servicio"][205]["ELIMINAR_SERVICIO_X_PUESTO"] == 1) {
                $fila[5] = "<a href='#' onclick=\"irEliminarAsignacion('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/delete.png' title='Eliminar Asignacion'/></a>";
            }
//$fila[6]="<a href='#' onclick=\"irAsignarAmbienteFisico('".$fila[0]."','".$fila[2]."');\"><img src='../../../../fastmedical_front/imagen/icono/gohome.png' title='Ambiente Fisico'/></a>";
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    function getListaServiciosparaAsignar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getListasServiciosparaAsignar($datos);
        $resultadoArray = array();
        foreach ($resultado as $fila) {
            if ($_SESSION["permiso_formulario_servicio"][205]["ASIGNAR_SERVICIO_X_PUESTO"] == 1) {
                $fila[3] = "<a href='#' onclick=\"grabarAsignacionServicioaPuesto('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/window_new.png' title='Asignar Servicio'/></a>";
            } else {
                $fila[3] = "";
            }
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    function grabarAsignacionServicioaPuesto($datos) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->grabarAsignacionServicioaPuesto($datos);
    }

    function activaryDesactivarAsignacionServicioaPuesto($datos) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->activaryDesactivarAsignacionServicioaPuesto($datos);
    }

    function eliminarAsignacionServicioaPuesto($datos) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->eliminarAsignacionServicioaPuesto($datos);
    }

    //////para registro de nuevo empleado
    public function registrarEmpleado($c_cod_per, $bEstado) {
        $o_DRrhh = new DRrhh();

        return $o_DRrhh->registrarEmpleado($c_cod_per, $bEstado);
    }

    public function detalleModalidadContrato($idEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->detalleModalidadContrato($idEmpleado);
        $cadena = "error";
        if ($rs) {
            $cadena = "";
            for ($i = 0; $i < count($rs[0]) / 2; $i++) {
                $cadena.=$rs[0][$i] . "|";
            }
        }
        return $cadena;
    }

    public function lGrabarMantenimientoContrato($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->dGrabarMantenimientoContrato($datos);
        return $rs;
    }

    public function detallePuestosEmpleados($id) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->detallePuestosEmpleados($id);
        $n = count($rs[0]) / 2;
        $cadena = "|";
        //echo $n;
        for ($i = 0; $i < $n; $i++) {
            $cadena.=$rs[0][$i] . "|";
            //echo $i."-";
        }

        //print_r($rs);
        //echo $rs[1][5];
        return $cadena;
    }

    public function tablaPeriodos($iidPuestoEmpleado) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->tablaPeriodos($iidPuestoEmpleado);
        $array = $rs;
        $j = 0;

        foreach ($array as $fila) {
            //121:Formulario de registro de personal - 212:Formulario de datos de usuario
            $edid = "<img src='../../../../fastmedical_front/imagen/icono/editar_desh.png' title='Editar Periodo'/>";
            if (isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                if ($_SESSION["permiso_formulario_servicio"][121]["EDITAR_PERIODO_PUESTO_EMP"] == 1)
                    $edid = "<a href='#' onclick=\"javascript:ventanaEditarPeriodos('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/edit2.png' title='Editar Periodo'/></a>";
            }
            else {
                if (!isset($_SESSION['permiso_formulario'][121]) && isset($_SESSION['permiso_formulario'][212])) {
                    if ($_SESSION["permiso_formulario_servicio"][212]["EDITAR_PERIODO_PUESTO_EMP"] == 1)
                        $edid = "<a href='#' onclick=\"javascript:ventanaEditarPeriodos('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/edit2.png' title='Editar Periodo'/></a>";
                }
            }
            //$edid="<a href='#' onclick=\"javascript:ventanaEditarPeriodos('".$fila[0]."');\"><img src='../../../../fastmedical_front/imagen/icono/edit2.png' title='Editar Periodo'/></a>";
            array_push($array[$j], $edid);
            $j++;
        }
        return $array;
    }

    public function listaEstadoPuestoEmpleado($iidPuestoEmpleado) {
        $o_DRrhh = new DRrhh();

        return $o_DRrhh->listaEstadoPuestoEmpleado($iidPuestoEmpleado);
    }

    public function cambiarEstadoPuestoEmpleado($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {
        $o_DRrhh = new DRrhh();
        $arrayIni = explode("/", $dInicio);
        $dInicio1 = $arrayIni[1] . "/" . $arrayIni[0] . "/" . $arrayIni[2];
        //echo "inicio:".$dInicio1;
        $arrayFin = explode("/", $dFin);
        $dFin1 = $arrayFin[1] . "/" . $arrayFin[0] . "/" . $arrayFin[2];
        //echo "fin: ".$dFin1;


        $resultado = $o_DRrhh->cambiarEstadoPuestoEmpleado($dInicio1, $dFin1, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado);
        return $resultado;
    }

    public function editarPeriodoPuesto($dInicio, $dFin, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado) {
        $o_DRrhh = new DRrhh();
        $arrayIni = explode("/", $dInicio);
        $dInicio1 = $arrayIni[1] . "/" . $arrayIni[0] . "/" . $arrayIni[2];
        //echo "inicio:".$dInicio1;
        $arrayFin = explode("/", $dFin);
        $dFin1 = $arrayFin[1] . "/" . $arrayFin[0] . "/" . $arrayFin[2];
        //echo "fin: ".$dFin1;


        $resultado = $o_DRrhh->editarPeriodoPuesto($dInicio1, $dFin1, $bEstado, $iIdPuestoEmpleado, $periodoPuestoEmpleado);
        return $resultado;
    }

    public function ventanaEditarPeriodos($iIdPeriodo) {
        $o_DRrhh = new DRrhh();

        return $o_DRrhh->ventanaEditarPeriodos($iIdPeriodo);
    }

    public function asignarPuestoEmpleado($arrayDat) {
        $o_DRrhh = new DRrhh();
        if ($arrayDat["opt"] == "locatario")
            return $o_DRrhh->asignarPuestoEmpleadoLocatario($arrayDat);
        else
            return $o_DRrhh->asignarPuestoEmpleado($arrayDat);
    }

    public function registrarEmpleadoComoUsuario($codigoEmpleado, $idPuesto) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->registrarEmpleadoComoUsuario($codigoEmpleado, $idPuesto);
    }

    /* ------------------------     Arbol para los Manuales       --------------------- */
    /* ------------------------         fecha 31/12/2010          --------------------- */


    /*     * ******************** GENERA EL ARBOL CON TODOS LOS ELEMENTOS ******************************************* */

    function crearArbolManuales($cadena, $ruta_archivo) {
        $oDManuales = new DRrhh();
//      $resultado = $oDCronograma -> getDatosCentroCostoCompleto();
        $resultado = $oDManuales->getDatosManualesCompleto($cadena);
        $this->factoryTree($resultado, $ruta_archivo);
    }

    public function generaManual($datos) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->generaManual($datos);
    }

    public function seleccionarFormulario() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->seleccionarFormulario();
//        $resultadoArray = array();
//        foreach($rs as $fila) {
//            $op=$fila[0];
//            $resultadoArray[$op]=htmlentities($fila[1]);
//        }
//        return $resultadoArray;
        return $rs;
    }

    public function registrarManual($datos) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->registrarManual($datos);
    }

    public function verItemManual($cod) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->verItemManual($cod);
    }

    public function eliminaManual($cod) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->eliminaManual($cod);
    }

    public function traerDatosPadre($cod) {
        $o_DRrhh = new DRrhh();
        return $o_DRrhh->traerDatosPadre($cod);
    }

    function generaArbolServicios() {
        $oDManuales = new DRrhh();
        $resultado = $oDManuales->generaArbolServicios();
        $ruta_archivo = "../../../../carpetaDocumentos/arbol_servicios";
        $this->factoryTree($resultado, $ruta_archivo);
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

    public function arbolCentroCosto() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->arbolCentroCosto();
        return $resultado;
    }

    public function tablaAreaCCosto($idCCosto) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->tablaAreaCCosto($idCCosto);

        return $resultado;
    }

    public function grabarArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarArea($datos);
        return $resultado;     // grabarSedeEmpresaAreaCentroCosto    grabarAreaCCosto  "cod_empresa",$datos["idSede"]
    }

    public function grabarAreaX($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarAreaX($datos);
        return $resultado;     // grabarSedeEmpresaAreaCentroCosto    grabarAreaCCosto  "cod_empresa",$datos["idSede"]
    }

//    public function grabarSedeEmpresaArea($datos) {
//        $o_DRrhh = new DRrhh();
//        //   $resultado = $o_DRrhh->grabarSedeEmpresaArea($datos);
//        $idCentroCosto= $datos["idccosto"];
//        $idSedeEmpresaArea = $o_DRrhh->grabarSedeEmpresaArea($datos);
//        if($idSedeEmpresaArea) {
//            $o_DRrhh = new DRrhh();
//            $resultado = $o_DRrhh->grabarSedeEmpresaAreaCentroCosto($idCentroCosto,$idSedeEmpresaArea[0][0]);
//
//            $idCCosto=$datos["idccosto"];
//            $idArea = $o_DRrhh->grabarArea($datos);
//            $resultado=null;
//        }
//        if($idArea) {
//            $o_DRrhh = new DRrhh();
//            $resultado = $o_DRrhh->grabarAreaCCosto($idArea[0][0],$idCCosto);
//
//        }
//
//        return $resultado;
//    }
    public function grabarAreaCCosto($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarAreaCCosto($datos);
        return $resultado;
    }

    public function buscarArea($nomArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->buscarArea($nomArea);

        foreach ($resultado as $j => $fila) {
            if ($resultado[$j][3] == 1)
                array_push($resultado[$j], "Activado");
            else if ($resultado[$j][3] == 0)
                array_push($resultado[$j], "Desactivado");
            $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
            array_push($resultado[$j], $imagen1);
        }
        return $resultado;
    }

    //*********************2012/02/17 Jose************
    public function buscarSubArea($idArea, $nomSubArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->buscarSubArea($idArea, $nomSubArea);
        foreach ($resultado as $j => $fila) {
            if ($resultado[$j][4] == 1)
                array_push($resultado[$j], "Activado");
            else if ($resultado[$j][4] == 0)
                array_push($resultado[$j], "Desactivado");
            $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
            array_push($resultado[$j], $imagen1);
        }
        return $resultado;
    }

    //*******************************************************
//  public function modificarArea($datos) {

    public function modificarArea($datos) {

        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->modificarArea($datos);
        return $resultado;
    }

    //jose 2012/02/20*************
    public function modificarSubArea($datos) {

        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->modificarSubArea($datos);
        return $resultado;
    }

    //***************************


    public function listaModalidadContrato() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaModalidadContrato();
        return $resultado;
    }

    public function listaTipoSueldo() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaTipoSueldo();
        return $resultado;
    }

    public function listaTablaArea($idSucursal) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaTablaArea($idSucursal);
        return $resultado;
    }

    public function listaSucursal($idEmpresa, $nomSede) {
        $o_DMantGeneral = new DMantenimientoGeneral();
        $resultado = $o_DMantGeneral->spListaSedes($idEmpresa, $nomSede);
        return $resultado;
    }

    public function listaTurnosDisponibles($idSedeempresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaTurnosDisponibles($idSedeempresaArea);
        return $resultado;
    }

    public function listaTurnosxSedeEmpresaArea($idSedeempresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaTurnosxSedeEmpresaArea($idSedeempresaArea);
        //////////////////////////////////////////////////////
//          foreach ($resultado as $j => $fila) {
//            if ($resultado[$j][5] == 1)
//                array_push($resultado[$j], "Activado");
//            else if ($resultado[$j][5] == 0)
//                array_push($resultado[$j], "Desactivado");
//            $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
//            $imagen2 = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";
//            array_push($resultado[$j], $imagen1);
//            array_push($resultado[$j], $imagen2);
//        }
//        return $resultado;
        ///////////////////////////////////

        foreach ($resultado as $j => $fila) {

            if ($resultado[$j][4] == 1) {

                $resultado[$j][4] = "Activado";

                //array_push($resultado[$j], "Activado");
            } else if ($resultado[$j][4] == 0) {
                $resultado[$j][4] = "Desactivado";
                // array_push($resultado[$j], "Desactivado");
            }


            //$imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
            $imagen1 = "../../../../fastmedical_front/imagen/icono/kchart1.png ^ Editar";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";

            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
        }






        //////////////////////////////////////////////////////
        return $resultado;
    }

    public function AsignarEmpleadoArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->AsignarEmpleadoArea($datos);
        return $resultado[0][0];
    }

//   08 de mayo del 2012 
    public function replicarPreProgramación($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->replicarPreProgramación($datos);
        return $resultado[0][0];
    }

    public function asignarsolofechasCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->asignarsolofechasCoordinador($datos);
        return $resultado[0][0];
    }

    //                ***********************************************************************************************************************************
//                ************************************Creado por Jose Quispe Araoz 29 Marzo 12 desactivar a un Coordinador Asignado*****************
//                ***********************************************************************************************************************************   

    public function DesactivarCoordinadorDeArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DesactivarCoordinadorDeArea($datos);
        return $resultado[0][0];
    }

    public function asignarNuevoCoordinadorAlArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->asignarNuevoCoordinadorAlArea($datos);
        return $resultado[0][0];
    }

    public function editarEncargadoArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->editarEncargadoArea($datos);
        return $resultado;
    }

    public function listPuestosxCategoria($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listPuestosxCategoria($datos);
        foreach ($resultado as $i => $value) {
            if ($resultado[$i][5] == 1)
                array_push($resultado[$i], "Activado");
            else if ($resultado[$i][5] == 0)
                array_push($resultado[$i], "Desactivado");
        }

        return $resultado;
    }

    public function grabarModalidadContrato($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarModalidadContrato($datos);
        return $resultado;
    }

    public function empleadoXarea($idSedeEmpresaArea, $fecha, $cboTipoContrato, $idSubArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->empleadoXarea($idSedeEmpresaArea, $fecha, $cboTipoContrato, $idSubArea);
        return $resultado;
    }

    public function empresaSucursal() {//id   jerarquia    titulo    nivel
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->empresaSucursal();
        $resul = array();
        $k = 0;
        foreach ($resultado as $i => $value) {
            $k++;
            $resul[$i]["id"] = $resultado[$i][0];
            $resul[$i]["titulo"] = $resultado[$i][1];
            if ($k == 1) {
                $resul[$i]["jerarquia"] = "01";
                $resul[$i]["nivel"] = 0;
            } else {
                $resul[$i]["jerarquia"] = "010" . $i;
                $resul[$i]["nivel"] = 1;
            }
        }
        return $resul;
    }

//modificado 2012/02/21
    public function listAreaSucursal($idSucursal) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listAreaSucursal($idSucursal);
        foreach ($resultado as $j => $fila) {
            if ($resultado[$j][5] == 1)
                array_push($resultado[$j], "Activado");
            else if ($resultado[$j][5] == 0)
                array_push($resultado[$j], "Desactivado");
            $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
        }
        return $resultado;
    }

    //listSubAreaXAreaXSede($idSedeArea, 100)

    public function listSubAreaXAreaXSede($idArea, $idSedeArea) {


        $o_DRrhh = new DRrhh();

        $resultado = $o_DRrhh->listSubAreaXAreaXSede($idArea, $idSedeArea);
        foreach ($resultado as $j => $fila) {

            if ($resultado[$j][6] == 1)
                array_push($resultado[$j], "Activado");
            else if ($resultado[$j][6] == 0)
                array_push($resultado[$j], "Desactivado");
            $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
            $imagen2 = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";
            array_push($resultado[$j], $imagen1);
            array_push($resultado[$j], $imagen2);
        }
        return $resultado;
    }

    public function cargarSubArea($idSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->cargarSubArea($idSedeEmpresaArea);
        return $resultado;
    }

    public function listaSedeAreaCentroCosto($idSedeArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaSedeAreaCentroCosto($idSedeArea);
        $imgEliminar = "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar";
        foreach ($resultado as $i => $value) {
            array_push($resultado[$i], $imgEliminar);
        }
        return $resultado;
    }

    public function eliminacionFisicaSedeAreaCentroCosto($idSEACC) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->eliminacionFisicaSedeAreaCentroCosto($idSEACC);
        return $resultado;
    }

    public function listTurnoArea() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listTurnoArea();
        foreach ($resultado as $i => $value) {
            if ($resultado[$i][6] == 1)
                $resultado[$i][6] = "Activado";
            else if ($resultado[$i][6] == 0)
                $resultado[$i][6] = "Desactivado";
        }
        return $resultado;
    }

    public function listTurnoProgramar() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listTurnoProgramar();
        foreach ($resultado as $i => $value) {
            if ($resultado[$i][5] == 1)
                $resultado[$i][5] = "Activado";
            else if ($resultado[$i][5] == 0)
                $resultado[$i][5] = "Desactivado";
        }
        return $resultado;
    }

    public function grabarTurnoProgramar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarTurnoProgramar($datos);
        return $resultado;
    }

    public function listaTurnosMaestros() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaTurnosMaestros();
        foreach ($resultado as $i => $value) {
            if ($resultado[$i][6] == 1)
                $resultado[$i][6] = "Activado";
            else if ($resultado[$i][6] == 0)
                $resultado[$i][6] = "Desactivado";
        }
        return $resultado;
    }

    public function turnoSedeEmpresaArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->turnoSedeEmpresaArea($datos);
        return $resultado;
    }

    /* public function listaLeyendaID() {
      $o_DRrhh = new DRrhh();
      $resultado = $o_DRrhh->listaLeyendaID();
      return $resultado;
      } */

    public function listTablaTurnoxArea($idSedeEmpresa) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listTablaTurnoxArea($idSedeEmpresa);
        if ($resultado) {
            foreach ($resultado as $i => $value) {//Ojo de la base se trae solo los activos
                if ($resultado[$i][6] == 1)
                    $imagen1 = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";
                else
                    $imagen1 = "../../../../fastmedical_front/imagen/icono/button_ok.png ^ Activar";
                array_push($resultado[$i], $imagen1);
            }
        }
        return $resultado;
    }

    public function listaTurnoSedeEmpresaArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->cboTurnoEmpresaSedeArea($datos);
        return $resultado;
    }

    public function grabarHorarioFijo($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarHorarioFijo($datos);
        return $resultado;
    }

//    public function tablaEncargadosxArea($idSedeEmpresaArea, $idCategoriaPuesto) {
//
//        $o_DRrhh = new DRrhh();
//        $resultado = $o_DRrhh->tablaEncargadosxArea($idSedeEmpresaArea, $idCategoriaPuesto);
//        return $resultado;
//    }

    public function encargadosXArea($idSedeEmpresaArea) {

        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->encargadosXArea($idSedeEmpresaArea);
        return $resultado;
    }

    public function grabarPersonaEncargada($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarPersonaEncargada($datos);
        return $resultado[0][0];
    }

    public function editarEmpleadoCargo($idEmpleado) {
        $o_DRrhh = new DRrhh();
        $result = $o_DRrhh->editarEmpleadoCargo($idEmpleado);
        $resultado = "NO";
        if ($result) {
            $resultado = $result[0][0] . "|" . $result[0][1] . "|" . $result[0][2] . "|" . $result[0][3];
        }
        return $resultado;
    }

    public function getDatosEncargado($idSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getDatosEncargado($idSedeEmpresaArea);
        $resul = "<p style='font-size: 14px; color: red; font-weight: bold'>No existe encargado alguno</p>";
        if ($resultado) {
            //$nombres = $resultado[0][4] . " " . $resultado[0][5] . " " . $resultado[0][6];
            $nombres = htmlentities($resultado[0][4]) . " " . htmlentities($resultado[0][5]) . " " . htmlentities($resultado[0][6]);
            $hidden = '<input name="hidIdProgramacionPersonal" type="hidden" id="hidIdProgramacionPersonal" value="' . $resultado[0][0] . '" />';
            $resul = "<p style='font-size: 13px;'>Encargado del &Aacute;rea : " . $nombres . "</p><br>" . $hidden;
        }
        return $resul;
    }

    public function grabarHorariosProgramados($datos) {
        $arrayIdTSEA = array();
        $arrayHorasTurno = array();
        $arrayFechaProgEmp = array();
        $idProgramacionPersonal = $datos["idProgramacionPersonal"];
        $idEmpleado = $datos["idEmpleado"];
        $iIdSedeEmpresaAreaCentroCosto = $datos["iIdSedeEmpresaAreaCentroCosto"];
        $arrayIdTSEA = $datos["arrayIdTSEA"];
        $arrayHorasTurno = $datos["arrayHorasTurno"];
        $arrayFechaProgEmp = $datos["arrayFechaProgEmp"];
        $accion = $datos["accion"];
        $modo = $datos["modo"];
        $numprog = $datos["numprog"];
        $idSubArea = $datos["idSubArea"];
        $resultado = "";
        if ($modo[0] == 1) {//insertar nuevos al grabar asi como insertar nuevos al momento de modificar
            $indice = array_keys($arrayIdTSEA);
            foreach ($indice as $i => $value) {
                $o_DRrhh = new DRrhh();
                $resultado = $o_DRrhh->grabarHorariosProgramados($idProgramacionPersonal, $idEmpleado, $iIdSedeEmpresaAreaCentroCosto, $arrayIdTSEA[$i], $arrayHorasTurno[$i], $arrayFechaProgEmp[$i], "grabar", $numprog, $idSubArea);
            }
        }

        if ($accion == "modificar") {//solo para modificar
            $valores = $datos["arrayEditados"];
            if ($modo[1] == 1) {
                $arrayIdDPPDias = array();
                foreach ($valores as $i => $value) {
                    $o_DRrhh = new DRrhh();
                    $arrayIdDPPDias = explode("_", $valores[$i]); //idDPP  -  arrayIdTSEA -   totalHoras
                    if ($arrayIdDPPDias[2] == "DELETE")
                        $resultado = $o_DRrhh->modificarHorariosProgramados($arrayIdDPPDias[0], "", "", "eliminar", $numprog, $idSubArea, $idEmpleado);
                    else {
                        $resultado = $o_DRrhh->modificarHorariosProgramados($arrayIdDPPDias[0], $arrayIdDPPDias[1], $arrayIdDPPDias[2], $accion, $numprog, $idSubArea, $idEmpleado);
                    }
                }
            }
        }
        return $resultado;
    }

    public function adicionarHorariosProgramados($datos) {
        $arrayIdTSEA = array();
        $arrayHorasTurno = array();
        $arrayFechaProgEmp = array();
        $idProgramacionPersonal = $datos["idProgramacionPersonal"];
        $idEmpleado = $datos["idEmpleado"];
        $iIdSedeEmpresaAreaCentroCosto = $datos["iIdSedeEmpresaAreaCentroCosto"];
        $arrayIdTSEA = $datos["arrayIdTSEA"];
        $arrayHorasTurno = $datos["arrayHorasTurno"];
        $arrayFechaProgEmp = $datos["arrayFechaProgEmp"];
        $idDPP = $datos["idDPP"];
        $resultado = "";
        if ($arrayIdTSEA) {//insertar nuevos al grabar asi como insertar nuevos al momento de modificar
            $indice = array_keys($arrayIdTSEA);
            foreach ($indice as $i => $value) {
                $o_DRrhh = new DRrhh();
                //tener en cuenta que con $indice=0 que representa al dia uno del mes, se esta enviando el id del detalle programacion personal $idDPP, en los otros casos se envia el id de programacion personal $idProgramacionPersonal
                if ($i == 0)
                    $resultado = $o_DRrhh->adicionarHorariosProgramados($idDPP, $idEmpleado, $iIdSedeEmpresaAreaCentroCosto, $arrayIdTSEA[$i], $arrayHorasTurno[$i], $arrayFechaProgEmp[$i], "index0", $datos["idSubArea"]);
                else
                    $resultado = $o_DRrhh->adicionarHorariosProgramados($idProgramacionPersonal, $idEmpleado, $iIdSedeEmpresaAreaCentroCosto, $arrayIdTSEA[$i], $arrayHorasTurno[$i], $arrayFechaProgEmp[$i], "index_mas", $datos["idSubArea"]);
            }
        }
        return $resultado;
    }

    public function listaTurnoProgramado($idEmpleadoProgramado, $iIdProgramacionpersonal, $mes, $anio, $accion, $var, $idSEACC, $cboTipoContrato) {

        $o_DRrhh = new DRrhh();

        $resultado = $o_DRrhh->listaTurnoProgramado($idEmpleadoProgramado, $iIdProgramacionpersonal, $mes, $anio, $accion, $var, $idSEACC, $cboTipoContrato);
        return $resultado;
    }

    //ejemplo de avisos al manipular data
    public function asignarSedeArea($datos) {
        $o_DRrhh = new DRrhh();
        $idSedeEmpresaArea = $o_DRrhh->asignarSedeArea($datos);
        $resultado = "<p style='color: red; font-weight: bold'>Error al asignar</p>";
        if ($idSedeEmpresaArea) {
            if (trim($idSedeEmpresaArea[0][0]) == "no")
                $resultado = "<p style='color: red; font-weight: bold'>Esta asignaci&oacute;n ya existe</p>";
            elseif (trim($idSedeEmpresaArea[0][0]) == "si")
                $resultado = "<p style='color: blue; font-weight: bold'>Se asign&oacute; correctamente</p>";
        }
        return $resultado;
    }

    public function desactivarTSEA($idTSEA) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->desactivarTSEA($idTSEA);
        return $resultado;
    }

    public function listaLeyendaTurno() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listaLeyendaTurno();
        $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
        foreach ($resultado as $i => $value) {
            if ($value[4] == 1)
                array_push($resultado[$i], "Activado");
            else
                array_push($resultado[$i], "Desactivado");
            array_push($resultado[$i], $imagen1);
        }
        return $resultado;
    }

    public function agregarTurnoAdicional($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->agregarTurnoAdicional($datos);
        return $resultado;
    }

    public function mostrarReporteAsistencial() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->mostrarReporteAsistencial();
        return $resultado;
    }

    public function listaCategoria($idSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->spListaCategoria($idSedeEmpresaArea);
        return $resultado;
    }

    public function listaCategoria2($idSucursal, $idArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->spListaCategoria2($idSucursal, $idArea);
        return $resultado;
    }

//    public function listaCategoria2($idSedeEmpresaArea) {
//        $o_DRrhh = new DRrhh();
//        $resultado = $o_DRrhh->spListaCategoria2($idSedeEmpresaArea);
//        return $resultado;
//    }
    public function PresentarHorarioEmpleadoTrabjados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->PresentarHorarioEmpleadoTrabjados($datos);
        return $resultado;
    }

    public function datosRutaCarpeta($opcion) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->recuperarRuta($opcion);
        return $resultado;
    }

    public function BusquedaEmpleado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DBusquedaEmpleado($datos);
        $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
        $imagen2 = "../../../../fastmedical_front/imagen/icono/borrar.png ^ Eliminar";
        $imagen3 = "../../../../fastmedical_front/imagen/icono/b_ver_on.gif ^ Eliminar";

        foreach ($resultado as $i => $value) {
            if ($value[18] == 18) {
                $resultado[$i][18] = $imagen1;
//                array_push($resultado[$i], $imagen1);
            }
            if ($value[19] == 19) {
                $resultado[$i][19] = $imagen2;
//                array_push($resultado[$i], $imagen2);
            }
            if ($value[23] == 23) {
                $resultado[$i][23] = $imagen3;
//                array_push($resultado[$i], $imagen3);
            }
        }
        return $resultado;
    }

    public function BusquedaPersonaRegularizar($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->BusquedaPersonaRegularizar($c_cod_per);
        return $resultado;
    }

    public function ActualizarTablansdHorarioRealesAsistencia($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->ActualizarTablansdHorarioRealesAsistencia($datos);
        return $resultado;
    }

    public function getArrayListaAreas($codigoSede) {
        $o_DRrhh = new DRrhh();
        $resultadoArray = array();
        $rs = $o_DRrhh->getArrayListaAreas($codigoSede);
        foreach ($rs as $ind => $fila) {
            $resultadoArray[$ind][0] = $fila[1];
            $resultadoArray[$ind][1] = $fila[2];
        }
        return $resultadoArray;
    }

    public function listarSubAreas($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getArraySubAreas($datos);
        $resultadoArray = array();
        $i = 1;
        foreach ($rs as $ind => $fila) {
            $resultadoArray[$ind][0] = $fila[0];
            $resultadoArray[$ind][1] = $i;
            $resultadoArray[$ind][2] = $fila[1];
            $resultadoArray[$ind][3] = $fila[2];
            $resultadoArray[$ind][4] = $fila[3];
            $resultadoArray[$ind][5] = $fila[3] == 1 ? 'Activado' : 'Desactivado';
            $i++;
        }
        return $resultadoArray;
    }

//    public function comboCategoriaSubArea($idSubArea) {
//        $o_DRrhh = new DRrhh();
//        $respuesta = $o_DRrhh->comboCategoriaSubArea($idSubArea);
//        return $respuesta;
//    }
    public function mntTablaCategoriaArea($datos) {
        $o_DRrhh = new DRrhh();
        $respuesta = $o_DRrhh->mntTablaCategoriaArea($datos);
        $arrayDatos = array();
        $cont = 1;
        foreach ($respuesta as $key => $value) {
            $arrayDatos[$key][0] = $value[0];
            $arrayDatos[$key][1] = $cont;
            $arrayDatos[$key][2] = $value[1];
            $arrayDatos[$key][3] = $value[2];
            $arrayDatos[$key][4] = $value[2] == 1 ? 'Activado' : 'Desactivado';
            $arrayDatos[$key][5] = $value[2] == 1 ? "../../../../fastmedical_front/imagen/icono/cancel.png ^ Desactivar" : "../../../../fastmedical_front/imagen/icono/clean.png ^ Activar";
            ;
            $cont++;
        }
        return $arrayDatos;
    }

    //2012/02/17 redireccionar a otro procedimiento o mejorarlo
    public function grabarSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $respuesta = $o_DRrhh->grabarSubArea($datos);
        return $respuesta;
    }

//****************************

    public function grabarCategoriaSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $respuesta = $o_DRrhh->grabarCategoriaSubArea($datos);
        return $respuesta;
    }

    public function cambiarEstadoCategoriasSubArea($idCategoriaSubArea) {
        $o_DRrhh = new DRrhh();
        $respuesta = $o_DRrhh->cambiarEstadoCategoriasSubArea($idCategoriaSubArea);
        return $respuesta;
    }

    public function listarEmpleadosAreas($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getArrayEmpleadosAreas($datos);
        $resultadoArray = array();
        $i = 1;
        foreach ($rs as $ind => $fila) {
            $resultadoArray[$ind][3] = $fila[3];
            $resultadoArray[$ind][2] = $fila[6] . " " . $fila[7] . " " . $fila[8];
            $resultadoArray[$ind][1] = $i;
            $resultadoArray[$ind][0] = $fila[5];
            $i++;
        }
        return $resultadoArray;
    }

    public function listarEmpleadosSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->getArrayEmpleadosSubArea($datos);
        $resultadoArray = array();
        $i = 1;
        foreach ($rs as $ind => $fila) {
            $resultadoArray[$ind][4] = "../../../../fastmedical_front/imagen/icono/editdelete.png ^ Ver";
            $resultadoArray[$ind][3] = $fila[2];
            $resultadoArray[$ind][2] = $fila[1];
            $resultadoArray[$ind][1] = $i;
            $resultadoArray[$ind][0] = $fila[0];
            $i++;
        }
        return $resultadoArray;
    }

    public function eliminarEmpleadoSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->eliminarEmpleadoSubArea($datos);
        return $resultado;
    }

    public function asignacionEmpleadoaSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->asignacionEmpleadoaSubArea($datos);
        return $resultado;
    }

    public function listaCoordinadoresAreas($iCodEmpCoordinador) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getArrayCoordinadoresAreas($iCodEmpCoordinador);
        $resultadoArray = array();
        foreach ($resultado as $ind => $valor) {
            $aux = $valor[0];
            $valor[0] = $valor[1];
            $valor[1] = htmlentities($aux);
            $resultadoArray[$ind] = $valor;
        }
        return $resultadoArray;
    }

    public function obtenerAreasdelCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getArrayAreasdelCoordinador($datos);
        return $resultado;
    }

    public function obtenerSubAreasdelAreadelCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getArraySubAreasdelAreadelCoordinador($datos);
        return $resultado;
    }

    public function obtenerCategoriasdelArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getArrayCategoriasdelArea($datos);
        return $resultado;
    }

    public function obtenerEmpleadosCategoriadelSubArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->getArrayEmpleadosCategoriadelSubArea($datos);
        return $resultado;
    }

    public function cboSedeEmpresaArea($idSedeEmpresa) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->cboSedeEmpresaArea($idSedeEmpresa);
        return $resultado;
    }

    public function asignarPuestoSedeArea($idSedeEmpresa, $idPuesto) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->asignarPuestoSedeArea($idSedeEmpresa, $idPuesto);
        return $resultado;
    }

    public function mostrarPuestoArea($idPuesto) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->mostrarPuestoArea($idPuesto);
        $imgEliminar = "../../../../fastmedical_front/imagen/icono/cancel.png ^ Eliminar";
        foreach ($resultado as $i => $value) {
            array_push($resultado[$i], $imgEliminar);
        }
        return $resultado;
    }

    public function eliminacionFisicaPuestoArea($iidPuestoSedeEmpresa) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->eliminacionFisicaPuestoArea($iidPuestoSedeEmpresa);
        return $resultado;
    }

    public function grabarContrato($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarContrato($datos);
        return $resultado;
    }

    public function codigoProgramacionHorario($idEmpleado) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->codigoProgramacionHorario($idEmpleado);
        return $resultado;
    }

    public function verificarExisteHorario($coordinador, $idSubArea, $idCategoria, $mes, $anio) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->verificarExisteHorario($coordinador, $idSubArea, $idCategoria, $mes, $anio);
        return $resultado;
    }

    public function registrarProgramacionHorario($cadenaCuerpo, $idProgramacion, $idSubArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->registrarProgramacionHorario($cadenaCuerpo, $idProgramacion, $idSubArea);
        return $resultado;
    }

    public function busquedaEmpleadoRegularizar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->busquedaEmpleadoRegularizar($datos);
        return $resultado;
    }

    public function guardarEmpleadoRegularizar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->guardarEmpleadoRegularizar($datos);
        return $resultado[0][0];
    }

    public function HorariosTurnos($codigoCordinador) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->HorariosTurnos($codigoCordinador);
        ;
        return $resultado;
    }

    public function eliminarAsistencia($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->eliminarAsistencia($datos);
        return $resultado;
    }

    public function exportarExcelEncargadosMorosos($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->exportarExcelEncargadosMorosos($datos);
        return $resultado;
    }

    public function exportarExcelEncargados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->exportarExcelEncargados($datos);
        return $resultado;
    }

    public function fechaProgramacion($iIdProgramacionpersonal) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->fechaProgramacion($iIdProgramacionpersonal);
        return $resultado;
    }

    public function personalVacaciones() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->personalVacaciones();
        return $resultado;
    }

    public function personalDescansoMedico() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->personalDescansoMedico();
        return $resultado;
    }

    public function desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->desactivarEmpleadoArea($idCodigoEmpleado, $idCodigoSEACC);
        return $resultado;
    }

    public function exportarExcelArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->exportarExcelArea($datos);
        return $resultado;
    }

    public function arbolAreas($idSedeEmpresa) {

        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->arbolAreas($idSedeEmpresa);
        return $resultado;
    }

    // 23 enero

    public function larbolPracticasOdontologicas() {

        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->darbolPracticasOdontologicas();
        return $resultado;
    }

    public function lArbolCentroCostos() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dArbolCentroCostos();
        return $resultado;
    }

    public function arbolAreas2($idSedeEmpresa) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->arbolAreas2($idSedeEmpresa);
        return $resultado;
    }

    public function lGeneraArbolCentroCostos() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dGeneraArbolCentroCostos();
        return $resultado;
    }

    public function nombreCoordinador($iCodEmpCoordinador) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->nombreCoordinador($iCodEmpCoordinador);
        return $resultado;
    }

    public function ListaSede($iCodEmpCoordinador) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->ListaSede($iCodEmpCoordinador);
        return $resultado;
    }

    public function ListaTodasSede() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->ListaTodasSede();
        return $resultado;
    }

    public function CargarArea($iCodEmpCoordinador, $cboSede) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarArea($iCodEmpCoordinador, $cboSede);
        return $resultado;
    }

//        print_r($resultado);

    public function CargarlistadoTodosCordinadores($cboSede) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarlistadoTodosCordinadores($cboSede);


//    print_r( $array[0][1]+ '/'+$array[0][2]+'/'+$array[0][3]);
        //////////////////////////////////////
        $j = 0;
        foreach ($resultado as $fila) {
//            $resultado[$j][3] = $array[$j][2];
//            $resultado[$j][3] = $j + 1;
            If ($resultado[$j][2] == '1') {
                $resultado[$j][2] = "Area";
//                $resultado[$j][4] = "<a onclick='javascript:desactivarProfesion(" . $array[$j][2] . ");'><img border='0' title='Desactivar' src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif'/></a>";
            } else if ($resultado[$j][2] == '2') {
                $resultado[$j][2] = "Sub Area";
//                $resultado[$j][4] = "<a onclick='javascript:activarProfesion(" . $array[$j][2] . ");'><img border='0' title='Activar' src='../../../../fastmedical_front/imagen/icono/op_atendido.gif'/></a>";
            }
            $j++;
        }
//        return $array;




        foreach ($resultado as $i => $valuey) {

            // $valuey[4] = "<a href='#' onclick=\"grabarAsignacionServicioaPuesto('" . $fila[0] . "');\"><img src='../../../../fastmedical_front/imagen/icono/window_new.png' title='Asignar Servicio'/></a>";

            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ AsignarTurn");
        }

        foreach ($resultado as $j => $valuem) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/kopeteavailable.png ^ AsignarCoordina");
        }
        foreach ($resultado as $j => $valuen) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/date.png ^ Horarios");
        }

        return $resultado;
    }

    public function CargarlistaPuestosXCentroCostos($idCentroDeCosto) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarlistaPuestosXCentroCostos($idCentroDeCosto);

        return $resultado;
    }

    public function CargarlistadoTodosCordinadoresFiltrado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarlistadoTodosCordinadoresFiltrado($datos);


        $j = 0;
        foreach ($resultado as $fila) {
            If ($resultado[$j][2] == '1') {
                $resultado[$j][2] = "Area";
            } else if ($resultado[$j][2] == '2') {
                $resultado[$j][2] = "Sub Area";
            }
            $j++;
        }

        foreach ($resultado as $i => $valuey) {

            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ AsignarTurn");
        }

        foreach ($resultado as $j => $valuem) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/kopeteavailable.png ^ AsignarCoordina");
        }
        foreach ($resultado as $j => $valuen) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/date.png ^ Horarios");
        }

        return $resultado;
    }

/////////////////////////////////////////////////////////////////////////////original


    public function CargarlistadoTodasAreasSinCoordinador($cboSede) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarlistadoTodasAreasSinCoordinador($cboSede);

//        $imgTurno1 = "../../../../fastmedical_front/imagen/icono/cancel.png ^ AsignarTurno";
//            public function BusquedaEmpleado($datos) {
//        $o_DRrhh = new DRrhh();
//        $resultado = $o_DRrhh->BusquedaEmpleado($datos);
//        $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
//        $imagen2 = "../../../../fastmedical_front/imagen/icono/borrar.png ^ Eliminar";
//
//        foreach ($resultado as $i => $value) {
//            array_push($resultado[$i], $imagen1);
//            array_push($resultado[$i], $imagen2);
//        }
//        return $resultado;
//    }

        $j = 0;
        foreach ($resultado as $fila) {

            If ($resultado[$j][2] == '1') {
                $resultado[$j][2] = "Area";
            } else if ($resultado[$j][2] == '2') {
                $resultado[$j][2] = "Sub Area";
            }
            $j++;
        }



        foreach ($resultado as $i => $valuey) {
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ AsignarTurn");
//            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/demo.png ^ AsignarCoordinar");
        }

//        $imgCoordinador = "../../../../fastmedical_front/imagen/icono/demo.png ^ AsignarCoordinar";
        foreach ($resultado as $j => $valuem) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/kopeteavailable.png ^ AsignarCoordina");
        }

        return $resultado;
    }

    public function CargarlistadoTodasAreasSinCoordinadorFiltrado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->CargarlistadoTodasAreasSinCoordinadorFiltrado($datos);

//        $imgTurno1 = "../../../../fastmedical_front/imagen/icono/cancel.png ^ AsignarTurno";
//            public function BusquedaEmpleado($datos) {
//        $o_DRrhh = new DRrhh();
//        $resultado = $o_DRrhh->BusquedaEmpleado($datos);
//        $imagen1 = "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar";
//        $imagen2 = "../../../../fastmedical_front/imagen/icono/borrar.png ^ Eliminar";
//
//        foreach ($resultado as $i => $value) {
//            array_push($resultado[$i], $imagen1);
//            array_push($resultado[$i], $imagen2);
//        }
//        return $resultado;
//    }


        $j = 0;
        foreach ($resultado as $fila) {

            If ($resultado[$j][2] == '1') {
                $resultado[$j][2] = "Area";
            } else if ($resultado[$j][2] == '2') {
                $resultado[$j][2] = "Sub Area";
            }
            $j++;
        }







        foreach ($resultado as $i => $valuey) {
            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/editar.png ^ AsignarTurn");
//            array_push($resultado[$i], "../../../../fastmedical_front/imagen/icono/demo.png ^ AsignarCoordinar");
        }

//        $imgCoordinador = "../../../../fastmedical_front/imagen/icono/demo.png ^ AsignarCoordinar";
        foreach ($resultado as $j => $valuem) {
            array_push($resultado[$j], "../../../../fastmedical_front/imagen/icono/kopeteavailable.png ^ AsignarCoordina");
        }

        return $resultado;
    }

    public function ListarEmpleadosPreProgramados($iCodEmpCoordinador, $datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->ListarEmpleadosPreProgramados($iCodEmpCoordinador, $datos);
        return $resultado;
    }

    public function listarEmpleados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listarEmpleados($datos);
        return $resultado;
    }

    public function insercionPreProgramacion($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->insercionPreProgramacion($datos);
        return $resultado;
    }

    ////agregado miecoles 14 marzo jcqa

    public function insercionTurnoDisponibleAlArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->insercionTurnoDisponibleAlArea($datos);
        return $resultado;
    }

//Modificado 20 Abril 2012

    public function grabarColorSelecionadoTurnoAreaSede($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->grabarColorSelecionadoTurnoAreaSede($datos);
        return $resultado;
    }

    public function actualizacionEstadoPuestoSedeEmpresaArea($idPuestoEmpleadoPorArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->actualizacionEstadoPuestoSedeEmpresaArea($idPuestoEmpleadoPorArea);
        return $resultado;
    }

    public function listarEmpleadosProgramados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->listarEmpleadosProgramados($datos);
        return $resultado;
    }

    public function actualizarEstadoPreProgramacion($idPreProgramacionPersonal) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->actualizarEstadoPreProgramacion($idPreProgramacionPersonal);
        return $resultado;
    }

    ////modifi

    public function quitarTurnoSeleccionadoAlArea($idTurnoAreaSede) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->quitarTurnoSeleccionadoAlArea($idTurnoAreaSede);
        return $resultado;
    }

    public function actualizacionEstadoPuestoSedeEmpresaAreadescativacion($idPuestoEmpleadoPorArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->actualizacionEstadoPuestoSedeEmpresaAreadescativacion($idPuestoEmpleadoPorArea);
        return $resultado;
    }

    public function mantenimientoCaja($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->mantenimientoCaja($c_cod_per);
        return utf8_encode($resultado[0][0]);
    }

    public function maximonumeroCaja($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->maximonumeroCaja($c_cod_per);
        return $resultado;
    }

    public function LtipoComprobante($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DtipoComprobante($c_cod_per);
        return $resultado;
    }

    public function LtipoComprobanteNoSeleccionado($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DtipoComprobanteNoSeleccionado($c_cod_per);
        return $resultado;
    }

    public function UsuarioCaja($c_cod_per) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->UsuarioCaja($c_cod_per);
        return $resultado;
    }

    public function LempleadoCajero($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DempleadoCajero($datos);
        return $resultado;
    }
    public function lElimnarCajaComprobante($iIdCajaComprobante) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dElimnarCajaComprobante($iIdCajaComprobante);
        return $resultado;
    }
    

    public function LserieComprobante($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DserieComprobante($datos);
        return $resultado;
    }

    public function LmodificarSerieEstado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DmodificarSerieEstado($datos);
        return $resultado;
    }

    //Jose Delgado 18/04/2012 10Am
    public function tablaMarcacionEmpleadosAudiotira($parametros) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->tablaMarcacionEmpleadosAudiotira($parametros);
        return $resultado;
    }

    /*     * *******************vacaciones************** */

    //JCDB 07/05/2012
    public function comboTipoDescanso() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->comboTipoDescanso();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities(strtoupper($fila[1]));
        }
        return $resultadoArray;
    }

    public function tablaDescansoContratoEmpleado($parametros) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->tablaDescansoContratoEmpleado($parametros);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/editar.png ^ Editar");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/borrar_.png ^ Eliminar");
        }
        return $rs;
    }

    public function guardarVacaciones($parametros) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->guardarVacaciones($parametros);
        return $resultado[0][0];
    }

    public function eliminarVacaciones($parametros) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->eliminarVacaciones($parametros);
        return $resultado[0][0];
    }

    public function desactivarPuestoenCentroCostos($parametros) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->desactivarPuestoenCentroCostos($parametros);
        return $resultado[0][0];
    }

    /*     * *********************fin vacaciones********* */

    // Inicio  RRHH lobo
    public function LDesactivarCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DDesactivarCoordinador($datos);
        return $resultado;
    }

    public function LActivarCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DActivarCoordinador($datos);
        return $resultado;
    }

    public function LActivarCordinadorXarea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DActivarCordinadorXarea($datos);
        foreach ($resultado as $key => $value) {
            if ($value[2] == 1) {
                array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/button_cancel.png ^ Desactivar");
            } else {
                if ($value[2] == 0) {
                    array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/good.gif ^ Activar");
                }
            }
        }

        return $resultado;
    }

    public function LdarPermisoEspecialAlCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DarPermisoEspecialAlCoordinador($datos);
        return $resultado;
    }

    public function LfechaSistema() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DfechaSistema();
        return $resultado;
    }

    public function LAreaDeLosCoordinadores($iCodEmpCoordinador, $anio, $mes) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DAreaDeLosCoordinadores($iCodEmpCoordinador, $anio, $mes);
        return $resultado;
    }

    public function LempleadosXsusArea($iIdSedeEmpresaArea, $anio, $mes, $idCategoria) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DempleadosXsusArea($iIdSedeEmpresaArea, $anio, $mes, $idCategoria);
        return $resultado;
    }

    public function LempleadosXturnos($iIdPreProgramacion, $anio, $mes, $nDias, $numeroProgramaciones, $posicion, $iIdPuestoEmpleado, $numeroProgramado, $iIdSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DempleadosXturnos
                ($iIdPreProgramacion, $anio, $mes, $nDias, $numeroProgramaciones, $posicion, $iIdPuestoEmpleado, $numeroProgramado, $iIdSedeEmpresaArea);
        return $resultado;
    }

    public function ListaTurnosArea($codigoSedeEmpresaArea,$anno,$mes) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DlistaTurnosArea($codigoSedeEmpresaArea,$anno,$mes);
        return $resultado;
    }

    public function LguardarTurnoProgramadoGrupo($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DguardarTurnoProgramadoGrupo($datos);
        return $resultado;
    }

    public function LmodificarTurnoProgramadoIndividuar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DmodificarTurnoProgramadoIndividuar($datos);
        return $resultado;
    }

    public function LeliminarTurnoProgramadoIndividuar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DeliminarTurnoProgramadoIndividuar($datos);
        return $resultado;
    }

    public function ListaTurnosAreaDescanso() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DlistaTurnosAreaDescanso();
        return $resultado;
    }

    /// fin de RRHH Lobo//
    //
    ///  de Medicos Lobo//
    public function getListaMedicos($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_DRrhh = new DRrhh();
        if ($estado == '') {
            
        }
        if ($cod != '' && $nDoc == '' && $apPat == '') {
            $rs = $o_DRrhh->getListaMedicoXCod($cod);
        }
        if ($nDoc != "Buscar..." && $nDoc != '') {
            $rs = $o_DRrhh->getListaMedicoXDoc($tipoDoc, $nDoc);
        }
        if ($apPat != '' || $apMat != '' || $nombre != '') {
            $rs = $o_DRrhh->getListaMedicoXNombre($apPat, $apMat, $nombre, $estado);
        }
//        if($estado!='') {
//            $rs = $o_DRrhh->getListaEmpleadosXEstado($estado);
//        }
        //$array = $this->filasEmpleados($rs);
        return $rs;
    }

    public function LreporteBusquedaMedico($datos, $cantidadMedicosRegistro) {
        $o_DRrhh = new DRrhh();

        $resultado = $o_DRrhh->DreporteBusquedaMedico($datos, $cantidadMedicosRegistro);
        foreach ($resultado as $key => $value) {
            array_push($resultado[$key], $cantidadMedicosRegistro);
        }
        return $resultado;
    }

    public function LreporteBusquedaMedicoX($datos, $cantidadMedicosRegistro) {
        $o_DRrhh = new DRrhh();

        $resultado = $o_DRrhh->DreporteBusquedaMedico($datos, $cantidadMedicosRegistro);

        return $resultado;
    }

    public function LcantidadRegistroMedico($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DcantidadRegistroMedico($datos);
        return $resultado;
    }

    public function LverEmpleadoCaducaSuContratoTabla() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DverEmpleadoCaducaSuContratoTabla();
        return $resultado;
    }

    public function LprogramacionAsistenciaPersonalRRHH($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DprogramacionAsistenciaPersonalRRHH($datos);
        return $resultado;
    }

    public function lMantenimientoAreaPersona($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dMantenimientoAreaPersona($datos);
        return $resultado;
    }

    public function lActualizarProgramacionEmpleados($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dActualizarProgramacionEmpleados($datos);
        return $resultado;
    }

    public function lListaPersonal() {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->dListaPersonal();
        return $resultado;
    }

    public function lListaPersonalDeAsistencia($txtFechainicio, $txtFechafin) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DListaPersonalDeAsistencia($txtFechainicio, $txtFechafin);
        return $resultado;
    }

    public function busquedaPersonalPorNombres($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->busquedaPersonalPorNombres($datos);
        return $resultado;
    }

    public function busquedaPersonalPorDNI($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->busquedaPersonalPorDNI($datos);
        return $resultado;
    }

    public function datosPersonalSeleccionadoXcoodinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->datosPersonalSeleccionadoXcoodinador($datos);
        return $resultado;
    }

//-------------------------------------SANDY-------------------------------------------------
//-------------------------------------------------------------------------------------------

    public function LprogramacionPorArea($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DprogramacionPorArea($datos);
        return $resultado;
    }

    public function LprogramacionPorAreaSede($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->LprogramacionPorAreaSede($datos);
        return $resultado;
    }

    public function datosAreasDeCoordinador($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->datosAreasDeCoordinador($datos);
        return $resultado;
    }

    public function LverificarTurnoProgramadoIndividuar($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DverificarTurnoProgramadoIndividuar($datos);
        return $resultado;
    }

    public function areasPorProgramacionEmpleado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->areasPorProgramacionEmpleado($datos);
        return $resultado;
    }

    public function programacionPorEmpleadoDetalleSede($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->programacionPorEmpleadoDetalleSede($datos);
        return $resultado;
    }

    public function cargarTablaProgramacionEmpleadoEliminarTurno($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->cargarTablaProgramacionEmpleadoEliminarTurno($datos);
        return $resultado;
    }

    public function LprogramacionSeleccionadaTurno($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DprogramacionSeleccionadaTurno($datos);
        return $resultado;
    }

    public function cargarTablaTurnosPreProgramacion($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->cargarTablaTurnosPreProgramacion($datos);
        return $resultado;
    }

    public function btnEliminarProgramacoinPreProgramacionSelecionado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->btnEliminarProgramacoinPreProgramacionSelecionado($datos);
        return $resultado;
    }

//-----------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------- 
    public function datosAreasDeEmpleado($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->datosAreasDeEmpleado($datos);
        return $resultado;
    }

    public function validarDatosContratoPersonal($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->validarDatosContratoPersonal($datos);
        return $resultado;
    }

    public function ListaTurnosAreaUsado($codigoSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DListaTurnosAreaUsado($codigoSedeEmpresaArea);
        return $resultado;
    }

    public function LturnosEmpleadosReales($codigoProgramacion) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DturnosEmpleadosReales($codigoProgramacion);
        return $resultado;
    }

    public function DeliminarTurnoPersona($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DeliminarTurnoPersona($datos);
        return $resultado;
    }

    public function LreportePerActElimInsert($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DreportePerActElimInsert($datos);
        return $resultado;
    }

    public function LbuscarEmpleadosAreasNombre($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DbuscarEmpleadosAreasNombre($datos);
        return $rs;
    }

    public function LbuscaEmpleadoHorario($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre, $dFechaInicio, $dFechaFin) {
        $o_DRrhh = new DRrhh();
        if ($estado == '') {
            
        }
        if ($cod != '' && $nDoc == '' && $apPat == '') {
            $rs = $o_DRrhh->getListaEmpleadosXCod($cod);
        }
        if ($nDoc != "Buscar..." && $nDoc != '') {
            $rs = $o_DRrhh->getListaEmpleadosXDoc($tipoDoc, $nDoc);
        }
        if ($apPat != '' || $apMat != '' || $nombre != '') {
            // $rs = $o_DRrhh->DbusquedaEmpleadosRegularizar($apPat, $apMat, $nombre, $estado);
            $rs = $o_DRrhh->DbuscaEmpleadoHorario($apPat, $apMat, $nombre, $estado, $dFechaInicio, $dFechaFin);
        }
//        if($estado!='') {
//            $rs = $o_DRrhh->getListaEmpleadosXEstado($estado);
//        }

        $array = $this->filasEmpleados($rs);
//        $j = 0;

        foreach ($array as $key => $value) {
            array_push($array[$key], "../../../../fastmedical_front/imagen/icono/blank.gif");
        }

        return $array;
    }

    public function LbuscarEmpleadoHorarioSusAreas($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DbuscarEmpleadoHorarioSusAreas($datos);
        return $rs;
    }

    public function LregularizacionAsistenciaPorCambioPersonal($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DregularizacionAsistenciaPorCambioPersonal($datos);
        return $rs;
    }

    public function LcargarTabladePersonaReemplazo($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DcargarTabladePersonaReemplazo($datos);
        return $rs;
    }

    public function LguardarEmpleadoReemplazador($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DguardarEmpleadoReemplazador($datos);
        return $rs;
    }

    public function LhoraExtrasTrabajadas($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DhoraExtrasTrabajadas($datos);
        return $rs;
    }

    public function LabrirPopapAsignacionDeTurnosAsignados($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DabrirPopapAsignacionDeTurnosAsignados($datos);
        return $rs;
    }

    public function LsedesHospital() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DsedesHospital();
        return $rs;
    }

    public function LdescripcionCboSedeArea($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DdescripcionCboSedeArea($datos);
        return $rs;
    }

    public function LdescripcionCboSedeAreaTurno($iIdSedeEmpresaArea) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DdescripcionCboSedeAreaTurno($iIdSedeEmpresaArea);
        return $rs;
    }

    public function LguardarNuevaProgramacionReemplanzo($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DguardarNuevaProgramacionReemplanzo($datos);
        return $rs;
    }

    /*     * ******************************************************************* */

    public function LbuscarMedico($cod, $estado, $tipoDoc, $nDoc, $apPat, $apMat, $nombre) {
        $o_DRrhh = new DRrhh();
        if ($estado == '') {
            
        }
        if ($cod != '' && $nDoc == '' && $apPat == '') {
            $rs = $o_DRrhh->getBuscaMedicoXCod($cod);
        }
        if ($nDoc != "Buscar..." && $nDoc != '') {
            $rs = $o_DRrhh->getBuscaMedicoXDoc($tipoDoc, $nDoc);
        }
        if ($apPat != '' || $apMat != '' || $nombre != '') {
            $rs = $o_DRrhh->DBuscaMedico($apPat, $apMat, $nombre, $estado);
        }
        //   $array = $this->filasEmpleados($rs);

        $array = array();
        $j = 0;
        foreach ($rs as $fila) {
            $array[$j][0] = $rs[$j][0];
            $array[$j][1] = $rs[$j][1];
            If ($rs[$j][3] == '1') {
                $array[$j][3] = "ACTIVO";
            } else {
                $array[$j][3] = "INACTIVO";
            }
            $array[$j][2] = $rs[$j][2];
            $array[$j][4] = $rs[$j][4];
            $array[$j][5] = $rs[$j][5];
            $array[$j][6] = $rs[$j][6];
            $j++;
        }

        return $array;
    }

    public function LbuscarMedicosCentroCostosHorarios($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DbuscarMedicosCentroCostosHorarios($datos);
        return $rs;
    }

    /*     * ******************************************************************* */

    public function LBuscarLasSedes($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DbuscarLasSedes($datos);
        return $rs;
    }

    public function LBuscarPuestoEmpleado($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DbuscarPuestoEmpleado($datos);
        return $rs;
    }

    public function LcboTipoProgramacion($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DcboTipoProgramacion($datos);
        return $rs;
    }

    public function LBuscarPuesto($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DBuscarPuesto($datos);
        return $rs;
    }

    public function LSedeAreaSeleccionada($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DSedeAreaSeleccionada($datos);
        return $rs;
    }

    public function LguardarPersonalTurnoRegularizar($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DguardarPersonalTurnoRegularizar($datos);
        return $rs;
    }

//   -----------------------------------------------------------------------
    public function DmodalidadContrato() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DmodalidadContrato();
        return $rs;
    }

    public function LreporteAsistenciaMedico($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DreporteAsistenciaMedico($datos);
        return $rs;
    }

    public function LdescripcionCboSedeArea1($datos) {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DdescripcionCboSedeArea1($datos);
        return $rs;
    }

    public function LMotivoReProgramacion() {
        $o_DRrhh = new DRrhh();
        $rs = $o_DRrhh->DMotivoReProgramacion();
        return $rs;
    }

    public function LvalidarQueNoExitaProgramacion($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DvalidarQueNoExitaProgramacion($datos);
        return $resultado;
    }

    public function LTablevalidarQueNoExitaProgramacion($datos) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DvalidarQueNoExitaProgramacion($datos);

        foreach ($resultado as $j => $valuem) {
            $resultado[$j][5] = "../../../../fastmedical_front/imagen/icono/borrar.png ^ Eliminar";
        }
        return $resultado;
    }

      public function LeliminarProgramacion($datos){
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DeliminarProgramacion($datos);
        return $resultado;
    }
        public function ListaTurnosAreaExcel($codigoSedeEmpresaArea,$anno,$mes) {
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->DlistaTurnosAreaExcel($codigoSedeEmpresaArea,$anno,$mes);
        return $resultado;
    }

}

?>
