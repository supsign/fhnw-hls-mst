<template>
    <div class="relative mt-2 text-left text-gray-700 min-h-16">
        <label class="input">
            <input
                :id="id"
                v-mask="mask"
                :autocomplete="'current-' + name"
                :autofocus="autofocus"
                :class="{
                    'is-invalid': showError
                }"
                :disabled="disabled"
                :name="name"
                :type="type"
                :value="internValue"
                class="w-full input__field"
                placeholder=" "
                @blur="blur"
                @input="input"
                v-on="listeners"
            />
            <span ref="tooltipp" class="input__label">
                {{ label }}{{ required ? " *" : "" }}
                <i v-if="tooltipp" class="fas fa-info-circle"></i>
            </span>

            <span v-if="showError" class="text-xs input__error" role="alert">
                {{ initialError || fieldControl.errors[0] }}
            </span>
        </label>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Model, Prop} from "vue-property-decorator";
import BaseComponent from "./base";
import {FieldControl} from "../helpers/validation/fieldControl";
import {ValidationRule} from "../helpers/validation/rules/validationRule";
import {parseValidationRules} from "../helpers/validation/rules/parseValidationRules";
import tippy, {Instance as TippyInstance} from "tippy.js";

@Component
export default class VueInput extends BaseComponent {
    fieldControl: FieldControl = null;
    isDirty = false;
    isTouched = false;
    initialError: string = null;
    tippy: TippyInstance = null;

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
        type: Boolean
    })
    date: boolean;

    @Prop({
        type: Boolean
    })
    time: boolean;

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
        type: Boolean
    })
    autofocus: boolean;

    @Prop({type: String, default: "text"})
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

    public get mask() {
        if (this.date && this.time) {
            return "####-##-## ##:##";
        }

        if (this.time) {
            return "##:##";
        }

        if (this.date) {
            return "####-##-##";
        }
    }

    get listeners() {
        const {input, blur, ...listeners} = this.$listeners;
        return listeners;
    }

    get showError() {
        return (
            !!this.initialError ||
            (!this.fieldControl.isValid && this.isTouched)
        );
    }

    input(ev: any) {
        this.internValue = ev.target.value;
        this.initialError = null;
        this.validate();
        this.$emit("input", ev.target.value);
    }

    @Emit()
    blur(ev: any) {
        this.isTouched = true;
        this.validate();
        return ev;
    }

    created(): void {
        this.initialError = this.initError;
        if (this.blade) {
            this.internValue = this.initValue;
        } else {
            this.internValue = this.value;
        }

        this.fieldControl = new FieldControl(this.name);
        this.loadValidationRules();
        this.validate();
    }

    beforeUpdate() {
        if (this.blade) {
            return;
        }
        this.internValue = this.value;
        this.validate();
    }

    mounted(): void {
        if (
            this.tooltipp &&
            !this.tippy &&
            this.$refs.tooltipp instanceof Element
        ) {
            this.tippy = tippy(this.$refs.tooltipp);
            this.tippy.setContent(this.tooltipp);
        }
    }

    loadValidationRules() {
        const validations: ValidationRule[] = [];
        const createValidationRuleOptions = parseValidationRules(
            this.validationRules
        );

        for (const createValidationRuleOption of createValidationRuleOptions) {
            const validation = ValidationRule.create(
                createValidationRuleOption
            );
            if (!validation) {
                continue;
            }
            validations.push(validation);
        }

        if (this.required) {
            validations.push(ValidationRule.required);
        }

        this.fieldControl.addValidationRule(...validations);
    }

    private validate() {
        this.fieldControl.validate(this.internValue);
        this.isDirty = true;
    }
}
</script>
