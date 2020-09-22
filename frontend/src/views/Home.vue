<template>
  <v-container fluid grid-list-xl>
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
    };
  },
  methods: {
    ...mapActions({
      signIn: "home/getCarsList",
    }),
    async getFirtsCarsList() {
      if (!this.carsList) {
        let response = await axios.get("cars?page=1");
        if (response) {
          this.carsList = response.data.data;
          console.log(this.carsList);
          this.paginationLinks = response.data.links;
          console.log(this.paginationLinks);
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
