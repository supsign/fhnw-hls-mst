<x-layout.admin>
    <x-slot name="title">
        @lang('l.courseEdit')
    </x-slot>

    <x-app.card class="mb-4">
        @foreach ($faqs AS $faq)
            <strong>{{ $faq->question }}</strong><br>
            {{ $faq->answer }}
            <hr/>
        @endforeach
    </x-app.card>
</x-layout.admin>
