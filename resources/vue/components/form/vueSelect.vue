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
            :filter="getFilter()"
            :class="{
                'is-invalid': showError
            }"
            @search:blur="blur"
        >
            <div slot="no-options">{{ lang("l.nothingFound") }}</div>
            <template #option="option" v-if="showOption">
                {{ showOption(option) }}
            </template>
            <template #selected-option="option" v-if="showOption">
                {{ showOption(option) }}
            </template>
        </v-select>
        <div class="text-xs vs__error" role="alert" v-if="showError">
            {{ initialError || fieldControl.errors[0] }}
        </div>
        <select :name="name" hidden>
            <option
                :value="internalValue.id"
                selected
                v-if="internalValue"
            ></option>
        </select>

        <div hidden v-if="value">
            {{ value.id || value }}
        </div>
    </div>
</template>

<script lang="ts">
import { Component } from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import vSelect from "vue-select";

@Component({
    components: {
        vSelect
    }
})
export default class VueSelect extends BaseComponent {

}
</script>
