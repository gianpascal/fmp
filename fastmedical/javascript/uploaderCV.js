var http=createRequestObject();
var uploader="";
var uploadDir="";
var dirname="";
var filename="";
var timeInterval="";
var idname="";

function createRequestObject() {
    var obj;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    else{
        return new XMLHttpRequest();
    }   
}
function traceUploadCV(idDocumentoEmpleado,idDocumento,version,codigoPersona,nomDocumento,ruta,flag) {
    pathRequestControlup='../rrhh/fileupload.php';
    patronModulo='adjuntarOtroFile';
    parametros='uploadDir='+uploadDir+'&dirname='+dirname+'&filename='+filename+'&uploader='+uploader;
    parametros+='&hdnIdDocEmpx='+idDocumentoEmpleado;
    parametros+='&hdnIdDocumentox='+idDocumento;
    parametros+='&hdnVersionx='+version;
    parametros+='&hdnCodPersonax='+codigoPersona;
    parametros+='&hdnNomDocumentox='+nomDocumento;
    parametros+='&hdnRutax='+ruta;
    parametros+='&hdnFlagx='+flag;
    //alert("heyy"+ruta);
    new Ajax.Request(pathRequestControlup,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            //            document.getElementById('txtAccion').value=0;
            respuesta = transport.responseText;
            //            mostrarTLegajo(document.getElementById('txtCodPer').value,1);
            $('divAdjuntarOtro').update(respuesta);
        //            $('divDerRegistroP').update(respuesta);
        }
    } )
}
function handleResponse() {
    if(http.readyState == 4){
        var response=http.responseText; 
        if(response.indexOf("File uploaded") != -1){
            clearInterval(timeInterval);
        //document.getElementById('loading'+idname).innerHTML="";
        }
        document.getElementById(uploaderId).innerHTML=response;
    //		document.getElementById('foto').innerHTML=response;
    }
    else {
        document.getElementById(uploaderId).innerHTML="Uploading File. Please wait...";
    }
}
/*function uploadFile(obj, dname) {
    alert('hola');
    uploadDir=obj.value;
    idname=obj.name;
    dirname=dname;
    filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
    //document.getElementById('loading'+idname).innerHTML="<img src='loading.gif' alt='loading...' />";
    uploaderId = 'uploader'+obj.name;
    uploader = obj.name;
    document.getElementById('formName'+obj.name).submit();
    timeInterval=setInterval("traceUpload()", 1500);
}*/
function uploadFileCV(obj, dname) {
    /*Inicializando variables*/
    //alert(dname);
    idDocumentoEmpleado=$('hdnIdDocEmp').value; //idDocumentoEmpleado
    idDocumento=$('hdnIdDocumento').value;
    nomDocumento=$('hdnNomDocumento').value;
    version=$('hdnVersion').value;
    codigoPersona=$('hdnCodPersona').value;
    ruta=$('hdnRuta').value;
    flag=$('hdnFlag').value;
    http=createRequestObject();
    uploadDir=obj.value;
    idname=obj.name;
    dirname=dname;
    filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
    document.getElementById('loading'+idname).innerHTML="";
    uploaderId = 'uploader'+obj.name;
    uploader = obj.name;
    //    document.getElementById('txtFotografia').value=filename;
    variable=document.getElementById('formName'+obj.name).submit();
    //setInterval se ejecutar� una y otra vez en intervalos de x segundos,
    //    alert(variable);
    //          alert("sss"+ruta);
    //traceUploadCV(idDocumentoEmpleado);
    timeInterval=setInterval("traceUploadCV("+idDocumentoEmpleado+","+idDocumento+","+version+",'"+codigoPersona+"','"+nomDocumento+"','"+ruta+"',"+flag+")", 1500);

}


//creado por JCQA 4Agosto 2012

function uploadFileCVjc(obj, dname) {
    /*Inicializando variables*/
    //alert("uploadFileeee");
    //alert(dname);

    
    var idMaterialLabo= $('hdnMaterialLabo').value;
    var codSerPro= $('hdncodserpro').value;
    var tipoMaterialLabo= $('hdnTipoMaterialLabo').value;
    var nombreTipoMaterialLabo= $('hdnnombreTipoMaterialLabo').value;
    var idArchivosMaterialLabo= $('hdnidArchivosMaterialLabo').value;
    var versionArchivo= $('hdnversionArchivo').value;
    var rutaCompletaArchivo= $('hdnrutaCompletaArchivo').value;
    var rutaSubida= $('hdnrutaSubida').value;
    var flag1=$('hdnFlag1').value;
    //    alert("idMaterialLabo uploadFile"+idMaterialLabo);

    //alert(idMaterialLabo+'/'+codSerPro+'/'+tipoMaterialLabo+'/'+nombreTipoMaterialLabo+'/'+idArchivosMaterialLabo+'/'
    //   +versionArchivo+'/'+rutaCompletaArchivo+'/'+rutaSubida+'/'+flag1)
    //    idDocumentoEmpleado=$('hdnIdDocEmp').value; //idDocumentoEmpleado
    //    idDocumento=$('hdnIdDocumento').value;
    //    nomDocumento=$('hdnNomDocumento').value;
    //    version=$('hdnVersion').value;
    //    codigoPersona=$('hdnCodPersona').value;
    //    
    //    ruta=$('hdnRuta').value;
    //    flag=$('hdnFlag').value;
    //    
    
    http=createRequestObject();
    uploadDir=obj.value;   //uploadDir: foto.jpg
    idname=obj.name; //id2
    dirname=dname;    //
    //    alert('uploadDir:'+uploadDir+'idname'+idname+'dirname:'+dirname);

    
    filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
    document.getElementById('loading'+idname).innerHTML="";
    uploaderId = 'uploader'+obj.name;
    uploader = obj.name;
    //    alert('filename:::::'+filename);
    //    document.getElementById('txtFotografia').value=filename;
    variable=document.getElementById('formName'+obj.name).submit();
    //setInterval se ejecutar� una y otra vez en intervalos de x segundos,
    //    alert(variable);
    //          alert("sss"+ruta);
    //traceUploadCV(idDocumentoEmpleado);
    //    timeInterval=setInterval("traceUploadCV("+idDocumentoEmpleado+","+idDocumento+","+version+",'"+codigoPersona+"','"+nomDocumento+"','"+ruta+"',"+flag+")", 1500);
    //alert("traceUploadCVjc("+idMaterialLabo+",'"+codSerPro+"',"+versionArchivo+",'"+tipoMaterialLabo+"','"+nombreTipoMaterialLabo+"','"+rutaSubida+"',"+flag1+")");
    timeInterval=setInterval("traceUploadCVjc("+idMaterialLabo+",'"+codSerPro+"','"+versionArchivo+"','"+tipoMaterialLabo+"','"+nombreTipoMaterialLabo+"','"+rutaSubida+"',"+flag1+")", 1500);


}

//creado por JCQA 4Agosto 2012
function traceUploadCVjc(idMaterialLabo,codSerPro,versionArchivo,tipoMaterialLabo,nombreTipoMaterialLabo,rutaSubida,flag1) {
    //alert("holassssssssssssss");
    pathRequestControlupjc='../laboratorio/fileupload3.php';
    
    //    pathRequestControlup='../rrhh/fileupload.php';
    
    patronModulo='adjuntarOtroFile';
    parametros='uploadDir='+uploadDir+'&dirname='+dirname+'&filename='+filename+'&uploader='+uploader;
    parametros+='&hdnidMaterialLabo='+idMaterialLabo;
    parametros+='&hdncodSerPro='+codSerPro;
    parametros+='&hdnversionArchivo='+versionArchivo;
    parametros+='&hdntipoMaterialLabo='+tipoMaterialLabo;
    parametros+='&hdnnombreTipoMaterialLabo='+nombreTipoMaterialLabo;
    parametros+='&hdnrutaSubida='+rutaSubida;
    parametros+='&hdnflag1='+flag1;
  
    new Ajax.Request(pathRequestControlupjc,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('divAdjuntarOtrojc').update(respuesta);
            
            //            alert("traceUploadTerminado");
            var nuevaVersion=parseInt(versionArchivo) +1;
            //            alert(nuevaVersion);
            $('hRutaCompletaNuevoArchivoSubido').value=rutaSubida+idMaterialLabo+'_'+codSerPro+'_V'+nuevaVersion;
            
            var srcNuevaFoto= $('hRutaCompletaNuevoArchivoSubido').value;
            
            //                      alert('ruta completa:'+srcNuevaFoto);

            $('Div_fotoMaterialLaboratorio').innerHTML=
            '<p style="color: blue; font-weight: bold;"><img width="100" height="120" src=\"'+srcNuevaFoto.trim()+'\" alt=Nuevo title=Id Material border=0/></p>';
          
        //            $('divDerRegistroP').update(respuesta);
        }
    } )
}



////ADJUNTAR FOTO ACTO MEDICO -- ANGEL SAYES


function adjuntarFotoOdontograma(id){
    var autonumerico=id
    var patronModulo='adjuntarFotoOdontograma';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+autonumerico;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
            $('adjuntarFotoOdontograma'+id).update(respuesta);
        }
    } )
    
}



function subirFotoProcimientoDiente(autonumerico,obj, dname){
    var idHistoriaDiente = $('idAntecedenteOdontograma_'+autonumerico).value;
    var patronModulo='verificarCantidadVersionImagenXHistoriaDiente';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+idHistoriaDiente;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;         
            $('iVersion'+autonumerico).value=respuesta;
            $('idHistoriaDiente'+autonumerico).value=idHistoriaDiente;
            ruta=$('hdnRutaAngel').value;
            flag=$('hdnFlagAngel').value;
            http=createRequestObject();
            uploadDir=obj.value;
            idname=obj.name;
            dirname=dname;
            filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
            document.getElementById('loadingAngel'+idname).innerHTML="";
            uploaderId = 'uploaderAngel'+obj.name;
            uploader = obj.name;
            variable=document.getElementById('formNameAngel'+obj.name).submit();

            timeInterval=setInterval("traceUploadOdontograma('"+ruta+"',"+flag+","+autonumerico+","+respuesta+","+idHistoriaDiente+")", 1500);
        }
    } )
     
}


function traceUploadOdontograma(ruta,flag,autonumerico,version,idHistoriaDiente){
    pathRequestControlup='../actomedico/fileuploadActoMedico.php';

    patronModulo='traceUploadOdontograma';
    parametros='uploadDir='+uploadDir+'&dirname='+dirname+'&filename='+filename+'&uploader='+uploader;
    parametros+='&hdnRutax='+ruta;
    parametros+='&hdnFlagx='+flag;
    parametros+='&autonumerico='+autonumerico;
    parametros+='&version='+version;
    parametros+='&idHistoriaDiente='+idHistoriaDiente;
    
    new Ajax.Request(pathRequestControlup,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            respuesta = transport.responseText;
            $('Vista'+autonumerico).update(respuesta);
            $('adjuntarFotoOdontograma'+autonumerico).hide();
            $('button'+autonumerico).hide();
          grabarImagenHistoriaDiente(autonumerico);
        }
    } ) 

}


function grabarImagenHistoriaDiente(autonumerico){
    var idHistoriaDiente = $('idAntecedenteOdontograma_'+autonumerico).value;
    var url = $('url'+autonumerico).value;
    var width = $('width'+autonumerico).value;
    var height = $('height'+autonumerico).value;
    var version = $('version'+autonumerico).value;
    var patronModulo='grabarImagenHistoriaDiente';
    var parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+url;
    parametros+='&p3='+idHistoriaDiente;
    parametros+='&p4='+width;
    parametros+='&p5='+height;
    parametros+='&p6='+version;
    new Ajax.Request(pathRequestControl,{
        method : 'get',
        parameters : parametros,
        onLoading : micargador(1),
        onComplete : function(transport){
            micargador(0);
            var respuesta = transport.responseText;
        }
    } )
}
