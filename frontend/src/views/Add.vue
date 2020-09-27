<template>
  <v-parallax height="100%" src="@/assets/winding-road.jpg">
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="grey" dark flat>
              <v-toolbar-title>Add new Car</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-icon @click="redirect('profile')">mdi-close</v-icon>
            </v-toolbar>
            <v-card-text>
              <v-form v-model="valid" :lazy-validation="lazy">
                <v-text-field
                  label="Brand"
                  name="brand"
                  prepend-icon="mdi-alpha-b-circle"
                  type="text"
                  :rules="brandRules"
                  v-model="form.brand"
                >
                </v-text-field>
                <v-text-field
                  label="Model"
                  name="model"
                  prepend-icon="mdi-car-info"
                  type="text"
                  :rules="modelRules"
                  v-model="form.model"
                ></v-text-field
                ><v-text-field
                  label="Production year"
                  name="productionyear"
                  prepend-icon="mdi-calendar-range"
                  type="number"
                  suffix="y."
                  :rules="productionyearRules"
                  v-model="form.productionyear"
                ></v-text-field>
                <v-textarea
                  label="Desription"
                  name="description"
                  prepend-icon="mdi-card-text"
                  type="text"
                  :rules="descriptionRules"
                  v-model="form.description"
                ></v-textarea>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                :disabled="!valid"
                type="submit"
                @click="addClick()"
                dark
                color="grey"
                >Add</v-btn
              >
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-parallax>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      valid: true,
      lazy: false,
      form: {
        brand: "",
        model: "",
        productionyear: "",
        description: "",
      },

      brandRules: [
        (v) => !!v || "Brand is required",
        (v) => v.length <= 10 || "Brand must be less than 10 characters",
      ],
      modelRules: [
        (v) => !!v || "Model is required",
        (v) => v.length <= 10 || "Model must be less than 10 characters",
      ],
      productionyearRules: [
        (v) => !!v || "Year name is required",
        (v) => v.length <= 5 || "Year must be less than 10 characters",
      ],
      descriptionRules: [
        (v) => !!v || "Description name is required",
        (v) =>
          v.length <= 350 || "Description must be less than 350 characters",
      ],
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
      AddNewCar: "cars/AddNewCar",
    }),
    addClick() {
      this.AddNewCar(this.form).then(() => {
        this.clear();
        this.redirect("profile");
        alert("  you have created a new car");
      });
    },

    redirect(where) {
      this.$router.replace({ path: `/${where}` });
    },
    clear() {
      this.form = {
        brand: "",
        model: "",
        productionyear: "",
        description: "",
      };
    },
  },
};
</script>
