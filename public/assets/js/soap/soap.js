function probarConexion(e) {
    loading();
    resetConsulta();
    resetSchema();
    const btnConexion = document.querySelector('#btnConexion');
    const conexionIcon = document.querySelector('#conexionIcon');
    const password = document.querySelector('#password').value;

    conexionIcon.classList.remove("fas", "fa-wifi");
    btnConexion.classList.remove("btn-outline-danger");

    conexionIcon.classList.add("fas", "fa-spinner");
    btnConexion.classList.add("btn-outline-primary");

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/conexion",
        type: "POST",
        data: { password: password },
        success: function (result) {
            clean('#response');
            $("#response").html(result);
            btnConexion.classList.remove("btn-outline-primary");
            btnConexion.classList.add("btn-outline-success");
            conexionIcon.classList.add("fas", "fa-wifi");
        },
    });
}

function probarConsulta(e) {
    loading()
    resetConexion();
    resetSchema();
    const btnConsulta = document.querySelector('#consulta');
    const consultaIcon = document.querySelector('#consultaIcon');
    const password = document.querySelector('#password').value;

    btnConsulta.classList.remove("btn-outline-danger");
    consultaIcon.classList.remove("fas", "fa-circle");
    consultaIcon.classList.remove("text-latinco");

    consultaIcon.classList.add("fas", "fa-spinner");
    consultaIcon.classList.add("text-primary");
    btnConsulta.classList.add("btn-outline-primary");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/consulta",
        type: "POST",
        data: { password: password },
        success: function (result) {
            clean('#response');
            $("#response").html(result);
            consultaIcon.classList.remove("fas", "fa-spinner");
            consultaIcon.classList.remove("text-primary");
            btnConsulta.classList.remove("btn-outline-primary");

            consultaIcon.classList.add("fas", "fa-circle");
            consultaIcon.classList.add("text-success");
            btnConsulta.classList.add("btn-outline-success");
        },
    });
}


function probarSchema() {
    loading()
    resetConsulta();
    resetConexion();
    const btnSchema = document.querySelector('#consultaSchema');
    const schemaIcon = document.querySelector('#schemaIcon');

    const conexionInput = document.querySelector('#conexionModal').value;
    const proveedorInput = document.querySelector('#proveedor').value;
    const SchemaInput = document.querySelector('#Schema').value;

    btnSchema.classList.remove("btn-outline-danger");
    schemaIcon.classList.remove("fas", "fa-circle");
    schemaIcon.classList.remove("text-latinco");

    schemaIcon.classList.add("fas", "fa-spinner");
    schemaIcon.classList.add("text-primary");
    btnSchema.classList.add("btn-outline-primary");

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/schema",
        type: "POST",
        data: {
            conexion: conexionInput,
            proveedor: proveedorInput,
            schema: SchemaInput,
        },
        success: function (result) {
            clean('#response');
            $("#response").html(result);

            schemaIcon.classList.remove("fas", "fa-spinner");
            schemaIcon.classList.remove("text-primary");
            btnSchema.classList.remove("btn-outline-primary");

            schemaIcon.classList.add("fas", "fa-circle");
            schemaIcon.classList.add("text-success");
            btnSchema.classList.add("btn-outline-success");
        },
    });
}


function modalSchema() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/modalSchema",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}

function modalConexion() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/modalConexion",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}

function modalConsulta() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "soap/modalConsulta",
        type: "GET",
        success: function (result) {
            $("#respuesta").html(result);
        },
    });
}

function clean(deleteContent) {
    const aux = document.querySelector(deleteContent)
    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}

function resetConexion() {
    const btnConexion = document.querySelector('#btnConexion');
    const conexionIcon = document.querySelector('#conexionIcon');

    btnConexion.classList.remove("btn-outline-success");
    btnConexion.classList.add("btn-outline-danger");
    conexionIcon.classList.add("fas", "fa-wifi");
}

function resetConsulta() {
    const btnConsulta = document.querySelector('#consulta');
    const consultaIcon = document.querySelector('#consultaIcon');


    btnConsulta.classList.remove("btn-outline-success");
    consultaIcon.classList.add("fas", "fa-circle");
    consultaIcon.classList.add("text-latinco");
    btnConsulta.classList.add("btn-outline-danger");

}

function resetSchema() {
    const btnSchema = document.querySelector('#consultaSchema');
    const schemaIcon = document.querySelector('#schemaIcon');


    btnSchema.classList.remove("btn-outline-success");
    schemaIcon.classList.add("fas", "fa-circle");
    schemaIcon.classList.add("text-latinco");
    btnSchema.classList.add("btn-outline-danger");
}


function loading() {
    const respuesta = document.querySelector('#response');
    clean('#response');
    respuesta.textContent = "Cargando..."

}



