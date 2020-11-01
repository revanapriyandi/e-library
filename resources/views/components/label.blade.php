@props(['for','value'])
<label for="{{ $for }}">{{ $value ?? $slot }}</label>
