<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        .cover {
            background-image: url('/assets/images/404/404_{{rand(1,2)}}.png'); background-repeat: no-repeat; background-position: center center; background-attachment: fixed; background-size: cover;
        }
        .block {position: absolute; left: 50%; margin-left: -20rem; width: 40rem; height: 12rem; top: calc(50% - 6rem);
        }
    </style>
</head>

<body class="cover">

    <div class="block alert alert-danger" >
        <p class="text-center mt-lg-4 font-16">We recieved several applications for this page, but we’re still hiring</p>
        <p class="text-center mt-lg-4">
            <a href="{{route('welcome')}}">
                <button class="btn btn-md btn-block btn-primary waves-effect waves-light font-20" type="button">
                    Go Back
                </button>
            </a>
        </p>
    </div>

</body>


</html>