<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- Button trigger modal -->
        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal">
            Nuevo usuario
        </a>
        <table class="table" id="tableUser">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="bodyData">
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            <!-- User Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="userForm">
                                {{-- @csrf --}}
                                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                                    <small class="text-danger" id="nameError"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                    <small class="text-danger" id="emailError"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="text-danger" id="passError"></small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="butsave">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $('#userForm').submit(function(e){
        e.preventDefault();

        let _token = $('#csrf').val();
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();

        $.ajax({
            url: "{{route('save-user')}}",
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                _token: _token,
            },
            success: function(response)
            {
                if(response)
                {
                    $('#tableUser tbody').prepend('<tr><td>'+response.name+'</td><td>'+response.email+'</td><td></td></tr>');
                    $('#userForm')[0].reset();
                    $('#userModal').modal('hide');
                }
            }
        });
    });
</script>


    {{-- Script ara index y eliminar con ajax normal sin modal --}}
    {{-- <script>
        $(document).ready(function () {
            var url = "{{URL('userData')}}";
    $.ajax({
    url: "/userData/getUserData",
    type: "POST",
    data: {
    _token: '{{ csrf_token() }}'
    },
    cache: false,
    dataType: 'json',
    success: function (dataResult) {
    console.log(dataResult);
    var resultData = dataResult.data;
    var bodyData = '';
    var i = 1;
    $.each(resultData, function (index, row) {
    var editUrl = url + '/' + row.id + "/edit";
    bodyData += "<tr>"
        bodyData += "<td>" + i++ + "</td>
        <td>" + row.name + "</td>
        <td>" +
            row.email +
            "</td>
        <td><a class='btn btn-primary btn-sm' href='" + editUrl +
                            "'>Edit</a>" +
            "<button class='btn-sm btn btn-danger delete' value='" + row
                            .id + "' style='margin-left:20px;'>Delete</button></td>";
        bodyData += "
    </tr>";

    })
    $("#bodyData").append(bodyData);
    }
    });


    $(document).on("click", ".delete", function () {
    var $ele = $(this).parent().parent();
    var id = $(this).val();
    var url = "{{URL('userData')}}";
    var dltUrl = url + "/" + id;
    $.ajax({
    url: dltUrl,
    type: "DELETE",
    cache: false,
    data: {
    _token: '{{ csrf_token() }}'
    },
    success: function (dataResult) {
    var dataResult = JSON.parse(dataResult);
    if (dataResult.statusCode == 200) {
    $ele.fadeOut().remove();
    }
    }
    });
    });

    });

    </script> --}}
</body>

</html>
