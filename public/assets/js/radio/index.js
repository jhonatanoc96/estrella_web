let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_evento_add_photo = "";
let current_images = [];

$(document).ready(function () {
    var events_true = [];
    let formAddPhotoBanner = document.getElementById("formAddPhotoBanner");

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/radio",
        success: function (msg) {
            console.log(msg);
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td><img style="height: 70px; width: auto;" src="http://estrella.test/' + [msg][0]["Message "][i]['url_image'] + '"</img></td>' +
                    '<td>' + [msg][0]["Message "][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "][i].url + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state_radio" id="radio' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    '<td><button style="background: none; border: none; font-size: 20px;" class="eliminar_imagen" id="radio' + [msg][0]["Message "][i]._id + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    events_true.push([msg][0]["Message "][i]._id);
                }
            }

            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state_radio"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { changeState(el[j]) };
                //Comprobar estado actual
                if (events_true.includes(el[i].id.replace('radio', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }
            }

            var el2 = document.querySelectorAll(".eliminar_imagen"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el2.length; i++) {
                let j = i;
                el2[i].onclick = function () { deleteImagen(el2[j]) };

            }

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });

    //Crear emisora
    $("#guardarCreateEmisora").click(function () {
        let emisora = document.getElementById("emisora").value;

        if (!emisora)
            return alert('error', 'Oops...', 'La emisora es obligatoria.');

        $.ajax({
            method: "POST",
            url: url + "api/create-radio",
            data: {
                url: emisora,
                state: true
            },
            success: function (msg) {
                console.log("MSG", msg);
                location.reload();
                return alert('success', 'Evento creado exitosamente', "");
            },
            error: function (error) {
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


function changeState(row) {

    let estado = false;

    if (!row.checked) {
        estado = false;
    } else {
        estado = true;
    }

    $.ajax({
        method: "PUT",
        url: url + "api/radio/" + row.id.replace('radio', ''),
        data: { state: estado },
        success: function (msg) {

            // window.location = "/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + estado + "/" + login + "/" + tipousuario + "/" + permiso;
            location.reload();
            return alert('success', 'Estado modificado exitosamente', "");

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });
}

function deleteImagen(row) {

    let id = row.id.replace("radio", "");

    $.ajax({
        method: "DELETE",
        url: url + "api/radio/" + id,
        success: function (msg) {
            location.reload();
            return alert('success', 'Emisora eliminada exitosamente', "");
        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


}

function viewImagen(row) {

    let nombre = row.id.replace("imagen", "");
    console.log(nombre);

    // window.location = "/eventosEdit/" + id;

}