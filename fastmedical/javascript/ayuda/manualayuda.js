//mygrid.attachEvent("onRowSelect",acciondelosManuales);
var pathRequestControl = "../../ccontrol/control/control.php";

function recargarArbolAyuda()
{
    myDiv=document.getElementById('divOpcAyuda');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divOpcAyuda","100%","100%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        clickCargaManual(tree.getSelectedItemId(),tree.getSelectedItemText());
        return true;
    })
    tree.loadXML("../../../javascript/xml/arbolAyudas.xml");
    tree.openAllItems(0);

}

function clickCargaManual(id)
{
    switch(id)
    {
        case "0102060002":
            mostrarRegistroPaciente();
            break;
        case "0102060001":
            mostrarBusquedaPaciente();
            break;
        case "0102060003":
            mostrarAcreditacionEssalud();
            break;
        case "XXXX500001":
            mostrarBusquedaCita();
            break;
        case "XXXX500002":
            mostrarReservaCita();
            break;
        case "XXXX400001":
            mostrarConsultaTarifa();
            break;
        case "XXXX300001":
            mostrarConsultaOrden();
            break;
    }

}
function mostrarRegistroPaciente(){
    path='../manuales/registraPaciente.php';
    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);
        }
    } )
}

function mostrarBusquedaPaciente(){
    path='../manuales/busquedaPaciente.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

function mostrarAcreditacionEssalud(){
    path='../manuales/acreditacionEssalud.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

function mostrarBusquedaCita(){
    path='../manuales/buscaCita.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

function mostrarReservaCita(){
    path='../manuales/reservaCita.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

function mostrarConsultaTarifa(){
    path='../manuales/consultaTarifa.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

function mostrarConsultaOrden(){
    path='../manuales/consultaOrden.php';

    parametros='';
    new Ajax.Request( path,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);

        }
    } )
}

/*------------- Juan Carlos -----------------*/

/******* FUNCION PARA HACER EVENTO AL CLICKEAR EL ARBOL DE LOS MANUALES *******/

function seleccionarArbolManual()
{
    myDiv=document.getElementById('divOpcAyuda');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divOpcAyuda","100%","100%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        generaManual(tree.getSelectedItemId(),tree.getSelectedItemText(),'s');
        return true;
    }
    )
    tree.loadXML("../../../../carpetaDocumentos/arbol_manuales.xml");
//     tree.loadXML("../../../javascript/xml/arbol_manuales.xml");
    tree.openAllItems(0);
}
function mostrarArbolManualCompleto(){
    patronModulo='mostrarArbolManualCompleto';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divOpcAyuda').update(respuesta);
            seleccionarArbolManualCompleto();
        }
    } )
}

function seleccionarArbolManualCompleto()
{
    myDiv=document.getElementById('divOpcAyuda');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divOpcAyuda","100%","100%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        generaManual(tree.getSelectedItemId(),tree.getSelectedItemText(),'c');
        //            document.getElementById("divBotonNew").style.visibility='visible';
        //            document.getElementById("divBotonEditar").style.visibility='visible';
        //            document.getElementById("divBotonEliminar").style.visibility='visible';
        //disableNuevoItem();
        return true;
    }
    )
    tree.enableCheckBoxes(1);
    tree.loadXML("../../../../carpetaDocumentos/arbol_manuales_completo.xml");
//    tree.loadXML("../../../javascript/xml/arbol_manuales_completo.xml");
    tree.openAllItems(0);
// document.getElementById("txtArbol").value="Completo";
}

function generaManual(id,text,tip){
    patronModulo='generarManual';
    parametros='';
    parametros+='p1='+patronModulo+'&iIdManual='+id;
//    alert(text);
if(tip=='s'){seleccionarArbolManual();}
if(tip=='c'){seleccionarArbolManualCompleto();}
     
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);
        }
    } )
}


function nuevoManual(){
    patronModulo='nuevoManual';
    parametros='';
    parametros+='p1='+patronModulo;
    new Ajax.Request ( pathRequestControl,
    {
        method 	: 'get',
        parameters 	: parametros,
        onLoading	: micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);
        }
    }
    )
}

function nue_actManual(opt){
    idManual=document.getElementById("txtManual").value;
    codPadre=document.getElementById("txtPadre").value;
    jerarquia=document.getElementById("txtJerarquia").value;
    titulo=document.getElementById("txtTitulo").value;
    cuerpo = CKEDITOR.instances.txtCuerpo.getData();
    estado=document.getElementById("cboEstado").value;
    orden=document.getElementById("txtOrden").value;
    version=document.getElementById("txtVersion").value;
    formulario=document.getElementById("cboFormulario").value;
    nivel=document.getElementById("txtNivel").value;
    opcion=opt;
//    alert("cuerpo"+cuerpo);
    //----------------     codificar     ---------------
    cuerpo = cuerpo.replace(/&/g, 'clmj0');
    cuerpo = cuerpo.replace(/'/g, 'ljcm1');
    cuerpo = cuerpo.replace(/"/g, 'lcmj2');
    cuerpo = cuerpo.replace(/%/g, 'jclm3');
    cuerpo = cuerpo.replace(/#/g, 'mlcj4');
    cuerpo = cuerpo.replace(/\?/g, 'cmjl5');
//    alert(cuerpo);
    //-------------------------------------------------
    patronModulo='nuevo_actualizarManual';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idManual;
    parametros+='&p3='+codPadre;
    parametros+='&p4='+jerarquia;
    parametros+='&p5='+titulo;
    parametros+='&p6='+cuerpo;
    parametros+='&p7='+estado;
    parametros+='&p8='+orden;
    parametros+='&p9='+version;
    parametros+='&p10='+formulario;
    parametros+='&p11='+nivel;
    parametros+='&p12='+opt;

    new Ajax.Request ( pathRequestControl,
    {
        method      : 'post',
        parameters  : parametros,
        onLoading   : function(transport){
            est_cargador(1);
        },
        onComplete  : function(transport){
            est_cargador(0);
            $('divInfo').innerHTML=transport.responseText;
            if (CKEDITOR.instances['txtCuerpo']) {
                CKEDITOR.remove(CKEDITOR.instances['txtCuerpo']);
            }
        }
    }
    )
         mostrarManuales();
        generaManual(idManual,'','');                   
}

function actualizarManual(){
    patronModulo='actualizar';
    parametros='';
    parametros+='p1='+patronModulo;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divOpcAyuda').update(respuesta);
            seleccionarArbolManualCompleto();
        }
    } )
}
function manualesActivos(){
    seleccionarArbolManual();

}
function manualesTodos(){
    mostrarArbolManualCompleto();
}

function editaManual(){
    patronModulo='editaManual';
    idManual=document.getElementById("txtManual").value;
    parametros='';
    parametros+='p1='+patronModulo+'&iIdManual='+idManual;
    new Ajax.Request(pathRequestControl,{
        method : 'post',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);
        }
    } )
}

function eliminaManual(){
    patronModulo='eliminaManual';
    idManual=document.getElementById("txtManual").value;
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+idManual;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAyuda').update(respuesta);
        }
    } )
}
function asignarPadre(){
    titulo='Busqueda...'
    vFormaAbrir='VENTANA'
    vformname='asignarPadre'
    vtitle='ASIGNAR MANUAL PADRE'
    vwidth='400'
    vheight='520'
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    veffect=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    file01=''
    vfunctionjava=''
    /*---------------------------------------*/
    patronModulo='asignarPadre'; //p1: va al control y recuperar la data para armar el arbol arbol_manuales.xml
    parametros='';
    parametros+='p1='+patronModulo;
    /*--------------------------------------*/
    posFuncion='arbolAsignarPadre';

    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
}

function arbolAsignarPadre()
{
    myDiv=document.getElementById('divAsignarPadre');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divAsignarPadre","100%","100%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){
        capturarPadre(tree.getSelectedItemId(),tree.getSelectedItemText());
        return true;
    }
    )
//    tree.loadXML("../../../javascript/xml/arbol_manuales.xml");
     tree.loadXML("../../../../carpetaDocumentos/arbol_manuales.xml");
    tree.openAllItems(0);
}

function capturarPadre(id){
    patronModulo='capturaPadre';
    parametros='';
    parametros+='p1='+patronModulo+'&iIdManual='+id;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            var miarray=respuesta.split("|");
            document.getElementById("txtDescripcionPadre").value=miarray[1];
            document.getElementById("txtPadre").value=miarray[0];
            document.getElementById("txtJerarquia").value=miarray[2];
            document.getElementById("txtNivel").value=miarray[3];
            document.getElementById("txtOrden").value=miarray[4];
        }
    } )
}

function cerrarPopap(){
    Windows.close("Div_asignarPadre")
}
function listarObjetos() {
    var patronModulo = 'listaObjetos';
    var parametros = '';
    parametros += 'p1=' + patronModulo + '&p2=' + 'todos';
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var objetos = transport.responseJSON
            procesarObjetos(objetos);

        }
    });
}
function procesarObjetos(objetos) {
    var i;
    var total=objetos.length;
    var avance=0;
    for (i = 0; i < objetos.length; i++) {
        avance=100*i/total;
        obtenerObjeto(objetos[i],avance);
        
    }
}
function obtenerObjeto(objeto,avance){
    var patronModulo = 'obtenerObjeto';
    var parametros = '';
    parametros += 'p1=' + patronModulo;
    parametros += '&p2=' + objeto.esquema;
    parametros += '&p3=' + objeto.objeto;
    parametros += '&p4=' + objeto.type;
    contadorCargador++;
    var idCargador = contadorCargador;
    new Ajax.Request(pathRequestControl, {
        method: 'get',
        parameters: parametros,
        asynchronous: false,
        onLoading: cargadorpeche(1, idCargador),
        onComplete: function (transport) {
            cargadorpeche(0, idCargador);
            var respuesta = transport.responseText;
            //var valor=$('respuesta').value;
            $('respuesta').update(avance+"%-"+respuesta+'\n');
            
        }
    });
}
