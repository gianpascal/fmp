var pathRequestControl = "../../ccontrol/control/control.php";


function cargarArbolCentroCostos(funcion)
{

    myDiv=document.getElementById('divCentroCostos');
    myDiv.innerHTML = " ";
    tree=new dhtmlXTreeObject("divCentroCostos","100%","90%",0);
    tree.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree.attachEvent("onClick", function(){

        funcionArbol(funcion,tree.getSelectedItemId());
        return true;
    })
    tree.setXMLAutoLoading("../../../javascript/xml/tree_oficinas.xml");
    tree.loadXML("../../../javascript/xml/arbol_centroCostos.xml");
    tree.openAllItems(1);
//var respuestajs = ajax.responseText;
//eval(respuestajs);


}
function funcionArbol(funcion,id){
    textofuncion=funcion+"('"+id+"')";
    eval(textofuncion);
//seleccionCentroCostos(id)
}



function recargarArbolCCostosPuestos(funcion)
{

 
    
    var parametros="p1=generaArbolCentroCostos";
    var divMostrar=document.getElementById('divOpcCCostos');
    divMostrar.innerHTML = " ";
    treeCentroCostosBusqueda=new dhtmlXTreeObject("divOpcCCostos","100%","100%",0);
    treeCentroCostosBusqueda.setSkin('dhx_skyblue');
    treeCentroCostosBusqueda.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostosBusqueda.attachEvent("onClick", function(){
        verTablaPuestosCentroCostos(treeCentroCostosBusqueda.getSelectedItemId());
    } );
    treeCentroCostosBusqueda.openAllItems(0);
    treeCentroCostosBusqueda.loadXML(pathRequestControl+'?'+parametros);

}

function verTablaPuestosCentroCostos(idCentroDeCosto){
    var parametros="p1=CargarlistaPuestosXCentroCostos&p2="+idCentroDeCosto ;
    var divMostrar=document.getElementById('divResultadoPuestosCCostos');
    divMostrar.innerHTML = " ";
    tablaPuestosCentroCostos = new dhtmlXGridObject('divResultadoPuestosCCostos');
    tablaPuestosCentroCostos.setImagePath("../../../../fastmedical_front/imagen/icono/");
    tablaPuestosCentroCostos.attachEvent("onRowSelect",function(fila,columna){
        var funcion=$('hfuncion').value; 
        funcion=funcion +'('+fila+','+columna+')';
        eval(funcion);
    }) ;
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaPuestosCentroCostos.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaPuestosCentroCostos.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    /////////////fin cargador ///////////////////////
    tablaPuestosCentroCostos.setSkin("dhx_skyblue");
    tablaPuestosCentroCostos.init();
    tablaPuestosCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){
        i++
    });

}






function busquedaArbol2(){
    //comentado cod. peche 28Mayo12
    //tree2.findItem($("txtBusquedaArbolx").value);
    treeCentroCostosBusqueda.findItem($("txtBusquedaArbolx").value);
    
}


//JCQA
function busquedaArbolPuestosEnCCostos(){
    
    treex.findItem($("txtBusquedaArbolx").value);
// treex.sortTree(0, 'ASC', true);

}



function verPuestosArbol(id){
    //********verPuestos es para listar los puestos por sede
    // verPuestos(id,'','detallePuestoCentro');
    CargarlistaPuestosXCentroCostos(tree2.getSelectedItemId());
    seleccionarCentroCostoPuesto(id);
    

}
function seleccionarCentroCostoPuesto(id){
    patronModulo = "seleccionarCentroCostoPuesto";
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+id;


    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('txtCentroCostos').value=respuesta;
        }
    } )
}

function seleccionarCentroCostoPuestoDelArbol(idCentroCostoSeleccionado){
    
    //alert(idCentroCostoSeleccionado)
    
    
    patronModulo = "seleccionarCentroCostoPuestoDelArbol";
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idCentroCostoSeleccionado;


    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('txtCentroCostos').value=respuesta;
        }
    } )
    
  
    
}



function verPuestos(id,event){
    var funcion=$('hfuncion').value;
   
    var ccosto;
    if(id=='x'){
        ccosto=1
    }else{
        document.getElementById('hCcosto').value=id;
        ccosto=id;
        document.getElementById('txtPuesto').value='Buscar...';
    }
    var puesto=document.getElementById('txtPuesto').value;
    if(puesto=='Buscar...'){
        puesto='';
    }
    var estado=$('comboEstados').value;
    var categoria=document.getElementById('comboCategoriaPuestos').value
    var patronModulo = "puestosxCCostos";
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+ccosto;
    parametros+='&p3='+puesto;
    parametros+='&p4='+categoria;
    parametros+='&p5='+estado;
    parametros+='&p6='+funcion;
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    if(tecla==13){
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                $('divResultadoPuestosCCostos').update(respuesta);
                limpiarDetallePuesto();
                if($('imagenEditar')!=null)
                    $('imagenEditar').hide();
            }
        } )
    }
   

}

//verPuestos2012('x',event,'detallePuestoCentro');
function verPuestos2012(id,event,funcion){
    //ok
    if(id=='x'){
        ccosto=1
    }else{
        document.getElementById('hCcosto').value=id;
        ccosto=id;
        document.getElementById('txtPuesto').value='Buscar...';
    }
    //ok
    puesto=document.getElementById('txtPuesto').value;//ok
    
    if(puesto=='Buscar...'){
        puesto='';
    }
    estado=$('comboEstados').value;
    categoria=document.getElementById('comboCategoriaPuestos').value//no
    patronModulo = "puestosxCCostos";
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+ccosto;
    parametros+='&p3='+puesto;
    parametros+='&p4='+categoria;
    parametros+='&p5='+estado;
    parametros+='&p6='+funcion;
    if(event==''){
        tecla=13;
    }else{
        tecla=event.keyCode
    }
    if(tecla==13){
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                $('divResultadoPuestosCCostos').update(respuesta);
                limpiarDetallePuesto();
                if($('imagenEditar')!=null)
                    $('imagenEditar').hide();
            }
        } )
    }
   

}


//11 Abril JCQA--- crea la tabla cuando pulso el boton Buscar
function BuscarPuestosxEstados($puesto,$estado){
    puesto=$puesto;
    estado=$estado;
 

    var parametros="p1=busquedaEmpleadosCentroCostosFiltrado";
    parametros+="&p2="+puesto;
    parametros+="&p3="+estado;
    //alert("id:"+id+"*** nombre:"+nombre)
    tablaBusquedaPuestosEnCentroCostos=new dhtmlXGridObject('divResultadoPuestosCCostos');
    tablaBusquedaPuestosEnCentroCostos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaBusquedaPuestosEnCentroCostos.setSkin("dhx_skyblue");
    tablaBusquedaPuestosEnCentroCostos.enableRowsHover(true,'grid_hover');
    tablaBusquedaPuestosEnCentroCostos.attachEvent("onRowSelect", CapturaDetalleBuscarPuestosxEstados);
    
    //////////para cargador peche////////////////
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaBusquedaPuestosEnCentroCostos.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
        
    });
    tablaBusquedaPuestosEnCentroCostos.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
        setColortablaBusquedaPuestosEnCentroCostos();
        $("selectCategoriaPuestos").selectedIndex=0;
    
        $('txtNombrePuesto').value='';
        $('txtCentroCostos').value='';
        document.getElementById("chkEstado").checked=false;
        $("chkEstado").value=0;

        
    });
    /////////////fin cargador ///////////////////////
    tablaBusquedaPuestosEnCentroCostos.init();
    tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros);
}

//funcion 11:55 11Abril 12
function CapturaDetalleBuscarPuestosxEstados(fil, col){
  
    //    var nombrePuesto=tablaBusquedaPuestosEnCentroCostos.cells(fil,1).getValue();
    //    var estadoPuesto=tablaBusquedaPuestosEnCentroCostos.cells(fil,2).getValue();
    //    var nombreCCosto=tablaBusquedaPuestosEnCentroCostos.cells(fil,4).getValue();
    //   
    //   $('txtNombrePuesto').value=nombrePuesto;
    //   
    //    $('txtCentroCostos').value=nombreCCosto;
    //    
    //    
    //    
    //      
    //    if(estadoPuesto=='ACTIVO'){
    //          
    //        document.getElementById("chkEstado").checked=true;
    //        $("chkEstado").value=1;
    //          
    //          
    //    }else if (estadoPuesto=='INACTIVO'){
    //        
    //        document.getElementById("chkEstado").checked=false;
    //        $("chkEstado").value=0;
    //          
    //          
    //    }
      
      
    //alert("nomPu:"+nombrePuesto+"estadoPuesto:"+estadoPuesto);
    
    var nombrePuesto=tablaBusquedaPuestosEnCentroCostos.cells(fil,1).getValue();
    var estadoPuesto=tablaBusquedaPuestosEnCentroCostos.cells(fil,2).getValue();
    
    var nombreCCosto=tablaBusquedaPuestosEnCentroCostos.cells(fil,4).getValue();
    var IdCategoriaPuesto=tablaBusquedaPuestosEnCentroCostos.cells(fil,6).getValue();

      
    $("selectCategoriaPuestos").selectedIndex=IdCategoriaPuesto;
    
    $('txtNombrePuesto').value=nombrePuesto;
    $('txtCentroCostos').value=nombreCCosto;
      
    if(estadoPuesto=='ACTIVO'){
          
        document.getElementById("chkEstado").checked=true;
        $("chkEstado").value=1;
          
          
    }else if (estadoPuesto=='INACTIVO'){
        
        document.getElementById("chkEstado").checked=false;
        $("chkEstado").value=0;
          
          
    }
    
    
    
    
    
    
    
    
}




//21  Mayo 2012 JCQA   CapturaDetallePuestosCentroCostos
//mygridx
//tablaBusquedaPuestoxCentroCostosFiltrado
function busquedaPuestoxCentroCostosFiltrado(){
    

    var puesto=$('txtPuesto').value;
    var estado=$('comboEstados').value;
    
    //    var dn;  
    var numero=puesto.length;
    
    accion='1';
    patronModulo='busquedaEmpleadosCentroCostosFiltrado';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+puesto;
    parametros+='&p3='+estado;
    
    if(numero==3){
        dn=0;
        tablaBusquedaPuestoxCentroCostosFiltrado = new dhtmlXGridObject('divResultadoPuestosCCostos');
        tablaBusquedaPuestoxCentroCostosFiltrado.setImagePath("../../../../fastmedical_front/imagen/icono/");
        //        tablaBusquedaPuestosEnCentroCostos.attachEvent("onRowSelect", 
        //            function(){
        //                alert("letall");
        ////                gridClick(tablaBusquedaPuestosEnCentroCostos.getSelectedId(),tablaBusquedaPuestosEnCentroCostos.getSelectedCellIndex(),"cuu");
        //                return true;
        //            }    
        //
        //            );
       
        //ini original
        tablaBusquedaPuestoxCentroCostosFiltrado.attachEvent("onRowSelect",capturadetallebusquedaPuestoxCentroCostosFiltrado );
        //fin original
        //tablaBusquedaPuestoxCentroCostosFiltrado.attachEvent("onRowSelect",CapturaDetallePuestosCentroCostos );
        
        //////////para cargador peche////////////////
        contadorCargador++;
        var idCargador=contadorCargador;
        tablaBusquedaPuestoxCentroCostosFiltrado.attachEvent("onXLS", function(){
            cargadorpeche(1,idCargador);
        
        });
        tablaBusquedaPuestoxCentroCostosFiltrado.attachEvent("onXLE", function(){
            cargadorpeche(0,idCargador);
            setColortablaBusquedaPuestoxCentroCostosFiltrado();
            
            $("selectCategoriaPuestos").selectedIndex=0;
    
            $('txtNombrePuesto').value='';
            $('txtCentroCostos').value='';
              
            document.getElementById("chkEstado").checked=false;
            $("chkEstado").value=0;
          
            
            
        
        });
        /////////////fin cargador ///////////////////////
       
       
        tablaBusquedaPuestoxCentroCostosFiltrado.setSkin("dhx_skyblue");
        tablaBusquedaPuestoxCentroCostosFiltrado.init();
        //        tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros,function(){
        
        tablaBusquedaPuestoxCentroCostosFiltrado.loadXML(pathRequestControl+'?'+parametros,function(){
            dn=1;
        });
        
        
        
    //tablaBusquedaPuestosEnCentroCostos.loadXML(pathRequestControl+'?'+parametros);
    //miTablaCie.clearAll();
    }
    if(numero>3&&dn==1){
        tablaBusquedaPuestoxCentroCostosFiltrado.filterBy(1,$('txtPuesto').value);
    }
  
    
}


//CapturaDetallePuestosCentroCostos
//11 Abril 2012 JCQA
function capturadetallebusquedaPuestoxCentroCostosFiltrado(fil, col){
    //var resul='';
    //$("cell52").update(resul);
    $('cell52').update('');
    
    //inicio original
   $("iddetallePuestosCCostos").show();
  
    var idPuesto =tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,0).getValue();
    $("hIdPuesto").value=idPuesto;
      
    var nombrePuesto=tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,1).getValue();
    var IdCategoriaPuesto=tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,6).getValue();
    var estadoPuesto=tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,2).getValue();
    var IdCcosto=tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,3).getValue();
    var nombreCCosto=tablaBusquedaPuestoxCentroCostosFiltrado.cells(fil,4).getValue();
         
    $("hIdCentroCosto").value=IdCcosto
    
    $("selectCategoriaPuestos").selectedIndex=IdCategoriaPuesto;
   
    // $('txtNombrePuesto').value=nombrePuesto;
    $('txtNombrePuesto').value=nombrePuesto;
    $('txtCentroCostos').value=nombreCCosto;
    
    //seleccionarCentroCostoPuestoDelArbol(treex.getSelectedItemId());
    seleccionarCentroCostoPuestoDelArbol(IdCcosto);
    
    if(estadoPuesto=='ACTIVO'){
          
        document.getElementById("chkEstado").checked=true;
        $("chkEstado").value=1;
          
          
    }else if (estadoPuesto=='INACTIVO'){
        
        document.getElementById("chkEstado").checked=false;
        $("chkEstado").value=0;

    }
    
//fin original
    
////////////////////////////////////////////////////////////////////////
 
//    $("iddetallePuestosCCostos").show();
//    
//    var idPuesto =mygridx.cells(fil,0).getValue();
//   
//    $("hIdPuesto").value=idPuesto;
//    var nombrePuesto=mygridx.cells(fil,1).getValue();
//    var IdCategoriaPuesto=mygridx.cells(fil,6).getValue();
//    var estadoPuesto=mygridx.cells(fil,2).getValue();
//    
//    $("selectCategoriaPuestos").selectedIndex=IdCategoriaPuesto;
//    $('txtNombrePuesto').value=nombrePuesto;
//    
//    if(estadoPuesto.trim()=='ACTIVO'){
//          
//        document.getElementById("chkEstado").checked=true;
//        $("chkEstado").value=1;
//          
//          
//    }else if (estadoPuesto.trim()=='INACTIVO'){
//        
//        document.getElementById("chkEstado").checked=false;
//        $("chkEstado").value=0;
//          
//          
//    }
 
 
 
///////////////////////////////////////////////////////////////////////
  
 
    
}

//11 Abril 2012 JCQA
function setColortablaBusquedaPuestoxCentroCostosFiltrado(){
      
    for(i=0;i<tablaBusquedaPuestoxCentroCostosFiltrado.getRowsNum();i++){
       
        var tipoArea = tablaBusquedaPuestoxCentroCostosFiltrado.cells(i,2).getValue();
       

        if(tipoArea=='ACTIVO' ){
    
            tablaBusquedaPuestoxCentroCostosFiltrado.setRowTextStyle(tablaBusquedaPuestoxCentroCostosFiltrado.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
    
        }else if(tipoArea=='INACTIVO' ){
   
            tablaBusquedaPuestoxCentroCostosFiltrado.setRowTextStyle(tablaBusquedaPuestoxCentroCostosFiltrado.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');
    
        }

    }
   
}

function setColortablaBusquedaPuestosEnCentroCostos(){
      
    for(i=0;i<tablaBusquedaPuestosEnCentroCostos.getRowsNum();i++){
       
        var tipoArea = tablaBusquedaPuestosEnCentroCostos.cells(i,2).getValue();
       

        if(tipoArea=='ACTIVO' ){
    
            tablaBusquedaPuestosEnCentroCostos.setRowTextStyle(tablaBusquedaPuestosEnCentroCostos.getRowId(i) ,'background-color:#CCFF99;color:black;border-top: 1px solid #DAEFC2;');
    
        }else if(tipoArea=='INACTIVO' ){
   
            tablaBusquedaPuestosEnCentroCostos.setRowTextStyle(tablaBusquedaPuestosEnCentroCostos.getRowId(i) ,'background-color:#8db1ff;color:black;border-top: 1px solid #FFD7BB;');
    
        }

    }
   
}





//function cuu(){
//    alert("1111111111");
//    
//
//}
//
//function cua(){
//    alert("22222");
//    
//}
//
//
//function c(){
//    alert("cccccccccccccccc");
//    
//}

function detallePuestoCentro(event,thiss,id){
    $('imagenEditar').show();
    patronModulo='detallePuestoCentroCosto';
    cod=id;
    //  alert(id);
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+cod;

    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        asynchronous:false,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            var miarray=respuesta.split("|");
            document.getElementById("txtNombrePuesto").value=miarray[2];
            
            document.getElementById("txtCentroCostos").value=miarray[1];
            document.getElementById("hIdPuesto").value=miarray[0];
            //document.getElementById("chkEstado").value=miarray[3];
            if(miarray[4]==1){
                document.getElementById("chkEstado").checked=true;
                $("chkEstado").value=1
            }else{
                document.getElementById("chkEstado").checked=false;
                $("chkEstado").value=0
            }
            //$('DivLimpiar').update(respuesta);
            $('selectCategoriaPuestos').value=miarray[3];

           
        //
        //$('divOpcInfActCCostos').update(respuesta);
        }
    } );
    deshabilitarDetallePuesto();
}

//11 Mayo 2012  aas 2:43pm JCQA
function editarDetallePuesto(){

    habilitarDetallePuesto();
    $('hAccion').value=1;
    $("fila5").show();
    
    $("imgagenGuardar").hide();
     
}

function blanquearData(){
    
//    $("txtNombrePuesto").value='';
    
    
}


//funcion agregada el 17Mayo 2012 JCQA
function actualizarDatosPuestoenCentroCostos(fil, col){
    //if(document.getElementById("chkEstado").checked==false){

   
    if(window.confirm("¿Está seguro que desea actualizarlo?")){
        var IdPuesto=$("hIdPuesto").value;
        var txtNombrePuesto=$("txtNombrePuesto").value;
        var selectCategoriaPuestos=$("selectCategoriaPuestos").value;
        var opcionPuesto=$("chkEstado").value;
        var hIdCentroCosto=$("hIdCentroCosto").value;
        var parametros="p1=desactivarPuestoenCentroCostos&p2="+IdPuesto+"&p3="+opcionPuesto+"&p4="+txtNombrePuesto+"&p5="+selectCategoriaPuestos;
        // var parametros="p1=actualizarDatosPuestoenCentroCostos&p2="+IdPuesto+"&p3="+opcionPuesto+"&p4="+txtNombrePuesto+"&p5="+selectCategoriaPuestos;  
        var datosx=traerData(parametros);
        CargarlistadoPuestosXCentroCostos(hIdCentroCosto);
        //alert(datosx[0]);
        if(datosx[0].trim()=='1'){
             
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El puesto ya se encontraba activado pero el nombre y/o categoria del Puesto si se actualizaron en '+ '<H1 style="color: RED; font-weight: bold;">'+$('hNombreCentroCostoClickeado').value+'</H1></p></CENTER>';
  
        }else if(datosx[0].trim()=='2'){
          
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El nombre del puesto se desactivo correctamente.'+ '<H1 style="color: RED; font-weight: bold;">'+'</H1></p></CENTER>';
          
        }else if(datosx[0].trim()=='3'){
            
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El puesto se activo correctamente y se actualizaron el Nombre y/o Categoria del Puesto en'+ '<H1 style="color: RED; font-weight: bold;">'+$('hNombreCentroCostoClickeado').value+'</H1></p></CENTER>';
         
        }else if(datosx[0].trim()=='4'){
          
            $('cell52').show();
            $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El puesto ya se encuentraba desactivado'+ '<H1 style="color: RED; font-weight: bold;">'+'</H1></p></CENTER>';
            
        }else{
            
            alert("ninguna de las anteriores")
        }
    }

//}
//    else {
//        alert("JCCC")
//    }
    
    
//    
//     patronModulo = "actualizarDatosPuestoenCentroCostos";
//    
//    txtNombrePuesto=$("txtNombrePuesto").value;
//    hIdCentroCosto=$("hIdCentroCosto").value;
//    selectCategoriaPuestos=$("selectCategoriaPuestos").value;
//    
//    parametros='';
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+txtNombrePuesto;
//    parametros+='&p3='+hIdCentroCosto;
//    parametros+='&p4='+selectCategoriaPuestos;
//
// 
// 
//    if(hIdCentroCosto!='' ){
//        
//        if(txtNombrePuesto.length>=1){
//         
//            if($("selectCategoriaPuestos").selectedIndex!=0){
//                if($('chkEstado').value!=0){
//                    
//                    new Ajax.Request( pathRequestControl,{
//                        method : 'get',
//                        parameters : parametros,
//                        onLoading : micargador(1),
//                        onComplete : function(transport){
//                            micargador(0);
//                            respuesta = transport.responseText;
//
//                            CargarlistadoPuestosXCentroCostos(hIdCentroCosto);
//                            
//                            if(respuesta.trim()=='ok'){
//                               
//                                $('cell52').show();
//                               
//                                $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El puesto fue asignado correctamente al C.Costos:'+ '<H1 style="color: RED; font-weight: bold;">'+$('hNombreCentroCostoClickeado').value+'</H1></p></CENTER>';
//                              
//                             
//                            }else if (respuesta.trim()=='existe') {
//                                
//                                $('cell52').show();
//                                $('cell52').innerHTML='<CENTER><p style="color: red; font-weight: bold;"><img width=40 heigth=40  id=\"imgagenError\" src=\"../../../../fastmedical_front/imagen/icono/alert_big.png\"/>El nombre del Puesto  "'+$('txtNombrePuesto').value+'"  ya existe, escoja otro nombre...</p></CENTER>';
//                                
//                            }else {
//                                alert("hol")
//                            }
//                        
//                       
//                        }
//                    } )
//
//                   
//                }else{
//                    alert("Active el estado del puesto¡")
//                }
//              
//                
//            }else{
//                
//                alert("Seleccione alguna Categoria para el puesto")
//                
//            }
//        
//        }else{
//            alert("Escriba algun nombre para el Puesto")   
//        }
//     
//   
//    }else{
//        alert("Escoja algun Centro de Costos");
//     
//    }
  
    
}


//17 Mayo 2012  aas 10:53 am JCQA
function habilitarDetallePuesto(){

    $('txtNombrePuesto').readOnly=false;
    $('selectCategoriaPuestos').disabled=false;
    $('chkEstado').disabled=false;
    
    //    $('txtCentroCostos').readOnly=false;
    
    //    $('imgagenGuardar').show();
    
    $('imgagenActualizar').show();
    
    $('imgagenCancelar').show();

//fin de codigo comentado 11 Mayo 2012  aas 2:43pm   

}

function deshabilitarDetallePuesto(){
    mostrargrabarDetallePuestoPuestoArea();
    $('hAccion').value=0;
    $('txtNombrePuesto').readOnly=true;
    $('txtCentroCostos').readOnly=true;
    $('chkEstado').disabled=true;
    $('selectCategoriaPuestos').disabled=true;
    $('imgagenGuardar').hide();
    $('imgagenCancelar').hide();
//
}
function limpiarDetallePuesto(){
    if($('hAccion')!=null)
        $('hAccion').value=0;
    $('txtNombrePuesto').value='';
    //$('txtCentroCostos').value='';
    $('txtCentroCostos').readOnly=true;
    
    $('chkEstado').checked=false;
    
    $('chkEstado').value=0;
    
    
    
    $('selectCategoriaPuestos').selectedIndex=0
    if($('imgagenGuardar')!=null)
        $('imgagenGuardar').hide();
    if($('imgagenCancelar')!=null)
        $('imgagenCancelar').hide();

}

function cancelarGrabarDetallePuesto(){
    id=$("hIdPuesto").value;
    detallePuestoCentro('','',id)
}



function cancelarGrabarDetallePuesto123(){
    //    id=$("hIdPuesto").value;
    //    detallePuestoCentro('','',id)
    //alert("cancelar");
    $('txtNombrePuesto').readOnly=true;
    $('selectCategoriaPuestos').disabled=true;
    $('chkEstado').disabled=true;
    //$('imgagenActualizar'). hide();
    $('fila5'). hide();
//$('txtCentroCostos').readOnly=true;

}


function prueba20121(){
    var habc=$("hIdCentroCosto").value;
    alert("id:"+habc+"fin");
    var a12 =   $("hNombreCentroCostoClickeado").value;
    
    alert("nombre:"+a12+"fin");
    if(treex.getSelectedItemId()==''){
        
        alert("Debe seleccionar algun CCosto del arbol");
        
    }else {
        
        alert("Gracias x seleccionar un CCosto");
        var a= treex.getSelectedItemId();
        var b= treex.getSelectedItemText();
        alert("ini"+a+"/"+b+"fin");
        //treex.getSelectedItemId()=='';
        var habcd=$("hIdCentroCosto").value
        alert("es:"+habcd+"fin");
        
    }
}

//function grabarDetallePuesto(){
//
//
//    patronModulo = "grabarDetallePuesto";
//    parametros='';
//    id=$("hCcosto").value;
//    idPuesto=$("hIdPuesto").value;
//    parametros+='p1='+patronModulo;
//    parametros+='&p2='+$("hIdPuesto").value;
//    parametros+='&p3='+$('selectCategoriaPuestos').value;
//    parametros+='&p4='+$('txtNombrePuesto').value;
//    parametros+='&p5='+$('chkEstado').value;
//    parametros+='&p6='+$('hAccion').value;
//    parametros+='&p7='+$('hCcosto').value;
//
//    new Ajax.Request( pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//            //            $('cell52').update(respuesta);
//            //            $('cell52').show();
//            if(respuesta=='no'){
//                window.alert("no se puede cambiar el estado del Puesto porque hay empleados con este puesto asignado")
//            }
//            deshabilitarDetallePuesto();
//            verPuestos(id,'','detallePuestoCentro');
//            detallePuestoCentro('','',idPuesto)
//        }
//    } )
//
////alert(parametros);
//
//}

function grabarDetallePuesto(){


    patronModulo = "grabarDetallePuesto";
    parametros='';
    id=$("hCcosto").value;
    idPuesto=$("hIdPuesto").value;
    parametros+='p1='+patronModulo;
    parametros+='&p2='+$("hIdPuesto").value;
    parametros+='&p3='+$('selectCategoriaPuestos').value;
    parametros+='&p4='+$('txtNombrePuesto').value;
    parametros+='&p5='+$('chkEstado').value;
    parametros+='&p6='+$('hAccion').value;
    parametros+='&p7='+$('hCcosto').value;

    new Ajax.Request( pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            //            $('cell52').update(respuesta);
            //            $('cell52').show();
            if(respuesta=='no'){
                window.alert("no se puede cambiar el estado del Puesto porque hay empleados con este puesto asignado")
            }
            deshabilitarDetallePuesto();
            verPuestos(id,'','detallePuestoCentro');
            detallePuestoCentro('','',idPuesto)
        }
    } )

//alert(parametros);

}

//function jcqa 11 Mayo 2012 2:55pm
function grabarDetallePuestoaCentroCosto(){

    patronModulo = "grabarDetallePuestoaCentroCosto";
    
    txtNombrePuesto=$("txtNombrePuesto").value;
    hIdCentroCosto=$("hIdCentroCosto").value;
    selectCategoriaPuestos=$("selectCategoriaPuestos").value;
    var estadoPuesto=0;
    estadoPuesto= $('chkEstado').value
    
    
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+txtNombrePuesto;
    parametros+='&p3='+hIdCentroCosto;
    parametros+='&p4='+selectCategoriaPuestos;

 
 
    if(hIdCentroCosto!='' ){
        
        if(txtNombrePuesto.length>=1){
         
            if($("selectCategoriaPuestos").selectedIndex!=0){
                //revisar
                if(estadoPuesto!=0){
                    
                    new Ajax.Request( pathRequestControl,{
                        method : 'get',
                        parameters : parametros,
                        onLoading : micargador(1),
                        onComplete : function(transport){
                            micargador(0);
                            respuesta = transport.responseText;

                            CargarlistadoPuestosXCentroCostos(hIdCentroCosto);
                            //alert("Inicio"+respuesta+"fin");
                            //            $('cell52').update(respuesta);
                            //            $('cell52').show();
                            //                            
                            //                            if(respuesta=='no'){
                            //                                window.alert("no se puede cambiar el estado del Puesto porque hay empleados con este puesto asignado")
                            //
                            //                                                        }
                            //                            alert("res:"+respuesta);
                            if(respuesta.trim()=='ok'){
                                //window.alert("LA RESPUESTA ESTA OK")
                                //$('cell52').update('joseeeee');
                                $('cell52').show();
                               
                                $('cell52').innerHTML='<CENTER><p style="color: blue; font-weight: bold;">El puesto fue asignado correctamente al C.Costos:'+ '<H1 style="color: RED; font-weight: bold;">'+$('hNombreCentroCostoClickeado').value+'</H1></p></CENTER>';
                                
                                
                            //$('cell52').visible(element)
                            //$('cell52').innerHTML='<p style="color: blue; font-weight: bold;">El puesto fue asignado correctament al CCostos</p>';
                            //                                $('cell52').show();
                            }else if (respuesta.trim()=='existe') {
                                //                                window.alert("no se puede cambiar el estado del Puesto porque hay empleados con este puesto asignado")
                                //window.alert("No se pudo asignar un puesto al Centro de Costos escogido, Consulte con Informatica")
                                $('cell52').show();
                               
                                $('cell52').innerHTML='<CENTER><p style="color: red; font-weight: bold;"><img width=40 heigth=40  id=\"imgagenError\" src=\"../../../../fastmedical_front/imagen/icono/alert_big.png\"/>El nombre del Puesto  "'+$('txtNombrePuesto').value+'"  ya existe, escoja otro nombre...</p></CENTER>';
                                
                            }else {
                                alert("hol")
                            }
                            
                            
                            
                        //                            deshabilitarDetallePuesto();
                        //                            verPuestos(id,'','detallePuestoCentro');
                        //                            detallePuestoCentro('','',idPuesto)
                        }
                    } )



                // alert(parametros);
                    
                    
                }else{
                    alert("Active el estado del puesto¡")
                }
              
                
            }else{
                
                alert("Seleccione alguna Categoria para el puesto")
                
            }
        
        }else{
            alert("Escriba algun nombre para el Puesto")   
        }
     
   
    }else{
        alert("Escoja algun Centro de Costos");
     
    }
    

//    new Ajax.Request( pathRequestControl,{
//        method : 'get',
//        parameters : parametros,
//        onLoading : micargador(1),
//        onComplete : function(transport){
//            micargador(0);
//            respuesta = transport.responseText;
//            //            $('cell52').update(respuesta);
//            //            $('cell52').show();
//            if(respuesta=='no'){
//                window.alert("no se puede cambiar el estado del Puesto porque hay empleados con este puesto asignado")
//            }
//            deshabilitarDetallePuesto();
//            verPuestos(id,'','detallePuestoCentro');
//            detallePuestoCentro('','',idPuesto)
//        }
//    } )



//    alert(parametros);

}



function agregarDetallePuesto(){
    //    alert("aler agregarDetallePuesto");
    $('iddetallePuestosCCostos').show();
    limpiarDetallePuesto();
    habilitarDetallePuesto();
    //$('imagenEditar').hide();
    $('hAccion').value=2; //insertar
    $('fila5').show();
    
    $('imgagenGuardar').show();
    
    $('imgagenActualizar').hide();
    
    
    $('cell52').hide();
    $('cell52').update('');
 

}

function ventana_formulario_empleado(){

    ancho='500'
    largo='200'
    ventanaCargar='../../ccontrol/control/control.php?p1=buscarPersonaParaEmpleado'
    titulo='Busqueda...'
    vFormaAbrir='VENTANA'
    vformname='busquedaPersonas'
    vtitle='Busqueda...'
    file02='../../ccontrol/control/control.php?p1=buscarPersonaParaEmpleado'
    vwidth='500'
    vheight='400'
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
    CargarVentanaFormulario(vFormaAbrir,vformname,vtitle,file02,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,veffect,vposx1,vposx2,vposy1,vposy2,file01,vfunctionjava)

}

function registrarEmpleado(evento,elemento,c_cod_per){
    
    //window.alert(c_cod_per);
    if(window.confirm('Esta Seguro de Registar al Empleado con codigo:'+ c_cod_per+' como empleado?')){
        var patronModulo = "registrarEmpleado";
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+c_cod_per;
        parametros+='&p3='+'1';
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                var respuesta = transport.responseText;
                window.alert('La persona Fue Registrada como Empleado Proceda a actualizar sus datos');
                buscarEmpleados(c_cod_per,'0002','','','','','');
                Windows.close("Div_busquedaPersonas");
            }
        }
        )
    }

}

function cambiarEstadoEmpleado(c_cod_per,estado){

    patronModulo = "registrarEmpleado";
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+c_cod_per;
    parametros+='&p3='+estado;

    if(window.confirm('Desea Cambiar el Estado El Estado')){
        new Ajax.Request( pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);
                respuesta = transport.responseText;
                if(respuesta=='yes'){
                    buscarEmpleados(c_cod_per,'','','','','','')
                }else{
                    window.alert('No se puede cambiar de estado porque el empleado tiene puestos activos asignados')
                }
            
            }
        }
        )
    }
     
}

/*=====================================================================================*/
/*==================      Actualizacion -> JCLM - 30/06/2011           ================*/

function cboSedeEmpresaArea(){
    var form="",funcion="";
    var destino="divSedeEmpresaArea";
    var idSede=$("cboSucursal").value;
    $('divAsignarPuestoArea').show();
    //    var nomSede=$("cboSucursal").options[$("cboSucursal").selectedIndex].text;
    //    if(idSede==""){
    //        alert("Por favor seleccione una Sede ...");
    //        return;
    //    }
    var parametros="p1=cboSedeEmpresaArea&p2="+idSede;

    enviarFormulario(form,parametros,funcion,destino);
}