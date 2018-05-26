<?php

include_once("../../cdatos/DCronograma.php");

class LCronograma {

    private $dCronograma;
    private $idCronograma;
    private $horarios;
    private $tiempoAtencion;
    private $cronogramaInformes;
    private $numerosubcabeceras;
    private $cadenaestadopagos;

    public function __construct() {
        $this->dCronograma = new DCronograma();
        $this->idCronograma = array();
        $this->horarios = array();
        $this->tiempoAtencion = 0;
        $this->cronogramaInformes = array();
        $this->numerosubcabeceras = 0;
        $this->cadenaestadopagos = "";
    }

    public function getCronogramaMedico($parametros) {
        return $this->dCronograma->getArrayCronogramaMedico($parametros);
    }

    public function guardarAfiliacionesXMedico($datos) {
        return $this->dCronograma->dguardarAfiliacionesXMedico($datos);
    }

    public function EliminarAfiliacionesXMedico($datos) {
        return $this->dCronograma->EliminarAfiliacionesXMedico($datos);
    }

    public function getCronogramaMedicoporMedico($parametros) {
        return $this->dCronograma->getArrayCronogramaMedicoporMedico($parametros);
    }

    public function getCronogramaMedicoporEspecialidad($parametros) {
        return $this->dCronograma->getArrayCronogramaMedicoporEspecialidad($parametros);
    }

    public function getCronogramaMedicoSede($parametros) {
        return $this->dCronograma->getArrayCronogramaMedicoporSede($parametros);
    }

    public function getCronogramaFiltroDato($parametros) {
        return $this->dCronograma->getArrayCronogramaFiltroDato($parametros);
    }

    public function getCronogramaMedicoObjecto($patron) {
        return $resultado = $this->dCronograma->getObjectCronogramaID($patron);
    }

    public function getListaProfesional($usuario) {
        $oDCronograma = new DCronograma();
        $rs1 = $oDCronograma->getArrayProfesional($usuario);
        $resultadoArray = array();
        foreach ($rs1 as $fila) {
            $fila['parametro'] = "../../ccontrol/control/control.php?p1=cro_busca_profesional_total&p2=" . $fila[7] . "','detalle_programacion";
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function getListaProfesionalTotal($oficina) {
//$usuario = empty($usuario)?'':$usuario;
        $rs1 = $this->dCronograma->getArrayProfesionalOficina($oficina);
        $resultadoArray = array();
        foreach ($rs1 as $fila) {
            $fila['parametro'] = "../../ccontrol/control/control.php?p1=cro_formulario_registro&p2=" . $fila[0] . "','Contenido";
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    function getDatosCronogramaMedico($bus, $id_cronograma) {
        return $this->dCronograma->getObjectCronogramaID($id_cronograma);
    }

    function getListaCronogramaporPersonalSalud($parametros) {
        return $this->dCronograma->getArrayCronogramaMedico($parametros);
    }

    function getDatosDisponibilidadCupos($bus, $id_cronograma) {
        return $this->dCronograma->getDisponibilidadCupos($id_cronograma);
    }

    function getListaProfesionalSalud($opcion, $patron1, $patron2, $patron3) {
        $resultado = $this->dCronograma->getArrayProfesionalSalud($opcion, $patron1, $patron2, $patron3);
        return $resultado;
    }

    public function getListaProfesionalCargo($persona) {
        $record = $this->dCronograma->getArrayProfesionalCargo($persona);
        return $record;
    }

    public function getListaCronogramaOficina($persona) {
        $usuario = empty($persona) ? '' : $persona;
        $record = $this->dCronograma->getArrayCronogramaOficina($persona);
        $resultadoArray = array();
        foreach ($record as $fila) {
            $fila[2] = '<a href="#" onclick="listaCronogramaOficina(\'' . $fila[0] . '\')"><img src="' . $_SESSION['path_principal'] . '../fastmedical_front/imagen/icono/mostrar.png" alt="VER" title="VER"/></a>';
            $fila[3] = '<img src="' . $_SESSION['path_principal'] . '../fastmedical_front/imagen/icono/button_ok.png" alt="HABILITAR" title="HABILITAR"/>';
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function getListaCronogramaPrincipal($mes_actual = '', $ano_actual = '', $persona, $oficina) {
        $oHospitalizacion = new LHospitalizacion();
        $oficina = $oficina == '' ? '%' : $oficina;
        $mes_actual = $mes_actual == '' ? intval(date('m')) : $mes_actual;
        $ano_actual = $ano_actual == '' ? date('Y') : $ano_actual;
        $inicio_mes = date('d/m/Y', mktime(0, 0, 0, $mes_actual, 1, $ano_actual));
        $fin_mes = date('d/m/Y', mktime(0, 0, 0, $mes_actual + 1, 0, $ano_actual));
        $record = $this->dCronograma->getArrayCronogramaPrincipal($inicio_mes, $fin_mes, $persona, $oficina);
        $resultadoArray = array();
        foreach ($record as $fila) {
            $fila[0] = $oHospitalizacion->getDiaEspaniol($fila[0]);
            $fila['turno'] = $fila[5] . '-' . $fila[6];
            $fila['cupos'] = $oHospitalizacion->getCupos($fila[7], $fila[5], $fila[6]);
            $cal_valores = "|" . $fila[1] . "|";
            $fila['opcion'] = '<a href="#" onclick=mostrarCalendario("' . $fila[12] . '","' . $fila[13] . '","' . $fila[11] . '","' . $fila[8] . '","' . $fila[9] . '","' . substr($fila[1], 0, 2) . '","' . substr($fila[1], 3, 2) . '","' . substr($fila[1], 6, 4) . '","' . $cal_valores . '",1,"' . $fila[14] . '") ><img src="' . $_SESSION['path_principal'] . '../fastmedical_front/imagen/icono/i_edit.png" border="0"/></a>&nbsp;<a href="#" onclick=cancelaCalendario("' . $fila[14] . '","' . $fila[1] . '")><img src="' . $_SESSION['path_principal'] . '../fastmedical_front/imagen/icono/agt_action_fail.png" border="0"/></a>';
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function getSeleccionOficinaHospital() {
        $record = $this->dCronograma->getArrayOficinaHospital();
        $resultadoArray = array();
        foreach ($record as $fila) {
            $resultadoArray[$fila[0]] = $fila[1];
        }
        return $resultadoArray;
    }

    public function getSeleccionActividad() {
        $record = $this->dCronograma->getArrayActividad();
        $resultadoArray = array();
        foreach ($record as $fila) {
            $resultadoArray[$fila[0]] = $fila[1];
        }
        return $resultadoArray;
    }

    public function getSeleccionProducto($oficina = '%', $producto = '%', $actividad = '%') {
        $record = $this->dCronograma->getArrayProducto($oficina, $producto, $actividad);
        $resultadoArray = array();
        if (!empty($record)) {
            foreach ($record as $fila) {
                $resultadoArray[$fila[2]] = $fila[3];
            }
        }
        return $resultadoArray;
    }

    public function getSeleccionAmbiente($oficina = '%', $actividad = '%') {
        $record = $this->dCronograma->getArrayAmbiente($oficina, $actividad);
        $resultadoArray = array();
        if (!empty($record)) {
            foreach ($record as $fila) {
                $resultadoArray[$fila[5]] = $fila[6];
            }
        }
        return $resultadoArray;
    }

    public function getSeleccionTurno() {
        $record = $this->dCronograma->getArrayTurno();
        $resultadoArray = array();
        if (!empty($record)) {
            foreach ($record as $fila) {
                $resultadoArray[$fila[0]] = $fila[1] . ' - ' . $fila[2];
            }
        }
        return $resultadoArray;
    }

    public function getValidaCronograma($persona, $oficina, $actividad, $ambiente, $producto, $turno, $fecha) {
        $record = $this->dCronograma->getArrayValidaCronograma($persona, $oficina, $actividad, $ambiente, $producto, $turno, $fecha);
        return $record[0];
    }

    public function getMantenimientoCronograma($accion, $vid_cronograma_ant, $persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos) {
        $iid_persona = $iid_persona == '' ? 0 : $iid_persona;
        $ambiente = $ambiente == '' ? 0 : $ambiente;
        $oficina = $oficina == '' ? '' : $oficina;
        $turno = $turno == '' ? 0 : $turno;
        $fecha = $fecha == '' ? '' : $fecha;
        $producto = $producto == '' ? '' : $producto;
        $actividad = $actividad == '' ? 0 : $actividad;
        $cupos = $cupos == '' ? 0 : $cupos;
        if ($accion == 'delete') {
            $record = $this->dCronograma->getArrayMantenimientoCronograma($accion, $vid_cronograma_ant, $persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos);
            if ($record)
                $resultado = 'Operacion exitosa fecha ' . $fecha;
            else
                $resultado = 'Error en la operacion fecha ' . $fecha;
            $resultado = '<input type="text" id="mensaje_crono" name="mensaje_crono" style="width:280px; border-width:0; text-align:center;" value="' . $resultado . '"/>';
        }
        else {
            if ($fecha <> '' and $accion <> '') {
                $row = $this->dCronograma->getArrayConsultaTiempo($producto);
                $tiempo = $row['ntiempo'];
                $row = $this->dCronograma->getArrayConsultaTurno($turno);
                if ($tiempo > 0) {
                    $separar[1] = explode(':', $row['dhora_inicio']);
                    $separar[2] = explode(':', $row['dhora_fin']);
                    $total_min_trans[1] = ($separar[1][0] * 60) + $separar[1][1];
                    $total_min_trans[2] = ($separar[2][0] * 60) + $separar[2][1];
                    $total_min = $total_min_trans[2] - $total_min_trans[1];
                    $cupos = round(floatval($total_min) / floatval($tiempo));
                    $record = $this->dCronograma->getArrayMantenimientoCronograma($accion, $vid_cronograma_ant, $persona, $ambiente, $oficina, $turno, $fecha, $producto, $actividad, $cupos);
                    if ($record)
                        $respuesta = 'Operacion exitosa fecha ' . $fecha;
                    else
                        $respuesta = 'Error en la operacion fecha ' . $fecha;
                    $resultado = '<input type="text" id="mensaje_crono" name="mensaje_crono" style="width:280px; border-width:0; text-align:center;" value="' . $respuesta . '"/>';
                }
            }
        }
        return $resultado;
    }

    /*     * **************************** ADMINISTARCION DEL ARBOL DE C COSTOS ****************************** */

    /*     * *********************************************************************
     * PRIMERO SE DEBE SABER QUÉ NIVEL OCUPA 
     * LUEGO COMPARAR CON EL ANTERIORMENTE ESCRITO 
     * PARA SABER SI SE DEBE CERRAR O PUEDE SER SU HIJO
     * ********************************************************************* */

    function crearArbolCentroCostos() {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getDatosCentroCosto();
        $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $cadena.="<tree id=\"0\" radio=\"1\">\n";
        $n = 4; //Se debe definir de acuerdo a la data
        $array = array();
        $i = $n;
        $value = $n + 1; //se cuenta con el 0
        $j;
        foreach ($array as $i => $value) {
            $array[$i] = 0;
        }
        $aux;
        $codAnterior = '';
        $borrar = '';

        foreach ($resultado as $rs => $valor) {
//CONDICIONES DEL CENTRO DE COSTO
            if ($resultado[$rs]["iNivel"] == 0) {
                $j = $n;
            } else {
                if ($resultado[$rs]["iNivel"] == 1) {
//Evalua si es nivel 1
                    $j = $n - 1;
                } else {
                    if ($resultado[$rs]["iNivel"] == 2) {
//nivel 2
                        $j = $n - 2;
                    } else {
                        if ($resultado[$rs]["iNivel"] == 3) {
                            $j = $n - 3;
                        } else {
                            $j = $n - 4;
                        }
                    }
                }
            }

//SE REPITE PARA CADA ITEM
            if ($codAnterior == '') { //para verificar si es el priner item
                $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                $array[$n - $j] = 1; //Indica que se ha abierto el nivel
            } else {
//verificar si el anterior era de mas nivel
                if ($codAnterior < strlen(trim($resultado[$rs]["cCodigoJerarquico"]))) {//el anterior era de nivel mas alto como 0
                    $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                    $array[$n - $j] = 1; //sirve para saber que el item nivel $n-2=1 está abierto
                } else {
//verificar q el item anterior esta abierto
                    $aux = $codAnterior - strlen(trim($resultado[$rs]["cCodigoJerarquico"]));
                    $aux = $aux / 2;
                    if ($aux == 0) {
                        $cadena.="</item>\n"; //se debe cerrar el item anterior porque el actual no puede ser su hijo
                        $array[$n - $aux] = 0; //el elemento anterior se esta cerrando, pero pueden haber otros elementos abiertos de mayor nivel
                    } else {
                        while ($aux >= 0) {
                            $cadena.="</item>\n"; //se debe cerrar el item anterior porque el actual no puede ser su hijo
                            $array[$n - $aux] = 0; //el elemento anterior se esta cerrando, pero pueden haber otros elementos abiertos de mayor nivel
                            $aux = $aux - 1;
                        }
                    }
                    $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
                    $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                    $array[$n - $j] = 1;
                }
            }
        }
        $i = $n;
        foreach ($array as $i => $value) {
            if ($array[$i] == 1) {
                $cadena.="</item>\n"; //se debe cerrar el item anterior
            }
        }
        $cadena.="\n</tree>";
        $archivo = basename("arbol_centroCostos");

        $archivo.=".xml";
        $contenido2 = $cadena;

        $ft = fopen("../../../../carpetaDocumentos/" . $archivo, "w");
        fwrite($ft, $contenido2);
        fclose($ft);
    }

    /*     * ******************** GENERA EL ARBOL CON TODOS LOS ELEMENTOS ******************************************* */

    function crearArbolCentroCostosCompleto() {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getDatosCentroCostoCompleto();
        $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $cadena.="<tree id=\"0\" radio=\"1\">\n";
        $n = 4; //Se debe definir de acuerdo a la data
        $array = array();
        $i = $n;
        $value = $n + 1; //se cuenta con el 0
        $j;
        foreach ($array as $i => $value) {
            $array[$i] = 0;
        }
        $aux;
        $codAnterior = '';
        $borrar = '';

        foreach ($resultado as $rs => $valor) {
//CONDICIONES DEL CENTRO DE COSTO
            if ($resultado[$rs]["iNivel"] == 0) {
                $j = $n;
            } else {
                if ($resultado[$rs]["iNivel"] == 1) {
//Evalua si es nivel 1
                    $j = $n - 1;
                } else {
                    if ($resultado[$rs]["iNivel"] == 2) {
//nivel 2
                        $j = $n - 2;
                    } else {
                        if ($resultado[$rs]["iNivel"] == 3) {
                            $j = $n - 3;
                        } else {

                            $j = $n - 4;
//  $cadena.="\n En nivel 4 j es:".$j."\n Y n es: ".$n;
                        }
                    }
                }
            }

//SE REPITE PARA CADA ITEM
            if ($codAnterior == '') { //para verificar si es el priner item
                if ($resultado[$rs]["bActivo"] == 1) {
                    $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" checked=\"1\" disabled=\"1\" >\n";
                } else {
                    $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" disabled=\"1\" >\n";
                }

                $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                $array[$n - $j] = 1; //Indica que se ha abierto el nivel
            } else {
//verificar si el anterior era de mas nivel
                if ($codAnterior < strlen(trim($resultado[$rs]["cCodigoJerarquico"]))) {//el anterior era de nivel mas alto como 0
                    if ($resultado[$rs]["bActivo"] == 1) {
                        $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" checked=\"1\" disabled=\"1\" >\n";
                    } else {
                        $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" disabled=\"1\" >\n";
                    }

                    $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                    $array[$n - $j] = 1; //sirve para saber que el item nivel $n-2=1 está abierto
                } else {
//verificar q el item anterior esta abierto
                    $aux = $codAnterior - strlen(trim($resultado[$rs]["cCodigoJerarquico"]));
                    $aux = $aux / 2;
                    if ($aux == 0) {
                        $cadena.="</item>\n"; //se debe cerrar el item anterior porque el actual no puede ser su hijo
                        $array[$n - $aux] = 0; //el elemento anterior se esta cerrando, pero pueden haber otros elementos abiertos de mayor nivel
                    } else {
                        while ($aux >= 0) {
                            $cadena.="</item>\n"; //se debe cerrar el item anterior porque el actual no puede ser su hijo
                            $array[$n - $aux] = 0; //el elemento anterior se esta cerrando, pero pueden haber otros elementos abiertos de mayor nivel
                            $aux = $aux - 1;
                        }
                    }
                    if ($resultado[$rs]["bActivo"] == 1) {
                        $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" checked=\"1\" disabled=\"1\" >\n";
                    } else {
                        $cadena.="<item text=\"" . trim($resultado[$rs]["vDescripcionCcosto"]) . "\" open=\"1\" id=\"" . trim($resultado[$rs]["iIdCentroCosto"]) . "\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" disabled=\"1\" >\n";
                    }

                    $codAnterior = strlen(trim($resultado[$rs]["cCodigoJerarquico"])); //guardo la longitud de su codjerarquico
                    $array[$n - $j] = 1;
                }
            }
        }
        $i = $n;
        foreach ($array as $i => $value) {
            if ($array[$i] == 1) {
                $cadena.="</item>\n"; //se debe cerrar el item anterior
            }
        }
        $cadena.="\n</tree>";
        $archivo = basename("arbol_centroCostosCompleto");

        $archivo.=".xml";
        $contenido2 = $cadena;

        $ft = fopen("../../../../carpetaDocumentos/" . $archivo, "w");
        fwrite($ft, $contenido2);
        fclose($ft);
    }

//MUESTRA LOS DATOS DEL CENTR DE COSTO
    function verItemCC($cod) {
        $oDCronograma = new DCronograma();
        $str = (string) $cod;
        if (strlen($str) < 10) { //si es el id
            $resultado = $oDCronograma->getDatosVerCentroCosto('', $cod);
        } else {
            $resultado = $oDCronograma->getDatosVerCentroCosto($cod, '');
        }

        return $resultado;
    }

//MUESTRA LOS DATOS DEL CENTRO DE COSTO PADRE
    function verItemPadre($cod) {
        $oDCronograma = new DCronograma();
        $str = (string) $cod;
        if (strlen($str) < 10) {
            $resultado = $oDCronograma->getDatosVerPapaCC('', $cod);
        } else {
            $resultado = $oDCronograma->getDatosVerPapaCC($cod, '');
        }

        return $resultado;
    }

//DEVULVE EL ID DEL ITEM SELECCIONADO O ACTUAL
    function getIdActualCentroCosto($cod) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getIdActual($cod);
        return $resultado;
    }

//OBTIENE EL CODIGO DE CENTRO DE COSTO ACTUAL
    function getCodigoActualCentroCosto($pId) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getCodigoActual($pId);
        return $resultado;
    }

//OBTIENE EL NOMBRE DEL CENTRO DE COSTO
    function getNombreCentroCosto($cod) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getNombreActual($cod);
        return $resultado;
    }

//ENVIA LOS DATOS DEL CENTRO DE COSTO PARA LA EDICION, ADICION O ELIMINACION
    function getDatosActualCentroCosto($opcNuevo, $opcAccion, $codj, $descripcion, $usuario, $abrev, $estado, $observ) {
        $estacion = $_SESSION['host'];
        if ($opcAccion == 1) { //AGREGA EL CENTRO DE COSTO
            $n = strlen($codj);
            $nivel = (int) $n;
            $nivel = ($nivel - 2) / 2;

            $aux = $codj;

            while (strlen($aux) < 10) {
                $aux = $aux . '0';
            }
            echo $aux; //Sirve para enviar el codigo medinate la respuesta XD

            $cod = $aux;
            $oDCronograma = new DCronograma();
            $resultado = $oDCronograma->getDatosInsertaCentroCosto($cod, $codj, $descripcion, $nivel, 1, $usuario, $abrev, $observ, $estacion);
        }
        if ($opcAccion == 2) { //ELIMINA EL CENTRO DE COSTO
            echo"item eliminado en proceso";
            $oDCronograma = new DCronograma();
            $resultado = $oDCronograma->getDatosEliminaCentroCosto($codj);
        }
        if ($opcAccion == 3) {  //EDITA EL CENTR ODE COSTO
            $oDCronograma = new DCronograma();
            $resultado = $oDCronograma->getDatosEditaCentroCosto($codj, $descripcion, $abrev, $estado, $usuario, $observ, $estacion);
        }
    }

//GENERA UN NUEVO CODIGO PARA EL NUEVO ITEM
    function getCodigoNuevoCentroCosto($id) {
        $oDCronograma = new DCronograma();
        $codigoAnt = $oDCronograma->getDatosItemCentroCosto($id);
        $cod1 = $codigoAnt['0']['0'];
        if ($cod1 == '') {
            $cod1 = $codj . '00';
        } else {
            $cod1 = rtrim($cod1);
        }
        $cod2 = (int) $cod1; //codigo jerarquico anterior
        $cod2 = $cod2 + 1;  //hay q sumarle 1
        $aux = (string) $cod2; //codigo jerarquico actual
        $aux = substr($aux, -2, 2); //ultimos 2 digito de la cadena
        $newCod = substr($cod1, 0, -2) . $aux;
        return $newCod;
    }

    /*     * ************************ FIN DE ADMINIOSTRACION DE ARBOL C COSTOS ****************************** */

    /* function crearArbolServiciosProgramados() {
      $oDCronograma = new DCronograma();
      $resultado = $oDCronograma -> getDatosServiciosProgramados();
      //print_r($resultado);
      $cadena = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
      $cadena.="<tree id=\"0\" radio=\"1\">\n";
      $cCodigoCentroCostos = 0;
      $bandera = 0;
      $cadena.="<item text=\"Servicio de Consulta Externa\" open=\"1\" id=\"0102060900\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
      foreach($resultado as $indice=>$valor) {
      if($resultado[$indice]["cCodigoCentroCosto"]!=$cCodigoCentroCostos) {
      if($bandera == 1)$cadena.="</item>";
      $cadena.="<item text=\"".trim($resultado[$indice]["vDescripcionCcosto"])."\" id=\"".trim($resultado[$indice]["cCodigoCentroCosto"])."\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" >\n";
      $cadena.="<item text=\"".trim($resultado[$indice]["v_desc_ser_pro"])."\" id=\"".trim($resultado[$indice]["c_cod_ser_pro"])."\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" />\n";
      $bandera = 1;
      }else {
      $cadena.="<item text=\"".trim($resultado[$indice]["v_desc_ser_pro"])."\" id=\"".trim($resultado[$indice]["c_cod_ser_pro"])."\" im0=\"tombs.gif\" im1=\"tombs_open.gif\" im2=\"tombs.gif\" />\n";
      }
      $cCodigoCentroCostos = $resultado[$indice]["cCodigoCentroCosto"];
      }
      $cadena.="</item>\n</item>\n</tree>";
      echo $cadena;
      //        $archivo=basename("arbolito");
      //        $archivo.=".xml";
      //        $contenido2=$cadena;
      //
      //        $ft=fopen("../../../javascript/xml/".$archivo,"w");
      //        fwrite($ft,$contenido2);
      //        fclose($ft);

      }
     */
    /*

      while($row=mysql_fetch_array($rs)){

      $con.="<track>";
      $con.="<title>".$row[1]."</title>";
      $con.="<location>".$row[3]."</location>";
      $con.="</track>";

      <<<<<<< .mine
      }
      $con.="<track>";
      $con.="<title>ZoneArtCss.com</title>";
      $con.="<location>introradiocoral.flv</location>";
      $con.="</track>";
      $con.="</trackList>";
      $con.="</playlist>";

      $archivo=basename("playlist");
      $archivo.=".xml";
      $contenido2=$con;

      $ft=fopen("system/videos/".$archivo,"w");
      fwrite($ft,$contenido2);
      fclose($ft);
     */

    function listarServiciosCitas($datos) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getDatosServiciosProgramados($datos);
        return $resultado;
    }

    /* CRONOGRAMACITASINFORMES */

    function getdatosdecronograma($datos) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getdatosdecronograma($datos);
        return $resultado;
    }

    function ltraerDatosCronogramaProgramado($datos) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->dtraerDatosCronogramaProgramado($datos);
        return $resultado[0][0];
    }

    function getListaCitasporCronograma($n_nro_prog, $datos) {
        $oDCronograma = new DCronograma();
        $repuesta = $oDCronograma->getArrayProgramacionPacientes($n_nro_prog, $datos);
        return $repuesta;
    }

    public function obtenerCantidadOptimaFechas($datos) {
        //print_r($datos);
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getCantidadOptimaFechas($datos);
        return $resultado[0]['contadorOptimoFechas'];
    }

    public function getListaCabeceraCronogramaInformes($datos) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getArrayCabeceraCronogramaInformes($datos);
        $cadena = "Hora";
        $coma = ",";
        $cspan = "#cspan";
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        foreach ($resultado as $indice => $valor) {
            $i = 0;
            $bandera = 1;
            while ($i <= $resultado[$indice]['iContador']) {
                if ($i == 0 || $i == 1) {
                    if ($bandera == 1) {
                        $cadena = $cadena . $coma . $dias[date('w', strtotime($resultado[$indice]['dFechaServicio']))] . " " . date('d', strtotime($resultado[$indice]['dFechaServicio'])) . " " . $meses[date('n', strtotime($resultado[$indice]['dFechaServicio'])) - 1] . " " . date('Y', strtotime($resultado[$indice]['dFechaServicio']));
                    }
                    $bandera = 0;
                }
                else
                    $cadena = $cadena . $coma . $cspan;
                $i = $i + 1;
            }
        }
//echo $cadena;
        return "\"" . $cadena . "\"";
    }

    public function tipocabecera() {
        $cadena = "ro,";
        $coma = ",";
        $numerocolumnas = $this->numerosubcabeceras;
        $i = 0;
        while ($i < $numerocolumnas) {
            $cadena = $cadena . "ro";
            if ($i <> $numerocolumnas - 1) {
                $cadena = $cadena . $coma;
            }
            $i = $i + 1;
        }

        return "\"" . $cadena . "\"";
    }

    public function alineamiento() {
        $cadena = "center,";
        $coma = ",";
        $numerocolumnas = $this->numerosubcabeceras;
        $i = 0;
        while ($i < $numerocolumnas) {
            $cadena = $cadena . "center";
            if ($i <> $numerocolumnas - 1) {
                $cadena = $cadena . $coma;
            }
            $i = $i + 1;
        }

        return "\"" . $cadena . "\"";
    }

    public function anchocolumnas() {
        $cadena = "70,";
        $coma = ",";
        $numerocolumnas = $this->numerosubcabeceras;
        $i = 0;
        while ($i < $numerocolumnas) {
            $cadena = $cadena . "150";
            if ($i <> $numerocolumnas - 1) {
                $cadena = $cadena . $coma;
            }
            $i = $i + 1;
        }

        return "\"" . $cadena . "\"";
    }

    public function getColumnasIds() {
        $cadena = "hora,";
        $coma = ",";
        $i = 0;
        foreach ($this->idCronograma as $indice => $valor) {
            $cadena = $cadena . $valor['iCodigoProgramacion'];
            $i = $i + 1;
            if ($i <> count($this->idCronograma)) {
                $cadena = $cadena . $coma;
            }
        }
        return "\"" . $cadena . "\"";
    }

    public function getListaSubCabeceraCronogramaInformes($datos) {
        $oDCronograma = new DCronograma();
        $resultado = $oDCronograma->getArraySubCabeceraCronogramaInformes($datos);
        $rspan = " ";
        $cadena = "#rspan";
        $coma = ",";
        $j = 0;
        $indicenorequerido = 0;
        $this->numerosubcabeceras = count($resultado);
        foreach ($resultado as $indice => $valor) {
            $i = 0;
            if ($valor['iCodigoProgramacion'] == "-1") {
                $this->idCronograma[$j]['iCodigoProgramacion'] = $indicenorequerido - 1;
                $indicenorequerido = $indicenorequerido - 1;
            } else {
                $this->idCronograma[$j]['iCodigoProgramacion'] = $resultado[$indice]['iCodigoProgramacion'];
            }
            $this->idCronograma[$j]['n_horarioinicio'] = $resultado[$indice]['n_horarioinicio'];
            $this->idCronograma[$j]['n_horariofinal'] = $resultado[$indice]['n_horariofinal'];
            $this->idCronograma[$j]['tipoambiente'] = $resultado[$indice]['tipoambiente'];
            $this->idCronograma[$j]['isprocedimiento'] = $resultado[$indice]['isprocedimiento'];
            while ($i <= $resultado[$indice]['dFechaServicio']) {
                if ($resultado[$indice]['iTiempoAtencion'] == 0)
                    $cadena = $cadena . $coma . $rspan;
                else {
                    $cadena = $cadena . $coma .utf8_encode($resultado[$indice]['vNombreMedico']);
                    $this->tiempoAtencion = $resultado[$indice]['iTiempoAtencion'];
                }
                $i = $i + 1;
            }
            $j = $j + 1;
        }
//echo $cadena;
        return "\"" . $cadena . "\"";
    }

    function armarMatrizHorarios($horarioinicio, $horariofinal, $tiempoatencion) {
        $matrizHorarios = array();
        $horainicio = $horarioinicio;
        $horaactual = number_format($horainicio, 2);
        $horafinal = number_format($horariofinal, 2);
        $contadorhorario = number_format($tiempoatencion * 0.01, 2);
        $contadorfila = 0;
        /* echo "$horainicio <br>";
          echo "$horaactual <br>";
          echo "$horafinal <br>";
          echo "$contadorhorario <br>";
         */
        while ($horaactual <= $horafinal && $tiempoatencion <> 0) {
            $parte_entera = floor($horaactual);
            $parte_decimal = number_format($horaactual, 2) - $parte_entera;
            if (number_format($parte_decimal, 2) >= 0.60) {
                $parte_decimal = number_format($parte_decimal, 2) - 0.60;
                $parte_entera = $parte_entera + 1;
                $horaactual = number_format($parte_entera + $parte_decimal, 2);
// echo "horaactual =".$horaactual." parteentera =".$parte_entera." partedecimal =".$parte_decimal."\n\n\n\n";
            } else {
// echo "horaactual =".$horaactual." parteentera =".$parte_entera." partedecimal =".$parte_decimal."\n\n\n\n";
            }
//echo "horaactual =" . $horaactual . " parteentera =" . $parte_entera . " partedecimal =" . $parte_decimal . "\n";
            if (number_format($horaactual, 2) == 24.00) {
                $horaactual = number_format(0.00, 2);
                $horafinal = number_format($horainicio - $contadorhorario, 2);
            }
            if (number_format($horaactual, 2) < 10.00) {
                $v_hora = number_format($horaactual, 2);
                $codigohora = $v_hora;
                $v_hora = '0' . $v_hora;
            } else {
                $v_hora = number_format($horaactual, 2);
                $codigohora = $v_hora;
            }
            if ($parte_entera < 12) {
                $codigohora = $codigohora . 'AM';
            } else {
                if ($parte_entera > 12) {
                    $codigohora = number_format(($parte_entera - 12) + $parte_decimal, 2);
                    $codigohora = $codigohora . 'PM';
                } else {
                    $codigohora = $codigohora . 'PM';
                }
            }
            $matrizHorarios[$contadorfila]['numeroHora'] = $v_hora;

            $codigohora = str_replace(".", ":", $codigohora);
            $matrizHorarios[$contadorfila]['codigohora'] = $codigohora;
            $v_hora = str_replace(".", ":", $v_hora);
            $matrizHorarios[$contadorfila]['horario'] = $v_hora;

            $variableAuxiliar = $parte_decimal + $contadorhorario;
            if ($variableAuxiliar >= 0.60) {
// echo "hora actual 1 $horaactual\n";
                $horaactual = number_format($horaactual + 1.00 + $contadorhorario - 0.60, 2);
// echo "a. $variableAuxiliar \n";
// echo "hora actual 2 $horaactual \n";
            } else {
// echo "b. $variableAuxiliar \n\n";
                $horaactual = number_format($horaactual + $contadorhorario, 2);
            }
//$horaactual = number_format($horaactual + $contadorhorario,2);
            $contadorfila = $contadorfila + 1;
        }
//print_r($matrizHorarios);
        return $matrizHorarios;
    }

    public function insertarMatrisHoraris($matriz, $codigoHora, $horario, $numeroHora) {
        $matrizResultado = array();
//$numeroHora = 0;
        $cantidad = count($matriz);
        if (!isset($matriz[0])) {
            $matrizResultado[0]['codigohora'] = $codigoHora;
            $matrizResultado[0]['horario'] = $horario;
            $matrizResultado[0]['numeroHora'] = $numeroHora;
        } else {
            if ($matriz[0]['numeroHora'] > $numeroHora) {
                $matrizResultado[0]['codigohora'] = $codigoHora;
                $matrizResultado[0]['horario'] = $horario;
                $matrizResultado[0]['numeroHora'] = $numeroHora;
                foreach ($matriz as $key => $value) {
                    array_push($matrizResultado, $value);
                }
            } else {
                if ($matriz[$cantidad - 1]['numeroHora'] < $numeroHora) {
                    $matrizResultado = $matriz;
                    $matrizResultado[$cantidad]['codigohora'] = $codigoHora;
                    $matrizResultado[$cantidad]['horario'] = $horario;
                    $matrizResultado[$cantidad]['numeroHora'] = $numeroHora;
                } else {
                    $i = 0;
                    $insertado = 0;
                    foreach ($matriz as $key => $value) {
                        if ($insertado == 0) {
                            if ($value['numeroHora'] > $numeroHora) {
                                $matrizResultado[$i]['codigohora'] = $codigoHora;
                                $matrizResultado[$i]['horario'] = $horario;
                                $matrizResultado[$i]['numeroHora'] = $numeroHora;
                                $insertado = 1;
                            }
                            array_push($matrizResultado, $value);
                        } else {
                            array_push($matrizResultado, $value);
                        }

                        $i++;
                    }
// $matrizResultado = $matriz;
                }
            }
        }
        return $matrizResultado;
//        foreach ($matriz as $key => $value) {
//            if($value['numeroHora']<$numeroHora){
//                
//            }
//        }
    }

    public function buscarCupoDisponible($datos) {
        $cantidad = 0;
        foreach ($this->idCronograma as $indice => $valor) {
            $n_nro_prog = $this->idCronograma[$indice]['iCodigoProgramacion'];
            $repuestaA = $this->getListaCitasporCronograma($n_nro_prog, $datos);
            $contador = count($repuestaA);
            //print_r($repuestaA);

            for ($x = 0; $x <= $contador - 1; $x++) {
                if ($repuestaA[$x][0] == 0 && $repuestaA[$x][1] == 'citanueva') {
                    $respuesta = 1;
                    $cantidad++;
                }
                if (!isset($repuestaA[$x][1])) {
                    $respuesta = -1;
                } else {
                    $respuesta = 0;
                }
            }
        }
        return $respuesta . "/" . $cantidad;
    }

    public function buscarCupoDisponibleNuevo($datos) {
        $cantidad = 0;
        $respuesta = 0;
        foreach ($this->idCronograma as $indice => $valor) {
            $n_nro_prog = $this->idCronograma[$indice]['iCodigoProgramacion'];
            $repuestaA = $this->getListaCitasporCronograma($n_nro_prog, $datos);
            $contador = count($repuestaA);
            //print_r($repuestaA);

            for ($x = 0; $x <= $contador - 1; $x++) {
                if ($repuestaA[$x][0] == 0 && $repuestaA[$x][1] == 'citanueva') {
                    $respuesta = 1;
                    $cantidad++;
                    // break;
                }
            }
        }
        return $respuesta . "/" . $cantidad;
    }

    public function buscarProximaCita($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->buscarProximaCita($datos);
        return $resultado;
    }

    //Revisar 8Abril2012
    public function armarCronogramaCitasInformes($datos) {

        $matrizHorarios = array();
        $matrizHorariosAuxiliar = array();
        $this->horarios = array();
        $minimo = array();
        $maximo = array();
        $i = 0;
        foreach ($this->idCronograma as $indice => $valor) {
            $minimo = $this->idCronograma[$indice]['n_horarioinicio'];
            $maximo = $this->idCronograma[$indice]['n_horariofinal'];

            $matrizHorariosAuxiliar = $this->armarMatrizHorarios($minimo, $maximo, $this->tiempoAtencion);
            foreach ($matrizHorariosAuxiliar as $key => $value) {
                array_push($matrizHorarios, $value);
            }
        }
//        print_r($matrizHorarios);
        //echo 'jose';
        foreach ($matrizHorarios as $value) {
            $this->horarios = $this->insertarMatrisHoraris($this->horarios, $value['codigohora'], $value['horario'], $value['numeroHora']);
// print_r($this->horarios);
        }

//        print_r($this->idCronograma);
        //echo 'jose';
//$horariominimo = min($minimo);
//  $horariomaximo = max($maximo);
// $this->horarios = $this->armarMatrizHorarios($horariominimo, $horariomaximo, $this->tiempoAtencion);
// $this->horarios[14]['codigohora']='2:50PM';
// $this->horarios[14]['horario']='14:50';
//print_r($this->horarios);
        foreach ($this->idCronograma as $indice => $valor) {
            $n_nro_prog = $this->idCronograma[$indice]['iCodigoProgramacion'];
            $cronogramaauxiliar[$valor['iCodigoProgramacion']] = $this->getListaCitasporCronograma($n_nro_prog, $datos);
        }

        $cadenapagos = "";
        $iniciocadena = "{'rows':[";
        $iniciafila = "{";
        $id = "'id':";
        $data = "'data':";
        $iniciadata = "[";
        $coma = ",";
        $finalizadata = "]";
        $finalizafila = "},";
        $finalizacadena = "}]}";
        $comillas = "'";

        $i = 0;
        $cadena = $iniciocadena;


        for ($z = 0; $z < count($this->horarios) + 3; $z++) {
//foreach($this->horarios as $indicehorario=>$valorhorario) {
            if ($z == 0)
                $cadena = $cadena . $iniciafila . $id . $comillas . 'IsProcedimiento' . $comillas . $coma . $data . $iniciadata;
            if ($z == 1)
                $cadena = $cadena . $iniciafila . $id . $comillas . 'TipoAmbiente' . $comillas . $coma . $data . $iniciadata;
            if ($z == 2)
                $cadena = $cadena . $iniciafila . $id . $comillas . 'Adicionales' . $comillas . $coma . $data . $iniciadata;
            if ($z != 0 && $z != 1 && $z != 2)
                $cadena = $cadena . $iniciafila . $id . $comillas . $this->horarios[$z - 3]['codigohora'] . $comillas . $coma . $data . $iniciadata;



            $j = 0;
            foreach ($cronogramaauxiliar as $indicecronograma => $valorcronograma) {
                if ($i == 0 && $j == 0) {
                    $cadena = $cadena . $comillas . 'Tipo Serv.' . $comillas . $coma;
                } else {
                    if ($i == 1 && $j == 0) {
                        $cadena = $cadena . $comillas . 'Tipo Amb.' . $comillas . $coma;
                    } else {
                        if ($i == 2 && $j == 0) {
                            $cadena = $cadena . $comillas . 'Adicional' . $comillas . $coma;
                        } else {
                            if ($j == 0) {
                                $cadena = $cadena . $comillas . $this->horarios[$z - 3]['horario'] . $comillas . $coma;
                            }
                        }
                    }
                }


                $encontrado = 0;
                if ($indicecronograma > 0) {
                    $k = 0;
                    if ($i == 0 && $j <= $this->numerosubcabeceras) {
                        foreach ($this->idCronograma as $indice => $valor) {
                            if ($this->idCronograma[$indice]['iCodigoProgramacion'] == $indicecronograma) {
                                if ($this->idCronograma[$indice]['isprocedimiento'] == 0) {
                                    $cadena = $cadena . $comillas . "||Consultas||" . $comillas;
                                }
                                if ($this->idCronograma[$indice]['isprocedimiento'] == 1) {
                                    $cadena = $cadena . $comillas . "||Procedimientos||" . $comillas;
                                }
                            }
                        }
//                        $cadena = $cadena.$comillas."||ambiente||".$comillas;
                        $encontrado = 1;
                    }
                    if ($i == 1 && $j <= $this->numerosubcabeceras) {
                        foreach ($this->idCronograma as $indice => $valor) {
                            if ($this->idCronograma[$indice]['iCodigoProgramacion'] == $indicecronograma) {
                                if ($this->idCronograma[$indice]['tipoambiente'] == 0) {
                                    $cadena = $cadena . $comillas . "||ambulatorios||" . $comillas;
                                }
                                if ($this->idCronograma[$indice]['tipoambiente'] == 1) {
                                    $cadena = $cadena . $comillas . "||asegurados||" . $comillas;
                                }
                            }
                        }
//                        $cadena = $cadena.$comillas."||ambiente||".$comillas;
                        $encontrado = 1;
                    }
                    if ($i == 2 && $j <= $this->numerosubcabeceras) {
                        $cadena = $cadena . $comillas . "citaadicional" . $comillas;
                        $encontrado = 1;
                    }
//echo $this->numerosubcabeceras;
//print_r($this->horarios);
                    foreach ($valorcronograma as $indice => $valor) {
                        if ($z >= 3) {
                            if (trim($this->horarios[$z - 3]['codigohora']) == trim($valor['c_cod_hora'])) {

                                $cadena = $cadena . $comillas . utf8_encode($valor['nombrepaciente']) . $comillas;
//echo $valor['nombrepaciente']." ".$valor['c_cod_hora']."<br/>";
                                switch ($valor['estado']) {
                                    case '1': {
                                            $cadenapagos = $cadenapagos . "mygrid.cells2(" . $i . "," . ($j + 1) . ").setBgColor('#F0F43A');";
                                            break;
                                        }
                                    case '2': {
                                            $cadenapagos = $cadenapagos . "mygrid.cells2(" . $i . "," . ($j + 1) . ").setBgColor('#F8A83E');";
                                            break;
                                        }
                                    case '3': {
                                            $cadenapagos = $cadenapagos . "mygrid.cells2(" . $i . "," . ($j + 1) . ").setBgColor('#DEEDF8');";
                                            break;
                                        }
                                    case '4': {
                                            $cadenapagos = $cadenapagos . "mygrid.cells2(" . $i . "," . ($j + 1) . ").setBgColor('#FFB2B2');";
                                            break;
                                        }
                                }
                                $encontrado = 1;
//break;
                            }
                        }

                        $k = $k + 1;
                    }
                }
                if ($indicecronograma < 0 || $encontrado == 0) {
                    $cadena = $cadena . $comillas . $comillas;
                    $cadenapagos = $cadenapagos . "mygrid.cells2(" . $i . "," . ($j + 1) . ").setBgColor('#C7C7C7');";
                }

                if ($j == count($cronogramaauxiliar) - 1)
                    $cadena = $cadena . $finalizadata;
                else
                    $cadena = $cadena . $coma;

                $j = $j + 1;
            }
            if ($i == count($this->horarios) + 2)
                $cadena = $cadena . $finalizacadena;
            else
                $cadena = $cadena . $finalizafila;
            $i = $i + 1;
        }
        $this->cadenaestadopagos = "\"" . $cadenapagos . "\"";
        return "\"" . $cadena . "\"";

        /* ORIGINAL */
//$data1 = "{\"rows\":[{\"id\":1001,\"data\":[\"100\",\"ji\",\"1500\",\"joaja\",\"kakaka\"]},{\"id\":1002,\"data\":[\"100\",\"ji\",\"1500\",\"joaja\",\"kakaka\"]}]}";
//$data1 = "{\"rows\":[{\"id\":\"8.00AM\",\"data\":[\"100\",\"200\"]},{\"id\":\"8.15AM\",\"data\":[\"100\",\"200\"]},{\"id\":\"8.30AM\",\"data\":[\"100\",\"200\"]}]}";
//                    [{'id':'8:00AM','data':['08:00',,,,'2612072',,,]},{'id':'8:15AM','data':['08:15',,,,'2612576',,,]}
    }

    public function getCadenaEstadoPagos() {
        return $this->cadenaestadopagos;
    }

    /*     * *******PROGRAMACIONMEDICOS******** */

    public function getListaProfesionalMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->getArrayProfesionalMedicos($datos);
        return $resultado;
    }

    public function obtenerEstadisticaMensualMedico($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->getArrayEstadisticaMensualMedico($datos);
        $cadena = "";
        $cuerpo = "<table width=\"95%\" border=\"0\" style=\"font-family: Tahoma;font-size: 11px;\">"
                . "   <tr style=\"background-image:url(../../../estilo/imgs/dhxgrid_dhx_blue/hdr.png);font-weight: bold;\">"
                . "       <td width=\"auto\"><div align=\"center\">Servicio</div></td>"
                . "       <td width=\"auto\"><div align=\"center\">Cupos Programados</div></td>"
                . "       <td width=\"auto\"><div align=\"center\">Cupos Adicionales</div></td>"
                . "       <td width=\"auto\"><div align=\"center\">Horas Programadas</div></td>"
                . "   </tr>";

        foreach ($resultado as $ind => $valor) {
            $cuerpo.= "<tr>"
                    . "       <td width=\"auto\"><div align=\"left\">" . utf8_encode($valor["nombreservicio"]) . "</div></td>"
                    . "       <td width=\"auto\"><div align=\"center\">" . $valor["cuposprogramadostotales"] . "</div></td>"
                    . "       <td width=\"auto\"><div align=\"center\">" . $valor["cuposadicionalestotales"] . "</div></td>"
                    . "       <td width=\"auto\"><div align=\"center\">" . $valor["horastotales"] . "</div></td>"
                    . "   </tr>";
        }
        $cuerpo .="</table>";

        return $cuerpo;
    }

    function obtenerProgramacionMedico($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->getArrayProgramacionMedico($datos);
        // echo date("m/d/y");


        foreach ($resultado as $key => $value) {
            $fechaResultado = $resultado[$key][1];
            $fechaHoy = date("d/m/y");
            $fechaResultadoArray = explode("/", $fechaResultado);
            $fechaHoyArray = explode("/", $fechaHoy);
            // print_r($fechaResultadoArray);
            //print_r($fechaHoyArray);
            if ($value[12] == 1) {
                if ((int) $fechaResultadoArray[1] >= (int) $fechaHoyArray[1]) {
                    if ((int) $fechaResultadoArray[0] >= (int) $fechaHoyArray[0] or (int) $fechaResultadoArray[0] <= (int) $fechaHoyArray[0] and (int) $fechaResultadoArray[1] > (int) $fechaHoyArray[1]) {
                        if ($_SESSION["permiso_formulario_servicio"][119]["EDITAR_PROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/edit2.png ^ Editar");
                        } else {
                            array_push($resultado[$key], "");
                        }

                        if ($_SESSION["permiso_formulario_servicio"][119]["ELIMINAR_PROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editdelete.png ^ Eliminar");
                        } else {
                            array_push($resultado[$key], "");
                        }
                        if ($_SESSION["permiso_formulario_servicio"][119]["AUTORIZAR_REPROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_action_success.png ^ Autorizar");
                        } else {
                            array_push($resultado[$key], "");
                        }
                        array_push($resultado[$key], 1);
                    } else {
                        if ($_SESSION["permiso_formulario_servicio"][119]["EDITAR_PROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editar_desh.png ^ Desabilitado");
                        } else {
                            array_push($resultado[$key], "");
                        }

                        if ($_SESSION["permiso_formulario_servicio"][119]["ELIMINAR_PROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png ^ Desabilitado");
                        } else {
                            array_push($resultado[$key], "");
                        }
                        if ($_SESSION["permiso_formulario_servicio"][119]["AUTORIZAR_REPROG_MED"] == 1) {
                            array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_action_success_desh.png ^ Desabilitado");
                        } else {
                            array_push($resultado[$key], "");
                        }
                        array_push($resultado[$key], 0);
                    }
                } else {
                    if ($_SESSION["permiso_formulario_servicio"][119]["EDITAR_PROG_MED"] == 1) {
                        array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editar_desh.png ^ Desabilitado");
                    } else {
                        array_push($resultado[$key], "");
                    }

                    if ($_SESSION["permiso_formulario_servicio"][119]["ELIMINAR_PROG_MED"] == 1) {
                        array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png ^ Desabilitado");
                    } else {
                        array_push($resultado[$key], "");
                    }
                    if ($_SESSION["permiso_formulario_servicio"][119]["AUTORIZAR_REPROG_MED"] == 1) {
                        array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_action_success_desh.png ^ Desabilitado");
                    } else {
                        array_push($resultado[$key], "");
                    }
                    array_push($resultado[$key], 0);
                }
            } else {
                if ($_SESSION["permiso_formulario_servicio"][119]["EDITAR_PROG_MED"] == 1) {
                    array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editar_desh.png ^ Desabilitado");
                } else {
                    array_push($resultado[$key], "");
                }

                if ($_SESSION["permiso_formulario_servicio"][119]["ELIMINAR_PROG_MED"] == 1) {
                    array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/editdelete.png ^ Ver Motivo Eliminacion");
                } else {
                    array_push($resultado[$key], "");
                }
                if ($_SESSION["permiso_formulario_servicio"][119]["AUTORIZAR_REPROG_MED"] == 1) {
                    array_push($resultado[$key], "../../../../fastmedical_front/imagen/icono/agt_action_success_desh.png ^ Desabilitado");
                } else {
                    array_push($resultado[$key], "");
                }
                array_push($resultado[$key], 0);
            }

            array_push($resultado[$key], $value[13] == 0 ? "../../../../fastmedical_front/imagen/icono/exclamation_off.png" : "../../../../fastmedical_front/imagen/icono/exclamation.png ^ Mensaje_Log");
        }
        return $resultado;
    }

    public function getArrayListaAmbientes($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArraylistaAmbientes($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function spListaAmbienteLogicoPorPuesto($datos) {//Junnior
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->spListaAmbienteLogicoPorPuesto($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function spListaServiciosPorActividadDeCentroCosto($datos) {//Junnior
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->spListaServiciosPorActividadDeCentroCosto($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArrayListaPuestos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayPuestos($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArrayListaServicios($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayServicios($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArrayListaAmbientesFisicos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAmbientesFisicos($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArrayListaTurnos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayTurnos($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = "" . $fila[0];
            if ($op >= 0 && $op < 10)
                $fila[1] = "0" . $fila[1];
            $fila[1] = str_replace(".", ":", $fila[1]);
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getTiempoAtencion($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getTiempoAtencion($datos);
        return $rs[0]["n_dmin_prom"];
    }

    function obtenercodigoTurno($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getcodigoTurno($datos);
        return $rs[0]["cCodigoTurno"];
    }

    function obtenerlistaAfiliacionesNOAsignadas() {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAfiliacionesNOAsignadas();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function lobtenerlistaAfiliacionesNOAsignadasPopad($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAfiliacionesNOAsignadasPopad($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    //obtenerlistaAfiliacionesAsignadasPopad

    function lobtenerlistaAfiliacionesAsignadasPopad($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAfiliacionesAsignadasPopad($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function obtenerlistaAfiliacionesAsignadas() {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAfiliacionesAsignadas();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function grabarProgramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $fechaActual = strftime("%Y-%m-%d", time());
        $fechas = array();
        $fechas = explode("|", $datos["fechasservicios"]);
        $fechaPasada = false;
        foreach ($fechas as $ind => $valor) {
            if ($valor < $fechaActual) {
                $fechaPasada = true;
            }
        }
        if ($fechaPasada) {
            $rs = "1|No se puede programar fechas pasadas,Verifique por favor";
        } else {
            $resultado = $o_Cronograma->grabarProgramacionMedicos($datos);
            $rs = utf8_encode($resultado[0]["respuesta"]);
        }
        return $rs;
    }

    function eliminarProgramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->eliminarProgramacionMedicos($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }

    function listarProgramacionAmbientesFisicos($datos) {
        $o_Cronograma = new DCronograma();
        $fechas = array();
        $fechas = explode("|", $datos["fechas"]);
        $cadena = "";
        foreach ($fechas as $ind => $valor) {
            $cadena = $cadena . "''" . $valor . "'',";
        }
        $cadena = substr($cadena, 0, strlen($cadena) - 1);
        $datos["fechas"] = $cadena;
        $rs = $o_Cronograma->getArrayProgramacionAmbientesFisicos($datos);
        return $rs;
    }

    /* REPROGRAMACION DE MEDICOS */

    public function armarcadenajs($nombreselect, $nuevonombre, $nuevovalor) {
        $cadena = "";
        /* $cadena = "opt = document.getElementById(\"$nombreselect\").options;
          opt[opt.length] = new Option(\"$nuevonombre\",\"$nuevovalor\");
          document.getElementById(\"$nombreselect\").selectedIndex = opt.length-1;
          document.getElementById(\"$nombreselect\").disabled = true; "; */
        $cadena = "opt = document.getElementById(\"$nombreselect\").options;
            opt.length = 0;
            opt[0] = new Option(\"Seleccionar\",\"0000\");
            opt[1] = new Option(\"$nuevonombre\",\"$nuevovalor\");
            document.getElementById(\"$nombreselect\").selectedIndex = 1;
            document.getElementById(\"$nombreselect\").disabled = true; ";
        return $cadena;
    }

    public function consultarProgramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $resultado = $o_Cronograma->getArrayDatosProgramacionMedicos($datos);
        $cadena = "var ";
        $separar = explode("|", $resultado[0]["actividad"]);
        $cadena .= $this->armarcadenajs("cb_filtro_actividad", $separar[1], $separar[0]);
        $separar = explode("|", $resultado[0]["puesto"]);
        $cadena .= $this->armarcadenajs("cb_filtro_puestos", $separar[1], $separar[0]);
        $separar = explode("|", $resultado[0]["servicio"]);
        $cadena .= $this->armarcadenajs("cb_filtro_servicios", $separar[1], $separar[0]);
        $separar = explode("|", $resultado[0]["ambientelogico"]);
        $cadena .= $this->armarcadenajs("cb_filtro_ambienteslogicos", $separar[1], $separar[0]);
        $separar = explode("|", $resultado[0]["ambientefisico"]);
        $cadena .= $this->armarcadenajs("cb_filtro_ambientefisico", $separar[1], $separar[0]);
//        $separar = explode("|",$resultado[0]["ambientefisico"]);
//        $cadena .= $this->armarcadenajs("cb_filtro_ambientefisico",$separar[1],$separar[0]);
//        $separar = explode("|",$resultado[0]["horario"]);
        $cadena .= $this->armarcadenajs("cb_filtro_turnoinicio", $resultado[0]["vhorainicio"], $resultado[0]["nhorainicio"]);
        $cadena .= $this->armarcadenajs("cb_filtro_turnofinal", $resultado[0]["vhorafinal"], $resultado[0]["nhorafinal"]);
        $cadena .= " document.getElementById(\"txttiempoatencion\").value=" . $resultado[0]["iTiempoAtencion"] . "; ";
        $cadena .= " document.getElementById(\"txtcuposxturno\").value=" . $resultado[0]["iCuposTotales"] . "; ";
        $cadena .= " document.getElementById(\"txtcuposadicionalesxturno\").value=" . $resultado[0]["iCuposAdicionales"] . "; ";
        $cadena .= " document.getElementById(\"hFechasAProgramar\").value='" . $resultado[0]["fechaservicio"] . "'; ";
//echo $cadena;
        return $cadena;
    }

    public function actualizarCronogramaReProgramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->actualizarCronogramaReProgramacionMedicos($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    public function spMantenimientoReprogramarMedico($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->spMantenimientoReprogramarMedico($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    public function generarCodigoAutorizacionProgramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $datos["claveautogenerada"] = time();
        $rs = $o_Cronograma->generarCodigoAutorizacionProgramacionMedicos($datos);
        return $rs[0]["claveautogenerada"];
    }

    /* public function validarAutorizacionProgramacionMedicos($datos) {
      $o_Cronograma = new DCronograma();
      $rs = $o_Cronograma ->validarAutorizacionProgramacionMedicos($datos);
      return utf8_encode($rs[0]["respuesta"]);
      } */

    public function listarMedicosparaReprogramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayMedicosparaReprogramacionMedicos($datos);
        return $rs;
    }

    public function grabarReprogramacionMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->grabarReprogramacionMedicos($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    public function traerDatosProgramacion($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->traerDatosProgramacion($datos);
        return $rs;
    }

    public function guardarMantenimientoPRogramado($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->guardarMantenimientoPRogramado($datos);
        return $rs;
    }

    function listaAfiliacionesXCronograma($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->getArrayAfiliacionesXCronograma($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    public function traerMotivoEliminacion($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->traerMotivoEliminacion($datos);
        return $rs;
    }

    public function mostrarEdicionProgramacion($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->mostrarEdicionProgramacion($datos);
        return $rs;
    }
    
    public function consultarAmbienteFisico($datos){
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->consultarAmbienteFisico($datos);           
        return $rs;
    }
  
    public function LconsultarSede($datos){
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->DconsultarSede($datos);           
        return $rs;
    }
    public function LcargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos){
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->DcargarComboAmbienteFisicoReprogramacionMedicoNuevo($datos);           
        return $rs;
    }

    public function lCantidadAdicionales($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->dCantidadAdicionales($datos);
        return $rs;
    }

    public function lGuardarCambiosLogADicionales($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->dGuardarCambiosLogADicionales($datos);
        return $rs;
    }

    public function labrirPopudReporteMensualCronograma($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->dabrirPopudReporteMensualCronograma($datos);
        return $rs;
    }

    public function lDatosCronogramaMedicos($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->dDatosCronogramaMedicos($datos);
        return $rs;
    }
    public function seleccionarTurnoProgramacionMedico($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->seleccionarTurnoProgramacionMedico($datos);           
        return $rs;
    }
    public function seleccionarHoraFinal($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->seleccionarHoraFinal($datos); 
        $resultado="";
        foreach($rs as $key => $value){ 
             $resultado.='<option value="'.$value[0].'">'.number_format($value[1],2).'</option>';
        }
        return $resultado;
    }
    public function actualizarTurnoProgramacionMedico($datos) {
        $o_Cronograma = new DCronograma();
        $rs = $o_Cronograma->actualizarTurnoProgramacionMedico($datos);           
        return utf8_encode($rs[0][0]);
    }
}

?>