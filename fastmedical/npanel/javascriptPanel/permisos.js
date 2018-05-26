//*************************************************************************************************   
//**********************************USUARIOS POR FORMULARIO*******************************************    
//*************************************************************************************************


function buscarCargarListaFormularios(){
    var palabra=$('txtNombreFormularios').value;
    var arrayPalabras=new Array();
    arrayPalabras=palabra.split(" ");
    var numeroPalabras=arrayPalabras.length;
    tablaFormulario.filterBy(3,arrayPalabras[0]);
    for(var i=1; i<numeroPalabras; i++){
        tablaFormulario.filterBy(3,arrayPalabras[i],true);
    }
}

function cargarListaFormularios(){
       
    var patronModulo='cargarFormulario';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaFormulario=new dhtmlXGridObject('divIzquierda');
    tablaFormulario.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaFormulario.setSkin("dhx_skyblue");
    tablaFormulario.enableRowsHover(true,'grid_hover');
    var filtroFormulario = "<input type='text' id='txtNombreFormularios' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarCargarListaFormularios();\" />"; 
    var header = ["#numeric_filter","#select_filter","",filtroFormulario,""]; 
    tablaFormulario.attachHeader(header); 
    //--------------
    tablaFormulario.attachEvent("onRowSelect", function(fila,columna){
        idFormulario=tablaFormulario.cells(fila,0).getValue();
        $('txtNumSinPermiso').value = idFormulario;
        reporteUsuarioConPermiso(idFormulario);    
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaFormulario.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaFormulario.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
    });
    tablaFormulario.setSkin("dhx_skyblue");
    tablaFormulario.init();
    tablaFormulario.loadXML(pathRequestControl+'?'+parametros);
}

function reporteUsuarioConPermiso(idFormulario){                                                            /********************/
    var patronModulo='cargarUsuarios';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idFormulario;
    tablaUsuarios=new dhtmlXGridObject('divDerecha');
    tablaUsuarios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUsuarios.setSkin("dhx_skyblue");
    tablaUsuarios.enableRowsHover(true,'grid_hover');

    tablaUsuarios.attachEvent("onRowSelect", function(fila,columna){
        if (columna==5){ 
            if(window.confirm("Esta seguro que desea quitarle el permiso ?")){
                idPersona=tablaUsuarios.cells(fila,0).getValue();
                CodFormulario=tablaUsuarios.cells(fila,2).getValue();
                idSistema=tablaUsuarios.cells(fila,3).getValue();
                quitarPermiso(idPersona,CodFormulario,idSistema);           
            }
        }
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUsuarios.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUsuarios.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
            
    });
    /////////////fin cargador ///////////////////////
    tablaUsuarios.setSkin("dhx_skyblue");
    tablaUsuarios.init();
    tablaUsuarios.loadXML(pathRequestControl+'?'+parametros,function(){
        for(i=0;i<tablaUsuarios.getRowsNum();i++){
            tablaUsuarios.setRowTextStyle(tablaUsuarios.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        }  
    });


}

function quitarPermiso(idPersona,CodFormulario,idSistema){
    patronModulo='QuitarPermiso';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+idPersona; 
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            reporteUsuarioConPermiso(CodFormulario)
        }
    } 
    )
}

/*    tablaVerDetalleOrden.setSkin("dhx_skyblue");
    tablaVerDetalleOrden.attachEvent("onRowSelect", aplicarDescuento);*/

function listarPersonasSinPermiso(){
    var idFormulario=$('txtNumSinPermiso').value;
    var patronModulo='cargarUsuariosInac';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idFormulario;
    tablaUsuariosIna=new dhtmlXGridObject('divDerecha');
    tablaUsuariosIna.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUsuariosIna.setSkin("dhx_skyblue");
    tablaUsuariosIna.enableRowsHover(true,'grid_hover');

    tablaUsuariosIna.attachEvent("onRowSelect", function(fila,columna){
        if (columna==5){
            if(window.confirm("Esta seguro asignarle el permiso ?")){
                idPersona=tablaUsuariosIna.cells(fila,0).getValue();
                CodFormulario=tablaUsuariosIna.cells(fila,2).getValue();
                idSistema=tablaUsuariosIna.cells(fila,3).getValue();
                AsignarPermiso(idPersona,CodFormulario,idSistema);
            }
        }
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUsuariosIna.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUsuariosIna.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);        
    });
    tablaUsuariosIna.setSkin("dhx_skyblue");
    tablaUsuariosIna.init();
    tablaUsuariosIna.loadXML(pathRequestControl+'?'+parametros, function(){
        for(i=0;i<tablaUsuariosIna.getRowsNum();i++){
            tablaUsuariosIna.setRowTextStyle(tablaUsuariosIna.getRowId(i) ,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        } 
    });
     
}




function AsignarPermiso(idPersona,CodFormulario,idSistema){
    patronModulo='AsignarPermiso';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+idPersona; 
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            listarPersonasSinPermiso();
        }
    } 
    )
}

function listarPersonasConPermiso(){
    var idFormulario=$('txtNumSinPermiso').value;
    reporteUsuarioConPermiso(idFormulario);
}


function listarUsuariosPermisos(){
    var Permisos=$('bEstado').value;
    if ($('bEstado').checked){
        Permisos=1;
        listarPersonasConPermiso();
    }else {
        Permisos=0; 
        listarPersonasSinPermiso();
    } 
}

    
//*************************************************************************************************   
//**********************************USUARIOS POR SERVICIO*******************************************    
//*************************************************************************************************

function buscarFormularioServicio(){
    var palabra=$('txtNombreFormulariosServicio').value;
    var arrayPalabras=new Array();
    arrayPalabras=palabra.split(" ");
    var numeroPalabras=arrayPalabras.length;
    tablaFormularioservicios.filterBy(4,arrayPalabras[0]);
    for(var i=1; i<numeroPalabras; i++){
        tablaFormularioservicios.filterBy(4,arrayPalabras[i],true);
    }
}

function cargarListaFormulariosServiciosUsuarios(){//carga por defecto la lista de servicios por ususarios***
       
    var patronModulo='cargarFormularioServicios';
    var parametros='';
    parametros+='p1='+patronModulo;
    tablaFormularioservicios=new dhtmlXGridObject('divIzquierda');
    tablaFormularioservicios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaFormularioservicios.setSkin("dhx_skyblue");
    tablaFormularioservicios.enableRowsHover(true,'grid_hover');
    var filtroFormularioServicio = "<input type='text' id='txtNombreFormulariosServicio' style='width:90%;font-size:8pt;font-family:Tahoma; ' onkeyup=\"buscarFormularioServicio();\" />"; 
    var header = ["#select_filter","","#select_filter","",filtroFormularioServicio]; 
    tablaFormularioservicios.attachHeader(header); 
    tablaFormularioservicios.attachEvent("onRowSelect", function(fila,columna){
        var idServicio=tablaFormularioservicios.cells(fila,5).getValue();
        var idSistema=tablaFormularioservicios.cells(fila,1).getValue();
        var idFormulario=tablaFormularioservicios.cells(fila,3).getValue();
        
        $('txtServicioUsuario').value = idServicio; // almacena el id en un txt para mostrar en la nueva tabla derecha 
        $('txtidSistema').value = idSistema; //idServicio,idSistema,idFormulario
        $('txtidFormulario').value = idFormulario; 
        reporteUsuarioServiConPermiso(idServicio,idSistema,idFormulario);    
    }); 

    //    //crear un nuevo evento 
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaFormularioservicios.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaFormularioservicios.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);  
        
        
    });
    tablaFormularioservicios.setSkin("dhx_skyblue");
    tablaFormularioservicios.init();
    tablaFormularioservicios.loadXML(pathRequestControl+'?'+parametros);
}

function cargarServicioUsuarios(fila,columna){//carga los ususarios por servicio********************
    var  CodSistema=tablaFormularioservicios.cells(fila,1).getValue();
    var  CodFormulario=tablaFormularioservicios.cells(fila,3).getValue();
    var  CodServicio=tablaFormularioservicios.cells(fila,5).getValue();
    
    var patronModulo='cargarServicioUsuariose';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+CodSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+CodServicio; 
    tablaServicioUsuarios=new dhtmlXGridObject('divDerecha');
    tablaServicioUsuarios.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaServicioUsuarios.setSkin("dhx_skyblue");
    tablaServicioUsuarios.enableRowsHover(true,'grid_hover');
    //crear un nuevo evento
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaServicioUsuarios.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaServicioUsuarios.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);  
        
    });
    tablaServicioUsuarios.setSkin("dhx_skyblue");
    tablaServicioUsuarios.init();
    tablaServicioUsuarios.loadXML(pathRequestControl+'?'+parametros);
}

function reporteUsuarioServiConPermiso(idServicio,idSistema,idFormulario){// muestra los ususarios con permiso por servicio, en el div derecha
    var Permisos=$('bEstado').value;
    if ($('bEstado').checked){
        Permisos=1;
    }else {
        Permisos=0; 
    }
    if(!(idServicio)){
        idServicio =$('txtServicioUsuario').value ;  
    }
    idSistema= $('txtidSistema').value ; //idServicio,idSistema,idFormulario
    idFormulario=    $('txtidFormulario').value ; 
    var patronModulo='cargarUsuariosActivos';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idServicio;
    parametros+='&p3='+idSistema;
    parametros+='&p4='+idFormulario;
    parametros+='&p5='+Permisos;
    
    tablaUsuarioServiConPermiso=new dhtmlXGridObject('divDerecha');
    tablaUsuarioServiConPermiso.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUsuarioServiConPermiso.setSkin("dhx_skyblue");
    tablaUsuarioServiConPermiso.enableRowsHover(true,'grid_hover');
    tablaUsuarioServiConPermiso.attachEvent("onRowSelect", function(fila,columna){
        if (columna==5){ 
            if(window.confirm("Esta seguro que desea quitarle el permiso ?")){
               
                var idPersona=tablaUsuarioServiConPermiso.cells(fila,0).getValue();
                idFormulario=$('txtidFormulario').value;
                CodServicio=$('txtServicioUsuario').value;
                idSistema=$('txtidSistema').value;
                quitarPermisoServicio(idPersona,idFormulario,idSistema,CodServicio)
            }
        }
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUsuarioServiConPermiso.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUsuarioServiConPermiso.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);
            
    });
    /////////////fin cargador ///////////////////////
    tablaUsuarioServiConPermiso.setSkin("dhx_skyblue");
    tablaUsuarioServiConPermiso.init();
    tablaUsuarioServiConPermiso.loadXML(pathRequestControl+'?'+parametros,function(){
        for(i=0;i<tablaUsuarioServiConPermiso.getRowsNum();i++){
            tablaUsuarioServiConPermiso.setRowTextStyle(tablaUsuarioServiConPermiso.getRowId(i) ,'background-color:#C1E69D;color:black;border-top: 1px solid #DAEFC2;');
        }  
    });
}

function quitarPermisoServicio(idPersona,CodFormulario,idSistema,idServicio){//quita permiso de servicio
    patronModulo='QuitarPermisoServicioUsuarios';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+idPersona; 
    parametros+="&p5="+ idServicio;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            reporteUsuarioServiConPermiso(idServicio,idSistema,CodFormulario)
        }
    } 
    )
}

function listarPersonasServiSinPermiso(idSistema, CodFormulario, idPersona,idServicio){//lista las personas sin permiso por servicio
    idSistema= $('txtidSistema').value ; //idServicio,idSistema,idFormulario
    idServicio=    $('txtServicioUsuario').value ; 
    CodFormulario= $('txtidFormulario').value ;
    if(!(idPersona)){
        idPersona='';  
    }
    var patronModulo='cargarServicioUsuariosInactivos';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+idPersona; 
    parametros+="&p5="+ idServicio;
    tablaUsuariosInactivos=new dhtmlXGridObject('divDerecha');
    tablaUsuariosInactivos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaUsuariosInactivos.setSkin("dhx_skyblue");
    tablaUsuariosInactivos.enableRowsHover(true,'grid_hover');
    tablaUsuariosInactivos.attachEvent("onRowSelect", function(fila,columna){
        if (columna==5){
            if(window.confirm("Esta seguro asignarle el permiso ?")){
                var idPersona=tablaUsuariosInactivos.cells(fila,0).getValue();
                CodFormulario=$('txtidFormulario').value;
                CodServicio=$('txtServicioUsuario').value;
                idSistema=$('txtidSistema').value;
                
                AsignarPermisoServicio(idPersona,CodFormulario,idSistema,idServicio);
              
            }
        }
    });  
    contadorCargador++;
    var idCargador=contadorCargador;
    tablaUsuariosInactivos.attachEvent("onXLS", function(){
        cargadorpeche(1,idCargador);
    });
    tablaUsuariosInactivos.attachEvent("onXLE", function(){
        cargadorpeche(0,idCargador);        
    });
    tablaUsuariosInactivos.setSkin("dhx_skyblue");
    tablaUsuariosInactivos.init();
    tablaUsuariosInactivos.loadXML(pathRequestControl+'?'+parametros, function(){
        for(i=0;i<tablaUsuariosInactivos.getRowsNum();i++){
            tablaUsuariosInactivos.setRowTextStyle(tablaUsuariosInactivos.getRowId(i) ,'background-color:#FFA66A;color:black;border-top: 1px solid #FFD7BB;');
        } 
    });
     
} 

function AsignarPermisoServicio(idPersona,CodFormulario,idSistema,idServicio){//asigna permiso de servicio
    patronModulo='AsignarPermisoServicioUsuarios';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+="&p2="+idSistema; 
    parametros+="&p3="+CodFormulario; 
    parametros+="&p4="+idPersona; 
    parametros+="&p5="+ idServicio;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            listarPersonasServiSinPermiso(idSistema, CodFormulario, idPersona);
        }
    } 
    )
}   


function listarPersonasServiConPermiso(){ //Guarga en el txt los usuarios con permiso de servicios
    var idServicio=$('txtServicioUsuario').value;
    var idSistema=  $('txtidSistema').value  //idServicio,idSistema,idFormulario
    var  idFormulario= $('txtidFormulario').value ;
    reporteUsuarioServiConPermiso(idServicio,idSistema,idFormulario)
}

function listarUsuariosServiPermisos(){//lista los usuarios con permiso por servicio, marcando el checkbox
    var Permisos=$('bEstado').value;
    if ($('bEstado').checked){
        Permisos=1;
        listarPersonasServiConPermiso();
    }else {
        Permisos=0; 
        listarPersonasServiSinPermiso();
    // listarPersonasServiSinPermiso(idSistema, CodFormulario, idPersona);
    } 
}


//  ----------------------------------------------------- CLONAR PERMISOS DE USUARIOS--------------------------------------------//

function podpadbuscarUsuariosClonarUsuario(){
  
    varBusquedaUsuario='1';
    var posFuncion = "";
    var vtitle="<h2>BUSQUEDA DE USUARIO</h2>";
    var vformname='podpadbuscarUsuariosClonarUsuario';
    var vwidth='840';
    var vheight='220';
    var patronModulo='podpadbuscarUsuariosClonarUsuario';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
  
}

// limpiar busqueda de la pantalla busqueda usuario
function limpiaBusquedaClonar(opc,elemento,evento){
    switch(opc)
    {
        case "01": //Busqueda por usuario
            document.getElementById('txtapellidoPaterno').value='';
            document.getElementById('txtapellidoMaterno').value='';
            document.getElementById('txtnombres').value='';
            break;

        case "04": //busqeuda por nombre
            document.getElementById('txtUsuario').value='';

            break;
    }
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        buscarUsuariosClonarUsuario();
    }  
}  

function buscarUsuariosClonarUsuario(){
    var usuario=$('txtUsuario').value;
    var apellidoPaterno=$('txtapellidoPaterno').value;
    var apellidoMaterno=$('txtapellidoMaterno').value;
    var nombres=$('txtnombres').value;
    
    if(apellidoPaterno.trim()!='' || apellidoMaterno.trim()!='' ||nombres.trim()!=''||usuario.trim()!='Buscar...'){
        var patronModulo = "buscarUsuariosClonarUsuario";
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+usuario;
        parametros+='&p3='+apellidoPaterno;
        parametros+='&p4='+apellidoMaterno;
        parametros+='&p5='+nombres;

        tablaEmpleados=new dhtmlXGridObject('divTablaResultadosEmpleados');
        tablaEmpleados.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaEmpleados.setSkin("dhx_skyblue");
        tablaEmpleados.enableRowsHover(true,'grid_hover');
        tablaEmpleados.attachEvent("onRowSelect", function(fila,columna){
            cargarDatosUsuario(fila,columna);
        });  
        tablaEmpleados.init();
        
    
        //        tablaEmpleados.loadXML(pathRequestControl+'?'+parametros);
        tablaEmpleados.loadXML(pathRequestControl+'?'+parametros, function(){   
            setColorTablaEstado();
        
        });
        
    }else{
        alert("Llene al menos un campo")
    }
   
}   


function  setColorTablaEstado(){
    for(fila=0;fila<tablaEmpleados.getRowsNum();fila++){
        var estado = tablaEmpleados.cells(fila,7).getValue();
        //        alert(estado);
        if(estado==0){
            tablaEmpleados.setRowTextStyle(tablaEmpleados.getRowId(fila) ,'background-color:#FFA66A;color:black;border-top: 1px solid #A9D0F5;');
        }
        else
            tablaEmpleados.setRowTextStyle(tablaEmpleados.getRowId(fila) ,'background-color:#C1E69D;color:black;border-top: 1px solid #FFD7BB;');
    }
}

function  cargarDatosUsuario(fila,columna){                                                          //*****************
    var  codPerOriginal=tablaEmpleados.cells(fila,0).getValue();
    var  loginUsuario=tablaEmpleados.cells(fila,1).getValue();
    var  usuario=tablaEmpleados.cells(fila,2).getValue();
    var  idPuestoEmpleado=tablaEmpleados.cells(fila,8).getValue();
    var  bEstados=tablaEmpleados.cells(fila,7).getValue();
    var  vNombrePuesto=tablaEmpleados.cells(fila,9).getValue();
    var  iCodigoEmpleado=tablaEmpleados.cells(fila,6).getValue();
    var  codpersona=tablaEmpleados.cells(fila,0).getValue();
    
    $('txtcodigoPerOriginal').value=codPerOriginal;
    $('txtnombreclonado').value=usuario;
    $('txtNombre_clonado').value=loginUsuario;
    $('txtCodigo').value=iCodigoEmpleado; 
    $('txtPersona').value=codpersona; 
    Windows.close("Div_podpadbuscarUsuariosClonarUsuario");
    CargarPuestosClonarUsuario(idPuestoEmpleado,bEstados,vNombrePuesto,iCodigoEmpleado);    
}

// carga tabla de puesto DEL USUARIO A CLONAR xD
function CargarPuestosClonarUsuario(idPuestoEmpleado,bEstados,vNombrePuesto,iCodigoEmpleado){// muestra los ususarios con permiso por servicio, en el div derecha
    var patronModulo='CargarPuestosClonarUsuario';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idPuestoEmpleado;
    parametros+='&p3='+bEstados;
    parametros+='&p4='+vNombrePuesto;
    parametros+='&p5='+iCodigoEmpleado;
    tablaCargarPuestosClonarUsuario=new dhtmlXGridObject('div_datosPuesto');
    tablaCargarPuestosClonarUsuario.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaCargarPuestosClonarUsuario.setSkin("dhx_skyblue");
    tablaCargarPuestosClonarUsuario.enableRowsHover(true,'grid_hover');
    tablaCargarPuestosClonarUsuario.attachEvent("onRowSelect", function(fila,columna){
       
        });  
    tablaCargarPuestosClonarUsuario.init();
    //  tablaCargarPuestosClonarUsuario.loadXML(pathRequestControl+'?'+parametros, function(){
       
    tablaCargarPuestosClonarUsuario.loadXML(pathRequestControl+'?'+parametros, function(){   
        setColorTablaEstadoCargar();
    });
}

function  setColorTablaEstadoCargar(){
    for(fila=0;fila<tablaCargarPuestosClonarUsuario.getRowsNum();fila++){
        var estado = tablaCargarPuestosClonarUsuario.cells(fila,1).getValue();
        //    alert(estado);
        if(estado==0){
            tablaCargarPuestosClonarUsuario.setRowTextStyle(tablaCargarPuestosClonarUsuario.getRowId(fila) ,'background-color:#FFA66A;color:black;border-top: 1px solid #A9D0F5;');
        }
        else
            tablaCargarPuestosClonarUsuario.setRowTextStyle(tablaCargarPuestosClonarUsuario.getRowId(fila) ,'background-color:#C1E69D;color:black;border-top: 1px solid #FFD7BB;');
  
    }
}


//----------------------------Usuario Copia del Clonar ----------------
function podpadbuscarUsuariosCopia(){
  
    varBusquedaUsuario='1';
    var posFuncion = "";
    var vtitle="<h2>BUSQUEDA DE USUARIO</h2>";
    var vformname='podpadbuscarUsuariosCopia';
    var vwidth='840';
    var vheight='220';
    var patronModulo='podpadbuscarUsuariosCopia';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
  
}

function limpiaBusquedaUsuarioCopia(opc,elemento,evento){

    switch(opc)
    {
        case "01": //Busqueda por usuario
            document.getElementById('txtapellidoPaterno').value='';
            document.getElementById('txtapellidoMaterno').value='';
            document.getElementById('txtnombres').value='';
            break;

        case "04": //busqeuda por nombre
            document.getElementById('txtUsuario').value='';

            break;
    }
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        buscarUsuariosCopia();
    } 
    
} 
function limpiaBusquedaUsuarioCopiaTexto(){
    document.getElementById('txtapellidoPaterno').value='';
    document.getElementById('txtapellidoMaterno').value='';
    document.getElementById('txtnombres').value=''; 
    document.getElementById('txtUsuario').value='Buscar...';
}

function buscarUsuariosCopia(){
    var usuario=$('txtUsuario').value;
    var apellidoPaterno=$('txtapellidoPaterno').value;
    var apellidoMaterno=$('txtapellidoMaterno').value;
    var nombres=$('txtnombres').value;
    if(apellidoPaterno.trim()!='' || apellidoMaterno.trim()!='' ||nombres.trim()!=''||usuario.trim()!='Buscar...'){

        var patronModulo = "buscarUsuariosClonarUsuario";
        var parametros='';
        parametros+='p1='+patronModulo;
        parametros+='&p2='+usuario;
        parametros+='&p3='+apellidoPaterno;
        parametros+='&p4='+apellidoMaterno;
        parametros+='&p5='+nombres;

        tablaUsuariosCopia=new dhtmlXGridObject('divTablaResultadosEmpleados');
        tablaUsuariosCopia.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
        tablaUsuariosCopia.setSkin("dhx_skyblue");
        tablaUsuariosCopia.enableRowsHover(true,'grid_hover');
        tablaUsuariosCopia.attachEvent("onRowSelect", function(fila,columna){
            cargarDatosUsuarioCopia(fila,columna); 
        });  
        tablaUsuariosCopia.init();
        // tablaUsuariosCopia.loadXML(pathRequestControl+'?'+parametros) 
        tablaUsuariosCopia.loadXML(pathRequestControl+'?'+parametros, function(){   
            setColorTablaEstadoCopia();
        });

    }else{
        alert("Llene al menos un campo")
    }  
}   

function  setColorTablaEstadoCopia(){
    for(fila=0;fila<tablaUsuariosCopia.getRowsNum();fila++){
        var estado = tablaUsuariosCopia.cells(fila,7).getValue();
        //        alert(estado);
        if(estado==0){
            tablaUsuariosCopia.setRowTextStyle(tablaUsuariosCopia.getRowId(fila) ,'background-color:#FFA66A;color:black;border-top: 1px solid #A9D0F5;');
        }
        else
            tablaUsuariosCopia.setRowTextStyle(tablaUsuariosCopia.getRowId(fila) ,'background-color:#C1E69D;color:black;border-top: 1px solid #FFD7BB;');
    }
}

function  cargarDatosUsuarioCopia(fila,columna){
    var  codigoPerCopia=tablaUsuariosCopia.cells(fila,0).getValue();
    var  loginUsuario=tablaUsuariosCopia.cells(fila,1).getValue();
    var  usuario=tablaUsuariosCopia.cells(fila,2).getValue();
    var  idPuestoEmpleado=tablaUsuariosCopia.cells(fila,8).getValue();
    var  bEstados=tablaUsuariosCopia.cells(fila,7).getValue();
    var  vNombrePuesto=tablaUsuariosCopia.cells(fila,9).getValue();
    var  iCodigoEmpleado=tablaUsuariosCopia.cells(fila,6).getValue();
    $('txtnombreCopia').value=usuario;
    $('txtNombre_copia').value=loginUsuario;
    $('txtCodigoCopia').value=iCodigoEmpleado;
    $('txtcodigoPerCopia').value=codigoPerCopia;
    Windows.close("Div_podpadbuscarUsuariosCopia");
    CargarPuestosClonarCopia(idPuestoEmpleado,bEstados,vNombrePuesto,iCodigoEmpleado);  
}

function CargarPuestosClonarCopia(idPuestoEmpleado,bEstados,vNombrePuesto,iCodigoEmpleado){// muestra los ususarios con permiso por servicio, en el div derecha
    var patronModulo='CargarPuestosClonarUsuario';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idPuestoEmpleado;
    parametros+='&p3='+bEstados;
    parametros+='&p4='+vNombrePuesto;
    parametros+='&p5='+iCodigoEmpleado;
    tablaCargarPuestosUsuarioCopia=new dhtmlXGridObject('div_datosPuestoCopia');
    tablaCargarPuestosUsuarioCopia.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaCargarPuestosUsuarioCopia.setSkin("dhx_skyblue");
    tablaCargarPuestosUsuarioCopia.enableRowsHover(true,'grid_hover');
    tablaCargarPuestosUsuarioCopia.attachEvent("onRowSelect", function(fila,columna){
        });  
    tablaCargarPuestosUsuarioCopia.init();
    //tablaCargarPuestosUsuarioCopia.loadXML(pathRequestControl+'?'+parametros);   
    tablaCargarPuestosUsuarioCopia.loadXML(pathRequestControl+'?'+parametros, function(){   
        setColorTablaClonarCopia();
    });
}

function  setColorTablaClonarCopia(){
    for(fila=0;fila<tablaCargarPuestosUsuarioCopia.getRowsNum();fila++){
        var estado = tablaCargarPuestosUsuarioCopia.cells(fila,1).getValue();
        //       alert(estado);
        if(estado==0){
            tablaCargarPuestosUsuarioCopia.setRowTextStyle(tablaCargarPuestosUsuarioCopia.getRowId(fila) ,'background-color:#FFA66A;color:black;border-top: 1px solid #A9D0F5;');
        }
        else
            tablaCargarPuestosUsuarioCopia.setRowTextStyle(tablaCargarPuestosUsuarioCopia.getRowId(fila) ,'background-color:#C1E69D;color:black;border-top: 1px solid #FFD7BB;');
    }
}

              
function ConfirmacionClonar(){
    var codPerOriginal=$('txtcodigoPerOriginal').value;
    var codigoPerCopia=$('txtcodigoPerCopia').value;
    if(window.confirm("Esta seguro se copiar todos los permisos ?")){
        clonarPermisos(codPerOriginal,codigoPerCopia);
    }  
}

function clonarPermisos(codPerOriginal,codigoPerCopia){
    var patronModulo='ClonarUsuario';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+codPerOriginal;
    parametros+='&p3='+codigoPerCopia;
    
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            ClonacionRealizada(codPerOriginal, codigoPerCopia);
        }
    } 
    )
 
}

function ClonacionRealizada(){
    window.alert("Se asignaron correctamente los permisos" )
}

//FUNCION CARGAR VENTANA DE POPPAP
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
	  
        new Ajax.Request(pathRequestControl,{
            method : 'get',
            parameters : parametros,
            onLoading : micargador(1),
            onComplete : function(transport){
                micargador(0);

                respuesta = transport.responseText;
                $(vidfrm).update(respuesta);
                posFuncion+="('')";
                eval(posFuncion);
            }
        } )
    }
}

//------------------------------RESETEO DE CLAVES-------------------------------------------------

function ConfirmacionResetearclave(){
    var c_cod_per=$('txtPersona').value;//envia la informacion del codigo de persona a la base de datos
    if(window.confirm("Esta seguro de resetear la contraseña?")){
        // alert(c_cod_per);
        ResetearClave(c_cod_per);
    }  
}

function ResetearClave(c_cod_per){
    var patronModulo='realizarResetearClave';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+c_cod_per;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            ResetearClaveRealizada();
        }
    } 
    )
}

function ResetearClaveRealizada(){
    window.alert("Se realizó correctamente el reseteo de la clave" )
}

//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL-----------------------------------------
//-----------------------------------------------------------------------------------------

function ConfirmacionCancelarSesionIndividual(){
    var idSession=$('txtidSession').value;
    var idInt=$('txtidInt').value;
    var idusuario=$('txtidusuario').value;

    if(window.confirm("¿Esta seguro de cancelar la sesion?")){
        // alert(c_cod_per);
        CancelarSesionIndividual(idSession,idInt,idusuario);
    }  
}

function CancelarSesionIndividual(idSession,idInt,idusuario){
    var patronModulo='realizarCancelarSesion';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idSession;
    parametros+='&p3='+idInt;
    parametros+='&p4='+idusuario;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            CancelarSesionRealizadaIndividual();
        }
    } 
    )
}

function CancelarSesionRealizadaIndividual(){
    window.alert("Se cancelo correctamente la sesion del usuario" )
}


function podpadbuscarUsuariosCancelarSesion(){
  
    var posFuncion = "";
    var vtitle="";
    var vformname='podpadbuscarUsuariosCancelarSesion';
    var vwidth='840';
    var vheight='520';
    var patronModulo='podpadbuscarUsuariosCancelarSesion';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
  
}

// limpiar busqueda de la pantalla busqueda usuario
function limpiaBusquedaCancelarSesion(opc,elemento,evento){
    switch(opc)
    {
        case "01": //Busqueda por usuario
            document.getElementById('txtapellidoPaterno').value='';
            document.getElementById('txtapellidoMaterno').value='';
            document.getElementById('txtnombres').value='';
            break;

        case "04": //busqeuda por nombre
            document.getElementById('txtUsuario').value='';

            break;
    }
    if(evento==''){
        tecla=13;
    }
    else{
        tecla=evento.keyCode
    }
    if(tecla==13){
        buscarUsuariosCancelarSesion();
    }  
    

    //busca a los usuarios para cerrar su sesion
    function buscarUsuariosCancelarSesion(){ // popap que busca a los usuarios para cancelar su sesion
        var usuario=$('txtUsuario').value;
        var apellidoPaterno=$('txtapellidoPaterno').value;
        var apellidoMaterno=$('txtapellidoMaterno').value;
        var nombres=$('txtnombres').value;
    

    
        if(apellidoPaterno.trim()!='' || apellidoMaterno.trim()!='' ||nombres.trim()!=''||usuario.trim()!='Buscar...'){
            var patronModulo = "buscarUsuariosCancelarSesion";
            var parametros='';
            parametros+='p1='+patronModulo;
            parametros+='&p2='+usuario;
            parametros+='&p3='+apellidoPaterno;
            parametros+='&p4='+apellidoMaterno;
            parametros+='&p5='+nombres;

            tablaBusqueda=new dhtmlXGridObject('divTablaResultadosEmpleados');
            tablaBusqueda.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
            tablaBusqueda.setSkin("dhx_skyblue");
            tablaBusqueda.enableRowsHover(true,'grid_hover');
            tablaBusqueda.attachEvent("onRowSelect", function(fila,columna){
                cargarUsuarioCerrarSesion(fila,columna);
            });  
            tablaBusqueda.init();
            tablaBusqueda.loadXML(pathRequestControl+'?'+parametros, function(){   
                //    setColorTablaEstado();    
                });
        }else{
            alert("Llene al menos un campo")
        } 
    }  

    function  cargarUsuarioCerrarSesion(fila,columna){                                                        
        var  estado=tablaBusqueda.cells(fila,0).getValue();
        var  c_cod_per=tablaBusqueda.cells(fila,1).getValue();
        var  idusuario=tablaBusqueda.cells(fila,6).getValue();
        var  idInt=tablaBusqueda.cells(fila,8).getValue();
        var  idSession=tablaBusqueda.cells(fila,9).getValue();
        var  nombre=tablaBusqueda.cells(fila,2).getValue();

        // carga tabla de la tabla del popap a los text
        $('txtestado').value=estado;
        $('txtc_cod_per').value=c_cod_per;
        $('txtidusuario').value=idusuario;
        $('txtidInt').value=idInt; 
        $('txtidSession').value=idSession; 
        $('txtnombreCancelar').value=nombre;
        Windows.close("Div_podpadbuscarUsuariosCancelarSesion");
    }
}   


//-----------------------------------------------------------------------------------------
//----------------------------CANCELAR SESION POR PERFIL-----------------------------------
//-----------------------------------------------------------------------------------------



function podpadseleccionarPerfilCancelarSesion(){
    var posFuncion = "cargarArbolPopad";
    var vtitle="";
    var vformname='podpadseleccionarPerfilCancelarSesion';
    var vwidth='940';
    var vheight='550';
    var patronModulo='podpadseleccionarPerfilCancelarSesion';
    var vcenter='t';
    var vresizable=''
    var vmodal='false';
    var vstyle='';
    var vopacity='';
    var veffect='';
    var vposx1='';
    var vposx2='';
    var vposy1='';
    var vposy2='';
    var parametros='';
    parametros+='p1='+patronModulo;
    this.CargarVentanaPopPap(vformname, vtitle, vwidth, vheight, vcenter, vresizable, vmodal, vstyle, vopacity, vposx1, vposx2, vposy1, vposy2, parametros, posFuncion);
    //cargarArbolPopad();
}

function cargaArbolCCostoCS(){
    var parametros="p1=generaArbolCentroCostosCS";
    var divMostrar=document.getElementById('divCCostos');
    divMostrar.innerHTML = " ";
    treeCentroCostos=new dhtmlXTreeObject("divCCostos","100%","100%",0);
    treeCentroCostos.setSkin('dhx_skyblue');
    treeCentroCostos.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treeCentroCostos.attachEvent("onClick", function(){
        //  buscarEmpleadosCentroCostos();
        //  buscarEmpleadosCentroCostos(treeCentroCostos.getSelectedItemId(),treeCentroCostos.getSelectedItemText());
        } );
    
    treeCentroCostos.openAllItems(0);
    //    treex.setXMLAutoLoading(pathRequestControl+'?'+parametros);
    treeCentroCostos.loadXML(pathRequestControl+'?'+parametros);
}



function cargarArbolPopad(){
    recargarArbolCCostosPuestosPopad();
}

function recargarArbolCCostosPuestosPopad(){    
    tree2=new dhtmlXTreeObject("divCCostosPopad","100%","100%",0);
    tree2.setImagePath("../../../../fastmedical_front/imagen/icono/tree/");
    tree2.attachEvent("onClick", function(){
        funcionArbolPopad(tree2.getSelectedItemId());
        return true;
    })
    tree2.loadXML("../../../../carpetaDocumentos/arbol_centroCostos.xml");
}

function funcionArbolPopad(var2){   
    var patronModulo = "funcionArbolPopad";
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+var2;
    tablaPuestos=new dhtmlXGridObject('divTablaResultadosEmpleados');
    tablaPuestos.setImagePath("../../../imagen/dhtmlxgrid/imgs/");
    tablaPuestos.setSkin("dhx_skyblue");
    tablaPuestos.enableRowsHover(true,'grid_hover');
    tablaPuestos.attachEvent("onRowSelect", function(fila,columna){
        var IdPuesto =tablaPuestos.cells(fila,0).getValue();
        if (columna==6){
          cargarArrayIdSesiones(IdPuesto);
        }
        });  
    tablaPuestos.init();
    tablaPuestos.loadXML(pathRequestControl+'?'+parametros, function(){   
        });
        
}


function cargarArrayIdSesiones(IdPuesto){
    var patronModulo='cargarArrayIdSesiones';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+IdPuesto;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            eliminarSesionesSegunPerfil(respuesta);
        }
    } 
    )
}

function  eliminarSesionesSegunPerfil(respuesta){
      var patronModulo='eliminarSesionesSegunPerfil';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+respuesta;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
        }
    } 
    )
}


//-----------------------------------------------------------------------------------------
//---------------------------------CANCELAR SESION INDIVIDUAL-----------------------------------------
//-----------------------------------------------------------------------------------------

function ConfirmacionCancelarSesionTotal(){
    if(window.confirm("¿Esta seguro de cancelar la sesion?")){
      // alert('hola');
        CancelarSesionTotal();
    }  
}

function CancelarSesionTotal(){
    var patronModulo='realizarCancelarSesionTotal';
    var parametros='';  
    parametros+='p1='+patronModulo;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            CancelarSesionRealizadaTotal();
        }
    } 
    )
}

function CancelarSesionRealizadaTotal(){
    window.alert("Se cancelo correctamente la sesion del usuario" )
}

//-----------------------------------------------------------------------------------------
//---------------------------------PERIODO DE ACCESO---------------------------------------
//-----------------------------------------------------------------------------------------

function caducarSesion (){
    alert ('CADUCANDO!');
  
    var patronModulo='realizarCaducarSesion';
    var parametros='';  
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idSession;
    parametros+='&p3='+idInt;
    parametros+='&p4='+idusuario;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1), 
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText
            CancelarSesionRealizadaIndividual();
        }
    } 
    )  
    
}
















/*
var cambioFechaLaboratorio=""
function estadoCambioFechasConsultaLaboratorio(opc){
    if(opc.trim()==1){
        cambioFechaLaboratorio=1;
    }
    else{
        cambioFechaLaboratorio=0;
    }
}


function calendarioHtmlx(id){
    window.dhx_globalImgPath = "../dhtmlxCalendar";
    var fecha = new Date();
    var aniolimite = fecha.getFullYear()+2;
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

    mCal = new dhtmlxCalendarObject(id, false, {
        isMonthEditable: true,
        isYearEditable: true,
        dateformat: '%d/%m/%Y'
        
    });
    mCal.setYearsRange(1900, aniolimite);
    mCal.loadUserLanguage('es');

    mCal.attachEvent("onClick", function(date) {
        var d = new Date(date);
        fecha =  d.getDate()+"/"+d.getMonth() + "/" +d.getFullYear();
    //calculaEdad(fecha);
    });
    
    mCal.draw(); 
}*/





