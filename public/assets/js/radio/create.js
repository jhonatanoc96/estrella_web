let url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/";

let images = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {

    $("#btnSubmitEmisora").click(function (e) {
        let form = document.getElementById("frmEmisora");

        let nombre = document.getElementById("nameCreate").value;
        let urlEmisora = document.getElementById("urlCreate").value;
        let imagen = document.getElementById("file").value;


        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!urlEmisora || urlEmisora == "")
            return alert('error', 'Oops...', 'La URL de la emisora es obligatoria.');

        if (!imagen)
            return alert('error', 'Oops...', 'Debe seleccionar una foto.');

        $.ajax({
            method: "POST",
            url: url + "api/create-radio",
            data: {
                url: urlEmisora,
                state: true,
                name: nombre,
                url_image: imagen,
            },
            success: function (msg) {
                console.log("MSG", msg);
                $("<input />").attr("type", "hidden").attr("name", "_id").attr("value", msg.result._id).appendTo(form);
                form.submit(function (e) { });
                return alert('success', 'Emisora creada exitosamente', "");
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