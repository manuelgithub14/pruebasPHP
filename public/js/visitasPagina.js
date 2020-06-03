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

        for (let i = 0; i < datos.length; i++) {
            arrayNumVisitas.push(datos[i].numVisitas);
            arrayPaginas.push(datos[i].pagina);
            arrayColores.push(colorRGB());
        }

        var miGrafica = new Chart(canvasGrafica, {
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
                }
            }
        });
    }
});

function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function colorRGB() {
    var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + coolor;
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