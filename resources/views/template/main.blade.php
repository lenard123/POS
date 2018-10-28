<!DOCTYPE html>
<html>
<head>
    <title>Point Of Sale System :: @yield('title', '')</title>

    <!-- BootStrap CSS 4 Minified -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <!-- JQuery Minified -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Bootstrap JS 4 Minified -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>

@yield('nav')

<main class="py-4">
@yield('body')
</main>


@yield('script')
</body>
</html>