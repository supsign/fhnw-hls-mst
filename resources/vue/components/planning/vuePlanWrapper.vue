<template>
  <div class="p-2 bg-white rounded shadow mb-4">
    <div class="content-center text-base" @click="toggleCollapse">

      <div class="flex flex-row justify-between space-x-3">
        <div class="my-auto">
          <i v-if="isCollapsed" aria-hidden="true" class="fas fa-arrow-right"></i>
          <i v-if="!isCollapsed" aria-hidden="true" class="fas fa-arrow-down"></i>
        </div>
        <slot name="header"></slot>
      </div>

    </div>
    <div v-if="!isCollapsed" class="pt-2 pb-0 text-sm lg:text-base">
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
  public break = 1024;

  public toggleCollapse() {
    this.isCollapsed = !this.isCollapsed;
  }

  public expand() {
    this.isCollapsed = false;
  }

  public handlerResize() {
    if (window.innerWidth > this.break) {
      this.expand();
    }
  }

  public mounted() {
    window.addEventListener('resize', this.handlerResize);
    this.handlerResize()
  }

  public destroyed() {
    window.removeEventListener('resize', this.handlerResize);
  }


}


</script>

