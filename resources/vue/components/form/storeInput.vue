<template>
    <div>
        <div v-if="!editMode" class="block py-2 px-6 w-full border border-transparent w-full">
            {{ value }}
        </div>
        <input
            v-else
            :disabled="disabled"
            :value="value"
            @input="input"
            @blur="blur"
            :id="id"
            :type="type"
            :name="name"
            v-on="listeners"
            class="w-full input__field"
            :class="{
                'is-invalid': showError,
            }"
            :autocomplete="'current-' + name"
            :placeholder="placeholder"
        />
    </div>
</template>

<script lang="ts">
import { Component, Emit, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import VueInput from './vueInput.vue';
import { IModel } from '../../store/model.interface';
import { EntityModel } from '../../store/base/baseEntity.model';
import { FieldControl } from '../../helpers/validation/fieldControl';
import { ValidationRule } from '../../helpers/validation/rules/validationRule';
import { parseValidationRules } from '../../helpers/validation/rules/parseValidationRules';

@Component({
    components: {
        VueInput,
    },
})
export default class VueStoreInput extends BaseComponent {
    @Prop({
        type: String,
        default: '',
    })
    validationRules: string;

    @Prop({
        type: String,
    })
    name: string;

    @Prop({
        type: String,
    })
    id: string;

    @Prop({
        type: String,
    })
    placeholder: string;

    @Prop({
        type: Boolean,
    })
    required: boolean;

    @Prop({
        type: Boolean,
    })
    disabled: boolean;

    @Prop({ type: String, default: 'text' })
    type: string;

    @Prop()
    entity: IModel;

    @Prop({
        type: Boolean,
    })
    editMode: boolean;

    @Prop({ type: EntityModel })
    model!: EntityModel<any, any, IModel>;

    fieldControl: FieldControl = null;
    isDirty = false;
    isTouched = false;

    public get value() {
        return this.entity[this.name];
    }

    @Emit()
    input(ev: any) {
        this.model.patch({ id: this.entity.id, [this.name]: ev.target.value });
        return ev.target.value;
    }

    @Emit()
    blur(ev: any) {
        return ev;
    }

    created(): void {
        this.fieldControl = new FieldControl(this.name);
        this.loadValidationRules();
        this.validate();
    }

    get showError() {
        return !this.fieldControl.isValid && this.isTouched;
    }

    get listeners() {
        const { input, blur, ...listeners } = this.$listeners;
        return listeners;
    }

    private validate() {
        this.fieldControl.validate(this.value);
        this.isDirty = true;
    }

    private loadValidationRules() {
        const validations: ValidationRule[] = [];
        const createValidationRuleOptions = parseValidationRules(this.validationRules);

        for (const createValidationRuleOption of createValidationRuleOptions) {
            const validation = ValidationRule.create(createValidationRuleOption);
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
