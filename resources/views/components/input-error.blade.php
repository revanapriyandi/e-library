@props(['for'])

@error($for)
<div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
    {{ $message}}
</div>
@else
<div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
    Silahkan isi {{ $for }} anda
</div>
@enderror
