// let url = "http://localhost:8080/";
let url = "http://3.16.246.24:3010/";


$(document).ready(function() {

    let formMainPhoto = document.getElementById("formMainPhoto");

    let current_url_image = message.url_image;
    let diasUsuario = [];
    diasUsuario = message.days;

    for (let i = 0; i < message.images.length; i++) {
        const divPhoto = document.createElement('div');
        divPhoto.setAttribute("class", "photo");
        const img = document.createElement('img');
        img.setAttribute("src", "http://estrella.test/" + message.images[i]);
        img.setAttribute("class", "center");
        divPhoto.appendChild(img);
        document.querySelector("#images").appendChild(divPhoto);
    }

    $("input:checkbox[name=daysEdit]").each(function() {
        if (diasUsuario.includes($(this)[0].id)) {
            $(this)[0].checked = true;
        }
    });

    $("#guardarEditEvento").click(function(e) {
        let dias = [];

        $("input:checkbox[name=daysEdit]:checked").each(function() {
            dias.push($(this)[0].id);
        });

    });

    $("#mainPhoto").change(function() {

        let nombre = document.getElementById("name").value;
        let descripcion = document.getElementById("description").value;
        let dias = [];
        let hora_inicial = document.getElementById("input_starttime_edit").value;
        let hora_final = document.getElementById("input_endtime_edit").value;

        $("input:checkbox[name=daysEdit]:checked").each(function() {
            dias.push($(this)[0].id);
        });

        $("<input />").attr("type", "hidden").attr("name", "creation_date").attr("value", message.creation_date).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "days").attr("value", dias).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "description").attr("value", descripcion).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "end_time").attr("value", hora_final).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "start_time").attr("value", hora_inicial).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "images").attr("value", message.images).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "name").attr("value", nombre).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "state").attr("value", message.state).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "update_date").attr("value", message.update_date).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "url_image").attr("value", message.url_image).appendTo(formMainPhoto);
        $("<input />").attr("type", "hidden").attr("name", "_id_event").attr("value", message._id).appendTo(formMainPhoto);
        formMainPhoto.submit(function(e) {});
        // $.post("/store-main-photo", { value: "buttonclicked" })
        //     .done(function(data) {
        //         //write your code after success
        //     });

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