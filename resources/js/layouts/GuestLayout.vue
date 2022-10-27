<template>
  <div class="guest-layout">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "GuestLayout",

  created() {
    console.log(this);
  }
};
</script>

<style>
</style>
