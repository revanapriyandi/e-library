<div>
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        {{ $logo }}
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $title }}</h4>
                        </div>

                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
