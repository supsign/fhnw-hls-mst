<template>
    <div class="p-2 bg-white rounded shadow mb-4">
        <div class="content-center p-2 rounded-t text-base" @click="toggleCollapse">

            <div class="flex flex-row justify-between space-x-2">
                <div class="my-auto">
                    <i v-if="isCollapsed" aria-hidden="true" class="fas fa-arrow-right"></i>
                    <i v-if="!isCollapsed" aria-hidden="true" class="fas fa-arrow-down"></i>
                </div>
                <slot name="header"></slot>
            </div>

        </div>
        <div v-if="!isCollapsed" class="p-3 border-t">
            <slot></slot>
        </div>
    </div>
</template>

<script lang="ts">
import {Component} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";

@Component
export default class VuePlanWrapper extends BaseComponent {
    public isCollapsed = true;

    public toggleCollapse() {
        this.isCollapsed = !this.isCollapsed;
    }


}
</script>

