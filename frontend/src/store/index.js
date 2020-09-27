import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import auth from "./auth";
import cars from "./cars";
import user from "./user";

Vue.use(Vuex);

export default new Vuex.Store({
  namespaced: true,

  state: {},
  mutations: {},
  actions: {
    async PostUserRent({ state }, car) {
      if (state.auth.user.cars === "[]") {
        let newArray = JSON.stringify([car]);

        axios.put(`user?user_id=${state.auth.user.id}&cars=${newArray}`);
        const response = await axios.post(`car/${car.id}/rent`);
        return response;
      } else {
        let carsArray = JSON.parse(state.auth.user.cars);
        let newcarsArray = [...carsArray, car];
        const arrayToSend = JSON.stringify(newcarsArray);
        axios.put(`user?user_id=${state.auth.user.id}&cars=${arrayToSend}`);
        const response = await axios.post(`car/${car.id}/rent`);
        return response;
      }
    },
  },
  modules: { auth, cars, user },
});
