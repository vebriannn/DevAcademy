<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="stylesheet" href="{{asset('nemolab/assets/css/components/navback.css')}} ">
  <link rel="stylesheet" href="{{asset('nemolab/assets/css/components/footer.css')}} ">
  <link rel="stylesheet" href="{{asset('nemolab/assets/css/superadmin-data.css')}} ">
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div id="content">
        @include('components.includes.navbar.navback')

        @yield('content-data-mentor')
        @yield('content-data-super-admin')
        @yield('content--data-pengajuan-mentor')
        @yield('content-data-course')
        @yield('content-data-category')
        @yield('content-data-chapter')
        @yield('content-data-course-admin')
        @yield('content-data-lessson')
        @yield('content-data-mentor')
        @yield('content-data-pengajuan-mentor')
        @yield('content-data-superadmin')
        @yield('content-data-member')
        @yield('content-courses-table-mentor')
    
        @include('components.includes.footer')
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const profileDiv = document.getElementById("profileMenu");
        const profileImg = document.getElementById("myProfile");

        profileImg.addEventListener("click", function () {
          profileDiv.classList.toggle("menu");
        });
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>