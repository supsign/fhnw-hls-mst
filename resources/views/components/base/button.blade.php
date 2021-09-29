<button
    {{ $attributes->merge(['class' => 'py-1 px-3'])->class(['disabled' => $disabled]) }}>
    @if($attributes['icon'])
        <i aria-hidden="true" class="{{ $attributes['icon'] }} mr-2"></i>
    @endif
    {{ $slot }}
</button>
