document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formCambioPassword");

    if (miForm) {
        var passActual = document.getElementById("passActual").value;
        var passNuevo = document.getElementById("passNuevo").value;
        var passNuevoRep = document.getElementById("passNuevoRep").value;

        miForm.addEventListener("submit", function (e) {
            var mensajesErrores = "";
            
            if (passActual !== "" && passNuevo !== "" && passNuevoRep !== "") {
                if (passNuevo !== passNuevoRep) {
                    mensajesErrores += "<p>Las contrase&ntilde;as no coinciden.</p>";
                }
            } else {
                mensajesErrores += "<p>Las contrase&ntilde;as no pueden estar vac&iacute;as.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
});