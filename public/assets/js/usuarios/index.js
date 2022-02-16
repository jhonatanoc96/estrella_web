let url = "http://3.16.246.24:3010/";

$(document).ready(function() {

    document.getElementsByClassName("check_state").onclick = (function(e) {

        console.log("e");
        console.log(e);
    });

    var users = $("#users_table");
    var users_true = [];

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/user",
        success: function(msg) {

            var html = '';
            var i;

            for (i = 0; i < msg["Message "].length; i++) {
                html += '<tr>' +
                    '<td>' + msg["Message "][i].name + ' ' + msg["Message "][i].last_name + '</td>' +
                    '<td>' + msg["Message "][i].email + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state" id="user' + msg["Message "][i].uid + '"><span class="slider round"></span></label> </td>' +
                    '<td>' + msg["Message "][i].creation_date + '</td>' +
                    '</tr>';

                if (msg["Message "][i].state) {
                    users_true.push(msg["Message "][i].uid);
                }
                console.log(msg["Message "]);
            }
            $('#users_table').html(html);

            // console.log(users_true);

            var el = document.querySelectorAll(".check_state"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function() { changeState(el[j]) };
                //Comprobar estado actual
                if (users_true.includes(el[i].id.replace('user', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }

            }


        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
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

function changeState(row) {

    let estado = false;

    if (!row.checked) {
        estado = false;
    } else {
        estado = true;
    }

    $.ajax({
        method: "PUT",
        url: url + "api/user/" + row.id.replace('user', ''),
        data: { state: estado },
        success: function(msg) {

            // window.location = "/public/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + estado + "/" + login + "/" + tipousuario + "/" + permiso;
            location.reload();
            return alert('success', 'Estado modificado exitosamente', "");

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });
}