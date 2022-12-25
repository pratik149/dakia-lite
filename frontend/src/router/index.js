import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/subscribers",
      name: "subscribers",
      component: () => import("../views/SubscribersView.vue"),
    },
    {
      path: "/subscribers/:id",
      name: "subscriber-details",
      component: () => import("../views/SubscriberView.vue"),
    },
  ],
});

export default router;
