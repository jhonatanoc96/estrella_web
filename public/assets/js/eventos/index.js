let url = "http://3.16.246.24:3010/";

$(document).ready(function() {
    var events_true = [];

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
                    '<td><button style="background: none; border: none;" class="editar_evento" id="editevento' + [msg][0]["Message "][i]._id + '"><i class="fas fa-edit" style="color: gray;"></i></button></td>' +
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