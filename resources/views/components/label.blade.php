@props(['for','value','required' => false])
@if ($required)
<label for="{{ $for }}" {{ $attributes }}>{{ $value ?? $slot }}<i class="text-danger">*</i></label>
@else
<label for="{{ $for }}" {{ $attributes }}>{{ $value ?? $slot }}</label>
@endif
