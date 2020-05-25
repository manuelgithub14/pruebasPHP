document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formEditarUsuario");

    if (miForm) {

        miForm.addEventListener("submit", function (e) {
            var miEdad = document.getElementById("edad");
            var infoEdad = document.getElementById("infoEdad");

            if (miEdad.value === "" || isNaN(miEdad.value)) {
                miEdad.classList.remove("is-success");

                miEdad.classList.add("is-danger");
                infoEdad.textContent = "Error, introduzca su edad";
                infoEdad.classList.add("is-danger");
            } else {
                miEdad.classList.remove("is-danger");
                infoEdad.textContent = "";
                infoEdad.classList.remove("is-danger");

                miEdad.classList.add("is-success");
            }

            if (miEdad.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});