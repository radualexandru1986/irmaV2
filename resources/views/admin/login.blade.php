<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Irma</title>
    <style>
        body{
            background-size: cover;
            background-position: center;
        }

        button, .btn, input, .form-control, .card {
            border-radius:0;
        }

        .btn-indigo{
            background-color:#9561e2;
            color:white;
        }
    </style>
</head>
<body style="background-image:url({{asset('images/main.jpg')}}) ">
<div class="container-fluid m-0 p-0 d-flex justify-content-end ">
    <div class="card col-lg-5 col-sm-12 col-md-6 col-xl-3 vh-100">
        <div class="card-body py-5">
            <h2 class="card-title text-center">Admin</h2>
            <form class="mx-auto w-75 my-5">
                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input type="email" class="form-control form-control-lg" autofocus>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-indigo btn-lg" type="button">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
