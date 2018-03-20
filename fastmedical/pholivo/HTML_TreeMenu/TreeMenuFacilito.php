<?php
    require_once('../../../pholivo/HTML_TreeMenu/TreeMenu.php');;

    class HTML_TreeMenuFacilito{
     	private $menu;
     	private $nodos;

     	private $icon;
    	private $expandedIcon;

    	private $nivel;

    	private $arrayNiveles;
    	private $arrayRecursivo;
    	private $arrayCorrelativo;
    	private $arrayIconos;
    	private $soloFinales;
    	private $funcionJSEscucha;
    	private $funcionJSExpand;
    	private $pathImagen;

    	private $divContenedorArbol;
    	private $estiloItem;

     	public function __construct($_array, $_divContenedorArbol,$_pathImagen='',$_arrayIconos=array(), $_soloFinales='', $_funcionJSEscucha='',$_funcionJSExpand='',$_estiloItem=''){
	     	$this->arrayNiveles = $_array;
	    	$this->arrayRecursivo = $_array;
	    	$this->arrayCorrelativo = $_array;
                $this->divContenedorArbol = $_divContenedorArbol;
     		//$this->icono = $_icono;

     		$this->pathImagen = $_pathImagen;
     		$this->arrayIconos = $_arrayIconos;
    		$this->soloFinales = empty($_soloFinales)?false:$_soloFinales;
    		$this->funcionJSEscucha = empty($_funcionJSEscucha)?'alert':$_funcionJSEscucha;
    		$this->funcionJSExpand = $_funcionJSExpand;
                $this->estiloItem = $_estiloItem;

     		$this->menu = new HTML_TreeMenu();
     		//$nodoPrincipal = new HTML_TreeNode(array('text' => "First level", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('foo'); return false"));
     	}

     	public function setParametros($_iconos='',$_iconosExpandidos='',$estilo=''){
     		return;
     	}
     	public function setArrayNiveles($_arrayNiveles){
     		$this->arrayNiveles=$_arrayNiveles;
     	}
     	public function getArrayNiveles(){
     		return $this->arrayNiveles;
     	}

     	public function setArrayRecursivo($_arrayRecursivo){
     		$this->arrayRecursivo=$_arrayRecursivo;
     	}
     	public function getArrayRecursivo(){
     		return $this->arrayRecursivo;
     	}
     	public function setArrayCorrelativo($_arrayCorrelativo){
     		$this->arrayCorrelativo=$_arrayCorrelativo;
     	}
     	public function getArrayCorrelativo(){
     		return $this->arrayCorrelativo;
     	}

     	private function crearNodos($array){
     		list($nivel,$presedencia,$codigo,$deriva,$descripcion,$url,$array1) = $array;
     		$icon =$this->arrayIconos[$nivel]["icono"];$expandedIcon=$this->arrayIconos[$nivel]["iconoExpandido"];
     		$onclick = !$this->soloFinales?"$this->funcionJSEscucha(this,'$codigo');":!$deriva==1?"$this->funcionJSEscucha(this,'$codigo');":"";
     		$nodo = new HTML_TreeNode(array('text' => "$codigo: $descripcion", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon,
     						'expanded' =>false), array('onclick' => "$onclick return false"));//'onexpand'=>"alert('expand')"
     		if(is_array($array1)){
     			foreach($array1 as $i=>$item){
     				$nodo->addItem($this->crearNodos($item));
     			}
     		}
     		return $nodo;
     	}
     	private  function getNodos($arrayArbol=array()){
     		$arrayArbol = is_array($arrayArbol)?array():$arrayArbol;
     		$arrayArbol = empty($arrayArbol)?$this->arrayRecursivo:$arrayArbol;
     		$this->nodos = $this->crearNodos($arrayArbol);
     		return $this->nodos;
     	}
     	public function getTreeMenuJS(){
     		//../../../imagen/imagenTreeMenu
     		$pathImagen = $this->pathImagen;
     		$this->menu->addItem($this->getNodos());
     		$treeMenu = &new HTML_TreeMenu_DHTML($this->menu,$this->divContenedorArbol,array('images' => $pathImagen, 'defaultClass' => $this->estiloItem));//3er parametro displayar o no: true;
     		return $treeMenu->printMenu();
     	}
     	public function getTreeMenuJSAjax(){
     		$scriptJSArbolDeMierda= $this->getTreeMenuJS();

     		$scriptJSArbolDeMierda = str_replace("<script type=\"text/javascript\">","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("//<![CDATA[","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("// ]]>","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("</script>","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("\n","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("\t","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("\r","",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("\"","'",$scriptJSArbolDeMierda);
			$scriptJSArbolDeMierda = str_replace("\\","\\\\",$scriptJSArbolDeMierda);

			return $scriptJSArbolDeMierda;
     	}

     	public function generaArrayNivelesRecursivo($arrayNPCFD=array()){
                $this->arrayCorrelativo = empty($this->arrayCorrelativo)?$arrayNPCFD:$this->arrayCorrelativo;
                $array = $this->arrayCorrelativo;
                $nivelMaximo=1;
                $arrayPreTree = array();
                $arrayTree1 = array();
                foreach ($array as $arrayHijo){
                                $deriva ="";
                                $arrayTemp[0] = $arrayHijo[0];//nivel
                                $arrayTemp[1] = $arrayHijo[1];//presedencia
                                $arrayTemp[2] = $arrayHijo[2];//codigo
                                $arrayTemp[3] = $arrayHijo[3];//deriva //final o no final
                                $arrayTemp[4] = $arrayHijo[4];//descripcion
                                $arrayTemp[5] = "#"; //Url
                                $arrayTemp[6] = intval($arrayHijo[3])==1 || trim($arrayHijo[3])=="1"?array():"";
                                //print_r($arrayTemp);
                                $arrayTemporal = $arrayPreTree;
                                if($nivelMaximo < intval($arrayTemp[0])){
                                        $arrayPreTree = array();
                                        array_push($arrayPreTree,$arrayTemp);
                                        $nivelMaximo = intval($arrayTemp[0]);
                                        $arrayAgregar = empty($arrayTemporal)?$arrayPreTree:$arrayTemporal;
                                        array_push($arrayTree1,$arrayAgregar);
                                }else{
                                        array_push($arrayPreTree,$arrayTemp);
                                }
                }
                $this->nivel = $nivelMaximo;
                array_push($arrayTree1,$arrayPreTree);
                $this->arrayNiveles=$arrayTree1;
                $this->arrayRecursivo = $this->arrayNiveles;
                $this->generaArrayRecursivo();
                $this->arrayRecursivo = $this->arrayRecursivo[0][0];
                //nivel,presedencia,codigo,deriva(1-0),descripcion//url,arrayHijos
        }

        private function generaArrayRecursivo(){
                //$this->arrayRecursivo = empty($_arrayNiveles)?$this->getGeneraArrayNiveles($this->arrayCorrelativo):$_arrayNiveles;
                $niveles = count($this->arrayRecursivo);
                if($niveles>1){
                        $ArrayHijo =$this->arrayRecursivo[$niveles-1];
                        $ArrayPadre = $this->arrayRecursivo[$niveles-2];
                        foreach($ArrayPadre as $i=>$itemPadre){
                                $item[$i] = $this->getAgregarPadre($itemPadre,$ArrayHijo);
                        }
                        array_pop($this->arrayRecursivo);
                        $this->arrayRecursivo[$niveles-2] = $item;
                        $this->generaArrayRecursivo();
                }
        }


        private function getAgregarPadre($itemPadreN,$arrayHijosSupuestos){
                $codigoPadre = $itemPadreN[2];
                foreach($arrayHijosSupuestos as $hijo){
                        if($hijo[1]==$codigoPadre){
                                array_push($itemPadreN[6],$hijo);
                        }
                }
                return $itemPadreN;
        }
     }
 ?>