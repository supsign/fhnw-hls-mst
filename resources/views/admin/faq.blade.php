<x-layout.admin>
    <x-slot name="title">
        @lang('l.faqEdit')
    </x-slot>

    <vue-admin-faq-wrapper :init-faqs="{{ $faqs }}"></vue-admin-faq-wrapper>
</x-layout.admin>
