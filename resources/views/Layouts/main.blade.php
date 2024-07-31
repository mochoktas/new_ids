<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title_page')</title>

    @include('Layouts/css_global')
    @yield('css_custom')
</head>

<body>
    <div id="app">
        @include('Layouts/sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="/" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    @yield('content')
                </section>
            </div>

            @include('Layouts/footer')

        </div>
    </div>
    @include('Layouts/js_global')
    @yield('js_custom')
</body>

</html>