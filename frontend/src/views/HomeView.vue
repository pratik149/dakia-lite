<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
  <main class="mx-auto flex h-full flex-auto flex-col justify-between py-16">
    <div class="max-w-md text-center">
      <h1 class="text-2xl font-semibold text-gray-700">Welcome to <span class="text-green-500"> DakiaLite </span></h1>
      <p class="mt-2 text-gray-500">
        Digital marketing tools to grow your audience faster and drive revenue smarter. Backed by 24/7 award-winning
        support.
      </p>
    </div>

    <RouterLink
      to="/subscribers"
      class="mx-auto block max-w-max rounded-lg bg-green-100 px-4 py-2 text-center text-3xl font-extrabold text-gray-800 transition duration-150 ease-out hover:bg-green-600 hover:text-white"
    >
      Explore
    </RouterLink>

    <p class="text-center text-gray-600">
      Made with 💚 by
      <a href="https://github.com/pratik149/" class="text-green-500 hover:text-green-600" target="_blank">
        @pratik149
      </a>
    </p>
  </main>
</template>
