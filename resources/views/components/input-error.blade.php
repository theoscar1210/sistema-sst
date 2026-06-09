@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'input-error']) }}>
        @foreach ((array) $messages as $message)
            <span><i class="bi bi-exclamation-circle"></i>{{ $message }}</span>
        @endforeach
    </div>
@endif
