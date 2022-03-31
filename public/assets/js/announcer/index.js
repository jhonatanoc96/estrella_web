let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_announcer_add_audio = "";
let current_images = [];

$(document).ready(function () {
    var events_true = [];

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/announcer",
        success: function (msg) {
            console.log(msg);
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td><img style="height: 70px; width: auto;" src="http://estrella.test/' + [msg][0]["Message "][i]['url_image'] + '"</img></td>' +
                    '<td><audio controls><source src="' + [msg][0]["Message "][i].url_audio + '"></audio><form id="formAudioAnnouncer' + [msg][0]["Message "][i]._id + '" method="POST" action="/store-audio-announcer" enctype="multipart/form-data"><input type="file" id="audioAnnouncer' + [msg][0]["Message "][i]._id + '" name="audioAnnouncer" class="audioAnnouncer" data-button=""></form></td>' +
                    '<td>' + [msg][0]["Message "][i].name + ' ' + [msg][0]["Message "][i].last_name + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state_announcer" id="announcer' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    // '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    '<td><button style="background: none; border: none;" class="eliminar_imagen" id="radio' + [msg][0]["Message "][i]._id + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button><button style="background: none; border: none;" class="editar_locutor" id="editlocutor' + [msg][0]["Message "][i]._id + '"><i class="fas fa-edit" style="color: gray;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    events_true.push([msg][0]["Message "][i]._id);
                }
            }

            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state_announcer"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { changeState(el[j]) };
                //Comprobar estado actual
                if (events_true.includes(el[i].id.replace('announcer', ''))) {
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


            var elEdit = document.querySelectorAll(".editar_locutor"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function () { editLocutor(elEdit[j]) };

            }

            var elAudio = document.querySelectorAll(".audioAnnouncer"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elAudio.length; i++) {
                let j = i;
                elAudio[i].onclick = function () { updateAudio(elAudio[j]) };

            }

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    function editLocutor(row) {

        let id = row.id.replace("editlocutor", "");

        window.location = "/announcerEdit/" + id;
    }

});

function updateAudio(row) {
    let id = row.id.replace('audioAnnouncer', '');
    _id_announcer_add_audio = id;

    let formAudioAnnouncer = document.getElementById("formAudioAnnouncer" + id);

    $("#audioAnnouncer" + id).change(function () {
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", id).appendTo(formAudioAnnouncer);
        console.log(("FORM", formAudioAnnouncer));
        formAudioAnnouncer.submit(function (e) { });

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
        url: url + "api/announcer/" + row.id.replace('announcer', ''),
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
        url: url + "api/announcer/" + id,
        success: function (msg) {
            location.reload();
            return alert('success', 'Locutor eliminado exitosamente', "");
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