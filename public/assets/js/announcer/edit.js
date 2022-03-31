// let url = "http://localhost:8080/";
let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";

let current_url_image = "";

$(document).ready(function () {


    let formMainPhotoAnnouncer = document.getElementById("formMainPhotoAnnouncer");
    let formEditAnnouncer = document.getElementById("formEditAnnouncer");

    current_url_image = message.url_image;
    let diasUsuario = [];
    diasUsuario = message.days;

    // for (let i = 0; i < message.images.length; i++) {
    //     const divPhoto = document.createElement('div');
    //     divPhoto.setAttribute("class", "photo");
    //     const img = document.createElement('img');
    //     img.setAttribute("src", "http://estrella.test/" + message.images[i]);
    //     img.setAttribute("class", "center");
    //     divPhoto.appendChild(img);
    //     document.querySelector("#images").appendChild(divPhoto);
    // }

    $("input:checkbox[name=daysEdit]").each(function () {
        if (diasUsuario.includes($(this)[0].id)) {
            $(this)[0].checked = true;
        }
    });

    $("#guardarEditLocutor").click(function (e) {
        //Ocultar botón para eliminar foto que se cargó 

        let nombre = document.getElementById("name").value;
        let apellido = document.getElementById("lastname").value;
        let descripcion = document.getElementById("description").value;
        let url_image_temp = "";
        let url_audio_temp = "";

        if (message.new_url_image && message.new_url_image != "") {
            url_image_temp = message.new_url_image;
        } else {
            url_image_temp = message.url_image;
        }

        // if (message.new_url_image && message.new_url_image != "") {
        //     url_image_temp = message.new_url_image;
        // } else {
        //     url_image_temp = message.url_image;
        // }

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "lastname").attr("value", apellido).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", url_image_temp).appendTo(formEditAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", message._id).appendTo(formEditAnnouncer);
        formEditAnnouncer.submit(function (e) { });

    });

    //Cuando se cancela la foto nueva para foto principal del evento
    $("#closeAudioAnnouncer").click(function () {

        let nombre = document.getElementById("name").value;
        let apellido = document.getElementById("name").value;
        let descripcion = document.getElementById("description").value;

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "lastname").attr("value", apellido).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", message.url_image).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", message._id).appendTo(formMainPhotoAnnouncer);
        formMainPhotoAnnouncer.submit(function (e) { });
    });

    //Cuando se carga una foto nueva para foto principal del evento
    $("#audioAnnouncer").change(function () {
        // document.getElementById("closeMainPhotoAnnouncer").style.display = "block";

        let nombre = document.getElementById("name").value;
        let apellido = document.getElementById("lastname").value;
        let descripcion = document.getElementById("description").value;

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "lastname").attr("value", apellido).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", message.url_image).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", message._id).appendTo(formMainPhotoAnnouncer);
        formMainPhotoAnnouncer.submit(function (e) { });


    });

    //Cuando se cancela la foto nueva para foto principal del evento
    $("#closeMainPhotoAnnouncer").click(function () {

        let nombre = document.getElementById("name").value;
        let apellido = document.getElementById("name").value;
        let descripcion = document.getElementById("description").value;

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "lastname").attr("value", apellido).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", message.url_image).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", message._id).appendTo(formMainPhotoAnnouncer);
        formMainPhotoAnnouncer.submit(function (e) { });
    });

    //Cuando se carga una foto nueva para foto principal del evento
    $("#mainPhotoAnnouncer").change(function () {
        // document.getElementById("closeMainPhotoAnnouncer").style.display = "block";

        let nombre = document.getElementById("name").value;
        let apellido = document.getElementById("lastname").value;
        let descripcion = document.getElementById("description").value;

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "lastname").attr("value", apellido).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", message.url_image).appendTo(formMainPhotoAnnouncer);
        $("<input />").attr("type", "hidden").attr("name", "_id_announcer").attr("value", message._id).appendTo(formMainPhotoAnnouncer);
        formMainPhotoAnnouncer.submit(function (e) { });


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