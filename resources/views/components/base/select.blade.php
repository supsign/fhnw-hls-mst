<vue-select class="w-full mt-2 min-h-16"
            :init-value="{{ $value ?? json_encode(null) }}"
            name="{{ $attributes->get('name') }}"
            {{ $attributes->get('clearable') ? 'clearable' : '' }}
            {{ $attributes->get('searchable') ? 'searchable' : '' }}
            {{ $attributes->get('required') ? 'required' : '' }}
            {{ $attributes->get('disabled') ? 'disabled' : '' }}
            is-blade>
</vue-select>
