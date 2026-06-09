@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'sst-input' . ($disabled ? ' opacity-60 cursor-not-allowed' : '')]) }}
>
