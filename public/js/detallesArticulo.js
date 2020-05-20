document.addEventListener("DOMContentLoaded", function () {
    var miFormComentario = document.getElementById("formComentario");
    var miFormRespuesta = document.getElementById("formRespuestaComentario");
    var miFormRespuestaResp = document.getElementById("formRespuestaResp");

    if (miFormComentario) {
        miFormComentario.addEventListener("submit", function (e) {
            var miComentario = document.getElementById("textComentario").value;
            var mensajesErrores = "";

            if (miComentario === "") {
                mensajesErrores += "<p>No puedes comentar en blanco.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }

    if (miFormRespuesta) {
        miFormRespuesta.addEventListener("submit", function (e) {
            var miRespuesta = document.getElementById("textRespuesta").value;
            var mensajesErrores = "";

            if (miRespuesta === "") {
                mensajesErrores += "<p>No puedes responder en blanco.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
    
    if (miFormRespuestaResp) {
        miFormRespuestaResp.addEventListener("submit", function (e) {
            var miRespuestaResp = document.getElementById("textRespuestaResp").value;
            var mensajesErrores = "";

            if (miRespuestaResp === "") {
                mensajesErrores += "<p>No puedes responder en blanco.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
});