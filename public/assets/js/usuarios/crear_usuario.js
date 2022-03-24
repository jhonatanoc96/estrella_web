let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";

$(document).ready(function() {

    var tipos_usuario = $("#select-tipo-usuario");
    var tipos_usuario_selected = "";

    //Obtener tipos de usuario
    $.ajax({
        method: "GET",
        url: url + "api/user-type",
        success: function(msg) {
            // window.location = "/public/indexUser/" + msg.users;
            $(msg["Message "]).each(function(i, v) { // indice, valor
                tipos_usuario.append('<option value="' + v._id + '">' + v.name + '</option>');
            })

        },
        error: function(error) {
            // return alert('error', 'Oops...', JSON.stringify(error));
        }
    });

    //Almacenar valor de tipo de usuario seleccionado
    $("#select-tipo-usuario").change(function() {
        tipos_usuario_selected = $(this).val();
    });

    $("#guardarCreate").click(function(e) {
        let correo = document.getElementById("correoCreate").value;
        let nombre = document.getElementById("nombreCreate").value;
        let apellido = document.getElementById("apellidoCreate").value;
        let passwordCreate = document.getElementById("passwordCreate").value;
        let confirmPasswordCreate = document.getElementById("confirmPasswordCreate").value;
        let tipousuario = tipos_usuario_selected;


        if (!correo || correo == "")
            return alert('error', 'Oops...', 'El correo electrónico es obligatorio.');

        if (!validarEmail(correo)) {
            return alert('error', 'Oops...', 'Ingrese un correo electrónico válido.');
        }

        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!apellido || apellido == "")
            return alert('error', 'Oops...', 'El apellido es obligatorio.');

        if (!tipousuario || tipousuario == "")
            return alert('error', 'Oops...', 'El tipo de usuario es obligatorio.');

        if (!passwordCreate || passwordCreate == "")
            return alert('error', 'Oops...', 'La contraseña es obligatoria.');

        if (!confirmPasswordCreate || confirmPasswordCreate == "")
            return alert('error', 'Oops...', 'La confirmación de contraseña es obligatoria.');

        $.ajax({
            method: "POST",
            url: url + "api/create-user",
            data: { email: correo, password: confirmPasswordCreate, name: nombre, last_name: apellido, phone_number: "0000000000", id_user_type: tipousuario },
            success: function(msg) {

                window.location = "/user/";
                return alert('success', 'Usuario creado exitosamente', "");

            },
            error: function(error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });


    });

});

function alert(type, title, text) {
    Swal.close()
    Swal.fire({
        type: type,
        title: title,
        text: text
    });
}

function validarEmail(email) {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
}