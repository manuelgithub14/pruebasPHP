document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formSignup");

    if (miForm) {
        var miPassword = miForm.querySelector("input[type='password']");
        var misInputsText = miForm.querySelectorAll("input[type='text']");
        var salida = true;

        miForm.addEventListener("submit", function (e) {
            var mensajeErrores = "";
            
            if (miPassword.value === "") {
                mensajeErrores += "<p>Contrase&ntilde;a inv&aacute;lida.</p>";
            }

            for (let i = 0; i < misInputsText.length; i++) {
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
                if (!salida) {
                    mensajeErrores += "<p>" + misInputsText[i].name + " inv&aacute;lido.</p>";
                }
            }

            if (mensajeErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajeErrores;
            }
        });
    }
});