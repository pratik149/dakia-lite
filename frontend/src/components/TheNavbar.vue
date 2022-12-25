<script setup>
import { RouterLink } from "vue-router";
import IconDakiaLite from "./icons/IconDakiaLite.vue";
</script>

<template>
  <header class="mx-auto flex w-full max-w-8xl flex-initial basis-auto justify-between bg-white px-4 py-6">
    <RouterLink class="text-2xl font-black tracking-tight" to="/">
      <IconDakiaLite />
    </RouterLink>
    <nav>
      <RouterLink class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100" to="/">Home</RouterLink>
      <RouterLink class="ml-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100" to="#">Account</RouterLink>
    </nav>
  </header>
</template>
