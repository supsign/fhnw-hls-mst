<template>
    <div class="p-2 rounded bg-white flex flex-col shadow-xl">
        <div v-if="$slots.title" class="content-center p-2 border-b rounded-t text-base md:text-lg">
            <slot name="title"></slot>
        </div>

        <div class="p-3 text-sm md:text-base flex-grow">
            <slot></slot>
        </div>

        <div v-if="$slots.footer" class="border-t border-gray-200 pt-2">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script lang="ts">
import { Component } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';

@Component
export default class VueCard extends BaseComponent {}
</script>
