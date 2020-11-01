<x-app-layout>
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="pt-3 container-fluid">
                        <div class="container">
                            <div class="my-5 row" id="settings-nav">
                                <div class="pb-5 col-md-3">
                                    <div class="nav flex-column nav-pills" aria-orientation="vertical">
                                        <a class="nav-item nav-link active show" href="#account"
                                            data-toggle="tab">Profile
                                            Information</a>
                                        </a>
                                        <a class="nav-item nav-link" href="#updatepassword" data-toggle="tab">Update
                                            Password
                                        </a>
                                        <a class="nav-item nav-link" href="#lainnya" data-toggle="tab">Lainnya
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="myTabContent">
                                        @livewire('profile.update-profile-information')
                                        @livewire('profile.update-password-information')
                                        @livewire('profile.update-information-lainnya')


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
