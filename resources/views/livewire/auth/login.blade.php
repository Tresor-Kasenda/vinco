<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
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
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <form wire:submit="login">
            <div class="form-group">
                <div class="form-label-group">
                    <x-auths.forms.label for="Email" :value="__('Email')"/>
                </div>
                <div class="form-control-wrap">
                    <x-auths.forms.text-input
                        wire:model="form.email"
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        class="@error('email') error @enderror"
                        :value="old('form.email')"
                        autocomplete="username"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <x-auths.forms.label for="password" :value="__('password')"/>
                    <a wire:navigate class="link link-primary link-sm" tabindex="-1"
                       href="{{ route('password.request') }}">Forgot Code?</a>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                       data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <x-auths.forms.text-input
                        wire:model="form.password"
                        id="password"
                        type="password"
                        name="password"
                        class="@error('password') error @enderror"
                        required
                        autocomplete="current-password"/>
                </div>
            </div>
            <div class="form-group">
                <x-auths.forms.button type="submit">
                    {{ __('Log in') }}
                </x-auths.forms.button>
            </div>
        </form>
        <div class="form-note-s2 pt-4">
            New on our platform? <a wire:navigate href="{{ route('register') }}">Create an account</a>
        </div>
        <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
        </div>
        <ul class="nav justify-center gx-4">
            <li class="nav-item"><a class="nav-link" href="{{ route('auth.facebook') }}">Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('auth.google') }}">Google</a></li>
        </ul>
    </div>
    <x-auth-footer/>
</div>
