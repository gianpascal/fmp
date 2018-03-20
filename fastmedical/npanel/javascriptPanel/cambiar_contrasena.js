
function validarNewPassword(){

    passwordNueva = $("nuevoPassword").value;
    if(passwordNueva==""){
        alert("Ingrese nueva contrase\xF1a");
        $("nuevoPassword").value="";
        $("nuevoPassword").focus();
    }
    else{
        if(passwordNueva.length<6){
            alert("Su nueva contrase\xF1a debe tener como m\xEDnimo 6 caracteres");
            $("nuevoPassword").value="";
            $("confPassword").value="";
            $("nuevoPassword").focus();
        }
        else{
            passwordConfirmada = $("confPassword").value;
            if(passwordConfirmada==""){
                alert("Confirme nueva contrase\xF1a");
                $("confPassword").value="";
                $("confPassword").focus();
            }
            else{
                if(passwordConfirmada!=passwordNueva){
                    alert("No coinciden las contrase\xF1as");
                    $("nuevoPassword").value="";
                    $("confPassword").value="";
                    $("nuevoPassword").focus();
                }
                else{
                    updatePassword();
                }
            }
        }
    }
//}
//}
}

function validarPassword(){
    var url = '../../ccontrol/control/control.php';
    var data = 'p1=validatePassword&' + $('mante_usuario').serialize();
    new Ajax.Request (url,
    {
        method     : 'get',
        parameters : data,
        //onLoading   : function(transport){est_cargador(1);},
        onComplete : function(transport){/*est_cargador(0);*/
            if(transport.responseText==0){
                alert("Contraseña incorrecta");
                $("antPassword").value="";
                $("antPassword").focus();
            }
            else{
                $("nuevoPassword").removeAttribute("readonly");
                //document.getElementById("txtobservacioncita").removeAttribute("readonly");
                $("confPassword").removeAttribute("readonly");
            }
        }
    }
    )
}

