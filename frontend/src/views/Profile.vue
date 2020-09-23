<template
  ><div>
    <AdminProfile v-if="role === 'admin'"> </AdminProfile>
    <UserProfile v-if="role === 'user'"></UserProfile>
  </div>
</template>

<script>
import AdminProfile from "@/components/AdminProfile";
import UserProfile from "@/components/UserProfile";

export default {
  name: "Profile",
  components: {
    AdminProfile,
    UserProfile,
  },
  data() {
    return {
      role: this.$store.state.auth.user.role,
    };
  },
  methods: {
    test() {
      console.log(this.$store.state.auth.user.role);
    },
  },
};
</script>
