const fechaInicio = document.querySelector('#fechaInicio');
const fechaFin = document.querySelector('#fechaFinal');
const totalDias = document.querySelector('#totalDias');
const diasEmpresa = document.querySelector('#diasEmpresa');
const diasEps = document.querySelector('#diasEps');
const cedula = document.querySelector('#cedulaInput');
const buttonIngresar = document.querySelector('#btn-ingresar-incapacidad');
const frmIncapacidad = document.querySelector('#frm-incapacidad');


fechaFin.setAttribute('disabled', true);
totalDias.setAttribute('disabled', true);

fechaInicio.addEventListener('change', e => {
    fechaFin.removeAttribute('disabled');
    fechaFin.min = fechaInicio.value;
});

fechaFin.addEventListener('change', e => {
    const total = calcularFecha(fechaInicio.value, fechaFin.value);
    let empresa = 2;
    let eps = total - empresa;
    if (total == 0) {
        eps = 0;
        empresa = 0;
    } else if (total == 1) {
        eps = 0;
        empresa = total;
    }

    totalDias.textContent = total;
    diasEmpresa.textContent = empresa;
    diasEps.textContent = eps;
});

cedula.addEventListener('input', (e) => {
    cargarEmpleado(e.target.value);
});

function cargarEmpleado(cedula) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidad/" + cedula,
        type: "GET",
        success: function (result) {
            if (result.length > 0) {
                result.forEach(empleado => {
                    const { cedula, nombre, fechaIngreso, salario, centro_operaciones, codigo, empresa, cargo, eps } = empleado;
                    $("#cedula").html(cedula);
                    $("#nombre").html(nombre);
                    $("#empresa").html(empresa);
                    $("#fecha").html(fechaIngreso);
                    $("#cargo").html(cargo);
                    $("#centroOperacion").html(centro_operaciones);
                    $("#eps").html(eps);
                    $("#co").html(codigo);
                    $("#salario").html(salario);
                });
                buttonIngresar.removeAttribute('disabled');
            } else {
                limpiarEmpleado();
                buttonIngresar.setAttribute('disabled', true);
            }
        },
    });
}


frmIncapacidad.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(frmIncapacidad);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidad",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.status == 201) {
                frmIncapacidad.reset();
                limpiarEmpleado();
            }
            $("#respuesta").html(result.modal);
        },
    });
});


function limpiarEmpleado() {
    clean("#cedula");
    clean("#nombre");
    clean("#empresa");
    clean("#fecha");
    clean("#cargo");
    clean("#centroOperacion");
    clean("#co");
    clean("#salario");
    clean("#eps");
}

function calcularFecha(fechaInicial, fechaFinalizacion) {
    const fechaInicio = new Date(fechaInicial).getTime();
    const fechaFinal = new Date(fechaFinalizacion).getTime();

    const diff = fechaFinal - fechaInicio;
    const dias = diff / (1000 * 60 * 60 * 24);
    if (dias < 0) {
        dias = 0;
    }
    return dias;
}


function clean(deleteContent) {
    const aux = document.querySelector(deleteContent)
    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}