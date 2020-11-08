@props(['for','value'])
<label for="{{ $for }}" {{ $attributes }}>{{ $value ?? $slot }}</label>
