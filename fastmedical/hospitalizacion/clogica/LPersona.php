<?php

require_once("../../cdatos/DPersona.php");

class LPersona {

    public function __construct() {
        
    }

    /* public function listaPersonasAdmision($opcion,$patron) {
      if($opcion==1) {
      $codBusqueda='06';
      $valor=utf8_encode($patron);
      }
      elseif($opcion==2) {
      $codBusqueda='21';
      $valor=$patron;
      }
      elseif($opcion==3) {
      $codBusqueda='14';
      $valor=utf8_encode($patron);
      }
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->listaPersonasAdmision($codBusqueda,$valor);
      $resultadoArray = array();
      foreach($rs as $fila) {
      $fila[9]=($fila[8]!='' ? date("d/m/Y",strtotime($fila[8])):'');
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      } */

//Busca personas por apellidos paterno y materno.
    public function listaPersonasAdmisionxApellidos($paterno, $materno) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaPersonasAdmisionxApellidos($paterno, $materno);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function listaAfiliacionPrecio($parametros) {
        $o_DPersona = new DPersona();
        $resultado = $o_DPersona->getVerificacionAfiliacionPrecio($parametros);
        return $resultado;
    }

    /* public function getArrayPersonaspordni($tipoDoc,$patron) {
      $codBusqueda='31';
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->getArrayDni($codBusqueda,utf8_encode($patron));
      //print_r($rs);
      $i=0;
      foreach($rs as $fila) {
      $aResults[$i]['id']    = $i;
      $aResults[$i]['value'] = $fila[1];
      $aResults[$i]['info']  = "";
      $i++;
      }
      return $aResults;
      } */

//Lista de documentos de identidad en un array.
    public function listaDocumentoIdentidad($c_cod_per) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaDocumentoIdentidad($c_cod_per);
        foreach ($rs as $fila) {

            echo $fila . "<br>";
        }
    }

    /* public function validaArrayPersonaspordni($tipoDoc,$patron){
      $codBusqueda='36';
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->validaArrayDni($codBusqueda,$tipoDoc,utf8_encode(trim($patron)));
      $i=0;
      $aResults=array();
      foreach($rs as $fila){
      $aResults[$i]['c_cod_per'] = $fila[0];
      $aResults[$i]['c_ndide']   = $fila[1];
      $aResults[$i]['nombre']    = $fila[2];
      $aResults[$i]['d_fecnac']  = $fila[3];
      $i++;
      }
      return $aResults;
      } */

//Busca personas por tipo y número de documento.
    public function validaPersonasDocIdentidad($tipo_documento, $nro_documento) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->validaPersonasDocIdentidad($tipo_documento, $nro_documento);
        $resultado = array();
        foreach ($rs as $fila) {
            array_push($resultado, $fila);
        }
        return $resultado;
    }

//Busca personas por apellidos paterno, materno y nombres.
    public function validaPersonasNombres($paterno, $materno, $nombres) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->validaPersonasNombres($paterno, $materno, $nombres);
        $i = 0;
        $aResults = array();
        foreach ($rs as $fila) {
            $aResults[$i]['c_cod_per'] = $fila[0];
            $aResults[$i]['nombre'] = $fila[1];
            $i++;
        }
        return $aResults;
    }

    /* public function longitudDNI($select,$option) {
      $codBusqueda='37';
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->lCampo($codBusqueda,$select,$option);
      $aResults = array();
      $aResults['iddtbl']   = $rs[0][0];
      $aResults['descri']   = $rs[0][1];
      $aResults['descri_r'] = $rs[0][2];
      $aResults['observ']   = $rs[0][3];
      $aResults['tipdat']   = $rs[0][4];
      $aResults['longit']   = $rs[0][5];
      $aResults['defect']   = $rs[0][6];
      return $aResults['longit'];
      } */

    /* public function getArrayContribuyentes($opcion,$patron) {
      if($opcion==1) {
      $codBusqueda='13';
      }//Busca de contribuyentes por codigo
      elseif($opcion==2) {
      $codBusqueda='12';
      }//Busca de contribuyentes por apellido.
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->getArrayPersonas($codBusqueda,utf8_encode($patron));
      $resultadoArray = array();
      foreach($rs as $fila) {
      $fila[9]=($fila[8]!='' ? date("d/m/Y",strtotime($fila[8])):'');
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      } */

//Lista de Estado Civiles en un array.
    public function seleccionarEstadoCivil() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarEstadoCivil();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

//Lista de tipos de Instituciones Educativas en un array.
    public function seleccionarTipoInstEducativa() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarTipoInstEducativa();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

//Lista de Insituciones Educativas en un array.
    public function seleccionarInstEducativa($tipoInstitucion) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarInstEducativa($tipoInstitucion);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

//Lista de Grupos Sanguíneos en un array.
    public function seleccionarGrupoSanguineo() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarGrupoSanguineo();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

//Lista de Tipos de medio de contacto en un array.
    public function seleccionarMediosContacto() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarMediosContacto();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = $fila[1];
        }
        return $resultadoArray;
    }

    /* public function getArrayPersonasDatos($iid_dato_nivel1) {
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->getArrayPersonasDatos($iid_dato_nivel1);
      $resultadoArray = array();
      foreach($rs as $fila) {
      $op=$fila[0];
      $opx=str_replace("0","",$fila[0]);
      $resultadoArray[$opx]=$fila[1];
      }
      return $resultadoArray;
      } */

//Verifica si el año es bisiesto.
    function bisiesto($anio_actual) {
        $bisiesto = false;
//probamos si el mes de febrero del año actual tiene 29 días
        if (checkdate(2, 29, $anio_actual)) {
            $bisiesto = true;
        }
        return $bisiesto;
    }

//Devuelve la edad a partir de la fecha de nacimiento.
    public function formatoEdad($fecha_de_nacimiento = "") {
        $fecha_actual = date("Y-m-d");
// print_r($fecha_de_nacimiento);

        $fecha_de_nacimiento = empty($fecha_de_nacimiento) ? $fecha_actual : $fecha_de_nacimiento;
        $fx = strtotime($fecha_de_nacimiento);
//      print_r($fx);
        $arrfx = date("Y-m-d", $fx);
//    print_r($arrfx);
        $array_nacimiento = explode("-", $arrfx);
        $array_actual = explode("-", $fecha_actual);
        $anos = $array_actual[0] - $array_nacimiento[0]; // calculamos años
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias = $array_actual[2] - $array_nacimiento[2]; // calculamos días
//        print_r($anos);
//        print_r($meses);
//        print_r($dias);
        if ($dias < 0) {
            --$meses;
            switch ($array_actual[1]) {
                case 1: $dias_mes_anterior = 31;
                    break;
                case 2: $dias_mes_anterior = 31;
                    break;
                case 3:
                    if ($this->bisiesto($array_actual[0])) {
                        $dias_mes_anterior = 29;
                        break;
                    } else {
                        $dias_mes_anterior = 28;
                        break;
                    }
                case 4: $dias_mes_anterior = 31;
                    break;
                case 5: $dias_mes_anterior = 30;
                    break;
                case 6: $dias_mes_anterior = 31;
                    break;
                case 7: $dias_mes_anterior = 30;
                    break;
                case 8: $dias_mes_anterior = 31;
                    break;
                case 9: $dias_mes_anterior = 31;
                    break;
                case 10: $dias_mes_anterior = 30;
                    break;
                case 11: $dias_mes_anterior = 31;
                    break;
                case 12: $dias_mes_anterior = 30;
                    break;
            }
            $dias = $dias + $dias_mes_anterior;
        }
        if ($meses < 0) {
            --$anos;
            $meses = $meses + 12;
        }
        $rpta = $anos . " a," . $meses . " m," . $dias . " d";
        return $rpta;
    }
    public function formatoEdadActoMedico($fecha_de_nacimiento = "") {
        $fecha_actual = date("Y-m-d");
// print_r($fecha_de_nacimiento);

        $fecha_de_nacimiento = empty($fecha_de_nacimiento) ? $fecha_actual : $fecha_de_nacimiento;
        $fx = strtotime($fecha_de_nacimiento);
//      print_r($fx);
        $arrfx = date("Y-m-d", $fx);
//    print_r($arrfx);
        $array_nacimiento = explode("-", $arrfx);
        $array_actual = explode("-", $fecha_actual);
        $anos = $array_actual[0] - $array_nacimiento[0]; // calculamos años
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias = $array_actual[2] - $array_nacimiento[2]; // calculamos días
//        print_r($anos);
//        print_r($meses);
//        print_r($dias);
        if ($dias < 0) {
            --$meses;
            switch ($array_actual[1]) {
                case 1: $dias_mes_anterior = 31;
                    break;
                case 2: $dias_mes_anterior = 31;
                    break;
                case 3:
                    if ($this->bisiesto($array_actual[0])) {
                        $dias_mes_anterior = 29;
                        break;
                    } else {
                        $dias_mes_anterior = 28;
                        break;
                    }
                case 4: $dias_mes_anterior = 31;
                    break;
                case 5: $dias_mes_anterior = 30;
                    break;
                case 6: $dias_mes_anterior = 31;
                    break;
                case 7: $dias_mes_anterior = 30;
                    break;
                case 8: $dias_mes_anterior = 31;
                    break;
                case 9: $dias_mes_anterior = 31;
                    break;
                case 10: $dias_mes_anterior = 30;
                    break;
                case 11: $dias_mes_anterior = 31;
                    break;
                case 12: $dias_mes_anterior = 30;
                    break;
            }
            $dias = $dias + $dias_mes_anterior;
        }
        if ($meses < 0) {
            --$anos;
            $meses = $meses + 12;
        }
        $rpta = $anos . " años, " . $meses . " meses, " . $dias . " días ";
        return utf8_decode($rpta);
    }
public function formatoEdadCitas($fecha_de_nacimiento = "") {
        $fecha_actual = date("Y-m-d");
// print_r($fecha_de_nacimiento);

        $fecha_de_nacimiento = empty($fecha_de_nacimiento) ? $fecha_actual : $fecha_de_nacimiento;
        $fx = strtotime($fecha_de_nacimiento);
//      print_r($fx);
        $arrfx = date("Y-m-d", $fx);
//    print_r($arrfx);
        $array_nacimiento = explode("-", $arrfx);
        $array_actual = explode("-", $fecha_actual);
        $anos = $array_actual[0] - $array_nacimiento[0]; // calculamos años
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias = $array_actual[2] - $array_nacimiento[2]; // calculamos días
//        print_r($anos);
//        print_r($meses);
//        print_r($dias);
        if ($dias < 0) {
            --$meses;
            switch ($array_actual[1]) {
                case 1: $dias_mes_anterior = 31;
                    break;
                case 2: $dias_mes_anterior = 31;
                    break;
                case 3:
                    if ($this->bisiesto($array_actual[0])) {
                        $dias_mes_anterior = 29;
                        break;
                    } else {
                        $dias_mes_anterior = 28;
                        break;
                    }
                case 4: $dias_mes_anterior = 31;
                    break;
                case 5: $dias_mes_anterior = 30;
                    break;
                case 6: $dias_mes_anterior = 31;
                    break;
                case 7: $dias_mes_anterior = 30;
                    break;
                case 8: $dias_mes_anterior = 31;
                    break;
                case 9: $dias_mes_anterior = 31;
                    break;
                case 10: $dias_mes_anterior = 30;
                    break;
                case 11: $dias_mes_anterior = 31;
                    break;
                case 12: $dias_mes_anterior = 30;
                    break;
            }
            $dias = $dias + $dias_mes_anterior;
        }
        if ($meses < 0) {
            --$anos;
            $meses = $meses + 12;
        }
        $rpta = $anos . " años, " . $meses . " meses, " . $dias . " días ";
        return $rpta;
    }

//FUNCIONES PARA MANTENIMIENTO DE PERSONA
//Inserta o Edita los datos de un paciente, llama a los métodos en DPersona.
    public function mantenimiento_Personas($p_acc, $p_iid, $arrP) {
//Graba datos principales de la persona(mx_persona)
        $o_DPersona = new DPersonas();
        $o_DPersona2 = new DPersonas();
        $o_DPersona3 = new DPersonas();
        $o_DPersona4 = new DPersonas();
        $o_DPersona5 = new DPersonas();
        $o_DPersona6 = new DPersonas();
        $o_DPersona7 = new DPersonas();
        $p_iid = $p_acc == 'update' ? $p_iid : $o_DPersona->generaCodigoPersona();
        $op2 = $o_DPersona2->mantePersona(($p_acc == 'update' ? '01' : '11'), $p_iid, $arrP);
        $op3 = $o_DPersona3->mantePersonaDireccion(($p_acc == 'update' ? '02' : '12'), $p_iid, $arrP);
        $op4 = $o_DPersona4->mantePersonaDireccionNac(($p_acc == 'update' ? '02' : '12'), $p_iid, $arrP);
        $op5 = $o_DPersona5->mantePersonaEstudios(($p_acc == 'update' ? '05' : '15'), $p_iid, $arrP);
        $op6 = $this->mantePersonaDocumentos($p_acc, $p_iid, $arrP);
        $op7 = $arrP["p39"] == '' ? '' : $this->mantePersonaDerHab($p_acc, $p_iid, $arrP);
        $op8 = $this->mantePersonaContactos($p_acc, $p_iid, $arrP);
        $op9 = $o_DPersona6->mantePersonaCompleto($p_iid);
        $resultado = $p_iid; //"La persona se registro correctamente";
        return $resultado;
    }

//Lista de departamentos en array.
    public function getArraylistaDatosUbigeoDep($pais) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArraylistaDatosUbigeoDep($pais);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = utf8_encode($fila[1]);
        }
        return $resultadoArray;
    }

    public function getArraylistaDatosPais() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArraylistaDatosPais();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = utf8_encode($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de provincias en array.
    public function getArraylistaDatosUbigeoProv($anioUbigeo, $dep_ubi) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArraylistaDatosUbigeoProv($anioUbigeo, $dep_ubi);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = utf8_encode($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de distritos en array.
    public function getArraylistaDatosUbigeoDist($anioUbigeo, $dep_ubi, $pro_ubi) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArraylistaDatosUbigeoDist($anioUbigeo, $dep_ubi, $pro_ubi);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = utf8_encode($fila[1]);
        }
        return $resultadoArray;
    }

    /* public function getArraylistaAnioUbigeo() {
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->getArraylistaAnioUbigeo();
      return $rs;
      } */

//Inserto o actualiza los documentos de identidad de una persona.
    public function mantePersonaDocumentos($p_acc, $p_iid, $arrP) {
        $arrId = $arrP["p3"];
        $arrNumDoc = $arrP["p2"];
        for ($i = 1; $i <= count($arrId); $i++) {
            $tipoDoc = $arrId[$i];
            $numDoc = $arrNumDoc[$i];
            $o_DPersona = new DPersonas();
            $op = $o_DPersona->mantePersonaDocumentos('13', $p_iid, $tipoDoc, $numDoc);
        }
    }

//Inserta u actualiza los derecho habientes de una persona.
    public function mantePersonaDerHab($p_acc, $p_iid, $arrP) {
        $cAfiliacion = $arrP["p38"];
        $arrCodigo = $arrP["p39"];
        $arrDerHab = $arrP["p41"];
        $c_cod_per_r = $p_iid;
        for ($i = 1; $i <= count($arrCodigo); $i++) {
            $c_cod_per = $arrCodigo[$i];
            $c_cod_per_h = $arrDerHab[$i];
            $o_DPersona = new DPersonas();
            $op = $o_DPersona->mantePersonaDerHab($cAfiliacion, $c_cod_per, $c_cod_per_r, $c_cod_per_h);
        }
    }

//Inserta u actualiza los contactos de una persona. (teléfono, celular1, celular2, mail)
    public function mantePersonaContactos($p_acc, $p_iid, $arrP) {
        $c_tipo = ($p_acc == 'update' ? '04' : '14');
        $telefono = $arrP["p11"];
        $celular = $arrP["p12"];
        $celular2 = $arrP["p13"];
        $email = $arrP["p14"];
        $o_DPersona1 = new DPersonas();
        $o_DPersona2 = new DPersonas();
        $o_DPersona3 = new DPersonas();
        $o_DPersona4 = new DPersonas();
        $op1 = $o_DPersona1->mantePersonaContactos($c_tipo, $p_iid, '0001', $telefono);
        $op2 = $o_DPersona2->mantePersonaContactos($c_tipo, $p_iid, '0003', $celular);
        $op3 = $o_DPersona3->mantePersonaContactos($c_tipo, $p_iid, '0004', $celular2);
        $op4 = $o_DPersona4->mantePersonaContactos($c_tipo, $p_iid, '0007', $email);
    }

/////////////////////////////////////////////////////// FILIACIONES DE PACIENTES  ////////////////////////////////
//Lista de afiliaciones de un paciente.
    public function listaFiliacionPaciente($c_cod_per, $cAfiliacion) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaFiliacionPaciente($c_cod_per);
        $resultadoArray = array();
        if ($c_cod_per != '') {
            foreach ($rs as $fila) {
//echo "<br>$fila[0]  $fila[1]  $fila[2]  $fila[3] $fila[4] $fila[5] $fila[6] $fila[7]<br>";
                $filiacion = $fila[0]; //p2
                $vDescripcion = $fila[1]; //p3
                $cNumeroAfiliacion = $fila[2]; //p4
                $c_cod_per = $fila[3]; //p5
                $c_cod_per_h = $fila[4]; //p6
                $c_cod_per_r = $fila[5]; //p7
                if ($cAfiliacion == '') {
                    $bUltimaAfil = $fila[6]; //p8
                } else {
                    $bUltimaAfil = $filiacion == $cAfiliacion ? '1' : '0';
                }
                $imageDerHab = $bUltimaAfil == 1 ? "add_user.png" : "add_user_black.png";
                $checked = $bUltimaAfil == "1" ? "checked='checked'" : "";
                $fila[6] = "<input type='radio' disabled='disabled' name='iddafiliacion' id='iddafiliacion' " . $checked . " value='" . $filiacion . "'
                                                onclick=\"
                                                        btn='btnAgregaDerHab[" . $filiacion . "]';
                                                        if(document.getElementById(btn)){
                                                            btnAgregaDerHab2=document.getElementById(btn);
                                                            deshabilita_agrega_fila_derhabiente();
                                                            btnAgregaDerHab2.disabled=false;
                                                            btnAgregaDerHab2.style.background='url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat';
                                                            btnAgregaDerHab2.style.cursor='pointer';
                                                            }else{
                                                                deshabilita_agrega_fila_derhabiente();
                                                            }
                                                            document.getElementById('dh_filiacion').value = '" . $filiacion . "';
                                                            myajax.Link('../../ccontrol/control/control.php?p1=derecho_habiente&p2=" . $filiacion . "&p3=" . $vDescripcion . "&p4=&p5=" . $c_cod_per . "&p6=&p7=" . $c_cod_per . "&p8=&p9=&p10=&p11=" . $c_cod_per . "','der_hab');\"/>";
                $der_hab = $fila[8] == "1" ? "<input type='button' id='btnAgregaDerHab[" . $filiacion . "]'
                                                        style='border:0px;background:url(../../../../fastmedical_front/imagen/icono/add_user.png) no-repeat;background-color:transparent;width:30px'
                                                        onclick=\"agrega_fila_derhabiente('tblDerHab');
                                                                  ventana_busca_persona('setDatosDerechoHabiente');\">" : "&nbsp;";
                $fila[5] = $der_hab;
                array_push($resultadoArray, $fila);
                $script2 = "<script>deshabilita_agrega_fila_derhabiente();</script>";
                echo $script2;
            }
        } else {
            $fila[0] = "";
            $fila[1] = "AMB. HOSPITAL";
            $fila[2] = "";
            $fila[3] = "";
            $fila[4] = "";
            $fila[5] = "";
            $fila[6] = "<input type='radio' name='iddafiliacion' id='iddafiliacion' checked='checked' value='0001'
                                            onclick=\"deshabilita_agrega_fila_derhabiente();
                                            $('dh_filiacion').value = '0001';\"/>";
            $der_hab = "&nbsp;";
            $fila[5] = $der_hab;
            array_push($resultadoArray, $fila);
            $script2 = "<script>$('dh_filiacion').value = '0001';</script>";
//echo $script2;
        }
        return $resultadoArray;
    }

//Lista de afiliaciones disponibles para un paciente.
    public function listaNoFiliacionPaciente($c_cod_per) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaNoFiliacionPaciente($c_cod_per);
        $resultadoArray = array();
        $i = 0;
        foreach ($rs as $fila) {
            $idAfiliacion = $fila['cIdAfiliacion'];
            $nombreAfiliacion = $fila['vDescripcion'];
            $numeroAfiliacion = $fila['vNumeroAfiliacion'];
            $fechaApertua = $fila['dFechaApertura'];
            $fechaCierre = $fila['dFechaCierre'];
            $tipoCarta = $fila['cCarta'];
            $estado = $fila['iEstado'];
            $objeto = $fila['vObjeto'];
            $tipoCarta = $fila['nTipoCarta'];
            $flagDerechoHabiente = $fila['bDerechoHabiente'];
            $porcentaje = $fila['nPorcentaje'];
            $flagIncluyeIgv = $fila['bIncluyeIgv'];
            if ($c_cod_per != '') {
                $filaX[0] = $fila[0];
                $filaX[1] = $fila[1];
                $filaX[2] = "<input type='button' disabled='disabled' name='btnNoAfiliado[" . $i . "]' id='btnNoAfiliado[" . $i . "]' style=\"background:url('../../../../fastmedical_front/imagen/icono/db_add_black.png') no-repeat;width:18px;border:0px;cursor:default;\" title='Agregar Filiacion' onmouseover=\"this.style.cursor='pointer'\" onclick=\"agrega_filiacion('" . $idAfiliacion . "','" . $nombreAfiliacion . "','" . $flagDerechoHabiente . "');elimina_filiacion(this.parentNode.parentNode.rowIndex);\">";
                array_push($resultadoArray, $filaX);
                $i++;
            } else {
                if ($idAfiliacion != '0001') {
                    $filaX[0] = $fila[0];
                    $filaX[1] = $fila[1];
                    $filaX[2] = "<input type='button' name='btnNoAfiliado[" . $i . "]' id='btnNoAfiliado[" . $i . "]' style=\"background:url('../../../../fastmedical_front/imagen/icono/db_add.png') no-repeat;width:18px;border:0px;cursor:pointer;\" title='Agregar Filiacion' onmouseover=\"this.style.cursor='pointer'\" onclick=\"agrega_filiacion('" . $idAfiliacion . "','" . $nombreAfiliacion . "','" . $flagDerechoHabiente . "');elimina_filiacion(this.parentNode.parentNode.rowIndex);\">";
                    array_push($resultadoArray, $filaX);
                    $i++;
                }
            }
        }
        return $resultadoArray;
    }

//Inserta u actualiza la afiliación de un paciente o de un derecho habiente.
    public function MantenimientoFiliacion($op_bd, $iafil, $ipers, $ipare, $btitu, $ipe_r, $bacti, $besta, $dvi_i, $dvi_f, $bcadu) {
//echo "$op_bd,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu";die();
        $o_DPersona = new DPersonas();
        if ($op_bd == 'insertar') {
            $rs = $o_DPersona->AgregaFiliacion($iafil, $ipers, $ipare, $btitu, $ipe_r, $bacti, $besta, $dvi_i, $dvi_f, $bcadu);
        } elseif ($op_bd == 'actualizar') {
            $rs = $o_DPersona->ActualizaFiliacion($iafil, $ipers, $ipare, $btitu, $ipe_r, $bacti, $besta, $dvi_i, $dvi_f, $bcadu);
        }
        /* foreach($rs as $fila){
          $op=$fila[0];
          } */
        $op = 1;
        return $op;
    }

////////////////////////////////////////////////////////// DERECHO HABIENTES //////////////////////////////////////////
    /* public function MantenimientoDerechoHabiente($op_bd,$usuario,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo) {
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->MantenimientoDerechoHabiente($op_bd,$usuario,$iafil,$ipers,$ipare,$btitu,$ipe_r,$bacti,$besta,$dvi_i,$dvi_f,$bcadu,$ipe_rsexo);
      foreach($rs as $fila){
      $op=$fila[0];
      }
      $op=1;
      return $op;
      } */
//Lista los derecho habientes de una persona para una afiliación que lo permita.
    public function ListaDerHabienteFiliacion($c_cod_per, $cAfiliacion) {
        $der_hab = "";
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->ListaDerHabienteFiliacion($c_cod_per, $cAfiliacion);
        $resultadoArray = array();
        $k = 1;
        foreach ($rs as $ind => $fila) {
            if ($fila[8] == '')
                $fila[8] = '0000';
            $o_ActionAdmision = new ActionAdmision();
            $cbo_vinculoFam = $o_ActionAdmision->seleccionarVinculoFamiliar($fila[8]);
            $fila[0] = "<input disabled='disabled' type='text' name='codigo[" . $k . "]' id='codigo[" . $k . "]' value='" . $fila[0] . "' style='width:60px;font-size:11px;cursor:default;'>";
            $fila[2] = "<input disabled='disabled' type='text' name='nombre[" . $k . "]' id='nombre[" . $k . "]' value='" . $fila[2] . "' style='width:220px;font-size:11px;cursor:default;'>";
            $fila[8] = "<select disabled='disabled' name='relacion[" . $k . "]' id='relacion[" . $k . "]' style='cursor:default;'>" . $cbo_vinculoFam . "</select>";
//$fila[9]="<a href='#' onclick=\"myajax.Link('../../ccontrol/control/control.php?p1=eliminar_derecho_habiente&p2=".$fila[1]."&p3=".$der_hab."&p4=0&p5=t&p6=".$der_hab."&p7=f&p8=t&p11=t&p12=eliminar&p13=vdh','fili_pac');\"><img src='../../../../fastmedical_front/imagen/btn/b_eliminar_on.gif' title='Eliminar Derecho Habiente'/></a>";
            $fila[9] = "<input disabled='disabled' type='button 'name='btnElimDerHab[" . $k . "]' id='btnElimDerHab[" . $k . "]' style='background:url(../../../../fastmedical_front/imagen/btn/b_eliminar_on_black.gif) no-repeat;width:68px;height:25px;border:0px;cursor:default;' onmouseover=\"this.style.cursor='pointer'\" title='Eliminar Derecho Habiente' onclick=\"idfila=this.parentNode.parentNode.rowIndex;elimina_fila_derhabiente(idfila)\"/>";
            array_push($resultadoArray, $fila);
            $k++;
        }
        return $resultadoArray;
    }

//Lista vínculo familiar en un array.
    public function seleccionarVinculoFamiliar() {
        $o_DPersona = new DPersonas();
        $result2 = $o_DPersona->seleccionarVinculoFamiliar();
        $resultadoArray = array();
        foreach ($result2 as $fila) {
            if ($fila[0] != '0000') {
                $op = $fila[0];
                $resultadoArray[$op] = $fila[1];
            }
        }
        return $resultadoArray;
    }

//Lista tipo de documento en un array.
    public function seleccionarTipoDocumento($cadDocs) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarTipoDocumento($cadDocs);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Búsqueda por tipo de documento.
    public function seleccionarTipoDocumentoBusqueda() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarTipoDocumentoBusqueda();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de clases de raza en un array.
    public function seleccionarClaseRaza($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarClaseRaza($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de tipos de vía en un array.
    public function seleccionarTipoVia() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarTipoVia();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de tipos de centro poblado en un array.
    public function seleccionarTipoCentroPoblado() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarTipoCentroPoblado();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de grupos laborales en un array.
    public function seleccionarGrupoLaboral() {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarGrupoLaboral();
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de subgrupos laborales en un array.
    public function seleccionarSubgrupoLaboral($grupo_laboral) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarSubgrupoLaboral($grupo_laboral);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[2]);
        }
        return $resultadoArray;
    }

//Lista de Grados de instrucción en un array.
    public function seleccionarGradoInstruccion($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarGradoInstruccion($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de Condiciones Laborales en un array.
    public function seleccionarCondicionLaboral($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarCondicionLaboral($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de clases de vivienda en un array.
    public function seleccionarClaseVivienda($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarClaseVivienda($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de medios de contacto en un array.
    public function listaMediosDeContacto($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaMediosDeContacto($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de tipos de documento en un array.
    public function listaTiposDeDocumento($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaTiposDeDocumento($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de tipos de dirección en un array.
    public function listaTiposDeDireccion($p) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->listaTiposDeDireccion($p);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

//Lista de grados de estudio en un array.
    public function seleccionarGradoEstudio($tipoInstitucion) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->seleccionarGradoEstudio($tipoInstitucion);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[1]);
        }
        return $resultadoArray;
    }

    /* public function listaNombreColegio($p) {
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->listaNombreColegio($p);
      $resultadoArray = array();
      foreach($rs as $fila) {
      $op=$fila[0];
      $resultadoArray[$op]=htmlentities($fila[1]);
      }
      return $resultadoArray;
      } */
    /* public function listaOcupacionLaboral($p) {
      $o_DPersona = new DPersonas();
      $rs = $o_DPersona->listaOcupacionLaboral($p);
      $resultadoArray = array();
      foreach($rs as $fila) {
      $op=$fila[0];
      $resultadoArray[$op]=htmlentities($fila[1]);
      }
      return $resultadoArray;
      } */

    public function fn_mante_paswd($sp1, $sp2, $sp3, $sp4) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->fn_mante_paswd($sp1, $sp2, $sp3, $sp4);
        return $rs;
    }

    public function genera_historia() {
        $op = '';
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->genera_historia();
        foreach ($rs as $fila) {
            $op = $fila[0];
        }
        return $op;
    }

     public function lDatosPersonaCompleto($patron, $tipoDoc, $parametro) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->getArrayListPersonas($patron, $tipoDoc, $parametro);
        return $array;
     }
    
//Busca personas por tipo de documento, según parámetro.
    public function getListaPersonas($patron, $tipoDoc, $parametro, $editar) {
        $o_DPersona = new DPersonas();
//echo $patron;
        $array = $o_DPersona->getArrayListPersonas($patron, $tipoDoc, $parametro);

        $i = 0;

        foreach ($array as $fila) {
            $array[$i][1]= utf8_encode($fila[1]);
            $c_cod_per = $array[$i][0];
//echo htmlentities($nombre);
// $precio=$array[$i][3];
            if ($editar == 'editar') {
                $edid = "<a href='#' onclick=\"javascript:ventanaEditaPersona('" . $c_cod_per . "');\"><img src='../../../../fastmedical_front/imagen/icono/edit2.png' title='Editar Persona'/></a>";
                array_push($array[$i], $edid);
            }
            $blanco = '';
            array_push($array[$i], $blanco);
            $i++;
        }

        return $array;
    }

//Lista las citas para una persona.
    public function ListaPersonaCitas($c_cod_per) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->ListaPersonaCitas($c_cod_per);                
        foreach ($rs as $key=>$fila) {
            array_push($rs[$key], $fila[5]=='PAGADO' || $fila[5]=='ATENDIDO'? "../../../../fastmedical_front/imagen/icono/kappfinder.png ^ Placa":"../../../../fastmedical_front/imagen/icono/kappfinder_off.png");            
        }
        return $rs;
    }

//Lista personas hospitalizadas.
    public function ListaPersonaHospitalizacion($c_cod_per) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->ListaPersonaHospitalizacion($c_cod_per);

        $resultadoArray = array();
        foreach ($rs as $fila) {
            $resultadoArray = $fila;
//array_push($resultadoArray,$fila[0]);
        }
        return $resultadoArray;
    }

//Lista de médicos filtrados por apellido paterno, materno y nombre.
    /*   public function getListaMedicos($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion) {
      $o_DPersona = new DPersonas();
      //echo $patron;
      $array = $o_DPersona->getArrayListMedicos($apellidoPaterno, $ApellidoMaterno, $Nombres);

      $i = 0;

      foreach ($array as $fila) {
      $c_cod_per = $array[$i][0];
      $nombre = htmlentities($array[$i][1]);
      $array[$i][1] = "<a href='#' onclick=\"javascript:" . $funcion . "('','','" . $array[$i][4] . "');\">" . htmlentities($array[$i][1]) . "</a>";

      $array[$i][2] = "<a href='#' onclick=\"javascript:" . $funcion . "('','','" . $array[$i][4] . "');\">" . htmlentities($array[$i][2]) . "</a>";
      //echo htmlentities($nombre);
      // $precio=$array[$i][3];
      $ver = "<a href='#' onclick=\"javascript:verCronogramaMedicoMensual('" . $c_cod_per . "','" . $nombre . "');\"><img src='../../../../fastmedical_front/imagen/icono/min_alarmd.png' title='Ver Cronograma'/></a>";
      array_push($array[$i], $ver);


      $i++;
      }

      return $array;
      } */

    function getListaMedicos($datos) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->getArrayListMedicos($datos);
        //   if (is_array($resultado)) {
     //   $i = 0;
        
        foreach ($resultado as $i => $value) {
            $resultado[$i][0] = "../../../../fastmedical_front/imagen/icono/min_alarmd.png ^ Cronograma";
           // $i++;
        }
        //print_r($resultado);
        return $resultado;
        // }
    }

    public function getListaMedicosGeneral($apellidoPaterno, $ApellidoMaterno, $Nombres, $funcion) {
        $o_DPersona = new DPersonas();
//echo $patron;
        $array = $o_DPersona->getArrayListMedicosGeneral($apellidoPaterno, $ApellidoMaterno, $Nombres);

//        $i=0;
//
//        foreach($array as $fila) {
//            $c_cod_per=$array[$i][0];
//            $nombre=htmlentities($array[$i][1]);
//            $array[$i][1]="<a href='#' onclick=\"javascript:".$funcion."('','','".$array[$i][4]."');\">".htmlentities($array[$i][1])."</a>";
//
//            $array[$i][2]="<a href='#' onclick=\"javascript:".$funcion."('','','".$array[$i][4]."');\">".htmlentities($array[$i][2])."</a>";
//            //echo htmlentities($nombre);
//            // $precio=$array[$i][3];
//            array_push($array[$i],$ver);
//
//            $i++;
//        }

        return $array;
    }

//Lista de actos médicos.
    public function getActosMedicos($c_cod_per) {
        $o_DPersona = new DPersonas();
//echo $patron;
        $array = $o_DPersona->getActosMedicos($c_cod_per);
        $i = 0;
        if (!empty($array)) {
            $arrayAux = $array['0'];
        }
        $arrayAux['0'] = 'SAM';
        $arrayAux['1'] = "Sin Acto Medico";
        $arrayAux['2'] = "";
        $arrayAux['3'] = "";
        $arrayAux['4'] = "";
        $arrayAux['5'] = "";
        $arraySinActo = array("", "Sin Acto Medico", "---", "---", "---", "---");
        array_unshift($array, $arrayAux);
//print_r($array);
        foreach ($array as $fila) {
            if ($i == 0) {
                $nroActomedico = $array[$i][0];
                $radio = "<input id=\"radioActoMedico\" type=\"radio\" name=\"radioActoMedico\" value='" . $nroActomedico . "' checked=\"true\"/>";

                $blanco = "";
                array_push($array[$i], $radio);
                array_push($array[$i], $blanco);
                array_push($array[$i], $nroActomedico);
// echo "---".$i."<br>";
            } else {
                $nroActomedico = $array[$i][1];
                $radio = "<input id=\"radioActoMedico\" type=\"radio\" name=\"radioActoMedico\" value='" . $nroActomedico . "'/>";
                $blanco = "";
                array_push($array[$i], $radio);
                array_push($array[$i], $blanco);
                array_push($array[$i], $nroActomedico);
            }
            $i++;
        }

        return $array;
    }

    public function getCronogramaMedicoMensual($codigo, $fecha) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->getCronogramaMedicoMensual($codigo, $fecha);
        $i = 0;
        $dias = array('2' => 'Lun', '3' => 'Mar', '4' => 'Mie', '5' => 'Jue', '6' => 'Vie', '7' => 'Sab', '1' => 'Dom');
//echo $fecha;
        foreach ($array as $fila) {

            $datetime = date_create($array[$i][1]);

            $array[$i][0] = $dias[$array[$i][0]];

            $i++;
        }


        return $array;
    }

    public function getDatosMedicoCronogramaMensual($datos) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->getArrayDatosMedicoCronogramaMensual($datos);
        $resultadoArray = array();
        foreach ($rs as $fila) {
            array_push($resultadoArray, $fila);
        }
        return $resultadoArray;
    }

    public function personaRegistrada($autoGenerado) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->personaRegistrada($autoGenerado);
        return $array;
    }

    public function lObtenerCoincidencias($apellidoPaterno, $ApellidoMaterno, $nombres, $dni, $rId) {
        $o_DPersona = new DPersonas();

        $array = $o_DPersona->obtenerCoincidencias($apellidoPaterno, $ApellidoMaterno, $nombres, $dni);
        $i = 0;
        foreach ($array as $fila) {
            $c_cod_per = $fila[0];
            $edid = "<a href='#' onclick=\"javascript:ventanaEditaPersona('" . $c_cod_per . "');\"><img src='../../../../fastmedical_front/imagen/icono/edit2.png' title='Editar Persona'/></a>";
            array_push($array[$i], $edid);
            array_push($array[$i], "$c_cod_per-$rId");

            $i++;
        }
        return $array;
    }

    public function spListaIpAcreditacion($mascaraSubRedSedeEmpresa) {
        $o_DPersona = new DPersonas();
        $rs = $o_DPersona->spListaIpAcreditacion($mascaraSubRedSedeEmpresa);
        return $rs;
    }

    public function actualizaPersonasdesdeEssalud($codigo, $parametros) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->updatePersonasdesdeEssalud($codigo, $parametros);
        return $array[0]["respuesta"];
    }

    public function grabaEssalud($codigo, $parametros) {
        $o_DPersona = new DPersonas();
        $fecha_actual = date("d/m/Y");
        $fecha_de_nacimiento = $parametros["txtFechaNacimiento"];


        $array_nacimiento = explode("/", $fecha_de_nacimiento);
        $array_actual = explode("/", $fecha_actual);
        $anos = $array_actual[2] - $array_nacimiento[2];
        $meses = $array_actual[1] - $array_nacimiento[1];
        if ($meses < 0) {
            --$anos;
            $meses = $meses + 12;
        }
        $edad = $anos;
        $fechain = str_replace("-", "/", $parametros["p8"]);
        ;
        $fechafin = str_replace("-", "/", $parametros["fechaVencimiento"]);
        $array = $o_DPersona->grabaEssalud($codigo, $parametros, $edad, $fechain, $fechafin);

        return $array[0]["resultado"];
    }

    public function grabaTablaEssalud($codigo, $parametros) {
        $o_DPersona = new DPersonas();
        $fechain = str_replace("-", "/", $parametros["p8"]);
        $fechafin = str_replace("-", "/", $parametros["fechaVencimiento"]);
        $fechaNacimiento = str_replace("-", "/", $parametros["txtFechaNacimiento"]);
        $parametros["p8"] = $fechain;
        $parametros["fechaVencimiento"] = $fechafin;
        $parametros["txtFechaNacimiento"] = $fechaNacimiento;
        $array = $o_DPersona->grabaTablaEssalud($codigo, $parametros);
        return $array[0]["respuesta"];
    }

    public function actualizarTablaEssalud($parametros) {
        $o_DPersona = new DPersonas();
        $arrayIni = explode("-", $parametros["p9"]);
        $arrayFin = explode("-", $parametros["p10"]);
        $fechain = $arrayIni[2] . $arrayIni[1] . $arrayIni[0];
        $fechafin = $arrayFin[2] . $arrayFin[1] . $arrayFin[0];
        $parametros["p9"] = $fechain;
        $parametros["p10"] = $fechafin;
        $array = $o_DPersona->actualizarTablaEssalud($parametros);
//echo " l_actualizarTablaEssalud";
        return $array;
    }

    public function detalleAcredita($c_cod_per) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->detalleAcredita($c_cod_per);
        foreach ($array as $i => $valor) {
            if ($array[$i][10] == '1') {
                $edid = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' title='Activada'/>";
            }
            if ($array[$i][10] == '2') {
                $edid = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' title='Desactivada'/>";
            }
            array_push($array[$i], $edid);
        }
        return $array;
    }

    public function cambiarAfiliacionAmbulatorio($datos) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->cambiarAfiliacionAmbulatorio($datos);
        return $array;
    }

    public function cambiarAfiliacionContribuyente($datos) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->cambiarAfiliacionContribuyente($datos);
        return $resultado;
    }

    public function cambiarAfiliacionEssalud($datos) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->cambiarAfiliacionEssalud($datos);
        return $array;
    }

    public function verDatosPaciente($datos) {
        $o_DPersona = new DPersonas();
        $array = $o_DPersona->getArrayDatosPersonaInformes($datos);
        return $array;
    }

    public function recuperarRuta($ruta) {
        require_once("../../cdatos/DRrhh.php");
        $o_DRrhh = new DRrhh();
        $resultado = $o_DRrhh->recuperarRuta($ruta);
        return $resultado;
    }

    public function actualizarFotoPersona($codPersona, $nomFoto) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->actualizarFotoPersona($codPersona, $nomFoto);
        return $resultado;
    }

    /* AFILICION CONTRIBUYENTE */

    public function obtenerDatosPersonaContribuyente($datos) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->getArrayDatosPersonaContribuyente($datos);
        return $resultado;
    }

    public function grabarParentescoPaciente($codPersonaTitular, $codPariente) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->grabarParentescoPaciente($codPersonaTitular, $codPariente);
        return $resultado;
    }

    public function listaParentescoPaciente($codPersonaTitular) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->listaParentescoPaciente($codPersonaTitular);
        if (is_array($resultado)) {
            foreach ($resultado as $i => $value) {
                $resultado[$i][5] = $resultado[$i][5] == "" ? "- Seleccionar -" : $resultado[$i][5];
                $resultado[$i][7] = "../../../../fastmedical_front/imagen/icono/eliminar.gif ^ Eliminar";
                $resultado[$i][6] = "../../../../fastmedical_front/imagen/icono/modificar.png ^ Grabar";
            }
        }
        return $resultado;
    }

    public function listaParentesco() {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->listaParentesco();
        return $resultado;
    }

    public function eliminarParentescoPaciente($idParentescoDePersona) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->eliminarParentescoPaciente($idParentescoDePersona);
        return $resultado;
    }

    public function asingarParientePaciente($datos) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->asingarParientePaciente($datos);
        return $resultado;
    }

    public function getMedicosdhtmlx($datos) {
        $o_DPersona = new DPersonas();
        $resultado = $o_DPersona->getArrayListMedicosGeneraldhtmlx($datos);
        return $resultado;
    }

}

?>
