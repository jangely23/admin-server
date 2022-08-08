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

    const confirmacion = document.getElementById("claveConfirmacion").value;
    const clave = document.getElementById("clave").value;
    const alerta = document.getElementById("alerta");
    const boton = document.getElementById("boton");

    alerta.classList.add("text-danger");
    alerta.classList.remove("text-success");

    if (clave == confirmacion) {
        alerta.classList.remove("text-danger");
        alerta.classList.add("text-success");
        boton.classList.remove("disabled");
    }
}

function confirmarAccion() {
    fecha = new Date();
    if (confirm("¿Estas seguro de enviar las cuentas de cobro hoy " + fecha + "?")) {
        document.tuformulario.submit()
    }
}

/* //No se esta usando actualmente

function agregar_input() {
    var contenido = document.getElementById("medio_pago").value;
    var input_hijo = !!document.getElementById("id_soporte_agregado");
    var padre_input = document.getElementById("id_soporte_pago");

    if (input_hijo) {
        padre_input.removeChild(document.getElementById("id_soporte_agregado"));
    }

    if (contenido != "Bancolombia_Francisco") {

        var input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.setAttribute("name", "soporte");
        input.setAttribute("id", "id_soporte_agregado");
        document.getElementById("id_soporte_pago").appendChild(input);

    } else {

        var input = document.createElement("input");
        input.type = "file";
        input.className = "form-control";
        input.setAttribute("name", "soporte");
        input.setAttribute("id", "id_soporte_agregado");
        document.getElementById("id_soporte_pago").appendChild(input);
    }
} */