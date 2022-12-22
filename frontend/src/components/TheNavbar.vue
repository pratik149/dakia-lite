<script setup>
import { RouterLink } from "vue-router";
import IconMailerLite from "./icons/IconMailerLite.vue";
</script>

<template>
  <header class="flex shrink-0 justify-between bg-white p-4 mx-auto max-w-8xl">
    <RouterLink class="text-2xl font-black tracking-tight" to="/">
      <IconMailerLite />
    </RouterLink>
    <nav>
      <RouterLink class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100" to="/">Home</RouterLink>
      <RouterLink class="ml-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100" to="#">Account</RouterLink>
    </nav>
  </header>
</template>
