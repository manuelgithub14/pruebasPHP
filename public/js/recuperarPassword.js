document.addEventListener("DOMContentLoaded", function () {
    var miFormRecuperar = document.getElementById("formRecuperarPass");
    var miFormCorreo = document.getElementById("formCorreo");

    if (miFormRecuperar) {
        miFormRecuperar.addEventListener("submit", function (e) {
            var passNuevo = document.getElementById("passNuevo").value;
            var passNuevoRep = document.getElementById("passNuevoRep").value;
            var mensajesErrores = "";

            if (passNuevo !== "" && passNuevoRep !== "") {
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

    if (miFormCorreo) {
        miFormCorreo.addEventListener("submit", function (e) {
            var miCorreo = document.getElementById("correo").value;
            var mensajesErrores = "";

            if (miCorreo === "") {
                mensajesErrores += "<p>Introduce un correo.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
});