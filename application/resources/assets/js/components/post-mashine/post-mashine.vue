<template>
    <h1>This is an example component</h1>
</template>

<script lang="ts">

import Vue from "vue"
import Component from "vue-class-component"

@Component
export default class postMashine extends Vue {
    //
    public name = "post-mashine"

    constructor() {
      super()
      console.log("Class component works.")
    }

}

</script>
