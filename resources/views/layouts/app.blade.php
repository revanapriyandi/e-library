<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-visit-control" content="reload">

    <title>{{ config('app.name') ?? $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Template CSS -->
    {{--  <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}"> --}}
    @stack('css')
    <livewire:styles />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/prism/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
    </style>

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
                                        <h5>{{ $header }}</h5>
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
                {{ $slot }}
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
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    {{--  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script> --}}
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/prism/prism.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    @stack('js')
    <script>
        function UpperCaseFirstLetter(str){
                return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
            }
            window.livewire.on('alert', param => {
            iziToast[param['type']]({title: UpperCaseFirstLetter(param['type']), message: param['message'], position: 'bottomRight'});
            });
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
