@props([
    'title',
    'description'
])
<div class="nk-block-head-content">
    <h5 class="nk-block-title">{{ $title ?? $slot }}</h5>
    <div class="nk-block-des">
        <p>{{ $description ?? $slot }}</p>
    </div>
</div>
