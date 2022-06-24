<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div id="error-msg" class="alert alert-danger" style="display:none"></div>
        <form id="myForm">
            {{-- @csrf --}}
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="idUser" name="id" value="{{$userData->id}}" readonly>
                <small class="text-danger" id="nameError"></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$userData->name}}">
                <small class="text-danger" id="nameError"></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$userData->email}}">
                <small class="text-danger" id="emailError"></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-danger" id="passError"></small>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" id="update_data"
                value="{{ $userData->id }}">Actualizar</button>
            <a href="{{ route('userData.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/ajax.js')}}"></script>
    {{-- <script>
        $(document).ready(function () {

            $(document).on("click", "#update_data", function (e) {
                e.preventDefault();
                var url = "{{URL('userData/'.$userData->id)}}";
                var id =
                    $.ajax({
                        url: url,
                        type: "PATCH",
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}',
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

    </script> --}}
</body>

</html>
