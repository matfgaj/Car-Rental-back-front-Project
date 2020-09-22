<template>
  <nav>
    <v-toolbar color="grey" flat>
      <v-toolbar-title
        @click="home"
        class="text-uppercase black--text mainName"
      >
        <span class="font-weight-light white--text">Car</span>
        <span>Rent</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn
        v-if="!authenticated"
        :to="{ name: 'signin' }"
        class="text-uppercase black--text mx-4"
        small
      >
        <span>sign in </span>
        <v-icon small>mdi-login</v-icon>
      </v-btn>
      <v-btn
        v-if="!authenticated"
        :to="{ name: 'register' }"
        class="text-uppercase black--text mx-4"
        small
      >
        <span>register</span>
        <v-icon small>mdi-login</v-icon>
      </v-btn>
      <template v-if="authenticated">
        <v-btn
          :to="{ name: 'profile' }"
          class="text-uppercase black--text mx-4"
          small
        >
          <span>Profile</span>
        </v-btn>
        <v-btn
          href="#"
          @click.prevent="signOut"
          class="text-uppercase black--text mx-4"
          small
        >
          <span>signout</span>
          <v-icon small>mdi-logout</v-icon>
        </v-btn>
      </template>
    </v-toolbar>
  </nav>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
    }),
    signOut() {
      this.signOutAction().then(() => {});
    },
    home() {
      this.$router.replace({ path: "/" });
    },
  },
};
</script>
<style lang="css">
.mainName:hover {
  cursor: pointer;
}
</style>
