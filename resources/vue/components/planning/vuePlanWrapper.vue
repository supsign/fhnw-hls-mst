<template>
    <div>
        <slot name="titel"></slot>
    </div>
</template>

<script lang="ts">
import {Component} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VuePlanWrapper extends BaseComponent {
}
</script>

