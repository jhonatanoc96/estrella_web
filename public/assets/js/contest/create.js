let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";

let images = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {

    $("#btnSubmitContest").click(function (e) {
        let form = document.getElementById("frmContest");

        let nombre = document.getElementById("nameCreateContest").value;
        let descripcion = document.getElementById("descriptionCreateContest").value;
        let archivos = document.getElementById("filesContest").value;

        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!descripcion || descripcion == "")
            return alert('error', 'Oops...', 'La descripcion es obligatoria.');

        if (!archivos)
            return alert('error', 'Oops...', 'Debe subir al menos una foto.');

        $.ajax({
            method: "POST",
            url: url + "api/create-contest",
            data: {
                name: nombre,
                // url_image: "JSON.stringify(images[0])",
                description: descripcion,
                state: true
            },
            success: function (msg) {
                // return alert('success', 'Evento creado exitosamente', "");
                $("<input />").attr("type", "hidden").attr("name", "_id").attr("value", msg.result._id).appendTo(form);
                $("<input />").attr("type", "hidden").attr("name", "date").attr("value", msg.result.creation_date).appendTo(form);
                form.submit(function (e) { });

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