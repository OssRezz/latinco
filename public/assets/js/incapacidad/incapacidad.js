const fechaInicio = document.querySelector('#fechaInicio');
const fechaFin = document.querySelector('#fechaFinal');
const totalDias = document.querySelector('#totalDias');
const diasEmpresa = document.querySelector('#diasEmpresa');
const diasEps = document.querySelector('#diasEps');

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