document.addEventListener("DOMContentLoaded", function(){
    var btnLogin = document.getElementById("btnSubmitLogin");
    btnLogin.addEventListener("click", comprobarLogin);
});

function comprobarLogin(){
    var miForm = document.getElementById("formLogin");
    var miPassword = miForm.querySelector("input[type='password']");
    var miCorreo = miForm.querySelector("input[type='text']");
    var mensajesErrores = "";
    
    if(!/^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(miCorreo.value)){
        mensajesErrores += "<p>Correo inválido.</p>";
    }
    if(miPassword.value === ""){
        mensajesErrores += "<p>Contraseña inválida.</p>";
    }
    
    if(mensajesErrores !== ""){
        document.getElementById("errores").innerHTML = mensajesErrores;
    }else{
        miForm.submit();
    }
}