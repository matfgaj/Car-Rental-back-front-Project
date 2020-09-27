<template
  ><v-container>
    <v-bottom-navigation grow dark>
      <v-btn
        v-bind:class="{ 'v-btn--active': active }"
        mandatory
        @click="myCarsChange"
      >
        <span>My cars</span>
        <v-icon large>mdi-car-sports</v-icon>
      </v-btn>

      <v-btn @click="historyChange">
        <span>History</span>
        <v-icon large>mdi-clipboard-text</v-icon>
      </v-btn>
    </v-bottom-navigation>
    <UserTable></UserTable>
  </v-container>
</template>
<script>
import UserTable from "@/components/User/UserTable";
import { mapActions } from "vuex";

export default {
  components: { UserTable },

  data() {
    return {
      active: false,
    };
  },

  methods: {
    ...mapActions({
      setCarsList: "user/setCarsList",
      checkAuth: "auth/checkAuth",
    }),

    historyChange() {
      this.setCarsList(JSON.parse(this.$store.state.auth.user.history));
      this.active = false;
    },
    myCarsChange() {
      this.setCarsList(JSON.parse(this.$store.state.auth.user.cars));
    },
  },
  created() {
    this.checkAuth();
    this.setCarsList(JSON.parse(this.$store.state.auth.user.cars));
    this.active = true;
  },
};
</script>
