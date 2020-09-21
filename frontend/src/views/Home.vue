<template>
  <div>home</div>
</template>

<script>
export default {
  name: "Home",
  components: {},
  data() {
    return {
      initialized: false,
    };
  },
  created() {
    this.fetchData().then(() => {
      this.initialized = true;
    });
  },
};
</script>
