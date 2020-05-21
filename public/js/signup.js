document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formSignup");

    if (miForm) {
        var miPassword = miForm.querySelector("input[type='password']");
        var misInputsText = miForm.querySelectorAll("input[type='text']");
        var infoCorreo = document.getElementById("infoCorreo");
        var infoPassword = document.getElementById("infoPassword");
        var infoDni = document.getElementById("infoDni");
        var infoEdad = document.getElementById("infoEdad");
        var correoContieneDanger = "";
        var dniContieneDanger = "";
        var edadContieneDanger = "";

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
                    case "edad":
                        if (isNaN(misInputsText[i].value) || misInputsText[i].value === "") {
                            misInputsText[i].classList.remove("is-success");

                            misInputsText[i].classList.add("is-danger");
                            infoEdad.textContent = "Edad inv\u00e1lida";
                            infoEdad.classList.add("is-danger");
                            edadContieneDanger = true;
                        } else {
                            misInputsText[i].classList.remove("is-danger");
                            infoEdad.textContent = "";
                            infoEdad.classList.remove("is-danger");

                            misInputsText[i].classList.add("is-success");
                            edadContieneDanger = false;
                        }
                        break;
                }
            }

            if (correoContieneDanger || miPassword.classList.contains("is-danger") || 
                    dniContieneDanger || edadContieneDanger ) {
                e.preventDefault();
            }
        });
    }
});