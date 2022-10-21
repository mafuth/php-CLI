<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title><?php echo  $config['appname']; ?></title>
    <style>
        .card{
            margin-top: 22vh;
            background: rgba(36, 36, 36, 0.60);
            border-radius: 16px;
            backdrop-filter: blur(4.7px);
            -webkit-backdrop-filter: blur(4.7px);
            color:white;
        }

    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3 mb-3 text-center">
                            <h1>Welcome to php-CLI</h1>
                            <p>This is the default index page. Replace this with you code!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3 mb-3 text-center">
                            <h1>Any contributions you make are greatly appreciated.</h1>
                            <p>If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>