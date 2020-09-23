import axios from "axios";

export default {
  namespaced: true,

  state: {
    pageInfo: {
      meta: {
        current_page: 1,
      },
    },
    filters: [],
    initialized: false,
  },
  mutations: {
    SET_PAGEINFO(state, pageInfo) {
      state.pageInfo = pageInfo;
    },

    SET_CURRENT_FILLTERS(state, data) {
      state.filters = data;
    },
    SET_CURRENT_PAGE(state, data) {
      state.pageInfo.meta.current_page = data;
    },
    SET_INITIALIZED(state, data) {
      state.initialized = data;
    },
  },
  actions: {
    async GetPageData({ commit, state }, filters) {
      if (state.initialized) {
        commit("SET_INITIALIZED", false);
      }
      const pageNumber = state.pageInfo.meta.current_page;
      const response = await axios.get(
        `cars?page=${pageNumber}&brand=${filters[0].value}&model=${filters[1].value}&productionyear=${filters[2].value}`
      );
      commit("SET_CURRENT_FILLTERS", filters);
      commit("SET_PAGEINFO", response.data);
      commit("SET_INITIALIZED", true);
    },
    setCurrentPage({ commit }, data) {
      commit("SET_CURRENT_PAGE", data);
    },
  },
};
