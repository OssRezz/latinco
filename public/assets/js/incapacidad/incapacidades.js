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
                $("#respuesta").html(result);
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
            fechaInicio: $('#fechaInicio').val(),
            fechaFin: $('#fechaFin').val(),
            totalDias: $('#totalDias').val(),
            diasEmpresa: $('#diasEmpresa').val(),
            diasEps: $('#diasEps').val(),
            prorroga: $('#prorroga').val(),
            fechaTranscripcion: $('#fechaTranscripcion').val(),
            numeroIncapacidad: $('#numeroIncapacidad').val(),
            fechaPago: $('#fechaPago').val(),
            quincenasNomina: $('#quincenasNomina').val(),
            valorRecuperado: $('#valorRecuperado').val(),
            valorPendiente: $('#valorPendiente').val(),
            estado: $('#estado').val(),
        },
        success: function (result) {
            $("#respuesta").html(result);
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
            $("#respuesta").html(result);

        },
    });
}

