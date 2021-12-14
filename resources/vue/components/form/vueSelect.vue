<template>
    <div class="relative block">
        <div
            class="absolute px-2 z-10 text-gray-400 bg-white whitespace-nowrap -top-3.5 left-2.5 font-semibold"
            style="transform: scale(0.9)"
        >
            {{ label }}{{ required && label ? " *" : "" }}
        </div>

        <v-select
            :clearable="clearable"
            :disabled="disabled"
            :filter="getFilter()"
            :label="optionKey"
            :options="options"
            :searchable="searchable"
            :selectable="selectable"
            :value="internalValue"
            class="w-full"
            @input="input"
            @search="search"
            @search:blur="blur"
        >
            <template v-if="showOption" #option="option">
                {{ showOption(option) }}
            </template>
            <template v-if="showOption" #selected-option="option">
                {{ showOption(option) }}
            </template>
            <template #no-options>
                Keine Einträge gefunden
            </template>
        </v-select>
        <div v-if="showError" class="text-xs vs__error" role="alert">
            {{ initialError || fieldControl.errors[0] }}
        </div>
        <select :name="name" hidden>
            <option
                v-if="internalValue"
                :value="internalValue.id"
                selected
            ></option>
            <option
                v-else
                :value="null"
                selected
            ></option>
        </select>

        <div v-if="value" hidden>
            {{ value.id || value }}
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import vSelect from "vue-select";
import {IModel} from "../../store/model.interface";
import Fuse from "fuse.js";
import {FieldControl} from "../../helpers/validation/fieldControl";
import {ValidationRule} from "../../helpers/validation/rules/validationRule";

@Component({
    components: {
        vSelect
    }
})
export default class VueSelect extends BaseComponent {
    @Prop({
        type: [Object, String]
    })
    value: IModel | string;

    @Prop({
        type: Object
    })
    initValue: IModel;

    @Prop({
        type: Boolean
    })
    isBlade: boolean;
    @Prop({
        type: String,
        default: "id"
    })
    optionKey: string;
    @Prop({
        type: String,
        default: ""
    })
    name: string;
    @Prop({
        type: String,
        default: ""
    })
    label: string;
    @Prop({
        type: Array
    })
    searchKeys: string[];
    @Prop({
        type: Boolean,
        default: false
    })
    clearable: boolean;
    @Prop({
        type: Boolean,
        default: false
    })
    disabled: boolean;
    @Prop({
        type: Array,
        default: (): [] => {
            return [];
        }
    })
    options: Array<IModel>;
    @Prop({
        type: Boolean,
        default: false
    })
    searchable: boolean;
    @Prop({
        type: Boolean,
        default: false
    })
    required: boolean;
    @Prop({
        type: Function
    })
    selectable: (option: any) => boolean;
    @Prop({
        type: Function
    })
    showOption: (option: any) => string;
    @Prop({
        type: String
    })
    initError: string;
    public internalValue: IModel | string = null;
    public isDirty = false;
    private fieldControl: FieldControl;
    private initialError: string = null;
    private isTouched = false;


    public get isValid() {
        return this.fieldControl.isValid;
    }

    get showError() {
        return (
            !!this.initialError ||
            (!this.fieldControl.isValid && this.isTouched)
        );
    }

    get calcValue() {
        return this.value;
    }

    public input(ev: any) {
        this.internalValue = ev;
        this.initialError = null;
        this.$emit("input", ev);
        this.blur(ev);
    }

    // ToDo Matthias
    public created() {
        this.initialError = this.initError;

        if (this.initValue) {
            this.internalValue = this.initValue;
        } else {
            this.internalValue = this.value;
        }

        this.fieldControl = new FieldControl(this.name);
        if (this.required) {
            this.fieldControl.addValidationRule(ValidationRule.required);
        }
        this.validate();
    }

    public beforeUpdate() {
        if (this.isBlade) {
            return;
        }
        this.internalValue = this.calcValue;
        this.validate();
    }

    @Emit()
    search(search: any, loading: any) {
        return {search, loading};
    }

    @Emit()
    blur(ev: any) {
        this.isTouched = true;
        this.validate();
        return ev;
    }

    public getFilter() {
        if (!this.searchKeys || this.searchKeys.length === 0) {
            return;
        }
        return (options: any[], search: string) => {
            const fuse = new Fuse(options, {
                keys: this.searchKeys,
                shouldSort: true,
                findAllMatches: true
            });

            return fuse.search(search).map(({item}): { item: any } => item);
        };
    }

    private validate() {
        this.fieldControl.validate(this.internalValue);
    }
}
</script>
