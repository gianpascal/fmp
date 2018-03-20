<?php
require_once("../../clogica/LRrhh.php");

class ActionManual {
    public function  mostrarManual($cadena,$ruta_archivo){
        $oLManual = new LRrhh();
        $oLManual -> crearArbolManuales($cadena,$ruta_archivo);
        require_once("../../cvista/manuales/inicioManuales.php");
    }

    public function  generaManual($datos){
        $oLManual = new LRrhh();
        $contenido=$oLManual -> generaManual($datos);

        $idManual=$contenido[0][0];
        $idDependencia=$contenido[0][1];
        $titulo=$contenido[0][2];
        $cuerpo=$contenido[0][3];
        $version=$contenido[0][4];
        $q=$oLManual->traerDatosPadre($idDependencia);
        $desc_padre=$q['0']['1'];
        include_once '../../cvista/manuales/generarManual.php';
//        require_once("../../cvista/manuales/generarManual.php");
    }

    public function formRegistroManual($codigo){
        $cboFormulario=$this->comboCodigoFormulario();
        $p = $this-> verItemManual($codigo);//Datos principales
        $idManual=$p['0']['0'];
        $idDependencia=$p['0']['1'];
        $jerarquia= $p['0']['2'];
        $titulo = $p['0']['3'];
        $contenido = $p['0']['4'];
        $estado = $p['0']['5'];
        $orden = $p['0']['6'];
        $version= $p['0']['7'];
        $formulario= $p['0']['8'];
        $nivel= $p['0']['9'];
        $o_LRrhh = new LRrhh();
        $q=$o_LRrhh->traerDatosPadre($idDependencia);
        $desc_padre=$q['0']['1'];
        $btnhabil=0;
        $btndeshabil=1;
        $btnPadre='hidden';
        require_once("../../cvista/manuales/nuevoManual.php");
    }

    public function comboCodigoFormulario(){
            $o_LRrhh = new LRrhh();
            $arrayCombo = $o_LRrhh->seleccionarFormulario();
//            $o_Combo = new Combo($arrayCombo);
//            $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
            return $arrayCombo;
    }

      public function registrarManual($datos){
        $oLRrhh = new LRrhh();
        $resultado=$oLRrhh -> registrarManual($datos);
        return $resultado;
      }

      public function formManual($cod){
        $p = $this-> verItemManual($cod);//Datos principales
        $idManual=$p['0']['0'];
        $idDependencia=$p['0']['1'];
        $jerarquia= $p['0']['2'];
        $titulo = $p['0']['3'];
        $contenido = $p['0']['4'];
        $estado = $p['0']['5'];
        $orden = $p['0']['6'];
        $version= $p['0']['7'];
        $formulario= $p['0']['8'];
        $nivel= $p['0']['9'];
        $respuesta=$idDependencia."|".$jerarquia."|".$titulo."|".$contenido."|".$estado."|".$orden."|".$version."|".$formulario."|".$nivel."|";
        return $respuesta;
      }
      public function verItemManual($cod){
        $oLRrhh = new LRrhh();
        $resultado=$oLRrhh -> verItemManual($cod);
        return $resultado;
      }
//      public function traerPadre($cod){
//        $oLRrhh = new LRrhh();
//        $resultado=$oLRrhh -> verItemManual($cod);
//        return $resultado;
//      }
      public function eliminaManual($cod){
        $oLRrhh = new LRrhh();
        $resultado=$oLRrhh -> eliminaManual($cod);
        return $resultado;
      }
    public function  asignarPadre($cadena,$ruta_archivo){
        $oLRrhh = new LRrhh();
        $oLRrhh -> crearArbolManuales($cadena,$ruta_archivo);
        require_once("../../cvista/manuales/asignarPadre.php");
    }

   public function capturaPadre($codigo){

        $oLRrhh = new LRrhh();
        $p=$oLRrhh->traerDatosPadre($codigo);
        $idManual=$p['0']['0'];
        $titulo = $p['0']['1'];
        $jerarquia = $p['0']['2'];
        $nivel = $p['0']['3'];
        $orden = $p['0']['4'];
        $resultado=$idManual."|".$titulo."|".$jerarquia."|".$nivel."|".$orden."|";
        return $resultado;
//        require_once("../../cvista/manuales/nuevoManual.php");
    }
}
?>