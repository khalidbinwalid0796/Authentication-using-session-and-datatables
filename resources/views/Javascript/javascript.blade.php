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
            <div class="card-header">{{ __('Javascript With Ajax') }}</div>

            <div class="card-body">
                <div class="title m-b-md" id="heading">
                    Laravel
                </div>
                <button type="button" onclick="changeText()">Click</button>
            </div>
            <div id="image"></div>

            <form method="post">
                <input type="text" name="name" id="name" class="form-control">
                <button type="button" class="btn btn-primary" onclick="ajaxPost()">Save</button>
            </form>
        </div>
      </div>
   </div>
</div>
<script>
    get_image();
    function changeText(){
        //object create
        let req = new XMLHttpRequest();
        //open(get/post, url, asycn(true/false))
        req.open('GET','{{route("ajax.get")}}',true);
        req.send();

        //now requset get
        req.onreadystatechange = function(){
            console.log(req);
            //(readyState == 4)->readyState a 4 ta state process hoyear por
            if(req.readyState == 4 && req.status == 200){
                document.getElementById('heading').innerHTML = req.responseText;
            }
        }
    }
    function ajaxPost(){
        let name = document.getElementById('name').value;
        // if(name){
            let req = new XMLHttpRequest();
            req.open('POST','{{route("ajax.post")}}',true);
            req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            req.send('name='+name+'&_token={{ csrf_token() }}');
            //token must pathate hobe
            req.onreadystatechange = function(){
                console.log(req);
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('heading').innerHTML = req.responseText;
                }
            // }
        }
       
    }
    function get_image() {
        let req = new XMLHttpRequest();
        req.open('GET','{{url("image")}}',true);
        req.send();

        req.onreadystatechange = function(){
            console.log(req);
            if(req.readyState == 4 && req.status == 200){
                document.getElementById('image').innerHTML = req.response;
            }
        }

    }



</script>   
</body>
</html>