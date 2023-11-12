<div class="nk-block nk-auth-footer">
    <div {{ $attributes->class(['nk-block-between']) }}>
        <ul class="nav nav-sm">
            <li class="nav-item">
                <a wire:navigate class="nav-link" href="#">Terms & Condition</a>
            </li>
            <li class="nav-item">
                <a wire:navigate class="nav-link" href="#">Privacy Policy</a>
            </li>
            <li class="nav-item">
                <a wire:navigate class="nav-link" href="#">Help</a>
            </li>
        </ul>
    </div>
    <div class="mt-3">
        <p>&copy; {{ now()->format('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
    </div>
</div>
