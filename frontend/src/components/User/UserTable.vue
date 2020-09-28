<template
  ><div>
    <v-data-table
      class="elevation-1"
      :headers="headers"
      :items="getcarList"
    ></v-data-table>
  </div>
</template>

<script>
import Vue from "vue";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      headers: [
        {
          text: "brand",
          value: "brand",
        },
        { text: "model", value: "model" },
        { text: "Production year", value: "productionyear" },
        { text: "Description", value: "description" },
      ],
    };
  },
  watch: {
    getcarList() {
      this.getcarList;
    },
  },
  computed: {
    ...mapGetters({ getcarList: "user/getcarList" }),
  },
  created() {
    this.getcarList;
    Vue.forceUpdate();
  },
};
</script>
