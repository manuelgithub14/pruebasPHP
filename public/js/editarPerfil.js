document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formEditarUsuario");

    if (miForm) {
        var miCorreo = document.getElementById("correo").value;
        var miDni = document.getElementById("dni").value;
        
        miForm.addEventListener("submit", function (e) {
            var mensajesErrores = "";
            var miEdad = document.getElementById("edad").value;
            
            if(miCorreo === document.getElementById("correo").value && miDni === document.getElementById("dni").value){
                if(miEdad === "" || isNaN(miEdad)){
                    mensajesErrores += "<p>Error, introduzca su edad.</p>";
                }
            }else{
                mensajesErrores += "<p>No se puede modificar estos datos.</p>";
            }
            
            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
});