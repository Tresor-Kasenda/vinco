@php use App\Enums\UserTypeEnum; @endphp

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
        <form wire:submit.prevent="register">
            <div class="form-group">
                <x-auths.forms.label for="user_type" :value="__('Type user')"/>
                <div class="form-control-wrap">
                    <select wire:model="user_type"
                            class="form-select form-control-lg js-select2 @error('user_type') error @enderror"
                            name="user_type"
                            id="user_type">
                        @foreach(UserTypeEnum::cases() as $option)
                            <option value="{{ $option->value }}">
                                {{ $option->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <x-auths.forms.label for="name" :value="__('Name')"/>
                <div class="form-control-wrap">
                    <x-auths.forms.text-input
                        wire:model="name"
                        id="name"
                        type="text"
                        name="name"
                        required
                        placeholder="Enter your name"
                        :value="old('name')"
                        autofocus
                        class="@error('name') error @enderror"
                        autocomplete="name"
                    />
                </div>
            </div>
            <div class="form-group">
                <x-auths.forms.label for="email" :value="__('Email')"/>
                <div class="form-control-wrap">
                    <x-auths.forms.text-input
                        wire:model="email"
                        id="email"
                        type="text"
                        name="email"
                        required
                        :value="old('email')"
                        placeholder="Enter your email address"
                        autofocus
                        class="@error('email') error @enderror"
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
                        placeholder="Enter your password"
                        name="password"
                        class="@error('password') error @enderror"
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
                    {{ __('Register') }}
                </x-auths.forms.button>
            </div>
        </form>
        <div class="form-note-s2 pt-4">
            Already have an account ? <a wire:navigate href="{{ route('login') }}">
                <strong>{{ __("Sign in instead") }}</strong>
            </a>
        </div>
        <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
        </div>
        <ul class="nav justify-center gx-8">
            <li class="nav-item"><a class="nav-link" href="{{ route('auth.facebook') }}">Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('auth.google') }}">Google</a></li>
        </ul>
    </div>
    <x-auth-footer/>
</div>
