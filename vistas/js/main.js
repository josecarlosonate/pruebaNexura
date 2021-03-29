// $("i.fa.fa-trash").click(function () {

// });
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

// guardar datos del empleado 
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'El empleado ha sido guardado',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#Modal').modal('hide');
                $('#formularioRegistro')[0].reset();
                mostrarEmpleados();
            }
            if (response == "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡Algo salió mal!',
                    footer: 'no se pudo realizar la operacion'
                })
            }
        },
    });
}

// traer listado de empleados 
function mostrarEmpleados() {
    $('#listadoEmpleados').empty();
    $.ajax({
        async: true,
        url: "ajax/empleados.ajax.php",
        type: "POST",
        data: {
            accion: "consultar",
        },
        success: function (response) {
            let data = JSON.parse(response);

            data.forEach(element => {
                let boletin = element.boletin;
                boletin = (element.boletin == 0) ? 'NO' : 'SI';
                let tr = document.createElement('tr');
                tr.innerHTML = `
                <th class="text-primary">${element.nombre}</th>
                <th class="text-primary">${element.email}</th>
                <th class="text-primary">${element.sexo}</th>
                <th class="text-primary">${element.area}</th>
                <th class="text-primary">${boletin}</th>
                <th class="text-primary iconoEditar" onclick="traerEmpleado(${element.id})"><i class="fa fa-eye"></i></th>
                <th class="text-primary iconoBorrar" onclick="eliminarEmpleado(${element.id})"><i class="fa fa-trash"></i></th>
                `;
                $('#listadoEmpleados').append(tr);
            });

        }
    });
}
mostrarEmpleados();

// eliminar empleado 
function eliminarEmpleado(id) {
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
            // eliminando 
            $.ajax({
                async: true,
                url: "ajax/empleados.ajax.php",
                type: "POST",
                data: {
                    accion: "eliminar",
                    id: id
                },
                success: function (response) {
                    console.log(response);
                    if(response == 'ok'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'El empleado ha sido eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        mostrarEmpleados();
                    }
                    if(response == 'error'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡Algo salió mal!',
                            footer: 'no se pudo realizar la operacion'
                        });
                    }
                }
            });
        }
    });
}

// editar o actualizar 
function traerEmpleado(id) {
    // primero traigo los datos del empleado 
    $.ajax({
        async: true,
        url: "ajax/empleados.ajax.php",
        type: "POST",
        data: {
            accion: "editar",
            id: id
        },
        success: function (response) {
            let data = JSON.parse(response);
            
            $('#ModalVer').modal('show')
            $('#verNombre').val(data.data.nombre);
            $('#verEmail').val(data.data.email);
            $('#verSexo').val(data.data.sexo);
            $('#verArea').val(data.data.area);
            let boletin = data.data.boletin;
                boletin = (data.data.boletin == 0) ? 'NO' : 'SI';
            $('#verBoletin').val(boletin);
            $('#verDescripcion').val(data.data.descripcion);
            
            let roles = data.roles;
            let rolesArray = [];
            roles.forEach(element => {
                rolesArray.push(element.nombre);
            });
            $('#verRoles').val(rolesArray.toString());
            // console.log(rolesArray);
        }
    });
}