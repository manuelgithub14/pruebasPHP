document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formLogin");

    if (miForm) {
        var miPassword = miForm.querySelector("input[type='password']");
        var miCorreo = miForm.querySelector("input[type='text']");
        var infoCorreo = document.getElementById("infoCorreo");
        var infoPassword = document.getElementById("infoPassword");

        miForm.addEventListener("submit", function (e) {
            if (!/^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(miCorreo.value)) {
                miCorreo.classList.remove("is-success");

                miCorreo.classList.add("is-danger");
                infoCorreo.textContent = "Correo inv\u00e1lido";
                infoCorreo.classList.add("is-danger");
            } else {
                miCorreo.classList.remove("is-danger");
                infoCorreo.textContent = "";
                infoCorreo.classList.remove("is-danger");

                miCorreo.classList.add("is-success");
            }

            if (miPassword.value === "") {
                miPassword.classList.remove("is-success");
                
                miPassword.classList.add("is-danger");
                infoPassword.textContent = "Contrase\u00f1a inv\u00e1lida";
                infoPassword.classList.add("is-danger");
            }else{
                miPassword.classList.remove("is-danger");
                infoPassword.textContent = "";
                infoPassword.classList.remove("is-danger");
                
                miPassword.classList.add("is-success");
            }

            if (miCorreo.classList.contains("is-danger") || miPassword.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});