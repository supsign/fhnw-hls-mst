<template>
    <div>
        <div v-if="icon === 1" class="my-auto text-lg flex-none">
            <i class="far fa-check-circle" aria-hidden="true"></i>
        </div>

        <div v-if="icon === 2" class="my-auto text-lg flex-none">
            <i class="far fa-times-circle" aria-hidden="true"></i>
        </div>

        <div v-else class="my-auto text-lg flex-none">
            <i class="far fa-circle" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';

@Component
export default class VueCompletion extends BaseComponent {
    @Prop({ type: Number })
    public icon: number;
}
</script>
