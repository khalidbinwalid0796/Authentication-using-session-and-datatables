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
                    JSON
                </div>
                <div id="data"></div>
            </div>
        </div>
      </div>
   </div>
</div>
<script>
    let customers = [
        {
            "name": "Mr. A",
            "email": "a@mail.com"
        },
        {
            "name": "Mr. B",
            "email": "b@mail.com"
        },
        {
            "name": "Mr. C",
            "email": "c@mail.com"
        }
    ];
    console.log(JSON.stringify(customers));
    // let converted = JSON.parse(customers);
    // console.log(JSON.parse(customers));
    // let html = '<ul>';
    // $.each(converted , function(key,value){
    //     html += '<li>'+value.name+'<br>'+value.email+'</li>';
    // });
    
    // html += '</ul>';
    
    // $('#data').append(html);
    </script>  
</body>
</html>