<div class="col-md-8">
    <form wire:submit.prevent="submit" id="setting-form" class="needs-validation" novalidate="">
        <div class="card" id="settings-card">
            <div class="card-header">
                <h4>General Settings</h4>
            </div>
            <div class="card-body">
                <div class="form-group row align-items-center">
                    <x-label for="site_title" class="form-control-label col-sm-3 text-md-right">{{ __('Site Title') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="site_title" name="site_title" wire:model="site_title" required />
                        <x-input-error for="site_title" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="site_url" class="form-control-label col-sm-3 text-md-right">{{ __('Site URL') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="site_url" name="site_url" placeholder="https://####.com"
                            wire:model="site_url" required />
                        <x-input-error for="site_url" />
                    </div>
                </div>
                <p class="text-muted">{{ __('DATABASE') }}</p>
                <div class="form-group row align-items-center">
                    <x-label for="db_conn" class="form-control-label col-sm-3 text-md-right">
                        {{ __('DB Connection') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db_conn" name="db_conn" wire:model="db_conn" required />
                        <x-input-error for="db_conn" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="db_host" class="form-control-label col-sm-3 text-md-right">{{ __('DB HOST') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db_host" name="db_host" wire:model="db_host" required />
                        <x-input-error for="db_host" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="db_port" class="form-control-label col-sm-3 text-md-right">{{ __('DB PORT') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db_port" name="db_port" wire:model="db_port" required />
                        <x-input-error for="db_port" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="db" class="form-control-label col-sm-3 text-md-right">{{ __('DATABASE') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db" name="db" wire:model="db" required />
                        <x-input-error for="db" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="db_user" class="form-control-label col-sm-3 text-md-right">{{ __('DB USERNAME') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db_user" name="db_user" wire:model="db_user" required />
                        <x-input-error for="db_user" />
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <x-label for="db_pass" class="form-control-label col-sm-3 text-md-right">{{ __('DB PASSWORD') }}
                    </x-label>
                    <div class="col-sm-6 col-md-9">
                        <x-input type="text" id="db_pass" name="db_pass" wire:model="db_pass" required />
                        <x-input-error for="db_pass" />
                    </div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn" type="submit"
                    wire:loading.class="btn disabled btn-primary btn-progress">{{ __('Save Changes') }}</button>
            </div>
        </div>
    </form>
</div>
