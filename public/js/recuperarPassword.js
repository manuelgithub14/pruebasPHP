document.addEventListener("DOMContentLoaded", function () {
    var miFormRecuperar = document.getElementById("formRecuperarPass");
    var miFormCorreo = document.getElementById("formCorreo");

    if (miFormRecuperar) {
        miFormRecuperar.addEventListener("submit", function (e) {
            var passNuevo = document.getElementById("passNuevo");
            var passNuevoRep = document.getElementById("passNuevoRep");
            var infoPassNuevo = document.getElementById("infoPasswordNuevo");
            var infoPassNuevoRep = document.getElementById("infoPasswordNuevoRep");

            if (passNuevo.value === "" && passNuevoRep.value === "" || passNuevo.value !== passNuevoRep.value) {
                passNuevo.classList.remove("is-success");
                passNuevo.classList.add("is-danger");
                infoPassNuevo.textContent = "Las contrase\u00f1as no coinciden o est\u00e1n vac\u00edas";
                infoPassNuevo.classList.add("is-danger");

                passNuevoRep.classList.remove("is-success");
                passNuevoRep.classList.add("is-danger");
                infoPassNuevoRep.textContent = "Las contrase\u00f1as no coinciden o est\u00e1n vac\u00edas";
                infoPassNuevoRep.classList.add("is-danger");
            } else {
                passNuevo.classList.remove("is-danger");
                passNuevo.classList.add("is-success");
                infoPassNuevo.textContent = "";
                infoPassNuevo.classList.remove("is-danger");

                passNuevoRep.classList.remove("is-danger");
                passNuevoRep.classList.add("is-success");
                infoPassNuevoRep.textContent = "";
                infoPassNuevoRep.classList.remove("is-danger");
            }

            if (passNuevo.classList.contains("is-danger") || passNuevoRep.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }

    if (miFormCorreo) {
        miFormCorreo.addEventListener("submit", function (e) {
            var miCorreo = document.getElementById("correo");
            var infoCorreo = document.getElementById("infoCorreo");

            if (miCorreo.value === "" || !/^[a-z][\w\.]*@[\w\.]+\.[a-z]{2,3}/i.test(miCorreo.value)) {
                miCorreo.classList.remove("is-success");

                miCorreo.classList.add("is-danger");
                infoCorreo.textContent = "Introduce un correo";
                infoCorreo.classList.add("is-danger");
            } else {
                miCorreo.classList.remove("is-danger");
                infoCorreo.textContent = "";
                infoCorreo.classList.remove("is-danger");

                miCorreo.classList.add("is-success");
            }

            if (miCorreo.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});