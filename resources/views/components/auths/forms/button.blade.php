<button {{ $attributes->merge(['class' => "btn btn-lg btn-primary btn-block", 'type' => 'button']) }}>
    {{ $slot }}
</button>
