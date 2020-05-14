document.addEventListener("DOMContentLoaded", function(){
    var btnGuardarUsuario = document.getElementById("btnGuardar");
    btnGuardarUsuario.addEventListener("click", comprobarSignup);
});

function comprobarSignup(){
    var miForm = document.getElementById("formSignup");
    var miPassword = miForm.querySelector("input[type='password']");
    var misInputsText = miForm.querySelectorAll("input[type='text']");
    var salida = true;
    var mensajeErrores = "";
    
    if(miPassword.value === ""){
        mensajeErrores += "<p>contraseña invalida.</p>";
    }
    
    for(let i = 0; i < misInputsText.length; i++){
        switch (misInputsText[i].name) {
            case "correo":
                salida = /^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(misInputsText[i].value);
                break;
            case "dni":
                salida = /^[0-9]{8}[a-z]{1}$/i.test(misInputsText[i].value);
                break;
            case "edad":
                (isNaN(misInputsText[i].value) || misInputsText[i].value === "") ? salida = false : salida = true;
                break;
        }
        if(!salida){
            mensajeErrores += "<p>" + misInputsText[i].name + " invalido.</p>";
        }
    }
    
    if(mensajeErrores !== ""){
        document.getElementById("errores").innerHTML = mensajeErrores;
    }else{
        miForm.submit();
    }
}