import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Signin from "../views/SignIn.vue";
import Profile from "../views/Profile.vue";
import Register from "../views/Register.vue";
import Edit from "../views/Edit.vue";
import Add from "../views/Add.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/signin",
    name: "signin",
    component: Signin,
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
  {
    path: "/add",
    name: "add",
    component: Add,
  },
  {
    path: "/edit",
    name: "edit",
    component: Edit,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
