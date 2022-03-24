let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_evento_add_photo = "";
let current_images = [];

$(document).ready(function() {
    var events_true = [];
    let formAddPhotoBanner = document.getElementById("formAddPhotoBanner");

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/bannerhome",
        success: function(msg) {
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td><img class="view_imagen" id="viewimagen' + [msg][0]["Message "][i]['url_image'] + '" style="height: 70px; width: auto;" src="http://estrella.test/' + [msg][0]["Message "][i]['url_image'] + '"</img></td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state_banner_event" id="bannerhome' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    '<td>' + [msg][0]["Message "][i].creation_date + '</td>' +
                    '<td><button style="background: none; border: none; font-size: 20px;" class="eliminar_imagen" id="bannerhome' + [msg][0]["Message "][i]._id + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    events_true.push([msg][0]["Message "][i]._id);
                }
            }

            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state_banner_event"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function() { changeState(el[j]) };
                //Comprobar estado actual
                if (events_true.includes(el[i].id.replace('bannerhome', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }
            }

            var el2 = document.querySelectorAll(".eliminar_imagen"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el2.length; i++) {
                let j = i;
                el2[i].onclick = function() { deleteImagen(el2[j]) };

            }

        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    //Cuando se carga una foto nueva para foto principal del evento
    $("#addPhoto").change(function() {
        formAddPhotoBanner.submit(function(e) {});
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

    console.log(row);
    console.log(estado);
    $.ajax({
        method: "PUT",
        url: url + "api/bannerhome/" + row.id.replace('bannerhome', ''),
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

function deleteImagen(row) {

    let id = row.id.replace("bannerhome", "");

    $.ajax({
        method: "DELETE",
        url: url + "api/bannerhome/" + id,
        success: function(msg) {
            location.reload();
            return alert('success', 'Imagen eliminada exitosamente', "");
        },
        error: function(error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


}

function viewImagen(row) {

    let nombre = row.id.replace("imagen", "");
    console.log(nombre);

    // window.location = "/eventosEdit/" + id;

}