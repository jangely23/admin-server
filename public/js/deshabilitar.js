$(document).ready(function() {
    deshabilitarCampos()
})

function deshabilitarCampos() {
    $(".estadoClienteProducto").each(function(idx, elem) {
        const padre = $(elem).parents("tr");
        const deshabilitar = padre.find(".botonDeshabilitar");
        let estado_texto = $(elem).text();
        if (estado_texto === "cancelado" || estado_texto === "entregado") {
            deshabilitar.removeAttr("onclick").removeClass('text-primary text-warning text-danger text-secondary text-success').addClass('text-secondary disable fw-light');

        } else if (estado_texto === "inactivo") {
            deshabilitar.removeClass('text-warning text-danger text-success').addClass('text-light fw-lighter');
            console.log(padre, deshabilitar)
        }
    })

}