var pathRequestControl = "../../ccontrol/control/control.php";

//function pruebaArbolito(){
//    
//    alert("joseCARLOS");
//    
////    pruebaArbolito();
//}

//divOpcCCostos



function CargarArboldeCentroCostos(){
   
    editarArea=0;
    idCadenaAreas="";

    var    parametros="p1=generaArbolCentroCostos";
   
    
    divMostrar=document.getElementById('divOpcCCostos');

    divMostrar.innerHTML = " ";
    treex=new dhtmlXTreeObject("divOpcCCostos","100%","100%",0);
    
    treex.setSkin('dhx_skyblue');
    treex.setImagePath("../../../../fastmedical_front/imagen/csh_bluebooks_simedh/");
    treex.attachEvent("onClick", function(){
        
        CargarlistadoPuestosXCentroCostos(treex.getSelectedItemId());
        seleccionarCentroCostoPuestoDelArbol(treex.getSelectedItemId());
        parametrosArbolInicializacion();
        cancelarGrabarDetallePuesto123();
        $('cell52').update('');
        
    } );
      
    treex.openAllItems(0);
   
    treex.loadXML(pathRequestControl+'?'+parametros);
  
}


function parametrosArbolInicializacion(){
      
    //muestra el div iddetallePuestosCCostos
    $('iddetallePuestosCCostos').show();
    
    //inicializar parametros al hacer click en el arbol;
    $("txtNombrePuesto").value='';//nombre del Puesto
    $("hNombreCentroCostoClickeado").value=treex.getSelectedItemText(); //guarda el nombre del Centro de Costo
    $("selectCategoriaPuestos").selectedIndex='0'; //selecciona la opcion "primera" del combo
    $("hIdCentroCosto").value=treex.getSelectedItemId(); //guarda el Id del centro de costo
    
    //estado
    document.getElementById("chkEstado").checked=false; 
    $("chkEstado").value=0;                             
        
    //$('fila5').hide(); //div donde se encuentra el boton guardar y cancelar, no es necesario
       
    var ActualizarTituloListaPuestosCCostos="<center><h1>Puestos del Centro de Costos:  "+treex.getSelectedItemText()+" </h1></center>";
       
    //carga el Titulo con el Nuevo Centro de Costos
    $('TituloListaPuestosDeCCostos').update(ActualizarTituloListaPuestosCCostos);
    
//document.getElementById("txtNombrePuesto").disabled=false;
    
}