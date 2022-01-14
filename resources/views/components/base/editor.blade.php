<div>
    <vue-editor
        validation-rules="{{ $validationRules }}"
        id="{{ $attributes->get('name') }}"
        type="{{ $attributes->get('type') }}"
        name="{{ $attributes->get('name') }}"
        label="{{ $attributes->get('label') }}"
        init-value="{!! old($attributes->get('name')) ?? $attributes->get('value') !!}"
        tooltipp="{{ $tooltipp }}"
        {{ $attributes->get('required') ? 'required' : '' }}
        {{ $attributes->get('disabled') ? 'disabled' : '' }}
        init-error="{{ $initError }}"
        blade>
    </vue-editor>
</div>
