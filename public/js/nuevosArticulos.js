document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor
            .create(document.querySelector("#editor"), {
                language: 'es',
                placeholder: 'Escriba su art\u00edculo...',
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [
                        {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                        {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'}
                    ]
                }
            })
            .then(nuevoEditor => {
                editor = nuevoEditor;
            })
            .catch(error => {
                console.error(error);
            });
     
    var miForm = document.getElementById("formArticulos");

    if (miForm) {
        var miTitulo = miForm.querySelector("input[type='text']");
        var miImagen = miForm.querySelector("input[type='file']");

        miForm.addEventListener("submit", function (e) {
            var mensajesErrores = "";
            
            if(miTitulo.value === ""){
                mensajesErrores += "<p>El t&iacute;tulo no puede estar vac&iacute;o.</p>";
            }
            
            if (editor.getData() === "") {
                mensajesErrores += "<p>El texto no puede estar vac&iacute;o.</p>";
            }

            if (miImagen.value === "") {
                mensajesErrores += "<p>La imagen no puede estar vac&iacute;a.</p>";
            }

            if (mensajesErrores !== "") {
                e.preventDefault();
                document.getElementById("errores").innerHTML = mensajesErrores;
            }
        });
    }
});