let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";
let _id_contest_add_photo = "";
let idContestSelectedToEdit = "";
let id_contest_selected = "";
let current_images = [];

$(document).ready(function () {
    var contests_true = [];
    let formAddPhotoContest = document.getElementById("formAddPhotoContest");

    //Obtener todos los usuarios
    $.ajax({
        method: "GET",
        url: url + "api/contest",
        success: function (msg) {
            var html = '';
            var i;
            for (i = 0; i < [msg][0]["Message "].length; i++) {
                html += '<tr>' +
                    '<td><img style="height: 70px; width: auto;" src="http://estrella.test/' + [msg][0]["Message "][i]['url_image'] + '"</img><form id="formImgContest' + [msg][0]["Message "][i]._id + '" method="POST" action="/store-img-contest" enctype="multipart/form-data"><input type="file" id="imgContest' + [msg][0]["Message "][i]._id + '" name="imgContest" class="imgContest" data-button=""></form></td>' +
                    // '<td><img style="height: 70px; width: auto;" src="http://estrella.test/' + [msg][0]["Message "][i]['url_image'] + '"</img><form id="formImgContest' + [msg][0]["Message "][i]._id + '" method="POST" action="/store-img-radio" enctype="multipart/form-data"><input type="file" id="imgContest' + [msg][0]["Message "][i]._id + '" name="imgContest" class="imgContest" data-button=""></form></td>' +
                    '<td>' + [msg][0]["Message "][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "][i].description + '</td>' +
                    '<td><label class="switch"><input type="checkbox" class="check_state" id="contest' + [msg][0]["Message "][i]._id + '"><span class="slider round"></span></label> </td>' +
                    '<td><button data-toggle="modal" data-target="#exampleModalEdit" style="background: none; border: none;" class="editar_contest" id="editcontest' + [msg][0]["Message "][i]._id + '"><i class="fas fa-edit" style="color: gray;"></i></button><button data-toggle="modal" data-target="#exampleModal" style="background: none; border: none;" class="edit_images_contest" id="editimagescontest' + [msg][0]["Message "][i]._id + '"><i class="fa fa-file" style="color: gray;"></i></button><button data-toggle="modal" data-target="#exampleModalCompetitors" style="background: none; border: none;" class="viewCompetitors" id="viewCompetitors' + [msg][0]["Message "][i]._id + '"><i class="fa fa-users" style="color: gray;"></i></button></td>' +
                    '</tr>';

                if ([msg][0]["Message "][i].state) {
                    contests_true.push([msg][0]["Message "][i]._id);
                }
            }
            $('#records_table').html(html);

            var el = document.querySelectorAll(".check_state"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { changeState(el[j]) };
                //Comprobar estado actual
                if (contests_true.includes(el[i].id.replace('contest', ''))) {
                    el[i].checked = true;
                } else {
                    el[i].checked = false;

                }
            }

            // var el = document.querySelectorAll(".eliminar_contest"); // this element contains more than 1 DOMs.
            // for (var i = 0; i < el.length; i++) {
            //     let j = i;
            //     el[i].onclick = function() { deletecontest(el[j]) };

            // }

            var elEdit = document.querySelectorAll(".editar_contest"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEdit.length; i++) {
                let j = i;
                elEdit[i].onclick = function () { editContest(elEdit[j]) };

            }

            var elEditImages = document.querySelectorAll(".edit_images_contest"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elEditImages.length; i++) {
                let j = i;
                elEditImages[i].onclick = function () { editImages(elEditImages[j]) };
            }

            var elviewCompetitors = document.querySelectorAll(".viewCompetitors"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elviewCompetitors.length; i++) {
                let j = i;
                elviewCompetitors[i].onclick = function () { viewCompetitors(elviewCompetitors[j]) };
            }


            var elImg = document.querySelectorAll(".imgContest"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elImg.length; i++) {
                let j = i;
                elImg[i].onclick = function () { updateImgContest(elImg[j]) };

            }

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    //Cuando se carga una foto nueva para foto principal del contest
    $("#addPhotoContest").change(function () {
        $("<input />").attr("type", "hidden").attr("name", "id_contest").attr("value", _id_contest_add_photo).appendTo(formAddPhotoContest);
        $("<input />").attr("type", "hidden").attr("name", "current_images_contest").attr("value", current_images).appendTo(formAddPhotoContest);

        formAddPhotoContest.submit(function (e) { });
    });

    //Editar emisora
    $("#guardarEditarConcurso").click(function () {

        let nombre = document.getElementById("nameEditContest").value;
        let descripcion = document.getElementById("descripcionEditContest").value;

        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!descripcion || descripcion == "")
            return alert('error', 'Oops...', 'La URL de la emisora es obligatoria.');

        $.ajax({
            method: "PUT",
            url: url + "api/contest/" + idContestSelectedToEdit,
            data: { name: nombre, description: descripcion },
            success: function (msg) {

                location.reload();
                return alert('success', 'Concurso modificado exitosamente', "");

            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });
    });


    $("#exportContestExcel").click(function () {
        window.location = "/generate-excel-contests/" + id_contest_selected;
    });


});


function editContest(row) {
    idContestSelectedToEdit = row.id.replace('editcontest', '');

    $.ajax({
        method: "GET",
        url: url + "api/contest/" + row.id.replace('editcontest', ''),
        success: function (msg) {
            document.getElementById("nameEditContest").value = msg['Message ']['name'];
            document.getElementById("descripcionEditContest").value = msg['Message ']['description'];
        },
        error: function (error) {
        }
    });

}

function updateImgContest(row) {
    let id = row.id.replace('imgContest', '');
    _id_contest_add_photo = id;

    let formImgContest = document.getElementById("formImgContest" + id);

    $("#imgContest" + id).change(function () {
        $("<input />").attr("type", "hidden").attr("name", "_id_contest").attr("value", id).appendTo(formImgContest);
        formImgContest.submit(function (e) { });

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

function deleteContest(row) {

    let id = row.id.replace("contest", "");

    Swal.fire({
        title: '¿Estás seguro que deseas borrar este concurso?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: 'Cancelar',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        console.log(result);
        if (!result.value) {
            Swal.fire('', 'No se ha eliminado el concurso', 'info');

        } else {
            $.ajax({
                method: "DELETE",
                url: url + "api/contest/" + id,
                success: function (msg) {
                    Swal.fire('', 'Concurso eliminado exitosamente', 'success');
                    location.reload();
                },
                error: function (error) {
                    return alert('error', 'Oops...', JSON.stringify(error));
                }
            });
        }
    })

}

function editConcurso(row) {

    let id = row.id.replace("editcontest", "");

    window.location = "/contestEdit/" + id;
}

function editImages(row) {

    let id = row.id.replace("editimagescontest", "");

    $.ajax({
        method: "GET",
        url: url + "api/contest/" + id,
        success: function (msg) {
            _id_contest_add_photo = msg["Message "]._id;
            current_images = msg["Message "].images;
            let images = msg["Message "].images;

            var html = '';
            var i;
            for (i = 0; i < images.length; i++) {
                html += '<tr>' +
                    '<td><img class="view_imagen" id="imgContest' + images[i] + '" style="height: 70px; width: auto;" src="http://estrella.test/' + images[i] + '"</img></td>' +
                    '<td><button style="background: none; border: none; font-size: 20px;" class="eliminar_imagen_contest" id="imagenContest' + images[i] + '"><i class="fas fa-trash" style="color: gray; text-align: right;"></i></button></td>' +
                    // '<td><button style="background: none; border: none;" class="eliminar_imagen" id="imagen' + images[i] + '"><i class="fas fa-trash" style="color: gray;"></i></button><button style="background: none; border: none;" class="view_imagen" id="viewimagen' + images[i] + '"><i class="fa fa-file" style="color: gray;"></i></button></td>' +
                    '</tr>';
            }
            $('#records_images_table_contest').html(html);

            var el = document.querySelectorAll(".eliminar_imagen_contest"); // this element contains more than 1 DOMs.
            for (var i = 0; i < el.length; i++) {
                let j = i;
                el[i].onclick = function () { deleteImagen(_id_contest_add_photo, el[j], images) };

            }


            var elImg = document.querySelectorAll(".imgContest"); // this element contains more than 1 DOMs.
            for (var i = 0; i < elImg.length; i++) {
                let j = i;
                elImg[i].onclick = function () { updateImg(elImg[j]) };

            }
        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });
}

function viewCompetitors(row) {

    id_contest_selected = row.id.replace("viewCompetitors", "");

    $.ajax({
        method: "GET",
        url: url + "api/contest/" + id_contest_selected,
        success: function (msg) {

            var html = '';
            var i;
            for (i = 0; i < msg['Message ']['competitor'].length; i++) {
                html += '<tr>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].lastname + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].tel + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].email + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].neighborhood + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].birth_date + '</td>' +
                    '</tr>';


                html += '<tr>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].name + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].lastname + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].tel + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].country + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].department + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].city + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].neighborhood + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].email + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].occupation + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].birth_date + '</td>' +
                    '<td>' + [msg][0]["Message "]['competitor'][i].creation_date + '</td>' +
                    '</tr>';
            }
            $('#records_images_table_contest_competitors').html(html);

        },
        error: function (error) {
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
        url: url + "api/contest/" + row.id.replace('contest', ''),
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

function deleteImagen(_id, row, images) {

    let nombre = row.id.replace("imagenContest", "");

    // window.location = "/contestEdit/" + id;
    images = images.filter(obj => obj != nombre);

    $.ajax({
        method: "PUT",
        url: url + "api/contest/" + _id,
        data: { images: images },
        success: function (msg) {

            location.reload();
            return alert('success', 'Concurso modificado exitosamente', "");

        },
        error: function (error) {
            return alert('error', 'Oops...', JSON.stringify(error));
        }
    });


    // window.location = "/contestEdit/" + id;

}

function viewImagen(row) {

    let nombre = row.id.replace("imagen", "");
    console.log(nombre);

    // window.location = "/contestEdit/" + id;

}