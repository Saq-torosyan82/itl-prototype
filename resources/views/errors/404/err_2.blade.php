<html>
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>

<body>
    <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%); font-family: Montserrat,sans-serif">
        <figure class="figure text-center">
            @if (rand(1,2) == 1)
                <img src="{{asset('/assets/images/404/404.svg')}}"/>
            @else
                <img src="{{asset('/assets/images/404/404.png')}}"/>
            @endif
            <figcaption class="figure-caption text-center mt-lg-4 font-16">We recieved several applications for this page, but we’re still hiring</figcaption>
        </figure>
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