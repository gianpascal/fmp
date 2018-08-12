<?php

include_once("../../cdatos/DCita.php");
include_once("../../centidad/ECita.php");
include_once "../../cdatos/DPersona.php";

class LCita {

    private $dCita;
    private $tsInicio;
    private $tsFin;
    private $periodo;
    private $eCita;

    public function __construct() {
        $this->eCita = new ECita();
        $this->dCita = new DCita();
    }

    public function getArrayCita($opc, $iid_cronograma) {
        switch (trim($opc)) {
            case '01': {
                    $rs = $this->dCita->getArrayCitaCronograma($iid_cronograma);
                    $resultadoArray = array();
                    foreach ($rs as $fila) {
                        /* Parámetros enviados:
                          $fila[37]=n_nro_prog ---> Número de programación de médico, m_cronomed
                          $fila[33]=c_cod_per
                          $fila[10]=n_prog_pac

                         */
                        $fila[46] = "<a href='#' onclick=\"irEditarCita('" . $fila[37] . "','" . $fila[33] . "','" . $fila[10] . "');\"><img src='../../../../fastmedical_front/imagen/icono/editar.png' title='Editar cita'/></a>";
                        if ($fila[24] + "" == "000")
                            $fila[47] = "<a href='#' onclick=\"irEliminarCita('" . $fila[10] . "');\"><img src='../../../../fastmedical_front/imagen/icono/editdelete.png' title='Eliminar cita'/></a>";
                        else
                            $fila[47] = "<img src='../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png' title='Eliminar cita'/>";
                        array_push($resultadoArray, $fila);
                    }
                    break;
                }
        }
        return $resultadoArray;
    }

    public function getFechHoraServidor() {
        $o_DCita = new DCita();
        $objFecha = $o_DCita->getFechHoraServidor();
        $resultadoArray = array();
        foreach ($objFecha as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        return $resultadoArray;
    }

    public function getOrigenCita() {
        $o_DCita = new DCita();
        $array = $o_DCita->getOrigenCita();
        return $array;
    }

    /* public function getObjectPacienteCita($iid_persona) {
      $o_DCita = new DCita();
      $objPaciente  = $o_DCita->getObjectPacienteCita($iid_persona);
      $resultadoArray = array();
      foreach($objPaciente as $indice=>$fila) {
      $resultadoArray[$indice] = $fila;
      }
      return $resultadoArray;
      } */

    //Lista datos principales de las personas.
    public function listaDatosPersona($c_cod_per) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersona($c_cod_per);
        $resultadoArray = array();
        foreach ($objPaciente as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        return $resultadoArray;
    }

    //Listas contactos de las personas, teléfono, celular, correo.
    public function listaDatosPersonaContactos($c_cod_per) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersonaContactos($c_cod_per);
        $resultadoArray = array();
        $telefono = '';
        $movil1 = '';
        $movil2 = '';
        $email = '';
        foreach ($objPaciente as $indice => $fila) {
            if ($fila[1] == '0001')
                $telefono = $fila[2]; //Telefono casa
            if ($fila[1] == '0003')
                $movil1 = $fila[2]; //Movil 1
            if ($fila[1] == '0004')
                $movil2 = $fila[2]; //Movil2
            if ($fila[1] == '0007')
                $email = $fila[2]; //Email1






























                
//echo "$indice $fila<br>";
        }
        $resultadoArray = array('vTelefono' => $telefono, 'vMovil1' => $movil1, 'vMovil2' => $movil2, 'vEmail' => $email);
        return $resultadoArray;
    }

    //Lista direcciones de las personas. (Dirección de nacimiento y dirección fiscal).
    public function listaDatosPersonaDireccion($c_cod_per, $tipo) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersonaDireccion($c_cod_per, $tipo);
        $resultadoArray = array();
        foreach ($objPaciente as $indice => $fila) {
            $resultadoArray = $fila;
        }
        return $resultadoArray;
    }

    //Lista estudios de las personas.
    public function listaDatosPersonaEstudios($c_cod_per, $tipo) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersonaEstudios($c_cod_per, $tipo);
        $resultadoArray = array();
        foreach ($objPaciente as $indice => $fila) {
            $resultadoArray = $fila;
        }
        return $resultadoArray;
    }

    //Lista documentos de identidad de un paciente.
    public function listaDatosPersonaDocumentos($c_cod_per) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersonaDocumentos($c_cod_per);
        $resultadoArray = array();
        foreach ($objPaciente as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        return $resultadoArray;
    }

    //Lista afiliaciones de un paciente.
    public function listaDatosPersonaAfiliacion($c_cod_per) {
        $o_DCita = new DCita();
        $objPaciente = $o_DCita->listaDatosPersonaAfiliacion($c_cod_per);
        $resultadoArray = array();
        foreach ($objPaciente as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        if (count($resultadoArray) == 0) {
            $resultadoArray[0] = array('cAfiliacion' => '', 'vDescripcion' => '');
        }
        return $resultadoArray;
    }

    public function getDatosCita($n_prog_pac) {
        $o_DCita = new DCita();
        $objCita = $o_DCita->getDatosCita($n_prog_pac);
        $resultadoArray = array();
        foreach ($objCita as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        return $resultadoArray;
    }

    public function getObjectPacienteCitaAdicionales($iid_persona) {
        $o_DCita = new DCita();
        $resultadoArray['1006'] = array('', '', 'insert');
        $resultadoArray['1005'] = array('', '', 'insert');
        $resultadoArray['1010'] = array('', '', 'insert');
        $resultadoArray['8002'] = array('', '', 'insert');
        $resultadoArray['8003'] = array('', '', 'insert');
        $resultadoArray['0007'] = array('', '', 'insert');
        $resultadoArray['8004'] = array('', '', 'insert');
        $resultadoArray['0009'] = array('', '', 'insert');
        $resultadoArray['8005'] = array('', '', 'insert');
        $resultadoArray['0010'] = array('', '', 'insert');
        $resultadoArray['0011'] = array('', '', 'insert');
        $resultadoArray['0008'] = array('', '', 'insert');
        $resultadoArray['8056'] = array('', '', 'insert');
        $resultadoArray['0014'] = array('', '', 'insert');
        $resultadoArray['8033'] = array('', '', 'insert');
        $resultadoArray['0006'] = array('', '', 'insert');
        $resultadoArray['8001'] = array('', '', 'insert');
        $objPacienteAdicionales = $o_DCita->getObjectPacienteCitaAdicionales($iid_persona);
        //print_r($objPacienteAdicionales);
        foreach ($objPacienteAdicionales as $ind => $fila) {
            //echo "$fila[5] $fila[0] $fila[1] $fila[2] $fila[3] $fila[5]<br>";
            $indice = $fila[5];
            $resultadoArray[$indice][0] = $fila[2];
            $resultadoArray[$indice][1] = $fila[3];
            $resultadoArray[$indice][2] = 'update';
        }
        //print_r($resultadoArray);echo "<br><br><br>";
        return $resultadoArray;
    }

    public function getObjectPacienteCitaAdicionales2($iid_persona) {
        $o_DCita = new DCita();
        $objPacienteAdicionales = $o_DCita->getObjectPacienteCitaAdicionales2($iid_persona);
        $resultadoArray = array();
        foreach ($objPacienteAdicionales as $ind => $fila) {
            //echo "$fila[5] $fila[0] $fila[1] $fila[2] $fila[3] $fila[5]<br>";
            $indice = $fila[5];
            $resultadoArray[$indice][0] = $fila[2];
            $resultadoArray[$indice][1] = $fila[3];
        }
        print_r($resultadoArray);
        echo "<br><br><br>";
        return $resultadoArray;
    }

    function getArraylistaDatosBusqueda($filtro, $dato, $fecha, $sede) {
        $o_Cita = new DCita();
        $rs = $o_Cita->getArraylistaDatosBusqueda($filtro, $dato, $fecha, $sede);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArrayListaSedes($datos) {
        $o_Cita = new DCita();
        $rs = $o_Cita->getArraylistaSedes($datos);
        return $rs;
    }

    function getArrayListaSedes1($datos) {
        $o_Cita = new DCita();
        $rs = $o_Cita->getArraylistaSedes1($datos);
        return $rs;
    }

    function getArrayListaActividades() {
        $o_Cita = new DCita();
        $rs = $o_Cita->getArrayListaActividades();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    function getArraylistaCitasPermitidas($nro_programacionmedico) {
        $o_Cita = new DCita();
        $rs = $o_Cita->getArraylistaCitasPermitidas($nro_programacionmedico);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[0]);
        }
        return $resultadoArray;
    }

    public function getArrayHoraCupoCopados($iid_cronograma) {
        $_arrayCuposCopados = $this->dCita->getArrayCuposCitasCronograma($iid_cronograma);
        $this->tsInicio = $_arrayCuposCopados[0]['dhora_inicio'];
        $this->tsFin = $_arrayCuposCopados[0]['dhora_fin'];
        $this->periodo = intval($_arrayCuposCopados[0]['ntiempo']);
        $arrayCuposCopados = array();
        //var_dump($_arrayCuposCopados);
        if ($_arrayCuposCopados[0]['iid_cita'] > 0) {
            foreach ($_arrayCuposCopados as $i => $fila) {
                $horats = strtotime($fila['dhora_cita']);
                array_push($arrayCuposCopados, array($horats, strftime("%r", $horats)));
            }
        }
        return $arrayCuposCopados;
    }

    public function getArrayCuposDisponibles($iid_cronograma) {
        $arrayHoraCuposCopados = $this->getArrayHoraCupoCopados($iid_cronograma);
        $arrayHoraCuposAsignados = $this->getArrayHorasAsignadasCronograma($this->tsInicio, $this->tsFin, $this->periodo);
        $cuposCopados = array();
        $cuposAsignados = array();
        foreach ($arrayHoraCuposCopados as $item)
            $cuposCopados[$item[0]] = $item[1];
        foreach ($arrayHoraCuposAsignados as $item)
            $cuposAsignados[$item[0]] = $item[1];
        $arrayCuposDisponibles = array_diff_assoc($cuposAsignados, $cuposCopados);
        //var_dump($arrayCuposDisponibles);
        return $arrayCuposDisponibles;
    }

    public function getArrayHorasAsignadasCronograma($ts_hora_inicio, $ts_hora_final, $tiempo) {
        $tsHInicio = strtotime($ts_hora_inicio);
        $tsHFin = strtotime($ts_hora_final);
        $tiempo = $tiempo;
        $horasArray = array();
        $horaProgramada = $tsHInicio;
        while ($horaProgramada < $tsHFin) {
            $horaHHMM = strftime("%r", $horaProgramada);
            array_push($horasArray, array($horaProgramada, $horaHHMM));
            $horaProgramada = strtotime('+' . $tiempo . ' minutes', $horaProgramada);
        }
        //var_dump($horasArray);
        return $horasArray;
    }

    public function getArrayOficinas() {
        return $this->dCita->getArrayOficinas();
    }

    /* 	public function grabarCita($eCita){
      $this->eCita = $eCita;
      $cod_oficina = $_SESSION["cod_oficina"];
      $return="";

      if (!is_numeric(trim($this->eCita->iid_mpersona))) $return = "Código de Persona Incorrecto";
      if (!is_numeric(trim($this->eCita->iid_mcronograma))) $return = "Código de Programacion de Médico";
      if (!is_numeric(trim($this->eCita->iid_tafiliacion))) $return = "Codigo de Afiliacion Incorrecto";
      if (!is_numeric(trim($this->eCita->iorigen_cita))) $return = "Origen de Cita Incorrecto";
      if (!is_numeric(trim($this->eCita->itipo_cita))) $return = "Tipo de Cita Incorrecto";
      if (!is_numeric(trim($this->eCita->dhora_cita))) $return = "Hora de Cita Incorrecta";
      if(!empty($return)) return $return;
      $error = $this->dCita->grabarCita($this->eCita,$cod_oficina);
      if(is_numeric($error) and $error>0){
      $arrayError = $this->dCita->errorGrabar;
      $return = $arrayError[$error];
      }else{ $return = "0"; }
      return $return;
      }

     */

    public function grabarCita($parametros) {
        $dcita = new DCita();
        return $dcita->grabarCita($parametros);
    }

    public function editarCita($parametros) {
        $dcita = new DCita();
        return $dcita->editarCita($parametros);
    }

    public function eliminarCita($n_prog_pac) {
        $dcita = new DCita();
        return $dcita->eliminarCita($n_prog_pac);
    }

    ////////*****************CITAS INFORMES****************/////////////////////

    public function listarDatosPersonaInformes($datos) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArrayDatosPersonaInformes($datos);
        $resultadoArray = array();
        foreach ($rs as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        include_once "LPersona.php";
        $o_Persona = new LPersona();
        if ($resultadoArray[0]['dFechaNacimiento'] == 'sindata') {
            $edadvista = "-";
        } else {
           
            //$datetime = date_create($resultadoArray[0]['dFechaNacimiento']);
           
            $fechaNacimiento = $resultadoArray[0]['dFechaNacimiento'];
            $fch =  str_replace('/','-',$resultadoArray[0]['dFechaNacimiento']);
            $edadvista = $o_Persona->formatoEdadCitas($fch);
            
        }
        $fechaNacimiento = strtotime($resultadoArray[0]['dFechaNacimiento']);
        $nombreCompleto = utf8_encode($resultadoArray[0]['vApellidoPaterno'] . " " . $resultadoArray[0]['vApellidoMaterno'] . ', ' . $resultadoArray[0]['vNombre']);
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $cadena = "<div align=\"center\"><font color=\"00028F\" class=\"Estilo9\">Datos del Paciente</font></div>"
                . "<input id=\"hiCodigoFiliacionActiva\" type=\"hidden\" value=\"" . ($resultadoArray[0]['cCodigoFiliacionActiva']) . "\"></input>"
                . "<input id=\"hiCodigoPersona\" type=\"hidden\" value=\"" . ($datos["codigopersona"]) . "\"></input>"
                . "<input id=\"hiCodigoPaciente\" type=\"hidden\" value=\"" . ($resultadoArray[0]['iCodigoPaciente']) . "\"></input>"
                . "<input id=\"hNombrePaciente\" type=\"hidden\" value=\"" . ($nombreCompleto) . "\"></input>"
                . "<input id=\"hNumeroDocumento\" type=\"hidden\" value=\"" . ($resultadoArray[0]['DocumentoIdentificacion']) . "\"></input>"
                . "<fieldset style=\"width:95%;height:auto;margin:5px;padding:5px;  border-radius:10px 10px 10px 10px; \">"
                . "<table>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Filiación </td><td class=\"Estilo7\">" . ($resultadoArray[0]['vDescripcion']) . "</td>";
        if (isset($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_AFILIACION_AMB_PAC"]) && ($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_AFILIACION_AMB_PAC"] == 1))
            $cadena .= "<td><a href='#' onclick=\"cambioaAmbulatorio('" . $datos["codigopersona"] . "');\"><img src='../../../../fastmedical_front/imagen/icono/reload3.png' title='Ambulatorio'/></a><td>";
        else
            $cadena .= "</tr>";
        if (isset($_SESSION["permiso_formulario_servicio"][110]["CAMBIAR_AFILIACION_GENERAL_PAC"]) && ($_SESSION["permiso_formulario_servicio"][110]["CAMBIAR_AFILIACION_GENERAL_PAC"] == 1))
        // $cadena .= "<td><a href='#' onclick=\"mostrarventanadecambiodeafiliacion('" . $datos["codigopersona"] . "');\"><img src='../../../../fastmedical_front/imagen/icono/add_user2.png' title='Cambio Afiliacion'/></a><td></tr>";
            $cadena .= "</tr>";
        else
            $cadena .= "</tr>";
        $cadena .= "<tr><td class=\"Estilo6_ReservaCita\">Nombres:</td><td class=\"Estilo7_ReservaCita\">" . $nombreCompleto . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">N. Documento</td><td class=\"Estilo7_ReservaCita\">" . ($resultadoArray[0]['DocumentoIdentificacion']) . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Edad </td><td class=\"Estilo7_ReservaCita\">" . ($edadvista) . "</td></tr>"
                . "</table>"
                . "</fieldset>"
                . "";
        return ($cadena);

//         . "<tr><td style='display:none' class=\"Estilo6\">Fecha Nacimiento</td><td class=\"Estilo7\">" . htmlentities($dias[date('w', $fechaNacimiento)] . " " . date('d', $fechaNacimiento) . " " . $meses[date('n', $fechaNacimiento) - 1] . " " . date('Y', $fechaNacimiento)) . "</td></tr>"
    }

    public function getArrayCitaInformesCronograma($codigoCronograma) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayCitaInformesCronograma($codigoCronograma);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }

        $cadena = "<div align=\"center\"><font color=\"00028F\" class=\"Estilo9\">Datos del Médico</font></div>"
                . "<fieldset style=\"width:95%;height:auto;margin:5px;padding:5px;border-radius:10px 10px 10px 10px; \">"
                . "<table>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Sede</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($resultadoArray[0]["sede"]) . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Servicio</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($resultadoArray[0]["vDescripcionFormato"]) . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">M&eacute;dico</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($resultadoArray[0]["nombreMedico"]) . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Ambiente</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($resultadoArray[0]["ambientelogico"]) . "</td></tr>"
                . "<tr><td class=\"Estilo6_ReservaCita\">Localización</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($resultadoArray[0]["ambientefisico"]) . "</td></tr>"
                . "</table>"
                . "</fieldset>"
                . "<input id=\"hiCodigoCronograma\" type=\"hidden\" value=\"" . htmlentities($resultadoArray[0]["iCodigoCronograma"]) . "\"></input>"
                . "";

        return $cadena;
    }

    public function getArrayCitaInformesServicio($codigoHora, $codigoCronograma, $tipocitaProgramada) {
        $dcita = new DCita();
        $dcitaAngel = new DCita();
        $resultadoFila = $dcita->getArrayCitaInformesServicio($codigoCronograma);
        $arrayHorasPRogramadas = $dcitaAngel->getArrayHorasProgramadasRestantesAngel($codigoCronograma);
        $arrayTipos = $dcitaAngel->getUbicacionCitas();
        $seledtedAdicional = '';
        if ($codigoHora == '---') {
            $seledtedAdicional = 'selected';
            $codigoHoraDos = $codigoHora;
        }


        $resultadoArray = array();
        foreach ($resultadoFila as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        switch ($tipocitaProgramada) {
            case 0: $cadenatipocita = "Programada";
                break;
            case 1: $cadenatipocita = "Adicional";
                break;
            case 2: $cadenatipocita = "Adicional";
                break;
        }
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $cadena = "<div align=\"center\"><font color=\"00028F\" class=\"Estilo9\">Datos del Servicio</font></div>"
                . ""
                . "<fieldset style=\"margin:5px;padding:5px; border-radius:10px 10px 10px 10px; \">"
                . "<table>"
                . "<tr><td class=\"Estilo7_ReservaCita\">Fecha de Servicio</td><td class=\"Estilo7_ReservaCita\">" . htmlentities($dias[date('w', strtotime($resultadoArray[0]['dFechaServicio']))] . " " . date('d', strtotime($resultadoArray[0]['dFechaServicio'])) . " " . $meses[date('n', strtotime($resultadoArray[0]['dFechaServicio'])) - 1] . " " . date('Y', strtotime($resultadoArray[0]['dFechaServicio']))) . "</td></tr>";

        $cadena.="<tr><td class=\"Estilo7_ReservaCita\">Turno</td><td class=\"Estilo7_ReservaCita\">
                <select onchange='seleccionarTurnoPRogramacion(this.value)'>";
        $cadena.="<option value=''>seleccionar...</option>";
        if (isset($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"]) && ($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"] == 1)) {
            $cadena.="<option " . $seledtedAdicional . " value='---'>Adicional</option>";
        }


        $xx = 0;
        foreach ($arrayHorasPRogramadas as $keyaaa => $valueaaa) {
            if ($codigoHora != '---') {
                if ($codigoHora == $valueaaa[0]) {
                    $selelected = 'selected';
                    if ($xx == 0) {
                        $xx++;
                        $codigoHoraDos = $codigoHora;
                    }
                } else {
                    $selelected = '';
                    if ($xx == 0) {
                        $codigoHoraDos = '';
                    }
                }
            }
            $cadena.="<option  " . $selelected . " value='" . $valueaaa[0] . "'>" . $valueaaa[0] . "</option>";
        }

        $cadena.="</select><input id=\"hcHoraProgramada\" type=\"hidden\" value=\"" . htmlentities($codigoHoraDos) . "\"></input>
            - Tipo <select id='selectUbicacionCita' style='width:100px'>";
        foreach ($arrayTipos as $value) {
            $cadena.="<option   value='" . $value[0] . "'>" . $value[1] . "</option>";
        }
        $cadena.="</select></td></tr>";
        $cadena.="<tr><td class=\"Estilo7_ReservaCita\">Tipo de Reservacion</td><td class=\"Estilo7_ReservaCita\" id='div_TipoProgramacion'>" . htmlentities($cadenatipocita) . "</td></tr>"
                . "<tr><td class=\"Estilo7_ReservaCita\">Observación</td><td><textarea class=\"Estilo8\" style=\"height=20px; \" name=\"txtobservacioncita\" rows=\"2\" cols=\"30\" id=\"txtobservacioncita\"></textarea></td><td><input type=\"button\" id=\"btnSelAmbiente\" name=\"btnSelAmbiente\" width=\"5\" value=\"...\" onclick=\"editarObsCita();\" style=\"visibility:hidden;\"/><td/></tr>"
                . "</table>"
                . "</fieldset>"
                . "";

        return $cadena;
    }

    function lGenerarComoTurnos($datos) {
        $codigoCronograma = $datos['iCodigoCronograma'];
        $dcitaAngel = new DCita();
        $arrayHorasPRogramadas = $dcitaAngel->getArrayHorasProgramadasRestantesAngel($codigoCronograma);
        $cadena = "<select onClick='mostrarBotonGrabarCita();' id='comoHoraEditarCita' style='height:200px;width: 80px; ' multiple='multiple'>";
        if (isset($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"]) && ($_SESSION["permiso_formulario_servicio"][118]["CITA_ADIC_X_SOLICITUD"] == 1)) {
            $cadena.="<option  value='---'>Adicional</option>";
        }
        foreach ($arrayHorasPRogramadas as $keyaaa => $valueaaa) {

            $cadena.="<option  value='" . $valueaaa[0] . "'>" . $valueaaa[0] . "</option>";
        }

        $cadena.="</select>";
        return $cadena;
    }

    function lGrabarEditarCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dGrabarEditarCita($datos);
        return $resultado;
    }

    public function getArraydescripcionCitaInformes($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArraydescripcionCitaInformes($datos);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }

        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        if ($resultadoArray[0]['dFechaServicio'] == null) {
            $fechModi = '';
        } else {
            $fechModi = utf8_encode($dias[date('w', strtotime($resultadoArray[0]['dFechaServicio']))] . " " . date('d', strtotime($resultadoArray[0]['dFechaServicio'])) . " " . $meses[date('n', strtotime($resultadoArray[0]['dFechaServicio'])) - 1] . " " . date('Y', strtotime($resultadoArray[0]['dFechaServicio'])));
        }

        $datosCitaPaciente = $resultadoArray[0]['vDescripcionFormato'] . "|" . $resultadoArray[0]['nombrePaciente'] . "|" . $resultadoArray[0]['nombreMedico'] . "|";

        $datosCitaPaciente.=$fechModi . "|";
        $datosCitaPaciente.=$resultadoArray[0]['codigoHora'] . "|" . $resultadoArray[0]['vProcedimientos'];
        $dniPaciente = $resultadoArray[0]['vTipoDocumento'] . '-' . $resultadoArray[0]['vNumeroDocumento'];
        $cadena = "<table width=\"100%\" align=\"center\" border=\"0\">"
                . " <tr>"
                . "   <td width=\"40%\" align=\"center\" class=\"Estilo7\">Persona: " . utf8_encode($resultadoArray[0]['nombrePaciente'])
                . "<input type=\"hidden\" name=\"hdnipaciente\" id=\"hdnipaciente\" value=\"" . utf8_encode($dniPaciente) . "\"/>"
                . "  <a href='#' onclick=\"javascript:ventanaEditaPersona('" . utf8_encode($resultadoArray[0]['cCodigoPersona']) . "');\"><img src='../../../../fastmedical_front/imagen/icono/editar.png' title='Editar'/></a>"
                ."<a href='#' onclick=\"javascript:VerCPTfaltantes('" .utf8_encode($resultadoArray[0]['cCodigoPersona']) . "');\"><img src='../../../../fastmedical_front/imagen/icono/hos_essalud.png' title='Cartera de servicios'/></a></td>"
                . "   <td width=\"30%\" align=\"center\" class=\"Estilo7\">Médico: " . utf8_encode($resultadoArray[0]['nombreMedico']) . "</td>"
                . "   <td width=\"30%\" align=\"center\" class=\"Estilo7\">Especialidad:" . utf8_encode($resultadoArray[0]['vDescripcionFormato']) . "</td>"//.htmlentities($resultadoArray[0]['cCodigoEspecialidad'])."</td>"
                . " </tr>"
                . "</table>"
                . "<table width=\"100%\" align=\"center\" border=\"0\">"
                . " <tr>"
                . "   <td width=\"30%\" align=\"center\" class=\"Estilo7\">Fecha: " . $fechModi . "</td>"
                . "   <td width=\"40%\" align=\"center\" class=\"Estilo7\">Ambiente: " . utf8_encode($resultadoArray[0]['ambientelogico']) . "</td>"
                . "   <td width=\"30%\" align=\"center\" class=\"Estilo7\">Hora: " . utf8_encode($resultadoArray[0]['codigoHora']) . "</td>"
                . " </tr>"
                . "</table>"
                . "<table width=\"100%\" align=\"center\" border=\"0\">"
                . " <tr>"
                . "   <td width=\"33%\" align=\"center\">Tipo de Servicio: " . utf8_encode($resultadoArray[0]['vDescripcionTipoCita']) . "</td>"
                . "   <td width=\"33%\" align=\"center\">Localización: " . utf8_encode($resultadoArray[0]['ambientefisico']) . "</td>"
                . "   <td width=\"33%\" align=\"center\">Usuario: " . utf8_encode($resultadoArray[0]['vNombreUsuario']) . "</td>"
                . " </tr>"
                . "</table><input type=\"hidden\" name=\"hidDatosCita\" id=\"hidDatosCita\" value=\"" . utf8_encode($datosCitaPaciente) . "\"/>";

        return $cadena;
    }

    public function cambiarEstadoConfirmacionCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->cambiarEstadoConfirmacionCita($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }

    public function lMantenimientoNumeroPlaca($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dMantenimientoNumeroPlaca($datos);
        return utf8_encode($resultado[0][0]);
    }

    public function lGrabarUbicacionImagenes($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dGrabarUbicacionImagenes($datos);
        return utf8_encode($resultado[0][0]);
    }

    public function grabarUbicacionPlacas($datos) {
        $dcita = new DCita();
        $resultado = $dcita->grabarUbicacionPlacas($datos);
        return $resultado[0][0];
    }

    public function obtenercalculaprecio($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getcalcularprecio($datos);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        $cadena = "<fieldset style=\"width:95%;height:auto;margin:5px;padding:5px;border:none\">"
                . "<table align=\"Estilo7_ReservaCita\">"
                . "<tr><td class=\"Estilo7_ReservaCita\">Precio</td><td class=\"Estilo7\">" . htmlentities($resultadoArray[0]['precio']) . "<input type='hidden' value='" . htmlentities($resultadoArray[0]['precio']) . "' id='txtPrecioServicio'></td></tr>"
                . "</table>"
                . "</fieldset>"
                . "";
        ;
        return $cadena;
    }

    public function getArraycargarNumeroOrdenGenerada($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArraycargarNumeroOrdenGenerada($datos);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        $arreglo = explode("|", $resultadoArray[0]['ordenyafiliacion']);
        $cadena = "<b>Nro. Orden: </b>" . htmlentities($arreglo[0]) . "<input type=\"hidden\" name=\"hidNroOrden\" id=\"hidNroOrden\" value=\"" . $arreglo[0] . "\"/>|" . $arreglo[1];
        return $cadena;
    }

    public function getArraycargarCodigoPersona($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArraycargarCodigoPersona($datos);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
//        $cadena = "<table width=\"100%\" align=\"center\" border=\"0\">"
//                . " <tr>"
//                . "   <td width=\"100%\" align=\"center\" style=\"font-family: Arial;font-size: 16pt\"><font color=\"blue\">Cod. Persona: ".htmlentities($resultadoArray[0]['cCodigoPersona'])."</font></td>"
//                . " </tr>"
//                . "</table>";
        $codigo = $resultadoArray[0]['cCodigoPersona'];
        $cadena1 = "<b>Cod. Persona: </b>" . htmlentities($resultadoArray[0]['cCodigoPersona']);
        $cadena1.= "<input type='hidden' id='hCodigoPersonaParaCobro' value='$codigo' >";
        return $cadena1 . "|" . htmlentities($resultadoArray[0]['iCodigoProgramacion']);
    }

    function verificarCronogramaAfiliacion($datos) {
        $dcita = new DCita();
        $resultado = $dcita->verificarCronogramaAfiliacion($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }

    function obtenerListaProgramacionEmergenciaInformes($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayProgramacionEmergenciaInformes($datos);
        $dias = array("1" => "Dom", "2" => "Lun", "3" => "Mar", "4" => "Mie", "5" => "Jue", "6" => "Vie", "7" => "Sab");
        $Arrayresultado = array();
        $j = 0;
        foreach ($resultado as $ind => $valor) {
            $valor[1] = $dias[$valor[1]];
            $valor['dia'] = $dias[$valor['dia']];
            $Arrayresultado[$ind] = $valor;
            $imagen = "../../../../fastmedical_front/imagen/icono/ver.png ^ Agregar";
            array_push($Arrayresultado[$j], $imagen);
            $j++;
        }
        return $Arrayresultado;
    }

    function lMostrarCronogramaMedicoCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dMostrarCronogramaMedicoCita($datos);
        $dias = array("1" => "Dom", "2" => "Lun", "3" => "Mar", "4" => "Mie", "5" => "Jue", "6" => "Vie", "7" => "Sab");
        $Arrayresultado = array();
        foreach ($resultado as $ind => $valor) {
            $valor[1] = $dias[$valor[1]];
            $valor['dia'] = $dias[$valor['dia']];
            $Arrayresultado[$ind] = $valor;
        }
        return $Arrayresultado;
    }

    /* ============================================================================== */
    /* DESCOMENTAR PARA QUE FUNCIONE LOS ADICIONALES IDEALMENTE!!!!!CUANDO SE HAGA EL MODULO PARA MEDICOS */
    /*
      public function getTablaAdicionales($datos) {
      $dcita = new DCita();
      $resultado = $dcita->getArrayTablaAdicionales($datos);

      $blanco="";
      if(!empty($resultado[0]["estado"])) {
      foreach($resultado as $indice=>$fila) {
      $imageneliminaractivado="<a href=\"javascript:eliminarCitaAdicionalInformes('".$resultado[$indice]['iCodigoProgramacion']."','".$datos["codigoCronograma"]."');\"><img src=\"../../../../fastmedical_front/imagen/icono/editdelete.png\"></a>";
      $imageneliminardesactivado="<a href=\"javascript:prohibidoeliminarAdicionalInformes('".$resultado[$indice]['estado']."');\"><img src=\"../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png\"></a>";
      if($resultado[$indice]['estado']=="RESERVADO") {
      array_push($resultado[$indice],$imageneliminaractivado);
      }else {
      array_push($resultado[$indice],$imageneliminardesactivado);
      }
      array_push($resultado[$indice],$blanco);

      }
      }
      return $resultado;
      }
     */
    /* ============================================================================= */
    /* MOSTRAR LAS PROGRAMACIONES DETALLADAS CON ADICIONALES FUERA DE TURNOS=====PARCHE!!!! */
    /* COMENTAR O ELIMINAR CUANDO SE REALIZE EL MODULO PARA MEDICOS */

    public function getTablaProgramacionDetallada($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayTablaProgramacionDetallada($datos);

        $blanco = "";
        if (!empty($resultado[0]["estado"])) {
            foreach ($resultado as $indice => $fila) {
                $resultado[$indice][1]=  utf8_encode($resultado[$indice][1]);
                if (isset($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA_TABLA_PROG_DET"]) && ($_SESSION["permiso_formulario_servicio"][118]["ELIMINAR_CITA_TABLA_PROG_DET"] == 1)) {
                    $imageneliminaractivado = "<a href=\"javascript:eliminarCitaAdicionalInformes('" . $resultado[$indice]['iCodigoProgramacion'] . "','" . $datos["codigoCronograma"] . "');\"><img src=\"../../../../fastmedical_front/imagen/icono/editdelete.png\"></a>";
                } else {
                    $imageneliminaractivado = "-";
                }

                $imageneliminardesactivado = "<a href=\"javascript:prohibidoeliminarAdicionalInformes('" . $resultado[$indice]['estado'] . "');\"><img src=\"../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png\"></a>";

                if ($resultado[$indice]['estado'] == "RESERVADO") {
                    array_push($resultado[$indice], $imageneliminaractivado);
                } else {
                    array_push($resultado[$indice], $imageneliminardesactivado);
                }

                //if (isset($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"]) && ($_SESSION["permiso_formulario_servicio"][118]["CAMBIAR_ESTADO_NO_ATENDIDO"] == 1)){
                $imageneliminaractivadoAdicional = "<a href=\"javascript:CambiarEstadoNoAtendidoAdicional('" . $resultado[$indice]['estado'] . "','" . $resultado[$indice]['iCodigoProgramacion'] . "');\"><img src=\"../../../../fastmedical_front/imagen/icono/reload3.png\" title='Cambiar de Estado'></a>";
                // } else {
                // $imageneliminaractivadoAdicional = "-";
                // }
                //print_r($resultado);
                if (($resultado[$indice]['estado'] == "ATENDIDO" || $resultado[$indice]['estado'] == "PAGADO") && ltrim(rtrim($resultado[$indice]['cHoraProgramada'])) == '---') {
                    array_push($resultado[$indice], $imageneliminaractivadoAdicional);
                } else {
                    array_push($resultado[$indice], '');
                }


                //array_push($resultado[$indice], $blanco);
            }
        }
        return $resultado;
    }

    /* ============================================================================= */

    public function getArrayeliminarCitaAdicional($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayeliminarCitaAdicional($datos);
        return utf8_encode($resultado[0]["respuesta"]);
        // break;
    }

    public function getCronogramaDetallada($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getCronogramaDetallada($datos);
        return $resultado; // break;
    }

    //JCQA
    public function LseleccionandoTratamientoParaCita($datos) {
        $o_LCita = new LCita();
        $resultadoJC = $o_LCita->LseleccionandoTratamientoParaCita($datos);
    }

    public function getArrayguardarCitaProgramada($datos) {
        $dcita = new DCita();
        $i = 0;
        $citaProcedimiento[$i] = new DCita();

        //Resultado para Procedimientos  y Consultorio
        $resultado = $dcita->getArrayguardarCitaProgramada($datos);
        //var_dump($resultado);
        $resultadoArray = array();
        foreach ($resultado as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }

        ////////////////////////////////PROCEDIMIENTOS/////////////////////////////////////////////////
        if ($datos["codigoTipoCita"] == "0002" && $resultadoArray[0]["nrodoc"] != "") {
            $datos["codigoformato"] = $resultadoArray[0]["codigoformato"];
            $datos["numeroformato"] = $resultadoArray[0]["numeroformato"];
            $servicios = array();
            $servicios = explode("gxxxgr", $datos["codigoServicioProducto"]);
            $matrizservicios = array();
            foreach ($servicios as $ind => $dato) {
                $matrizservicios[$ind] = explode("|", $dato);
            }

            $contadorservicios = count($matrizservicios) - 1;
            $i = 0;
            $detalle = array();
            //Por cada Servicio escogido de Procedimientos
            while ($i < $contadorservicios) {
                unset($dcita);
                $dcita = new DCita();
                $detalle["codigoservicio"] = $matrizservicios[$i][0];
                $detalle["nombreservicio"] = $matrizservicios[$i][1];
                $detalle["precioservicio"] = $matrizservicios[$i][2];
                $detalle["cantidadservicio"] = $matrizservicios[$i][3];
                $detalle["totalservicio"] = $matrizservicios[$i][2] * $matrizservicios[$i][3];
                //Devuelve el c_item para luego ingresarlo a dbweb.OrdenesTratamiento

                $resultado1 = $dcita->guardardetallectacte($datos, $detalle, $resultadoArray[0]["nrodoc"]);

                $resultadoArraydxctacte = array();
                foreach ($resultado1 as $indice1 => $fila1) {
                    $resultadoArraydxctacte[$indice1] = $fila1;
                }
//                if ($datos["idTratamientoSeleccionado"] != "abcde") {
//                    //insertando a dbweb.OrdenesTratamiento
////                    $dcita->insertarOrdenesTratamiento($datos, $resultadoArraydxctacte);
////                    Match con Listado de recetas
//                    $dcita->insertarOrdenesTratamientoProcedimiento($datos, $resultadoArraydxctacte);
//                }
                $i = $i + 1;
            }
        }  //Fin de Procedimientos
        ///////////////////////////////Agregado 14 Febrero JCQA/////////////////////////////////////
        ////////////////////////////////CONSULTORIO/////////////////////////////////////////////////

        if ($datos["codigoTipoCita"] == "0001" && $resultadoArray[0]["c_item"] != "" && $datos["idTratamientoSeleccionado"] != "abcde") {
            unset($dcita);
            $dcita = new DCita();
            $resultadoArraydxctacte = array();
            $resultadoArraydxctacte[0]["c_item"] = $resultadoArray[0]["c_item"];
            //Comentado 27 Marzo 2013
            //$dcita->insertarOrdenesTratamiento($datos, $resultadoArraydxctacte);
        }
        /////Fin Agregado JCQA

        if ($resultadoArray[0]["nrodoc"] != '' || $resultadoArray[0]["c_item"] != '') {
            ///Procedimiento
            If ($resultadoArray[0]["nrodoc"] != '') {
                $numeroOrden = substr($resultadoArray[0]["nrodoc"], 0, 12);
            }
            /////Consultorio
            If ($resultadoArray[0]["c_item"] != '') {
//                $numeroOrden = $resultadoArray[0]["c_nro_doc"] . '|' . $resultadoArray[0]["c_nro_doc"];
                $numeroOrden = $resultadoArray[0]["c_nro_doc"];
            }

//            If ($resultadoArray[0]["c_item"] != '') {
//
//                $numeroOrden = substr($resultadoArray[0]["c_item"], 0, 12);
//            }
//            $numeroOrden = substr($resultadoArray[0]["nrodoc"], 0, 12);

            $idProgramacion = '';

            if ($datos["codigoTipoCita"] == "0002") {
                //Procedimientos
                $cadenaAuxiliar = $resultadoArray[0]["nrodoc"] . '|' . $resultadoArray[0]["idprogramacion"] . '|';
            } else {
                //Consultorio
//                echo 'holitas';
                //$cadenaAuxiliar = $resultadoArray[0]["nrodoc"];    AGREGADO 11 FEBRERO
//                $cadenaAuxiliar = $resultadoArray[0]["c_nro_doc"];
                $cadenaAuxiliar = $resultadoArray[0]["c_nro_doc"] . '|' . $resultadoArray[0]["idprogramacion"] . '|';
//                echo 'araoz:' . $cadenaAuxiliar . 'jose:';
                // substr($resultadoArray[0]["nrodoc"], 0,12);
            }

            ///////////////////////agregado//////////////////////////////
//             if ($datos["codigoTipoCita"] == "0001") {
//                $cadenaAuxiliar = $resultadoArray[0]["nrodoc"] . '|' . $resultadoArray[0]["idprogramacion"] . '|';
//            } else {
//                //$cadenaAuxiliar = $resultadoArray[0]["nrodoc"];    AGREGADO 11 FEBRERO
//
//                $cadenaAuxiliar = $resultadoArray[0]["c_nro_doc"];
//
//                // substr($resultadoArray[0]["nrodoc"], 0,12);
//            }
            /////////////////////////////////////////////////////


            $cadena = "<input type=\"hidden\" id=\"hidNroOrden\" value=\"" . $numeroOrden . "\"  >";
            $cadena = $cadena . "<font color=\"RED\">Nro. Orden : " . htmlentities($cadenaAuxiliar) . "</font>";
            //
        } else {

//            print_r($resultadoArray);
            $cadena = "<font color=\"RED\">NO SE GUARDO nnnnnn CORRECTAMENTE!!!!!!</font>";
        }

//        $resultado2 = $dcita->isExisteNroDoc($resultadoArray[0]["nrodoc"],$datos);
//        if($resultado2[0]["resp"] == 1)
//                $cadena = "<font color=\"RED\">Nro. Orden : ".htmlentities($resultadoArray[0]["nrodoc"])."</font>";
//        else
//                $cadena = "<font color=\"RED\">NO SE GUARDO CORRECTAMENTE!!!!!!</font>";

        return $cadena;
    }

    public function getArrayeditarCitaInformes($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayeditarCitaInformes($datos);
        return utf8_encode($resultado[0]["respuesta"]);
    }

    public function getArrayeliminarCitaProgramada($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayeliminarCitaProgramada($datos);

        return utf8_encode($resultado[0]["respuesta"]);
    }

    public function lrestaurarOrdenesTratamientoCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->drestaurarOrdenesTratamientoCita($datos);
        return $resultado;
    }

    //Registro de triaje en la programacion de pacientes
    public function spManteTriaje($accion, $codigoProgramacion, $peso, $talla, $temp, $frecCardiaca, $presArterial, $frecRespiratoria, $satOxigeno) {
        $dcita = new DCita();
        $rs = $dcita->spManteTriaje($accion, $codigoProgramacion, $peso, $talla, $temp, $frecCardiaca, $presArterial, $frecRespiratoria, $satOxigeno);
        return $rs;
    }

    public function spListaTriaje($codigoProgramacion) {
        $dcita = new DCita();
        $rs = $dcita->spListaTriaje($codigoProgramacion);
        return $rs;
    }

    /*     * *****************APOYO AL DIAGNOSTICO (IMAGENES)************************ */

    public function obtenerListaProgramacionTemporal($datos) {
        $dcita = new DCita();
        $resultado = $dcita->getArrayListaProgramacionTemporal($datos);

        $blanco = "";
        if (!empty($resultado[0]["estado"])) {
            foreach ($resultado as $indice => $fila) {
                $imageneliminaractivado = "../../../../fastmedical_front/imagen/icono/editdelete.png";
                $imageneliminardesactivado = "../../../../fastmedical_front/imagen/icono/editdelete_inactivo.png";
                if ($resultado[$indice]['estado'] == "RESERVADO") {
                    array_push($resultado[$indice], $imageneliminaractivado);
                } else {
                    array_push($resultado[$indice], $imageneliminardesactivado);
                }
                array_push($resultado[$indice], $blanco);
            }
        }
        return $resultado;
    }

    ///////////////////////////////////////////////DETALLE DE ORDENES////////////////////////////////////////////////////

    public function LMostrarDetalleOrden($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarDetalleOrden($datos);
        return $resultado;
    }

    public function LMostrarUsuarioRegistro($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarUsuarioRegistro($datos);
        return $resultado;
    }

    public function LMostrarUsuarioConfirma($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarUsuarioConfirma($datos);
        return $resultado;
    }

    public function LMostrarUsuarioPaga($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarUsuarioPaga($datos);
        return $resultado;
    }

    public function LMostrarAtencionInicio($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarAtencionInicio($datos);
        return $resultado;
    }

    public function LMostrarAtencionFin($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarAtencionFin($datos);
        return $resultado;
    }

    public function LmostrarReceta($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DmostrarReceta($datos);
        return $resultado;
    }

    public function lListarCronogramaMedicoEmergencia($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dListarCronogramaMedicoEmergencia($datos);
        return $resultado;
    }

    public function lListaUbicacionCita() {
        $dcita = new DCita();
        $resultado = $dcita->dListaUbicacionCita();
        return $resultado;
    }

    public function lDatosNumeroPlaca($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dDatosNumeroPlaca($datos);
        return $resultado;
    }

    public function lUbicacionesImagenes() {
        $dcita = new DCita();
        $resultado = $dcita->dUbicacionesImagenes();
        return $resultado;
    }

    public function lHistorialUbicacionesImagenes($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dHistorialUbicacionesImagenes($datos);
        return $resultado;
    }

    public function lDatosEditarCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dDatosEditarCita($datos);
        return $resultado;
    }
    public function lServicios($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dServicios($datos);
        return $resultado;
    }
    
    public function lCargarMedicosEditarCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dCargarMedicosEditarCita($datos);
        return $resultado;
    }

    public function lUpdateUbicacionCita($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dUpdateUbicacionCita($datos);
        return $resultado;
    }

    public function lMostrarDetalleCronogramaMedico($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DMostrarDetalleCronogramaMedico($datos);
        return $resultado;
    }

    public function LtablacargarMedicosAsignados($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DtablacargarMedicosAsignados($datos);
        return $resultado;
    }

    public function LguardarASignacionMedico($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DguardarASignacionMedico($datos);
        return $resultado;
    }

    public function lListarHistoriaCronogramaPaciente($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dListarHistoriaCronogramaPaciente($datos);
        return $resultado;
    }

    public function LvalidaServicionConProcedimiento($datos) {
        $dcita = new DCita();
        $resultado = $dcita->DvalidaServicionConProcedimiento($datos);
        return $resultado;
    }
     public function lCargarDatosLeyenda($datos) {
        $dcita = new DCita();
        $resultado = $dcita->dCargarDatosLeyenda($datos);
        return $resultado;
    }
    

}

?>
