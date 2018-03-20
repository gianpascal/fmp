<?php
class Calendario {
    private $anio;
    private $mes;
    private $dia;
    private $estiloCabeceraDia;
    private $estiloCasilla1;
    private $estiloCasilla2;
    private $casillerosTimeStamp;
    private $tsFechaActual;
    private $tsFechaNueva;
    private $tsFechaObtenida;
    private $idAdicionFecha;
    private $funcionjsDia;
    private $funcionjsCalendario;
    public  $nombreCalendario;
    private $estiloAccion;
    private $fechaActual;
    private $diapintado;// 1 pinta el dia unico, 0 no pinta el dia y es multiseleccion
    private $dibujarCheck;// 1: Dibuja check, 0: No dibuja check
    private $funcionjsCheckDia;// javascript que escucha la selección de un checkbox dia

    public function __construct($_nombreCalendario='',$_estiloAccion='', $_estiloCabeceraDia='',$_estiloCasilla1='',$_estiloCasilla2='',$_fechaActual='',$_idAdicionFecha='',$_funcionjsDia='',$_funcionjsCalendario='',$diapintado='',$_dibujarCheck=0,$_funcionjsCheckDia='') {
        $this->funcionjsCheckDia = $_funcionjsCheckDia;
        $this->dibujarCheck = $_dibujarCheck;
        $this->diapintado = $diapintado;
        $this->tsFechaActual = empty($_fechaActual)?strtotime(date("Y-m-d")):$_fechaActual;
        $this->estiloCabeceraDia = $_estiloCabeceraDia;
        $this->estiloCasilla1 = $_estiloCasilla1;
        $this->estiloCasilla2 = $_estiloCasilla2;
        $this->idAdicionFecha = $_idAdicionFecha;
        $this->nombreCalendario= $_nombreCalendario;
        $this->funcionjsDia = $_funcionjsDia;
        $this->funcionjsCalendario = $_funcionjsCalendario;
        $this->estiloAccion = $_estiloAccion;
        $this->tsFechaNueva = self::getTsFechaNueva($_idAdicionFecha,$this->tsFechaActual);
        $tsFecha = $this->tsFechaNueva;
        $this->anio = strftime("%Y",$tsFecha);
        $this->mes = strftime("%d",$tsFecha);
        $numDiaSeleccionadoNuevo = $this->getNuevoDiaSeleccionado($tsFecha, strftime("%d",$this->fechaActual));
        $this->dia = $numDiaSeleccionadoNuevo;
        $this->tsFechaObtenida = mktime(0,0,0,$this->mes,$numDiaSeleccionadoNuevo,$this->anio);
    }
    public function getTsFechaObtenida() {
        return $this->tsFechaObtenida;
    }
    public static function getNumDiasMeses() {
        return array("01"=>"31", "02"=>array("01"=>"28","02"=>"29"), "03"=>"31", "04"=>"30", "05"=>"31",
                "06"=>"30", "07"=>"31", "08"=>"31", "09"=>"30", "10"=>"31", "11"=>"30",  "12"=>"31");
    }

    public static function getArrayDiasEn() {
        return array("1"=>"Mon", "2"=>"Tue", "3"=>"Wed", "4"=>"Thu", "5"=>"Fri", "6"=>"Sat", "7"=>"Sun");
    }

    public static function getArrayDiasEs() {
        return array("1"=>"Lun", "2"=>"Mar", "3"=>"Mie", "4"=>"Jue", "5"=>"Vie", "6"=>"Sab", "7"=>"Dom");
    }

    public static function getArrayNombreMeses() {
        return array("1"=>"Enero", "2"=>"Febrero", "3"=>"Marzo", "4"=>"Abril", "5"=>"Mayo", "6"=>"Junio", "7"=>"Julio",
                "8"=>"Agosto","9"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
    }

    public static function getNumDiasMes($tsFecha) {
        $numMes = strftime("%m",$tsFecha);
        $anio = strftime("%Y",$tsFecha);
        $numDiasMes_ = self::getNumDiasMeses();
        if($numMes=="02") {
            $numDias =self::isBisiesto($anio)?'29':'28';
        }else {
            $numDias = $numDiasMes_[$numMes];
        }
        return $numDias;
    }

    public static function isBisiesto($anio='') {
        $anio = empty($anio)?date("Y"):$anio;
        return checkdate(2,29,$anio);
    }

    public static function getNuevoDiaSeleccionado($tsFechaNueva,$numDiaSeleccionadoAnterior) {
        $nuevoDia = $numDiaSeleccionadoAnterior;
        $anio = date("Y",$tsFechaNueva);
        $numMes = date("m",$tsFechaNueva);
        if(in_array($numMes,array("4","6","9","11"))) {
            $nuevoDia=$nuevoDia=="31"?"30":$nuevoDia;
        }else if(in_array($numMes,array("2"))) {
            if ($nuevoDia > 28) {
                $nuevoDia = checkdate(02,29,$anio)?"29":"28";
            }
        }
        return $nuevoDia;
    }

    public function getDia() {
        return $this->dia;
    }
    public function getMes() {
        return $this->mes;
    }
    public function getAnio() {
        return $this->anio;
    }
    public function getArrayTimeStampCalendario($tsFecha='') {
        $casillerosTimeStamp=array_fill(1,42,"");
        $tsFecha = empty($tsFecha)?$this->tsFechaActual:$tsFecha;
        //$tsFecha = empty($tsFecha)?strtotime(date("Y-m-d")):$tsFecha;
        $numDiaSeleccionado = date("d",$tsFecha);
        //if(empty($tsFecha)){
        $numDiaSeleccionado = date("d",$tsFecha);
        $_idAdicion = $this->idAdicionFecha;
        $this->tsFechaNueva = self::getTsFechaNueva($_idAdicion,$tsFecha);
        $tsFecha = $this->tsFechaNueva;
        //}
        $this->fechaNueva = $tsFecha;
        $numDiaSeleccionadoNuevo = $this->getNuevoDiaSeleccionado($tsFecha,$numDiaSeleccionado);
        $this->dia = $numDiaSeleccionadoNuevo;
        $this->mes = date("m",$tsFecha);
        $this->anio = date("Y",$tsFecha);
        $this->tsFechaObtenida = mktime(0,0,0,$this->mes,$this->dia,$this->anio);

        $primerNombreDiaFecha = date("D",$tsFecha);
        $primerNumeroCasilleroDiaFecha = array_keys(Calendario::getArrayDiasEn(),$primerNombreDiaFecha);
        $tsFechaCalendario = $tsFecha;
        $inicio = $primerNumeroCasilleroDiaFecha[0];
        $numDias = Calendario::getNumDiasMes($tsFecha);
        $fin = $numDias + $inicio;
        foreach($casillerosTimeStamp as $i=>$tsFechaMes) {
            if($i>= $inicio	&& $i < $fin) {
                $casillerosTimeStamp[$i] = $tsFechaCalendario;
                $tsFechaCalendario = strtotime("+1 day",$tsFechaCalendario);
            }
        }
        return $casillerosTimeStamp;
    }

    public function getHTMLCalendario($casillerosTimeStamp='',$_estiloCasilla1='',$_funcionjsDia='') {
        $fila ="";
        $this->estiloCasilla1  = empty($_estiloCasilla1)?$this->estiloCasilla1:$_estiloCasilla1;
        //$diaSeleccionado = $this->getNuevoDiaSeleccionado()
        foreach ($casillerosTimeStamp as $i=>$tsFecha) {
            $numDia = empty($tsFecha)?'':date("d",$tsFecha);
            //$classEstilo = empty($tsFecha)?"":"";
            //$estiloBotonFecha = "";
            $_funcionjsDia = empty($this->funcionjsDia)?$_funcionjsDia:$this->funcionjsDia;
            if(!empty($_funcionjsDia)) {
                $enlace = !empty($numDia)?"<a href=\"javascript:$_funcionjsDia('$this->nombreCalendario"."-".$numDia."','$this->nombreCalendario')\">".$numDia."</a>":$numDia;
            }else {
                $enlace = !empty($numDia)?"<a>".$numDia."</a>":$numDia;
            }

            $id = empty($numDia)?"":"id='$this->nombreCalendario-$numDia'";
            if($this->diapintado=='0')
                $_estiloCasilla = $this->estiloCasilla1;
            if($this->diapintado=='1')
                $_estiloCasilla = $this->dia == $numDia?$this->estiloCasilla2:$this->estiloCasilla1;
            $class= "class='$_estiloCasilla'";
            $td = "<td $class $id>".$enlace."</td>";
            if($i%7==1) {
                $fila.= "<tr>".$td;
            }else if($i%7==0) {
                $fila.=$td."</tr>\n";//////
            }else {
                $fila.= $td;
            }
        }
        return $fila;
    }

    public function getTsFechaNueva($numAccion='',$tsFechaActual='') {
        $tsFechaActual = empty($tsFechaActual)?$this->tsFechaActual:$tsFechaActual;
        $arrayAccion = array("1"=>"-1 year","2"=>"-1 month","3"=>"+1 month","4"=>"+1 year","5"=>"0 month");
        $accion = $arrayAccion[$numAccion];
        //$tsFechaActual = empty($stringFecha)?strtotime(date("d-m-Y")):strtotime($stringFecha);
        //$numDiaSeleccionado = date("d",$tsFechaActual);
        //$tsFechaNueva = strtotime("+1 Month",$tsFechaActual);
        //echo "Fecha Actual: ".strftime("%d/%m/%Y",$tsFechaActual)."<br>\n";
        //echo "Dia Seleccionado: ".$numDiaSeleccionado."<br>\n";
        $tsFechaNueva = strtotime("01".date("-m-Y",$tsFechaActual));
        $tsFechaNueva = strtotime($accion,$tsFechaNueva);
        return $tsFechaNueva;
    }

    function toDiaEspanol($nomDia) {
        $dia_ingles = array("Monday", "Tuesday", "Wednesday","Thursday","Friday","Saturday","Sunday");
        $dia_espanol   = array("Lunes", "Martes", "Miercoles","Jueves","Viernes","Sabado","Domingo");
        return str_replace($dia_ingles, $dia_espanol, $nomDia);
    }

    function toMesEspanol($nomMes) {
        $mes_ingles = array("January", "February", "March", "April","May","June","July","August","September", "October", "November","December");
        $mes_espanol   = array("Enero", "Febrero", "Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return str_replace($mes_ingles, $mes_espanol, $nomMes);
    }

    function getHTMLCabeceraDia($_diasAbrev = array(),$_class='') {
        $_diasAbrev = empty($_diasAbrev)?self::getArrayDiasEs():$_diasAbrev;
        $_class = empty($_class)?" class='".$this->estiloCabeceraDia."' ":"class='".$_class."' ";
        $cabeceraDias = "<tr>";
        foreach ($_diasAbrev as $i=>$abrevia) {
            $cabeceraDias.= "<td align=\"center\" style=\"font-family:Arial,serif;font-size:10pt\"nowrap='nowrap' $_class>$abrevia</td>\n";
        }

        $cabeceraDias.="</tr>\n";
        return $cabeceraDias;
    }

    function getHTMLCheckDiaSeleccionado($_diasAbrev = array()) {
        $_diasAbrev = empty($_diasAbrev)?self::getArrayDiasEs():$_diasAbrev;
        $checkDia = "<tr>";
        $j=1;
        foreach ($_diasAbrev as $i=>$abrevia) {
            $checkDia.= "<td align=\"center\"><input type=\"checkbox\" id=\"chkFechasPorDia$j\" name=\"chkFechasPorDia\" value=\"$abrevia\" onclick=\"$this->funcionjsCheckDia(this,$j,'$this->nombreCalendario')\"></td>\n";
            $j++;
        }
        $checkDia.="</tr>\n";
        return $checkDia;
    }

    function getHTMLFechasPorDia($casillerosTimeStamp='',$_estiloCasilla1='',$_funcionjsDia='') {
        $fila ="";
        //$this->estiloCasilla1  = empty($_estiloCasilla1)?$this->estiloCasilla1:$_estiloCasilla1;
        //$diaSeleccionado = $this->getNuevoDiaSeleccionado()
        $fechasLunes="";
        $fechasMartes="";
        $fechasMiercoles="";
        $fechasJueves="";
        $fechasViernes="";
        $fechasSabados="";
        $fechasDomingos="";

        foreach ($casillerosTimeStamp as $i=>$tsFecha) {
            $numDia = empty($tsFecha)?'':date("d",$tsFecha);

            if(!empty($numDia)) {
                if($i%7==1) {//Todas las posiciones de la matriz que son Lunes
                    if($fechasLunes=="") {
                        $fechasLunes=$numDia;
                    }
                    else {
                        $fechasLunes.="-".$numDia;
                    }
                }
                else {
                    if($i%7==2) {//Todas las posiciones de la matriz que son Martes
                        if($fechasMartes=="") {
                            $fechasMartes=$numDia;
                        }
                        else {
                            $fechasMartes.="-".$numDia;
                        }
                    }
                    else {
                        if($i%7==3) {//Todas las posiciones de la matriz que son Miercoles
                            if($fechasMiercoles=="") {
                                $fechasMiercoles=$numDia;
                            }
                            else {
                                $fechasMiercoles.="-".$numDia;
                            }
                        }
                        else {
                            if($i%7==4) {//Todas las posiciones de la matriz que son Jueves
                                if($fechasJueves=="") {
                                    $fechasJueves=$numDia;
                                }
                                else {
                                    $fechasJueves.="-".$numDia;
                                }
                            }
                            else {
                                if($i%7==5) {//Todas las posiciones de la matriz que son Viernes
                                    if($fechasViernes=="") {
                                        $fechasViernes=$numDia;
                                    }
                                    else {
                                        $fechasViernes.="-".$numDia;
                                    }
                                }
                                else {
                                    if($i%7==6) {//Todas las posiciones de la matriz que son Sabado
                                        if($fechasSabados=="") {
                                            $fechasSabados=$numDia;
                                        }
                                        else {
                                            $fechasSabados.="-".$numDia;
                                        }
                                    }
                                    else {
                                        if($i%7==0) {//Todas las posiciones de la matriz que son Domingo
                                            if($fechasDomingos=="") {
                                                $fechasDomingos=$numDia;
                                            }
                                            else {
                                                $fechasDomingos.="-".$numDia;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $fila.= "<input type=\"hidden\" id=\"dia1\" value=\"$fechasLunes\">";
        $fila.= "<input type=\"hidden\" id=\"dia2\" value=\"$fechasMartes\">";
        $fila.= "<input type=\"hidden\" id=\"dia3\" value=\"$fechasMiercoles\">";
        $fila.= "<input type=\"hidden\" id=\"dia4\" value=\"$fechasJueves\">";
        $fila.= "<input type=\"hidden\" id=\"dia5\" value=\"$fechasViernes\">";
        $fila.= "<input type=\"hidden\" id=\"dia6\" value=\"$fechasSabados\">";
        $fila.= "<input type=\"hidden\" id=\"dia7\" value=\"$fechasDomingos\">";
        return $fila;
    }

    public function getHTMLBotonAccion() {
        $value = array("1"=>"<<","2"=>"<","3"=>">","4"=>">>",);
        $botones = "<tr><td align=\"center\" colspan=\"7\">\n<div style=\"width:100%;text-align:center;font-family:Arial,serif;font-size:12pt\">";
        $cal = $this->nombreCalendario;
        $arrayMeses = self::getArrayNombreMeses();
        $titutloCalendario = $arrayMeses[intval($this->mes)]."  ".date("Y",$this->tsFechaNueva);
        for ($i=1;$i<=4;$i++) {
            $botones.="<input type=\"button\" class=\"$this->estiloAccion\" value=\"$value[$i]\" onClick=\"$this->funcionjsCalendario('$i','$cal')\">\t";
            if($i==2) $botones.="&nbsp;&nbsp;".$titutloCalendario."&nbsp;&nbsp;";
        }
        return $botones."</div></td></tr>";
    }

    public function getHTMLFechaActual() {
        $arrayFecha = array("1"=>$this->getDia(),"2"=>$this->getMes(),"3"=>$this->getAnio());
        //var_dump($arrayFecha);
        $input ="";
        for ($i=1;$i<=3;$i++) {
            $item = $arrayFecha[$i];
            $input.="<input  type=\"hidden\"  value=\"$item\">";
        }
        return $input;
    }

    function getHTMLFullCalendario() {
        //$stringFecha="2008-01-30";
        //$tsFechaActual = empty($stringFecha)?strtotime(date("Y-m-d")):strtotime($stringFecha);
        //$numDiaSeleccionado = date("d",$tsFechaActual);
        /// calcularla fecha del nuevo mes segun la accion seleccionada, el nuevo mes estara siempre en el dia 01 de ese mes.
        //$o_Cal01 = new Calendario('cal01','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,'3','seleccionarFecha','');
        //$tsFechaNueva= Calendario::getTsFechaNueva('3',$tsFechaActual);

        $numDiaSeleccionadoNuevo = $this->dia;
        //Arma Fechas TimeStamp de un mes en una array para un Calendario con 42 casillas:
        $casillerosTimeStamp=$this->getArrayTimeStampCalendario();
        $anio = date("Y",$this->tsFechaNueva);
        $calendario="";
        $calendario.= "<div id=$this->nombreCalendario name=$this->nombreCalendario>";
        $calendario.= "<div style=\"width:100%;height:80%\">";
        $calendario.= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"vertical-align:bottom;width:100%;height:100%;\">";
        $calendario.= $this->getHTMLBotonAccion();
        $calendario.= $this->getHTMLCabeceraDia();
        if($this->dibujarCheck==1){//Dibuja los check de los dias de la semana
            $calendario.= $this->getHTMLCheckDiaSeleccionado();
        }
        $calendario.= $this->getHTMLCalendario($casillerosTimeStamp,'','');
        $calendario.= "</table>";
        $calendario.= "</div>";
        if($this->dibujarCheck==1){//Dibuja los hidden donde se guardaran las fechas por dia
            $calendario.= $this->getHTMLFechasPorDia($casillerosTimeStamp,'','');
        }
        $calendario.= $this->getHTMLFechaActual();
        $calendario.= "</div>";
        return $calendario;
    }
    /// funciones de calendario largo
//********************************************************************************************************************
    //*************************************************************

    function getHTMLFullCalendarioLargo() {
        //$stringFecha="2008-01-30";
        //$tsFechaActual = empty($stringFecha)?strtotime(date("Y-m-d")):strtotime($stringFecha);
        //$numDiaSeleccionado = date("d",$tsFechaActual);
        /// calcularla fecha del nuevo mes segun la accion seleccionada, el nuevo mes estara siempre en el dia 01 de ese mes.
        //$o_Cal01 = new Calendario('cal01','botonAccionCalendario','cabeceraCalendario','btnCalendario','estiloCasillaSeleccionada',$tsFechaActual,'3','seleccionarFecha','');
        //$tsFechaNueva= Calendario::getTsFechaNueva('3',$tsFechaActual);

        $numDiaSeleccionadoNuevo = $this->dia;
        //Arma Fechas TimeStamp de un mes en una array para un Calendario con 42 casillas:
        $casillerosTimeStamp=$this->getArrayTimeStampCalendario();
        $anio = date("Y",$this->tsFechaNueva);
        $calendario="";
        $calendario.= "<div id=$this->nombreCalendario name=$this->nombreCalendario>";
        $calendario.= "<div style=\"width:100%;height:100%\">";
        $calendario.= "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"vertical-align:bottom;width:100%;height:100%;\">";
        $calendario.= $this->getHTMLBotonAccion();
        $calendario.= $this->getHTMLCabeceralargo();

//                        if($this->dibujarCheck==1){//Dibuja los check de los dias de la semana
//                            $calendario.= $this->getHTMLCheckDiaSeleccionado();
//                        }

   $calendario.= $this->getHTMLCalendarioLargo($casillerosTimeStamp,'','');
//$calendario.= $this->getHTMLCalendario($casillerosTimeStamp,'','');
        $calendario.= "</table>";
        $calendario.= "</div>";
//                        if($this->dibujarCheck==1){//Dibuja los hidden donde se guardaran las fechas por dia
//                            $calendario.= $this->getHTMLFechasPorDia($casillerosTimeStamp,'','');
//                        }
        $calendario.= $this->getHTMLFechaActualLargo();
        $calendario.= "</div>";
        return $calendario;
    }
    function getHTMLCabeceralargo($_diasAbrev = array(),$_class='') {
        $_diasAbrev = empty($_diasAbrev)?self::getArrayDiasEsLargo():$_diasAbrev;
        $_class = empty($_class)?" class='".$this->estiloCabeceraDia."' ":"class='".$_class."' ";
        $cabeceraDias = "<tr>";
        foreach ($_diasAbrev as $i=>$abrevia) {
            $cabeceraDias.= "<td align=\"center\" style=\"font-family:Arial,serif;font-size:10pt\"nowrap='nowrap' $_class>$abrevia</td>\n";
        }

        $cabeceraDias.="</tr>\n";
        return $cabeceraDias;
    }

    public static function getArrayDiasEsLargo() {
        $fechaActuaTimeStamp = date("m");
        if($fechaActuaTimeStamp=='01'||$fechaActuaTimeStamp=='03'||$fechaActuaTimeStamp=='05'||$fechaActuaTimeStamp=='07'
                ||$fechaActuaTimeStamp=='08'||$fechaActuaTimeStamp=='10'||$fechaActuaTimeStamp=='12') {
            return array("1"=>"Lun", "2"=>"Mar", "3"=>"Mie", "4"=>"Jue", "5"=>"Vie", "6"=>"Sab", "7"=>"Dom"
                        ,"8"=>"Lun", "9"=>"Mar", "10"=>"Mie", "11"=>"Jue", "12"=>"Vie", "13"=>"Sab", "14"=>"Dom"
                        ,"15"=>"Lun", "16"=>"Mar", "17"=>"Mie", "18"=>"Jue", "19"=>"Vie", "20"=>"Sab", "21"=>"Dom"
                        ,"22"=>"Lun", "23"=>"Mar", "24"=>"Mie", "25"=>"Jue", "26"=>"Vie", "27"=>"Sab", "28"=>"Dom"
                        ,"29"=>"Lun", "30"=>"Mar", "31"=>"Mie");
        }else {
               if($fechaActuaTimeStamp=='04'||$fechaActuaTimeStamp=='06'||$fechaActuaTimeStamp=='09'||$fechaActuaTimeStamp=='11') {
            return array("1"=>"Lun", "2"=>"Mar", "3"=>"Mie", "4"=>"Jue", "5"=>"Vie", "6"=>"Sab", "7"=>"Dom"
                        ,"8"=>"Lun", "9"=>"Mar", "10"=>"Mie", "11"=>"Jue", "12"=>"Vie", "13"=>"Sab", "14"=>"Dom"
                        ,"15"=>"Lun", "16"=>"Mar", "17"=>"Mie", "18"=>"Jue", "19"=>"Vie", "20"=>"Sab", "21"=>"Dom"
                        ,"22"=>"Lun", "23"=>"Mar", "24"=>"Mie", "25"=>"Jue", "26"=>"Vie", "27"=>"Sab", "28"=>"Dom"
                        ,"29"=>"Lun", "30"=>"Mar");
        }
        }
       if($fechaActuaTimeStamp=='02') {
          // $fechaActuaTimeStamp = date("Y-m-d");
            return array("1"=>"Lun", "2"=>"Mar", "3"=>"Mie", "4"=>"Jue", "5"=>"Vie", "6"=>"Sab", "7"=>"Dom"
                        ,"8"=>"Lun", "9"=>"Mar", "10"=>"Mie", "11"=>"Jue", "12"=>"Vie", "13"=>"Sab", "14"=>"Dom"
                        ,"15"=>"Lun", "16"=>"Mar", "17"=>"Mie", "18"=>"Jue", "19"=>"Vie", "20"=>"Sab", "21"=>"Dom"
                        ,"22"=>"Lun", "23"=>"Mar", "24"=>"Mie", "25"=>"Jue", "26"=>"Vie", "27"=>"Sab", "28"=>"Dom"
                        ,"29"=>"Lun");
        }
    }

    public function getHTMLCalendarioLargo($casillerosTimeStamp='',$_estiloCasilla1='',$_funcionjsDia='') {
        $fila ="";
        $this->estiloCasilla1  = empty($_estiloCasilla1)?$this->estiloCasilla1:$_estiloCasilla1;
        //$diaSeleccionado = $this->getNuevoDiaSeleccionado()
        foreach ($casillerosTimeStamp as $i=>$tsFecha) {
            $numDia = empty($tsFecha)?'':date("d",$tsFecha);
            //$classEstilo = empty($tsFecha)?"":"";
            //$estiloBotonFecha = "";
            $_funcionjsDia = empty($this->funcionjsDia)?$_funcionjsDia:$this->funcionjsDia;
//            if(!empty($_funcionjsDia)) {
//                $enlace = !empty($numDia)?"<a href=\"javascript:$_funcionjsDia('$this->nombreCalendario"."-".$numDia."','$this->nombreCalendario')\">".$numDia."</a>":$numDia;
//            }else {
                $enlace = !empty($numDia)?"<a>".$numDia."</a>":$numDia;
//            }

            $id = empty($numDia)?"":"id='$this->nombreCalendario-$numDia'";
//            if($this->diapintado=='0')
//                
//            if($this->diapintado=='1')
            $_estiloCasilla = $this->estiloCasilla1;
            $class= "class='$_estiloCasilla'";
            $td = "<td $class $id>".$enlace."</td>";
            
//            if($i%7==1) {
//                $fila.= "<tr>".$td;
//            }else if($i%7==0) {
//                $fila.=$td."</tr>";//////\n
//            }else {
                $fila.= $td;
//            }
        }
        return $fila;
    }
    public function getHTMLFechaActualLargo() {
        $arrayFecha = array("1"=>$this->getDia(),"2"=>$this->getMes(),"3"=>$this->getAnio());
        //var_dump($arrayFecha);
        $input ="";
        for ($i=1;$i<=3;$i++) {
            $item = $arrayFecha[$i];
            $input.="<input  type=\"hidden\"  value=\"$item\">";
        }
        return $input;
    }

}