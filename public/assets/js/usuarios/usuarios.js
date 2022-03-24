let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let estadoEdit = false;


$(document).ready(function() {

    let _id = document.getElementById("_idEdit").value;
    let correo = document.getElementById("correoEdit").value;
    let token = document.getElementById("tokenEdit").value;
    let phone_number = document.getElementById("phoneEdit").value;
    let id_user_typeEdit = document.getElementById("id_user_typeEdit").value;

    if (document.getElementById("estadoActual").value == true) {
        document.getElementById("estadoEdit").checked = false;
    } else {
        document.getElementById("estadoEdit").checked = true;

    }

    $("#guardarEdit").click(function(e) {
        let nombre = document.getElementById("nombreEdit").value;
        let apellido = document.getElementById("apellidoEdit").value;
        let estado = document.getElementById("estadoEdit").checked;

        $.ajax({
            method: "PUT",
            url: url + "api/user/" + _id,
            data: { name: nombre, last_name: apellido, state: estado },
            success: function(msg) {

                window.location = "/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + phone_number + "/" + estado + "/" + id_user_typeEdit;
                return alert('success', 'Usuario modificado exitosamente', "");

            },
            error: function(error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });

    });


    // Cambiar la contraseña
    $("#changePassword").click(function(e) {

        let password = document.getElementById("passwordEdit").value;
        let confirmPassword = document.getElementById("confirmPasswordEdit").value;

        if (!password || password == "")
            return alert('error', 'Oops...', 'La contraseña es obligatoria.');

        if (!confirmPassword || confirmPassword == "")
            return alert('error', 'Oops...', 'La confirmación de contraseña es obligatoria.');

        if (password != confirmPassword)
            return alert('error', 'Oops...', 'Las contraseñas no coinciden.');

        $.ajax({
            method: "PUT",
            url: url + "api/updatepassword",
            data: { password: password, email: correo },
            success: function(msg) {

                // window.location = "/public/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + estado + "/" + login + "/" + tipousuario + "/" + permiso;
                return alert('success', 'Contraseña modificada exitosamente', "");

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