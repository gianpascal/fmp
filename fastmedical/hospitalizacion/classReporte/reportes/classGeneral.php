<?php
class classGeneral {
    private $styleCL;
    private $styleCD;
    private $styleDL;
    private $styleDD;
    private $stylePL;
    private $stylePD;
    private $lblCabecera;
    private $lblDetalle;
    private $lblPie;

    public function __construct() {

    }

    public  function setLabelCabecera($labelCabecera,$atributosReceta) {
        $a=0;
        foreach ($labelCabecera as $i => $val) {
            $this->lblCabecera[$a]=utf8_encode($labelCabecera[$i]["vNombre"]);
            /*======================= Datos por defecto =============================*/
            $this->styleCL[$a][0]="50";
            $this->styleCL[$a][1]="5";
            $this->styleCL[$a][2]="5";
            $this->styleCL[$a][3]="5";
            $this->styleCL[$a][4]=array(0=>"0",1=>"0",2=>"0");
            $this->styleCL[$a][5]="helvetica";
            $this->styleCL[$a][6]="N";
            $this->styleCL[$a][7]="6";
            $this->styleCD[$a][0]="50";
            $this->styleCD[$a][1]="5";
            $this->styleCD[$a][2]="5";
            $this->styleCD[$a][3]="5";
            $this->styleCD[$a][4]=array(0=>"0",1=>"0",2=>"0");
            $this->styleCD[$a][5]="helvetica";
            $this->styleCD[$a][6]="N";
            $this->styleCD[$a][7]="6";
            /*==================== Fin datos por defecto ===========================*/
            foreach ($atributosReceta as $j => $rec) {
                if($labelCabecera[$i]["iIdEtiqueta"]==$atributosReceta[$j]["iIdEtiqueta"]) {
                    switch ($atributosReceta[$j]["Atributo"]) {
                        case "Ancho":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][0]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][0]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Alto":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][1]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][1]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Superior":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][2]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][2]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Izquierda":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][3]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][3]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Color":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            break;
                        case "Tipo Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][5]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][5]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Estilo Letra":
                            $vValor=$this->tipoLetra($atributosReceta[$j]["vValor"]);
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][6]=$vValor;
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][6]=$vValor;
                            break;
                        case "Tamaño Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleCL[$a][7]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleCD[$a][7]=$atributosReceta[$j]["vValor"];
                            break;

                    }
                }
            }
            $a++;
        }
    }

    public  function setLabelDetalle($labelDetalle,$atributosReceta) {
        $b=0;
        foreach ($labelDetalle as $i => $val) {
            $this->lblDetalle[$b]=utf8_encode($labelDetalle[$i]["vNombre"]);
            /*======================= Datos por defecto =============================*/
            $this->styleDL[$b][0]="50";
            $this->styleDL[$b][1]="5";
            $this->styleDL[$b][2]="10";
            $this->styleDL[$b][3]="5";
            $this->styleDL[$b][4]=array(0=>"0",1=>"0",2=>"0");
            $this->styleDL[$b][5]="helvetica";
            $this->styleDL[$b][6]="N";
            $this->styleDL[$b][7]="6";
            $this->styleDD[$b][0]="50";
            $this->styleDD[$b][1]="5";
            $this->styleDD[$b][2]="10";
            $this->styleDD[$b][3]="5";
            $this->styleDD[$b][4]=array(0=>"0",1=>"0",2=>"0");
            $this->styleDD[$b][5]="helvetica";
            $this->styleDD[$b][6]="N";
            $this->styleDD[$b][7]="6";
           /*====================== Fin datos por defecto ===========================*/
            foreach ($atributosReceta as $j => $rec) {
                if($labelDetalle[$i]["iIdEtiqueta"]==$atributosReceta[$j]["iIdEtiqueta"]) {
                    switch ($atributosReceta[$j]["Atributo"]) {
                        case "Ancho":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][0]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][0]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Alto":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][1]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][1]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Superior":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][2]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][2]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Izquierda":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][3]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][3]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Color":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            break;
                        case "Tipo Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][5]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][5]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Estilo Letra":
                            $vValor=$this->tipoLetra($atributosReceta[$j]["vValor"]);
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][6]=$vValor;
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][6]=$vValor;
                            break;
                        case "Tamaño Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->styleDL[$b][7]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->styleDD[$b][7]=$atributosReceta[$j]["vValor"];
                            break;
                    }
                }
            }
            $b++;
        }
    }

    public  function setLabelPie($labelPie,$atributosReceta) {
        $c=0;
        foreach ($labelPie as $i => $val) {
            $this->lblPie[$c]= $labelPie[$i]["vNombre"];
            /*======================= Datos por defecto =============================*/
            $this->stylePL[$c][0]="50";
            $this->stylePL[$c][1]="5";
            $this->stylePL[$c][2]="25";
            $this->stylePL[$c][3]="5";
            $this->stylePL[$c][4]=array(0=>"0",1=>"0",2=>"0");
            $this->stylePL[$c][5]="helvetica";
            $this->stylePL[$c][6]="N";
            $this->stylePL[$c][7]="6";
            $this->stylePD[$c][0]="50";
            $this->stylePD[$c][1]="5";
            $this->stylePD[$c][2]="25";
            $this->stylePD[$c][3]="5";
            $this->stylePD[$c][4]=array(0=>"0",1=>"0",2=>"0");
            $this->stylePD[$c][5]="helvetica";
            $this->stylePD[$c][6]="N";
            $this->stylePD[$c][7]="6";
            /*==================== Fin datos por defecto ===========================*/

            foreach ($atributosReceta as $j => $rec) {
                if($labelPie[$i]["iIdEtiqueta"]==$atributosReceta[$j]["iIdEtiqueta"]) {
                    switch ($atributosReceta[$j]["Atributo"]) {
                        case "Ancho":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][0]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][0]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Alto":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][1]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][1]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Superior":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][2]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][2]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Izquierda":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][3]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][3]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Color":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][4]=$this->getConvert($atributosReceta[$j]["vValor"]);
                            break;
                        case "Tipo Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][5]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][5]=$atributosReceta[$j]["vValor"];
                            break;
                        case "Estilo Letra":
                            $vValor=$this->tipoLetra($atributosReceta[$j]["vValor"]);
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][6]=$vValor;
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][6]=$vValor;
                            break;
                        case "Tamaño Letra":
                            if($atributosReceta[$j]["iIdTipo"]==1)
                                $this->stylePL[$c][7]=$atributosReceta[$j]["vValor"];
                            else if($atributosReceta[$j]["iIdTipo"]==2)
                                $this->stylePD[$c][7]=$atributosReceta[$j]["vValor"];
                            break;
                    }
                }
            }
            $c++;
        }
    }
    public function tipoLetra($letra) {
        $result="N";
        switch ($letra) {
            case "Negrita":
                $result="B";
                break;
            case "Normal":
                $result="N";
                break;
            case "Cursiva":
                $result="I";
                break;
            case "Negrita-Cursiva":
                $result="BI";
                break;
        }
        return $result;
    }
    public  function getLblCabecera() {
        return $this->lblCabecera;
    }
    public  function getStyleCL() {
        return $this->styleCL;
    }
    public  function getStyleCD() {
        return $this->styleCD;
    }
    public  function getLblDetalle() {
        return $this->lblDetalle;
    }
    public  function getStyleDL() {
        return $this->styleDL;
    }
    public  function getStyleDD() {
        return $this->styleDD;
    }
    public  function getLblPie() {
        return $this->lblPie;
    }
    public  function getStylePL() {
        return $this->stylePL;
    }
    public  function getStylePD() {
        return $this->stylePD;
    }

    public function getConvert($array) {
        $var1=substr($array,1,2);
        $var2=substr($array,3,2);
        $var3=substr($array,5,2);
        $num1=hexdec($var1);
        $num2=hexdec($var2);
        $num3=hexdec($var3);
        $color=array(0=>$num1,1=>$num2,2=>$num3);
        return $color;
    }

}
?>