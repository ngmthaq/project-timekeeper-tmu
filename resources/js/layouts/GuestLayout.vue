<template>
  <div class="guest-layout">
    <slot></slot>
  </div>
</template>

<script>
import localStorageData from "../configs/localStorage";

export default {
  name: "GuestLayout",

  created() {
    if (localStorage.getItem(localStorageData.key.auth)) {
      this.$router.push({ name: "Timekeeper" });
    }
  },
};
</script>

<style>
</style>
