document.addEventListener("DOMContentLoaded", function(){
    var btnCambiarPass = document.getElementById("btnCambiarPass");
    btnCambiarPass.addEventListener("click", comprobarCambioPassword);
});

function comprobarCambioPassword(){
    var miForm = document.getElementById("formCambioPassword");
    var passActual = document.getElementById("passActual").value;
    var passNuevo = document.getElementById("passNuevo").value;
    var passNuevoRep = document.getElementById("passNuevoRep").value;
    var mensajesErrores = "";
    
    if(passActual !== "" && passNuevo !== "" && passNuevoRep !== ""){
        if(passNuevo !== passNuevoRep){
            mensajesErrores += "<p>Las contraseñas no coinciden.</p>";
        }
    }else{
        mensajesErrores += "<p>Las contraseñas no pueden estar vacias.</p>";
    }
    
    if(mensajesErrores !== ""){
        document.getElementById("errores").innerHTML = mensajesErrores;
    }else{
        miForm.submit();
    }
}

