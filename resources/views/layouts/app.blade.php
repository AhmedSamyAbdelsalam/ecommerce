<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href={{asset('frontend/vendor/glightbox/css/glightbox.min.css')}}>
    <link rel="stylesheet" href={{asset('frontend/vendor/nouislider/nouislider.min.css')}}>
    <link rel="stylesheet" href={{asset('frontend/vendor/choices.js/public/assets/styles/choices.min.css')}}>
    <link rel="stylesheet" href={{asset('frontend/vendor/swiper/swiper-bundle.min.css')}}>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.default.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href={{asset('frontend/css/custom.css')}}>
    <livewire:styles />
    @yield('style')
</head>
<body>
    <div id="app" class="page-holder {{request()->routeIs('frontend.detail') ? 'bg-light' : ''}}">
        @include('partial.frontend.header')
        <div class="container">
            @yield('content')
        </div>
        @include('partial.frontend.footer')
    </div>
    <livewire:frontend.product-modal-shared />
    <!--scripts-->
    <livewire:scripts />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <script src="{{ asset('js/app.js') }}"></script>
    <script src={{asset('frontend/vendor/glightbox/js/glightbox.min.js')}}></script>
    <script src={{asset('frontend/vendor/nouislider/nouislider.min.js')}}></script>
    <script src={{asset('frontend/vendor/swiper/swiper-bundle.min.js')}}></script>
    <script src={{asset('frontend/vendor/choices.js/public/assets/scripts/choices.min.js')}}></script>
    <script src={{asset('frontend/js/front.js')}}></script>

{{--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}
{{--    --}}
    <script>
        function injectSvgSprite(path) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    </script>
    @yield('script')

</body>
</html>
