<template>
    <div
        class="relative mt-2 text-left text-gray-700"
        :id="id"
        :class="{ 'cursor-not-allowed opacity-75': disabled }"
    >
        <div class="flex flex-row">
            <div
                @click="toggle"
                v-on="listeners"
                :class="{ 'cursor-pointer': !disabled }"
                class="w-8 text-center"
            >
                <div
                    class="border rounded-lg shadow-md w-7 h-7"
                >
                    <div
                        v-if="internalValue"
                        class="flex items-center justify-center h-full"
                    >
                        <font-awesome-icon
                            icon="check"
                            style="color:green"
                            class="text-xl"
                        />
                    </div>
                </div>
            </div>
            <div
                class="ml-4 text-black align-center"
                ref="tooltipp"
                v-html="requiredLabel"
            ></div>
        </div>

        <input
            hidden
            type="string"
            :value="internalValue ? valueId : 0"
            :name="name"
        />
    </div>
</template>

<script lang="ts">
import { Component, Emit, Model, Prop } from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import { FieldControl } from "../../helpers/validation/fieldControl";

@Component
export default class VueCheckbox extends BaseComponent {
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
        type: [Boolean, Number]
    })
    initValue: boolean | number;

    @Prop({
        type: [Boolean, String, Number],
        default: 1
    })
    valueId: boolean | string | number;

    @Model("input", {
        type: [Boolean, String, Number]
    })
    value: boolean | string | number;

    internalValue: boolean = false;

    public get requiredLabel() {
        return this.label + (this.required ? " *" : "");
    }

    toggle() {
        if (this.disabled) {
            return;
        }
        this.isTouched = true;
        this.internalValue = !this.internalValue;
        this.initialError = null;
        this.$emit("input", this.internalValue);
        this.blur();
    }

    @Emit()
    blur() {
        return this.internalValue;
    }

    created(): void {
        this.initialError = this.initError;
        if (this.blade) {
            this.setInternalValue(this.initValue);
        }
    }

    beforeUpdate() {
        if (this.blade) {
            return;
        }

        this.setInternalValue(this.value);
    }

    get listeners() {
        const { input, blur, ...listeners } = this.$listeners;
        return listeners;
    }


    private setInternalValue(value: any) {
        if (typeof value === "undefined") {
            this.internalValue = false;
            return;
        }

        if (typeof value === "string") {
            if (value === "0" || value.toLowerCase() === "false") {
                this.internalValue = false;
                return;
            }

            this.internalValue = Boolean(value);
            return;
        }

        if (typeof value === "boolean") {
            this.internalValue = value;
            return;
        }

        if (typeof value === "number") {
            this.internalValue = !!this.value;
            return;
        }

        this.internalValue = !!this.value;
    }
}
</script>

