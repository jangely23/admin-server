$(document).ready(function() {
    deshabilitarCampos()
})

function deshabilitarCampos() {
    $(".estadoClienteProducto").each(function(idx, elem) {
        const padre = $(elem).parents("tr");
        const deshabilitar = padre.find(".botonDeshabilitar");
        let estado_texto = $(elem).text();
        if (estado_texto === "cancelado" || estado_texto === "entregado" || estado_texto === "cancelada") {
            deshabilitar.removeAttr("onclick").removeClass('text-primary text-warning text-danger text-info text-success').addClass('text-secondary disable fw-light');

        } else if (estado_texto === "inactivo") {
            deshabilitar.removeClass('text-warning text-danger text-success text-info').addClass('fw-light text-secondary');
            console.log(padre, deshabilitar)
        }
    })

}