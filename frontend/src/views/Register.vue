<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12">
          <v-toolbar color="grey" dark flat>
            <v-toolbar-title>Welcome</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-icon @click="redirect('')">mdi-close</v-icon>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" :lazy-validation="lazy"
              ><v-text-field
                label="First name"
                name="firstname"
                prepend-icon="mdi-card-account-details"
                type="text"
                v-model="form.firstname"
                :rules="firstnameRules"
              ></v-text-field
              ><v-text-field
                label="Last Name"
                name="lastname"
                prepend-icon="mdi-card-account-details"
                type="text"
                v-model="form.lastname"
                :rules="lastnameRules"
              ></v-text-field>
              <v-text-field
                label="Email"
                name="email"
                prepend-icon="mdi-account"
                type="text"
                v-model="form.email"
                :rules="emailRules"
              >
              </v-text-field>
              <v-text-field
                label="Password"
                name="password"
                prepend-icon="mdi-lock"
                type="text"
                v-model="form.password"
                :rules="passwordRules"
              ></v-text-field>
              <v-text-field
                label="Confirm Password"
                name="confirm"
                prepend-icon="mdi-ticket-confirmation"
                type="text"
                v-model="form.confirm"
                :rules="confirmRules.concat(passwordConfirmationRule)"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              :disabled="!valid"
              type="submit"
              @click="
                register(form).then(() => {
                  clear();
                  redirect('signin');
                })
              "
              dark
              color="grey"
              >Register</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      valid: true,
      form: {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirm: "",
      },
      lazy: false,
      firstnameRules: [
        (v) => !!v || "First name is required",
        (v) => v.length <= 10 || "Name must be less than 10 characters",
      ],
      lastnameRules: [
        (v) => !!v || "Last name is required",
        (v) => v.length <= 10 || "Name must be less than 10 characters",
      ],
      emailRules: [
        (v) =>
          !v ||
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "E-mail must be valid",
        (v) => !!v || "Email name is required",
      ],
      passwordRules: [(v) => !!v || "Password is required"],
      confirmRules: [(v) => !!v || "Password is required"],
    };
  },
  computed: {
    passwordConfirmationRule() {
      return () =>
        this.form.password === this.form.confirm || "Password must match";
    },
  },
  methods: {
    ...mapActions({
      register: "auth/register",
    }),

    redirect(where) {
      this.$router.replace({ path: `/${where}` });
    },
    clear() {
      this.form = {
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirm: "",
      };
    },
  },
};
</script>
