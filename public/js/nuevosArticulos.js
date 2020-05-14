document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor
            .create(document.querySelector("#editor"), {
                language: 'es',
                placeholder: 'Escriba su artículo...',
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [
                        {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                        {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'}
                    ]
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

    var btnCrearArticulo = document.getElementById("btnCrearArticulo");
    btnCrearArticulo.addEventListener("click", comprobarArticulos);
});

function comprobarArticulos() {
    var miForm = document.getElementById("formArticulos");
    var misInputsText = miForm.querySelectorAll("input[type='text']");
    var miImagen = miForm.querySelector("input[type='file']");
    var mensajesErrores = "";

    for (let i = 0; i < misInputsText.length; i++) {
        if (misInputsText[i].value === "") {
            mensajesErrores += "<p>" + misInputsText[i].name + " no puede estar vacío.</p>";
        }
    }

    if (miImagen.value === "") {
        mensajesErrores += "<p>" + miImagen.name + " no puede estar vacío.</p>";
    }

    if (mensajesErrores !== "") {
        document.getElementById("errores").innerHTML = mensajesErrores;
    } else {
        miForm.submit();
    }
}