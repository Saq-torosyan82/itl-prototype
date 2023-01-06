@extends("layouts.guest")
@section("content")
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 mt-3">
        <div class="container-fluid">
            @include('components.employer-registration');
        </div>
        <!-- Google script for recaptcha -->
        <script src="https://www.google.com/recaptcha/api.js"></script>
    </body>
@endsection
