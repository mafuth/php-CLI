<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>{{$config['appname']}}</title>
    <style>
        .card{
            margin-top: 22vh;
            background: rgba(36, 36, 36, 0.60);
            border-radius: 16px;
            backdrop-filter: blur(4.7px);
            -webkit-backdrop-filter: blur(4.7px);
            color:white;
        }
        #nprogress{
            z-index: 99999;
        }
    </style>
</head>
<body class="bg-dark">
    @yield('contents')
</body>