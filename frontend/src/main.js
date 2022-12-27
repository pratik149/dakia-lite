import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";
import axios from "./plugins/axios";
import "./assets/style.css";

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL;

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(axios, {
  baseUrl: apiBaseUrl,
});

app.mount("#app");
