<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('prepend-style')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @stack('addon-script')
</head>

<body>
    <div id="content">
        {{-- content --}}
        @yield('content')
    </div>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <script src="{{ asset('nemolab/components/admin/js/profile-navbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // input password
        var a;

        function pass() {
            if (a == 1) {
                document.getElementById("password").type = "password";
                document.getElementById("pass-icon").src = "nemolab/member/img/eye.png";
                a = 0;
            } else {
                document.getElementById("password").type = "text";
                document.getElementById("pass-icon").src = "nemolab/member/img/hidden.png";
                a = 1;
            }
        }
    </script>
    @stack('addon-script')

</body>

</html>
