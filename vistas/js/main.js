$("i.fa.fa-trash").click(function () {
    Swal.fire({
        title: "Estas segur@?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, bórralo!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
});
// mensajes español
$(document).ready(function () {
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        email: "Por favor, escribe una dirección de correo válida",
        number: "Por favor, escribe un número entero válido.",
        maxlength: jQuery.validator.format(
            "Por favor, no escribas más de {0} caracteres."
        ),
        minlength: jQuery.validator.format(
            "Por favor, no escribas menos de {0} caracteres."
        ),
    });
});
// validar formulario
$("#formularioRegistro").validate({
    rules: {
        nombre: {
            required: true,
            minlength: 4,
        },
        email: {
            required: true,
            email: true,
        },
        sexo: {
            required: true,
        },
        sltArea: {
            required: true,
        },
        descripcion: {
            required: true,
            minlength: 5,
            maxlength: 200,
        },
        "roles[]": {
            required: true,
        },
    },
    messages: {
        "roles[]": "Debe escoger un rol obligatoriamente.",
    },
});

$("#btnGuardar").click(function () {
    if ($("#formularioRegistro").valid() == false) {
        return;
    }

    let nombre = $("#nombre").val();
    let email = $("#email").val();
    let sexo = $("[name='sexo']:checked").val();
    let area = $("#sltArea").val();
    let descripcion = $("#descripcion").val();
    let boletin = $("#boletin").is(":checked");
    boletin = boletin == true ? 1 : 0;
    let roles = [];
    $(".form-check-input.roles").each(function () {
        if (this.checked) {
            roles.push($(this).val());
        }
    });

    // objeto de datos
    let objDatos = {
        nombre: nombre,
        email: email,
        sexo: sexo,
        area_id: area,
        descripcion: descripcion,
        boletin: boletin,
        roles: roles,
    };
    // console.log(objDatos,JSON.stringify(objDatos));
    enviarAjax(JSON.stringify(objDatos));
});

function enviarAjax(datos) {
    $.ajax({
        async: true,
        url: "ajax/empleados.ajax.php",
        type: "POST",
        data: {
            accion: "nuevo",
            empleado: datos,
        },
        success: function (response) {
            console.log(response);
            if (response == "ok") {

            }
        },
    });
}