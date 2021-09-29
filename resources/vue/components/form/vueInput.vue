<template>
    <div class="relative mt-2 text-left text-gray-700 min-h-16">
        <label class="input">
            <input
                :disabled="disabled"
                :value="internValue"
                @input="input"
                @blur="blur"
                :id="id"
                :type="type"
                :name="name"
                v-on="listeners"
                class="w-full input__field"
                autofocus
                :autocomplete="'current-' + name"
                placeholder=" "
            />
            <span class="input__label" ref="tooltipp">
                {{ label }}{{ required ? " *" : "" }}
                <i v-if="tooltipp" class="fas fa-info-circle"></i>
            </span>

        </label>
    </div>
</template>

<script lang="ts">
import {Component, Model, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {FieldControl} from "../../helpers/validation/fieldControl";

@Component
export default class VueInput extends BaseComponent {
    fieldControl: FieldControl = null;
    isDirty = false;
    isTouched = false;
    initialError: string = null;

    @Prop({
        type: String,
        default: ""
    })
    validationRules: string;

    @Prop({
        type: String
    })
    name: string;

    @Prop({
        type: String
    })
    id: string;

    @Prop({
        type: String
    })
    label: string;

    @Prop({
        type: String
    })
    initError: string;

    @Prop({
        type: Boolean
    })
    required: boolean;

    @Prop({
        type: Boolean
    })
    disabled: boolean;

    @Prop({ type: String, default: "text" })
    type: string;

    @Prop({
        type: String
    })
    tooltipp: string;

    @Prop({
        type: Boolean,
        default: false
    })
    blade: boolean;

    @Prop({
        type: String
    })
    initValue: string;

    @Model("input")
    value: string;

    internValue = "";

    get listeners() {
        const { input, blur, ...listeners } = this.$listeners;
        return listeners;
    }
}
</script>
