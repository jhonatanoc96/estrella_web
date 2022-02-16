let url = "http://3.16.246.24:3010/";

let images = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {

    $("#btnSubmit").click(function(e) {
        let form = document.getElementById("frm");

        let nombre = document.getElementById("nameCreate").value;
        let descripcion = document.getElementById("descriptionCreate").value;
        let dias = [];
        let hora_inicial = document.getElementById("input_starttime").value;
        let hora_final = document.getElementById("input_endtime").value;
        let archivos = document.getElementById("files").value;

        $("input:checkbox[name=days]:checked").each(function() {
            dias.push($(this)[0].id);
        });

        if (!nombre || nombre == "")
            return alert('error', 'Oops...', 'El nombre es obligatorio.');

        if (!descripcion || descripcion == "")
            return alert('error', 'Oops...', 'La descripcion es obligatoria.');

        if (!dias || dias.length == 0)
            return alert('error', 'Oops...', 'Los días son obligatorios.');

        if (!hora_inicial || hora_inicial == '')
            return alert('error', 'Oops...', 'La hora inicial es obligatoria.');

        if (!hora_inicial || hora_final == '')
            return alert('error', 'Oops...', 'La hora final es obligatoria.');

        if (hora_inicial > hora_final)
            return alert('error', 'Oops...', 'La hora inicial no puede ser mayor que la hora final.');

        if (!archivos)
            return alert('error', 'Oops...', 'Debe subir al menos una foto.');

        $.ajax({
            method: "POST",
            url: url + "api/create-event",
            data: {
                name: nombre,
                // url_image: "JSON.stringify(images[0])",
                description: descripcion,
                start_time: hora_inicial,
                end_time: hora_final,
                days: dias,
                // images: "[images, asdasd]",
                state: true
            },
            success: function(msg) {
                console.log("MSG", msg);
                // return alert('success', 'Evento creado exitosamente', "");
                $("<input />").attr("type", "hidden").attr("name", "_id").attr("value", msg.result._id).appendTo(form);
                $("<input />").attr("type", "hidden").attr("name", "date").attr("value", msg.result.creation_date).appendTo(form);
                form.submit(function(e) {});

            },
            error: function(error) {
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