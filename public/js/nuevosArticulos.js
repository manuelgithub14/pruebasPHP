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
        var miFecha = miForm.querySelector("input[type='date']");
        var infoTitulo = document.getElementById("infoTitulo");
        var infoTexto = document.getElementById("infoTexto");
        var infoImagen = document.getElementById("infoImagen");

        miForm.addEventListener("submit", function (e) {
            miFecha.classList.add("is-success");
            
            if (miTitulo.value === "") {
                miTitulo.classList.remove("is-success");

                miTitulo.classList.add("is-danger");
                infoTitulo.textContent = "El t\u00edtulo no puede estar vac\u00edo";
                infoTitulo.classList.add("is-danger");
            } else {
                miTitulo.classList.remove("is-danger");
                infoTitulo.textContent = "";
                infoTitulo.classList.remove("is-danger");

                miTitulo.classList.add("is-success");
            }

            if (editor.getData() === "") {
                infoTexto.textContent = "El texto no puede estar vac\u00edo";
                infoTexto.classList.add("is-danger");
            } else {
                infoTexto.textContent = "";
                infoTexto.classList.remove("is-danger");
            }

            if (miImagen.value === "") {
                miImagen.classList.remove("is-success");

                miImagen.classList.add("is-danger");
                infoImagen.textContent = "La imagen no puede estar vac\u00eda";
                infoImagen.classList.add("is-danger");
            } else {
                miImagen.classList.remove("is-danger");
                infoImagen.textContent = "";
                infoImagen.classList.remove("is-danger");

                miImagen.classList.add("is-success");
            }

            if (miTitulo.classList.contains("is-danger") || infoTexto.classList.contains("is-danger") || miImagen.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});