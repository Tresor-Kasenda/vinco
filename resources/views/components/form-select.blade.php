@props([
    'disabled' => false,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
])
<select
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'form-select js-select2']) }}>
    <option class="text-sm font-medium" value="">{{ $placeholder }}</option>
    @foreach($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>
