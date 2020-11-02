<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3 container-fluid">
                    <div class="container">
                        <div class="my-5 row" id="settings-nav">
                            <div class="pb-5 col-md-3">
                                <div class="nav flex-column nav-pills" aria-orientation="vertical">
                                    <a class="nav-item nav-link" href="{{ route('profile.update-profile') }}">Profile
                                        Information</a>
                                    </a>
                                    <a class="nav-item nav-link" href="{{ route('profile.update-password') }}">Update
                                        Password
                                    </a>
                                    <a class="nav-item nav-link active show"
                                        href="{{ route('profile.update-lainnya') }}">Lainnya
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" role="tabpanel">
                                        <h4 class="mb-3">{{ __('Pengaturan Lainnya') }}</h4>
                                        <hr>
                                        @livewire('profile.change-email')
                                        <hr>
                                        <div class="section-title">{{ __('Browser Sessions') }}
                                        </div>
                                        @livewire('profile.logout-other-browser-sessions-form')
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
