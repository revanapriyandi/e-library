<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-visit-control" content="reload">

    <title>{{ config('app.name') ?? $title }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ mix('css/template.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    @stack('css')
    <livewire:styles />
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <livewire:navigation />
            <div class="main-sidebar sidebar-style-2">
                <livewire:sidebar />
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-6 col-sm-6">
                                        <h5>{{ $header ?? '' }}</h5>
                                    </div>
                                    <div class=" col-md-6 col-lg-6 col-6 col-sm-6">
                                        <div class="buttons">
                                            @stack('button')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $slot ?? '' }}
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> {{ config('app.name') }} <a
                        href="revanapriyandi.github.io">M Revan apriyandi</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <livewire:scripts />
    <script src="{{ mix ('js/template.js') }}"> </script>
    @stack('js')

</body>

</html>
