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
function traceUpload(hdnCodPerx,hdnRutax,hdnNumx) {
   http.onreadystatechange = handleResponse;
   http.open("GET", '../admision/imageupload.php?uploadDir='+uploadDir+'&dirname='+dirname+'&filename='+filename+'&uploader='+uploader+'&hdnCodPerx='+hdnCodPerx+'&hdnRutax='+hdnRutax+'&hdnNumx='+hdnNumx);
   http.send(null);   
}
function handleResponse() {
	if(http.readyState == 4){
		var response=http.responseText; 
		if(response.indexOf("File uploaded") != -1){
			clearInterval(timeInterval);
			//document.getElementById('loading'+idname).innerHTML="";
		}
        document.getElementById(uploaderId).innerHTML=response;
		document.getElementById('foto').innerHTML=response;
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
function uploadFile(obj, dname) {
    /*Inicializando variables*/
    hdnCodPerx=$('hdnCodPer').value;
    hdnRutax=$('hdnRuta').value;
    hdnNumx=$('hdnNum').value;
    http=createRequestObject();
    uploadDir=obj.value;
    idname=obj.name;
    dirname=dname;
    filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
    document.getElementById('loading'+idname).innerHTML="";
    uploaderId = 'uploader'+obj.name;
    uploader = obj.name;
    document.getElementById('txtFotografia').value=filename;
    document.getElementById('formName'+obj.name).submit();
    //setInterval se ejecutar� una y otra vez en intervalos de x segundos,
    traceUpload(hdnCodPerx,hdnRutax,hdnNumx);
//    timeInterval=setInterval("traceUpload()", 1500);

}
