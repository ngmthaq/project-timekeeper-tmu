<template>
  <auth-layout>
    <div class="header">
      <h2>Bảng chấm công</h2>
      <p>Số ngày công: 11/21</p>
    </div>
    <calendar
      :data="calendarData"
      @initial="getData"
      @changeMonth="getData"
    ></calendar>
  </auth-layout>
</template>

<script>
import moment from "moment";
import { Calendar } from "../components";

export default {
  components: {
    calendar: Calendar,
  },

  data() {
    return {
      calendarData: [],
    };
  },

  methods: {
    async getData(data) {
      let date = data.clone().format("YYYY-MM-DD");
      let res = await this.$store.dispatch("timekeeper/getCheckinData", {
        date: date,
      });

      if (res.status === 200) {
        this.calendarData = res.data.map((date) => ({
          ...date,
          date: moment(date.date).format("DD/MM/YYYY"),
        }));
      } else {
        alert("Đã xảy ra lỗi");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 24px;
}
</style>
