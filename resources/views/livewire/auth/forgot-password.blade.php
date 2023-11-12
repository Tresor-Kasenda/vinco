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
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <form wire:submit.prevent="sendPasswordResetLink">
            <div class="form-group">
                <div class="form-label-group">
                    <x-auths.forms.label for="email" :value="__('Email')"/>
                </div>
                <div class="form-control-wrap">
                    <x-auths.forms.text-input
                        wire:model="email"
                        id="email"
                        type="text"
                        name="email"
                        class="@error('email') error @enderror"
                        required
                        :value="old('email')"
                        placeholder="Enter your email address"
                        autofocus
                        autocomplete="email"
                    />
                </div>
            </div>
            <div class="form-group">
                <x-auths.forms.button type="submit">
                    {{ __('Send Password Reset Link') }}
                </x-auths.forms.button>
            </div>
        </form>
        <div class="form-note-s2 pt-5">
            <a wire:navigate href="{{ route('login') }}"><strong>Return to login</strong></a>
        </div>
    </div>
    <x-auth-footer/>
</div>
