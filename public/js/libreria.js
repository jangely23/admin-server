function abrirPagina(pagina, contenedor, parametros, ejecutar = "") {

    $.ajax({
        type: 'post',
        url: pagina,
        data: parametros,
        async: true,
        success: function(data) {

            $('#' + contenedor).html(data);

            if (ejecutar !== "") {
                eval(ejecutar);
            }

        }
    });
}

function enviarFormulario(formulario, contenedor = "", ejecutar = "") {

    //alert("el id es "+id_formulario);
    var url = $(formulario).attr("action"); // El script a dónde se realizará la petición.
    var type = $(formulario).attr("method");
    console.log('la url : ' + url);
    console.log('el type : ' + type);
    var formData = new FormData(formulario);
    $.ajax({
        type: 'post',
        url: url,
        //        dataType:"html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log('Se ha procesado con exito el envio del formulario');


            if (contenedor !== "") {
                $('#' + contenedor).html(data);
            }

            if (ejecutar !== "") {
                eval(ejecutar);
            }

        },
        error: function(xhr, status) {
            return false; // Evitar ejecutar el submit del formulario.   
            alert('Disculpe, existió un problema');
        },
        // código a ejecutar sin importar si la petición falló o no
        complete: function(xhr, status) {
            console.log('Petición realizada');
            return false; // Evitar ejecutar el submit del formulario.   
        }
    });
    return false; // Evitar ejecutar el submit del formulario.   
}

function sumarServicios() {

    const arrayTotal = document.getElementById("id_span_array_total");
    arrayTotal.classList.add("invisible");
    arrayTotal.innerHTML = "";

    var total = 0;

    $(document).find('input[name="hidden_valor[]"]').each((idx, elem) => {

        let current_element = $(elem); //selecciona el elemento actual
        let element_checkbox = current_element.siblings('input[name="id_servicio[]"]'); //busca el input dentro del mismo nivel que correspona a ese name

        if (element_checkbox.is(':checked')) { //valida si el input fue seleccionado
            total += parseFloat(current_element.val());
        }
    });
    document.getElementById("id_span_total").innerHTML = total;
}

function confirmarClave() {
    const confirmacion = document.getElementById("txt_claveConfirmacion").value;
    const clave = document.getElementById("txt_clave").value;
    const alerta = document.getElementById("alerta");
    const boton = document.getElementById("boton");

    if (clave == confirmacion) {
        alerta.classList.remove("text-danger");
        alerta.classList.add("text-success");
        boton.classList.remove("disabled");
    }
}