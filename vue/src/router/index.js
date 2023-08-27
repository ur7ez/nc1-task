import {createRouter, createWebHistory} from "vue-router";
import DefaultLayout from "../components/DefaultLayout.vue";
import About from "../views/About.vue";
import Properties from "../views/Properties.vue";

const routes = [
  {
    path: '/',
    redirect: "/about",
    component: DefaultLayout,
    children: [
      { path: "/about", name: "About", component: About },
      { path: "/properties", name: "Properties", component: Properties },
      { path: "/search", name: "PropertySearch", component: Properties },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
