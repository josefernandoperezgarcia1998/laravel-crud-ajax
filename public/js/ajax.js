$(document).ready(function () {
    $('#butsave').on('click', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        if (name != "" && email != "" && password != "") {
            /*  $("#butsave").attr("disabled", "disabled"); */
            $.ajax({
                url: "/userData",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    type: 1,
                    name: name,
                    email: email,
                    password: password,
                },
                cache: false,
                success: function (dataResult) {
                    alert('Registro guardado correctamente.');
                    if (dataResult.statusCode == 200) {
                        $('#myForm').trigger("reset");
                    } else if (dataResult.statusCode == 201) {
                        alert("A ocurrido un error!");
                    }
                    $('#myForm').trigger("reset");
                    $('#nameError').text('');
                    $('#emailError').text('');
                    $('#passError').text('');
                },
                error: function (response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#passError').text(response.responseJSON.errors.password);
                }
            });
        } else {
            alert('Por favor llene todos los campos!');
        }
    });
});



// Update
$(document).ready(function () {
    let idUser = $('#idUser').val();
    const url = window.location.origin,
        token = $('#csrf').val();
    $(document).on("click", "#update_data", function (e) {
        e.preventDefault();
        console.log(idUser);
        $.ajax({
            url: url + '/userData/' + idUser,
            type: "PATCH",
            cache: false,
            data: {
                _token: token,
                type: 3,
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            },
            success: function (dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode) {
                    // window.location = "/userData";
                    alert('actualizado');
                    $('#password').text('');
                } else {
                    alert("Internal Server Error");
                }

            }
        });
    });
});
