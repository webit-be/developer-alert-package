<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.dev', 'Webit Developer Alert') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome from Webit website -->
    <link rel="stylesheet" href="https://webit.be/wp-content/cache/min/1/font-awesome/4.6.3/css/font-awesome.min.css?ver=1676541619">
    
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- Highlight JS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/languages/go.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/styles/vs2015.min.css">
    
    <!-- Styles -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="{{ asset('/developer_alert/css/app.css') }}" rel="stylesheet" /> <!-- CSS files is gelinked maar veranderingen in app.css komen niet door -->
</head>
<body class="min-vh-100">
    <header class="mb-5 p-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo fw-bold fs-5">
                <a href="/developer-alert/dashboard">
                    <img src="https://www.webit.be/wp-content/themes/webit/images/logo.gif" alt="Webit-logo" height="50">
                </a>
            </div>
            <?php $uri = $_SERVER['REQUEST_URI']; if ( $uri !== "/developer-alert/dashboard" ) : ?>
                <div>
                    <a class="button" style="height: max-content;" href="/developer-alert/dashboard">
                        Go to dashboard
                        <i class="fa fa-sharp fa-solid fa-chevron-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <div id="app">
        <main class="mb-5">
            @yield('content')
        </main>
    </div>

    <footer class="p-4 position-relative d-flex justify-content-center w-100" style="background:#BDE6FA;">
        <div class="container">
            <p>
                ©
                <a href="https://webit.be" target="_blank" class="text-decoration-none">Webdesign Webit</a>
                {{ date('Y') }} — met
                <i class="fa fa-heart" style="color:#e07d7d;"></i>
                gebouwd, door ons!
            </p>
           
        </div>
        <button class="d-block position-absolute top-0 end-0 me-2 mt-2 btn" onclick="goToTop()">
            <i class="bi bi-arrow-up-square fs-2"></i>
        </button>
    </footer>

    <!-- Styles -->
    <script src="{{ asset('/developer_alert/js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function goToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        }
    </script>

</body>
</html>
