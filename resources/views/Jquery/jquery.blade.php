<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}">
</head>
<body>

<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                <div class="title m-b-md" id="heading">
                    Laravel
                </div>
                <button type="button" id="change-text">Click</button>
            </div>
            <div id="image"></div>

            <form method="post">
                <input type="text" name="name" id="name" class="form-control">
                <button type="button" class="btn btn-primary save-btn">Save</button>
            </form>
        </div>
      </div>
   </div>
</div>
<script>
$(document).ready(function(){
    load_image();

    $('#change-text').click(function(){
        $.get("{{route('jquery.ajax.get')}}", function(data, status){
            if(data)
            {
                $("#heading").html(data);
                console.log(status);
            }
        });
    });

    $('.save-btn').click(function(){
        let name = $('#name').val();
        let _token = "{{csrf_token()}}";
        $.post("{{route('jquery.ajax.post')}}", {
            name: name,_token:_token

        },function(data, status){
            if(data)
            {
                $("#heading").text(data);
                console.log(status);
            }
        });
    });


    function load_image(){
        $.get("{{route('jquery.ajax.image')}}", function(data, status){
            if(data)
            {
                $("#image").html(data);
                console.log(status);
            }
        });
    }

    
});

</script>   
</body>
</html>