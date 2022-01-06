<x-layout.app>
    <x-slot name="title">
        @lang('l.faq')
    </x-slot>

    <div class="container p-3 mx-auto space-y-4 mt-2">
        @foreach ($faqs AS $faq)
            <strong>{{ $faq->question }}</strong><br>
            {{ $faq->answer }}
            <hr/>
        @endforeach
    </div>
</x-layout.app>
