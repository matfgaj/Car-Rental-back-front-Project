<template>
  <v-app>
    <Navigation></Navigation>
    <router-view></router-view>'
    <v-flex>
      <v-footer absolute padless class="font-weight-medium">
        <v-col class="text-center" cols="12">
          {{ new Date().getFullYear() }} — <strong>Car Rent</strong>
        </v-col>
      </v-footer>
    </v-flex>
  </v-app>
</template>
<script>
import Navigation from "@/components/Navigation";

export default {
  components: {
    Navigation,
  },
};
</script>
