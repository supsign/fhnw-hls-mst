<template>
    <div class="relative mt-2 text-left text-gray-700 min-h-16">
        <editor
            @input="input"
            :name="name"
            :value="internValue"
            api-key="6shd46sowki9fg98un4sdjuru2amdjuj1u8xpwlqc9jmlggq"
            :disabled="disabled"
            :id="id + '_editor'"
            :init="{
                menubar: false,
                plugins: ['autoresize lists advlist link'],
                toolbar:
                    'undo redo | h6 | bold italic | link unlink | alignleft aligncenter alignright alignjustify |bullist numlist | cut copy | removeformat',
                default_link_target: '_blank',
                content_style: [
                    'h6 {font-size:18px; margin-block-start:0em;margin-block-end:0em} ',
                    'p {margin-block-start:0em}',
                    'ul {margin-block-start: 0em}'
                ]
            }"
        />
        <span class="input__label" ref="tooltipp">
            {{ label }}{{ required ? " *" : "" }}
            <i v-if="tooltipp" class="fas fa-info-circle"></i>
        </span>

        <span class="text-xs input__error" role="alert" v-if="showError">
            {{ initialError || fieldControl.errors[0] }}
        </span>
    </div>
</template>

<script lang="ts">
import { Component, Emit, Model, Prop } from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import { FieldControl } from "../../helpers/validation/fieldControl";
import { ValidationRule } from "../../helpers/validation/rules/validationRule";
import { parseValidationRules } from "../../helpers/validation/rules/parseValidationRules";

@Component
export default class VueEditor extends BaseComponent {
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
        type: String
    })
    initValue: string;

    @Model("input")
    value: string;

    internValue = "";

    input(ev: any) {
        this.internValue = ev;
        this.initialError = null;
        this.validate();
        this.$emit("input", ev);
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
    }

    get listeners() {
        const { input, blur, ...listeners } = this.$listeners;
        return listeners;
    }

    private validate() {
        this.fieldControl.validate(this.internValue);
        this.isDirty = true;
    }

    get showError() {
        return (
            !!this.initialError ||
            (!this.fieldControl.isValid && this.isTouched)
        );
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
}
</script>
