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
          <v-col cols="6" sm="1">
            <v-btn @click="getCarsList(filters)">
              <v-icon class="mx-4" large> mdi-magnify</v-icon>
            </v-btn>
          </v-col>
        </v-row>
      </v-layout>
    </v-container>

    <v-layout wrap justify-space-around>
      <v-flex v-for="car in carsList" :key="car.id" xs6 sm4 md2>
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
    <v-flex>
      <Pagination
        v-if="initialized"
        store="cars"
        collection="pageInfo"
      ></Pagination>
    </v-flex>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";
import Pagination from "@/components/Pagination";

export default {
  components: {
    Pagination,
  },
  name: "Home",
  data() {
    return {
      filters: [
        { name: "brand", label: "car brand", value: "" },
        { name: "model", label: "car model", value: "" },
        { name: "year", label: "production year", value: "" },
      ],
    };
  },
  computed: {
    carsList: {
      get() {
        return this.$store.state.cars.pageInfo.data;
      },
    },
    initialized: {
      get() {
        return this.$store.state.cars.initialized;
      },
    },
  },
  methods: {
    ...mapActions({ GetPageData: "cars/GetPageData" }),

    async getCarsList() {
      this.GetPageData(this.filters);
    },
  },

  created() {
    if (!this.carsList) {
      this.getCarsList();
    }
  },
};
</script>
