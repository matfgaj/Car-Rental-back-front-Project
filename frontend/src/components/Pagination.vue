<template>
  <v-pagination
    v-model="currentPage"
    class="my-4"
    :length="lastPage"
    total-visible="6"
  ></v-pagination>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: ["store", "collection"],
  watch: {
    currentPage() {
      this.paginatePage();
    },
  },
  computed: {
    filters: {
      get() {
        return this.$store.state.cars.filters;
      },
    },
    currentPage: {
      get() {
        return this.$store.state.cars.pageInfo.meta.current_page;
      },
      set(value) {
        this.$store.commit("cars/SET_CURRENT_PAGE", value);
      },
    },
    lastPage: {
      get() {
        return this.$store.state.cars.pageInfo.meta.last_page;
      },
    },
  },
  methods: {
    ...mapActions({ GetPageData: "cars/GetPageData" }),

    paginatePage() {
      this.GetPageData(this.filters);
    },
  },
};
</script>
