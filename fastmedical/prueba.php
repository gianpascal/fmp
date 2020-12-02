<?php

class ArrayToXml {

    protected $document;
    protected $replaceSpacesByUnderScoresInKeyNames = true;
    protected $addXmlDeclaration = true;
    protected $numericTagNamePrefix = 'numeric_';

    public function __construct(
            array $array,
            $rootElement = '',
            $replaceSpacesByUnderScoresInKeyNames = true,
            $xmlEncoding = null,
            $xmlVersion = '1.0',
            $domProperties = [],
            $xmlStandalone = null
    ) {
        $this->document = new DOMDocument($xmlVersion, $xmlEncoding);

        if (!is_null($xmlStandalone)) {
            $this->document->xmlStandalone = $xmlStandalone;
        }

        
        
        if (!empty($domProperties)) {
            $this->setDomProperties($domProperties);
        }

        $this->replaceSpacesByUnderScoresInKeyNames = $replaceSpacesByUnderScoresInKeyNames;

        if ($this->isArrayAllKeySequential($array) && !empty($array)) {
            throw new DOMException('Invalid Character Error');
        }

        $root = $this->createRootElement($rootElement);

        $this->document->appendChild($root);

        $this->convertElement($root, $array);
    }

    public function setNumericTagNamePrefix(string $prefix) {
        $this->numericTagNamePrefix = $prefix;
    }

    public static function convert(
            array $array,
            $rootElement = '',
            bool $replaceSpacesByUnderScoresInKeyNames = true,
            string $xmlEncoding = null,
            string $xmlVersion = '1.0',
            array $domProperties = [],
            bool $xmlStandalone = null
    ) {
        $converter = new static(
                $array,
                $rootElement,
                $replaceSpacesByUnderScoresInKeyNames,
                $xmlEncoding,
                $xmlVersion,
                $domProperties,
                $xmlStandalone
        );

        return $converter->toXml();
    }

    public function toXml(): string {
        if ($this->addXmlDeclaration === false) {
            return $this->document->saveXml($this->document->documentElement);
        }

        return $this->document->saveXML();
    }

    public function toDom(): DOMDocument {
        return $this->document;
    }

    protected function ensureValidDomProperties(array $domProperties) {
        foreach ($domProperties as $key => $value) {
            if (!property_exists($this->document, $key)) {
                throw new Exception($key . ' is not a valid property of DOMDocument');
            }
        }
    }

    public function setDomProperties(array $domProperties) {
        $this->ensureValidDomProperties($domProperties);

        foreach ($domProperties as $key => $value) {
            $this->document->{$key} = $value;
        }

        return $this;
    }

    public function prettify() {
        $this->document->preserveWhiteSpace = false;
        $this->document->formatOutput = true;

        return $this;
    }

    public function dropXmlDeclaration() {
        $this->addXmlDeclaration = false;

        return $this;
    }

    private function convertElement(DOMElement $element, $value) {
        $sequential = $this->isArrayAllKeySequential($value);

        if (!is_array($value)) {
            $value = htmlspecialchars($value);

            $value = $this->removeControlCharacters($value);

            $element->nodeValue = $value;

            return;
        }

        foreach ($value as $key => $data) {
            if (!$sequential) {
                if (($key === '_attributes') || ($key === '@attributes')) {
                    $this->addAttributes($element, $data);
                } elseif ((($key === '_value') || ($key === '@value')) && is_string($data)) {
                    $element->nodeValue = htmlspecialchars($data);
                } elseif ((($key === '_cdata') || ($key === '@cdata')) && is_string($data)) {
                    $element->appendChild($this->document->createCDATASection($data));
                } elseif ((($key === '_mixed') || ($key === '@mixed')) && is_string($data)) {
                    $fragment = $this->document->createDocumentFragment();
                    $fragment->appendXML($data);
                    $element->appendChild($fragment);
                } elseif ($key === '__numeric') {
                    $this->addNumericNode($element, $data);
                } elseif (substr($key, 0, 9) === '__custom:') {
                    $this->addNode($element, str_replace('\:', ':', preg_split('/(?<!\\\):/', $key)[1]), $data);
                } else {
                    $this->addNode($element, $key, $data);
                }
            } elseif (is_array($data)) {
                $this->addCollectionNode($element, $data);
            } else {
                $this->addSequentialNode($element, $data);
            }
        }
    }

    protected function addNumericNode(DOMElement $element, $value) {
        foreach ($value as $key => $item) {
            $this->convertElement($element, [$this->numericTagNamePrefix . $key => $item]);
        }
    }

    protected function addNode(DOMElement $element, $key, $value) {
        if ($this->replaceSpacesByUnderScoresInKeyNames) {
            $key = str_replace(' ', '_', $key);
        }

        $child = $this->document->createElement($key);
        $element->appendChild($child);
        $this->convertElement($child, $value);
    }

    protected function addCollectionNode(DOMElement $element, $value) {
        if ($element->childNodes->length === 0 && $element->attributes->length === 0) {
            $this->convertElement($element, $value);

            return;
        }

        $child = $this->document->createElement($element->tagName);
        $element->parentNode->appendChild($child);
        $this->convertElement($child, $value);
    }

    protected function addSequentialNode(DOMElement $element, $value) {
        if (empty($element->nodeValue) && !is_numeric($element->nodeValue)) {
            $element->nodeValue = htmlspecialchars($value);

            return;
        }

        $child = new DOMElement($element->tagName);
        $child->nodeValue = htmlspecialchars($value);
        $element->parentNode->appendChild($child);
    }

    protected function isArrayAllKeySequential($value) {
        if (!is_array($value)) {
            return false;
        }

        if (count($value) <= 0) {
            return true;
        }

        if (\key($value) === '__numeric') {
            return false;
        }

        return array_unique(array_map('is_int', array_keys($value))) === [true];
    }

    protected function addAttributes(DOMElement $element, array $data) {
        foreach ($data as $attrKey => $attrVal) {
            $element->setAttribute($attrKey, $attrVal);
        }
    }

    protected function createRootElement($rootElement): DOMElement {
        if (is_string($rootElement)) {
            $rootElementName = $rootElement ?: 'root';

            return $this->document->createElement($rootElementName);
        }

        $rootElementName = $rootElement['rootElementName'] ?? 'root';

        $element = $this->document->createElement($rootElementName);

        foreach ($rootElement as $key => $value) {
            if ($key !== '_attributes' && $key !== '@attributes') {
                continue;
            }

            $this->addAttributes($element, $rootElement[$key]);
        }

        return $element;
    }

    protected function removeControlCharacters(string $value): string {
        return preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value);
    }

}

//$header['fechaTransaccion'] = date('Y-m-d H:i:s');// '2020-11-06 12:46:41';
$header['fechaTransaccion'] =  '2020-11-06 12:46:41';
$header['idEmisor'] = 'VALDITEX';
$header['token'] = 'HvUpAWbL+FI/mA5B+sd+yc1PPFQ=';
$header['transaccion'] = 'enviarComprobanteRequest';

$comprobanteElectronico['anticipo'] = 'false';
$comprobanteElectronico['codTipoOperacion'] = '0101';
$comprobanteElectronico['codigoEmisor'] = 'VALDITEX';
$comprobanteElectronico['codigoTipoDocumentoIdentificacionAdquiriente'] = '6';
$comprobanteElectronico['codigoTipoDocumentoIdentificacionEmisor'] = '6';
$comprobanteElectronico['codigoTipoMoneda'] = 'PEN';
$comprobanteElectronico['correoElectronicoAdquiriente'] = 'd.maguino@conastec.com.pE';

$descuentoCargoGlobal['descuentoAfectaIGV'] = '21.94';
$descuentoCargoGlobal['indicador'] = 'false';
$descuentoCargoGlobal['recagoYpropina'] = '27.19';

$comprobanteElectronico['descuentoCargoGlobal'] = $descuentoCargoGlobal;
$comprobanteElectronico['descuentoGlobal'] = '21.94';

$direccionAdquiriente['departamento'] = 'LIMA';
$direccionAdquiriente['direccionDetallada'] = 'AV. LAS CAMELIAS NRO. 820 INT. 701 URB. SANTA CRUZ';
$direccionAdquiriente['distrito'] = 'SAN ISIDRO';
$direccionAdquiriente['provincia'] = 'LIMA';

$comprobanteElectronico['direccionAdquiriente'] = $direccionAdquiriente;

$direccionEmisor['codigoPais'] = 'PE';
$direccionEmisor['codigoSede'] = 'HCC6';
$direccionEmisor['codigoSunatAnexo'] = '';
$direccionEmisor['codigoUbigeo'] = '030101';
$direccionEmisor['departamento'] = 'APURÍMAC';
$direccionEmisor['direccionDetallada'] = 'AV. MI CASA NRO. 125';
$direccionEmisor['distrito'] = 'ABANCAY';
$direccionEmisor['provincia'] = 'ABANCAY';

$comprobanteElectronico['direccionEmisor'] = $direccionEmisor;

$direccionEntregaBienOPrestaServicio['codigoPais'] = 'PE';
$direccionEntregaBienOPrestaServicio['codigoSede'] = 'HCC6';
$direccionEntregaBienOPrestaServicio['codigoSunatAnexo'] = '';
$direccionEntregaBienOPrestaServicio['codigoUbigeo'] = '030101';
$direccionEntregaBienOPrestaServicio['departamento'] = 'APURÍMAC';
$direccionEntregaBienOPrestaServicio['direccionDetallada'] = 'AV. MI CASA NRO. 125';
$direccionEntregaBienOPrestaServicio['distrito'] = 'ABANCAY';
$direccionEntregaBienOPrestaServicio['provincia'] = 'ABANCAY';
$comprobanteElectronico['direccionEntregaBienOPrestaServicio'] = $direccionEntregaBienOPrestaServicio;

$listadoDeEstructuras['nombre'] = 'CAJERO';
$listadoDeEstructuras['valor'] = 'USUARIO_VALDITEX';
$estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;
$listadoDeEstructuras['nombre'] = 'RECARGO_CONSUMO';
$listadoDeEstructuras['valor'] = '27.19';
$estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;
$listadoDeEstructuras['nombre'] = 'SEDE';
$listadoDeEstructuras['valor'] = 'SEDE ALFA';
$estructuraVariable['listadoDeEstructuras'][] = $listadoDeEstructuras;


$comprobanteElectronico['estructuraVariable'] = $estructuraVariable;
$comprobanteElectronico['fechaEmision'] = date('Y-m-d');//'2020-11-27';
$comprobanteElectronico['fechaVencimiento'] = date('Y-m-d');;
$comprobanteElectronico['formaPago'] = 'CRE';
$comprobanteElectronico['gratuito'] = 'false';
$comprobanteElectronico['horaEmision'] = date('H:i:s');//'12:46:41';

$identificador['codigoTipoDocumento'] = '01';
$identificador['numeroCorrelativo'] = '12';
$identificador['numeroDocumentoIdentificacionEmisor'] = '20553771111';
$identificador['serie'] = 'FA71';
$identificador['tipoEmision'] = 'ELE';

$comprobanteElectronico['identificador'] = $identificador;
$comprobanteElectronico['importeTotal'] = '169.71';
$comprobanteElectronico['indicadorOperacionSujetaDetraccion'] = 'N';
$comprobanteElectronico['indicadorRetornoEstado'] = 'S';


$itemsComprobantePagoElectronicoVenta['cantidad'] = '1.0';
$itemsComprobantePagoElectronicoVenta['cargoNoAfectaIGV'] = '0.0';
$itemsComprobantePagoElectronicoVenta['cargoNoAfectaIGVFactor'] = '0';
$itemsComprobantePagoElectronicoVenta['codigoProducto'] = '';
$itemsComprobantePagoElectronicoVenta['descripcionProducto'] = 'ASDASD';
$itemsComprobantePagoElectronicoVenta['detalleProducto'] = '';
$itemsComprobantePagoElectronicoVenta['gratuito'] = 'false';
$itemsComprobantePagoElectronicoVenta['importeTotal'] = '169.71';
$itemsComprobantePagoElectronicoVenta['importeValorVentaItem'] = '143.82';




$impuestosUnitarios['codigoImpuestoUnitario'] = '1000';
$impuestosUnitarios['codigoTipoAfectacionIgv'] = '10';
$impuestosUnitarios['montoBaseImpuesto'] = '143.82';
$impuestosUnitarios['montoSubTotalImpuestoUnitario'] = '25.89';
$impuestosUnitarios['montoTotalImpuestoUnitario'] = '25.89';

$itemsComprobantePagoElectronicoVenta['impuestosUnitarios'] = $impuestosUnitarios;


$itemsComprobantePagoElectronicoVenta['numeroOrden'] = '1';
$itemsComprobantePagoElectronicoVenta['precioReferencia'] = 'false';

$preciosUnitarios['codigoTipoPrecio'] = '01';
$preciosUnitarios['montoPrecio'] = '169.71';
$itemsComprobantePagoElectronicoVenta['preciosUnitarios'] = $preciosUnitarios;

$itemsComprobantePagoElectronicoVenta['unidadMedida'] = 'ZZ';
$itemsComprobantePagoElectronicoVenta['valorVentaUnitario'] = '143.82000';


$comprobanteElectronico['itemsComprobantePagoElectronicoVenta'] = $itemsComprobantePagoElectronicoVenta;
$comprobanteElectronico['numeroDocumentoIdentificacionAdquiriente'] = '20508316985';
$comprobanteElectronico['observaciones'] = '';
$comprobanteElectronico['precioReferencial'] = 'false';
$propiedadesAdicionales['codigoPropiedadAdicional'] = '1000';
$propiedadesAdicionales['descripcionPropiedadAdicional'] = 'CIENTO SETENTA Y UNO CON 01/100 SOLES';
$comprobanteElectronico['propiedadesAdicionales'] = $propiedadesAdicionales;
$comprobanteElectronico['razonSocialAdquiriente'] = 'CONSULTORIA Y ASESORIA EN TECNOLOGIA CONASTEC S.R.L. ';
$comprobanteElectronico['razonSocialEmisor'] = 'VALDITEX PERU E.I.R.L.';
$comprobanteElectronico['sumatoriaOtrosCargos'] = '27.19';
$comprobanteElectronico['telefonoEmisor'] = '';
$comprobanteElectronico['ticket'] = 'false';
$comprobanteElectronico['totalCargoNoAfecta'] = '27.19';
$comprobanteElectronico['totalIgv'] = '21.94';
$comprobanteElectronico['totalImpuesto'] = '21.94';
$comprobanteElectronico['totalIsc'] = '0.00';
$comprobanteElectronico['totalOperacionExportacion'] = '0.00';
$comprobanteElectronico['totalOperacionGratuito'] = '0.00';
$comprobanteElectronico['totalPrecioVenta'] = '143.82';
$comprobanteElectronico['totalTributoGratuito'] = '0.00';
$comprobanteElectronico['totalValorVenta'] = '121.88';
$comprobanteElectronico['totalValorVentaOperacionesExoneradas'] = '0.00';
$comprobanteElectronico['totalValorVentaOperacionesGravadas'] = '121.88';
$comprobanteElectronico['totalValorVentaOperacionesInafectas'] = '0.00';
$comprobanteElectronico['usuario'] = 'USUARIO_VALDITEX';
$comprobanteElectronico['ventaItinerante'] = 'false';

$enviarComprobante['header'] = $header;
$enviarComprobante['comprobanteElectronico'] = $comprobanteElectronico;
print_r($enviarComprobante);
$data = ArrayToXml::convert($enviarComprobante, 'enviarComprobante', true, 'UTF-8', '1.0', [], true);



$wsdl = 'https://qa.ebis.pe/SfeWeb/services/ws/sfeServicesNetwork.wsdl'; //URL de nuestro servicio soap
//Basados en la estructura del servicio armamos un array
$params = Array(
    "data" => $data
);

$options = Array(
    "uri" => $wsdl,
    "style" => SOAP_RPC,
    "use" => SOAP_ENCODED,
    "soap_version" => SOAP_1_1,
    "cache_wsdl" => WSDL_CACHE_BOTH,
    "connection_timeout" => 15,
    "trace" => false,
    "encoding" => "UTF-8",
    "exceptions" => false,
    "stream_context" => stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                )
            )
    )
);

//Enviamos el Request
$soap = new SoapClient($wsdl, $options);
$result = $soap->enviarComprobante($params); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
var_dump($result);


$wsImprimirComprobantePagoPeticion['codigoEmisor']='VALDITEX';
$header= array();
$header['fechaTransaccion']='2020-11-16 09:32:41';
$header['idEmisor']='VALDITEX';
$header['token']='75BzrdWwYkeHqa0ZZHeFU6Yj2Js=';
$header['transaccion']='imprimirComprobantePagoRequest';
$wsImprimirComprobantePagoPeticion['header']=$header;
$identificador['codigoTipoDocumento']='01';
$identificador['numeroCorrelativo']='10';
$identificador['numeroDocumentoIdentificacionEmisor']='20553771111';
$identificador['serie']='FA71';
$wsImprimirComprobantePagoPeticion['identificador']=$identificador;
$wsImprimirComprobantePagoPeticion['fechaEmision']='2020-11-06';
$wsImprimirComprobantePagoPeticion['indicadorPeticionTxt']='N';
$wsImprimirComprobantePagoPeticion['indicadorPeticionXml']='N';
$wsImprimirComprobantePagoPeticion['indicadorPeticionPdf']='S';
$wsImprimirComprobantePagoPeticion['indicadorTipoDocumento']='V';
$params = Array(
    "data" => $wsImprimirComprobantePagoPeticion
);
$result2 = $soap->enviarComprobante($params);
echo "/n <br>";
var_dump($result);


