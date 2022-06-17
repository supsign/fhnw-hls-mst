<template>
    <div v-if="!editMode" class="block w-full px-6 py-2 border border-transparent">
        {{ showOption(value) }}
    </div>
    <vue-select
        v-else
        :value="value"
        @input="input"
        :disabled="disabled"
        @blur="blur"
        :options="options"
        :showOption="showOption"
        :searchable="searchable"
        :searchKeys="searchKeys"
        :clearable="clearable"
        :required="required"
        :option-key="label"
    ></vue-select>
</template>

<script lang="ts">
import BaseComponent from '../base/baseComponent';
import { Component, Emit, Prop } from 'vue-property-decorator';
import VueSelect from './vueSelect.vue';
import { IModel } from '../../store/model.interface';
import { EntityModel } from '../../store/base/baseEntity.model';
import { FieldControl } from '../../helpers/validation/fieldControl';
import { ValidationRule } from '../../helpers/validation/rules/validationRule';
import { parseValidationRules } from '../../helpers/validation/rules/parseValidationRules';

@Component({
    components: {
        VueSelect,
    },
})
export default class VueStoreSelect extends BaseComponent {
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
        type: Boolean,
    })
    required: boolean;

    @Prop({
        type: Boolean,
    })
    disabled: boolean;

    @Prop()
    entity: IModel;

    @Prop({
        type: Boolean,
    })
    editMode: boolean;

    @Prop({
        type: Array,
    })
    searchKeys: string[];

    @Prop({ type: EntityModel })
    model!: EntityModel<any, any, IModel>;

    @Prop({ type: EntityModel })
    relatedModel!: EntityModel<any, any, IModel>;

    @Prop({
        type: Function,
        default: () => true,
    })
    relatedFilter!: (entity: IModel) => boolean;

    @Prop({
        type: Function,
        default: (option: any) => option?.name,
    })
    showOption: (option: any) => string;

    @Prop({
        type: Function,
    })
    sortOptions: (a: any, b: any) => number;

    @Prop({
        type: Boolean,
        default: false,
    })
    searchable: boolean;

    @Prop({
        type: Boolean,
        default: false,
    })
    clearable: boolean;

    @Prop({
        type: String,
    })
    label: string;

    fieldControl: FieldControl = null;
    isDirty = false;
    isTouched = false;

    public get value() {
        const relatedId = this.entity[this.name];
        if (relatedId === null || relatedId === undefined) {
            return;
        }
        if (typeof relatedId !== 'number') {
            throw new Error('id ist not a number');
        }
        return this.relatedModel.getById(relatedId);
    }

    @Emit()
    input(selectedModel: IModel) {
        if (selectedModel) {
            this.model.patch({
                id: this.entity.id,
                [this.name]: selectedModel.id,
            });
        } else {
            this.model.patch({ id: this.entity.id, [this.name]: null });
        }

        return selectedModel;
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

    public get options() {
        // create new Array to prevent mutation in the store
        return [...this.relatedModel.all].sort(this.sortOptions || this.defaultSortOptions).filter(this.relatedFilter);
    }

    private defaultSortOptions(a: any, b: any) {
        return this.showOption(a).localeCompare(this.showOption(b));
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
