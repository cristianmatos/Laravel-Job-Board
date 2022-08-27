@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span>*</span>
    @endif
</label>
