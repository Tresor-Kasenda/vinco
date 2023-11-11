@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
<div {{ $attributes->merge(['class' => "form-label-group"]) }} class="">
    <label class="form-label" for="default-01">Email or Username</label>
</div>
