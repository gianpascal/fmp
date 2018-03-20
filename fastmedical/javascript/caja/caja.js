

var pathRequestControl = "../../ccontrol/control/control.php";
function calendarioGeneral() {
    fecha = new Date();
    aniolimite = fecha.getFullYear() + 2;
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

    mCal1 = new dhtmlxCalendarObject('dhtmlxCalendar1', false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'
    });
    mCal1.setOnClickHandler(seleccionar1);
    mCal1.setYearsRange(2000, aniolimite);
    mCal1.loadUserLanguage('es');
    mCal1.draw();
}
function seleccionar1(date) {
    $('txtcalendario1').value = mCal1.getFormatedDate(null, date);
    $('dhtmlxCalendar1').style.display = 'none';
}
function mostrarcalendar(id) {
    if ($(id).style.display == 'none')
        $(id).show();
    else
        $(id).hide();
}
function busquedaResponsabledesuCaja() {
    numeroCaja = $('cb_filtroCajas').value;
    if (numeroCaja != '0000') {
        patronModulo = 'busquedaResponsabledesuCaja';
        parametros = '';
        parametros += 'p1=' + patronModulo;
        parametros += '&p2=' + numeroCaja;

        new Ajax.Request(pathRequestControl, {
            method: 'get',
            parameters: parametros,
            onLoading: micargador(1),
            onComplete: function (transport) {
                micargador(0);
                respuesta = transport.responseText;
                $('txtresponsabledesucaja').value = respuesta;
            }
        })
    }
}

function mostrarTabsCierreCaja() {
    tabCierreCaja = new dhtmlXTabBar("Div_TabCierreCaja");
    //tabCierreCaja.setSkin('dhx_skyblue');
    tabCierreCaja.setImagePath("../../../imagen/dhtmlxTabbar/");
    tabCierreCaja.addTab("a1", "Parte Diario", "150px");
    tabCierreCaja.addTab("a2", "Consistencia", "150px");
    tabCierreCaja.setContent("a1", "Div_TablaParteDiarioCierreCaja");
    tabCierreCaja.setContent("a2", "Div_ConsistenciaCierreCaja");
    tabCierreCaja.setTabActive("a1");
}

function mostrarTablaParteDiariaCierreCaja(numerocaja, fechadeproceso) {

    patronModulo = 'mostrarTablaParteDiariaCierreCaja';
    parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + numerocaja;
    parametros += '&p3=' + fechadeproceso;

    tablaPartidaDiariaCierreCaja = new dhtmlXGridObject('Div_TablaParteDiarioCierreCaja');
    tablaPartidaDiariaCierreCaja.setImagePath("../../../../medifacil_front/imagen/icono/");
    tablaPartidaDiariaCierreCaja.setSkin("dhx_skyblue");
    tablaPartidaDiariaCierreCaja.init();
    tablaPartidaDiariaCierreCaja.loadXML(pathRequestControl + '?' + parametros);
}
function busquedaCierreCaja() {
    var idtipobusqueda = tabCierreCaja.getActiveTab();
    if (idtipobusqueda == "a1") {
        iniciarbusquedaParteDiariaCierreCaja();
    }
    if (idtipobusqueda == "a2") {
        iniciarbusquedaConsistenciaCierreCaja();
    }
}
function iniciarbusquedaConsistenciaCierreCaja() {
    // window.alert("alejandro");
}
function iniciarbusquedaParteDiariaCierreCaja() {
    numerocaja = $('cb_filtroCajas').value;
    if (numerocaja == '0000') {
        window.alert("Seleccione una caja");
        return;
    }
    fecha = $('txtcalendario1').value.split('/');
    fechadeproceso = fecha[2] + fecha[1] + fecha[0];

    mostrarTablaParteDiariaCierreCaja(numerocaja, fechadeproceso)
}

function cerrarCajaCierreCaja() {
    fecha = $('txtcalendario1').value;
    arreglo = fecha.split('/');
    fechadeproceso = arreglo[2] + arreglo[1] + arreglo[0];
    numeroCaja = $('cb_filtroCajas').value;
    if (numeroCaja != '0000') {
        if (confirm('\xBFEstá seguro de cerrar la caja para la fecha ' + fecha + ' ?')) {
            patronModulo = 'cerrarCajaCierreCaja';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + numeroCaja;
            parametros += '&p3=' + fechadeproceso;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    window.alert(respuesta);
                }
            })
        }
    } else {
        window.alert("Seleccione una caja...")
    }
}
function selecciontipodebusquedaCierreCaja() {
    tipobusqueda = $('combo_tipobusqueda').value;
    if (tipobusqueda == '2') {
        $('Div_rangoderecibos').show();
    } else {
        $('Div_rangoderecibos').hide();
    }
    codCaja = $('cb_filtroCajas').value;
    fechaHoy = $('txtcalendario1').value;
    arreglo = fechaHoy.split('/');
    fechadeproceso = arreglo[2] + arreglo[1] + arreglo[0];
    $('cboTipoComprobante').hide()
    //     alert(codCaja+'---'+fechaHoy);
    form = "";
    destino = "div_tipoComprobante";
    funcion = "";
    parametros = "p1=selecciontipoComprobante&p2=" + codCaja + '&p3=' + fechadeproceso;
    enviarFormulario(form, parametros, funcion, destino);

}
function anularCierreCaja() {
    fecha = $('txtcalendario1').value;
    arreglo = fecha.split('/');
    fechadeproceso = arreglo[2] + arreglo[1] + arreglo[0];
    numeroCaja = $('cb_filtroCajas').value;
    if (numeroCaja != '0000') {
        if (confirm('\xBFEstá seguro de anular el cierre de caja para la fecha ' + fecha + ' ?')) {
            patronModulo = 'anularCierreCaja';
            parametros = '';
            parametros += 'p1=' + patronModulo;
            parametros += '&p2=' + numeroCaja;
            parametros += '&p3=' + fechadeproceso;

            new Ajax.Request(pathRequestControl, {
                method: 'get',
                parameters: parametros,
                onLoading: micargador(1),
                onComplete: function (transport) {
                    micargador(0);
                    respuesta = transport.responseText;
                    window.alert(respuesta);
                }
            })
        }
    } else {
        window.alert("Seleccione una caja...")
    }
}


function reporteCajaPorCajero(fila) {
    codCajaC = $('cboCajeroC').value;
    txtFechaIni = $('txtFechaIniC').value;
    txtFechaFinal = $('txtFechaFinalC').value;
    //  alert(fila);
    if (fila == 1) {
        //        $('divReportePorNumeroCaja').show();
        parametros = "p1=reporteCajaPorCajero&p2=" + codCajaC + '&p3=' + txtFechaIni + '&p4=' + txtFechaFinal + '&p5=' + fila;
    }
    if (fila == 2) {
        //        $('divReportePorNumeroCaja').show();  
        parametros = "p1=reporteCajaPorCajero&p2=" + codCajaC + '&p3=' + txtFechaIni + '&p4=' + txtFechaFinal + '&p5=' + fila;
    }
    destino = "divReportePorNumeroCaja";
    form = "";
    funcion = "";
    enviarFormulario(form, parametros, funcion, destino);
}

function buscarReporteCaja() {
    var patronModulo = 'cargarReporteCaja';
    var parametros = '';
    parametros += 'p1=' + patronModulo;

    parametros += '&p2=' + $('txtFechaInicial').value;
    parametros += '&p3=' + $('txtFechaFinal').value;


    tablaReporteCaja = new dhtmlXGridObject('divReporteCaja');
    tablaReporteCaja.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaReporteCaja.setSkin("dhx_skyblue");
    tablaReporteCaja.enableRowsHover(true, 'grid_hover');
    var header = ["#text_filter", "#text_filter", "#text_filter", "#text_filter", "#text_filter", "#select_filter", "#text_filter", "#text_filter", , , , , , , , ];
    tablaReporteCaja.attachHeader(header);
    /*var parax = "";
     parax="p1=cargarComboProcedencia";
     var datosx=traerDataPrueba(parax);
     var filtroProcedencia=datosx[0];
     
     //    var filtroExamenesLab = "<input type='text' id='idFiltroExamenLab' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarExamenesLab();\" />"; 
     var filtro1="<select id='comboProcedencia' type='text'></select>";
     
     var header = [,,,"#text_filter","#select_filter","#select_filter","#text_filter",filtroProcedencia,"#select_filter","#select_filter"]; 
     tablaEstadoExamenes.attachHeader(header); 
     
     tablaEstadoExamenes.attachEvent("onRowSelect", function(rowId,cellInd){
     switch(cellInd){
     case 16:
     siguientePasoExamen();
     break;
     case 17:
     var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
     formatoLaboratorio(idCodExamen);
     break; 
     case 18:
     var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
     reprogramarExamen(idCodExamen);
     break; 
     case 19:
     var  idCodExamen = tablaEstadoExamenes.cells(rowId,1).getValue();
     anularExamen(idCodExamen);
     break; 
     }
     //siguientePasoExamen();
     });
     //////////para cargador peche////////////////
     
     
     //    tablaEstadoExamenes.attachEvent("onCellChanged", function(rId,cInd,nValue){
     //        xyz1(rId,cInd,nValue);
     //    });
     */
    contadorCargador++;
    var idCargador = contadorCargador;
    tablaReporteCaja.attachEvent("onXLS", function () {
        cargadorpeche(1, idCargador);
    });
    tablaReporteCaja.attachEvent("onXLE", function () {
        cargadorpeche(0, idCargador);
    });

    /////////////fin cargador ///////////////////////
    //    tablaEstadoExamenes.attachEvent("onRowDblClicked", function(rowId,cellInd){  
    //        //asignarExamenAPerfil();
    //    });  
    tablaReporteCaja.enableMultiline(true);
    tablaReporteCaja.init();
    //tablaEstadoExamenes.splitAt(2);
    tablaReporteCaja.attachFooter(",,,,,,,,TOTALES,<div id='div_imponible'>0</div>,<div id='div_igv'>0</div>,<div id='div_total'>0</div>,<div id='div_descuento'>0</div>,,", ["text-align:left;"]);
    //tablaReporteCaja.attachFooter("Income per Region,#cspan,<div id='nr_s'>0</div>,#cspan,<div id='sr_s'>0</div>,#cspan", ["text-align:left;"]);

    tablaReporteCaja.loadXML(pathRequestControl + '?' + parametros, function () {
        calcularTotalesReporteCaja();
//var casa;
        // setColorTablaTablaEstadoExamenes();
        // alert('peche');
        //            for(i=0;i<tablaEstadoExamenes.getRowsNum();i++){
        //                //casa = tablaEstadoExamenes.cells(i,9).getValue();
        //             tablaEstadoExamenes.setRowTextStyle(tablaEstadoExamenes.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        //            }
    });
    /*
     tablaReporteCaja.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
     if(stage==2 && cInd==7){
     return actualizarProcedenciaExamenLaboratorio(rId,nValue,oValue);
     }  
     });
     */


}

function calcularTotalesReporteCaja() {
    var imponible = document.getElementById("div_imponible");
    imponible.innerHTML = sumaReporteCaja(9);
    var igv = document.getElementById("div_igv");
    igv.innerHTML = sumaReporteCaja(10);
    var total = document.getElementById("div_total");
    total.innerHTML = sumaReporteCaja(11);
    var descuento = document.getElementById("div_descuento");
    descuento.innerHTML = sumaReporteCaja(12);
    return true;
}
function sumaReporteCaja(ind) {
    var out = 0;
    for (var i = 0; i < tablaReporteCaja.getRowsNum(); i++) {
        
        out += parseFloat(tablaReporteCaja.cells2(i, ind).getValue());
    }
    return out;
}
function exportarReporteCaja(extencion){

    var fechaInicio=$("txtFechaInicial").value;
    var fechaFinal=$("txtFechaFinal").value;
   
    //  parametros="p1=HorariosTurnos&p2="+codigoCordinar;
    var parametros="p1=exportarReporteCaja&p2="+fechaInicio+'&p3='+fechaFinal+'&p4='+ extencion;
          
    location.href= pathRequestControl+'?'+parametros;
    
    }
    
     