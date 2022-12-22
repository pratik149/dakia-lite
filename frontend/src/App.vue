<script setup>
import { RouterView } from "vue-router";

// Components
import TheNavbar from "./components/TheNavbar.vue";
// import TheFooter from "./components/TheFooter.vue";
</script>

<template>
  <TheNavbar />

  <RouterView />

  <!-- <TheFooter /> -->
</template>
