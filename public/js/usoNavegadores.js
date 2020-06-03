document.addEventListener("DOMContentLoaded", function () {
    var canvasGrafica = document.getElementById("canvasGrafica");

    if (canvasGrafica) {
        var datos = JSON.parse(document.getElementById("datosNavegadores").innerHTML);
        var arrayNavegadores = [];
        var arrayUso = [];
        var arrayColores = [];
        
        for(let i = 0; i < datos.length; i++){
            arrayNavegadores.push(datos[i].navegador);
            arrayUso.push(datos[i].numUso);
            arrayColores.push(colorRGB());
        }
        
        var miGrafica = new Chart(canvasGrafica, {
            type: 'doughnut',
            data: {
                labels: arrayNavegadores,
                datasets: [{
                        label: 'Navegadores usados',
                        data: arrayUso,
                        backgroundColor: arrayColores,
                        borderColor: arrayColores,
                        borderWidth: 1
                    }]
            },
            options: {
                
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