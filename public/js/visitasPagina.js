document.addEventListener("DOMContentLoaded", function () {
    var miForm = document.getElementById("formFechaVisitas");
    var canvasGrafica = document.getElementById("canvasGrafica");

    if (miForm) {
        miForm.addEventListener("submit", function (e) {
            var fechaIni = document.getElementById("fechaIni");
            var infoFechaIni = document.getElementById("infoFechaInicio");
            var fechaFin = document.getElementById("fechaFin");
            var infoFechaFin = document.getElementById("infoFechaFin");

            if (!validarFormatoFecha(fechaIni.value) || !existeFecha(fechaIni.value)) {
                fechaIni.classList.remove("is-success");
                fechaIni.classList.add("is-danger");
                infoFechaIni.textContent = "Error, introduzca una fecha";
                infoFechaIni.classList.add("is-danger");
            } else {
                fechaIni.classList.remove("is-danger");
                infoFechaIni.textContent = "";
                infoFechaIni.classList.remove("is-danger");
                fechaIni.classList.add("is-success");
            }

            if (!validarFormatoFecha(fechaFin.value) || !existeFecha(fechaFin.value)) {
                fechaFin.classList.remove("is-success");
                fechaFin.classList.add("is-danger");
                infoFechaFin.textContent = "Error, introduzca una fecha";
                infoFechaFin.classList.add("is-danger");
            } else {
                fechaFin.classList.remove("is-danger");
                infoFechaFin.textContent = "";
                infoFechaFin.classList.remove("is-danger");
                fechaFin.classList.add("is-success");
            }

            if (fechaIni.classList.contains("is-danger") || fechaFin.classList.contains("is-danger")) {
                e.preventDefault();
            }
        });
    }

    if (canvasGrafica) {
        var datos = JSON.parse(document.getElementById("datosPaginas").innerHTML);
        var datosFechas = JSON.parse(document.getElementById("datosFechas").innerHTML);
        var arrayNumVisitas = [];
        var arrayPaginas = [];
        var arrayColores = [];

        document.getElementById("fechaIni").value = datosFechas.inicio;
        document.getElementById("fechaFin").value = datosFechas.final;
        document.getElementById("canvasGrafica2").style.display = "none";

        for (let i = 0; i < datos.length; i++) {
            arrayNumVisitas.push(datos[i].numVisitas);
            arrayPaginas.push(datos[i].pagina);
            arrayColores.push(colorRGB());
        }

        var ctx = canvasGrafica.getContext("2d");
        var miGrafica = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrayPaginas,
                datasets: [{
                        label: 'Visitas',
                        data: arrayNumVisitas,
                        backgroundColor: arrayColores,
                        borderColor: arrayColores,
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                },
                onClick: function obtenerDatosParaAjax(e) {
                    var elementos = miGrafica.getElementsAtEvent(e);
                    if (elementos[0]) {
                        var datosGrafica = elementos[0]._chart.config.data;
                        var indice = elementos[0]._index;

                        var label = datosGrafica.labels[indice];
                        var valor = datosGrafica.datasets[0].data[indice];

                        obtenerFechasPaginaAjax(label, datosFechas.inicio, datosFechas.final);
                    }
                }
            }
        });
    }
});

function obtenerFechasPaginaAjax(pagina, fechaInicio, fechaFinal) {
    var xhttp = new XMLHttpRequest();
    var url = "/visitasPagina";

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var miArray = JSON.parse(this.responseText);
            var arrayNumVisitas = [];
            var arrayFechas = [];
            var arrayColores = [];

            for (let i = 0; i < miArray.length; i++) {
                arrayNumVisitas.push(miArray[i].numVisitas);
                arrayFechas.push(miArray[i].fecha);
                arrayColores.push(colorRGB());
            }

            document.getElementById("canvasGrafica").style.display = "none";
            var canvasGrafica2 = document.getElementById("canvasGrafica2");
            canvasGrafica2.style.display = "block";
            var ctx = canvasGrafica2.getContext("2d");
            var miGrafica = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: arrayFechas,
                    datasets: [{
                            label: 'Visitas a ' + pagina,
                            data: arrayNumVisitas,
                            backgroundColor: arrayColores,
                            borderColor: arrayColores,
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        }
    };

    xhttp.open("GET", url + "?pagina=" + pagina + "&fechaIni=" + fechaInicio + "&fechaFin=" + fechaFinal, true);
    xhttp.send();
}

function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function colorRGB() {
    var color = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + color;
}

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