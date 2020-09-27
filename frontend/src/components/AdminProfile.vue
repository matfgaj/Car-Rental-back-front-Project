<template
  ><v-container>
    <v-data-table
      v-model="selected"
      :headers="headers"
      :items="getAdminCars"
      :single-select="true"
      item-key="id"
      show-select
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar dense dark
          ><v-toolbar-title class="text-uppercase black--text mainName pa-md-4">
            <span class="font-weight-light white--text">all your </span>
            <span class="orange--text">cars</span>
          </v-toolbar-title>
          <v-row justify="start">
            <v-col :key="button.name" v-for="button in buttons" cols="6" sm="1">
              <v-btn medium icon @click="button.function">
                <v-icon class="mx-4" medium>{{ button.icon }}</v-icon>
              </v-btn>
            </v-col>
          </v-row>
        </v-toolbar>
      </template>
    </v-data-table>
    <v-spacer pa-md-4 mx-lg-auto></v-spacer>
  </v-container>
</template>

<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";

export default {
  data() {
    return {
      buttons: [
        { name: "add", function: () => this.redirect("add"), icon: "mdi-plus" },
        {
          name: "edit",
          function: () => this.redirectEdit(),
          icon: "mdi-pencil",
        },
        {
          name: "delete",
          function: this.delete,
          icon: "mdi-delete",
        },
      ],
      selected: [],
      headers: [
        { text: "Brand", value: "id" },

        { text: "Name", align: "start", sortable: false, value: "name" },
        { text: "Brand", value: "brand" },
        { text: "Model", value: "model" },
        { text: "Description", value: "description" },
        { text: "Year of production", value: "productionyear" },
        { text: "Rented", value: "rented" },
      ],
    };
  },
  computed: {
    ...mapGetters({ getAdminCars: "cars/getAdminCars" }),
  },
  methods: {
    ...mapActions({
      checkAuth: "auth/checkAuth",
      GetAllCars: "cars/GetAllCars",
      SetSelectedCar: "cars/SetSelectedCar",
    }),
    redirect(where) {
      this.$router.replace({ name: `${where}` });
    },
    redirectEdit() {
      if (this.selected.length !== 0) {
        this.SetSelectedCar(this.selected);
        this.$router.replace({ name: `edit` });
      }
    },
    delete() {
      this.GetAllCars();
      if (this.selected !== []) {
        const id = this.selected[0].id;
        axios.delete(`car/${id}`);
        this.selected = [];
        this.GetAllCars();
        this.checkAuth();
      }
    },
  },
  created() {
    this.GetAllCars();
    this.getAdminCars;
    this.checkAuth();
  },
};
</script>
