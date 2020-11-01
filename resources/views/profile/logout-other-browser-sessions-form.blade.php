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
                                    <div class="tab-pane fade active show" id="lainnya" role="tabpanel">

                                        <div>
                                            @if (count($this->sessions) > 0)
                                            <ul class="list-unstyled">
                                                @foreach ($this->sessions as $session)
                                                <li class="media">
                                                    @if ($session->agent->isDesktop())
                                                    <img class="mr-3" src="{{ asset('assets/img/dekstop.png') }}"
                                                        alt="Generic placeholder image" style="width:60px">
                                                    @else
                                                    <img class="mr-3" src="{{ asset('assets/img/hp.png') }}"
                                                        alt="Generic placeholder image" style="width:60px">
                                                    @endif
                                                    <div class="media-body">
                                                        <h6 class="mt-0 mb-1">{{ $session->agent->platform() }} -
                                                            {{ $session->agent->browser() }}</h6>
                                                        <p>{{ $session->ip_address }},

                                                            @if ($session->is_current_device)
                                                            <span
                                                                class="font-semibold text-green-500">{{ __('This device') }}</span>
                                                            @else
                                                            {{ __('Last active') }} {{ $session->last_active }}
                                                            @endif</p>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            <x-button class="btn btn-primary" wire:click="confirmLogout"
                                                wire:loading.attr="disabled" id="logoutses">
                                                {{ __('Logout Other Browser Sessions') }}
                                            </x-button>

                                        </div>
                                        <x-modal wire:model="confirmingLogout" id="modalLogoutSession">
                                            <x-slot name="title">
                                                {{ __('Logout Other Browser Sessions') }}
                                            </x-slot>

                                            <x-slot name="content">
                                                {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}

                                                <div class="form-group">
                                                    <x-input type="password" class="form-control"
                                                        placeholder="{{ __('Password') }}" x-ref="password"
                                                        wire:model.defer="password"
                                                        wire:keydown.enter="logoutOtherBrowserSessions" />

                                                    <x-input-error for="password" class="mt-2" />
                                                </div>
                                            </x-slot>

                                            <x-slot name="footer">
                                                <x-button class="btn btn-secondary"
                                                    wire:click="$toggle('confirmingLogout')"
                                                    wire:loading.attr="disabled">
                                                    {{ __('Nevermind') }}
                                                </x-button>

                                                <x-button class="btn btn-primary"
                                                    wire:click="logoutOtherBrowserSessions"
                                                    wire:loading.attr="disabled">
                                                    {{ __('Logout Other Browser Sessions') }}
                                                </x-button>
                                            </x-slot>
                                        </x-modal>
                                        @push('js')
                                        <script>
                                            $("#logoutses").click(function(){
                                                $("#modalLogoutSession").modal({backdrop: false});
                                                });
                                        </script>
                                        @endpush
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
