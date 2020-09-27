export default {
  namespaced: true,

  state: {
    carsList: null,
  },
  getters: {
    getcarList: (state) => {
      return state.carsList;
    },
  },
  mutations: {
    SET_CARS_LIST(state, data) {
      state.carsList = data;
    },
  },
  actions: {
    setCarsList({ commit }, data) {
      commit("SET_CARS_LIST", data);
    },
  },
};
