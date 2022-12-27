import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import SubscribersView from "../views/SubscribersView.vue";
import SubscriberView from "../views/SubscriberView.vue";

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
      component: SubscribersView,
    },
    {
      path: "/subscribers/:id",
      name: "subscriber-details",
      component: SubscriberView,
    },
  ],
});

export default router;
