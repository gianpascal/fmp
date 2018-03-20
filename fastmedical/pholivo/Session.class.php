<?php
require_once("../../../hospitalizacion/cdatos/DLogin.php");

class Sesion {
	private $activa = true;
	private $clave;
	var     $id_sesion;
	private $encriptar = array('r' => true, 'w' => false);
	private $vars;
	private $tabla;
	private $tiempo = 1800; //5 horas, valor calculado en segundos tanto en BD como en archivo de configuracion PHP.INI
	private $SQL;
	private $usuario;
        private $id_usuario; //anadido
	private $id_sistema;
        private $ip; //anadido
	private $dsn=array();
	//private $dSesion;

	/*******************************************************
	*** INICIALIZA LA CLAVE DE SESION (constructor),
	********************************************************/
//	public function Sesion ($dsn = '') {
//        //public function  __construct($dsn = '') {
//		global $vars;
//		$this->dSesion = new DSesion();
//		$this->dsn = $dsn;
//		/*@session_unset();
//        //@session_destroy();
//		if ($this->activa && function_exists('ini_set'))
//        {
//            @ini_set('session.use_trans_sid', '0');
//            @ini_set('session.cache_limiter', 'nocache');
//            @ini_set('session.cache_expire', '180');
//            @ini_set('session.use_cookies', '1');
//            @ini_set('session.use_only_cookies', '1');
//            @ini_set('session.gc_maxlifetime', $this->tiempo);
//            @ini_set('session.save_handler', 'user');
//            @ini_set('session.gc_probability', '1');
//		}*/
//	}

	/*************************
	*** SETEO DE VARIABLES ***
	**************************/
	public function setLogin (&$usuario) {
		$this->usuario = &$usuario;
                
	}

        public function setIdUsuario (&$id_usuario) {
		$this->id_usuario = &$id_usuario;

	}

	public function setSistema ($id_sistema) {
		$this->id_sistema = $id_sistema;
	}
       
	public function setDsn (&$dsn){
		$this->dsn = $dsn;
	}

	/*****************************************************
	/*** function inicia (void)
	/*** Inicializa las funciones manejadoras de sesiones
	******************************************************/
	public function inicia () {
		if ($this->activa) {
                    //session_start();
                    $this->id_sesion =session_id();
                    $this->id_usuario =$_SESSION['id_usuario'];      
			session_set_save_handler
			(
				array(&$this, 'abrir'),
				array(&$this, 'cerrar'),
				array(&$this, 'leer'),
				array(&$this, 'escribir'),
				array(&$this, 'destruir'),
				array(&$this, 'caducar')
			);
		}
		register_shutdown_function('session_write_close');

	}

	/***************************************************************
	/*** function encriptar (boolean $r, boolean $w)
	/*** Permite indicar si se va a encriptar los datos de sesion
	/*** en las funciones de lectura y escritura
	****************************************************************/
	public function encriptar ($r, $w) {
		$this->encriptar = array('r' => $r, 'w' => $w);
	}

	/*************************************************************
	*** function abrir (string $save_path, string $session_name)
	*** Genera el session_id y a partir de este la clave que sera
	*** usada pera generar el keyED.
	*** return boolean
	**************************************************************/
	public function abrir ($save_path, $session_name) {
		//if(empty($this->id_sesion))
			$session_id = session_id();
                      
		if (empty($session_id)) {
			list($sec, $usec) = explode(' ', microtime());
			mt_srand((float) $sec + ((float) $usec * 100000));
			$session_id = md5(uniqid(mt_rand(), true));
			session_id($session_id);
		}
		$this->id_sesion = $session_id;
		$this->clave = substr($this->id_sesion, 1, -1);
		return true;
	}

	/************************************************
	*** function cerrar (void)
	*** Destruye (delete) la session actual en la BD
	*** donde el contenido sea vacio
	*** return boolean
	*************************************************/
	public function cerrar ($contenido) {
		$ok=$this->EJecutarSQL("CERRAR",$contenido);
		return true;
	}
	/*******************************************************************
	*** function ler (void)
	*** Recupera el contenido de la BD, si se usa encriptacion procede
	*** a desencriptar el contenido devolviendo la cadena resultante
	*** return string
	********************************************************************/
	public function leer ($contenido) {
		$this->EJecutarSQL("CADUCAR",$contenido);
		$contenido=$this->EJecutarSQL("LEER",$contenido);

		if ($contenido>"") {
			if ($this->encriptar['r'] && strlen($contenido)) {
				$contenido = $this->desencripta($contenido);
			}

			return $contenido;
		}
		else {
			return '';
		}
    }
	/*************************************************************************
	*** function escribir (string $id, string $sess_data)
	*** Registro de datos en la session BD, si encriptar esta activo encripta
	*** los datos y los inserta o actualiza en la BD.
	*** return boolean
	**************************************************************************/
	public function escribir ($sess_data) {
		global $clases;
		if (empty($sess_data)) {
			return true;
		}

		if ($this->encriptar['w']) {
			$contenido = $this->encripta($sess_data);
		} else {
			$contenido = $sess_data;
                        session_start();
                        $_SESSION['contenido'];

		}
                $usuario=$sess_data['login_user'];
		$contenidoant=$this->EJecutarSQL("LEER",$contenido,$usuario);

		if($contenidoant=="")
		{
                   // session_start();

                    if ($_SESSION['Nuevo']=='1'||$_SESSION['Nuevo']=='0')
                    {
                        $accion="ACTUALIZAR"; //cuando se actualiza
                       // header("Location: ../../cvista/inicio/salir.php");

                    }
                    else
                    {
			$accion="INSERTAR"; //cuando ingresa datos de usuario
                  }
		}else{
			$accion="CADUCAR";
		}

		$ok=$this->EJecutarSQL($accion,$contenido,$usuario);
                 switch($accion){
                     case 'INSERTAR':
                        $okas=$ok['0'];
                         switch($okas){
                                        case '1':
                                        session_start();
                                        $_SESSION['Nuevo']='1'; // cuando la insercion fue exitosa
                                            break;
                                        case '2':
                                        session_start();
                                        $_SESSION['Nuevo']='1';
                                       // header("Location: ../../cvista/inicio/salir.php");
                                        //EL USUARIO ESTÁ SIENDO UTILIZADO, HAY QUE ELIMINARLO
                                        case '3':
                                        //header("Location: ../../index.php?razon=I3");
                                         //LA SESIÓN YA ESTÁ ACTIVA, IDENTIFICADOR DE SESIÓN DUPLICADO
                                        break;
                                }
                                break;

                      case 'CADUCAR':
                            $okas=$ok['0'];
			switch($okas){
				case '1':
                                        //session_destroy();
                                    session_start();
                                    $_SESSION['Nuevo']='0';
                                         header("Location: ../../cvista/inicio/salir.php");
                                //LA SESIÓN HA CADUCADO
				break;
                                case '2':
                                    $ok=$this->EJecutarSQL("ACTUALIZAR",$contenido,$usuario);
                                    $okas=$ok['0'];
                                    if ($okas=='2'){
                                        session_start();
                                 $_SESSION['Nuevo']='0';
                                 $_SESSION['Destroy']='1';
                                 header("Location: ../../cvista/inicio/salir.php");                                 }

				break;
			}
                          break;

                      case 'ACTUALIZAR':
                            $okas=$ok['0'];
			switch($okas){
				case '1':
                                        // header("Location: ../../cvista/inicio/salir.php");
                                $_SESSION['Nuevo']='1';
				break;
                                case '2':
                                  session_start();
                                 $_SESSION['Nuevo']='0';
                                 $_SESSION['Destroy']='1';
                                 echo "<script type='text/javascript'>
                                        window.location = '../../cvista/inicio/salir.php'
                                    </script>";
                                 //header("Location: ../../cvista/inicio/salir.php");
				break;
			}
                          break;
                 }
		return true;
	}

	/******************************************
	**** function destruir (void)
	*** Elimina el fichero de sesi�n actual
	*** return boolean
	*******************************************/
	public function destruir () {
		$ok=$this->EJecutarSQL("DESTRUIR",$contenido);
		return true;
	}

	/************************************************
	*** function caducar (void)
	*** Elimina todas las sesiones con un tiempo de acceso
	*** mayor al definido en la varibale $this->tiempo
	*** o su contenido sea vacio}
	*** return boolean
	**************************************************/
	public function caducar () {
		$ok=$this->EJecutarSQL("CADUCAR",$contenido);
		return true;
	}


	/************************************************************
	*** function EJecutarSQL (string $accion, string $contenido)
	*** Ejecuta las acciones sobre la BD
	*** return string
	************************************************************/
	public function EJecutarSQL($accion,$contenido)
	{	//if($this->id_sesion=='')
		//	$session_id = session_id();
		//else
                //if($accion=='INSERTAR') $contenido = '';

                $o_DLogin = new DLogin();
                $session_id = $this->id_sesion;
                // setIp();
                $ip = $this->getIp();
                $_SESSION["ip_usuario"]=$ip;
                $tcaduca=60;
                
                $row = $o_DLogin->getAccionSesion($accion,$session_id,$this->tiempo,$this->id_sistema,$contenido,$this->id_usuario,$tcaduca,$ip);
                //session_start();
               
		//$row = $this->dSesion->getAccionSesion($accion,$session_id,$this->tiempo,$this->id_sistema,$contenido,$this->id_usuario,$tcaduca,$ip);
                $row[0]='';
                return $row[0];
	}

	/**********************************************************
	*** function encripta (string $cad)
	*** Encripta una cadena de texto $cad a partir de la clave
	*** y devuelve el resultado
	*** return string
	***********************************************************/
	public function encripta ($cad) {
//		srand((double)microtime()*1000000);
//		$aleatorio = md5(rand(0,32000));
//		$lonx_clave = strlen($this->clave);
//                if(empty ($cad)){
//                    $cad='';
//                }
//
//                //print_r($cad);
//
//		$lonx_cad = strlen($cad);
//		$cnt = 0;
//		$resultado = '';
//
//		for ($i=0; $i < $lonx_cad; $i++){
//			$cnt = ($cnt == $lonx_clave)?0:$cnt;
//			$resultado .= substr($aleatorio, $cnt, 1).(substr($cad, $i, 1) ^ substr($aleatorio, $cnt, 1));
//			$cnt++;
//		}

		return $cad;
	}

	/*****************************************************************
	*** function desencripta (string $cad)
	*** Desencripta una cadena de texto $cad y devuelve el resultado
	*** return string
	******************************************************************/
	public function desencripta ($cad) {
//		$cad = $this->keyED(base64_decode($cad));
//		$lonx_cad = strlen($cad);
//		$resultado = '';
//
//		for ($i=0; $i < $lonx_cad; $i++){
//			$md5 = substr($cad ,$i, 1);
//			$i++;
//			$resultado .= (substr($cad, $i, 1) ^ $md5);
//		}

		return $cad;
	}

	/*********************************************
	*** function keyED (string $cad)
	*** Realiza operacion XOR con la cadena recibida y la clave generada,
	*** se utiliza para encriptar y desencriptar la cadena
	*** return string
	**********************************************/
	public function keyED ($cad) {
		$lonx_clave = strlen($this->clave);
		$lonx_cad = strlen($cad);
		$cnt = 0;
		$resultado = '';

		for ($i=0; $i < $lonx_cad; $i++) {
			$cnt = ($cnt == $lonx_clave)?0:$cnt;
			$resultado .= substr($cad, $i, 1) ^ substr($this->clave, $cnt, 1);
			$cnt++;
		}

		return $resultado;
	}

	/********************************
	*** function getIp (string $cad)
	*** Obtenemos el Ip del Cliente
	*** return string
	*********************************/
	public function getIp () {
			
      return $_SERVER['REMOTE_ADDR'];

	}
}
?>