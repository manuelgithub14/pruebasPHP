document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formCambioPassword");

    if (miForm) {
        var passActual = document.getElementById("passActual");
        var passNuevo = document.getElementById("passNuevo");
        var passNuevoRep = document.getElementById("passNuevoRep");
        var infoPassAntiguo = document.getElementById("infoPassAntiguo");
        var infoPassNuevo = document.getElementById("infoPassNuevo");
        var infoPassNuevoRep = document.getElementById("infoPassNuevoRep");

        miForm.addEventListener("submit", function (e) {
            if (passActual.value !== "" && passNuevo.value !== "" && passNuevoRep.value !== "") {
                passActual.classList.remove("is-danger");
                passActual.classList.add("is-success");
                infoPassAntiguo.textContent = "";
                infoPassAntiguo.classList.remove("is-danger");

                if (passNuevo.value !== passNuevoRep.value) {
                    passNuevo.classList.remove("is-success");
                    passNuevo.classList.add("is-danger");
                    infoPassNuevo.textContent = "Las contrase\u00f1as no coinciden";
                    infoPassNuevo.classList.add("is-danger");

                    passNuevoRep.classList.remove("is-success");
                    passNuevoRep.classList.add("is-danger");
                    infoPassNuevoRep.textContent = "Las contrase\u00f1as no coinciden";
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
            } else {
                passActual.classList.remove("is-success");
                passActual.classList.add("is-danger");
                infoPassAntiguo.textContent = "Las contrase\u00f1as est\u00e1n vac\u00edas";
                infoPassAntiguo.classList.add("is-danger");

                passNuevo.classList.remove("is-success");
                passNuevo.classList.add("is-danger");
                infoPassNuevo.textContent = "Las contrase\u00f1as est\u00e1n vac\u00edas";
                infoPassNuevo.classList.add("is-danger");

                passNuevoRep.classList.remove("is-success");
                passNuevoRep.classList.add("is-danger");
                infoPassNuevoRep.textContent = "Las contrase\u00f1as est\u00e1n vac\u00edas";
                infoPassNuevoRep.classList.add("is-danger");
            }

            if (passActual.classList.contains("is-danger") || passNuevo.classList.contains("is-danger") 
                    || passNuevoRep.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});