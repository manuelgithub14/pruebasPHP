document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formEditarUsuario");

    if (miForm) {
        var miCorreo = document.getElementById("correo");
        var miDni = document.getElementById("dni");
        var infoCorreo = document.getElementById("infoCorreo");
        var infoDni = document.getElementById("infoDni");

        miForm.addEventListener("submit", function (e) {
            var miEdad = document.getElementById("edad");
            var infoEdad = document.getElementById("infoEdad");

            // COMPROBAR CORREO Y DNI DEL SERVIDOR CON AJAX??
            if (miCorreo.value === document.getElementById("correo").value && miDni.value === document.getElementById("dni").value) {
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
            } else {
                miCorreo.classList.remove("is-success");
                
                miCorreo.classList.add("is-danger");
                infoCorreo.textContent = "No se puede modificar este dato";
                infoCorreo.classList.add("is-danger");

                miDni.classList.remove("is-success");
                
                miDni.classList.add("is-danger");
                infoDni.textContent = "No se puede modificar este dato";
                infoDni.classList.add("is-danger");
            }

            if (miCorreo.classList.contains("is-danger") || miDni.classList.contains("is-danger") || miEdad.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});