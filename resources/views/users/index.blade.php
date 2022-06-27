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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="bodyData">
            </tbody>
        </table>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script>
        $(document).ready(function(){
            var url = "{{URL('userData')}}";
    $.ajax({
    url: "/userData/getUserData",
    type: 'POST',
    data: {
    _token: '{{ csrf_token() }}'
    },
    cache: false,
    dataType: 'json',
    success: function(dataResult) {
    console.log(dataResult);
    var resultData = dataResult.data;
    var bodyData = '';
    var i=1;
    $.each(resultData, function(index,row){
    var editUrl = url+'/'+row.id+'/edit';
    bodyData+='<tr>'
        bodyData+='<td>'+ i++ +'</td>
        <td>'+row.name+'</td>
        <td>'+row.email+'</td>
        <td><a> class="btn btn-primary btn-sm" href="'+editUrl+"'>Edit</a>'
            +"<button class='btn btn-danger delete' value='"+row.id+"' style='margin-left:20px;'>Delete</button></td>";
        bodyData+="
    </tr>";
    })
    $("#bodyData").append(bodyData);
    }
    });


    $(document).on("click", ".delete", function() {
    var $ele = $(this).parent().parent();
    var id= $(this).val();
    var url = "{{URL('userData')}}";
    var dltUrl = url+"/"+id;
    $.ajax({
    url: dltUrl,
    type: "DELETE",
    cache: false,
    data:{
    _token:'{{ csrf_token() }}'
    },
    success: function(dataResult){
    var dataResult = JSON.parse(dataResult);
    if(dataResult.statusCode==200){
    $ele.fadeOut().remove();
    }
    }
    });
    });

    });
    </script> --}}



    {{-- Script ara index y eliminar --}}
    <script>
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
                        bodyData += "<td>" + i++ + "</td><td>" + row.name + "</td><td>" +
                            row.email +
                            "</td><td><a class='btn btn-primary btn-sm' href='" + editUrl +
                            "'>Edit</a>" +
                            "<button class='btn-sm btn btn-danger delete' value='" + row
                            .id + "' style='margin-left:20px;'>Delete</button></td>";
                        bodyData += "</tr>";

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

    </script>
</body>

</html>
