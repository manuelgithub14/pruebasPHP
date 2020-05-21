document.addEventListener("DOMContentLoaded", function () {
    var miFormComentario = document.getElementById("formComentario");
    var miFormRespuesta = document.getElementById("formRespuestaComentario");
    var miFormRespuestaResp = document.getElementById("formRespuestaResp");

    if (miFormComentario) {
        miFormComentario.addEventListener("submit", function (e) {
            var miComentario = document.getElementById("textComentario");
            var infoComentario = document.getElementById("infoComentario");

            if (miComentario.value === "") {
                miComentario.classList.remove("is-success");

                miComentario.classList.add("is-danger");
                infoComentario.textContent = "No puedes comentar en blanco";
                infoComentario.classList.add("is-danger");
            }else{
                miComentario.classList.remove("is-danger");
                infoComentario.textContent = "";
                infoComentario.classList.remove("is-danger");

                miComentario.classList.add("is-success");
            }

            if (miComentario.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }

    if (miFormRespuesta) {
        miFormRespuesta.addEventListener("submit", function (e) {
            var miRespuesta = document.getElementById("textRespuesta");
            var infoRespuesta = document.getElementById("infoRespuesta");

            if (miRespuesta.value === "") {
                miRespuesta.classList.remove("is-success");

                miRespuesta.classList.add("is-danger");
                infoRespuesta.textContent = "No puedes responder en blanco";
                infoRespuesta.classList.add("is-danger");
            }else{
                miRespuesta.classList.remove("is-danger");
                infoRespuesta.textContent = "";
                infoRespuesta.classList.remove("is-danger");

                miRespuesta.classList.add("is-success");
            }

            if (miRespuesta.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
    
    if (miFormRespuestaResp) {
        miFormRespuestaResp.addEventListener("submit", function (e) {
            var miRespuestaResp = document.getElementById("textRespuestaResp");
            var infoRespuestaResp = document.getElementById("infoRespuestaResp");

            if (miRespuestaResp.value === "") {
                miRespuestaResp.classList.remove("is-success");

                miRespuestaResp.classList.add("is-danger");
                infoRespuestaResp.textContent = "No puedes responder en blanco";
                infoRespuestaResp.classList.add("is-danger");
            }else{
                miRespuestaResp.classList.remove("is-danger");
                infoRespuestaResp.textContent = "";
                infoRespuestaResp.classList.remove("is-danger");

                miRespuestaResp.classList.add("is-success");
            }

            if (miRespuestaResp.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});