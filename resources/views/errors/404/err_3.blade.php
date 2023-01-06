<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        .cover {
            background-image: url({{asset('assets/images/404/404_3.png')}}); background-repeat: no-repeat; background-position: center center; background-attachment: fixed; background-size: cover;
        }
        .block {position: absolute;  left: 50%; margin-left: -35rem;  width: 39rem; height: 4rem; top: calc(50% - 1rem););
        }
    </style>
</head>

<body class="cover">

<div class="block" >


        <a href="{{route('welcome')}}">
            <button style="background-color: transparent; border-color: transparent; height: 70px;" class="btn btn-md btn-block btn-primary waves-effect waves-light font-20" type="button">
                &nbsp;
            </button>
        </a>

</div>

</body>


</html>