let url = "http://3.16.246.24:3010/";

$(document).ready(function() {


    $("#guardar").click(function(e) {

        let email = document.getElementById("emailLogin").value;
        let password = document.getElementById("passwordLogin").value;

        if (!email || email == "")
            return alert('error', 'Oops...', 'El correo electrónico es obligatorio.');

        if (!password || password == "")
            return alert('error', 'Oops...', 'La contraseña es obligatoria.');
        $.ajax({
            method: "POST",
            url: url + "api/login",
            data: { email: email, password: password },
            success: function(msg) {

                window.location = "/session/home/" + msg.token + "/" + msg.user.uid + "/" + msg.user.name + "/" + msg.user.last_name + "/" + msg.user.email + "/" + msg.user.phone_number + "/" + msg.user.state + "/" + msg.user.id_user_type;
                return alert('success', 'Inicio de sesión exitoso', 'Hola ' + msg.user.name + ' ' + msg.user.last_name);

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

$(".intention-card").on('click', function() {
    console.log("Intention Card");
});