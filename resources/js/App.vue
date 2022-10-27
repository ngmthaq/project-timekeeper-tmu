<template>
  <v-app>
    <v-main>
      <router-view :key="updateLocaleTime"></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  metaInfo: {
    meta: [
      /* Your meta data here */
    ],
  },

  data() {
    return {
      updateLocaleTime: 0,
    };
  },

  methods: {
    changeLocale(locale) {
      this.updateLocaleTime++;
    },
  },

  created() {
    this.$bus.$on("changeLocale", this.changeLocale);
  },
};
</script>

<style>
</style>
