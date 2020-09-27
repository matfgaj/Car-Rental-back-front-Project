import axios from "axios";

export default {
  namespaced: true,

  state: {
    token: null,
    user: null,
  },
  getters: {
    authenticated(state) {
      return state.token && state.user;
    },
    user(state) {
      return state.user;
    },
  },
  mutations: {
    SET_TOKEN(state, token) {
      state.token = token;
    },
    SET_USER(state, user) {
      state.user = user;
    },
  },
  actions: {
    async signIn({ dispatch }, credentials) {
      let response = await axios.post("auth/signin", credentials).catch((e) => {
        if (!e.response || e.response.status === 401) {
          return alert("invalid data");
        }
      });
      if (response) {
        return dispatch("attempt", response.data.token);
      }
    },

    async attempt({ commit, state }, token) {
      if (token) {
        commit("SET_TOKEN", token);
      }

      if (!state.token) {
        return;
      }

      try {
        let response = await axios.get("auth/me");

        commit("SET_USER", response.data);
      } catch (e) {
        commit("SET_TOKEN", null);
        commit("SET_USER", null);
      }
    },

    signOut({ commit }) {
      return axios.post("auth/signout").then(() => {
        commit("SET_TOKEN", null);
        commit("SET_USER", null);
      });
    },
    async register(_, passedForm) {
      let form = {
        name: `${passedForm.firstname} ${passedForm.lastname}`,
        email: `${passedForm.email}`,
        password: `${passedForm.password}`,
      };
      const response = await axios.post("register", form);
      if (response) {
        return alert("gratulacje udało Ci się założyć konto");
      }
    },
    checkAuth({ dispatch, state }) {
      dispatch("attempt", state.token);
    },
  },
};
