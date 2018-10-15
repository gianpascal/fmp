
var url = '../../ccontrol/control/control.php';

//función empleada en las búsquedas
/*
 function estadoCargador(estado){
 switch (estado){
 case 0:	{
 $('VentanaTransparente').setStyle({
 visibility:'hidden'
 });
 break;
 }
 case 1:{
 $('VentanaTransparente').setStyle({
 visibility:'visible'
 });
 break;
 }
 }
 }
 */
function ltrim(s) {
    return s.replace(/^\s+/, "");
}

function rtrim(s) {
    return s.replace(/\s+$/, "");
}

function trim(s) {
    return rtrim(ltrim(s));
}

function validarManteAmbienteFisico(accion) {
    //Validar que se ingrese la descripción del ambiente físico
    descAmbienteFisico = trim($('descAmbienteFisico').value);
    if (descAmbienteFisico == "") {
        alert("Inserte descripci\xF3n");
        $('descAmbienteFisico').value = "";
        $('descAmbienteFisico').focus();
    } else {
        //Validar que se haya seleccioando un piso
        indice = $('numPisoAmbienteFisico').selectedIndex;
        indice2 = $('tipoAmbiente').selectedIndex;
        if (indice == 0) {
            alert("Seleccione piso");
        } else if (indice2 == 0) {
            alert("Seleccione el Tipo de Ambiente");
        } else {
            manteAmbienteFisico(accion);
        }
    }
}

function manteAmbienteFisico(accion) {
    var codAmbienteFisico = $('codAmbienteFisico').value;
    var idSedeEmpresa = $('cboSede').value;
    var idTipo = $('tipoAmbiente').value;
    var nomAmbienteFisico = trim($('nomAmbienteFisico').value);
    var descAmbienteFisico = trim($('descAmbienteFisico').value);
    var numPisoAmbienteFisico = $('numPisoAmbienteFisico').value;
    var anchoAmbienteFisico = trim($('anchoAmbienteFisico').value);
    var largoAmbienteFisico = trim($('largoAmbienteFisico').value);
    var altoAmbienteFisico = trim($('altoAmbienteFisico').value);
    var umAmbienteFisico = $('umAmbienteFisico').value;

    var datos = codAmbienteFisico + "|" + idSedeEmpresa + "|" + nomAmbienteFisico + "|" + descAmbienteFisico + "|" + numPisoAmbienteFisico + "|" + anchoAmbienteFisico + "|" + largoAmbienteFisico + "|" + altoAmbienteFisico + "|" + umAmbienteFisico + "|" + idTipo;
    //datos = datos.replace(/'/gi,"\'\'");
    datos = Base64.encode(datos);

    //var data = 'p1=manteFormulario&'+$('mante_formulario').serialize()+'&accion='+accion;
    var data = 'p1=manteAmbienteFisico&accion=' + accion + '&datos=' + datos;
    new Ajax.Request(url,
            {
                method: 'post',
                parameters: data,
                onLoading: function (transport) {
                    estadoCargador(1);
                },
                onComplete: function (transport) {
                    estadoCargador(0);
                    alert(transport.responseText);
                    Windows.close("Div_popupMantAmbFisico");
                    refrescarAmbienteFisico(idSedeEmpresa);
                }
            }
    )
}

function eliminarAmbienteFisico(accion, codAmbienteFisico) {
    idSedeEmpresa = $('cboSede').value;
    if (confirm("\xBFEst\xE1 seguro que desea eliminar el ambiente f\xEDsico?")) {
        data = 'p1=manteAmbienteFisico&accion=' + accion + '&codAmbienteFisico=' + codAmbienteFisico + '&idSedeEmpresa=' + idSedeEmpresa;
        new Ajax.Request(url,
                {
                    method: 'post',
                    parameters: data,
                    onLoading: function (transport) {
                        estadoCargador(1);
                    },
                    onComplete: function (transport) {
                        estadoCargador(0);
                        alert(transport.responseText);
                        refrescarAmbienteFisico(idSedeEmpresa);
                    }
                }
        )
    }
}
//Actualiza tabla de ambientes fisicos mostrados
function refrescarAmbienteFisico(idSedeEmpresa) {
    data = 'p1=listaAmbientesFisicos&p2=' + idSedeEmpresa;
    new Ajax.Request(url,
            {
                method: 'post',
                parameters: data,
                onLoading: function (transport) {
                    estadoCargador(1);
                },
                onComplete: function (transport) {
                    estadoCargador(0);
                    $('contenido_detalle').innerHTML = transport.responseText;
                    /*$("nombre_formulario").value='';
                     $("nombre_formulario").focus();*/
                }
            }
    )
}

function mostrarAmbFisicoxServBasico(codAmbienteFisico, nomAmbienteFisico) {
    CargarVentana('popupAmbFisicoxServBasico', 'Ambiente Físico: ' + nomAmbienteFisico, '../mantenimientogeneral/ambFisicoxServBasico.php?p2=' + codAmbienteFisico, '400', '120', false, true, '', 1, '', 10, 10, 10, 10);
}
//Habilitar-Deshabilitar servicio básico de ambiente físico
function habServBasicoDeAmbFisico(codAmbienteFisico, codServicioBasico, nomServicioBasico, estado) {
    data = 'p1=habServBasicoDeAmbFisico&p2=' + codAmbienteFisico + '&p3=' + codServicioBasico + '&p4=' + estado;
    var habi = estado == 1 ? 'DESHABILITADO' : 'HABILITADO';
    var ask = confirm('El Servicio: ' + nomServicioBasico + ' va a ser ' + habi + ' \xBFDesea Continuar?');
    if (ask) {
        new Ajax.Request(url,
                {
                    method: 'post',
                    parameters: data,
                    onLoading: function (transport) {
                        estadoCargador(1);
                    },
                    onComplete: function (transport) {
                        estadoCargador(0);
                        alert('Servicio: ' + nomServicioBasico + ' fue ' + habi);
                        refrescarServBasicoDeAmbFisico(codAmbienteFisico);
                    }
                }
        )
    }
}

function refrescarServBasicoDeAmbFisico(codAmbienteFisico) {
    data = 'p1=listaAmbFisicoxServBasico&p2=' + codAmbienteFisico;
    new Ajax.Request(url,
            {
                method: 'post',
                parameters: data,
                onLoading: function (transport) {
                    estadoCargador(1);
                },
                onComplete: function (transport) {
                    estadoCargador(0);
                    $('divAmbFisicoxServBasico').innerHTML = transport.responseText;
                }
            }
    )
}

function mostrarMantCamaxAmbFisico(codAmbienteFisico, nomAmbienteFisico) {
    //CargarVentana('popupMantCamaxAmbFisico','Ambiente Físico: '+nomAmbienteFisico,'../mantenimientogeneral/manteCamaxAmbFisico.php?p2='+codAmbienteFisico+'&p3='+nomAmbienteFisico,'500','400',false,true,'',1,'',10,10,10,10);
    CargarVentana('popupMantCamaxAmbFisico', '', '../mantenimientogeneral/manteCamaxAmbFisico.php?p2=' + codAmbienteFisico + '&p3=' + nomAmbienteFisico, '500', '300', false, true, '', 1, '', 10, 10, 10, 10);
}

//Habilitar-Deshabilitar cama de ambiente físico
function habCamaDeAmbFisico(codAmbienteFisico, codCama, nroCama, estado) {
    data = 'p1=habCamaDeAmbFisico&p2=' + codAmbienteFisico + '&p3=' + codCama + '&p4=' + estado;
    var habi = estado == 1 ? 'DESHABILITADA' : 'HABILITADA';
    var ask = confirm('La cama nro. : ' + nroCama + ' va a ser ' + habi + ' \xBFDesea Continuar?');
    if (ask) {
        new Ajax.Request(url,
                {
                    method: 'post',
                    parameters: data,
                    onLoading: function (transport) {
                        estadoCargador(1);
                    },
                    onComplete: function (transport) {
                        estadoCargador(0);
                        alert('Cama nro. : ' + nroCama + ' fue ' + habi);
                        refrescarCamaDeAmbFisico(codAmbienteFisico);
                    }
                }
        )
    }
}

function refrescarCamaDeAmbFisico(codAmbienteFisico) {
    data = 'p1=listaCamaxAmbFisico&p2=' + codAmbienteFisico;
    new Ajax.Request(url,
            {
                method: 'post',
                parameters: data,
                onLoading: function (transport) {
                    estadoCargador(1);
                },
                onComplete: function (transport) {
                    estadoCargador(0);
                    $('divCamaxAmbFisico').innerHTML = transport.responseText;
                }
            }
    )
}

function mostrarMantCamaxAmbFisico2(accion, datos) {
    //CargarVentana('popupMantCamaxAmbFisico2','Ambiente Físico: '+nomAmbienteFisico,'../mantenimientogeneral/manteCamaxAmbFisico2.php?p2='+codAmbienteFisico+'&p3='+nomAmbienteFisico,'400','150',false,true,'',1,'',10,10,10,10);
    CargarVentana('popupMantCamaxAmbFisico2', '', '../mantenimientogeneral/manteCamaxAmbFisico2.php?accion=' + accion + '&datos=' + datos, '400', '150', false, true, '', 1, '', 10, 10, 10, 10);
}

function manteCamaxAmbFisico(accion, codAmbienteFisico) {
    idCama = $('hdnIdCama').value;
    numCama = $('txtNumeroCama').value;
    descCama = $('txaDescripcion').value;

    datos = idCama + "|" + codAmbienteFisico + "|" + numCama + "|" + descCama;
    //datos = datos.replace(/'/gi,"\'\'");
    datos = Base64.encode(datos);

    //var data = 'p1=manteFormulario&'+$('mante_formulario').serialize()+'&accion='+accion;
    data = 'p1=manteCamaxAmbFisico&accion=' + accion + '&datos=' + datos;
    new Ajax.Request(url,
            {
                method: 'post',
                parameters: data,
                onLoading: function (transport) {
                    estadoCargador(1);
                },
                onComplete: function (transport) {
                    estadoCargador(0);
                    alert(transport.responseText);
                    Windows.close("Div_popupMantCamaxAmbFisico2");
                    refrescarCamaDeAmbFisico(codAmbienteFisico);
                }
            }
    )
}

///Angel Sayes - Mantenimiento de Almacen 
function resultadoalmacenes() {
    document.getElementById('divresultadoalmacenes');
    patronModulo = 'resultadoalmacenes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    rAlmacen = new dhtmlXGridObject('divresultadoalmacenes');
    rAlmacen.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rAlmacen.setSkin("dhx_skyblue");
    rAlmacen.enableRowsHover(true, 'grid_hover');
    var header = ["", "", "#text_filter", "#select_filter", ""];
    rAlmacen.attachHeader(header);
    rAlmacen.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 4) {
            var idAlmacen = rAlmacen.cells(rId, 0).getValue();
            nuevoAlmacen(idAlmacen);
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rAlmacen.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);
    });
    rAlmacen.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    rAlmacen.init();
    rAlmacen.loadXML(pathRequestControl + '?' + parametros);
}


function nuevoAlmacen(idAlmacen) {
    posFuncion = "";
    vtitle = "";
    vformname = 'EtiquetaAtributo';
    vwidth = '500';
    vheight = '400';
    patronModulo = 'mantenimientoAlmacen';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    if (idAlmacen > 0) {
        parametros += "&p2=" + idAlmacen;
    } else {
        parametros += "&p2=" + 0;
    }
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}



function comboSedes() {
    patronModulo = 'comboSedes';
    parametros = '';
    parametros += 'p1=' + patronModulo;

    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            $('DivAfiliacion').update(respuesta);
        }
    }
    )
}


function grabarMantenimientoAlmacenEvento() {
    var iIdCodigoAlmacen = $('txtCodAlmacen').value;
    var idAmbienteFisico = $('txtCodAmbienteFi').value;
    var nombreAlmacen = $('txtNombre').value;
    var nombreAlmacenPersona = $('txtNombre').value;
    var codPersona = $('txtCodPer').value;
    var descripcion = $("txtDescripcion").value;

    if (iIdCodigoAlmacen > 0) {
        var patronModulo = 'grabarMantenimientoAlmacen';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idAmbienteFisico;
        parametros += "&p3=" + nombreAlmacen;
        parametros += "&p4=" + descripcion;
        parametros += "&p5=" + codPersona;
        parametros += "&p6=" + nombreAlmacenPersona;
        parametros += "&p7=" + codPersona;
    } else {
        var patronModulo = 'grabarAgregarAlmacen';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idAmbienteFisico;
        parametros += "&p3=" + nombreAlmacen;
        parametros += "&p4=" + descripcion;
        parametros += "&p5=" + nombreAlmacenPersona;
    }
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            //$('divMantenimientoAlmacen').update(respuesta);
            resultadoalmacenes();
            Windows.close("Div_EtiquetaAtributo");
        }
    }
    )
}


function asignarAlmacenFisico() {
    var codigoSucursal = $("cboSucursal").value;
    if (codigoSucursal != '0000') {
        posFuncion = "listaAmbienteFisico";
        vtitle = "";
        vformname = 'AsignarAlmacenFisico';
        vwidth = '500';
        vheight = '400';
        patronModulo = 'asignarAmbienteFisico';
        vcenter = 't';
        vresizable = ''
        vmodal = 'true';
        vstyle = '';
        vopacity = '';
        veffect = '';
        vposx1 = '';
        vposx2 = '';
        vposy1 = '';
        vposy2 = '';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + codigoSucursal;
        CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    } else {
        alert("SELECCIONES UNA SEDE POR FAVOR");
    }
}

function listaAmbienteFisico() {
    txtNombreAmbienteFisico = $("txtNombreAmbienteFisico").value;
    codigoSucursal = $("cboSucursal").value;
    parametros = "p1=buscarAmbienteFisico&p2=" + codigoSucursal + "&p3=" + txtNombreAmbienteFisico;
    div = "divTablaArea";
    funcionClick = "clickTablaAreaAmbienteFisico";
    funcionDblClick = "";
    funcionLoad = "";
    generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);

}
function clickTablaAreaAmbienteFisico(fil, col) {
    if (col == 3 || col == 0 || col == 1 || col == 2) {
        $("txtCodAmbienteFi").value = mygridx.cells(fil, 0).getValue();
        $("txtCodigo").value = mygridx.cells(fil, 1).getValue();
        $("txtAmbiFisico").value = mygridx.cells(fil, 2).getValue();


        Windows.close("Div_AsignarAlmacenFisico")
    }
}

function limpiardatos() {
    $("txtCodAmbienteFi").value = ""
    $("txtCodigo").value = ""
    $("txtAmbiFisico").value = ""
}


function cerrarMantenimientoAlmacenEvento() {
    Windows.close("Div_EtiquetaAtributo");
}



//Mantenimiento Unidades de Medida

function cargarTablaTipoUnidadMedida() {
    $('agregarUnidadMedida').hide();
    document.getElementById('divTiposUnidadesMedida');
    patronModulo = 'tablaUnidadMedida';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    aUnidadMedida = new dhtmlXGridObject('divTiposUnidadesMedida');
    aUnidadMedida.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aUnidadMedida.setSkin("dhx_skyblue");
    aUnidadMedida.enableRowsHover(true, 'grid_hover');
    aUnidadMedida.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 0 || cInd == 1) {
            $('agregarUnidadMedida').show();
            var idTipoUnidad = aUnidadMedida.cells(rId, 0).getValue();
            cargarTablaUnidadMedida(idTipoUnidad);

            document.getElementById('txtNumeroEscondido').value = idTipoUnidad;
        } else if (cInd == 2) {
            idTipoUnidad = aUnidadMedida.cells(rId, 0).getValue();
            popadTipoUnidaMedida(idTipoUnidad);
        } else if (cInd == 3) {
            idTipoUnidad = aUnidadMedida.cells(rId, 0).getValue();
            popadEliminarTipoUnidaMedida(idTipoUnidad);
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aUnidadMedida.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);
    });
    aUnidadMedida.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    aUnidadMedida.init();
    aUnidadMedida.loadXML(pathRequestControl + '?' + parametros);
}


function cargarTablaUnidadMedida(idTipoUnidad) {
    var UnidadMedida = idTipoUnidad;
    document.getElementById('divUnidadesMedida');
    patronModulo = 'tablaUnidad';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + UnidadMedida;
    aUnidad = new dhtmlXGridObject('divUnidadesMedida');
    aUnidad.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aUnidad.setSkin("dhx_skyblue");
    aUnidad.enableRowsHover(true, 'grid_hover');
    aUnidad.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 4) {
            var idUnidadMedida = aUnidad.cells(rId, 0).getValue();
            popadUnidaMedida(idUnidadMedida);
        } else if (cInd == 5) {
            idUnidadMedida = aUnidad.cells(rId, 0).getValue();
            popadEliminarUnidaMedida(idUnidadMedida);
        }
    });

    contadorCargador++;
    var idCargador = contadorCargador;
    aUnidad.attachEvent("onXLS", function () {
        cargadorpeche(0, idCargador);
    });
    aUnidad.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });
    aUnidad.attachEvent("onCheckbox", clicenRadioButton);
    aUnidad.init();
    aUnidad.loadXML(pathRequestControl + '?' + parametros);

}

function clicenRadioButton(rowId, cellInd, state) {
    var idUnidadMedida = aUnidad.cells(rowId, 0).getValue();
    if (confirm("Esta seguro de cambiar  de unidad de medida principal")) {
        modificarRadioButton(idUnidadMedida);
    } else {
        var idTipoUnidad = document.getElementById('txtNumeroEscondido').value;
        cargarTablaUnidadMedida(idTipoUnidad);
    }
}
function popadEliminarTipoUnidaMedida(idTipoUnidad) {
    posFuncion = "";
    vtitle = "";
    vformname = 'TipoUnidaMedida';
    vwidth = '350';
    vheight = '200';
    patronModulo = 'MantenimientoEliminarTiposUnidadMedida';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idTipoUnidad
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function popadTipoUnidaMedida(idTipoUnidad) {
    posFuncion = "";
    vtitle = "";
    vformname = 'TipoUnidaMedida';
    vwidth = '350';
    vheight = '200';
    patronModulo = 'MantenimientoTiposUnidadMedida';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    if (idTipoUnidad > 0) {
        parametros += "&p2=" + idTipoUnidad;
    } else {
        parametros += "&p2=" + 0;

    }
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function cerrarMantenimientoTipoUnidadMedida() {
    Windows.close("Div_TipoUnidaMedida");
}

function grabarTipoUnidadMedida() {
    var idTipoUnidadMedida = $('txtIdTipoUnidadMedida').value;
    var TipoUnidadMedida = $('txtTipoUnidadMedida').value;

    if (idTipoUnidadMedida > 0) {
        var patronModulo = 'grabarMantenimientoTipoUnidadMedida';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idTipoUnidadMedida;
        parametros += "&p3=" + TipoUnidadMedida;
    } else {
        var patronModulo = 'grabarAgregarTipoUnidadMedida';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + TipoUnidadMedida;
    }
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            //$('divMantenimientoAlmacen').update(respuesta);
            cargarTablaTipoUnidadMedida();
            Windows.close("Div_TipoUnidaMedida");
        }
    }
    )
}

function popadUnidaMedida(idUnidadMedida) {
    posFuncion = "";
    vtitle = "";
    vformname = 'UnidaMedida';
    vwidth = '350';
    vheight = '300';
    patronModulo = 'MantenimientoUnidadMedida';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    if (idUnidadMedida > 0) {
        parametros += "&p2=" + idUnidadMedida;
        parametros += "&p3=" + document.getElementById('txtNumeroEscondido').value;
    } else {
        parametros += "&p2=" + 0;
        parametros += "&p3=" + document.getElementById('txtNumeroEscondido').value;
        //obtenerIdTipoUnidadMedida();   
    }
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

}


function cerrarMantenimientoUnidadMedida() {
    Windows.close("Div_UnidaMedida");
}

function grabarUnidadMedida() {
    var idTipoUnidad = $('txtidTIpoUnidad').value;
    var idUnidad = $('txtidUnidad').value;
    var unidadMedida = $('txtUnidadMedida').value;
    var principal = $('bPrincipal').value;
    if ($('bPrincipal').checked) {
        principal = 1;
    } else {
        principal = 0;
    }
    var equivalencia = $('txtEquivalencia').value;

    if (idUnidad > 0) {
        var patronModulo = 'grabarMantenimientoUnidadMedida';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idTipoUnidad;
        parametros += "&p3=" + unidadMedida;
        parametros += "&p4=" + principal;
        parametros += "&p5=" + equivalencia;
        parametros += "&p6=" + idUnidad;
    } else {
        patronModulo = 'grabarAgregarUnidadMedida';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + idTipoUnidad;
        parametros += "&p3=" + unidadMedida;
        parametros += "&p4=" + principal;
        parametros += "&p5=" + equivalencia;
    }
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            //$('divMantenimientoAlmacen').update(respuesta);
            cargarTablaUnidadMedida(idTipoUnidad);
            Windows.close("Div_UnidaMedida");
        }
    }
    )
}


function eliminarTipoUnidadMedida() {
    var idTipoUnidad = $('txtIdTipoUnidadMedida').value;
    patronModulo = 'EliminarTipoUnidadMedida';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idTipoUnidad;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            //$('divMantenimientoAlmacen').update(respuesta);
            cargarTablaTipoUnidadMedida();
            Windows.close("Div_TipoUnidaMedida");
        }
    }
    )
}

function popadEliminarUnidaMedida(idUnidadMedida) {
    posFuncion = "";
    vtitle = "";
    vformname = 'UnidaMedida';
    vwidth = '350';
    vheight = '300';
    patronModulo = 'MantenimientoEliminarUnidadMedida';
    vcenter = 't';
    vresizable = ''
    vmodal = 'true';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idUnidadMedida

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}


function eliminarUnidadMedida() {
    var idIdUnidad = $('txtidTIpoUnidad').value;
    var idUnidad = $('txtidUnidad').value;
    patronModulo = 'EliminarUnidadMedida';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idUnidad;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            //$('divMantenimientoAlmacen').update(respuesta);
            cargarTablaUnidadMedida(idIdUnidad);
            Windows.close("Div_UnidaMedida");
        }
    }
    )
}

function modificarRadioButton(idUnidadMedida) {
    var idUnidad = idUnidadMedida;
    patronModulo = 'modificarRadioButtonUnidadMedida';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + idUnidad;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            var respuesta = transport.responseText;
            cargarTablaUnidadMedida(idIdUnidad);
        }
    }
    );
}
function cargarListaAmbientesFisicos() {

    var pathLink = "p1=listaAmbientesFisicos&p2=" + document.getElementById('cboSede').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenido_detalle').update(respuesta);

        }
    });
}

function listarAmbientesFisicos() {
    //myajax.Link('../../ccontrol/control/control.php?p1=seleccionAmbientesFisicos&p2='+document.getElementById('cboSede').value,'div_ambfisicos');\"";

    var pathLink = "p1=seleccionAmbientesFisicos&p2=" + document.getElementById('cboSede').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: pathLink,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('div_ambfisicos').update(respuesta);

        }
    });
}