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
                v-mask="mask"
                class="w-full input__field"
                :class="{
                    'is-invalid': showError
                }"
                autofocus
                :autocomplete="'current-' + name"
                placeholder=" "
            />
            <span class="input__label" ref="tooltipp">
                {{ label }}{{ required ? " *" : "" }}
                <i v-if="tooltipp" class="fas fa-info-circle"></i>
            </span>

            <span class="text-xs input__error" role="alert" v-if="showError">
                {{ initialError || fieldControl.errors[0] }}
            </span>
        </label>
    </div>
</template>

<script lang="ts">
import { Component } from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VueInput extends BaseComponent {

}
</script>
