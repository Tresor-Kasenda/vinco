<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <x-auths.logo route="{{ route('home') }}"/>
        </div>
        <div class="nk-block-head">
            <x-auths.head
                :title="__('login')"
                :description="__('description')"
            />
        </div>
        <form wire:submit.prevent="resetPassword">
            <div class="form-group">
                <x-auths.forms.label for="email" :value="__('Email')"/>
                <div class="form-control-wrap">
                    <x-auths.forms.text-input
                        wire:model="email"
                        id="email"
                        type="text"
                        name="email"
                        required
                        class="@error('email') error @enderror"
                        :value="old('email')"
                        placeholder="Enter your email address"
                        autofocus
                        autocomplete="email"
                    />
                </div>
            </div>
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
                        class="@error('password') error @enderror"
                        placeholder="Enter your password"
                        name="password"
                        required
                        autocomplete="current-password"/>
                </div>
            </div>
            <div class="form-group">
                <x-auths.forms.label for="password_confirmation" :value="__('password confirmation')"/>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                       data-target="password_confirmation">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <x-auths.forms.text-input
                        wire:model="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        class="@error('password_confirmation') error @enderror"
                        placeholder="Enter your password confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="current-password"/>
                </div>
            </div>

            <div class="form-group">
                <x-auths.forms.button type="submit">
                    {{ __('Reset Password') }}
                </x-auths.forms.button>
            </div>
        </form>
    </div>
    <x-auth-footer/>
</div>
