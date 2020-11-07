<div>
    @if (count($this->sessions) > 0)
    <ul class="list-unstyled">
        @foreach ($this->sessions as $session)
        <li class="media">
            @if ($session->agent->isDesktop())
            <img class="mr-3" src="{{ asset('assets/img/dekstop.png') }}" alt="Generic placeholder image"
                style="width:60px">
            @else
            <img class="mr-3" src="{{ asset('assets/img/hp.png') }}" alt="Generic placeholder image" style="width:60px">
            @endif
            <div class="media-body">
                <h6 class="mt-0 mb-1">{{ $session->agent->platform() }} -
                    {{ $session->agent->browser() }}</h6>
                <p>{{ $session->ip_address }},

                    @if ($session->is_current_device)
                    <span class="font-semibold text-green-500">{{ __('This device') }}</span>
                    @else
                    {{ __('Last active') }} {{ $session->last_active }}
                    @endif</p>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
    <x-input-error for="password" />
    <x-button class="btn btn-primary" data-toggle="modal" data-target="#ConfirmModal" id="btnConfirm"
        wire:loading.attr="disabled">
        {{ __('Logout Other Browser Sessions') }}
    </x-button>
    <x-modal wire:ignore.self tabindex="-1" role="dialog" id="ConfirmModal">
        <x-slot name="title">
            {{ __('Logout Other Browser Sessions') }}
        </x-slot>
        <form class="needs-validation" novalidate="">
            <x-slot name="content">
                {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}
                <div class="form-group">
                    <x-input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Password') }}" required x-ref="password" wire:model.defer="password"
                        wire:keydown.enter="logoutOtherBrowserSessions" />
                    <x-input-error for="password" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Nevermind') }}
                </x-button>

                <x-button type="submit" class="btn btn-primary" wire:click="logoutOtherBrowserSessions"
                    wire:loading.attr="disabled">
                    {{ __('Logout Other Browser Sessions') }}
                </x-button>
            </x-slot>
        </form>
    </x-modal>
</div>