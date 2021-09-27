@php
    $classes = "text-blue-600 hover:text-blue-800";
    if(strpos($attributes->get('class'), 'button-primary') !== false){
    $classes="";
    }
@endphp

<a {{ $attributes->merge(['class' => $classes ]) }}>
    @isset($attributes['icon'])
        <i aria-hidden="true" class="mr-1 {{ $attributes['icon'] }}"></i>
    @endisset
    {{ $slot }}
</a>
