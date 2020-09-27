<template>
  <v-container fluid grid-list-xl>
    <template v-if="loading"
      ><v-overlay>
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>
    </template>
    <template v-if="loading == false">
      <v-parallax height="100%" src="@/assets/winding-road.jpg">
        <v-container class="cont-2">
          <v-layout row wrap>
            <v-flex v-for="filter in filters" :key="filter.name" xs12 sm4>
              <v-text-field
                dark
                v-model="filter.value"
                v-bind:label="filter.label"
              ></v-text-field>
            </v-flex>
            <v-row justify="center">
              <v-col cols="6" sm="1">
                <v-btn @click="getCarsList(filters)">
                  <v-icon class="mx-4" large>mdi-magnify</v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </v-layout>
        </v-container>

        <v-layout wrap justify-space-around>
          <v-flex v-for="car in carsList" :key="car.id" xs12 sm6 md3>
            <v-card>
              <v-img src="../assets/bmw.jpg" aspect-ratio="2.4"> </v-img>
              <v-container fluid>
                <v-layout>
                  <v-flex xs12 align-center flexbox>
                    <span class="headline "> {{ car.brand }} </span>
                    <v-spacer></v-spacer>
                    <span class="headline "> {{ car.model }} </span>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card-title primary-title>
                <v-card-text small
                  >{{ car.description.slice(0, 40) }}...</v-card-text
                >
              </v-card-title>
              <v-card-actions>
                <v-btn :id="car.id" @click="getdetail" dark rounded color="grey"
                  ><span @click="getdetail" :id="car.id">Details</span></v-btn
                >
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>

        <v-flex>
          <Pagination store="cars" collection="pageInfo"></Pagination>
        </v-flex>

        <v-row justify="center">
          <v-dialog v-model="details" max-width="1000">
            <v-card>
              <v-card-title class="headline">{{ car.name }}</v-card-title>
              <v-img src="../assets/bmw.jpg" aspect-ratio="2.75"> </v-img>
              <v-card-text> Brand: {{ car.brand }} </v-card-text>
              <v-card-text> Model: {{ car.model }} </v-card-text>
              <v-card-text>
                Year of production: {{ car.productionyear }}
              </v-card-text>

              <v-card-text> Description: {{ car.description }}. </v-card-text>

              <v-card-actions>
                <v-flex v-if="role === 'user'">
                  <v-btn color="green darken-1" outlined rounded @click="rent">
                    Rent Me
                  </v-btn>
                </v-flex>
                <v-spacer> </v-spacer>
                <v-btn color="orange darken-1" text @click="details = false">
                  close
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </v-parallax>
    </template>
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
      role: "guest",
      loading: false,
      details: false,
      car: {},

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
  },
  methods: {
    ...mapActions({
      GetPageData: "cars/GetPageData",
      PostUserRent: "PostUserRent",
      checkAuth: "auth/checkAuth",
    }),

    getCarsList() {
      this.GetPageData(this.filters);
    },
    getdetail(event) {
      this.details = true;
      let currentCar = this.carsList.find((car) => {
        if (car.id == event.target.id) {
          currentCar = car;
        }
        this.car = currentCar;
      });
    },

    async rent() {
      this.loading = true;
      const response = await this.PostUserRent(this.car);
      if (response) {
        console.log("response");
        this.getCarsList();
        this.details = false;
        this.loading = false;
      }
    },
    checkIfLogedIn() {
      if (this.$store.state.auth.user == null) {
        this.role = "guest";
      } else if (this.$store.state.auth.user.role == "user") {
        this.role = "user";
      }
    },
  },

  created() {
    this.loading = true;
    this.checkIfLogedIn();
    this.getCarsList();
    this.loading = false;
  },
};
</script>
