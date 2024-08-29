<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nemolab | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @stack('addon-style')
</head>

<body>

    <div id="content">
        @include('components.includes.member.navbar-play')

        @yield('content')

        @include('components.includes.member.footer')

        {{-- include sweetalert --}}
        @include('sweetalert::alert')
    </div>

    @stack('prepend-script')
    {{-- <script src="{{ asset('nemolab/assets/js/profile-navbar.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('addon-style')
</body>

</html>
