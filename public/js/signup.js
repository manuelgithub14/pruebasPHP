document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formSignup");

    if (miForm) {
        var miPassword = miForm.querySelector("input[type='password']");
        var miFecha = miForm.querySelector("input[type='date']");
        var misInputsText = miForm.querySelectorAll("input[type='text']");
        var infoCorreo = document.getElementById("infoCorreo");
        var infoPassword = document.getElementById("infoPassword");
        var infoDni = document.getElementById("infoDni");
        var infoFecha = document.getElementById("infoFecha");
        var correoContieneDanger = "";
        var dniContieneDanger = "";

        miForm.addEventListener("submit", function (e) {
            if (miPassword.value === "") {
                miPassword.classList.remove("is-success");

                miPassword.classList.add("is-danger");
                infoPassword.textContent = "Contrase\u00f1a inv\u00e1lida";
                infoPassword.classList.add("is-danger");
            } else {
                miPassword.classList.remove("is-danger");
                infoPassword.textContent = "";
                infoPassword.classList.remove("is-danger");

                miPassword.classList.add("is-success");
            }

            if (!validarFormatoFecha(miFecha.value) || !existeFecha(miFecha.value)) {
                miFecha.classList.remove("is-success");

                miFecha.classList.add("is-danger");
                infoFecha.textContent = "Fecha inv\u00e1lida";
                infoFecha.classList.add("is-danger");
            } else {
                miFecha.classList.remove("is-danger");
                infoFecha.textContent = "";
                infoFecha.classList.remove("is-danger");

                miFecha.classList.add("is-success");
            }

            for (let i = 0; i < misInputsText.length; i++) {
                switch (misInputsText[i].name) {
                    case "correo":
                        if (/^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(misInputsText[i].value)) {
                            misInputsText[i].classList.remove("is-danger");
                            infoCorreo.textContent = "";
                            infoCorreo.classList.remove("is-danger");

                            misInputsText[i].classList.add("is-success");
                            correoContieneDanger = false;
                        } else {
                            misInputsText[i].classList.remove("is-success");

                            misInputsText[i].classList.add("is-danger");
                            infoCorreo.textContent = "Correo inv\u00e1lido";
                            infoCorreo.classList.add("is-danger");
                            correoContieneDanger = true;
                        }
                        break;
                    case "dni":
                        if (/^[0-9]{8}[a-z]{1}$/i.test(misInputsText[i].value)) {
                            misInputsText[i].classList.remove("is-danger");
                            infoDni.textContent = "";
                            infoDni.classList.remove("is-danger");

                            misInputsText[i].classList.add("is-success");
                            dniContieneDanger = false;
                        } else {
                            misInputsText[i].classList.remove("is-success");

                            misInputsText[i].classList.add("is-danger");
                            infoDni.textContent = "DNI inv\u00e1lido";
                            infoDni.classList.add("is-danger");
                            dniContieneDanger = true;
                        }
                        break;
                }
            }

            if (correoContieneDanger || miPassword.classList.contains("is-danger") ||
                    dniContieneDanger || miFecha.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});

function validarFormatoFecha(campo) {
    var RegExPattern = /^\d{2,4}-\d{1,2}-\d{1,2}$/;
    if ((campo.match(RegExPattern)) && (campo !== '')) {
        return true;
    } else {
        return false;
    }
}

function existeFecha(fecha) {
    var fechaf = fecha.split("-");
    var d = fechaf[2];
    var m = fechaf[1];
    var y = fechaf[0];
    return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}