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
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="bodyData">
                @foreach ($users as $user)
                <tr id="userid{{$user->id}}">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editUser({{$user->id}})">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- User Modal Create-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        {{-- <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> --}}
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
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

        <!-- User Modal Edit-->
        <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userEditForm">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            {{-- <input type="hidden" name="_token" id="csrfEdit" value="{{Session::token()}}"> --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nameEdit" name="name">
                                <small class="text-danger" id="nameError"></small>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="emailEdit" name="email">
                                <small class="text-danger" id="emailError"></small>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordEdit" name="password">
                                <small class="text-danger" id="passError"></small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" id="butsaveEdit">Actualizar</button>
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
    {{-- Script for create and index --}}
    <script>
        $('#userForm').submit(function(e){
            e.preventDefault();
    
            let _token = $('input[name=_token]').val();
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
                        $('#tableUser tbody').prepend('<tr><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.email+'</td><td><a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editUser('+response.id+')">Editar</a></td></tr>');
                        $('#userForm')[0].reset();
                        $('#userModal').modal('hide');
                    }
                }
            });
        });
    </script>

    {{-- Script for modal edit --}}
    <script>
        function editUser(id)
        {
            $.get('/userData/'+id+'/edit/', function(user){
                $('#id').val(user.id);
                $('#nameEdit').val(user.name);
                $('#emailEdit').val(user.email);
                $('#passwordEdit').val(user.password);
                $('#userEditModal').modal('toggle');
                console.log(user);
            });
        }

        $('#userEditForm').submit(function(e){
            e.preventDefault();
            
            let id = $('#id').val();
            let _token = $('input[name=_token]').val();
            let name = $('#nameEdit').val();
            let email = $('#emailEdit').val();
            let password = $('#passwordEdit').val();

            $.ajax({
                url:  '/userUpdate',
                type: 'PUT',
                data: {
                        id: id,
                        name: name,
                        email: email,
                        password: password,
                        _token: _token,
                },
                success: function(response){
                    $('#userid' + response.id + ' td:nth-child(2)').text(response.name);
                    $('#userid' + response.id + ' td:nth-child(3)').text(response.email);
                    $('#userEditModal').modal('toggle');
                    $('#userEditForm')[0].reset();
                    console.log(response);
                }
            });
        });
    </script>
</body>

</html>
