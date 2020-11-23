const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles([
    'public/assets/modules/bootstrap/css/bootstrap.min.css',
    'public/assets/modules/select2/dist/css/select2.min.css',
    'public/assets/css/style.css',
    'public/assets/css/components.css',
    'public/assets/modules/prism/prism.css',
    'public/assets/modules/izitoast/css/iziToast.min.css',
], 'public/css/template.css').version();

mix.styles([
    'public/assets/modules/bootstrap/css/bootstrap.min.css',
    'public/assets/css/style.css',
    'public/assets/css/components.css',
], 'public/css/template-guest.css').version();

mix.scripts([
    'public/assets/modules/jquery.min.js',
    'public/assets/modules/popper.js',
    'public/assets/modules/tooltip.js',
    'public/assets/modules/bootstrap/js/bootstrap.min.js',
    'public/assets/modules/nicescroll/jquery.nicescroll.min.js',
    'public/assets/modules/moment.min.js',
    'public/assets/js/stisla.js',
    'public/assets/js/scripts.js',
    'public/assets/js/custom.js',
], 'public/js/template-guest.js').version();

mix.scripts([
    'public/assets/modules/jquery.min.js',
    'public/assets/modules/popper.js',
    'public/assets/modules/tooltip.js',
    'public/assets/modules/bootstrap/js/bootstrap.min.js',
    'public/assets/modules/nicescroll/jquery.nicescroll.min.js',
    'public/assets/modules/moment.min.js',
    'public/assets/js/stisla.js',
    'public/assets/modules/select2/dist/js/select2.full.min.js',
    'public/assets/modules/sweetalert/sweetalert.min.js',
    'public/assets/modules/prism/prism.js',
    'public/assets/modules/jquery-ui/jquery-ui.min.js',
    'public/assets/modules/izitoast/js/iziToast.min.js',
    'public/assets/js/scripts.js',
    'public/js/function.js',
    'public/assets/js/custom.js',
], 'public/js/template.js').version();