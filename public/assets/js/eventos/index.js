let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_evento_add_photo = "";
let current_images = [];

$(document).ready(function() {
    var events_true = [];
    let formAddPhoto = document.getElementById("formAddPhoto");

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/event",
        success: function(msg) {
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td>' + [msg][0]["Message "][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "][i].description + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state" id="evento' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    // '<td><button style="background: none; border: none;" class="eliminar_evento" id="evento' + [msg][0]["Message "][i]._id + '"><i class="fas fa-trash" style="color: gray;"></i></button><button style="background: none; border: none;" class="editar_evento" id="editevento' + [msg][0]["Message "][i]._id + '"><i class="fas fa-edit" style="color: gray;"></i></button></td>' +
                    '<td><button style="background: none; border: none;" class="editar_evento" id="editevento' + [msg][0]["Message "][i]._id + '"><i class="fas fa-edit" style="color: gray;"></i></button><button data-toggle="modal" data-target="#exampleModal" style="background: none; border: none;" class="edit_images" id="editimages' + [msg][0]["Message "][i]._id + '"><i class="fa fa-file" style="color: gray;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    events_true.push([msg][0]["Message "][i]._id);
                }
            }
            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function() { changeState(el[j]) };
                //Comprobar estado actual
                if (events_true.includes(el[i].id.replace('evento', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }
            }

            // var el = document.querySelectorAll(".eliminar_evento"); // this element contains more than 1 DOMs.
            // for (var i = 0; i < el.length; i++) {
            //     let j = i;
            //     el[i].onclick = function() { deleteEvento(el[j]) };

            // }

            var elEdit = document.querySelectorAll(".editar_evento"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function() { editEvento(elEdit[j]) };

            }

            var elEditImages = document.querySelectorAll(".edit_images"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEditImages.length; i++) {
                let j = i;
                elEditImages[i].onclick = function() { editImages(elEditImages[j]) };
            }

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    //Cuando se carga una foto nueva para foto principal del evento
    $("#addPhoto").change(function() {
        $("<input />").attr("type", "hidden").attr("name", "id_evento").attr("value", _id_evento_add_photo).appendTo(formAddPhoto);
        $("<input />").attr("type", "hidden").attr("name", "current_images").attr("value", current_images).appendTo(formAddPhoto);

        formAddPhoto.submit(function(e) {});
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

function deleteEvento(row) {

    let id = row.id.replace("evento", "");

    Swal.fire({
        title: '¿Estás seguro que deseas borrar este evento?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: 'Cancelar',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        console.log(result);
        if (!result.value) {
            Swal.fire('', 'No se ha eliminado el evento', 'info');

        } else {
            $.ajax({
                method: "DELETE",
                url: url + "api/event/" + id,
                success: function(msg) {
                    Swal.fire('', 'Evento eliminado exitosamente', 'success');
                    location.reload();
                },
                error: function(error) {
                    return alert('error', 'Oops...', JSON.stringify(error));
                }
            });
        }
    })

}

function editEvento(row) {

    let id = row.id.replace("editevento", "");

    window.location = "/eventosEdit/" + id;
}

function editImages(row) {

    let id = row.id.replace("editimages", "");

    $.ajax({
        method: "GET",
        url: url + "api/event/" + id,
        success: function(msg) {
            _id_evento_add_photo = msg["Message "]._id;
            current_images = msg["Message "].images;
            let images = msg["Message "].images;

            var html = '';
            var i;
            for (i = 0; i < images.length; i++) {
                html += '<tr>' +
                    '<td><img class="view_imagen" id="viewimagen' + images[i] + '" style="height: 70px; width: auto;" src="http://estrella.test/' + images[i] + '"</img></td>' +
                    '<td><button style="background: none; border: none; font-size: 20px;" class="eliminar_imagen" id="imagen' + images[i] + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button></td>' +
                    // '<td><button style="background: none; border: none;" class="eliminar_imagen" id="imagen' + images[i] + '"><i class="fas fa-trash" style="color: gray;"></i></button><button style="background: none; border: none;" class="view_imagen" id="viewimagen' + images[i] + '"><i class="fa fa-file" style="color: gray;"></i></button></td>' +
                    '</tr>';
            }
            $('#records_images_table').html(html);

            var el = document.querySelectorAll(".eliminar_imagen"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function() { deleteImagen(_id_evento_add_photo, el[j], images) };

            }

            var elEdit = document.querySelectorAll(".view_imagen"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function() { viewImagen(elEdit[j]) };

            }

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });
}


function changeState(row) {

    let estado = false;

    if (!row.checked) {
        estado = false;
    } else {
        estado = true;
    }

    console.log(row);
    console.log(estado);
    $.ajax({
        method: "PUT",
        url: url + "api/event/" + row.id.replace('evento', ''),
        data: { state: estado },
        success: function(msg) {

            // window.location = "/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + estado + "/" + login + "/" + tipousuario + "/" + permiso;
            location.reload();
            return alert('success', 'Estado modificado exitosamente', "");

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });
}

function deleteImagen(_id, row, images) {

    let nombre = row.id.replace("imagen", "");
    // window.location = "/eventosEdit/" + id;
    images = images.filter(obj => obj != nombre);

    $.ajax({
        method: "PUT",
        url: url + "api/event/" + _id,
        data: { images: images },
        success: function(msg) {

            // window.location = "/session/profile/" + token + "/" + _id + "/" + nombre + "/" + apellido + "/" + correo + "/" + estado + "/" + login + "/" + tipousuario + "/" + permiso;
            location.reload();
            return alert('success', 'Evento modificado exitosamente', "");

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    // window.location = "/eventosEdit/" + id;

}

function viewImagen(row) {

    let nombre = row.id.replace("imagen", "");
    console.log(nombre);

    // window.location = "/eventosEdit/" + id;

}