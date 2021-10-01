<vue-select class="w-full mt-2 min-h-16"
    option-key="{{ $optionKey }}"
    :options="{{ $options }}"
    :init-value="{{ $value ?? json_encode(null) }}"
    label="{{ $label }}"
    name="{{ $attributes->get('name') }}"
    {{ $attributes->get('clearable') ? 'clearable' : '' }}
    {{ $attributes->get('searchable') ? 'searchable' : '' }}
    {{ $attributes->get('required') ? 'required' : '' }}
    {{ $attributes->get('disabled') ? 'disabled' : '' }}
    init-error="{{ $initError }}"
    is-blade>
</vue-select>
