document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formLogin");

    if (miForm) {
        var miPassword = miForm.querySelector("input[type='password']");
        var miCorreo = miForm.querySelector("input[type='text']");
        

        miForm.addEventListener("submit", function (e) {
            var mensajesErrores = "";
            if (!/^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(miCorreo.value)) {
                mensajesErrores += "<p>Correo inv&aacute;lido.</p>";
            }
            if (miPassword.value === "") {
                mensajesErrores += "<p>Contrase&ntilde;a inv&aacute;lida.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            } 
        });
    }
});