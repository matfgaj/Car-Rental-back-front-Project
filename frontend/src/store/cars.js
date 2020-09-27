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
    adminCars: [],
    selectedCar: null,
  },
  mutations: {
    SET_PAGEINFO(state, pageInfo) {
      state.pageInfo = pageInfo;
    },
    SET_PAGEINFO_DATA(state, data) {
      state.pageInfo.data = data;
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
    SET_ADMIN_CARS(state, data) {
      state.adminCars = data;
    },
    SET_SELECTED_CAR(state, car) {
      state.selectedCar = car;
    },
  },
  getters: {
    getAdminCars: (state) => {
      return state.adminCars;
    },
  },
  actions: {
    async GetPageData({ commit, state }, filters) {
      if (state.initialized) {
        commit("SET_INITIALIZED", false);
      }
      const pageNumber = state.pageInfo.meta.current_page;
      const response = await axios.get(
        `cars/available?page=${pageNumber}&brand=${filters[0].value}&model=${filters[1].value}&productionyear=${filters[2].value}`
      );

      commit("SET_CURRENT_FILLTERS", filters);
      commit("SET_PAGEINFO", response.data);
      commit("SET_INITIALIZED", true);

      return await response;
    },
    setCurrentPage({ commit }, data) {
      commit("SET_CURRENT_PAGE", data);
    },

    async GetAllCars({ commit }) {
      const response = await axios.get(`cars`);
      commit("SET_ADMIN_CARS", response.data.data);
    },
    async AddNewCar(_, form) {
      const newForm = {
        name: `${form.brand} ${form.model}`,
        brand: form.brand,
        model: form.model,
        productionyear: form.productionyear,
        description: form.description,
        rented: 0,
      };
      await axios.post(`car`, newForm);
    },
    SetSelectedCar({ commit }, data) {
      commit("SET_SELECTED_CAR", data);
    },

    async EditCar({ state }, form) {
      const newForm = {
        car_id: state.selectedCar[0].id,
        brand: state.selectedCar[0].brand,
        model: state.selectedCar[0].model,
        description: state.selectedCar[0].description,
        productionyear: state.selectedCar[0].productionyear,
        rented: state.selectedCar[0].rented,
        name: state.selectedCar[0].rented,
      };

      if (form.brand !== "") {
        newForm.brand = form.brand;
      }
      if (form.model !== "") {
        newForm.model = form.model;
      }
      if (form.description !== "") {
        newForm.description = form.description;
      }
      if (form.productionyear !== "") {
        newForm.productionyear = form.productionyear;
      }
      if (form.brand !== "" && form.model !== "") {
        newForm.name = `${form.brand} ${form.model}`;
      }

      const response = await axios.put(`car`, newForm);
      console.log(response);
    },
  },
};
