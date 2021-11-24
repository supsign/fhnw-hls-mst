<div {{$attributes->merge(['class'=> 'p-2 bg-white rounded shadow']) }}>

    @isset($title)
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg">
            {{ $title }}
        </div>
    @endisset

    <div class="p-3 text-sm md:text-base">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-gray-200 pt-2">
            {{ $footer }}
        </div>
    @endisset
</div>
