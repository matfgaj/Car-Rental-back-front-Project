<template>
  <v-parallax height="100%" src="@/assets/winding-road.jpg">
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="grey" dark flat>
              <v-card-text>
                Edit only fields you want to change in selected car
              </v-card-text>
              <v-spacer></v-spacer>
              <v-icon
                @click="
                  redirect('profile').then(() => {
                    this.SetSelectedCar([]);
                  })
                "
                >mdi-close</v-icon
              >
            </v-toolbar>
            <v-card-text>
              <v-form v-model="valid" :lazy-validation="lazy">
                <v-text-field
                  label="Brand"
                  name="brand"
                  prepend-icon="mdi-alpha-b-circle"
                  type="text"
                  v-model="form.brand"
                >
                </v-text-field>
                <v-text-field
                  label="Model"
                  name="model"
                  prepend-icon="mdi-car-info"
                  type="text"
                  v-model="form.model"
                ></v-text-field
                ><v-text-field
                  label="Production year"
                  name="productionyear"
                  prepend-icon="mdi-calendar-range"
                  type="number"
                  suffix="y."
                  v-model="form.productionyear"
                ></v-text-field>
                <v-textarea
                  label="Desription"
                  name="description"
                  prepend-icon="mdi-card-text"
                  type="text"
                  v-model="form.description"
                ></v-textarea>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                :disabled="!valid"
                type="submit"
                @click="editClick()"
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
    };
  },
  methods: {
    ...mapActions({
      EditCar: "cars/EditCar",
      SetSelectedCar: "cars/SetSelectedCar",
    }),
    editClick() {
      this.EditCar(this.form).then(() => {
        this.clear();
        this.redirect("profile");
        alert("You have edited selected car");
        this.SetSelectedCar([]);
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
