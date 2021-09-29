<vue-checkbox
    :name="'{{ $attributes['name'] }}'"
    label="{{ $slot }}"
    :blade="true"
    value-id="{{ $attributes['value'] ?: true }}">
</vue-checkbox>
