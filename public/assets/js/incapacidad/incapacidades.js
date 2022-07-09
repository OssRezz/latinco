cargarTabla();

function modalTranscribir(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidades/create",
        type: "GET",
        data: { id: e.value },
        success: function (result) {
            $("#respuesta").html(result);

        },
    });
}

function modalEditar(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidades/" + e.value,
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}

function ingresarTranscripcion(buttonEvent) {
    const frmTranscripcion = document.querySelector('#frmTranscripcion');
    frmTranscripcion.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(frmTranscripcion);
        formData.append('id', buttonEvent.value);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "incapacidades",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                cargarTabla(result);
            },
        });

    });
}

function actualizarIncapacidad(buttonEvent) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidades/" + buttonEvent.value,
        type: "PUT",
        data: {
            tipo: $('#tipo').val(),
            numeroIncapacidad: $('#numeroIncapacidad').val(),
            fechaInicio: $('#fechaInicio').val(),
            fechaFin: $('#fechaFin').val(),
            totalDias: $('#totalDias').val(),
            diasEmpresa: $('#diasEmpresa').val(),
            diasEps: $('#diasEps').val(),
            quincenas_nomina: $('#quincenas_nomina').val(),
            prorroga: $('#prorroga').val(),
            incapacidad_prorroga: $('#incapacidad_prorroga').val(),
            estado: $('#estado').val(),

            fechaPago: $('#fechaPago').val(),
            valorRecuperado: $('#valorRecuperado').val(),
            valorPendiente: $('#valorPendiente').val(),
        },
        success: function (result) {
            cargarTabla(result);
        },
    });
}

function elimiarIncapacidad(e) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidades/" + e.value,
        type: "DELETE",
        success: function (result) {
            cargarTabla(result);
        },
    });
}


function cargarTabla(data) {
    const tableBody = document.querySelector('#tableBody');
    const spinner = document.querySelector('.spinner');
    const tableDiv = document.querySelector('#tableDiv');
    tableDiv.style.display = "none";
    spinner.style.display = "flex";

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidades/table",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(data);
            clean('#tableBody');
            tableBody.innerHTML = result;
            spinner.style.display = "none";
            tableDiv.style.display = "";
            cargarDataTable();
        },
    });
}
function cargarDataTable() {
    $("#tablaIncapacidad").dataTable().fnDestroy();
    const table = $("#tablaIncapacidad").DataTable({
        responsive: true,
        // order: [
        //     [0, "desc"],
        //     [1, "asc"],
        //     [4, "asc"],
        // ],
        language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
    });
    new $.fn.dataTable.FixedHeader(table);


}

function clean(deleteContent) {
    const aux = document.querySelector(deleteContent)
    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}
