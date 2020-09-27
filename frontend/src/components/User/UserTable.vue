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
      console.log("ja");
    },
  },
  computed: {
    ...mapGetters({ getcarList: "user/getcarList" }),
  },
  created() {
    this.getcarList;
  },
};
</script>
