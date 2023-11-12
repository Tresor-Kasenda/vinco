<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <x-auths.logo route="{{ route('home') }}"/>
        </div>
        <div class="nk-block-head">
            <x-auths.head
                :title="__('login')"
                :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
            />
        </div>
        <form wire:submit="confirmPassword">
            <div class="form-group">
                <x-auths.forms.label for="password" :value="__('password')"/>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                       data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <x-auths.forms.text-input
                        wire:model="password"
                        id="password"
                        type="password"
                        placeholder="Enter your password"
                        name="password"
                        required
                        autocomplete="current-password"/>
                </div>
            </div>

            <div class="form-group">
                <x-auths.forms.button type="submit">
                    {{ __('Confirm') }}
                </x-auths.forms.button>
            </div>
        </form>
    </div>

    <x-auth-footer/>
</div>
