<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $siteSettings['site_name'] ?? 'JobFinder' }} Admin Panel</title>


    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- Admin CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >

</head>


<body>


    <!-- =========================
         ADMIN SIDEBAR
    ========================== -->

    @include('admin.layouts.slidebar')



    <!-- =========================
         ADMIN CONTENT WRAPPER
    ========================== -->

    <div class="admin-wrapper">


        <!-- =========================
             ADMIN NAVBAR
        ========================== -->

        @include('admin.layouts.navbar')



        <!-- =========================
             PAGE CONTENT
        ========================== -->

        <main class="admin-main">

            @yield('content')

        </main>


    </div>



</body>

</html>