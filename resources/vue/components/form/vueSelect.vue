<template>
    <div class="relative block">
        <div
            class="absolute px-2 z-10 text-gray-400 bg-white whitespace-nowrap -top-3.5 left-2.5 font-semibold"
            style="transform: scale(0.9)"
        >
            {{ label }}{{ required && label ? " *" : "" }}
        </div>

        <v-select
            class="w-full"
            :options="options"
            :clearable="clearable"
            :searchable="searchable"
            @input="input"
            :value="internalValue"
            :label="optionKey"
            @search="search"
            :disabled="disabled"
            :selectable="selectable"
            @search:blur="blur"
        >
            <template #option="option" v-if="showOption">
                {{ showOption(option) }}
            </template>
            <template #selected-option="option" v-if="showOption">
                {{ showOption(option) }}
            </template>
        </v-select>
        <select :name="name" hidden>
            <option
                :value="internalValue.id"
                selected
                v-if="internalValue"
            ></option>
            <option
                :value="null"
                selected
                v-else
            ></option>
        </select>

        <div hidden v-if="value">
            {{ value.id || value }}
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import vSelect from "vue-select";
import {IModel} from "../../store/model.interface";

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

    public input(ev: any) {
        console.log(ev);
        this.internalValue = ev;
        this.initialError = null;
        this.$emit("input", ev);
        this.blur(ev);
    }

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
    private initialError: string = null;
    private isTouched = false;

    // ToDo Matthias
    public created() {
        console.log(this.options);
        this.initialError = this.initError;

        if (this.initValue) {
            this.internalValue = this.initValue;
        } else {
            this.internalValue = this.value;
        }
    }

    public beforeUpdate() {
        if (this.isBlade) {
            return;
        }
        this.internalValue = this.calcValue;
    }

    get calcValue() {
        return this.value;
    }

    @Emit()
    search(search: any, loading: any) {
        return { search, loading };
    }

    @Emit()
    blur(ev: any) {
        this.isTouched = true;
        return ev;
    }
}
</script>
