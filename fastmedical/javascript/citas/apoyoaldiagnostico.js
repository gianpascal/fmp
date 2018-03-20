function cargarventanaProgramacionTemporal(fecha,codigoservicio){
    vformname='programacionTemporal';
    vtitle='ProgramacionTemporal';
    vwidth='800'
    vheight='650'
    vcenter='t'
    vresizable=''
    vmodal='false'
    vstyle=''
    vopacity=''
    vposx1=''
    vposx2=''
    vposy1=''
    vposy2=''
    patronModulo='mostrartablaprogramacionTemporal';
    parametros='';
    parametros+='p1='+patronModulo;
    parametros+='&p2='+fecha;
    parametros+='&p3='+codigoservicio;
    posFuncion='';
    CargarVentanaPopPap(vformname,vtitle,vwidth,vheight,vcenter,vresizable,vmodal,vstyle,vopacity,vposx1,vposx2,vposy1,vposy2,parametros,posFuncion)    
}
function programacionTemporal(){
    fecha = $('hFecha').value;
    codigoservicio = $('hServicio').value.split("|")[0];
    if(fecha == ''){
        window.alert('Seleccione Fecha')
        return;
    } 
    if(codigoservicio == ''){
        window.alert('Seleccione Servicio')
        return;
    }    
    cargarventanaProgramacionTemporal(fecha,codigoservicio);    
}

