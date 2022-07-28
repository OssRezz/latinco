const fechaInicio = document.querySelector("#fechaInicio");
let fechaFin = document.querySelector("#fechaFinal");
const totalDias = document.querySelector("#totalDias");
const diasEmpresa = document.querySelector("#diasEmpresa");
const diasMedio = document.querySelector("#diasMedio");
const cedula = document.querySelector("#cedulaInput");
const buttonIngresar = document.querySelector("#btn-ingresar-incapacidad");
const frmIncapacidad = document.querySelector("#frm-incapacidad");
const medioHtml = document.querySelector("#medioText");
const tipoIncapacidad = document.querySelector("#tipoIncapacidadInput");
const prorroga = document.querySelector("#prorrogaSelect");
const colProrroga = document.querySelector("#colProrroga");
let total;
let empresa;
let medioValor;
let medio;

fechaFin.setAttribute("disabled", true);
fechaInicio.setAttribute("disabled", true);

tipoIncapacidad.addEventListener("change", () => {
    medio = "Maternidad/Paternidad";
    if (tipoIncapacidad.value == 1) {
        medio = "EPS";
    } else if (tipoIncapacidad.value == 2) {
        medio = "ARL";
    }
    fechaInicio.removeAttribute("disabled");
    medioHtml.removeAttribute("hidden");
    if (medio == "Maternidad/Paternidad") {
        return (medioHtml.textContent = "Días EPS :");
    }

    medioHtml.textContent = "Días " + medio + " :";
});

prorroga.addEventListener("change", (e) => {
    if (prorroga.value == "No") {
        colProrroga.setAttribute("hidden", true);
    } else {
        colProrroga.removeAttribute("hidden");
    }
});

fechaInicio.addEventListener("change", (e) => {
    fechaFin.removeAttribute("disabled");
    fechaFin.min = fechaInicio.value;
});

fechaFin.addEventListener("change", (e) => {
    total = calcularFecha(fechaInicio.value, fechaFin.value);
    empresa;
    medioValor;
    if (prorroga.value == "No") {
        if (medio == "EPS") {
            empresa = total;
            medioValor = 0;
            if (total > 2) {
                empresa = 2;
                medioValor = total - empresa;
            }
        } else if (medio == "ARL") {
            empresa = total;
            medioValor = 0;
            if (total > 1) {
                empresa = 1;
                medioValor = total - empresa;
            }
        } else if (medio == "Maternidad/Paternidad") {
            empresa = 0;
            medioValor = total;
        }
    } else {
        empresa = 0;
        medioValor = total;
    }

    totalDias.textContent = total;
    diasEmpresa.textContent = empresa;
    diasMedio.textContent = medioValor;
});

cedula.addEventListener("input", (e) => {
    cargarEmpleado(e.target.value);
});

function cargarEmpleado(cedula) {
    const nombreSpan = document.querySelector("#cedulaSpan");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidad/" + cedula,
        type: "GET",
        success: function (result) {
            if (result.length > 0) {
                result.forEach((empleado) => {
                    const {
                        cedula,
                        nombre,
                        fechaIngreso,
                        salario,
                        centro_operaciones,
                        codigo,
                        empresa,
                        cargo,
                        eps,
                    } = empleado;
                    $("#cedula").html(cedula);
                    $("#nombre").html(nombre);
                    nombreSpan.setAttribute("value", cedula);
                    $("#empresa").html(empresa);
                    $("#fecha").html(fechaIngreso);
                    $("#cargo").html(cargo);
                    $("#centroOperacion").html(centro_operaciones);
                    $("#eps").html(eps);
                    $("#co").html(codigo);
                    const formatterPeso = new Intl.NumberFormat("es-CO", {
                        style: "currency",
                        currency: "COP",
                        minimumFractionDigits: 0,
                    });
                    $("#salario").html(formatterPeso.format(salario));
                });
                buttonIngresar.removeAttribute("disabled");
            } else {
                limpiarEmpleado();
                buttonIngresar.setAttribute("disabled", true);
            }
        },
    });
}

function cargarHistorial(e) {
    console.log(e.value);
    e.setAttribute("disabled", "disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "incapacidad/modalHistorial",
        type: "GET",
        data: { cedula: e.value },
        success: function (result) {
            $("#respuesta").html(result);
            e.removeAttribute("disabled");
        },
        error: function (err) {
            e.removeAttribute("disabled");
        },
    });
}

frmIncapacidad.addEventListener("submit", (e) => {
    buttonIngresar.setAttribute("disabled", "disabled");
    e.preventDefault();
    const formData = new FormData(frmIncapacidad);
    formData.append("totalDias", total);
    formData.append("diasEmpresa", empresa);
    formData.append("diasMedio", medioValor);
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
                totalDias.textContent = "N/A";
                diasEmpresa.textContent = "N/A";
                diasMedio.textContent = "N/A";
                buttonIngresar.setAttribute("disabled", "disabled");
                colProrroga.setAttribute("hidden", true);
            } else if (result.status == 404) {
                buttonIngresar.removeAttribute("disabled");
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
    let dias = diff / (1000 * 60 * 60 * 24);
    if (dias < 0) {
        dias = 0;
    }
    return dias;
}

function clean(deleteContent) {
    const aux = document.querySelector(deleteContent);
    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}

function copyToClickBoard(e) {
    // e.setAttribute("disabled", "disabled");
    console.log(JSON.parse(e.value));

    const prorroga = JSON.parse(e.value);
    const { id_prroroga, numero_incapacidad } = prorroga;
    const incapacidad = numero_incapacidad + "-" + id_prroroga;
    console.log(incapacidad);

    navigator.clipboard
        .writeText(incapacidad)
        .then(() => {
            console.log("Text copied to clipboard...");
        })
        .catch((err) => {
            console.log("Something went wrong", err);
        });
}
