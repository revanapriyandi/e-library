@props(['value'])
<button {{ $attributes }}>
    {{ $value ?? $slot }}
</button>
