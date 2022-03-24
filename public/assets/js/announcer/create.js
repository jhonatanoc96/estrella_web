let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";

let images = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {

    $("#btnSubmitLocutor").click(function (e) {
        let form = document.getElementById("frmLocutor");

        let nombre = document.getElementById("nameCreate").value;
        let apellido = document.getElementById("lastnameCreate").value;
        let descripcion = document.getElementById("descriptionCreate").value;
        let imagen = document.getElementById("file").value;
        let audio = document.getElementById("audioLocutor").value;


        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!apellido || apellido == "")
            return alert('error', 'Oops...', 'El apellido es obligatorio.');

        if (!imagen)
            return alert('error', 'Oops...', 'Debe seleccionar una foto.');

        if (!audio)
            return alert('error', 'Oops...', 'Debe seleccionar un audio.');

        $.ajax({
            method: "POST",
            url: url + "api/create-announcer",
            data: {
                name: nombre,
                last_name: apellido,
                description: descripcion || "",
                url_image: imagen,
                url_audio: audio,
                state: true,
            },
            success: function (msg) {
                console.log("MSG", msg);
                $("<input />").attr("type", "hidden").attr("name", "_id").attr("value", msg["Message "]._id).appendTo(form);
                form.submit(function (e) { });
                return alert('success', 'Locutor creado exitosamente', "");
            },
            error: function (error) {
                return alert('error', 'Oops...', JSON.stringify(error));
            }
        });

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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