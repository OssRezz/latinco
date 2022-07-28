const chartDonaEps = document.getElementById("myChart").getContext("2d");
const chartLine = document.getElementById("myChart2");
const chartDonaCo = document.getElementById("chartCo");
const fechaInicio = document.querySelector("#fechaInicio");
const fechaFin = document.querySelector("#fechaFin");
const reporte = document.querySelector("#reporteSelect");
const descargar = document.querySelector("#btn-descargar");

let labelDona = [];
let dataInfoDona = [];
let labelDonaCo = [];
let dataInfoDonaCo = [];
let labelsLineRecuperado = [];
let dataLineRecuperado = [];
let dataLinePorRecuperar = [];

cargarDona();
cargarLinea();
permitirDescarga();
cargarDonaCo();

fechaInicio.addEventListener("change", permitirDescarga);
fechaFin.addEventListener("change", permitirDescarga);
reporte.addEventListener("change", permitirDescarga);

function permitirDescarga() {
    descargar.setAttribute("disabled", "disabled");
    if (
        fechaInicio.value != "" &&
        fechaFin.value != "" &&
        reporte.value != ""
    ) {
        descargar.removeAttribute("disabled");
    }
}

const dataDona = {
    labels: labelDona,
    datasets: [
        {
            label: "# Entidad que mas debe",
            data: dataInfoDona,
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
            borderRadius: 10,
            offset: 10,
            hoverOffset: 30,
        },
    ],
};

const configDona = {
    type: "doughnut",
    data: dataDona,
    options: {
        responsive: true,
        cutout: "70%",
        layout: {
            padding: 25,
        },
    },
};

const dataDonaCo = {
    labels: labelDonaCo,
    datasets: [
        {
            label: "# Entidad que mas debe",
            data: dataInfoDonaCo,
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
            borderRadius: 10,
            offset: 10,
            hoverOffset: 30,
        },
    ],
};

const configDonaCo = {
    type: "doughnut",
    data: dataDonaCo,
    options: {
        responsive: true,
        cutout: "70%",
        layout: {
            padding: 25,
        },
    },
};

const dataLinea = {
    labels: labelsLineRecuperado,
    datasets: [
        {
            label: "Recuperado",
            data: dataLineRecuperado,
            borderColor: "rgba(75, 192, 192, 0.2)",
            backgroundColor: "rgba(75, 192, 192, 1)",
            borderWidth: 7,
            pointRadius: 10,
            pointHoverRadius: 16,
        },
        {
            label: "Por recuperar",
            data: dataLinePorRecuperar,
            borderColor: "rgba(255, 99, 132, 0.2)",
            backgroundColor: "rgba(255, 99, 132, 1)",
            borderWidth: 7,
            pointRadius: 10,
            pointHoverRadius: 16,
        },
    ],
};

const configLinea = {
    type: "line",
    data: dataLinea,
    options: {
        tension: 0.45,
        responsive: true,
    },
};

function cargarDona() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/dona",
        type: "GET",
        success: function (result) {
            result.forEach((element) => {
                const { eps, total } = element;
                labelDona.push(eps);
                dataInfoDona.push(total);
            });
            const chartDonaEPS = new Chart(chartDonaEps, configDona);
        },
    });
}

function cargarDonaCo() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/donaCo",
        type: "GET",
        success: function (result) {
            result.forEach((element) => {
                const { nombre, total } = element;
                labelDonaCo.push(nombre);
                dataInfoDonaCo.push(total);
            });
            const chartDonaCO = new Chart(chartDonaCo, configDonaCo);
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
            result.forEach((element) => {
                const { mes, valorRecuperado, valor_pendiente } = element;

                labelsLineRecuperado.push("mes " + mes);
                dataLineRecuperado.push(valorRecuperado ? valorRecuperado : 0);
                dataLinePorRecuperar.push(valor_pendiente);
            });
            const stackedLine = new Chart(chartLine, configLinea);
        },
    });
}

function tutela(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/tutela",
        type: "GET",
        success: function (result) {
            e.removeAttribute("disabled");
            $("#respuesta").html(result);
        },
    });
}

function prorroga(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/prorroga",
        type: "GET",
        success: function (result) {
            e.removeAttribute("disabled");
            $("#respuesta").html(result);
        },
    });
}

function pensiones(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/pensiones",
        type: "GET",
        success: function (result) {
            e.removeAttribute("disabled");
            $("#respuesta").html(result);
        },
    });
}

function actualizarTutela(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/tutela/actualizar",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}
function actualizarEstadoTutela(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/tutela/actualizarEstadoTutela",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            e.removeAttribute("disabled");
            // $("#respuesta").html(result);
        },
    });
}

function actualizarProrroga(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/prorroga/actualizar",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}
function actualizarEstadoProrroga(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/prorroga/actualizarEstadoProrroga",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            e.removeAttribute("disabled");
        },
    });
}

function actualizarFondo(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/fondo/actualizar",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}
function actualizarEstadoFondo(e) {
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportesincapacidad/fondo/actualizarFondoPension",
        type: "POST",
        data: { id: e.value },
        success: function (result) {
            e.removeAttribute("disabled");
        },
    });
}
