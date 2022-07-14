const chartDonaf = document.getElementById('myChart').getContext("2d");;
const chartLine = document.getElementById('myChart2');
let labelDona = [];
let dataInfoDona = [];
let labelsLineRecuperado = [];
let dataLineRecuperado = [];
let dataLinePorRecuperar = [];

const dataDona = {
    labels: labelDona,
    datasets: [{
        label: '# Entidad que mas debe',
        data: dataInfoDona,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1,
        borderRadius: 15,
        offset: 10,
        hoverOffset: 30,
    }]
}

const configDona = {
    type: 'doughnut',
    data: dataDona,
    options: {
        responsive: true,
        cutout: '70%',
        layout: {
            padding: 25,
        }
    }
}

const dataLinea = {
    labels: labelsLineRecuperado,
    datasets: [{
        label: 'Recuperado',
        data: dataLineRecuperado,
        borderColor: 'rgba(75, 192, 192, 0.2)',
        backgroundColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 7,
        pointRadius: 10,
        pointHoverRadius: 16,
    },
    {
        label: 'Por recuperar',
        data: dataLinePorRecuperar,
        borderColor: 'rgba(255, 99, 132, 0.2)',
        backgroundColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 7,
        pointRadius: 10,
        pointHoverRadius: 16,
    },
    ]
}

const configLinea = {
    type: 'line',
    data: dataLinea,
    options: {
        tension: 0.45,
        responsive: true,
    },
}




cargarDona();
cargarLinea();

function cargarDona() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/dona",
        type: "GET",
        success: function (result) {
            result.forEach(element => {
                const { eps, total } = element;
                labelDona.push(eps);
                dataInfoDona.push(total);
            });
            const myChart = new Chart(chartDonaf, configDona);


        },
    });
}
function cargarLinea() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/linea",
        type: "GET",
        success: function (result) {
            console.log(result);
            result.forEach(element => {
                const { mes, valorRecuperado, valor_pendiente } = element;

                labelsLineRecuperado.push("mes " + mes);
                dataLineRecuperado.push(valorRecuperado ? valorRecuperado : 0);
                dataLinePorRecuperar.push(valor_pendiente);
            });
            const stackedLine = new Chart(chartLine, configLinea);
            console.log(labelsLineRecuperado);
            console.log(dataLineRecuperado);
            console.log(dataLinePorRecuperar);


        },
    });
}


function tutela(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/tutela",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);

        },
    });
}

function prorroga(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/prorroga",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);

        },
    });
}