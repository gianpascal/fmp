//var pathRequestControl = "../../ccontrol/control/control.php";
//var pathRequestReporte="../../classReporte/reportes/pdf.php";
//var dhtmlXChart="../javascript/dhtmlxchart/dhtmlxchart.js";
//var dataset="../javascript/dhtmlxchart/testdata.js";
/*=============================================================================*/
/*========== Ajax funciones anegl generalizadas Juan Carlos Ludeña Montesinos ======*/
/*=============================================================================*/
//col=mygridx.getSelectedCellIndex();
function enviarFormulario(form, parametros, funcion, destino) {
    var data;
    if (form == "") {
        data = parametros;
    } else {
        data = parametros + "&" + $(form).serialize();
    }

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: data,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            if (destino != "")
                $(destino).update(respuesta);
            funcion += "()";
            eval(funcion);
        }
    })
}
function enviarFormularioSincronizado(form, parametros, funcion, destino) {
    var data;
    if (form == "")
        data = parametros;
    else
        data = parametros + "&" + $(form).serialize();
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: data,
        asynchronous: false,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            if (destino != "")
                $(destino).update(respuesta);
            funcion += "()";
            eval(funcion);
        }
    })
}

function traerData(parametros) {
    var datos;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            datos = respuesta.split("|");
        }
    });

    return datos;
}
//JCDB 07/07/2012
function traerDataPrueba(parametros) {
    var datos;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            datos = respuesta.split("|");
        }
    });
    return datos;
}

function verificarData(path, parametros) {//no cambiar
    var datos;
    new Ajax.Request(path, {
        method: 'post',
        parameters: parametros,
        asynchronous: false,
        onLoading: micargador(1),
        onComplete: function (transport) {
            micargador(0);
            respuesta = transport.responseText;
            datos = respuesta.split("|");
        }
    });

    return datos;
}
function enviarFormularioTraerData(form, parametros, funcion) {
    var data;
    if (form == "")
        data = parametros;
    else
        data = parametros + "&" + $(form).serialize();
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'post',
        parameters: data,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            respuesta = transport.responseText;
            funcion += "('" + respuesta + "')";
            eval(funcion);
        }
    });
}

function generarArbolx(div, parametros, funcionClick)
{
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    treex = new dhtmlXTreeObject(div, "100%", "100%", 0);
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function () {
        selectTree(treex.getSelectedItemId(), treex.getSelectedItemText(), funcionClick);
        return true;
    });
    treex.openAllItems(0);
    treex.loadXML(pathRequestControl + '?' + parametros);
}
function busquedaArbolx() {
    treex.findItem($("txtBusquedaArbolx").value);
}
function selectTree(id, text, funcionClick) {
    funcionClick += "('" + id + "','" + text + "')";
    eval(funcionClick);
}
function generarTablaSplitAt(div, parametros, funcionClick, funcionDblClick, funcionLoad, split) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridSplitAt = new dhtmlXGridObject(div);
    mygridSplitAt.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridSplitAt.setSkin("dhx_skyblue");
    mygridSplitAt.splitAt(split);
    mygridSplitAt.attachEvent("onRowSelect",
            function () {
                gridClick(mygridSplitAt.getSelectedId(), mygridSplitAt.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridSplitAt.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridSplitAt.getSelectedId(), mygridSplitAt.getSelectedCellIndex(), funcionDblClick);
                return true;
            });
    mygridSplitAt.enableRowsHover(true, 'grid_hover');
    mygridSplitAt.init();
    mygridSplitAt.attachEvent("onXLE", showLoading);
    mygridSplitAt.attachEvent("onXLS", function () {
        showLoading(true)
    });
    mygridSplitAt.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}

function showLoading(fl) {
    if (fl === true)
        micargador(1);
    else
        micargador(0);

}

function generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridx = new dhtmlXGridObject(div);
    mygridx.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridx.setSkin("dhx_skyblue");
    mygridx.attachEvent("onRowSelect",
            function () {
                gridClick(mygridx.getSelectedId(), mygridx.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridx.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridx.getSelectedId(), mygridx.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    mygridx.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    mygridx.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    mygridx.enableRowsHover(true, 'grid_hover');
    mygridx.init();
    mygridx.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}



function generarTablaCoordinadores(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridxcor = new dhtmlXGridObject(div);
    mygridxcor.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridxcor.setSkin("dhx_skyblue");
    mygridxcor.attachEvent("onRowSelect",
            function () {
                gridClick(mygridxcor.getSelectedId(), mygridxcor.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridxcor.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridxcor.getSelectedId(), mygridxcor.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    mygridxcor.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    mygridxcor.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    mygridxcor.enableRowsHover(true, 'grid_hover');
    mygridxcor.init();
    mygridxcor.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}



function generarTablaAreasSinCoordinadores(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridx = new dhtmlXGridObject(div);
    mygridx.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridx.setSkin("dhx_skyblue");
    mygridx.attachEvent("onRowSelect",
            function () {
                gridClick(mygridx.getSelectedId(), mygridx.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridx.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridx.getSelectedId(), mygridx.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    mygridx.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    mygridx.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    mygridx.enableRowsHover(true, 'grid_hover');
    mygridx.init();
    mygridx.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}

function generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridy = new dhtmlXGridObject(div);
    mygridy.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridy.setSkin("dhx_terrace");
    mygridy.attachEvent("onRowSelect",
            function () {
                gridClick(mygridy.getSelectedId(), mygridy.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridy.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridy.getSelectedId(), mygridy.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador = contadorCargador;
    mygridy.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    mygridy.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    /////////////fin cargador ///////////////////////
    mygridy.enableRowsHover(true, 'grid_hover');
    mygridy.init();
    mygridy.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}
function generarTablaxxx(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    //mygridy
    mygridxxx = new dhtmlXGridObject(div);
    mygridxxx.setImagePath("../../../imagen/dhtmlxgrid/imgs/");

    //    mygridy.setHeader("a1,a2 ,a3");

    mygridxxx.setSkin("dhx_skyblue");
    mygridxxx.attachEvent("onRowSelect",
            function () {
                gridClick(mygridy.getSelectedId(), mygridy.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridxxx.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridy.getSelectedId(), mygridy.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    mygridxxx.enableRowsHover(true, 'grid_hover');
    mygridxxx.init();
    mygridxxx.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}
function generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridz = new dhtmlXGridObject(div);
    mygridz.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridz.setSkin("dhx_skyblue");
    mygridz.attachEvent("onRowSelect",
            function () {
                gridClick(mygridz.getSelectedId(), mygridz.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridz.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridz.getSelectedId(), mygridz.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    mygridz.enableRowsHover(true, 'grid_hover');
    mygridz.init();
    mygridz.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}
function generarTablak(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridz = new dhtmlXGridObject(div);
    mygridz.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridz.setSkin("dhx_skyblue");
    mygridz.attachEvent("onRowSelect",
            function () {
                gridClick(mygridz.getSelectedId(), mygridz.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridz.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridz.getSelectedId(), mygridz.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    mygridz.enableRowsHover(true, 'grid_hover');
    mygridz.init();
    mygridz.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}
function generarTablaw(div, parametros, funcionClick, funcionDblClick) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridw = new dhtmlXGridObject(div);
    mygridw.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridw.setSkin("dhx_skyblue");
    mygridw.attachEvent("onRowSelect",
            function () {
                gridClick(mygridw.getSelectedId(), mygridw.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridw.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridw.getSelectedId(), mygridw.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    mygridw.enableRowsHover(true, 'grid_hover');
    mygridw.init();
    mygridw.loadXML(pathRequestControl + '?' + parametros);
}
function generarTablaBusquedaPopap(div, parametros, funcionClick, funcionDblClick, accion) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridBusquedaPopap = new dhtmlXGridObject(div);
    mygridBusquedaPopap.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridBusquedaPopap.setSkin("dhx_skyblue");
    mygridBusquedaPopap.attachEvent("onRowSelect",
            function () {

                gridClickBusquedaPopap(mygridBusquedaPopap.getSelectedId(), mygridBusquedaPopap.getSelectedCellIndex(), funcionClick, accion);
                return true;
            });
    mygridBusquedaPopap.attachEvent("onRowDblClicked",
            function () {
                gridDblClickBusquedaPopap(mygridBusquedaPopap.getSelectedId(), mygridBusquedaPopap.getSelectedCellIndex(), funcionDblClick, accion);
                return true;
            })
    mygridBusquedaPopap.enableRowsHover(true, 'grid_hover');
    mygridBusquedaPopap.init();
    mygridBusquedaPopap.loadXML(pathRequestControl + '?' + parametros);
}


function generarTablap(div, parametros, funcionClick, funcionDblClick, funcionLoad) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = " ";
    mygridp = new dhtmlXGridObject(div);
    mygridp.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    mygridp.setSkin("dhx_skyblue");
    mygridp.attachEvent("onRowSelect",
            function () {
                gridClick(mygridp.getSelectedId(), mygridp.getSelectedCellIndex(), funcionClick);
                return true;
            });
    mygridp.attachEvent("onRowDblClicked",
            function () {
                gridDblClick(mygridp.getSelectedId(), mygridp.getSelectedCellIndex(), funcionDblClick);
                return true;
            })
    mygridp.enableRowsHover(true, 'grid_hover');
    mygridp.init();
    mygridp.loadXML(pathRequestControl + '?' + parametros, function () {
        if (funcionLoad != "") {
            eval(funcionLoad + "()");
        }
    });
}

function gridClick(fil, col, funcion) {
    funcion += "('" + fil + "','" + col + "')";
    eval(funcion);
}

function gridDblClick(fil, col, funcion) {
    funcion += "('" + fil + "','" + col + "')";
    eval(funcion);
}
function gridClickBusquedaPopap(fil, col, funcion, accion) {
    funcion += "('" + fil + "','" + col + "','" + accion + "')";
    eval(funcion);
}

function gridDblClickBusquedaPopap(fil, col, funcion, accion) {
    funcion += "('" + fil + "','" + col + "','" + accion + "')";
    eval(funcion);
}
function generarCombo(div, parametros) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = "";
    window.dhx_globalImgPath = "../../../estilo/imgs/";
    dhtmlx.skin = "dhx_skyblue";
    cbox = new dhtmlXCombo(div, "alfa1", 180);
    cbox.readonly(1)
    cbox.loadXML(pathRequestControl + '?' + parametros)
}
function cerrarVentana(div) {
    Windows.close(div, "")
}

function MostrarReportePopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, parametros, posFuncion)
{
    vstyle = 0;
    vopacity = 0;
    veffect = '';
    vposx1 = 0;
    vposx2 = 0;
    vposy1 = 0;
    vposy2 = 0;
    myRand = parseInt(Math.random() * 999999999999999);
    if (vwidth == undefined || vwidth == 0)
        vwidth = 700;
    if (vheight == undefined || vheight == 0)
        vheight = 400;
    if (vposx1 == undefined || vposx1 == 0)
        vposx1 = 25;
    if (vposy1 == undefined || vposy1 == 0)
        vposy1 = 110;
    if (vposx2 == undefined || vposx2 == 0)
        vposx2 = 25;
    if (vposy2 == undefined || vposy2 == 0)
        vposy2 = 110;

    if (vresizable == undefined || vresizable == 0)
        vresizable = true;
    else
        vresizable = false;
    if (vstyle == undefined || vstyle == 0)
        vstyle = "alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if (vmodal == undefined || vmodal == 0)
        vmodal = false;
    else
        vmodal = true;
    if (vopacity == undefined || vopacity == 0)
        vopacity = 1;
    if (vcenter == undefined || vcenter == 0 || vcenter == 't')
        vcenter = true;
    else
        vcenter = false;
    if (vtitle == undefined)
        vtitle = vformname;
    if (!ExisteObjeto("Div_" + vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid = "Div_" + vformname;
        vidfrm = "Frm_" + vformname;
        var vzindex = 100;
        var win;
        if (vmodal == true || vmodal == 1)
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                zIndex: vzindex,
                opacity: vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title: vtitle,
                width: vwidth,
                height: vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='" + vidfrm + "'></div>";
        //'"+pathRequestReporte+"?+"+parametros+"'
        //        win.getContent().innerHTML = "<iframe id='"+vidfrm+"' width='"+vwidth+"' height='"+vheight+"' ></iframe>";
        //        var testFrame = document.getElementById(vidfrm);
        //        testFrame.src = pathRequestReporte+"?"+parametros;
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if (vcenter == true || vcenter == 1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left: vposx1,
            right: vposx2,
            top: vposy1,
            bottom: 'auto'
        })
        win.toFront();
        new Ajax.Request(pathRequestReporte,
                {
                    method: 'post',
                    parameters: parametros,
                    asynchronous: false,
                    onLoading: micargador(1),
                    onComplete: function (transport) {
                        micargador(0);
                        respuesta = transport.responseText;
                        $(vidfrm).update(respuesta);
                        posFuncion += "('')";
                        eval(posFuncion);

                    }
                }
        )
    }
}

function uploadFileHMLO(div, titulox, patronModulox, nombreFile, opcion, arrayTipoFile, rutaFile, functionPostLoad) {
    vFormaAbrir = 'VENTANA';
    vformname = 'Upload' + div;
    vtitle = titulox;
    vwidth = '430';
    vheight = '270';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    file01 = '';
    vfunctionjava = '';
    patronModulo = patronModulox;
    parametros = '';
    parametros += patronModulox;
    alert(parametros);
    //    posFuncion='executeUploadFile("'+div+'","'+nombreFile+'","'+opcion+'","'+arrayTipoFile+'","'+rutaFile+'","'+functionPostLoad+'")';
    posFuncion = 'executeUploadFile123("' + div + '","' + nombreFile + '","' + opcion + '","' + arrayTipoFile + '","' + rutaFile + '","' + functionPostLoad + '")';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function existUploadFile(nombreFile, rutaFile) {
    var nomFileFisico = $("divFileName1").innerHTML;
    var nomFileFisicoSplit = nomFileFisico.split(".");
    var extension = nomFileFisicoSplit[nomFileFisicoSplit.length - 1];//obtengo la extensión
    var parametros = "nomFile=" + nombreFile + "&rutaFile=" + rutaFile + "&extension=" + extension;
    var respuesta = verificarData("../../classUpload/existsFile.php", parametros);
    if (respuesta[0] == "ok") {
        if (window.confirm("El archivo ya existe, desea reemplazarlo ?")) {
            flagExisteFile = true;
        } else {
            Windows.close("Div_UploaddivAdjuntarHorarios", "");
            flagExisteFile = false;
        }
    } else if (respuesta[0] == "not") {
        flagExisteFile = true;
    } else if (respuesta[0] == "error") {
        alert("Se produjo un error desconocido, por favor vuelva a intentar");
        flagExisteFile = false;
    }
}
function executeUploadFile(div, nombreFile, opcion, arrayTipoFile, rutaFile, functionPostLoad) {
    alert(div + '/' + nombreFile + '' + opcion + '' + arrayTipoFile + '' + rutaFile + '' + functionPostLoad)
    fileUpload = new dhtmlXVaultObject();
    fileUpload.setImagePath("../../../estilo/imgs/");

    fileUpload.setServerHandlers("../../classUpload/UploadHandler.php?nomFile=" + nombreFile + "&opcion=" + opcion + "&rutaFile" + rutaFile, "../../classUpload/GetInfoHandler.php", "../../classUpload/GetIdHandler.php");

    var cadena = "";
    arrayTipoFile = arrayTipoFile.split(",");
    for (i = 0; i < arrayTipoFile.length; i++) {
        if (i == 0)
            cadena += arrayTipoFile[i];
        else
            cadena += " , " + arrayTipoFile[i];
    }
    fileUpload.onAddFile = function (fileName) {
        var ext = this.getFileExtension(fileName);
        var flagExt = false;
        for (i = 0; i < arrayTipoFile.length; i++) {
            if (ext == arrayTipoFile[i])
                flagExt = true;
        }
        if (!flagExt) {
            var msm = "Por favor usted puede cargar sólo los documentos ( " + cadena + " ). Por favor vuelva a intentar.";
            msm = ext == "xlsx" ? "Por favor adjunte documentos Excel 2003" : msm;
            alert(msm);
        } else {
            setTimeout(function () {
                existUploadFile(nombreFile, rutaFile);
            }, 400);
        }

        return flagExt;
    };
    fileUpload.onFileUploaded = function (file) {
        if (functionPostLoad != "")
            eval(functionPostLoad);

        alert("fille Up")
    };
    fileUpload.isDemo = true;
    fileUpload.create(div);
}

//////

function executeUploadFile123(div, nombreFile, opcion, arrayTipoFile, rutaFile, functionPostLoad) {
    alert(div + '/' + nombreFile + '' + opcion + '' + arrayTipoFile + '' + rutaFile + '' + functionPostLoad)
    alert("executeUploadFile123");
    fileUpload = new dhtmlXVaultObject();
    fileUpload.setImagePath("../../../estilo/imgs/");

    fileUpload.setFilesLimit(1);

    fileUpload.strings.btnAdd = "Agregar Foto";
    fileUpload.strings.btnUpload = "Subir Foto";
    fileUpload.strings.btnClean = "Limpiar";


    fileUpload.setServerHandlers("../../classUpload/UploadHandler.php?nomFile=" + nombreFile + "&opcion=" + opcion + "&rutaFile" + rutaFile, "../../classUpload/GetInfoHandler.php", "../../classUpload/GetIdHandler.php");
    //    fileUpload.setServerHandlers("../../classUpload/UploadHandler.php", "../../classUpload/GetInfoHandler.php", "../../classUpload/GetIdHandler.php");

    //   var cadena="";
    //    arrayTipoFile=arrayTipoFile.split(",");
    //    for(i=0;i<arrayTipoFile.length;i++){
    //        if(i==0)
    //            cadena+=arrayTipoFile[i];
    //        else
    //            cadena+=" , "+arrayTipoFile[i];
    //    }
    //
    //
    //
    //

    //subida completa
    fileUpload.onUploadComplete = function (files) {
        alert(files.length);
        var s = "";
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            s += ("id:" + file.id + ",name:" + file.name + ",uploaded:" + file.uploaded + ",error:" + file.error) + "\n";
        }
        alert(s);
    };



    //Agregar foto
    fileUpload.onAddFile = function (fileName) {

        var ext = this.getFileExtension(fileName);
        alert(ext + ': extension')
        if (ext == "jpg" || ext == "png" || ext == "bmp" || ext == "gif" || ext == "JPG") {
            alert("La extesnion es:" + ext);
            //            alert(fileName.name+'/'+fileName.id )

            return true;

        } else
            return false;

        //      alert('//'+true+'///')
    };

    //    fileUpload.onUploadComplete = function(files) { 
    //        alert("onUploadComplete");
    //      var s=""; 
    //      aler(files.length)
    //      for (var i=0; i<files.length; i++) { 
    //         var file = files[i]; 
    //         s += ("id:" + file.id + ",name:" + file.name + ",uploaded:" + file.uploaded + ",error:" + file.error)+"\n"; 
    //      } 
    //      alert(s); 
    //   }; 



    //    fileUpload.onAddFile = function(fileName){
    //        var ext = this.getFileExtension(fileName);
    //        var flagExt=false;
    //        for(i=0;i<arrayTipoFile.length;i++){
    //            if (ext == arrayTipoFile[i])
    //                flagExt=true;
    //        }
    //        if(!flagExt){
    //            var msm="Por favor usted puede cargar sólo los documentos ( "+cadena+" ). Por favor vuelva a intentar.";
    //            msm=ext=="xlsx" ? "Por favor adjunte documentos Excel 2003" : msm;
    //            alert(msm);
    //        }
    //        else{
    //            setTimeout(function() {
    //                existUploadFile(nombreFile,rutaFile);
    //            }, 400);
    //        }
    //
    //        return flagExt;
    //    };
    //
    //click en Upload
    //    fileUpload.onFileUploaded = function(file){
    //        if(functionPostLoad != "")
    //            eval(functionPostLoad);
    //        
    //        alert("fille Up")
    //    };
    //subir foto
    fileUpload.onFileUploaded = function (fileName) {
        //        id:3,name:tubo.jpg,uploaded:false,error:true
        alert("id:" + fileName.id + ",name:" + fileName.name + ",uploaded:" + fileName.uploaded + ",error:" + fileName.error);
    };



    fileUpload.isDemo = true;
    fileUpload.create(div);


    fileUpload.setFormField("customerId", "PS104");
    fileUpload.setFormField("country", "UK");
    fileUpload.setFormField("groupId", null); // will remove this field from the form 
}


//alert("funcionClick"+funcionClick+" fil"+fil+" col"+col);
/*
 var dateFrom=null;
 var dateTo=null;
 function calendarioFromHtmlx(id1){
 selectDate1(dateTo);
 window.dhx_globalImgPath = "../dhtmlxCalendar/";
 dhtmlxCalendarLangModules = new Array();
 dhtmlxCalendarLangModules['es'] = {
 langname: 'es',
 monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
 monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
 daysFNames: ["Domingo","Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
 daysSNames: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
 weekend: [0, 6],
 weekstart: 1,
 msgClose: "Cerrar",
 msgMinimize: "Minimizar",
 msgToday: "Hoy"
 }
 
 mCal1 = new dhtmlxCalendarObject(id1, false, {
 isMonthEditable: true,
 isYearEditable: true,
 dateformat: '%d/%m/%Y'
 
 });
 //    mCal1.setOnClickHandler(selectDate1);
 mCal1.setYearsRange(1900, 2020);
 mCal1.loadUserLanguage('es');
 mCal1.attachEvent("onClick", function(date) {
 dateFrom= new Date(date);
 fecha =  dateFrom.getDate()+"/"+dateFrom.getMonth() + "/" +dateFrom.getFullYear();
 });
 
 mCal1.draw();
 }
 function selectDate1(dateTox){
 alert("date1");
 if(dateTox!=null)
 mCal1.setSensitive(dateTox,null);
 }
 function selectDate2(dateFromx){
 alert("date2");
 if(dateFromx!=null && dateTo!=null)
 mCal2.setSensitive(dateFromx,dateTo);
 //    dateFrom=null;
 //    dateTo=null;
 }
 function calendarioToHtmlx(id1,id2){
 //    txtFechaIni=$(id1).value;
 //    variable=txtFechaIni.split("/")
 //    toFecha=variable[2]+"."+variable[1]+"."+variable[0];
 selectDate2(dateFrom);
 window.dhx_globalImgPath = "../dhtmlxCalendar/";
 dhtmlxCalendarLangModules = new Array();
 dhtmlxCalendarLangModules['es'] = {
 langname: 'es',
 monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
 monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
 daysFNames: ["Domingo","Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
 daysSNames: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
 weekend: [0, 6],
 weekstart: 1,
 msgClose: "Cerrar",
 msgMinimize: "Minimizar",
 msgToday: "Hoy"
 }
 
 mCal2 = new dhtmlxCalendarObject(id2, false, {
 isMonthEditable: true,
 isYearEditable: true,
 dateformat: '%d/%m/%Y'
 
 });
 //    mCal2.setOnClickHandler(selectDate2);
 mCal2.setYearsRange(1900, 2020);
 mCal2.loadUserLanguage('es');
 //    mCal2.setSensitive(dateFrom,dateTo);
 mCal2.attachEvent("onClick", function(date) {
 dateTo = new Date(date);
 fecha =  dateTo.getDate()+"/"+dateTo.getMonth() + "/" +dateTo.getFullYear();
 });
 mCal2.draw();
 
 }
 */


/*========================================================================*/
/*========================================================================*/
var campoReporte = ["txtNomReporte", "cboEstadoReporte"];
var campoEtiqueta = ["txtNomEtiqueta", "cboEstadoEtiqueta", "cboTpoReporteDetalle", "txtOrdenEtiqueta"];
var campoAtributo = ["txtNomAtributo", "cboEstadoAtributo", "cboAtributo"];

function limpiarFormulario(form) {
    $(form).reset();
    switch (form) {
        case 'formReporte':
            habilitarCampos(campoReporte);
            document.getElementById("divBtnGrabarReporte").style.display = 'block';
            document.getElementById("divBtnEditarReporte").style.display = 'none';
            document.getElementById("divBtnModificarReporte").style.display = 'none';
            $("hidIdReporte").value = ""
            break;
        case 'formEtiqueta':
            habilitarCampos(campoEtiqueta);
            document.getElementById("divBtnGrabarEtiqueta").style.display = 'block';
            document.getElementById("divBtnEditarEtiqueta").style.display = 'none';
            document.getElementById("divBtnModificarEtiqueta").style.display = 'none';
            $("hidIdEtiqueta").value = "";
            break;
        case 'formAtributo':
            habilitarCampos(campoAtributo);
            document.getElementById("divBtnGrabarAtributo").style.display = 'block';
            document.getElementById("divBtnEditarAtributo").style.display = 'none';
            document.getElementById("divBtnModificarAtributo").style.display = 'none';
            $("hidIdAtributo").value = "";
            $("editaAtributoFormato").style.display = 'none';
            break;
    }
}

function tabsMantenimietoReporte(activado) {
    var divTabs = ["mrTab1", "mrTab2", "mrTab3"];
    var idMenu = ["men1", "men2", "men3"];
    iniTabs(divTabs, idMenu, activado);
}

function mantenimientoReporte(form, opt, hacer) {
    var parametros;
    var funcion;
    switch (opt) {
        case 'reporte':
            if (hacer == "editar") {
                document.getElementById("divBtnGrabarReporte").style.display = 'none';
                document.getElementById("divBtnEditarReporte").style.display = 'none';
                document.getElementById("divBtnModificarReporte").style.display = 'block';
                habilitarCampos(campoReporte);
            } else {
                funcion = "deshabilitarReporte";
                parametros = "p1=grabarReporte&p2=" + hacer;
                enviarFormularioTraerData(form, parametros, funcion);
            }
            break;
        case 'etiqueta':
            if (hacer == "editar") {
                document.getElementById("divBtnGrabarEtiqueta").style.display = 'none';
                document.getElementById("divBtnEditarEtiqueta").style.display = 'none';
                document.getElementById("divBtnModificarEtiqueta").style.display = 'block';
                habilitarCampos(campoEtiqueta);
            } else {
                idReporte = $("hidIdReporte").value;
                if (hacer == "grabar" && idReporte == "") {
                    alert("Por Favor Registre un Nuevo Reporte o Seleccion uno ya Existente ...!");
                    return;
                }
                funcion = "postGrabarEtiqueta";
                parametros = "p1=grabarEtiqueta&p2=" + idReporte + "&p3=" + hacer;
                enviarFormularioTraerData(form, parametros, funcion);
            }
            break;
        case 'atributo':
            if (hacer == "editar") {
                document.getElementById("divBtnGrabarAtributo").style.display = 'none';
                document.getElementById("divBtnEditarAtributo").style.display = 'none';
                document.getElementById("divBtnModificarAtributo").style.display = 'block';
                habilitarCampos(campoAtributo);
            } else {
                funcion = "postGrabarAtributo";
                parametros = "p1=grabarAtributoFormato&p2=" + hacer;
                enviarFormulario(form, parametros, funcion, "");
            }
            break;
    }

}
function deshabilitarReporte(respuesta) {
    datos = respuesta.split("|");
    if (datos[0] != "") {
        $("hidIdReporte").value = datos[0];
    }
    document.getElementById("divBtnGrabarReporte").style.display = 'none';
    document.getElementById("divBtnEditarReporte").style.display = 'block';
    document.getElementById("divBtnModificarReporte").style.display = 'none';
    deshabilitarCampos(campoReporte);
    arbolReporte();
}
function arbolReporte() {
    //    idVersion=document.getElementById("cboVersion").value;
    //    parametros="p1=arbolHCFechas";
    parametros = "p1=arbolReporte";
    funcionClick = "editarReporte";
    div = "divTreeReporte";
    generarArbolx(div, parametros, funcionClick);
}

function editarReporte(id, text) {//se edita los datos cuando se selecciona el arbol
    parametros = "p1=editarReporte&p2=" + id;
    //    funcion="editarDatosReporte";
    if (/^[0-9]+$/.test(id)) {
        datos = traerData(parametros);//invocando al ajax para traer data
        $("hidIdReporte").value = datos[0];
        $("txtNomReporte").value = datos[1];
        $("cboEstadoReporte").value = datos[2];
        tabsMantenimietoReporte("men1");//activar el menu del tabs 1
        deshabilitarCampos(campoReporte);
        document.getElementById("divBtnGrabarReporte").style.display = 'none';
        document.getElementById("divBtnEditarReporte").style.display = 'block';
        document.getElementById("divBtnModificarReporte").style.display = 'none';
    } else {
        $("hidIdReporte").value = "";
        $("txtNomReporte").value = "";
        $("cboEstadoReporte").value = "";
    }
    limpiarFormulario("formEtiqueta");
    limpiarFormulario("formAtributo");
}

function postGrabarEtiqueta(respuesta) {
    datos = respuesta.split("|");
    if (datos[0] != "")
        $("hidIdEtiqueta").value = datos[0];

    if ($("hidIdEtiqueta").value != "") {
        deshabilitarCampos(campoEtiqueta);
        document.getElementById("divBtnGrabarEtiqueta").style.display = 'none';
        document.getElementById("divBtnEditarEtiqueta").style.display = 'block';
        document.getElementById("divBtnModificarEtiqueta").style.display = 'none';
    }
    idReporte = $("hidIdReporte").value;
    if (idReporte != "") {
        parametros = "p1=listaEtiqueta&p2=" + idReporte;
        div = "divListaEtiqueta";
        funcionClick = "editarEtiqueta";//editar los datos de la etiqueta
        funcionDblClick = "";
        funcionLoad = "";
        generarTablax(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    }
}

function listaEtiqueta(form) {
    //    $(form).reset();
    this.postGrabarEtiqueta("");
}

function editarEtiqueta(fil, col) {
    deshabilitarCampos(campoEtiqueta);
    document.getElementById("divBtnGrabarEtiqueta").style.display = 'none';
    document.getElementById("divBtnEditarEtiqueta").style.display = 'block';
    document.getElementById("divBtnModificarEtiqueta").style.display = 'none';
    idEtiqueta = mygridx.cells(fil, 0).getValue();  //se esta usando la funcion generarTablax
    nomEtiqueta = mygridx.cells(fil, 2).getValue();
    stdEtiqueta = mygridx.cells(fil, 3).getValue();
    idTipoReporteDetalle = mygridx.cells(fil, 4).getValue();
    idReporteDetalle = mygridx.cells(fil, 5).getValue();
    orden = mygridx.cells(fil, 6).getValue();
    $("hidIdEtiqueta").value = idEtiqueta;
    $("hidIdReporteDetalle").value = idReporteDetalle;
    $("txtNomEtiqueta").value = nomEtiqueta;
    $("cboEstadoEtiqueta").value = stdEtiqueta;
    $("txtOrdenEtiqueta").value = orden;
    $("cboTpoReporteDetalle").value = idTipoReporteDetalle;
}

function postGrabarAtributo() {
    //llamar tabla de Atributos
    if ($("hidIdAtributo").value != "") {
        deshabilitarCampos(campoAtributo);
        document.getElementById("divBtnGrabarAtributo").style.display = 'none';
        document.getElementById("divBtnEditarAtributo").style.display = 'block';
        document.getElementById("divBtnModificarAtributo").style.display = 'none';
    }
    parametros = "p1=listaAtributos";
    div = "divListaAtributos";
    funcionClick = "editarAtributo";//editar los datos de la Atributo
    funcionDblClick = "";
    funcionLoad = "";
    generarTablay(div, parametros, funcionClick, funcionDblClick, funcionLoad);
}
function listaAtributos(form) {
    //    $(form).reset();
    this.postGrabarAtributo();
}
function editarAtributo(fil, col) {
    deshabilitarCampos(campoAtributo);
    idAtributo = mygridy.cells(fil, 0).getValue();  //se esta usando la funcion generarTablay
    nomAtributo = mygridy.cells(fil, 1).getValue();
    stdAtributo = mygridy.cells(fil, 2).getValue();
    tpoAtributo = mygridy.cells(fil, 3).getValue();
    document.getElementById("divBtnGrabarAtributo").style.display = 'none';
    document.getElementById("divBtnEditarAtributo").style.display = 'block';
    document.getElementById("divBtnModificarAtributo").style.display = 'none';
    $("hidIdAtributo").value = idAtributo;
    $("txtNomAtributo").value = nomAtributo;
    $("cboEstadoAtributo").value = stdAtributo;
    $("cboAtributo").value = tpoAtributo;
    $("editaAtributoFormato").style.display = 'none';
    if (tpoAtributo == 1) {//tpoAtributo==1 --> atributo tipo multi valor
        $("editaAtributoFormato").style.display = 'block';
    }
}

function abrirVentanaTipoAtributo(opt) {
    tpoAtributo = $("cboAtributo").value;
    if (tpoAtributo == 1) {
        nomAtributo = $("txtNomAtributo").value;
        idAtributo = $("hidIdAtributo").value;
        if (nomAtributo == "") {
            $("txtNomAtributo").focus();
            $("cboAtributo").value = "";
            alert("Ud. No a escrito el nombre o a restaurado uno ya guardado");
            return;
        } else {
            //    var x=combo.options[combo.selectedIndex].text;
            vformname = 'TipoAtributo';
            vtitle = 'Registrar Valores';
            vwidth = '400';
            vheight = '300';
            patronModulo = 'tipoAtributoFormato';
            vcenter = 't';
            vresizable = ''
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + idAtributo + '&p3=' + opt;
            posFuncion = "postAbrirVentanaTipoAtributo";
            CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)
        }
    }
}
function postAbrirVentanaTipoAtributo() {
    if (document.getElementById("hidIdComboAtributo[1]")) {
        document.getElementById("nuevoCombo").style.display = 'none';
        document.getElementById("modificarCombo").style.display = 'block';
    } else {
        document.getElementById("nuevoCombo").style.display = 'block';
        document.getElementById("modificarCombo").style.display = 'none';
    }
}
function agregaItemsCombo(id, kk) {

    tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    row = document.createElement("tr");
    td1 = document.createElement("td");
    td2 = document.createElement("td");
    td3 = document.createElement("td");
    td4 = document.createElement("td");
    caja1 = document.createElement("input");
    caja2 = document.createElement("input");
    link = document.createElement("a");
    img = document.createElement("img");
    sel1 = document.createElement("select");
    sel2 = document.createElement("select");
    val = $('divValorCombo').innerHTML;
    cadena = new Array();
    kk = parseInt(val) + 1;

    $('divValorCombo').innerHTML = kk;

    txtTexto = "txtTexto[" + kk + "]";
    txtValue = "txtValue[" + kk + "]";
    img.src = "../../../imagen/inicio/eliminar.gif";
    link.setAttribute("href", "#");
    if (navigator.userAgent.indexOf("MSIE") != -1)
        link.setAttribute("onclick", function () {
            eliminaRowComboAtributo(kk)
        });
    else
        link.setAttribute("onclick", "eliminaRowComboAtributo(" + kk + ");");

    caja1.setAttribute("type", "text");
    caja1.setAttribute("id", txtTexto);
    caja1.setAttribute("name", txtTexto);
    caja1.setAttribute("value", '');
    caja1.setAttribute("style", "width:100px;");

    caja2.setAttribute("type", "text");
    caja2.setAttribute("id", txtValue);
    caja2.setAttribute("name", txtValue);
    caja2.setAttribute("value", kk);
    caja2.setAttribute("size", "3");
    row.setAttribute("id", "rowMasCombo" + kk);

    td2.appendChild(caja2);
    td3.appendChild(caja1);
    link.appendChild(img)
    td1.appendChild(link);
    row.appendChild(td3);
    row.appendChild(td2);
    row.appendChild(td1);
    tbody.appendChild(row);
}
function eliminaRowComboAtributo(kk) {
    el = document.getElementById('rowMasCombo' + kk);
    padre = el.parentNode;
    padre.removeChild(el);
    $('divValorCombo').innerHTML = kk - 1;
}

function grabarAtributoCombo(form, opt) {
    var parametros;
    var funcion;
    switch (opt) {
        case 'grabar':
            /*============ grabar Atributo Formato =============*/
            idAtributo = $("hidIdAtributo").value;
            nomAtributo = $("txtNomAtributo").value;
            stdAtributo = $("cboEstadoAtributo").value;
            tpoAtributo = $("cboAtributo").value;
            /*==================================================*/
            funcion = "postGrabarAtributoCombo";
            parametros = "p1=grabarAtributoCombo&p2=" + idAtributo + "&p3=" + nomAtributo;
            parametros += "&p4=" + stdAtributo + "&p5=" + tpoAtributo + "&p6=" + opt;
            enviarFormulario(form, parametros, funcion, "");
            break;
        case 'modificar':
            /*================================================*/
            idAtributo = $("hidIdAtributo").value;
            funcion = "";
            parametros = "p1=modificarAtributoCombo&p2=" + idAtributo + "&p3=" + opt;
            enviarFormulario(form, parametros, funcion, "");
            break;
    }
}

function postGrabarAtributoCombo() {
    Windows.close("Div_TipoAtributo", "");
    this.postGrabarAtributo();
}

function eliminaDbComboAtributo(val) {
    idComboAtributo = document.getElementById("hidIdComboAtributo[" + val + "]").value;
    idAtributo = document.getElementById("hidIdAtributo").value;
    txtTexto = document.getElementById("txtTexto[" + val + "]").value;
    funcion = "cerrarVentana('Div_TipoAtributo')";
    parametros = "p1=eliminaDbComboAtributo&p2=" + idAtributo + "&p3=" + idComboAtributo;
    if (window.confirm("Desea eliminar  el campo : " + txtTexto + " ?")) {
        enviarFormulario("", parametros, funcion, "");
    }

}

function asignarEtiquetaAtributo() {
    idReporte = $("hidIdReporte").value;
    idEtiqueta = $("hidIdEtiqueta").value;
    if (idReporte == "") {
        alert("Por Favor Registre un Nuevo Reporte o Seleccion uno ya Existente ...!");
        return;
    }
    if (idEtiqueta == "") {
        alert("Seleccione una Etiqueta o registre uno nuevo ...!");
        return;
    }
    vformname = 'EtiquetaAtributo';
    vtitle = 'Asignar Etiqueta a Atributos';
    vwidth = '500';
    vheight = '500';
    patronModulo = 'asignarEtiquetaAtributo';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    //    parametros+='&p2='+idAtributo+'&p3='+opt;
    posFuncion = "otraTablaEtiqueta";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)


//    alert("wwwwwwwwww");
}

function otraTablaEtiqueta() {
    parametros = "p1=listaAsignarAtributos";
    div = "divListaAtributosx";
    funcionClick = "verificarAtributoCombo";//editar los datos de la Atributo
    funcionDblClick = "";
    funcionLoad = "";
    generarTablaz(div, parametros, funcionClick, funcionDblClick, funcionLoad);
    this.listaEtiquetaAtributo();
}

function verificarAtributoCombo(fil, col) {
    idTipoAtributoFormato = mygridz.cells(fil, 3).getValue();
    nomTipoAtributoFormato = mygridz.cells(fil, 1).getValue();
    idAtributo = mygridz.cells(fil, 0).getValue();
    $("hidIdAtributox").value = idAtributo;
    $("hidTipoAF").value = idTipoAtributoFormato;
    if (idTipoAtributoFormato == 1) {
        /*==========================*/
        divMostrar = document.getElementById("divInputText");
        divMostrar.innerHTML = "";
        /*==========================*/
        div = "comboAtributo";
        document.getElementById("divCombo").style.display = 'block';
        parametros = "p1=cargarAtributoCombo&p2=" + idAtributo;
        generarCombo(div, parametros);
    } else {
        /*==========================*/
        divMostrar = document.getElementById("comboAtributo");
        divMostrar.innerHTML = "";
        /*==========================*/

        div = "divInputText";
        document.getElementById("divCombo").style.display = 'block';
        if (nomTipoAtributoFormato == "Color")
            creaCampoAtributo(div, 1);
        else
            creaCampoAtributo(div, "");

        //        document.getElementById("divCombo").style.display='none';
        //getSelectedValue()
    }

}
function creaCampoAtributo(div, otro) {
    divMostrar = document.getElementById(div);
    divMostrar.innerHTML = "";
    capa = document.getElementById(div);
    caja1 = document.createElement("input");
    caja1.setAttribute("type", "text");
    caja1.setAttribute("id", "txtValorAtributo");
    caja1.setAttribute("name", "txtValorAtributo");
    caja1.setAttribute("value", '');
    caja1.setAttribute("style", "width:100px;");
    if (otro == 1) {
        if (navigator.userAgent.indexOf("MSIE") != -1)
            caja1.setAttribute("onclick", function () {
                elegirColor()
            });
        else
            caja1.setAttribute("onclick", "elegirColor();");
        caja1.setAttribute("value", 'Elegir Color');
    }
    capa.appendChild(caja1);
}

function grabarEtiquetaAtributo(opt) {
    switch (opt) {
        case 'grabar':
            if ($("hidTipoAF").value == 0) {//textVale --> es el valor que se almacena en vValor de la tabla nsdEtiquetaAtributoFormato
                textVale = $("txtValorAtributo").value;
                textVale = textVale.replace(/#/g, 'jclm63');
            } else if ($("hidTipoAF").value == 1) {
                if (cbox.getSelectedValue() == "") {
                    alert("Por Favor Seleccione un Valor ...!");
                    return;
                }
                textVale = cbox.getSelectedText();
            }
            idAtributo = $("hidIdAtributox").value;//mygridz.cells(fil,0).getValue();
            idEtiqueta = $("hidIdEtiqueta").value;
            idTipoEtiquetaAtributo = $("cboTipoEtiquetaAtributo").value;
            funcion = "postGrabarEtiquetaAtributo";
            parametros = "p1=grabarEtiquetaAtributo&p2=" + idAtributo;
            parametros += "&p3=" + idEtiqueta + "&p4=" + textVale + "&p5=" + idTipoEtiquetaAtributo;
            if (idTipoEtiquetaAtributo == "") {
                alert("Por favor elija el Tipo");
                return;
            }
            enviarFormulario("", parametros, funcion, "");
            break;
        case 'modificar':
            idEtiquetaAtributo = $("hidIdEtiquetaAtributo").value;
            idTipoEtiquetaAtributo = $("cboTipoEtiquetaAtributox").value;
            txtValor = $("txtValor").value;
            txtValor = txtValor.replace(/#/g, 'jclm63');
            document.getElementById("divEditarEtiquetasAtributos").style.display = 'none';
            document.getElementById("divmsj").style.display = 'block';
            funcion = "postGrabarEtiquetaAtributo";
            parametros = "p1=modificarEtiquetaAtributo&p2=" + idEtiquetaAtributo;
            parametros += "&p3=" + txtValor + "&p4=" + idTipoEtiquetaAtributo;
            if (idTipoEtiquetaAtributo == "") {
                alert("Por favor elija el Tipo");
                return;
            }
            enviarFormulario("", parametros, funcion, "");
            break;
    }
}
function listaEtiquetaAtributo() {
    idEtiqueta = $("hidIdEtiqueta").value;
    parametros = "p1=listaEtiquetaAtributo&p2=" + idEtiqueta;
    div = "divEtiquetasAtributos";
    funcionClick = "activa_desactivaEtiquetaAributo";//editar los datos de la Atributo
    funcionDblClick = "editarEtiquetaAributo";
    generarTablaw(div, parametros, funcionClick, funcionDblClick);
}
function postGrabarEtiquetaAtributo() {
    this.listaEtiquetaAtributo();
}

function activa_desactivaEtiquetaAributo(fil, col) {
    if (col == 8) {
        idEtiquetaAtributo = mygridw.cells(fil, 0).getValue();
        estado = mygridw.cells(fil, 6).getValue();
        if (window.confirm("Esta Seguro que Desea Eliminar Esta Asignación ?")) {
            funcion = "listaEtiquetaAtributo";
            parametros = "p1=switchEtiquetaAtributo&p2=" + idEtiquetaAtributo + "&p3=" + estado;
            enviarFormulario("", parametros, funcion, "");
        }
    }
}
function editarEtiquetaAributo(fil, col) {
    $("hidIdEtiquetaAtributo").value = mygridw.cells(fil, 0).getValue();
    $("txtValor").value = mygridw.cells(fil, 3).getValue();
    $("cboTipoEtiquetaAtributox").value = mygridw.cells(fil, 4).getValue();
    document.getElementById("divEditarEtiquetasAtributos").style.display = 'block';
    document.getElementById("divmsj").style.display = 'none';
}

/** ================ imprimir receta ==================**/
//function imprimirRecetaAtencion(){
//codigoProgramacion=$("hcodigoProgramacion").value;
//parametros="p1=imprimirRecetaMedica&p2="+codigoProgramacion;
//respuesta=traerData(parametros);
//if(respuesta[0]=="NO"){
//    alert("No se ha registrado ninguna receta médica para esta consulta");
//}
//else{
//    codigoPaciente=$("htxtcodigopaciente").value;
//    datos="p1="+codigoProgramacion+"&p2="+codigoPaciente;
//    location.href="../../classReporte/reportes/recetaMedica.php?"+datos;
//}
//}
function elegirColor() {
    vformname = 'seleccionarColor';
    vtitle = 'Elegir Color';
    vwidth = '360';
    vheight = '275';
    patronModulo = 'seleccionarColor';
    vcenter = 't';
    vresizable = ''
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    posFuncion = "";
    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}
function seleccionarColor() {
    color = $("hex").value;
    color = color.substring(1, 8);
    $("txtValorAtributo").setAttribute("style", "background-color: " + color + ";");
    $("txtValorAtributo").value = color;
    Windows.close("Div_seleccionarColor", "")
}

function imprimirRecetaAtencion() {
    codigoProgramacion = $("hcodigoProgramacion").value;
    parametros = "p1=imprimirRecetaMedica&p2=" + codigoProgramacion;
    respuesta = traerData(parametros);
    if (respuesta[0] == "NO") {
        alert("No se ha registrado ninguna receta médica para esta consulta");
    } else {
        var idReporte = 1; //OJOOOOOOOOOOO este valor mas adelante va hacer variable
        var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
        codigoPaciente = $("htxtcodigopaciente").value;
        codigoMedico = $("txtcodigoMedico").value;
        datos = "p1=recetaMedica&p2=" + modo;
        datos += "&p3=" + codigoProgramacion + "&p4=" + codigoPaciente + "&p5=" + codigoMedico + "&p6=" + idReporte;
        //----------------------------------------------------------------------------------
        vformname = 'RecetaAtencion';
        vtitle = 'Receta Médica';
        vwidth = '950';
        vheight = '700';
        vcenter = 't';
        vresizable = ''
        vmodal = 'false';
        posFuncion = "";
        MostrarReportePopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, datos, posFuncion);
        //===========================================================================================================
    }
}
function imprimirRecetaUnicaEstandarizadaTodas() {
    var codigoProgramacion = $("hcodigoProgramacion").value;
    var patronModulo = 'cadenaRecetas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigoProgramacion;
    //parametros+='&p3='+proximacitasugerida;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);

            var respuesta = transport.responseText;
            //alert(respuesta)
            var arregloRecetas = respuesta.split("|");
            var numeroRecetas = arregloRecetas.length - 1;
            var i
            var tipoReceta;
            for (i = 0; i < numeroRecetas; i++) {
                tipoReceta = arregloRecetas[i].split("*");
                if (tipoReceta[1] == 1) {
                    imprimirRecetaUnicaEstandarizada(tipoReceta[0])
                }
                if (tipoReceta[1] == 2) {
                    imprimirOrdenMedica(tipoReceta[0])
                }

            }
            ImprimirHCXdia(codigoProgramacion);
            //imprimirRecetaUnicaEstandarizadaTodas();
        }
    })
}
function imprimirRecetaUnicaEstandarizada(idReceta) {
    //codigoProgramacion=$("hcodigoProgramacion").value;    //  '3709814';
    var parametros = "p1=imprimirRecetaMedica&p2=" + idReceta;
    var idReporte = 4; //OJOOOOOOOOOOO este valor mas adelante va hacer variable
    var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
    var codigoPersona = $("htxtcodigopaciente").value;  // '0457912'  para el paciente
    var codigoMedico = ""; // '0324523';
    var datos = "p1=recetaUnicaEstandarizada&p2=" + modo;
    datos += "&p3=" + idReceta + "&p4=" + codigoPersona + "&p5=" + codigoMedico + "&p6=" + idReporte;
    ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);

}
function imprimirOrdenMedica(idReceta) {
    //codigoProgramacion=$("hcodigoProgramacion").value;    //  '3709814';
    var parametros = "p1=imprimirRecetaMedica&p2=" + idReceta;
    var idReporte = 6; //OJOOOOOOOOOOO este valor mas adelante va hacer variable
    var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
    var codigoPersona = $("htxtcodigopaciente").value;  // '0457912'  para el paciente
    var codigoMedico = $("txtcodigoMedico").value; // '0324523';
    var datos = "p1=recetaOrdenMedica&p2=" + modo;
    datos += "&p3=" + idReceta + "&p4=" + codigoPersona + "&p5=" + codigoMedico + "&p6=" + idReporte;
    ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);

}

function imprimirTicketOrdenMedica(idTratamiento) {


    //window.alert(cadena);

    var idReporte = 7;
    var codigoPersona = $("htxtcodigopaciente").value;  // '0457912'  para el paciente
    //var codigoMedico=$("txtcodigoMedico").value;
    var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
    var datos = "p1=ticketOrdenMedica&p2=" + modo;
    datos += "&p3=" + idReporte;
    datos += "&p4=" + idTratamiento;
    datos += "&p5=" + codigoPersona;

    //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
    var ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);


}
function imprimirTicketCita() {
    if (document.getElementById("hidDatosCita")) {

        var cadena = $("hidDatosCita").value;
        //alert(cadena);
        //window.alert(cadena);
        var ordenCita = $("hidNroOrden").value;
        var arraydatos = ordenCita + "|" + cadena;
        var idReporte = 2;
        var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
        var datos = "p1=ticketCita&p2=" + modo;
        datos += "&p3=" + arraydatos + "&p4=" + idReporte;
        //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
        ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
        window.open(ruta);
    } else {
        alert("Por favor especifique la CITA ...");
    }

}

function ImprimirHCXdia(idProgramacion) {
    console.log('entroooooooooooooo');
    console.log(idProgramacion);
    parametros = "p1=verificarHistoriaClinicaXDia&p2=" + idProgramacion;
    var datosHC = traerData(parametros);
    if (datosHC[0] == "NO_DATA") {
        alert("El paciente no tiene registrado su historia clinica  en el sistema ...");
    } else {
        var idReporte = 10;
        var modo = 1;
        var codigoPersona = $("htxtcodigopaciente").value;
        datos = "p1=historiaClinicaXDia&p2=" + modo;
        datos += "&p3=" + codigoPersona + "&p4=" + idReporte + "&p5=" + datosHC[0] + "&p6=" + idProgramacion;
        ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
        window.open(ruta);
    }
}


function mostrarHistoriaClinica(idPer) {
    console.log(idPer);
    if (idPer > 0) {
        console.log('entro1');
        idpersona = "000" + idPer;
    } else if (idPer = 'undefined') {
        console.log('entro2');
        idpersona = $("txtCodigoPersona").value;
        console.log(idpersona);
    }
    console.log(idpersona);
    if (idpersona == "") {
        alert("Por favor seleccione una persona .");
    } else {
        parametros = "p1=verificarHistoriaClinica&p2=" + idpersona;
        var datosHC = traerData(parametros);
        if (datosHC[0] == "NO_DATA") {
            alert("El paciente no tiene registrado su historia clinica  en el sistema ...");
        } else {
            //            alert(datosHC[0]+" - "+datosHC[1]);

            var idReporte = 3;
            var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
            datos = "p1=historiaClinica&p2=" + modo;
            datos += "&p3=" + datosHC[1] + "&p4=" + idReporte + "&p5=" + datosHC[0]; //datosHC[0]-->codigo paciente
            //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
            ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
            window.open(ruta);
            //===========================================================================================================
            //Modificado por Luis para q ya no se muestre en un pop-up sino en una pestaña aparte..el motivo xq se demora mucho al cargar.            
            //            vformname='SedeEmpresaArea';
            //            vtitle='Reporte de Historia clinica';
            //            vwidth='950';
            //            vheight='700';
            //            vcenter='t';
            //            vresizable=''
            //            vmodal='false';
            //            posFuncion = "";
            //            MostrarReportePopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, datos, posFuncion);
            //===========================================================================================================
        }
    }
}

function formatoLaboratorio(idCodExamen) {
    var idReporte = 8;
    var modo = 1;
    var codPacienteLab = idCodExamen;
    var datos = "p1=formatolaboratorio&p2=" + modo;
    datos += "&p3=" + idReporte
    datos += "&p4=" + codPacienteLab
    ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);
}

function imprimirRecibo(numerorecibo) {
    if (numerorecibo == "") {
        alert("Recibo de pago no seleccionado.");
    } else {
        parametros = "p1=verificarRecibodePago&p2=" + numerorecibo;
        var datosRecibo = traerData(parametros);
        if (datosRecibo == "NOEXISTE") {
            alert("No existe el numero de recibo de pago");
        } else {
            var idReporte = 5;
            var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
            datos = "p1=recibodepago&p2=" + modo;
            datos += "&p3=" + numerorecibo + "&p4=" + idReporte;
            //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
            ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
            window.open(ruta);
        }
    }
}

function imprimirComprobante(numerorecibo, codigoEmpleado) {
    alert(codigoEmpleado + '');
    if (numerorecibo == "") {
        alert("Recibo de pago no seleccionado.");
    } else {
        parametros = "p1=recibodepagoImprimir&p2=" + numerorecibo + "&p3=" + codigoEmpleado;
        var datosRecibo = traerData(parametros);
        if (datosRecibo == "NOEXISTE") {
            alert("No existe el numero de recibo de pago");
        } else {
            var idReporte = 5;
            var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
            datos = "p1=recibodepagoImprimir&p2=" + modo;
            datos += "&p3=" + numerorecibo + "&p4=" + idReporte + "&p5=" + codigoEmpleado;
            //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
            ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
            window.open(ruta);
        }
    }

}

function cargarEstadisticas() {
    debugger;
    $('Dia2').show();
    $('Dia').show();
    $('Mes').hide();
    $('Year').hide();
    $('Mes2').hide();
    $('Year2').hide();
    $('Semestral').hide();
    $('YearSe').hide();
    $('Trimestral').hide();
    $('YearTre2').hide();
    $('Trimestral2').hide();
    $('YearTre').hide();
    $('Anual').hide();
    $('Semestral2').hide();
    $('YearSe2').hide();
    $('Anual2').hide();
    $('contenedorfiltros10').update('<img src="../../../imagen/graficos/bar.bmp">');
    $('grafico').value = "bar";
    $('con1').hide();
    $('con2').hide();
    $('con3').hide();
    $('con4').hide();
    $('con5').hide();
    $('con6').hide();
    $('con7').hide();
    $('con8').hide();
    $('con9').hide();
    $('con10').show();
    var contenedor="";
    var contenedorLeyenda="";
    for (var x = 1; x <= 50; x++) {
        contenedor="contenedorgraficotabla" + x;
        contenedorLeyenda="contenedorTablaLeyenda" + x;
        $(contenedor).hide();
        $(contenedorLeyenda).hide();

    }
}

function imprimirCarnetSanidad(DNI, nombreCompleto, tipoCertificado, c_cod_per, apellidos, nombre, fechaActual, fechaCaducidad) {

    var idReporte = 9; //OJOOOOOOOOOOO este valor mas adelante va hacer variable    
    var modo = 1; // modo de impresion de reporte --> (1=>label y datos, 0=>solo datos)
    var datos = "p1=carnetSanidad&p2=" + modo;
    datos += "&p3=" + DNI;
    datos += "&p4=" + nombreCompleto;
    datos += "&p5=" + tipoCertificado;
    datos += "&p6=" + c_cod_per;
    datos += "&p7=" + idReporte;
    datos += "&p8=" + apellidos;
    datos += "&p9=" + nombre;
    datos += "&p10=" + fechaActual;
    datos += "&p11=" + fechaCaducidad;
    //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
    var ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);

}

function MostrarDivDeBusqueda(id) {
    switch (id)
    {
        case '1':
            $('Mes2').hide();
            $('Year2').hide();
            $('Dia2').show();
            $('Dia').show();
            $('Trimestral').hide();
            $('Mes').hide();
            $('Year').hide();
            $('Semestral').hide();
            $('YearSe').hide();
            $('YearTre').hide();
            $('Anual').hide();
            $('YearTre2').hide();
            $('Trimestral2').hide();
            $('Semestral2').hide();
            $('YearSe2').hide();
            $('Anual2').hide();
            break;
        case '2':
            $('Mes2').show();
            $('Year2').show();
            $('Dia2').hide();
            $('Dia').hide();
            $('Trimestral').hide();
            $('Mes').show();
            $('Year').show();
            $('Semestral').hide();
            $('YearSe').hide();
            $('YearTre').hide();
            $('Anual').hide();
            $('YearTre2').hide();
            $('Trimestral2').hide();
            $('Anual2').hide();
            break;
        case '3':
            $('Mes2').hide();
            $('Year2').hide();
            $('Dia2').hide();
            $('Dia').hide();
            $('Trimestral').show();
            $('Mes').hide();
            $('Year').hide();
            $('Semestral').hide();
            $('YearSe').hide();
            $('YearTre').show();
            $('Anual').hide();
            $('YearTre2').show();
            $('Trimestral2').show();
            $('Semestral2').hide();
            $('YearSe2').hide();
            $('Anual2').hide();
            break;
        case '4':
            $('Mes2').hide();
            $('Year2').hide();
            $('Dia2').hide();
            $('Dia').hide();
            $('Trimestral').hide();
            $('Mes').hide();
            $('Year').hide();
            $('Semestral').show();
            $('YearSe').show();
            $('YearTre').hide();
            $('Anual').hide();
            $('YearTre2').hide();
            $('Trimestral2').hide();
            $('Semestral2').show();
            $('YearSe2').show();
            $('Anual2').hide();
            break;
        case '5':
            $('Mes2').hide();
            $('Year2').hide();
            $('Dia2').hide();
            $('Dia').hide();
            $('Trimestral').hide();
            $('Mes').hide();
            $('Year').hide();
            $('Semestral').hide();
            $('YearSe').hide();
            $('YearTre').hide();
            $('Anual').show();
            $('YearTre2').hide();
            $('Trimestral2').hide();
            $('Semestral2').hide();
            $('YearSe2').hide();
            $('Anual2').show();
            break;
    }
}

function guargarContenedorGrafico(idContenedor) {
    if ($('TituloGrafico.' + idContenedor).value == "") {
        alert("Escriba un titulo para guargar...");
    } else {
        $('TituloGrafico.' + idContenedor).hide();
        $('btnGuardar' + idContenedor).hide();
        var Estados = $('Estados.' + idContenedor).value;
        var Atencion = $('Atencion.' + idContenedor).value;
        var Programacion = $('Programacion.' + idContenedor).value;
        var Medicos = $('Medicos.' + idContenedor).value;
        var Servicios = $('Servicios.' + idContenedor).value;
        var AmbiFi = $('AmbiFi.' + idContenedor).value;
        var AmbiLo = $('AmbiLo.' + idContenedor).value;
        var Sedes = $('Sedes.' + idContenedor).value;
        var Turnos = $('Turnos.' + idContenedor).value;
        var tipografico = $('grafico.' + idContenedor).value;
        var opcion = $('ComboEscala' + idContenedor).value;
        var fechaInicio = $('DiaInicio' + idContenedor).value;
        var fechaFin = $('DiaFin' + idContenedor).value;
        var imesInicio = $('MesInicio' + idContenedor).value;
        var imesFin = $('MesFin' + idContenedor).value;
        var iTrimestreInicio = $('TrimestreInicio' + idContenedor).value;
        var iTrimestreFin = $('TrimestreFin' + idContenedor).value;
        var iSemestreInicio = $('SemestreInicio' + idContenedor).value;
        var iSemestreFin = $('SemestreFin' + idContenedor).value;
        var ianioInicio = $('AnioInicio' + idContenedor).value;
        var ianiofin = $('AnioFin' + idContenedor).value;
        var titulo = $('TituloGrafico.' + idContenedor).value;
        var actividades = $('Actividad' + idContenedor).value;
        var patronModulo = 'guardarDatosHistoriaEstadistica';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += "&p2=" + Estados;
        parametros += "&p3=" + Atencion;
        parametros += "&p4=" + Programacion;
        parametros += "&p5=" + Medicos;
        parametros += "&p6=" + Servicios;
        parametros += "&p7=" + AmbiFi;
        parametros += "&p8=" + AmbiLo;
        parametros += "&p9=" + Sedes;
        parametros += "&p10=" + Turnos;
        parametros += "&p11=" + opcion;
        parametros += "&p12=" + fechaInicio;
        parametros += "&p13=" + fechaFin;
        parametros += "&p14=" + imesInicio;
        parametros += "&p15=" + imesFin;
        parametros += "&p16=" + iTrimestreInicio;
        parametros += "&p17=" + iTrimestreFin;
        parametros += "&p18=" + iSemestreInicio;
        parametros += "&p19=" + iSemestreFin;
        parametros += "&p20=" + ianioInicio;
        parametros += "&p21=" + ianiofin;
        parametros += "&p22=" + tipografico;
        parametros += "&p23=" + titulo;
        parametros += "&p24=" + actividades;
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText
                cargarTablaHistoriaEstadistica();

            }
        }
        )
    }

}

function verGraficosEstadisticos() {
    if ($('Estados').value == "") {
        alert("Ud. debe escojer datos para el filtro, si ya escogio le falta escojer algun estado...");
    } else
    {
        var tipografico = $('grafico').value;
        var numeroGrafico = $('numeroGraficos').value;
        var contenedorGrafico = "contenedorGraficos" + numeroGrafico;
        var mostrarTablaCont = "contenedorgraficotabla" + numeroGrafico;
        if (numeroGrafico == 0) {
            alert("El maximo de graficos soportados ha sido superado...recarge la pagina para volver(NOTA: Se perderan los graficos anteriores)");
        } else {
            $('Estados.' + numeroGrafico).value = $('Estados').value;
            $('Atencion.' + numeroGrafico).value = $('Atencion').value;
            $('Programacion.' + numeroGrafico).value = $('Programacion').value;
            $('Medicos.' + numeroGrafico).value = $('Medicos').value;
            $('Servicios.' + numeroGrafico).value = $('Servicios').value;
            $('AmbiFi.' + numeroGrafico).value = $('AmbiFi').value;
            $('AmbiLo.' + numeroGrafico).value = $('AmbiLo').value;
            $('Sedes.' + numeroGrafico).value = $('Sedes').value;
            $('Turnos.' + numeroGrafico).value = $('Turnos').value;
            $('Actividad' + numeroGrafico).value = $('Actividades').value;
            $('grafico.' + numeroGrafico).value = tipografico;
            var Estados = $('Estados').value;
            var Atencion = $('Atencion').value;
            var Programacion = $('Programacion').value;
            var Medicos = $('Medicos').value;
            var Servicios = $('Servicios').value;
            var AmbiFi = $('AmbiFi').value;
            var AmbiLo = $('AmbiLo').value;
            var Sedes = $('Sedes').value;
            var Turnos = $('Turnos').value;
            var Actividades = $('Actividades').value;
            var patronModulo = 'estadisticasMedicos';
            var parametros = '';
            var opcion = $('comboEscala').value;
            switch (opcion) {
                case '1':
                    var fechaInicio = $('txtDia1').value;
                    var fechaFin = $('txtDia2').value;
                    var imesInicio = 0;
                    var imesFin = 0;
                    var iTrimestreInicio = 0;
                    var iTrimestreFin = 0;
                    var iSemestreInicio = 0;
                    var iSemestreFin = 0;
                    var ianioInicio = 0;
                    var ianiofin = 0;
                    $('ComboEscala' + numeroGrafico).value = 1;
                    $('DiaInicio' + numeroGrafico).value = $('txtDia1').value;
                    $('DiaFin' + numeroGrafico).value = $('txtDia2').value;
                    $('MesInicio' + numeroGrafico).value = "";
                    $('MesFin' + numeroGrafico).value = "";
                    $('TrimestreInicio' + numeroGrafico).value = "";
                    $('TrimestreFin' + numeroGrafico).value = "";
                    $('SemestreInicio' + numeroGrafico).value = "";
                    $('SemestreFin' + numeroGrafico).value = "";
                    $('AnioInicio' + numeroGrafico).value = "";
                    $('AnioFin' + numeroGrafico).value = "";
                    break;


                case '2':
                    var fechaInicio = 0;
                    var fechaFin = 0;
                    var imesInicio = $('cbxMes1').value;
                    var imesFin = $('cbxMes2').value;
                    var iTrimestreInicio = 0;
                    var iTrimestreFin = 0;
                    var iSemestreInicio = 0;
                    var iSemestreFin = 0;
                    var ianioInicio = $('txtYear1').value;
                    var ianiofin = $('txtYear2').value;
                    $('ComboEscala' + numeroGrafico).value = 2;
                    $('DiaInicio' + numeroGrafico).value = ""
                    $('DiaFin' + numeroGrafico).value = ""
                    $('MesInicio' + numeroGrafico).value = $('cbxMes1').value;
                    $('MesFin' + numeroGrafico).value = $('cbxMes2').value;
                    $('TrimestreInicio' + numeroGrafico).value = "";
                    $('TrimestreFin' + numeroGrafico).value = "";
                    $('SemestreInicio' + numeroGrafico).value = "";
                    $('SemestreFin' + numeroGrafico).value = "";
                    $('AnioInicio' + numeroGrafico).value = $('txtYear1').value;
                    $('AnioFin' + numeroGrafico).value = $('txtYear2').value;
                    break;
                case '3':
                    var fechaInicio = 0;
                    var fechaFin = 0;
                    var imesInicio = 0;
                    var imesFin = 0;
                    var iTrimestreInicio = $('trimestre1').value;
                    var iTrimestreFin = $('trimestre2').value;
                    var iSemestreInicio = 0;
                    var iSemestreFin = 0;
                    var ianioInicio = $('txtYearTre1').value;
                    var ianiofin = $('txtYearTre2').value;
                    $('ComboEscala' + numeroGrafico).value = 3;
                    $('DiaInicio' + numeroGrafico).value = ""
                    $('DiaFin' + numeroGrafico).value = ""
                    $('MesInicio' + numeroGrafico).value = "";
                    $('MesFin' + numeroGrafico).value = "";
                    $('TrimestreInicio' + numeroGrafico).value = $('trimestre1').value;
                    $('TrimestreFin' + numeroGrafico).value = $('trimestre2').value;
                    $('SemestreInicio' + numeroGrafico).value = "";
                    $('SemestreFin' + numeroGrafico).value = "";
                    $('AnioInicio' + numeroGrafico).value = $('txtYearTre1').value;
                    $('AnioFin' + numeroGrafico).value = $('txtYearTre2').value;
                    break;
                case '4':
                    var fechaInicio = 0;
                    var fechaFin = 0;
                    var imesInicio = 0;
                    var imesFin = 0;
                    var iTrimestreInicio = 0;
                    var iTrimestreFin = 0;
                    var iSemestreInicio = $('semestre1').value;
                    var iSemestreFin = $('semestre2').value;
                    var ianioInicio = $('txtYearSe1').value;
                    var ianiofin = $('txtYearSe2').value;
                    $('ComboEscala' + numeroGrafico).value = 4;
                    $('DiaInicio' + numeroGrafico).value = ""
                    $('DiaFin' + numeroGrafico).value = ""
                    $('MesInicio' + numeroGrafico).value = "";
                    $('MesFin' + numeroGrafico).value = "";
                    $('TrimestreInicio' + numeroGrafico).value = "";
                    $('TrimestreFin' + numeroGrafico).value = "";
                    $('SemestreInicio' + numeroGrafico).value = $('semestre1').value;
                    $('SemestreFin' + numeroGrafico).value = $('semestre2').value;
                    $('AnioInicio' + numeroGrafico).value = $('txtYearSe1').value;
                    $('AnioFin' + numeroGrafico).value = $('txtYearSe2').value;

                    break;
                case '5':
                    var fechaInicio = 0;
                    var fechaFin = 0;
                    var imesInicio = 0;
                    var imesFin = 0;
                    var iTrimestreInicio = 0;
                    var iTrimestreFin = 0;
                    var iSemestreInicio = 0;
                    var iSemestreFin = 0;
                    var ianioInicio = $('txtAnual1').value;
                    var ianiofin = $('txtAnual2').value;
                    $('ComboEscala' + numeroGrafico).value = 5;
                    $('DiaInicio' + numeroGrafico).value = ""
                    $('DiaFin' + numeroGrafico).value = ""
                    $('MesInicio' + numeroGrafico).value = "";
                    $('MesFin' + numeroGrafico).value = "";
                    $('TrimestreInicio' + numeroGrafico).value = "";
                    $('TrimestreFin' + numeroGrafico).value = "";
                    $('SemestreInicio' + numeroGrafico).value = "";
                    $('SemestreFin' + numeroGrafico).value = "";
                    $('AnioInicio' + numeroGrafico).value = $('txtAnual1').value;
                    $('AnioFin' + numeroGrafico).value = $('txtAnual2').value;
                    break;
            }
            var prefijo = contenedorGrafico;
            parametros += 'p1=' + patronModulo;
            parametros += "&p2=" + Estados;
            parametros += "&p3=" + Atencion;
            parametros += "&p4=" + Programacion;
            parametros += "&p5=" + Medicos;
            parametros += "&p6=" + Servicios;
            parametros += "&p7=" + AmbiFi;
            parametros += "&p8=" + AmbiLo;
            parametros += "&p9=" + Sedes;
            parametros += "&p10=" + Turnos;
            parametros += "&p11=" + opcion;
            parametros += "&p12=" + fechaInicio;
            parametros += "&p13=" + fechaFin;
            parametros += "&p14=" + imesInicio;
            parametros += "&p15=" + imesFin;
            parametros += "&p16=" + iTrimestreInicio;
            parametros += "&p17=" + iTrimestreFin;
            parametros += "&p18=" + iSemestreInicio;
            parametros += "&p19=" + iSemestreFin;
            parametros += "&p20=" + ianioInicio;
            parametros += "&p21=" + ianiofin;
            parametros += "&p22=" + prefijo;
            parametros += "&p23=" + tipografico;
            parametros += "&p24=" + Actividades;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    if (respuesta == 1) {
                        alert("La busqueda retorno dato vacios");
                    } else {
                        $(mostrarTablaCont).show();
                        $('numeroGraficos').value = $('numeroGraficos').value - 1;
                        tablaLeyenda(numeroGrafico);
                        eval(respuesta);
                    }
                }
            }
            )
        }
    }

}


function verGraficosEstadisticosInicio() {
    var patronModulo = 'cargarEstadisticasAjax';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    contadorCargador++;
    var idCargadoragregar = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargadoragregar),
        onComplete: function (transport) {
            cargadorpeche(0, idCargadoragregar);
            var respuesta = transport.responseText;
            eval(respuesta);
            var barChart1 = new dhtmlXChart({
                view: "pie",
                container: "chart_container1",
                value: "#sales#",
                radius: 0,
                border: true,
                xAxis: {
                    template: "'#year#"
                },
                yAxis: {
                    start: 0,
                    end: 100,
                    step: 1000,
                    template: function (obj) {
                        return(obj % 20 ? "" : obj)
                    }
                }
            });

            var barChart5 = new dhtmlXChart({
                view: "bar",
                container: "chart_container5",
                value: "#sales#",
                radius: 0,
                border: true,
                xAxis: {
                    template: "'#year#"
                },
                yAxis: {
                    start: 0,
                    end: 100,
                    step: 10,
                    template: function (obj) {
                        return(obj % 20 ? "" : obj)
                    }
                }
            });

            var barChart99 = new dhtmlXChart({
                view: "line",
                container: "chart_container2",
                value: "#sales#",
                radius: 0,
                border: true,
                xAxis: {
                    template: "'#year#"
                },
                yAxis: {
                    start: 0,
                    end: 100,
                    step: 10,
                    template: function (obj) {
                        return(obj % 20 ? "" : obj)
                    }
                }
            });


            barChart1.parse(dataset, "json");
            barChart5.parse(dataset, "json");
            barChart99.parse(dataset, "json");
        }
    })
    cargarSkaterBar();
}

function cargarSkaterBar() {
    var multiple_dataset = [{
            sales: "20",
            sales2: "35",
            sales3: "55",
            year: "02"
        }, {
            sales: "40",
            sales2: "24",
            sales3: "40",
            year: "03"
        }, {
            sales: "44",
            sales2: "20",
            sales3: "27",
            year: "04"
        }, {
            sales: "23",
            sales2: "50",
            sales3: "43",
            year: "05"
        }, {
            sales: "21",
            sales2: "36",
            sales3: "31",
            year: "06"
        }, {
            sales: "50",
            sales2: "40",
            sales3: "56",
            year: "07"
        }, {
            sales: "30",
            sales2: "65",
            sales3: "75",
            year: "08"
        }, {
            sales: "90",
            sales2: "62",
            sales3: "55",
            year: "09"
        }, {
            sales: "55",
            sales2: "40",
            sales3: "60",
            year: "10"
        }, {
            sales: "72",
            sales2: "45",
            sales3: "54",
            year: "11"
        }];

    var barChart = new dhtmlXChart({
        view: "stackedBar",
        container: "chart_container12",
        width: 50,
        xAxis: {
            title: "",
            template: "#year#"
        },
        yAxis: {
            title: ""
        },
        gradient: "3d"
    })
    barChart.addSeries({
        value: "#sales#",
        color: "red",
        label: ""
    });
    barChart.addSeries({
        value: "#sales2#",
        color: "green",
        label: ""
    });
    barChart.addSeries({
        value: "#sales3#",
        color: "black",
        label: ""
    });
    barChart.parse(multiple_dataset, "json");




}





function abrirPopapOpciones(id) {
    switch (id) {
        case '1':
            posFuncion = "";
            vtitle = '';
            vformname = 'propiedadesPopadEstado';
            vwidth = '150';
            vheight = '170';
            patronModulo = 'propiedadesPopadEstado';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
            break;
        case '2':
            posFuncion = "";
            vtitle = '';
            vformname = 'propiedadesPopadMedicos';
            vwidth = '696';
            vheight = '440';
            patronModulo = 'propiedadesPopadMedicos';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

            break;
        case '3':
            posFuncion = "cargarTablaServicio()";
            vtitle = '';
            vformname = 'propiedadesPopadServicios';
            vwidth = '350;';
            vheight = '440';
            patronModulo = 'propiedadesPopadServicios';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);


            break;
        case '4':
            posFuncion = "cargarTablaAmbiLo()";
            vtitle = '';
            vformname = 'propiedadesPopadAmbiL';
            vwidth = '350';
            vheight = '440';
            patronModulo = 'propiedadesPopadAmbiL';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

            break;
        case '5':
            posFuncion = "cargarTablaAmbiFi()";
            vtitle = '';
            vformname = 'propiedadesPopadAmbiF';
            vwidth = '350';
            vheight = '440';
            patronModulo = 'propiedadesPopadAmbiF';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
            break;
        case '6':
            posFuncion = "cargarTablaSedes()";
            vtitle = '';
            vformname = 'PopadSedes';
            vwidth = '200';
            vheight = '250';
            patronModulo = 'PopadSedes';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

            break;
        case '7':
            posFuncion = "";
            vtitle = '';
            vformname = 'cargarPopadTurnos';
            vwidth = '150';
            vheight = '170';
            patronModulo = 'cargarPopadTurnos';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);

            break;
        case '8':
            posFuncion = "";
            vtitle = '';
            vformname = 'propiedadesPopadAtencion';
            vwidth = '170';
            vheight = '140';
            patronModulo = 'propiedadesPopadAtencion';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
            break;
        case '9':
            posFuncion = "";
            vtitle = '';
            vformname = 'propiedadesPopadProgramacion';
            vwidth = '170';
            vheight = '140';
            patronModulo = 'propiedadesPopadProgramacion';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
            break;
        case '10':
            posFuncion = "verGraficosEstadisticosInicio";
            vtitle = '';
            vformname = 'CatalogodeGraficos';
            vwidth = '1080';
            vheight = '500';
            patronModulo = 'CatalogodeGraficos';
            vcenter = 't';
            vresizable = '';
            vmodal = 'false';
            vstyle = '';
            vopacity = '';
            veffect = '';
            vposx1 = '';
            vposx2 = '';
            vposy1 = '';
            vposy2 = '';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
            break;
    }
}

function HistoriaEstadistica() {
    var descripcion = $('IdEstadisticaHistoria').value;
    var Id = $('IdDescr').value;
    var patronModulo = 'EditarVdescripcionHistorial';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + Id;
    parametros += "&p3=" + descripcion;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText
            Windows.close("Div_EditarHistoriaEstadistica");
            cargarTablaHistoriaEstadistica();
        }
    }
    )
}

function cargarPopadEditarHistorialEstadistica() {
    posFuncion = "";
    vtitle = '';
    vformname = 'EditarHistoriaEstadistica';
    vwidth = '300';
    vheight = '60';
    patronModulo = 'EditarHistoriaEstadistica';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function cargaraFiltro(id, desc, cont) {
    if (cont == '1') {
        if ($('Estados').value.indexOf(id + "|") != -1) {
            //   alert('El filtro seleccionado ya se encuentra en el panel');
            // if(confirm('Esta Seguro Eliminar El Filtro')){
            var nodoHijo = document.getElementById(id);
            var nodoPadre = nodoHijo.parentNode;
            nodoPadre.removeChild(nodoHijo);
            if ($('Estados').value.indexOf(id + "|") != -1) {
                $('Estados').value = $('Estados').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
            }
            if ($('Estados').value.indexOf(id) != -1) {
                $('Estados').value = $('Estados').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
                $('Estados').value = $('Estados').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
            }
            document.getElementById("Estados").value = $('Estados').value;
            ocultarDivMaestrosVacios();
            //}  
        } else {
            var para = document.getElementById("contenedorfiltros1");
            $('con1').show();
            var s = '<table cellSpacing="0" border="0" width="220" id=' + id + '><tr><td width="120"><font size="2"><UL type = square><LI>' + desc + '</UL></font></td><td><center><a href="javascript:eliminarFiltroEstados(\'' + id + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);
            $('Estados').value += id + '|';
        }
    } else if (cont == '2') {
        if ($('Atencion').value.indexOf(id + "|") != -1) {
            // alert('El filtro seleccionado ya se encuentra en el panel');
            // if(confirm('Esta Seguro Eliminar El Filtro')){
            var nodoHijo = document.getElementById(id);
            var nodoPadre = nodoHijo.parentNode;
            nodoPadre.removeChild(nodoHijo);
            if ($('Atencion').value.indexOf(id + "|") != -1) {
                $('Atencion').value = $('Atencion').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
            }
            if ($('Atencion').value.indexOf(id) != -1) {
                $('Atencion').value = $('Atencion').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
                $('Atencion').value = $('Atencion').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
            }
            document.getElementById("Atencion").value = $('Atencion').value;
            //}   
            ocultarDivMaestrosVacios();
        } else {
            var para = document.getElementById("contenedorfiltros2");
            $('con2').show();
            var s = '<table cellSpacing="0" border="0" width="220" id=' + id + '><tr><td width="120"><font size="2"><UL type = square><LI>' + desc + '</UL></font></td><td><center><a href="javascript:eliminarFiltroAtencion(\'' + id + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);
            $('Atencion').value += id + '|';
        }
    } else if (cont == '3') {
        if ($('Programacion').value.indexOf(id + "|") != -1) {
            // alert('El filtro seleccionado ya se encuentra en el panel');
            // if(confirm('Esta Seguro Eliminar El Filtro')){
            var nodoHijo = document.getElementById(id);
            var nodoPadre = nodoHijo.parentNode;
            nodoPadre.removeChild(nodoHijo);
            if ($('Programacion').value.indexOf(id + "|") != -1) {
                $('Programacion').value = $('Programacion').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
            }
            if ($('Programacion').value.indexOf(id) != -1) {
                $('Programacion').value = $('Programacion').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
                $('Programacion').value = $('Programacion').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
            }
            document.getElementById("Programacion").value = $('Programacion').value;
            //}
            ocultarDivMaestrosVacios();
        } else {
            var para = document.getElementById("contenedorfiltros3");
            $('con3').show();
            var s = '<table cellSpacing="0" border="0" width="220" id=' + id + '><tr><td width="120"><font size="2"><UL type = square><LI>' + desc + '</UL></font></td><td><center><a href="javascript:eliminarFiltroProgramacion(\'' + id + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
            var range = document.createRange();
            range.selectNode(document.body);
            var documentFragment = range.createContextualFragment(s);
            para.appendChild(documentFragment);
            $('Programacion').value += id + '|';
        }
    } else if (cont == '4') {
        alert("Actualmente el sistema web no tiene datos Estadisticos para Turnos");
    }
//        if ($('Turnos').value.indexOf(id+"|")!=-1) {
//            alert('El filtro seleccionado ya se encuentra en el panel');
//        }
//        else {
//            var para = document.getElementById("contenedorfiltros9");
//            $('con9').show();
//            var s ='<table cellSpacing="0" border="0" width="220" id='+id+'><tr><td width="120"><font size="2"><UL type = square><LI>'+desc+'</UL></font></td><td><center><a href="javascript:eliminarFiltroTurnos(\''+id+'\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
//            var range = document.createRange();
//            range.selectNode(document.body);
//            var documentFragment = range.createContextualFragment(s);
//            para.appendChild(documentFragment);  
//            $('Turnos').value+= id + '|';
//        } 
//    }
}

function eliminarFiltroEstados(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Estados').value.indexOf(id + "|") != -1) {
        $('Estados').value = $('Estados').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Estados').value.indexOf(id) != -1) {
        $('Estados').value = $('Estados').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Estados').value = $('Estados').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("Estados").value = $('Estados').value;
    $(id).checked = false;
    ocultarDivMaestrosVacios();
//  }
}

function eliminarFiltroACtividades(id) {
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Actividades').value.indexOf(id + "|") != -1) {
        $('Actividades').value = $('Actividades').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Actividades').value.indexOf(id) != -1) {
        $('Actividades').value = $('Actividades').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Actividades').value = $('Actividades').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("Actividades").value = $('Actividades').value;
    ocultarDivMaestrosVacios();
//  }
}



function eliminarFiltroAtencion(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Atencion').value.indexOf(id + "|") != -1) {
        $('Atencion').value = $('Atencion').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Atencion').value.indexOf(id) != -1) {
        $('Atencion').value = $('Atencion').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Atencion').value = $('Atencion').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("Atencion").value = $('Atencion').value;
    $(id).checked = false;
    ocultarDivMaestrosVacios();
// }    
}


function eliminarFiltroProgramacion(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Programacion').value.indexOf(id + "|") != -1) {
        $('Programacion').value = $('Programacion').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Programacion').value.indexOf(id) != -1) {
        $('Programacion').value = $('Programacion').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Programacion').value = $('Programacion').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    $(id).checked = false;
    document.getElementById("Programacion").value = $('Programacion').value;
    ocultarDivMaestrosVacios();
//   }    
}

function eliminarFiltroTurnos(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Turnos').value.indexOf(id + "|") != -1) {
        $('Turnos').value = $('Turnos').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Turnos').value.indexOf(id) != -1) {
        $('Turnos').value = $('Turnos').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Turnos').value = $('Turnos').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("Turnos").value = $('Turnos').value;
    ocultarDivMaestrosVacios();
// }    
}

function eliminarFiltroMedicos(id) {
    //  if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Medicos').value.indexOf(id + "|") != -1) {
        $('Medicos').value = $('Medicos').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Medicos').value.indexOf(id) != -1) {
        $('Medicos').value = $('Medicos').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Medicos').value = $('Medicos').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    $('ContadorMedicos').value = $('ContadorMedicos').value - 1;
    document.getElementById("Medicos").value = $('Medicos').value;
    ocultarDivMaestrosVacios();
// }    
}


function eliminarFiltroServicios(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Servicios').value.indexOf(id + "|") != -1) {
        $('Servicios').value = $('Servicios').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Servicios').value.indexOf(id) != -1) {
        $('Servicios').value = $('Servicios').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Servicios').value = $('Servicios').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    $('ContadorServicios').value = $('ContadorServicios').value - 1;
    document.getElementById("Servicios").value = $('Servicios').value;
    ocultarDivMaestrosVacios();
//}    
}

function eliminarFiltroSedes(id) {
    //if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('Sedes').value.indexOf(id + "|") != -1) {
        $('Sedes').value = $('Sedes').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('Sedes').value.indexOf(id) != -1) {
        $('Sedes').value = $('Sedes').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('Sedes').value = $('Sedes').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    document.getElementById("Sedes").value = $('Sedes').value;
    ocultarDivMaestrosVacios();
//}    
}
function eliminarFiltroAmbiFi(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('AmbiFi').value.indexOf(id + "|") != -1) {
        $('AmbiFi').value = $('AmbiFi').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('AmbiFi').value.indexOf(id) != -1) {
        $('AmbiFi').value = $('AmbiFi').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('AmbiFi').value = $('AmbiFi').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    $('ContadorAfiliaciones').value = $('ContadorAfiliaciones').value - 1;
    document.getElementById("AmbiFi").value = $('AmbiFi').value;
    ocultarDivMaestrosVacios();
// }    
}


function eliminarFiltroAmbiLo(id) {
    // if(confirm('Esta Seguro Eliminar El Filtro')){
    var nodoHijo = document.getElementById(id);
    var nodoPadre = nodoHijo.parentNode;
    nodoPadre.removeChild(nodoHijo);
    if ($('AmbiLo').value.indexOf(id + "|") != -1) {
        $('AmbiLo').value = $('AmbiLo').value.replace(id + "|", '');//Eliminar de la cadena en el caso el elmento se encuentre en el inicio o antes de llegar al final
    }
    if ($('AmbiLo').value.indexOf(id) != -1) {
        $('AmbiLo').value = $('AmbiLo').value.replace("|" + id, '');//Eliminar de la cadena en el caso el elemento se encuentre al final
        $('AmbiLo').value = $('AmbiLo').value.replace(id, '');//Eliminar de la cadena en el caso solo haya uno
    }
    $('ContadorAmbientesLo').value = $('ContadorAmbientesLo').value - 1;
    document.getElementById("AmbiLo").value = $('AmbiLo').value;
    ocultarDivMaestrosVacios();
//  }    
}

function cargarTablaPersonal() {
    var codigo = document.getElementById("CodPer").value;
    var dni = document.getElementById("dni").value;
    var apepat = document.getElementById("txtApellidoPat").value;
    var apemat = document.getElementById("txtApellidoMat").value;
    var nombre = document.getElementById("txtApellidoNom").value;
    var patronModulo = 'cargarTablaPersonal';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + codigo;
    parametros += '&p3=' + apepat;
    parametros += '&p4=' + apemat;
    parametros += '&p5=' + nombre;
    parametros += '&p6=' + dni;
    rTablaPersonal = new dhtmlXGridObject('tablaPersonal');
    rTablaPersonal.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaPersonal.setSkin("dhx_terrace");
    rTablaPersonal.enableRowsHover(true, 'grid_hover');
    rTablaPersonal.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 4) {
            var Codigo = rTablaPersonal.cells(rId, 1).getValue();
            var Nombre = rTablaPersonal.cells(rId, 2).getValue();
            if ($('Medicos').value.indexOf(Codigo + "|") != -1) {
                eliminarFiltroMedicos(Codigo);
            } else {
                /* if ($('Servicios').value!="" || $('AmbiFi').value!="" || $('AmbiLo').value!="" || $('Sedes').value!="" || $('Turnos').value!=""){
                 alert("Ya as agregado un filtro de otro grupo - Solo pudes realizar filtros con Medicos , Estados , Atencion  y Programacion")
                 }
                 else{ */
                var para = document.getElementById("contenedorfiltros4");
                $('ContadorMedicos').value++;
                $('con4').show();
                if ($('ContadorMedicos').value <= 3) {
                    $('Medicos').value += Codigo + '|';
                    var s = '<table cellSpacing="0" border="0" width="220" id=' + Codigo + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroMedicos(\'' + Codigo + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment);
                } else {
                    alert("El maximo de medicos es 3");
                    $('ContadorMedicos').value = $('ContadorMedicos').value - 1
                }
                // }
            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaPersonal.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    rTablaPersonal.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    rTablaPersonal.setSkin("dhx_terrace");
    rTablaPersonal.init();
    rTablaPersonal.loadXML(pathRequestControl + '?' + parametros, function () {
    });
    $("CodPer").value = "";
    $("dni").value = "";
    $("txtApellidoPat").value = "";
    $("txtApellidoMat").value = "";
    $("txtApellidoNom").value = "";
}


function ListarActividades() {
    var patronModulo = 'ListarActividades';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    istarActividades = new dhtmlXGridObject('contenedorActividad');
    istarActividades.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    istarActividades.setSkin("dhx_terrace");
    istarActividades.enableRowsHover(true, 'grid_hover');
    istarActividades.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 2) {
            var Codigo = istarActividades.cells(rId, 0).getValue();
            var Nombre = istarActividades.cells(rId, 1).getValue();
            if ($('Actividades').value.indexOf(Codigo + "|") != -1) {
                eliminarFiltroACtividades(Codigo)
            } else {
                var para = document.getElementById("contenedorfiltros11");
                $('con11').show();
                $('Actividades').value += Codigo + '|';
                var s = '<table cellSpacing="0" border="0" width="220" id=' + Codigo + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroServicios(\'' + Codigo + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                var range = document.createRange();
                range.selectNode(document.body);
                var documentFragment = range.createContextualFragment(s);
                para.appendChild(documentFragment);

            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    istarActividades.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    istarActividades.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    istarActividades.setSkin("dhx_terrace");
    istarActividades.init();
    istarActividades.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}

function  cargarTablaServicio() {
    var servicio = document.getElementById("txtServicio").value;
    var patronModulo = 'cargarTablaServicios';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + servicio;
    aServicios = new dhtmlXGridObject('tablaServicios');
    aServicios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aServicios.setSkin("dhx_terrace");
    aServicios.enableRowsHover(true, 'grid_hover');
    aServicios.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 2) {
            var Codigo = aServicios.cells(rId, 0).getValue();
            var Nombre = aServicios.cells(rId, 1).getValue();
            if ($('Servicios').value.indexOf(Codigo + "|") != -1) {
                eliminarFiltroServicios(Codigo)
            } else {
                var para = document.getElementById("contenedorfiltros5");
                $('ContadorServicios').value++;
                $('con5').show();
                if ($('ContadorServicios').value <= 1) {
                    $('Servicios').value += Codigo + '|';
                    var s = '<table cellSpacing="0" border="0" width="220" id=' + Codigo + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroServicios(\'' + Codigo + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment);
                } else {
                    alert("El maximo de servicios es 1");
                    $('ContadorServicios').value = $('ContadorServicios').value - 1
                }
            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aServicios.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    aServicios.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    aServicios.setSkin("dhx_terrace");
    aServicios.init();
    aServicios.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}

function cargarTablaSedes() {
    var patronModulo = 'cargarTablaSedes';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    rTablaSedes = new dhtmlXGridObject('tablaSedes');
    rTablaSedes.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaSedes.setSkin("dhx_terrace");
    rTablaSedes.enableRowsHover(true, 'grid_hover');
    rTablaSedes.attachEvent("onRowSelect", function (rId, cInd) {
        var Codigo = rTablaSedes.cells(rId, 0).getValue();

        var Nombre = rTablaSedes.cells(rId, 1).getValue();
        if (Codigo == "0000000001") {
            var idSede = 1;
        } else if (Codigo == "0000000002") {
            var idSede = 3;
        } else if (Codigo == "0000000003") {
            var idSede = 2;
        } else if (Codigo == "0000001464") {
            var idSede = 4;
        }
        if (cInd == 2) {

            if ($('Sedes').value.indexOf(idSede + "|") != -1) {

                eliminarFiltroSedes(idSede)
            } else {
                var para = document.getElementById("contenedorfiltros8");
                $('con8').show();

                $('Sedes').value += idSede + '|';
                var s = '<table cellSpacing="0" border="0" width="220" id=' + idSede + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroSedes(\'' + idSede + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                var range = document.createRange();
                range.selectNode(document.body);
                var documentFragment = range.createContextualFragment(s);
                para.appendChild(documentFragment);
            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaSedes.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    rTablaSedes.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    rTablaSedes.setSkin("dhx_terrace");
    rTablaSedes.init();
    rTablaSedes.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}



function cargarTablaAmbiFi() {
    var patronModulo = 'tablaAmbiFi';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    rTablaAmbiFi = new dhtmlXGridObject('tablaAmbiFi');
    rTablaAmbiFi.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaAmbiFi.setSkin("dhx_terrace");
    rTablaAmbiFi.enableRowsHover(true, 'grid_hover');
    rTablaAmbiFi.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 2) {
            var Codigo = rTablaAmbiFi.cells(rId, 0).getValue();
            var Nombre = rTablaAmbiFi.cells(rId, 1).getValue();
            if ($('AmbiFi').value.indexOf(Codigo + "|") != -1) {
                eliminarFiltroAmbiFi(Codigo)
            } else {
                $('ContadorAfiliaciones').value++;
                var para = document.getElementById("contenedorfiltros7");
                $('con7').show();
                if ($('ContadorAfiliaciones').value <= 3) {
                    $('AmbiFi').value += Codigo + '|';
                    var s = '<table cellSpacing="0" border="0" width="220" id=' + Codigo + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroAmbiFi(\'' + Codigo + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment);
                } else {
                    alert("El maximo de Afiliaciones es 3");
                    $('ContadorAfiliaciones').value = $('ContadorAfiliaciones').value - 1
                }


            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaAmbiFi.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    rTablaAmbiFi.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    rTablaAmbiFi.setSkin("dhx_terrace");
    rTablaAmbiFi.init();
    rTablaAmbiFi.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}
function cargarTablaAmbiLo() {
    var patronModulo = 'tablaAmbiLo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    rTablaAmbiLo = new dhtmlXGridObject('tablaAmbiLo');
    rTablaAmbiLo.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    rTablaAmbiLo.setSkin("dhx_terrace");
    rTablaAmbiLo.enableRowsHover(true, 'grid_hover');
    rTablaAmbiLo.attachEvent("onRowSelect", function (rId, cInd) {
        if (cInd == 2) {
            var Codigo = rTablaAmbiLo.cells(rId, 0).getValue();
            var Nombre = rTablaAmbiLo.cells(rId, 1).getValue();
            if ($('AmbiLo').value.indexOf(Codigo + "|") != -1) {
                eliminarFiltroAmbiLo(Codigo)
            } else {
                var para = document.getElementById("contenedorfiltros6");
                $('ContadorAmbientesLo').value++;
                $('con6').show();
                if ($('ContadorAmbientesLo').value <= 3) {
                    $('AmbiLo').value += Codigo + '|';
                    var s = '<table cellSpacing="0" border="0" width="220" id=' + Codigo + '><tr><td width="120"><font size="1"><UL type = square><LI>' + Nombre + '</UL></font></td><td><center><a href="javascript:eliminarFiltroAmbiLo(\'' + Codigo + '\')"><img src="../../../../fastmedical_front/imagen/icono/cancelarAngel.png"></a></center></td></tr></table>';
                    var range = document.createRange();
                    range.selectNode(document.body);
                    var documentFragment = range.createContextualFragment(s);
                    para.appendChild(documentFragment);
                } else {
                    alert("El maximo de Ambientes Logicos es 3");
                    $('ContadorAmbientesLo').value = $('ContadorAmbientesLo').value - 1
                }
            }
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    rTablaAmbiLo.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    rTablaAmbiLo.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    rTablaAmbiLo.setSkin("dhx_terrace");
    rTablaAmbiLo.init();
    rTablaAmbiLo.loadXML(pathRequestControl + '?' + parametros, function () {
    });
}

function filtrartablaservicios() {
    var palabra = $('txtServicio').value;
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    aServicios.filterBy(1, arrayPalabras[0]);
    for (var i = 1; i < numeroPalabras; i++) {
        aServicios.filterBy(1, arrayPalabras[i], true);
    }
}

function filtrartablaAmbiLo() {
    var palabra = $('txtAmbiLogi').value;
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    rTablaAmbiLo.filterBy(1, arrayPalabras[0]);
    for (var i = 1; i < numeroPalabras; i++) {
        rTablaAmbiLo.filterBy(1, arrayPalabras[i], true);
    }
}


function filtrartablaAmbiFi() {
    var palabra = $('txtAmbiFisi').value;
    var arrayPalabras = new Array();
    arrayPalabras = palabra.split(" ");
    var numeroPalabras = arrayPalabras.length;
    rTablaAmbiFi.filterBy(1, arrayPalabras[0]);
    for (var i = 1; i < numeroPalabras; i++) {
        rTablaAmbiFi.filterBy(1, arrayPalabras[i], true);
    }
}

function cambiarGrafico() {
    abrirPopapOpciones('10');
}
function agregaropcionCatalogoGrafico(id) {
    switch (id) {
        case 1:
            $('contenedorfiltros10').update('<img src="../../../imagen/graficos/pie.bmp">')
            $('grafico').value = "pie";
            break;
        case 6:
            $('contenedorfiltros10').update('<img src="../../../imagen/graficos/bar.bmp">')
            $('grafico').value = "bar";
            break;
        case 12:
            $('contenedorfiltros10').update('<img src="../../../imagen/graficos/stackedBar.bmp">')
            $('grafico').value = "stackedBar";
            break;
        case 2:
            $('contenedorfiltros10').update('<img src="../../../imagen/graficos/line.bmp">')
            $('grafico').value = "line";
            break;

    }
    Windows.close("Div_CatalogodeGraficos");
}

function calendarioHtmlxActoMedicoEstadistica(id) {
    window.dhx_globalImgPath = "../dhtmlxCalendar/";
    var fecha = new Date();
    var aniolimite = fecha.getFullYear() + 2;
    dhtmlxCalendarLangModules = new Array();
    dhtmlxCalendarLangModules['es'] = {
        langname: 'es',
        monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
        monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        daysFNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        daysSNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekend: [0, 6],
        weekstart: 1,
        msgClose: "Cerrar",
        msgMinimize: "Minimizar",
        msgToday: "Hoy"
    }

    mCal = new dhtmlxCalendarObject(id, false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function (date) {
        var d = new Date(date);
        fecha = d.getDate() + "/" + d.getMonth() + "/" + d.getFullYear();
    });
    mCal.draw();
}

function ValidarFechasRangos(idobjetoevento, idobjetocomparar, escala) {
    if (escala == 1) {
        var contador = $('validacionFechas').value
        if (contador == 1) {
            var text1 = $(idobjetoevento).value;
            var text2 = $(idobjetocomparar).value;
            if (text1 > text2) {
                alert('El primer campo no puede ser mayor al segundo...!');
                $(idobjetoevento).value = text2;
            }
        }
    }
    if (escala == 2) {
        $('validacionFechas').value = 1;
        var text2 = $(idobjetoevento).value;
        var text1 = $(idobjetocomparar).value;
        if (text2 < text1) {
            alert('El campo no permite datos menores al campo anterior...!');
            $(idobjetoevento).value = text1;
        }
    }
}



function layaoutiniciadorReportesEstadisiticos() {
    var dhxLayout1 = new dhtmlXLayoutObject("parentId1", "6C", "dhx_web");
    dhxLayout1.cells("a").setText("");
    dhxLayout1.cells("a").attachObject("parentId2");
    dhxLayout1.cells("b").setText("");
    dhxLayout1.cells("b").attachObject("estadosatencionprogramacion");
    dhxLayout1.cells("c").setText("Médicos");
    dhxLayout1.cells("c").attachObject("contenedorMedico");
    dhxLayout1.cells("d").setText("Afiliaciones");
    dhxLayout1.cells("d").attachObject("contenedorAFisicos");
    // dhxLayout1.cells("e").setText("Ambientes"); 
    dhxLayout1.cells("e").setText("");
    dhxLayout1.cells("e").attachObject("contenedorMAmbientes");
    dhxLayout1.cells("f").setText("Ambientes Lógicos");
    dhxLayout1.cells("f").attachObject("contenedorALogicos");
    dhxLayout1.cells("b").setWidth(265);
    dhxLayout1.cells("b").setHeight(130);
    dhxLayout1.cells("c").setWidth(265);
    dhxLayout1.cells("c").setHeight(250);
    dhxLayout1.cells("d").setWidth(265);
    dhxLayout1.cells("d").setHeight(250);
    dhxLayout1.cells("e").setWidth(265);
    dhxLayout1.cells("e").setHeight(100);
    dhxLayout1.cells("f").setWidth(265);
    dhxLayout1.cells("f").setHeight(400);
    var dhxLayout2 = new dhtmlXLayoutObject("parentId2", "3T", "dhx_web");
    dhxLayout2.cells("a").setText("Busqueda por Escala");
    dhxLayout2.cells("a").attachObject("contenedorEscala");
    dhxLayout2.cells("a").setHeight(120);
    dhxLayout2.cells("b").setText("Graficos");
    dhxLayout2.cells("b").attachObject("contenedormaestro");
    dhxLayout2.cells("c").setText("Filtros")
    dhxLayout2.cells("c").attachObject("filtros");
    dhxLayout2.cells("c").setWidth(220);
    var dhxLayout3 = new dhtmlXLayoutObject("contenedorMAmbientes", "3E", "dhx_web");
    dhxLayout3.cells("a").setText("Sedes");
    dhxLayout3.cells("a").attachObject("sedes");
    dhxLayout3.cells("b").setText("Servicios");
    dhxLayout3.cells("b").attachObject("contenedorServicios");
    dhxLayout3.cells("c").setText("Actividad");
    dhxLayout3.cells("c").attachObject("contenedorActividad");
    dhxLayout3.cells("a").setHeight(150);
    dhxLayout3.cells("b").setHeight(200);
    dhxLayout3.cells("c").setHeight(200);
    debugger;
    cargarEstadisticas();
    cargarTablaServicio();
    cargarTablaAmbiLo();
    cargarTablaAmbiFi();
    cargarTablaSedes();
    ListarActividades();
    cargarTablaHistoriaEstadistica();
}

function cargarTablaHistoriaEstadistica() {

    var patronModulo = 'TablaHistoriaEstadistica';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    aHistoriaEstadistica = new dhtmlXGridObject('HistorialGrafico');
    aHistoriaEstadistica.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aHistoriaEstadistica.setSkin("dhx_terrace");
    aHistoriaEstadistica.enableRowsHover(true, 'grid_hover');
    aHistoriaEstadistica.attachEvent("onRowSelect", function (rId, cInd) {
        var idEstadistica = aHistoriaEstadistica.cells(rId, 0).getValue();
        if (cInd == 26) {
            $('IdEstadisticaHistoria').value = idEstadistica;
            cargarPopadEditarHistorialEstadistica();
        }
        if (cInd == 27) {
            tablaLeyendaGuardados(rId);
            cargarTablaGuardados(rId);

        }
        if (cInd == 28) {
            eliminarEstadisticaGuardada(idEstadistica);
        }
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aHistoriaEstadistica.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    aHistoriaEstadistica.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    aHistoriaEstadistica.setSkin("dhx_terrace");
    aHistoriaEstadistica.init();
    aHistoriaEstadistica.loadXML(pathRequestControl + '?' + parametros, function () {
        var casa;
        for (i = 0; i < aHistoriaEstadistica.getRowsNum(); i++) {
            casa = aHistoriaEstadistica.cells(i, 3).getValue();
            if (casa == '1')
                aHistoriaEstadistica.setRowTextStyle(aHistoriaEstadistica.getRowId(i), 'background-color:#66A738;color:black;border-top: 0px solid #FAFAF8;');
            else if (casa == '0')
                aHistoriaEstadistica.setRowTextStyle(aHistoriaEstadistica.getRowId(i), 'background-color:#C8E38B;color:black;border-top: 0px solid #FAFAF8;');
        }
    });
}


function cargarTablaGuardados(rId) {

    var Estados = aHistoriaEstadistica.cells(rId, 4).getValue();
    var Atencion = aHistoriaEstadistica.cells(rId, 5).getValue();
    var Programacion = aHistoriaEstadistica.cells(rId, 6).getValue();
    var Medicos = aHistoriaEstadistica.cells(rId, 7).getValue();
    var Servicios = aHistoriaEstadistica.cells(rId, 8).getValue();
    var AmbiFi = aHistoriaEstadistica.cells(rId, 9).getValue();
    var AmbiLo = aHistoriaEstadistica.cells(rId, 10).getValue();
    var Sedes = aHistoriaEstadistica.cells(rId, 11).getValue();
    var Turnos = aHistoriaEstadistica.cells(rId, 12).getValue();
    var opcion = aHistoriaEstadistica.cells(rId, 13).getValue();
    var fechaInicio = aHistoriaEstadistica.cells(rId, 14).getValue();
    var fechaFin = aHistoriaEstadistica.cells(rId, 15).getValue();
    var imesInicio = aHistoriaEstadistica.cells(rId, 16).getValue();
    var imesFin = aHistoriaEstadistica.cells(rId, 17).getValue();
    var iTrimestreInicio = aHistoriaEstadistica.cells(rId, 18).getValue();
    var iTrimestreFin = aHistoriaEstadistica.cells(rId, 19).getValue();
    var iSemestreInicio = aHistoriaEstadistica.cells(rId, 20).getValue();
    var iSemestreFin = aHistoriaEstadistica.cells(rId, 21).getValue();
    var ianioInicio = aHistoriaEstadistica.cells(rId, 22).getValue();
    var ianiofin = aHistoriaEstadistica.cells(rId, 23).getValue();
    var tipografico = aHistoriaEstadistica.cells(rId, 24).getValue();
    var Actividad = aHistoriaEstadistica.cells(rId, 25).getValue();
    var numeroGrafico = $('numeroGraficos').value;
    $("btnGuardar" + numeroGrafico).hide();
    var contenedorGrafico = "contenedorGraficos" + numeroGrafico;
    var mostrarTablaCont = "contenedorgraficotabla" + numeroGrafico;
    var prefijo = contenedorGrafico;
    $(mostrarTablaCont).show();
    $('TituloGrafico.' + numeroGrafico).hide();
    $('numeroGraficos').value = $('numeroGraficos').value - 1;
    var patronModulo = 'estadisticasMedicos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + Estados;
    parametros += "&p3=" + Atencion;
    parametros += "&p4=" + Programacion;
    parametros += "&p5=" + Medicos;
    parametros += "&p6=" + Servicios;
    parametros += "&p7=" + AmbiFi;
    parametros += "&p8=" + AmbiLo;
    parametros += "&p9=" + Sedes;
    parametros += "&p10=" + Turnos;
    parametros += "&p11=" + opcion;
    parametros += "&p12=" + fechaInicio;
    parametros += "&p13=" + fechaFin;
    parametros += "&p14=" + imesInicio;
    parametros += "&p15=" + imesFin;
    parametros += "&p16=" + iTrimestreInicio;
    parametros += "&p17=" + iTrimestreFin;
    parametros += "&p18=" + iSemestreInicio;
    parametros += "&p19=" + iSemestreFin;
    parametros += "&p20=" + ianioInicio;
    parametros += "&p21=" + ianiofin;
    parametros += "&p22=" + prefijo;
    parametros += "&p23=" + tipografico;
    parametros += "&p24=" + Actividad;

    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText
            eval(respuesta);
        }
    }
    )
}


function tablaLeyendaGuardados(rId) {
    var numeroGrafico = $('numeroGraficos').value;
    var Estados = aHistoriaEstadistica.cells(rId, 4).getValue();
    var Atencion = aHistoriaEstadistica.cells(rId, 5).getValue();
    var Programacion = aHistoriaEstadistica.cells(rId, 6).getValue();
    var Medicos = aHistoriaEstadistica.cells(rId, 7).getValue();
    var Servicios = aHistoriaEstadistica.cells(rId, 8).getValue();
    var AmbiFi = aHistoriaEstadistica.cells(rId, 9).getValue();
    var AmbiLo = aHistoriaEstadistica.cells(rId, 10).getValue();
    var Sedes = aHistoriaEstadistica.cells(rId, 11).getValue();
    var Turnos = aHistoriaEstadistica.cells(rId, 12).getValue();
    var opcion = aHistoriaEstadistica.cells(rId, 13).getValue();
    var fechaInicio = aHistoriaEstadistica.cells(rId, 14).getValue();
    var fechaFin = aHistoriaEstadistica.cells(rId, 15).getValue();
    var imesInicio = aHistoriaEstadistica.cells(rId, 16).getValue();
    var imesFin = aHistoriaEstadistica.cells(rId, 17).getValue();
    var iTrimestreInicio = aHistoriaEstadistica.cells(rId, 18).getValue();
    var iTrimestreFin = aHistoriaEstadistica.cells(rId, 19).getValue();
    var iSemestreInicio = aHistoriaEstadistica.cells(rId, 20).getValue();
    var iSemestreFin = aHistoriaEstadistica.cells(rId, 21).getValue();
    var ianioInicio = aHistoriaEstadistica.cells(rId, 22).getValue();
    var ianiofin = aHistoriaEstadistica.cells(rId, 23).getValue();
    var Actividades = aHistoriaEstadistica.cells(rId, 25).getValue();
    var patronModulo = 'TablaLeyendaGrafica';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + Estados;
    parametros += "&p3=" + Atencion;
    parametros += "&p4=" + Programacion;
    parametros += "&p5=" + Medicos;
    parametros += "&p6=" + Servicios;
    parametros += "&p7=" + AmbiFi;
    parametros += "&p8=" + AmbiLo;
    parametros += "&p9=" + Sedes;
    parametros += "&p10=" + Turnos;
    parametros += "&p11=" + opcion;
    parametros += "&p12=" + fechaInicio;
    parametros += "&p13=" + fechaFin;
    parametros += "&p14=" + imesInicio;
    parametros += "&p15=" + imesFin;
    parametros += "&p16=" + iTrimestreInicio;
    parametros += "&p17=" + iTrimestreFin;
    parametros += "&p18=" + iSemestreInicio;
    parametros += "&p19=" + iSemestreFin;
    parametros += "&p20=" + ianioInicio;
    parametros += "&p21=" + ianiofin;
    parametros += "&p22=" + Actividades;
    var contenedorLeyenda = 'contenedorTablaLeyenda' + numeroGrafico;
    $(contenedorLeyenda).show();
    document.getElementById(contenedorLeyenda).style.height = '120';
    var cadena = '';
    var variable = 'aLeyenda';
    var nombretabla = '';
    cadena += eval(variable + numeroGrafico) + '=new dhtmlXGridObject(contenedorLeyenda);';
    cadena += eval(variable + numeroGrafico) + '.setImagePath("../../../imagen/dhtmlxgrid/imgs/");';
    cadena += eval(variable + numeroGrafico) + '.setSkin("");';
    cadena += eval(variable + numeroGrafico) + '.enableRowsHover(true,"grid_hover");';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onRowSelect", function(rId,cInd){';
    cadena += '});';
    cadena += 'contadorCargador++;';
    cadena += 'var idCargador=contadorCargador;';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onXLS", function(){';
    cadena += 'cargadorpeche(1,idCargador);';
    cadena += '});';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onXLE", function(){';
    cadena += 'cargadorpeche(0,idCargador);';
    cadena += '});';
    cadena += eval(variable + numeroGrafico) + '.setSkin("");';
    cadena += eval(variable + numeroGrafico) + '.init();';
    cadena += eval(variable + numeroGrafico) + '.loadXML(pathRequestControl+"?"+parametros,function(){';
    cadena += '});';
    eval(cadena);
}

function setColorTablaLeyenda() {
    for (var i = 0; i < aLeyenda.getRowsNum(); i++) {
        aLeyenda.cells(i, 3).setBgColor('#DFDD6B');
        aLeyenda.cells(i, 4).setBgColor('#66A738');
        aLeyenda.cells(i, 5).setBgColor('#80E3F4');
    }
}
function eliminarContenedorGrafico(idContenedor) {
    var idCont = 'contenedorgraficotabla' + idContenedor;
    if (confirm('Esta Seguro Eliminar el Grafico')) {
        //        $(idTabla).hide();
        var nodoHijo = document.getElementById(idCont);
        var nodoPadre = nodoHijo.parentNode;
        nodoPadre.removeChild(nodoHijo);

        if ($(idCont).value.indexOf(idCont + "|") != -1) {
            $(idCont).value = $(idCont).value.replace(idCont + "|", '');
        }
        if ($(idCont).value.indexOf(idCont) != -1) {
            $(idCont).value = $(idCont).value.replace("|" + idCont, '');
            $(idCont).value = $(idCont).value.replace(idCont, '');
        }
        document.getElementById(idCont).value = $(idCont).value;

    }
}


function tablaLeyenda(numeroGrafico) {
    var opcion = $('comboEscala').value;
    var Estados = $('Estados').value;
    var Atencion = $('Atencion').value;
    var Programacion = $('Programacion').value;
    var Medicos = $('Medicos').value;
    var Servicios = $('Servicios').value;
    var AmbiFi = $('AmbiFi').value;
    var AmbiLo = $('AmbiLo').value;
    var Sedes = $('Sedes').value;
    var Turnos = $('Turnos').value;
    var Actividades = $('Actividades').value;
    switch (opcion) {
        case '1':
            var fechaInicio = $('txtDia1').value;
            var fechaFin = $('txtDia2').value;
            var imesInicio = 0;
            var imesFin = 0;
            var iTrimestreInicio = 0;
            var iTrimestreFin = 0;
            var iSemestreInicio = 0;
            var iSemestreFin = 0;
            var ianioInicio = 0;
            var ianiofin = 0;
            break;
        case '2':
            var fechaInicio = 0;
            var fechaFin = 0;
            var imesInicio = $('cbxMes1').value;
            var imesFin = $('cbxMes2').value;
            var iTrimestreInicio = 0;
            var iTrimestreFin = 0;
            var iSemestreInicio = 0;
            var iSemestreFin = 0;
            var ianioInicio = $('txtYear1').value;
            var ianiofin = $('txtYear2').value;
            break;
        case '3':
            var fechaInicio = 0;
            var fechaFin = 0;
            var imesInicio = 0;
            var imesFin = 0;
            var iTrimestreInicio = $('trimestre1').value;
            var iTrimestreFin = $('trimestre2').value;
            var iSemestreInicio = 0;
            var iSemestreFin = 0;
            var ianioInicio = $('txtYearTre1').value;
            var ianiofin = $('txtYearTre2').value;
            break;
        case '4':
            var fechaInicio = 0;
            var fechaFin = 0;
            var imesInicio = 0;
            var imesFin = 0;
            var iTrimestreInicio = 0;
            var iTrimestreFin = 0;
            var iSemestreInicio = $('semestre1').value;
            var iSemestreFin = $('semestre2').value;
            var ianioInicio = $('txtYearSe1').value;
            var ianiofin = $('txtYearSe2').value;
            break;
        case '5':
            var fechaInicio = 0;
            var fechaFin = 0;
            var imesInicio = 0;
            var imesFin = 0;
            var iTrimestreInicio = 0;
            var iTrimestreFin = 0;
            var iSemestreInicio = 0;
            var iSemestreFin = 0;
            var ianioInicio = $('txtAnual1').value;
            var ianiofin = $('txtAnual2').value;
            break;
    }
    var patronModulo = 'TablaLeyendaGrafica';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += "&p2=" + Estados;
    parametros += "&p3=" + Atencion;
    parametros += "&p4=" + Programacion;
    parametros += "&p5=" + Medicos;
    parametros += "&p6=" + Servicios;
    parametros += "&p7=" + AmbiFi;
    parametros += "&p8=" + AmbiLo;
    parametros += "&p9=" + Sedes;
    parametros += "&p10=" + Turnos;
    parametros += "&p11=" + opcion;
    parametros += "&p12=" + fechaInicio;
    parametros += "&p13=" + fechaFin;
    parametros += "&p14=" + imesInicio;
    parametros += "&p15=" + imesFin;
    parametros += "&p16=" + iTrimestreInicio;
    parametros += "&p17=" + iTrimestreFin;
    parametros += "&p18=" + iSemestreInicio;
    parametros += "&p19=" + iSemestreFin;
    parametros += "&p20=" + ianioInicio;
    parametros += "&p21=" + ianiofin;
    parametros += "&p22=" + Actividades;
    var contenedorLeyenda = 'contenedorTablaLeyenda' + numeroGrafico;
    $(contenedorLeyenda).show();
    var cadena = '';
    var variable = 'aLeyenda';
    var nombretabla = '';
    cadena += eval(variable + numeroGrafico) + '=new dhtmlXGridObject(contenedorLeyenda);';
    cadena += eval(variable + numeroGrafico) + '.setImagePath("../../../imagen/dhtmlxgrid/imgs/");';
    cadena += eval(variable + numeroGrafico) + '.setSkin("");';
    cadena += eval(variable + numeroGrafico) + '.enableRowsHover(true,"grid_hover");';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onRowSelect", function(rId,cInd){';
    cadena += '});';
    cadena += 'contadorCargador++;';
    cadena += 'var idCargador=contadorCargador;';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onXLS", function(){';
    cadena += 'cargadorpeche(1,idCargador);';
    cadena += '});';
    cadena += eval(variable + numeroGrafico) + '.attachEvent("onXLE", function(){';
    cadena += 'cargadorpeche(0,idCargador);';
    cadena += '});';
    cadena += eval(variable + numeroGrafico) + '.setSkin("");';
    cadena += eval(variable + numeroGrafico) + '.init();';
    cadena += eval(variable + numeroGrafico) + '.loadXML(pathRequestControl+"?"+parametros,function(){';
    cadena += '});';
    eval(cadena);
}

function eliminarEstadisticaGuardada(IdGrafico) {
    var patronModulo = '';
    patronModulo = 'eliminarEstadisticaGuardada';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + IdGrafico;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            cargarTablaHistoriaEstadistica()
        }
    })
}

function ocultarDivMaestrosVacios() {
    if ($("Estados").value == "") {
        $('con1').hide();
    }
    if ($("Atencion").value == "") {
        $('con2').hide();
    }
    if ($("Programacion").value == "") {
        $('con3').hide();
    }
    if ($("ContadorMedicos").value == 0) {
        $('con4').hide();
    }
    if ($("ContadorServicios").value == 0) {
        $('con5').hide();
    }
    if ($("ContadorAfiliaciones").value == 0) {
        $('con7').hide();
    }
    if ($("ContadorAmbientesLo").value == 0) {
        $('con6').hide();
    }
    if ($("Sedes").value == "") {
        $('con8').hide();
    }
    if ($("Turnos").value == "") {
        $('con9').hide();
    }
    if ($("Actividades").value == "") {
        $('con11').hide();
    }

}



function cargarCuerpoReporteDiagnostico() {
    var dhxLayout1 = new dhtmlXLayoutObject("parentId1", "2E", "dhx_web");
    dhxLayout1.cells("a").setText("Filtros");
    dhxLayout1.cells("a").attachObject("contenedorFiltros");
    dhxLayout1.cells("b").setText("Graficos");
    dhxLayout1.cells("b").attachObject("contenedorGraficos");
    dhxLayout1.cells("a").setHeight(140);
    dhxLayout1.cells("b").setHeight(560);
}

function ocultarFiltros(vNombreObjeto, vThis) {
    if ($(vThis).checked == true) {
        $(vNombreObjeto).show();
    } else {
        $(vNombreObjeto).hide();
    }
}



function abrirPopudDiagnosticos() {
    posFuncion = "";
    vtitle = '';
    vformname = 'abrirPopudDiagnosticosReporte';
    vwidth = '900';
    vheight = '600';
    patronModulo = 'abrirPopudDiagnosticosReporte';
    vcenter = 't';
    vresizable = '';
    vmodal = 'false';
    vstyle = '';
    vopacity = '';
    veffect = '';
    vposx1 = '';
    vposx2 = '';
    vposy1 = '';
    vposy2 = '';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
}

function listarBusquedaCIE(evento) {
    var vNombreCie = $('txtBusquedaCIE').value;
    var lenght = vNombreCie.length;
    if (evento.keyCode == '13') {
        if (lenght >= 4) {
            var patronModulo = '';
            patronModulo = 'listarBusquedaCIE';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + vNombreCie;
            contadorCargador++;
            var idCargador = contadorCargador;
            new Ajax.Request(pathRequestControl, {
                method: 'get',
                asynchronous: false,
                parameters: parametros,
                onLoading: cargadorpeche(1, idCargador),
                onComplete: function (transport) {
                    cargadorpeche(0, idCargador);
                    var respuesta = transport.responseText;
                    $('lstTablaListadoCie').update(respuesta);
                }
            })
        }
    }
}

function agregarCieReporte(iIdCie, vNombreCie) {
    $('txtIdDiagnostico').value = iIdCie;
    $('txtDiagnostico').value = vNombreCie;
    Windows.close("Div_abrirPopudDiagnosticosReporte");
}

function mostrarReportesEstadisticos() {
    var vAccion = "";
    if ($('chkSede').checked == false && $('chkAfiliacion').checked == false && $('chkDiagnostico').checked == false) {
        vAccion = "Fechas";
    }
    if ($('chkSede').checked == false && $('chkAfiliacion').checked == true && $('chkDiagnostico').checked == false) {
        vAccion = "FechasAfiliacion";
    }
    if ($('chkSede').checked == true && $('chkAfiliacion').checked == false && $('chkDiagnostico').checked == false) {
        vAccion = "FechasSede";
    }
    if ($('chkSede').checked == false && $('chkAfiliacion').checked == false && $('chkDiagnostico').checked == true) {
        vAccion = "FechasCIE";
    }
    if ($('chkSede').checked == true && $('chkAfiliacion').checked == true && $('chkDiagnostico').checked == false) {
        vAccion = "FechasAfiliacionSede";
    }
    if ($('chkSede').checked == false && $('chkAfiliacion').checked == true && $('chkDiagnostico').checked == true) {
        vAccion = "FechasAfiliacionCIE";
    }
    if ($('chkSede').checked == true && $('chkAfiliacion').checked == false && $('chkDiagnostico').checked == true) {
        vAccion = "FechasSedeCIE";
    }
    if ($('chkSede').checked == true && $('chkAfiliacion').checked == true && $('chkDiagnostico').checked == true) {
        vAccion = "FechasAfiliacionSedeCIE";
    }

    var sede1 = "";
    var sede2 = "";
    var sede3 = "";
    var sede4 = "";
    if ($('chkHMLO').checked == true) {
        sede1 = "1";
    }
    if ($('chkTREBOL').checked == true) {
        sede2 = "2";
    }
    if ($('chkVILLASOL').checked == true) {
        sede3 = "3";
    }
    if ($('chkPROLIMA').checked == true) {
        sede4 = "4";
    }


    var fecha1 = $('txtfecha1').value;
    var fecha2 = $('txtfecha2').value;
    var afiliacion = $('cbxafiliacion').value;
    var sede = "";
    var diagnostico = $('txtIdDiagnostico').value;
    var patronModulo = '';
    patronModulo = 'mostrarReportesEstadisticos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + vAccion;
    parametros += '&p3=' + fecha1;
    parametros += '&p4=' + fecha2;
    parametros += '&p5=' + afiliacion;
    parametros += '&p6=' + sede;
    parametros += '&p7=' + diagnostico;
    parametros += '&p8=' + sede1;
    parametros += '&p9=' + sede2;
    parametros += '&p10=' + sede3;
    parametros += '&p11=' + sede4;
    aHistoriaEstadisticaCIE = new dhtmlXGridObject('contenedorGraficos');
    aHistoriaEstadisticaCIE.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aHistoriaEstadisticaCIE.setSkin("dhx_terrace");
    aHistoriaEstadisticaCIE.enableRowsHover(true, 'grid_hover');
    aHistoriaEstadisticaCIE.attachEvent("onRowSelect", function (rId, cInd) {
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aHistoriaEstadisticaCIE.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    aHistoriaEstadisticaCIE.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    aHistoriaEstadisticaCIE.setSkin("dhx_terrace");
    aHistoriaEstadisticaCIE.init();
    aHistoriaEstadisticaCIE.loadXML(pathRequestControl + '?' + parametros, function () {

    });
}


function buscarReporteGruposEtareos() {
    //var iIdCPT = $("txtiIdCPT").value;
    var patronModulo = 'buscarReporteGruposEtareos';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    // parametros += '&p2=' + iIdCPT;
    tablaBuscarReporteGruposEtareos = new dhtmlXGridObject('div_TablaGrupoEtareo');
    tablaBuscarReporteGruposEtareos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaBuscarReporteGruposEtareos.setSkin("dhx_skyblue");
    tablaBuscarReporteGruposEtareos.attachEvent("onRowSelect", function (fila, columna) {
        var iIdGrupoEtareo = tablaBuscarReporteGruposEtareos.cells(fila, 1).getValue();
        var ServComple = tablaBuscarReporteGruposEtareos.cells(fila, 5).getValue();
        buscarPersonasGrupoEtareo(iIdGrupoEtareo, ServComple);
    });
    tablaBuscarReporteGruposEtareos.enableMultiline(true);
    tablaBuscarReporteGruposEtareos.init();
    tablaBuscarReporteGruposEtareos.loadXML(pathRequestControl + '?' + parametros);


}

function buscarPersonasGrupoEtareo(iIdGrupoEtareo, ServComple) {
    var patronModulo = 'buscarPersonasGrupoEtareo';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + iIdGrupoEtareo;
    parametros += '&p3=' + ServComple;
    tablaBuscarPersonasGrupoEtareo = new dhtmlXGridObject('div_TablaPersonasGrupoEtareo');
    tablaBuscarPersonasGrupoEtareo.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaBuscarPersonasGrupoEtareo.setSkin("dhx_skyblue");
    tablaBuscarPersonasGrupoEtareo.attachEvent("onRowSelect", function (fila, columna) {
        var c_cod_per = tablaBuscarPersonasGrupoEtareo.cells(fila, 0).getValue();
        VerCPTfaltantes(c_cod_per);
    });
    tablaBuscarPersonasGrupoEtareo.enableMultiline(true);
    tablaBuscarPersonasGrupoEtareo.init();
    tablaBuscarPersonasGrupoEtareo.loadXML(pathRequestControl + '?' + parametros);

}

function VerCPTfaltantes(c_cod_per) {
    vformname = 'formVerCPTfaltantes'
    vtitle = 'Ver Detalle de Servicios Faltantes'
    vwidth = '680'
    vheight = '420'
    vcenter = 't'
    vresizable = ''
    vmodal = 'false'
    vstyle = ''
    vopacity = ''

    vposx1 = ''
    vposx2 = ''
    vposy1 = ''
    vposy2 = ''
    patronModulo = 'MostrarCPTfaltantes';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + c_cod_per;
    posFuncion = 'CPTfaltantes';

    CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion)

}

function cargarCuerpoReporteRecetaMedica() {
    var dhxLayout1 = new dhtmlXLayoutObject("parentId1", "2E", "dhx_web");
    dhxLayout1.cells("a").setText("Filtros");
    dhxLayout1.cells("a").attachObject("contenedorFiltros");
    dhxLayout1.cells("b").setText("Graficos");
    dhxLayout1.cells("b").attachObject("contenedorGraficos");
    dhxLayout1.cells("a").setHeight(250);
    dhxLayout1.cells("b").setHeight(450);
    mostrarReportesEstadisticosREcetaMedica();
}

function mostrarObjetosReporteRecetaMedica(vThis, chk, Ocultar, chk2, blanqueoId, blanqueoDes) {
    if ($(chk).checked == true) {
        $(vThis).show();
        $(Ocultar).hide();
        $(chk2).checked = false;
        $(blanqueoId).value = '';
        $(blanqueoDes).value = '';
        $('contenedorGraficos').update(' ');
    } else {
        $(vThis).hide();
    }
}

function buscarMedicamento(evento) {
    var medicamento = $('txtMedicamento').value;
    if (evento.keyCode == '13') {
        if (medicamento == "") {
            alert('Escriba un Medicamento');
            $('contenedorGraficos').update(' ');
        } else {
            var patronModulo = 'buscarMedicamento';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + medicamento;
            tablabuscarMedicamento = new dhtmlXGridObject('contenedorGraficos');
            tablabuscarMedicamento.setImagePath("../../../../fastmedical_front/imagen/icono/");
            tablabuscarMedicamento.setSkin("dhx_skyblue");
            tablabuscarMedicamento.attachEvent("onRowSelect", function (fila, columna) {
                var c_cod_ser = tablabuscarMedicamento.cells(fila, 0).getValue();
                var v_Desc_ser_pro = tablabuscarMedicamento.cells(fila, 1).getValue();
                $('txtIdMedicamento').value = c_cod_ser;
                $('txtMedicamento').value = v_Desc_ser_pro;
                $('contenedorGraficos').update(' ');
            });
            tablabuscarMedicamento.enableMultiline(true);
            tablabuscarMedicamento.init();
            tablabuscarMedicamento.loadXML(pathRequestControl + '?' + parametros);
        }
    }

}
function buscarMEdico(evento) {
    var medico = $('txtMedico').value;
    if (evento.keyCode == '13') {
        if (medico == "") {
            alert('Escriba el nombre del Medico')
            $('contenedorGraficos').update(' ');
        } else {
            var patronModulo = 'buscarMEdico';
            var parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + medico;
            tablabuscarMedico = new dhtmlXGridObject('contenedorGraficos');
            tablabuscarMedico.setImagePath("../../../../fastmedical_front/imagen/icono/");
            tablabuscarMedico.setSkin("dhx_skyblue");
            tablabuscarMedico.attachEvent("onRowSelect", function (fila, columna) {
                var c_cod_per = tablabuscarMedico.cells(fila, 0).getValue();
                var Doctor = tablabuscarMedico.cells(fila, 1).getValue();
                $('txtIdMedico').value = c_cod_per;
                $('txtMedico').value = Doctor;
                $('contenedorGraficos').update(' ');
            });
            tablabuscarMedico.enableMultiline(true);
            tablabuscarMedico.init();
            tablabuscarMedico.loadXML(pathRequestControl + '?' + parametros);
        }
    }
}


function mostrarReportesEstadisticosREcetaMedica() {
    var vAccion = "";
    if ($('chkMedicamento').checked == false && $('chkMedico').checked == false) {
        vAccion = "Fechas";
    }
    if ($('chkMedicamento').checked == true && $('chkMedico').checked == false) {
        vAccion = "FechasMEdicamentos";
    }
    if ($('chkMedicamento').checked == false && $('chkMedico').checked == true) {
        vAccion = "FechasMedico";
    }


    var fecha1 = $('txtfecha1').value;
    var fecha2 = $('txtfecha2').value;
    var Medicamento = $('txtIdMedicamento').value;
    var Medico = $('txtIdMedico').value;
    var patronModulo = '';
    patronModulo = 'mostrarReportesEstadisticosREcetaMedica';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + vAccion;
    parametros += '&p3=' + fecha1;
    parametros += '&p4=' + fecha2;
    parametros += '&p5=' + Medicamento;
    parametros += '&p6=' + Medico;

    aHistoriaEstadisticaCIE = new dhtmlXGridObject('contenedorGraficos');
    aHistoriaEstadisticaCIE.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    aHistoriaEstadisticaCIE.setSkin("dhx_terrace");
    aHistoriaEstadisticaCIE.enableRowsHover(true, 'grid_hover');
    aHistoriaEstadisticaCIE.attachEvent("onRowSelect", function (rId, cInd) {
    });
    contadorCargador++;
    var idCargador = contadorCargador;
    aHistoriaEstadisticaCIE.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    aHistoriaEstadisticaCIE.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    aHistoriaEstadisticaCIE.setSkin("dhx_terrace");
    aHistoriaEstadisticaCIE.init();
    aHistoriaEstadisticaCIE.loadXML(pathRequestControl + '?' + parametros, function () {

    });
}


function cargarArbolListaReportesESSALUD() {
    treeEssalud = new dhtmlXTreeObject("divContenedorArbolESSALUD", "100%", "100%", 0);
    treeEssalud.setSkin('dhx_skyblue');
    treeEssalud.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeEssalud.attachEvent("onClick", function () {
        clickCargarVistaReportesEssalud(treeEssalud.getSelectedItemId(), treeEssalud.getSelectedItemText());
    });
    treeEssalud.openAllItems(0);
    treeEssalud.loadXML("../reporte/generarArbolESSALUD.xml");
}



function cargarTablaProgramacionDHTMLX() {
    alert('paso');
    var patronModulo = '';
    patronModulo = 'cargarTablaProgramacionDHTMLX';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    cargarTablaProgramacionDHTMLX = new dhtmlXGridObject('contenedorTablitaImprimibleAngelSayes');
    cargarTablaProgramacionDHTMLX.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    cargarTablaProgramacionDHTMLX.setSkin("dhx_skyblue");
    cargarTablaProgramacionDHTMLX.enableRowsHover(true, 'grid_hover');
    cargarTablaProgramacionDHTMLX.attachEvent("onRowSelect", function (rId, cInd) {

    });
    contadorCargador++;
    var idCargador = contadorCargador;
    cargarTablaProgramacionDHTMLX.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    cargarTablaProgramacionDHTMLX.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
        ;
    });
    cargarTablaProgramacionDHTMLX.init();
    cargarTablaProgramacionDHTMLX.loadXML(pathRequestControl + '?' + parametros, function () {

    });
}

function clickCargarVistaReportesEssalud(id, text) {
    var html = id.split("|");
    var dhxLayout;
    var patronModulo = '';
    if (html != 'rpt') {
        patronModulo = 'clickCargarVistaReportesEssalud';
        var parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + html[0];
        parametros += '&p3=' + html[1];
        contadorCargador++;
        var idCargador = contadorCargador;
        new Ajax.Request(pathRequestControl, {
            method: 'get',
            asynchronous: false,
            parameters: parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete: function (transport) {
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $('contenidoCuerpoReporte').update(respuesta);
                if (html[0] == '5') {
                    calendarioAtencionesPreventivas();
                }
                if (html[0] == '3') {
                    armarEsqueletoAccordion();
                }
                if (html[0] == '9') {
                    cargarTablaProgramacionDHTMLX();
                }
                if (html[0] == '7') {
                    cargarArbolOperacionalTBC();
                }
                if (html[0] == '2') {
                    cargarArbolGridNSIG();
                }

            }
        })

    } else {

    }
}


function armarEsqueletoAccordion() {
    dhxAccord = new dhtmlXAccordion("divContenedorBody", "dhx_skyblue");
    dhxAccord.addItem("a1", "Completos por Grupo Etareo");
    dhxAccord.addItem("a2", "Incompletos");
    dhxAccord.addItem("a3", "Completos por Paquetes Etareos");
    dhxAccord.addItem("a4", "Completos Etregados");
    dhxAccord.openItem("a1");
}


function cargarArbolNSIG() {
    var patronModulo = '';
    patronModulo = 'cargarArbolNSIG';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    treeEssaludNISG = new dhtmlXTreeObject("divContenedorArbolESSALUDNSIG", "100%", "100%", 0);
    treeEssaludNISG.setSkin('dhx_skyblue');
    treeEssaludNISG.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeEssaludNISG.attachEvent("onClick", function () {

    });
    treeEssaludNISG.openAllItems(0);
    treeEssaludNISG.loadXML(pathRequestControl + '?' + parametros);
//    contadorCargador++;
//    var idCargador=contadorCargador;
//    new Ajax.Request(pathRequestControl,{
//        method : 'get',
//        asynchronous:false,
//        parameters : parametros,
//        onLoading : cargadorpeche(1,idCargador),
//        onComplete : function(transport){
//            cargadorpeche(0,idCargador);
//            var respuesta = transport.responseText;
//            alert(respuesta);
//            $('divContenedorArbolESSALUDNSIG').update(respuesta);
//   
//        }
//    }) 

}


function generarReporteModuloEssalud() {
    var dFechaInici = $('txtFechaMesInicio').value;
    var dFechaFin = $('txtFechaMesFin').value;
    var dPatron = $('txtPatroModulo').value;
    if (dFechaInici == '') {
        alert('Seleccione Fecha Inicio')
    }
    if (dFechaFin == '') {
        alert('Seleccione Fecha Fin')
    }
    if (dFechaFin != '' && dFechaFin != '') {
        window.open(
                "../../classReporte/reportes/setDatosReporte.php?p1=" + dPatron + "&p2=" + dFechaInici + "&p3=" + dFechaFin,
                'blank'
                );
    }

}


function imprimirAtencionesPreventivas(dFecha) {
    window.open(
            "../../classReporte/reportes/setDatosReporte.php?p1=historiasPreventivas&p2=" + dFecha,
            '_new'
            );
}


function calendarioAtencionesPreventivas() {
    window.dhx_globalImgPath = "../dhtmlxCalendar/";
    var fecha = new Date();
    var aniolimite = fecha.getFullYear() + 2;
    dhtmlxCalendarLangModules = new Array();
    dhtmlxCalendarLangModules['es'] = {
        langname: 'es',
        monthesFNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
        monthesSNames: ["Ene", "Feb", "May", "Аbr", "Маy", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        daysFNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        daysSNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekend: [0, 6],
        weekstart: 1,
        msgClose: "Cerrar",
        msgMinimize: "Minimizar",
        msgToday: "Hoy"
    }

    mCal = new dhtmlxCalendarObject('divContenedorCalendar', false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'

    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function (date) {
        var d = new Date(date);
        fecha = d.getDate() + "/" + parseInt(d.getMonth() + 1) + "/" + d.getFullYear();
        imprimirAtencionesPreventivas(fecha);
    });

    mCal.draw();


}


function verificarSubCarpetas(valorThis) {
    var patronModulo = '';
    patronModulo = 'verificarSubCarpetas';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valorThis;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorComboMes').update(respuesta);
            $('contenedorDirectorioMamografia').update(' ');

        }
    })
}


function verificarExistenciaCarpeta(valorThis) {
    var patronModulo = '';
    patronModulo = 'verificarExistenciaCarpeta';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + valorThis;
    parametros += '&p3=' + $('cbxAnio').value;
    parametros += '&p4=' + $('txtITem').value;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        asynchronous: false,
        parameters: parametros,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            $('contenedorDirectorioMamografia').update(respuesta);

        }
    })
}

function cargarArbolOperacionalTBC() {
    mygrid = new dhtmlXGridObject('gridbox');
    //alert("Cabeza");
    //mygrid.setImagePath('../../../dhtmlxGrid/codebase/imgs/');
    mygrid.setImagePath('../../../../fastmedical_front/imagen/csh_bluebooks_simedh/');
    mygrid.setSkin('dhx_skyblue');
    mygrid.setHeader("Servicio, [0-9],[10-14],[15-19],[20-44],[45-59],[60-mas],total");
    mygrid.setInitWidths("500,*,*,*,*,*,*,*")
    mygrid.setColTypes("tree,ro,ro,ro,ro,ro,ro,ro");
    mygrid.enableTreeGridLines(true);
    mygrid.enableMultiselect(true);

    mygrid.init();
    mygrid.kidsXmlFile = "../../../hospitalizacion/ccontrol/control/control.php?p1=cargarArbol";
    mygrid.loadXML("../../../hospitalizacion/ccontrol/control/control.php?p1=cargarArbol");
//mygrid.toPDF('../../../grid-excel-php/generate.php');
}


function cargarArbolGridNSIG() {
    var patronModulo = '';
    patronModulo = 'cargarArbolNSIG';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    dhtmlx_tree_grid_AngelSayes = new dhtmlXGridObject('divContenedorArbolESSALUDNSIG');
    dhtmlx_tree_grid_AngelSayes.setImagePath('../../../../fastmedical_front/imagen/csh_bluebooks_simedh/');
    dhtmlx_tree_grid_AngelSayes.setSkin('dhx_skyblue');
    dhtmlx_tree_grid_AngelSayes.setHeader("Item, Enero,Frebrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Setiembre,Octubre,Noviembre,Diciembre,Año");
    dhtmlx_tree_grid_AngelSayes.setInitWidths("350,*,*,*,*,*,*,*,*,*,*,*,*,*")
    dhtmlx_tree_grid_AngelSayes.setColTypes("tree,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
    dhtmlx_tree_grid_AngelSayes.enableTreeGridLines(true);
    dhtmlx_tree_grid_AngelSayes.enableMultiselect(true);
    dhtmlx_tree_grid_AngelSayes.init();
    dhtmlx_tree_grid_AngelSayes.kidsXmlFile = pathRequestControl + '?' + parametros;
    dhtmlx_tree_grid_AngelSayes.loadXML(pathRequestControl + '?' + parametros);
}

function imprimirBoucher() {
    var nroOrden = $("hdnNroOrdenCompraSeleccionado").value;
    var c_cod_per = $("txtCodPerDeOrdenGenerada").value;
    var datos = "p1=boucherPago&p2=" + nroOrden;
    datos += "&p3=" + c_cod_per;
    //location.href="../../classReporte/reportes/setDatosReporte.php?"+datos;
    var ruta = "../../classReporte/reportes/setDatosReporte.php?" + datos;
    window.open(ruta);

}