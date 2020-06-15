document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor
            .create(document.querySelector("#editor"), {
                language: 'es',
                placeholder: 'Describa su producto...',
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

    var miForm = document.getElementById("formProductos");

    if (miForm) {
        var miTitulo = miForm.querySelector("input[name='titulo']");
        var miReferencia = miForm.querySelector("input[name='referencia']");
        var miPrecio = miForm.querySelector("input[name='precio']");
        var miStock = miForm.querySelector("input[name='stock']");
        var miImagen = miForm.querySelector("input[type='file']");
        var infoTitulo = document.getElementById("infoTitulo");
        var infoDescripcion = document.getElementById("infoDescripcion");
        var infoReferencia = document.getElementById("infoReferencia");
        var infoPrecio = document.getElementById("infoPrecio");
        var infoStock = document.getElementById("infoStock");
        var infoImagen = document.getElementById("infoImagen");

        miForm.addEventListener("submit", function (e) {
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
            
            if (miReferencia.value === "") {
                miReferencia.classList.remove("is-success");

                miReferencia.classList.add("is-danger");
                infoReferencia.textContent = "La referencia no puede estar vac\u00eda";
                infoReferencia.classList.add("is-danger");
            } else {
                miReferencia.classList.remove("is-danger");
                infoReferencia.textContent = "";
                infoReferencia.classList.remove("is-danger");

                miReferencia.classList.add("is-success");
            }
            
            if (miPrecio.value === "" || isNaN(miPrecio.value)) {
                miPrecio.classList.remove("is-success");

                miPrecio.classList.add("is-danger");
                infoPrecio.textContent = "Precio incorrecto";
                infoPrecio.classList.add("is-danger");
            } else {
                miPrecio.classList.remove("is-danger");
                infoPrecio.textContent = "";
                infoPrecio.classList.remove("is-danger");

                miPrecio.classList.add("is-success");
            }
            
            if (miStock.value === "" || isNaN(miStock.value)) {
                miStock.classList.remove("is-success");

                miStock.classList.add("is-danger");
                infoStock.textContent = "Stock incorrecto";
                infoStock.classList.add("is-danger");
            } else {
                miStock.classList.remove("is-danger");
                infoStock.textContent = "";
                infoStock.classList.remove("is-danger");

                miStock.classList.add("is-success");
            }

            if (editor.getData() === "") {
                infoDescripcion.textContent = "La descripci\u00f3n no puede estar vac\u00eda";
                infoDescripcion.classList.add("is-danger");
            } else {
                infoDescripcion.textContent = "";
                infoDescripcion.classList.remove("is-danger");
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

            if (miTitulo.classList.contains("is-danger") || infoDescripcion.classList.contains("is-danger") || miImagen.classList.contains("is-danger")
                    || miReferencia.classList.contains("is-danger") || miPrecio.classList.contains("is-danger") || miStock.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }
});