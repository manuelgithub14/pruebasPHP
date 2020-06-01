document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formEditarUsuario");

    if (miForm) {

        miForm.addEventListener("submit", function (e) {
            var miFecha = document.getElementById("fecha");
            var infoFecha = document.getElementById("infoFecha");

            if (!validarFormatoFecha(miFecha.value) || !existeFecha(miFecha.value)) {
                miFecha.classList.remove("is-success");

                miFecha.classList.add("is-danger");
                infoFecha.textContent = "Error, introduzca su fecha de nacimiento";
                infoFecha.classList.add("is-danger");
            } else {
                miFecha.classList.remove("is-danger");
                infoFecha.textContent = "";
                infoFecha.classList.remove("is-danger");

                miFecha.classList.add("is-success");
            }

            if (miFecha.classList.contains("is-danger")) {
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