<template>
  <v-container fluid grid-list-xl>
    <v-container class="cont-2">
      <v-layout row wrap>
        <v-flex v-for="filter in filters" :key="filter.name" xs12 sm4>
          <v-text-field
            v-model="filter.value"
            v-bind:label="filter.label"
          ></v-text-field>
        </v-flex>
        <v-row justify="center">
          <v-col cols="6" md="2">
            <v-btn @click="test">
              <v-icon class="mx-4" large> mdi-magnify</v-icon>
            </v-btn>
          </v-col>
        </v-row>
      </v-layout>
    </v-container>

    <v-layout wrap justify-space-around>
      <v-flex v-for="car in carsList" :key="car.id" xs12 sm6 md4>
        <v-card>
          <v-img
            src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
            aspect-ratio="2.75"
            ><v-container fluid>
              <v-layout>
                <v-flex xs12 align-end flexbox>
                  <span class="headline white--text">{{ car.name }}</span>
                </v-flex>
              </v-layout>
            </v-container></v-img
          >
          <v-card-title primary-title>
            <v-card-text small
              >{{ car.description.slice(0, 100) }}...</v-card-text
            >
          </v-card-title>
          <v-card-actions>
            <v-btn color="orange">Details</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";
import axios from "axios";

export default {
  name: "Home",
  data() {
    return {
      initialized: false,
      carsList: null,
      paginationLinks: null,
      displayedPage: null,
      filters: [
        { name: "name", label: "car name", value: "" },
        { name: "brand", label: "car brand", value: "" },
        { name: "year", label: "production year", value: "" },
      ],
    };
  },
  methods: {
    ...mapActions({
      signIn: "home/getCarsList",
    }),
    test() {
      console.log(this.paginationLinks);
    },

    async getFirtsCarsList() {
      if (!this.carsList) {
        let response = await axios.get("cars?page=1");
        if (response) {
          this.carsList = response.data.data;
          this.paginationLinks = response.data.links;
        }
      }
    },
  },
  created() {
    this.getFirtsCarsList().then(() => {
      this.initialized = true;
    });
  },
};
</script>
