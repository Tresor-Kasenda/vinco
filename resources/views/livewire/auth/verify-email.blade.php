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
        <div class="">
            <div class="nk-block-title">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="nk-block-des text-success">
                    <p>
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                </div>
            @endif

            <div class="d-flex">
                <x-auths.forms.button class="btn btn-primary" wire:click.prevent="sendVerification" type="submit">
                    {{ __('Resend Verification Email') }}
                </x-auths.forms.button>
                <x-auths.forms.button wire:click.prevent="logout" type="submit">
                    {{ __('Log Out') }}
                </x-auths.forms.button>
            </div>
        </div>
    </div>
    <x-auth-footer/>
</div>
