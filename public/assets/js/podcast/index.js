let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_evento_add_photo = "";
let current_images = [];
let _id_radio_add_photo = "";
let idPodcastSelectedToEdit = "";

$(document).ready(function () {
    var radios_true = [];

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/podcast",
        success: function (msg) {
            console.log(msg);
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td>' + [msg][0]["Message "][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "][i].url_audio + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state_podcast" id="podcast' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    '<td><button style="background: none; border: none;" class="eliminar_podcast" id="podcast' + [msg][0]["Message "][i]._id + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button><button style="background: none; border: none;" class="editar_podcast" id="editpodcast' + [msg][0]["Message "][i]._id + '" data-toggle="modal" data-target="#exampleModalEditPodcast"><i class="fas fa-edit" style="color: gray;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    radios_true.push([msg][0]["Message "][i]._id);
                }
            }

            $('#records_table_podcast').html(html);

            var el = document.querySelectorAll(".check_state_podcast"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { changeState(el[j]) };
                //Comprobar estado actual
                if (radios_true.includes(el[i].id.replace('podcast', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }
            }

            var el2 = document.querySelectorAll(".eliminar_podcast"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el2.length; i++) {
                let j = i;
                el2[i].onclick = function () { deletePodcast(el2[j]) };

            }

            var elEdit = document.querySelectorAll(".editar_podcast"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function () { updatePodcast(elEdit[j]) };

            }

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });

    //Crear emisora
    $("#guardarCrearPodcast").click(function () {
        let nombre = document.getElementById("nameCreatePodcast").value;
        let urlPodcast = document.getElementById("urlCreatePodcast").value;

        if (!nombre)
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!urlPodcast)
            return alert('error', 'Oops...', 'La URL es obligatori1.');

        $.ajax({
            method: "POST",
            url: url + "api/create-podcast",
            data: {
                name: nombre,
                url_audio: urlPodcast,
                state: true
            },
            success: function (msg) {
                console.log("MSG", msg);
                location.reload();
                return alert('success', 'Podcast creado exitosamente', "");
            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });
    });

    //Editar emisora
    $("#guardarEditarPodcast").click(function () {

        let nombre = document.getElementById("nameEditPodcast").value;
        let urlPodcast = document.getElementById("urlEditPodcast").value;

        if (!nombre)
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!urlPodcast)
            return alert('error', 'Oops...', 'La URL es obligatori1.');

        $.ajax({
            method: "PUT",
            url: url + "api/podcast/" + idPodcastSelectedToEdit,
            data: { name: nombre, url_audio: urlPodcast },
            success: function (msg) {

                location.reload();
                return alert('success', 'Podcast modificado exitosamente', "");

            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });
    });
});

function updatePodcast(row) {
    idPodcastSelectedToEdit = row.id.replace('editpodcast', '');

    $.ajax({
        method: "GET",
        url: url + "api/podcast/" + row.id.replace('editpodcast', ''),
        success: function (msg) {
            document.getElementById("nameEditPodcast").value = msg['Message ']['name'];
            document.getElementById("urlEditPodcast").value = msg['Message ']['url_audio'];
        },
        error: function (error) {
        }
    });

}

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
        url: url + "api/podcast/" + row.id.replace('podcast', ''),
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

function deletePodcast(row) {

    let id = row.id.replace("podcast", "");

    $.ajax({
        method: "DELETE",
        url: url + "api/podcast/" + id,
        success: function (msg) {
            location.reload();
            return alert('success', 'Podcast eliminado exitosamente', "");
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



