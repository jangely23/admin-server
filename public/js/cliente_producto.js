$(document).ready(function() {
    deshabilitarCampos()
})

function deshabilitarCampos() {
    /*const estado = $(".estadoClienteProducto").text();
    const padre = $(".estadoClienteProducto").parents("tr");
    const deshabilitar = padre.find(".botonDeshabilitar");

    console.log(estado);
    if (estado != "cancelado") {
        //deshabilitar.attr("disable", true);
        console.log("llehue");
    }*/

    $(".estadoClienteProducto").each(function(idx, elem) {
        const padre = $(elem).parents("tr");
        const deshabilitar = padre.find(".botonDeshabilitar");
        let estado_texto = $(elem).text();
        if (estado_texto === "cancelado") {
            deshabilitar.removeAttr("onclick").removeClass('text-warning text-danger').addClass('text-secondary disable fw-light');
            console.log(padre, deshabilitar)
        }
    })

}