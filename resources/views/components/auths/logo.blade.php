@props(['route' => null])
<div>
    <a wire:navigate href="{{ $route }}" class="logo-link">
        <img
            class="logo-light logo-img logo-img-lg"
            src="{{ asset('images/vinco.svg') }}"
            srcset="{{ asset('images/vinco.svg') }} 2x"
            alt="Logo Vinco en mode light">
        <img
            class="logo-dark logo-img logo-img-lg"
            src="{{ asset('images/vinco_dark.svg') }}"
            srcset="{{ asset('images/vinco_dark.svg') }} 2x"
            alt="logo vinco en mode dark">
    </a>
</div>
