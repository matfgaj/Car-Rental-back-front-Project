<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12">
          <v-toolbar color="grey" dark flat>
            <v-toolbar-title>Sign In</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-icon
              @click="
                home().then(() => {
                  clear();
                })
              "
              >mdi-close</v-icon
            >
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field
                label="email"
                name="email"
                prepend-icon="mdi-account"
                type="text"
                v-model="form.email"
              >
              </v-text-field>
              <v-text-field
                label="Password"
                name="password"
                prepend-icon="mdi-lock"
                type="text"
                v-model="form.password"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="submit" dark color="grey">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "signin",
  components: {
    //
  },
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
    }),
  },
  methods: {
    ...mapActions({
      signIn: "auth/signIn",
    }),
    submit() {
      this.signIn(this.form).then(() => {
        this.$router.replace({
          name: `${this.authenticated ? "profile" : "Home"}`,
        });
      });
    },
    home() {
      this.$router.replace({ path: "/" });
    },
    clear() {
      this.form.email = "";
      this.form.password = "";
    },
  },
};
</script>
