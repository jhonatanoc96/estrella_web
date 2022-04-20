let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_evento_add_photo = "";
let current_images = [];
let _id_radio_add_photo = "";
let idRadioSelectedToEdit = "";

$(document).ready(function () {
    var radios_true = [];

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/listener",
        success: function (msg) {
            console.log(msg);
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td>' + [msg][0]["Message "][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "][i].lastname + '</td>' +
                    '<td>' + [msg][0]["Message "][i].tel + '</td>' +
                    '<td>' + [msg][0]["Message "][i].country + '</td>' +
                    '<td>' + [msg][0]["Message "][i].department + '</td>' +
                    '<td>' + [msg][0]["Message "][i].city + '</td>' +
                    '<td>' + [msg][0]["Message "][i].email + '</td>' +
                    '<td>' + [msg][0]["Message "][i].occupation + '</td>' +
                    '<td>' + [msg][0]["Message "][i].birth_date + '</td>' +
                    '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    radios_true.push([msg][0]["Message "][i]._id);
                }
            }

            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state_radio"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { changeState(el[j]) };
                //Comprobar estado actual
                if (radios_true.includes(el[i].id.replace('radio', ''))) {
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


            var elImg = document.querySelectorAll(".imgRadio"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elImg.length; i++) {
                let j = i;
                elImg[i].onclick = function () { updateImg(elImg[j]) };

            }

            var elEdit = document.querySelectorAll(".editar_radio"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function () { updateRadio(elEdit[j]) };

            }

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });

    //Crear emisora
    $("#enviarNotificacion").click(function () {
        let title = document.getElementById("titleNotification").value;
        let description = document.getElementById("descriptionNotification").value;

        if (!title)
            return alert('error', 'Oops...', 'El título es obligatorio.');

        if (!description)
            return alert('error', 'Oops...', 'La descripción es obligatoria.');

        $.ajax({
            method: "POST",
            url: "https://onesignal.com/api/v1/notifications",
            headers: {
                Authorization: 'Bearer Mjc3MDhkZDUtNGQzNS00NzRjLWEzOGEtYWYxY2FhOWExNGI4'
            },
            data: {
                app_id: "8d023c5f-8bdd-4755-b5ba-62f174adab7b",
                included_segments: ["Active Users"],
                headings: { "en": title },
                contents: { "en": description },
                data: { "task": "OK" }
            },
            success: function (msg) {
                console.log("MSG", msg);
                location.reload();
                return alert('success', "Notificación enviada", 'La notificación ha sido enviada exitosamente a ' + msg["recipients"] + " dispositivo(s).");
            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });
    });

    //Editar emisora
    $("#guardarEditarEmisora").click(function () {

        let nombre = document.getElementById("nameEditRadio").value;
        let urlEmisora = document.getElementById("urlEditRadio").value;

        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!urlEmisora || urlEmisora == "")
            return alert('error', 'Oops...', 'La URL de la emisora es obligatoria.');

        $.ajax({
            method: "PUT",
            url: url + "api/radio/" + idRadioSelectedToEdit,
            data: { name: nombre, url: urlEmisora },
            success: function (msg) {

                location.reload();
                return alert('success', 'Emisora modificada exitosamente', "");

            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });
    });
});


function updateImg(row) {
    let id = row.id.replace('imgRadio', '');
    _id_radio_add_photo = id;

    let formImgRadio = document.getElementById("formImgRadio" + id);

    $("#imgRadio" + id).change(function () {
        $("<input />").attr("type", "hidden").attr("name", "_id_radio").attr("value", id).appendTo(formImgRadio);
        formImgRadio.submit(function (e) { });

    });
}

function updateRadio(row) {
    idRadioSelectedToEdit = row.id.replace('editradio', '');

    $.ajax({
        method: "GET",
        url: url + "api/radio/" + row.id.replace('editradio', ''),
        success: function (msg) {
            document.getElementById("nameEditRadio").value = msg['Message ']['name'];
            document.getElementById("urlEditRadio").value = msg['Message ']['url'];
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



