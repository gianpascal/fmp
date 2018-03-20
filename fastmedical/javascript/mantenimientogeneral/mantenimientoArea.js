var url = '../../ccontrol/control/control.php';
var pathRequestControl = "../../ccontrol/control/control.php";
//*****************************************************JOSE DELGADO**********************************************************************//
//***********************************************FUNCIONES UTILIZADAS EN VISTA MANTENIMIENTOAREA ****************************************//
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
function listaAreaXSede (){
    $("divTablaAreaSede").show();
    idSede=$("cboSede").value;
    if(idSede==""){
        alert("Por favor seleccione una Sede ...");
        $("btnNuevaArea").hide();
        return;
    }
    else{
        $("btnNuevaArea").show();
        $("htxtDescripcionSedex").value=$('cboSede').options[$('cboSede').selectedIndex].text.trim();
        $("hidIdAreaSede").value=idSede.trim();
    }
    parametros="p1=listAreaSucursal&p2="+idSede;
    div="divTablaAreaSede";
    funcionClick="setAreaXSede";
    funcionDblClick="";
    funcionLoad="";
    generarTablay(div,parametros,funcionClick,funcionDblClick,funcionLoad);
}

function setAreaXSede(fil,col){
  
    idSedeEmpresaArea=$("cboSede").value.trim();
    idArea=mygridy.cells(fil,1).getValue().trim();
   
    
    $("htxtDescripcionAreax").value=mygridy.cells(fil,2).getValue().trim();
    $("htxtIdAreax").value=idArea;
    
    
    if(idSedeEmpresaArea==""){
        $("btnNueaSubArea").hide();
    }
    else{
        $("btnNueaSubArea").show();
    }
    this.listSubAreaXAreaXSede(idSedeEmpresaArea,idArea);
//alert(idSedeEmpresaArea+' '+idArea);
}
function listSubAreaXAreaXSede(hidIdAreaSede,hidArea){
    if(hidIdAreaSede != "" && hidArea!=""){
        parametros="p1=listSubAreaXAreaXSede&p2="+hidArea+"&p3="+hidIdAreaSede;
        div="divSubAreaXAreaXSede";
        funcionClick="";
        funcionDblClick="";
        funcionLoad="";
    
        generarTablaz(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    }
}

function abrirSubArea(opt,fil){
    //   alert('idAreaSede='+$("hidIdAreaSede").value+' idSede='+$("cboSede").value);

    if(idArea!=""){
   
    
        posFuncion = "buscarSubarea('all')";
        //posFuncion = "";
        vtitle="Registrar Nueva Sub Area";
        vformname='EtiquetaAtributo';
        vwidth='600';
        vheight='400';
        //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
        patronModulo='nuevaSubArea';
        vcenter='t';
        vresizable=''
        vmodal='false';
        vstyle='';
        vopacity='';
        veffect='';
        vposx1='';
        vposx2='';
        vposy1='';
        vposy2='';
        parametros='';
        parametros+='p1='+patronModulo;
        this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    }
    else
    {
        alert("Seleecione una Área");
    }
}

function buscarSubarea(opt){
    $("txtDescripcionSede").value=$('cboSede').options[$('cboSede').selectedIndex].text.trim();
    $("txtDescripcionAreax").value=$("htxtDescripcionAreax").value;
    $("divFilter").show();
    $("divTablaSubAreaCont").show();
    $("divMantenimientoSubArea").hide();
    $("divAsignarSubArea").show();
    nomSubArea=$("txtNombreSubArea").value;
    parametros="p1=buscarSubArea&p2="+idArea+"&p3="+nomSubArea;
    //alert(parametros);
    div="divTablaSubArea";
    funcionClick="clickTablaSubArea";
    funcionDblClick="";
    funcionLoad="setColorTablaAreaEstado"; 
    if(nomSubArea==""  || nomSubArea.length>3 || opt=="all"){
        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
    }
}

function clickTablaSubArea(fil, col){
    $("txtDescripcionSubAreax").value="";
    $("txtAbreviaturaSubAreax").value="";
    $("hidIdSubAreax").value=mygridx.cells(fil,0).getValue().trim();
    idSubArea=mygridx.cells(fil,0).getValue().trim();
    if(col==6){// Editar   
        $("txtDescripcionSubAreax").value=mygridx.cells(fil,2).getValue().trim();
        $("txtAbreviaturaSubAreax").value=mygridx.cells(fil,3).getValue().trim();
        $("txtEstadoSubAreax").value=mygridx.cells(fil,5).getValue().trim();
        $("btnModificar").show();
        $("divMantenimientoSubArea").show();
        $("btnGrabar").hide();
        $("divTablaSubAreaCont").hide();
        $("divFilter").hide();
        $("divAsignarSubArea").hide();
    //        abrirArea("editar",fil);
    }else if(col==2||col ==3||col ==5){
        estadoSubArea = mygridx.cells(fil,4).getValue();
        idSubArea=mygridx.cells(fil,0).getValue();
        if(estadoSubArea=='1'){
            $("btnGrabar").show();
            $("btnModificar").hide();
        }else if(estadoSubArea=='0'){
            alert("Por Favor Active la Sub Area ...");
        }
    // editarEncargado(idSubArea);
    }
}


function nuevoDatosSubArea(){
    //  alert("Hola");
    $("btnGrabar").show();
    $("btnModificar").hide();
    $("divMantenimientoSubArea").show();
    $("divFilter").hide();
    $("divTablaSubAreaCont").hide();
    $("divAsignarSubArea").hide();
    $("hidIdAreax").value="";
    $("txtDescripcionAreax").value="";
    $("txtAbreviaturaAreax").value="";
}

function CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
{
    
    myRand = parseInt(Math.random()*999999999999999);
    if(vwidth==undefined || vwidth==0) vwidth=700;
    if(vheight==undefined || vheight==0) vheight=400;
    if(vposx1==undefined || vposx1==0) vposx1=25;
    if(vposy1==undefined || vposy1==0) vposy1=110;
    if(vposx2==undefined || vposx2==0) vposx2=25;
    if(vposy2==undefined || vposy2==0) vposy2=110;

    if(vresizable==undefined || vresizable==0) vresizable=true;else vresizable=false;
    if(vstyle==undefined || vstyle==0) vstyle="alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if(vmodal==undefined || vmodal==0) vmodal=false;else vmodal=true;
    if(vopacity==undefined || vopacity==0) vopacity=1;
    if(vcenter==undefined || vcenter==0 || vcenter == 't') vcenter=true; else vcenter=false;
    if(vtitle==undefined) vtitle=vformname;
    if(!ExisteObjeto("Div_"+vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid="Div_"+vformname;
        vidfrm="Frm_"+vformname;
        var vzindex = 100;
        var win;
        if(vmodal==true || vmodal==1)
            win = new Window({
                id: vid,
                className: vstyle,
                title:vtitle,
                width:vwidth,
                height:vheight,
                zIndex:vzindex,
                opacity:vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title:vtitle,
                width:vwidth,
                height:vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='"+vidfrm+"'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if(vcenter==true || vcenter==1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left:vposx1,
            right:vposx2,
            top: vposy1,
            bottom:'auto'
        })
        win.toFront();
        contadorCargador++;
        var idCargador = contadorCargador;  
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading: cargadorpeche(1, idCargador),
            onComplete : function(transport){
                cargadorpeche(0, idCargador);

                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                posFuncion+="('')";
                eval(posFuncion);
            }
        } )
    }
}

function CargarVentanaPopPapJorge(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)
{   
    myRand = parseInt(Math.random()*999999999999999);
    if(vwidth==undefined || vwidth==0) vwidth=700;
    if(vheight==undefined || vheight==0) vheight=400;
    if(vposx1==undefined || vposx1==0) vposx1=25;
    if(vposy1==undefined || vposy1==0) vposy1=110;
    if(vposx2==undefined || vposx2==0) vposx2=25;
    if(vposy2==undefined || vposy2==0) vposy2=110;

    if(vresizable==undefined || vresizable==0) vresizable=true;else vresizable=false;
    if(vstyle==undefined || vstyle==0) vstyle="alphacube";   // fondo y estilo
    //if(veffect==veffect || veffect==0) veffect="popup_effect";
    if(vmodal==undefined || vmodal==0) vmodal=false;else vmodal=true;
    if(vopacity==undefined || vopacity==0) vopacity=1;
    if(vcenter==undefined || vcenter==0 || vcenter == 't') vcenter=true; else vcenter=false;
    if(vtitle==undefined) vtitle=vformname;
    if(!ExisteObjeto("Div_"+vformname))
    {
        var vidfrm;
        // file02=decodeURIComponent(file02);
        var vid="Div_"+vformname;
        vidfrm="Frm_"+vformname;
        var vzindex = 100;
        var win;
        if(vmodal==true || vmodal==1)
            win = new Window({
                id: vid,
                className: vstyle,
                title:vtitle,
                width:vwidth,
                height:vheight,
                zIndex:vzindex,
                opacity:vopacity,
                resizable: vresizable
            });
        else
            win = new Window({
                id: vid,
                className: vstyle,
                title:vtitle,
                width:vwidth,
                height:vheight,
                resizable: vresizable
            });
        win.getContent().innerHTML = "<div id='"+vidfrm+"'></div>";
        //win.getContent().innerHTML = "<h1>No Constraint</h1>Wired mode<br><a href='#' onclick='Windows.getWindow(\"win3\").maximize()'>Maximize me</a>";
        win.setDestroyOnClose();
        if(vcenter==true || vcenter==1)
            win.showCenter(vmodal);
        else
            win.show(vmodal);
        win.setConstraint(true, {
            left:vposx1,
            right:vposx2,
            top: vposy1,
            bottom:'auto'
        })
        win.toFront();
        contadorCargador++;
        var idCargador = contadorCargador;  
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            asynchronous: false,
            onLoading: cargadorpeche(1, idCargador),
            onComplete : function(transport){
                cargadorpeche(0, idCargador);
                var respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                eval(posFuncion);
            }
        } )
    }
}

function setColorTablaAreaEstado(){
    vfila=5;
    for(i=0;i<mygridx.getRowsNum();i++){
        estado = mygridx.cells(i,vfila).getValue();
        if(estado=='1')
            mygridx.setRowTextStyle(mygridx.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        else if(estado=='0')
            mygridx.setRowTextStyle(mygridx.getRowId(i) ,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');

    }
}

//2012/02/17 12:44Pm esta funcion antes estaba en personal.js
//grabarSubArea(opt)
function grabarSubArea(opcion){
    //    alert("hola")
    //    datos=$("cboAreax").value;
    //    datos=datos.split("|");
    //    if(datos[1]==""){
    //        alert("Por favor seleccione Un área.");
    //        return;
    //    }
    //    var form="fromSubAreas",parametros="p1=grabarSubArea&p2="+opt,funcion="cargarTablaSubareasxx",destino="";
    //    enviarFormulario(form,parametros,funcion,destino);


    //*****************************************************************************************************************//

    if(opcion=="grabar"){
        parametros="p1=grabarSubArea";
        descripcion=$("txtDescripcionSubAreax").value;
        abrevia=$("txtAbreviaturaSubAreax").value;
        estado=$("txtEstadoSubAreax").value;
        parametros+="&p2="+descripcion.trim()+"&p3="+abrevia.trim()+"&p4="+estado+"&p5="+idArea;
        funcion="posModificarSubArea";
    } else if(opcion=="modificar"){
        parametros="p1=modificarSubArea";
        descripcion=$("txtDescripcionSubAreax").value;
        abrevia=$("txtAbreviaturaSubAreax").value;
        estado=$("txtEstadoSubAreax").value;
        funcion="posModificarArea";
        parametros+="&p2="+idSubArea+"&p3="+descripcion+"&p4="+abrevia+"&p5="+estado;
    }
    form="";
    destino="";
    //    alert(parametros);
    enviarFormulario(form,parametros,funcion,destino);
//    buscarArea("all");

}

function AsignarSubArea(){
    //    alert("Hola");
    
    if(hidIdAreax==""){
        alert("Por favor seleccione o registre un Area");
        return;
    }
    cboSucursal=$("cboSucursal").value;
    form="";
    funcion="";
    destino="divResulAreaSede";
    parametros="p1=asignarSedeArea&p2="+hidIdAreax+"&p3="+cboSucursal;
    enviarFormulario(form,parametros,funcion,destino);
}

function cargarArbolAreas(sede){
    ///var idVersion='4';
    
    //2012-04-02
    //editarArea=0;
    //idCadenaAreas="";
    
    parametros="p1=arbolAreas";
    parametros+="&p2="+sede;
    divMostrar=document.getElementById('arbolAreas');
    divMostrar.innerHTML = " ";
    treex=new dhtmlXTreeObject("arbolAreas","100%","100%",0);
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../medifacil_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function(){
        editarAreas(treex.getSelectedItemId(),treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl+'?'+parametros);
}

//23 enero

function cargarArbolodontologia(){
    ///var idVersion='4';
    
    //2012-04-02
    //editarArea=0;
    //idCadenaAreas="";
    
    parametros="p1=arbolPracticasOdontologicas";
    //parametros+="&p2="+sede;
    divMostrar=document.getElementById('arbolOdontologia');
    divMostrar.innerHTML = " ";
    treex=new dhtmlXTreeObject("arbolOdontologia","100%","100%",0);
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../medifacil_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function(){
        editarAreas(treex.getSelectedItemId(),treex.getSelectedItemText());
        return true;
    });
    treex.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treex.loadXML(pathRequestControl+'?'+parametros);
}




function opcionCkbSucursales(opc){
    sucursales="";
    var numCkb=document.getElementById("ckbSucursales").elements.length;
    switch(opc){     
        case 0:{
            for (i=0; i < numCkb; i++) {  
                if (document.getElementById("ckbSucursales").elements[i].type == 'checkbox' ) {
                    document.getElementById("ckbSucursales").elements[i].checked = false;
                    document.getElementById("ckbSucursales").elements[i].value=0;                  
                }  
            }
            break;
        }
        case 1:{
            for (i=0; i < numCkb; i++) {  
                if (document.getElementById("ckbSucursales").elements[i].type == 'checkbox' ) {
                    document.getElementById("ckbSucursales").elements[i].checked = true;
                    document.getElementById("ckbSucursales").elements[i].value=1;
                    sucursales+=document.getElementById("ckbSucursales").elements[i].id+"|";
                }  
            }
            break;         
        }
    }
//    alert(sucursales);
}

var sucursales=""
function cargarIdSucursal(idSucursal,opc){
    if(opc==1){
        //alert(idSucursal)
        sucursales+=idSucursal+"|";
    }
    else{
        sucursales=sucursales.replace(idSucursal+"|","")
    }
//alert(sucursales);
}


//***************************************************************************************************************************************//
//***********************************************FIN FUNCIONES UTILIZADAS EN VISTA MANTENIMIENTOAREA ************************************//
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//


//*****************************************************************2012/02/23************************************************************//
//***************************************************************************************************************************************//
//***********************************************FUNCIONES UTILIZADAS EN VISTA VMANTENIMIENTOAREA ***************************************//
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//

//Funcion Combo Areas Principales y Areas por sede y sucursal

function buscarArbolArea(){
    if($("cboSede").value.trim()!="XX"){
        $("asignacionAreas").hide();
        $("divNuevaAreaCatalogo").hide(); 
        $("divBtnNuevaAreaCatalogo").hide();
        $("divLeyenda1").hide();
        $("divLeyenda2").show();
        $("divResultados").hide();
        $('divResultadosInsercionArea').hide();
        cargarArbolAreas($("cboSede").value.trim());
        botonesAreaCatalogo(2);
        editarArea=0;
        grabarArea=0;
        opcionCkbSucursales(0);
        $('divSucursalesXidArea').hide();
        $('idInfoArea').hide();
        $('divEdicionSedeEmpresaArea').hide();
    }
    else{
        $("asignacionAreas").hide();  //modificado 2012/04/03  $("asignacionAreas").show()
        $("divNuevaAreaCatalogo").show(); // se activa cuando se presiona el btn
        $("divBtnNuevaAreaCatalogo").show();
        $("divResultados").show();
        //alert($("idLeyendaArbol").value);
        $("divLeyenda1").show();
        $("divLeyenda2").hide();
        cargarArbolAreas('');
        limpiarCajonesArea();
        $("divEdicionSedeEmpresaArea").hide();
        editarAreaCatalogo();
        
    }
}
var idCadenaAreas='';
var idArbolSeleccionado='';
var idPadreArbolSeleccionado='';
var nivelArbol='';
function editarAreas(a,b){ 
    idArbolSeleccionado=a;
    idCadenaAreas='';
    nivelArbol=treex.getLevel(a)-1;
    idPadreArbolSeleccionado=treex.getParentId(a);
    var idHijo='';
    var idPadre=a.trim();
    while (idPadre !="0"){
        idCadenaAreas+=idPadre+"|";  
        idHijo=idPadre;
        idPadre=treex.getParentId(idPadre);
    }
    idCadenaAreas=idCadenaAreas.replace(idHijo+"|",'')
    idCadenaAreas=idCadenaAreas.substring(idCadenaAreas.length -1,0)
    // solo cargar el estado al momento de darle click en nueva area
    if($("cboSede").value.trim()!="XX"){
        cambiaBotonesAreaXSede(1);
        if(a!=idHijo){
            $("divEdicionSedeEmpresaArea").show();
            if(idPadreArbolSeleccionado!=idHijo){
                $("txtIdAreaPadreXSede").value=idPadreArbolSeleccionado;
            }
            else{
                $("txtIdAreaPadreXSede").value="";    
            }
            $("txtDescripcionAreaPadreXSede").value=treex.getItemText(idPadreArbolSeleccionado);
            $("txtIdAreaXSede").value=a;
            $("txtDescripcionAreaXSede").value=treex.getItemText(a);
            $("txtNivelXSede").value=nivelArbol;
            preeditaAreaXSedeEmpresa(a,$("cboSede").value.trim(),$("txtNivelXSede").value.trim());
            //alert(a+' '+$("cboSede").value.trim()+' '+$("txtNivelXSede").value.trim())
            abilitaCajonesAreaXSede(2); 
        }
        else{
            limpiarCajonesAreaXsedeEmpresa();
        }
  
    }
    else{
        
        $("divResultadosInsercionArea").hide();
        $("idInfoArea").hide();
 
        if(editarArea==1 && grabarArea==0 &&  nivelArbol>0){
            //alert("hola");
            if(idPadreArbolSeleccionado!=idHijo){ 
                $("txtIdAreaPadre").value=idPadreArbolSeleccionado;
            }
            else{
                $("txtIdAreaPadre").value="";
            //alert("hola");
            }
            $("divEdicionSedeEmpresaArea").hide();
            $("divNuevaAreaCatalogo").show();    
            
            $("txtDescripcionAreaPadre").value=treex.getItemText(idPadreArbolSeleccionado);
            $("txtIdArea").value=a;
            $("txtDescripcionArea").value=treex.getItemText(a);
            $("txtNivel").value=nivelArbol;
            preeditaArea(a);
            preGrabarArea(idPadreArbolSeleccionado);
            abilitarCajonesAreaCatalogo(2);
            botonesAreaCatalogo(1);
            tablaSucursalesXidArea($("txtIdArea").value.trim());
        //alert("hola");
        }
        if(grabarArea==1 && editarArea==0){
            if(a!=idHijo){
                $("txtIdAreaPadre").value=a;
            }
            else{
                $("txtIdAreaPadre").value="";
            }
            $("txtDescripcionAreaPadre").value=b//treex.getSelectedItemText();
            $("txtIdArea").value="";
            $("txtDescripcionArea").value="";
            $("cboEstado").value=1;
            $("txtNivel").value=nivelArbol+1;
            preGrabarArea(a);
            abilitarCajonesAreaCatalogo(1);           
        }        
    }
}
function tablaSucursalesXidArea(idArea){
    $("divSucursalesXidArea").show();
    parametros='';
    parametros="p1=tablaSucursalesXidArea";
    parametros+="&p2="+idArea;
    //  alert(parametros);
    div="divResultadosSucursalesXidArea";
    funcionClick="editarTablaSucursalesXidArea";
    funcionDblClick="";
    funcionLoad="setColortablaSucursalesXidArea";
    generarTablay(div,parametros,funcionClick,funcionDblClick,funcionLoad); 
}
function setColortablaSucursalesXidArea(){
    setColorTablaAreaEstado(5,mygridy);
}

function editarTablaSucursalesXidArea(fil,col){
    if(col==8){ 
        if(confirm('¿Estás seguro que quiere eliminar el Área de la Sede')){
            var idSedeEmpresaArea=mygridy.cells(fil,0).getValue();
            // alert(codigoRegulariza);
            form="";
            destino="";
            funcion='tablaSucursalesXidArea('+$("txtIdArea").value.trim()+')';
            parametros="p1=actualizacionLogicaSedeEmpresaArea&p2="+idSedeEmpresaArea;
            enviarFormulario(form,parametros,funcion,destino); 
            $("divResultadosInsercionArea").hide();
        }
    }
}
function asignarAreaASucursal(opc){
    switch(opc){
        case 'nuevo':{
            if(idCadenaAreas.length>=1 && $("txtIdArea").value.trim().length>0){
                if(sucursales.length>=10){
                    if($("cboEstado").value.trim()==1){
                        //                          alert(treex.getSelectedItemText());
                        //                          alert('idAreas:'+idCadenaAreas)
                        //alert(sucursales.substring(sucursales.length -1,0))
                  
                        parametros="p1=guardarSedeEmpresaAreaMasivamente";
                        parametros+="&p2="+idCadenaAreas;
                        parametros+="&p3="+sucursales.substring(sucursales.length -1,0);
                        //  alert(parametros);
        
                        //alert(parametros);
                        div="divResultados";
                        funcionClick="";
                        funcionDblClick="";
                        funcionLoad="setColorTablaResultadosInsercionArea"; 
                        $("divResultadosInsercionArea").show();
                        generarTablax(div,parametros,funcionClick,funcionDblClick,funcionLoad);
                        tablaSucursalesXidArea($("txtIdArea").value.trim());
                        // para cerrar el podpad 2012/04/02
                        Windows.close("Div_podpadAsignacionAreaSede", "");
                        
                        
                    }
                    else {
                        alert("El Área se encuentra en estado INACTIVO activo primero el Área")
                    }
                }
                else{
                    alert("Seleccione las Sedes que desea Asignar!!!")
                }
            } 
            else{
                if(sucursales.length>=10){
                    alert("Debe Seleccionar la Área que desea asignar a las Sedes !!!");
                }
                else{
                    alert("Debe Seleccionar la Área y las Sedes")
                }
            }
            break;
        }
    }
}
function setColorTablaResultadosInsercionArea(){
    setColorTablaAreaEstado(2,mygridx);
}
var editarArea=0;
var grabarArea=0;
function nuevaAreaCatalogo(){
    //$("asignacionAreas").hide();
    // $("divNuevaAreaCatalogo").show();
    opcionCkbSucursales(0);
    $("divResultadosInsercionArea").hide();
    $("divEdita").hide();
    $("divActualiza").hide(); 
    $("btnAsignarArea").hide(); 
    $("divGraba").show();
    $("btnAsignarArea").hide();
    grabarArea=1; 
    editarArea=0;
    abilitarCajonesAreaCatalogo(2);
    limpiarCajonesArea();
    $("idInfoArea").hide();
    $("divSucursalesXidArea").hide();
    //alert(treex.getChildItemIdByIndex(0,0));
    //alert(treex.getChildItemIdByIndex(0,0)+' '+treex.getItemText(treex.getChildItemIdByIndex(0,0)));
    editarAreas(treex.getChildItemIdByIndex(0,0),treex.getItemText(treex.getChildItemIdByIndex(0,0)));    
}


function editarAreaCatalogo(){
    //    $("asignacionAreas").hide();
    //    $("divNuevaAreaCatalogo").show();
    //    $("divEdita").show();
    //    $("divActualiza").hide();  
    //    $("divGraba").hide();
    
    //alert("hola");
    editarArea=1;
    grabarArea=0;
    $('idInfoArea').hide();
    $("divResultadosInsercionArea").hide();
    $("btnAsignarArea").show();
    $("divEdita").show();
    $("divActualiza").hide();
    $("divGraba").hide();
    abilitarCajonesAreaCatalogo(2);
    limpiarCajonesArea();
////  alert(nuevaArea);
//podpadAsignacionAreaSede();

}

function abilitarCajonesAreaCatalogo(opc){
    switch(opc){
        case 1:{
            //Habilita los Cajones de Texto del Form Área Catalogo
            document.getElementById("txtDescripcionArea").disabled=false;
            document.getElementById("cboEstado").disabled=false;
            document.getElementById("txtAbreviaturaArea").disabled=false;
            break;
        }
        case 2:{
            document.getElementById("txtDescripcionArea").disabled=true;
            document.getElementById("cboEstado").disabled=true;  
            document.getElementById("txtAbreviaturaArea").disabled=true;
            break;
        }
        case 3:{
            document.getElementById("txtDescripcionArea").disabled=false;
            document.getElementById("cboEstado").disabled=true;  
            document.getElementById("txtAbreviaturaArea").disabled=false;  
            break;
        }
    }
}
//    document.getElementById("divEdita").style.display='none';
//    document.getElementById("divGraba").style.display='none';
//    document.getElementById("divActualiza").style.display='block';
//    document.getElementById("divElimina").style.display='block';
//    document.getElementById("btnAsignarPadre").style.visibility='hidden';

function limpiarCajonesArea(){
    $("txtIdAreaPadre").value="";
    $("txtDescripcionAreaPadre").value="";
    $("txtIdArea").value="";
    $("txtDescripcionArea").value="";
    $("txtAbreviaturaArea").value="";
    $("txtNivel").value="";
    $("cboEstado").value=-1;
   
}



function nuevaArea(opc){
    switch(opc){
        case 'actualizar':{
            if($("txtIdArea").value.length>=1){
                if($("cboEstado").value!=-1 && $("txtDescripcionArea").value.length>=1){
                    //                    alert("Hola");
                    patronModulo='modificarSubArea';
                    parametros='';
                    parametros+='p1='+patronModulo+'&p2='+$("txtIdArea").value.trim();
                    parametros+="&p3="+$("txtDescripcionArea").value.trim();
                    parametros+="&p4="+$("txtAbreviaturaArea").value.trim();
                    parametros+="&p5="+$("cboEstado").value;
                    new Ajax.Request(pathRequestControl,{
                        method : 'get',
                        parameters : parametros,
                        onLoading : micargador(1),
                        onComplete : function(transport){
                            micargador(0);
                            respuesta = transport.responseText;
                            var miarray=respuesta.split("|");
                            //document.getElementById("cboState").value=1;
                            document.getElementById("txtResultados").value=parseInt(miarray[0].trim());  
                            abilitarCajonesAreaCatalogo(2);
                            $("divEdita").show();
                            $("divActualiza").hide(); 
                            $("btnAsignarArea").show();
                            cargarArbolAreas("");
                            
                            editarArea=1;
                        }
                    } )
                //                 alert(parametros);
                 
                }
                else(alert("Seleccione un estado y complete la desripción del Área"))
            }
            else{
                alert("Seleccione el Área que quiere Actualizar primero!!!")
            }
            break;
        }
        case 'nuevo':{
            //  alert(idArbolSeleccionado.trim().length);
            // alert(treex.getChildItemIdByIndex(0,0));
            if($("txtDescripcionAreaPadre").value.trim().length>=1){
                if($("cboEstado").value.trim()!=-1 && $("txtDescripcionArea").value.length>=1){
                    if($("estadoPadre").value=="1"){
                        patronModulo='grabarAreaJerarquicamente';
                        parametros='';
                        parametros+='p1='+patronModulo+'&p2='+$("txtIdAreaPadre").value.trim();
                        parametros+="&p3="+$("txtDescripcionArea").value.trim();
                        parametros+="&p4="+$("txtAbreviaturaArea").value.trim();
                        parametros+="&p5="+$("cboEstado").value.trim();
                        parametros+="&p6="+$("txtNivel").value.trim();
                        form="";
                        funcion="nuevaAreaPostAbilita";
                        destino="idInfoArea";
                        enviarFormulario(form,parametros,funcion,destino);
                        cargarArbolAreas("");
                        abilitarCajonesAreaCatalogo(2);
                        break;
                    }
                    else{
                        alert("El Área Padre se encuentra con estado INACTIVO active primero el Área padre!!!")
                    }
                }
                else(alert("Seleccione un estado y complete la desripción del Área"))
            }
            else{
                alert("Seleccione el Área Padre primero!!!")
            }
        }
    }
}

function nuevaAreaPostAbilita(){
    $("divResultadosInsercionArea").hide();
    $("idInfoArea").show();
    $("divGraba").hide();
    grabarArea=0;
    editarArea=0;
    abilitarCajonesAreaCatalogo(2);

}

function preGrabarArea(idArea){
    patronModulo='preeditaArea';
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+idArea;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            var miarray=respuesta.split("|");
            //document.getElementById("cboState").value=1;
            document.getElementById("estadoPadre").value=parseInt(miarray[0].split(' ').join(''));
        //document.getElementById("txtAbreviaturaArea").value=miarray[1].trim();
        //            alert(miarray[1].trim());          
        }
    } )
}

function preeditaArea(idArea){
    patronModulo='preeditaArea';
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+idArea;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            var miarray=respuesta.split("|");
            //document.getElementById("cboState").value=1;
            document.getElementById("cboEstado").value=parseInt(miarray[0].split(' ').join(''));
            document.getElementById("txtAbreviaturaArea").value=miarray[1].trim();
        //            alert(miarray[1].trim());          
        }
    } )
}


function preeditaAreaXSedeEmpresa(idArea,idSedeEmpresa,nivel){
    patronModulo='preeditaAreaXSedeEmpresa';
    parametros='';
    parametros+='p1='+patronModulo+'&p2='+idArea;
    parametros+='&p3='+idSedeEmpresa;
    parametros+='&p4='+nivel;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            var miarray=respuesta.split("|");
            //document.getElementById("cboState").value=1;
            document.getElementById("cboEstadoXSede").value=parseInt(miarray[0].split(' ').join(''));
            document.getElementById("txtAbreviaturaAreaXSede").value=miarray[1].trim();
            //idSedeEmpresaArea
            document.getElementById("idSedeEmpresaArea").value=miarray[2].trim();
        //            alert(miarray[1].trim());          
        }
    } )
}


function botonesAreaCatalogo(opc){
    switch(opc){
        case 1: {
            $("divActualiza").hide();
            $("divEdita").show();
            $("divGraba").hide();
            $("btnAsignarArea").show();
            break;
        }
        case 2: {
            $("divActualiza").hide();
            $("divEdita").hide();
            $("divGraba").hide();
            $("btnAsignarArea").hide();
            break;
        }
    }
}


function editaArea(){
    $("divEdita").hide();
    $("divActualiza").show(); 
    $("btnAsignarArea").hide();
    if($("estadoPadre").value.trim()==0)
        abilitarCajonesAreaCatalogo(3);
    else{
        abilitarCajonesAreaCatalogo(1);
    }
}




function editaAreaXSede(){
    abilitaCajonesAreaXSede(1);
    cambiaBotonesAreaXSede(2);
}


function abilitaCajonesAreaXSede(opc){
    switch(opc){
        case 1:{ // abilita estado
            document.getElementById("cboEstadoXSede").disabled=false;
            break;
        }
        case 2:{ // desabilita estado
            document.getElementById("cboEstadoXSede").disabled=true;
            break;
        }
    }
}

function limpiarCajonesAreaXsedeEmpresa(){
    $("txtIdAreaPadreXSede").value="";
    $("txtDescripcionAreaPadreXSede").value="";
    $("txtIdAreaXSede").value="";
    $("txtDescripcionAreaXSede").value="";
    $("txtAbreviaturaAreaXSede").value="";
    $("txtNivelXSede").value="";
    $("cboEstadoXSede").value=-1;
   
}


function cambiaBotonesAreaXSede(opc){
    switch(opc){
        case 1:{
            $("divEditaAreaXSede").show();
            $("divActualizaAreaXSede").hide();
            break;
        }
        case 2:
            $("divEditaAreaXSede").hide();
            $("divActualizaAreaXSede").show();
            break;
    }
}


function actualizarAreaXSede(){
    //idSedeEmpresaArea
    if(idArbolSeleccionado.length>=1){
        if($("cboEstadoXSede").value!=-1 ){
            patronModulo='actualizarEstadoSedeEmpresaArea';
            parametros='';
            //$("cboSede").value.trim()
            //@nivelArea,@idArea,@idSedeEmpresa,@idSedeEmpresaArea,@estadoArea
            parametros+='p1='+patronModulo+'&p2='+ $("idSedeEmpresaArea").value.trim();
            parametros+='&p3='+$("cboEstadoXSede").value.trim();
            parametros+='&p4='+$("txtIdAreaXSede").value.trim();
            parametros+='&p5='+$("txtNivelXSede").value.trim();
            parametros+='&p6='+$("cboSede").value.trim();
            form="";
            funcion="actualizaAreaCajonesBotones";
            destino="idInfoAreaXSede";
            // alert(parametros);
            enviarFormulario(form,parametros,funcion,destino);
            buscarArbolArea();
        }
        else(alert("Seleccione un estado"))
    }
    else{
        alert("Seleccione el Área Padre primero!!!")
    }
    
    
}

function actualizaAreaCajonesBotones(){
    abilitaCajonesAreaXSede(2);
    cambiaBotonesAreaXSede(1);
}


function validar(e,opc) { 
    var tecla = (document.all) ? e.keyCode : e.which;
    var patron; 
    if((tecla==null)  || (tecla==8) || (tecla==0)|| (tecla==13) || (tecla==27)|| (tecla==9)  ) return true; // 3
    switch(opc){
        //Solo texto
        case 0:{
            
            patron =/[A-Za-z\s]/; // 4
            break;
        }
        //solo texto y numero
        case 1:{
            
            patron =/[A-Za-zñÑ.\s\d]/;
            break;
        }
        case 2:{
            patron =/[-:\s\d]/;
            break;
        }
        case 3:{
            patron =/[:\s\d]/;
            break;     
        }
        //        case 4:
        //            patron =/(^([0-9]|[0-1][0-9]|[2][0-3]):([0-5][0-9])$)|(^([0-9]|[1][0-9]|[2][0-3])$)/;
        //            break;
        case 4:{
            patron=/[/\s\d]/;
            break;
        }
        //numeros, signo y punto
        case 5:{
            patron=/[-.\d]/;
            break;
        }          
    }
    var te = String.fromCharCode(tecla); 
    return patron.test(te);
} 

//function validarFecha(y,mo,d,h,mi,s) { 
//    var date = new Date(y, mo - 1, d, h, mi, s, 0); 
//    var ny = date.getFullYear(); 
//    var nmo = date.getMonth() + 1; 
//    var nd = date.getDate(); 
//    var nh = date.getHours(); 
//    var nmi = date.getMinutes(); 
//    var ns = date.getSeconds(); 
//    // return ny == y && nmo == mo && nd == d && nh == h && nmi == mi && ns == s; 
//    alert(ny+' '+nmo+' '+nd+' '+nh+' '+nmi+' '+ns);
//} 

function fechaActualX(){
    var date = new Date(); 
    var ny = date.getFullYear(); 
    var nmo = date.getMonth() + 1; 
    var nd = date.getDate(); 
    var nh = date.getHours(); 
    var nmi = date.getMinutes();  
    return nd+'-'+nmo+'-'+ny+' '+nh+':'+nmi+':'+'00'
}
//valida en formato HH:MM
function validaHoraMinuto(strHoraMinuto){
    strHoraMinuto=strHoraMinuto.trim();
    var patron =/(^([0-9]|[0-1][0-9]|[2][0-3]):([0-5][0-9])$)|(^([0-9]|[1][0-9]|[2][0-3])$)/;
    if(patron.test(strHoraMinuto)){
        // strHoraMinuto=strHoraMinuto.replace(":",".")
        return 1
    }
    else{
        return 0
    }
}

function mensajeHoraMinuto(cajon){
    var caso = validaHoraMinuto(document.getElementById(cajon).value);   
    switch(caso){
        case 1:{
            document.getElementById(cajon).style.color='#4141F8';
            break;
        }
        case 0:{
            document.getElementById(cajon).style.color='#D43037';
            break;
        }
    }
}

function validaFechaHora(strFechaHora){
    var fecha;
    var hora;
    var arrayFechaHora;
    var arrayFecha;
    var arrayHora;
    var dia,mes,anio;
    var hh,mm,ss;
    /* Ojo expRegFecha
    Matches 29/02/2000 | 31/01/2000 | 30-01-2000 
    Non-Matches 29/02/2002 | 32/01/2002 | 10/2/2002 
    */
    //var expRegFecha1=/^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;
    //var expRegFecha=/(((0[1-9]|[12][0-9]|3[01])([-./])(0[13578]|10|12)([-./])(\d{4}))|(([0][1-9]|[12][0-9]|30)([-./])(0[469]|11)([-./])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([-./])(02)([-./])(\d{4}))|((29)(\.|-|\/)(02)([-./])([02468][048]00))|((29)([-./])(02)([-./])([13579][26]00))|((29)([-./])(02)([-./])([0-9][0-9][0][48]))|((29)([-./])(02)([-./])([0-9][0-9][2468][048]))|((29)([-./])(02)([-./])([0-9][0-9][13579][26])))/
    var expRegFecha=/^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$/;   /*Matches 2004-04-30 | 2004-02-29  Non-Matches 2004-04-31 | 2004-02-30 */
    var expRegHora=/^((([0]?[1-9]|1[0-2])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?( )?(AM|am|aM|Am|PM|pm|pM|Pm))|(([0]?[0-9]|1[0-9]|2[0-3])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?))$/;
    strFechaHora=strFechaHora.trim();
    arrayFechaHora=strFechaHora.split(" ");
    if(arrayFechaHora[0] !=undefined && expRegFecha.test(arrayFechaHora[0].trim()) && arrayFechaHora[0].length<=10 &&arrayFechaHora[0].length>=8){
        if(arrayFechaHora[1]!= undefined && expRegHora.test(arrayFechaHora[1].trim()) && arrayFechaHora[1].length>=5 && arrayFechaHora[1].length<=10){
            //    fecha=strFechaHora.substring(0,10).trim();
            //    hora=strFechaHora.substring(10,19).trim();
            fecha=arrayFechaHora[0];
            hora=arrayFechaHora[1];
            arrayFecha=fecha.split("-");
            arrayHora=hora.split(":");
            dia=arrayFecha[0];
            mes=arrayFecha[1];
            anio=arrayFecha[2];
            hh=arrayHora[0];
            mm=arrayHora[1];
            ss=arrayHora[2]; 
            if(anio!=undefined && mes!=undefined && dia!=undefined && hh!=undefined && mm!=undefined && ss!=undefined){
                // alert(dia+'-'+mes+'-'+anio+' '+hh+':'+mm+':'+ss);
                //validarFecha(anio,mes,dia,hh,mm,ss);
                return 1
            //alert(1);
            }
            else
            {
                //alert('-3');
                return -3
            }
        }
        else{
            return -2
        //alert('-2')
        }
    }
    else{
        return -1
    //alert("-1")
    }
        
}

function mensajeCajonesTextoFechaHora(cajon){
    var caso = validaFechaHora(document.getElementById(cajon).value);   
    switch(caso){
        case 1:{
            document.getElementById(cajon).style.color='#4141F8';
            document.getElementById(cajon).style.font='bold arial';
            break;
        }
        case -1: case -2: case -3:{
            document.getElementById(cajon).style.color='#D43037';
            //alert(caso);
            break;
        }
    }
}





// podPad Asignacion de Area a Sede 2012/04/02

function podpadAsignacionAreaSede(opt,fil){  
    if(idCadenaAreas.length>=1 && $("txtIdArea").value.trim().length>0){    
        if($("cboEstado").value.trim()==1){
            posFuncion = "";
            //posFuncion = "";
            vtitle="Asignación de Área a Sede";
            vformname='podpadAsignacionAreaSede';
            vwidth='600';
            vheight='250';
            //'nuevaSubArea' llama al control y luego al actionRRHH y carga la vista vGuardarArea
            patronModulo='ventanaAsignaAreaSede';
            vcenter='t';
            vresizable=''
            vmodal='false';
            vstyle='';
            vopacity='';
            veffect='';
            vposx1='';
            vposx2='';
            vposy1='';
            vposy2='';
            parametros='';
            parametros+='p1='+patronModulo;
            this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
        }
        else {
            alert("El Área se encuentra en estado INACTIVO activo primero el Área")
        } 
    } 
    else{     
        alert("Debe Seleccionar la Área que desea asignar primero !!!");
    }
}



//Windows.close("Div_podpadAsignacionAreaSede", "");



//valida en formato DD/MM/YYYY 
function validaFecha(fecha){
    //alert("hola");
    var patron =/(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])(\d{4}))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))/;
    if(patron.test(fecha)){
        return 1
    }
    else{
        return 0
    }
}

function alertFechaHora(){
    var i=document.getElementById('txtHoraEntrada').value;
    var f=document.getElementById('txtHoraSalida').value;
    var vi=validaFechaHora(document.getElementById('txtHoraEntrada').value);
    var vf=validaFechaHora(document.getElementById('txtHoraSalida').value);
    if(vi==1 && vf==1){
        return 1;
    }
    else{
        if(vi==1 && f==""){
            alert("Complete la Hora de Salida (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00");
        }
        if(i=="" && vf==1){
            alert("Complete la Hora de Entrada (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00");
        }
        if(vi==1 && vf!=1 && f!=""){
            alert("Ingrese bien la Hora de Salida (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00");
        }
        if(vi!=1 && vf==1 && i!=""){
            alert("Ingrese bien la Hora de Entrada (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00");
        }
        if(vi!=1 && vf!=1 && i!="" && f!=""){
            alert("Ingrese bien las Horas (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00")
        }
        if(i=="" && f==""){
            alert("Complete las Horas (YYYY-MM-DD HH:MM:DD) ejemplo: 2012-01-01 07:58:00");
        }
        return 0;
    }
}

function getHora(vFecha){
    var vHora=""
    vFecha=vFecha.trim();
    if(vFecha!=""){
        vHora=vFecha.split(" ")[1];
        if(vHora!=undefined){
            return vHora;
        }
        else return "";
    }
    else return "";
}

function validaHora(vHora){
    vHora=vHora.trim();
    var expRegHora=/^((([0]?[1-9]|1[0-2])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?( )?(AM|am|aM|Am|PM|pm|pM|Pm))|(([0]?[0-9]|1[0-9]|2[0-3])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?))$/;
    if(expRegHora.test(vHora)){
        return 1;
    }
    else return 0;
}

function mensajeCajonesTextoHora(cajon){
    var caso = validaHora(document.getElementById(cajon).value);   
    switch(caso){
        case 1:{
            document.getElementById(cajon).style.color='#4141F8';
            document.getElementById(cajon).style.font='bold arial';
            break;
        }
        case 0:{
            document.getElementById(cajon).style.color='#D43037';
            //alert(caso);
            break;
        }
    }
}

function getSegundos(hora){
    hora=hora.trim();
    var arrayHora;
    arrayHora=hora.split(":");
    var hh,mm,ss;
    hh=arrayHora[0];
    mm=arrayHora[1];
    ss=arrayHora[2];
    //alert(parseInt(hh,10));
    if(hh!=undefined && mm!=undefined && ss!=undefined && hora!=""){
        return parseInt(hh,10)*3600+parseInt(mm,10)*60+parseInt(ss,10)
    }
    else return -1;
}

function validaSiguienteDia(hIni,hFin){
    hIni=hIni.trim();
    hFin=hFin.trim();
    if(getSegundos(hIni)<getSegundos(hFin)){
        return 0;
    }
    else return 1;
}

function alertHora(){
    var i=document.getElementById('txtHoraEntrada').value;
    var f=document.getElementById('txtHoraSalida').value;
    var vi=validaHora(document.getElementById('txtHoraEntrada').value);
    var vf=validaHora(document.getElementById('txtHoraSalida').value);
    if(vi==1 && vf==1){
        return 1;
    }
    else{
        if(vi==1 && f==""){
            alert("Complete la Hora de Salida (HH:MM:DD) ejemplo:07:58:00");
        }
        if(i=="" && vf==1){
            alert("Complete la Hora de Entrada (HH:MM:DD) ejemplo: 07:58:00");
        }
        if(vi==1 && vf!=1 && f!=""){
            alert("Ingrese bien la Hora de Salida (HH:MM:DD) ejemplo: 07:58:00");
        }
        if(vi!=1 && vf==1 && i!=""){
            alert("Ingrese bien la Hora de Entrada (HH:MM:DD) ejemplo: 07:58:00");
        }
        if(vi!=1 && vf!=1 && i!="" && f!=""){
            alert("Ingrese bien las Horas (HH:MM:DD) ejemplo: 07:58:00")
        }
        if(i=="" && f==""){
            alert("Complete las Horas (HH:MM:DD) ejemplo: 07:58:00");
        }
        return 0;
    }
}

function toMMDDYYYY1(fecha){
    var dd=fecha.substring(8);
    var mm=fecha.substring(5,7);
    var yy=fecha.substring(0,4);
    return mm+'/'+dd+'/'+yy;
}

function buscarAreaArbol(){
    treex.findItem($('idTxtBuscarArbol').value,1,1);
}