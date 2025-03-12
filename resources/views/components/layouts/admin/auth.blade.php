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
    <link rel="icon" href="{{ asset('nemolab/member/img/logo-devacademy.png') }}" type="image/x-icon" />
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // input password
        var a;

        function pass() {
            const passwordField = document.getElementById("password");
            const passIcon = document.getElementById("pass-icon");
            const currentSrc = passIcon.src;

            // Menghapus "/admin" dari URL jika ada
            const newSrc = currentSrc.replace('/admin', '');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passIcon.src = newSrc.replace('eye.png', 'hidden.png');
            } else {
                passwordField.type = "password";
                passIcon.src = newSrc.replace('hidden.png', 'eye.png');
            }
        }
    </script>
    @stack('addon-script')

</body>

</html>
