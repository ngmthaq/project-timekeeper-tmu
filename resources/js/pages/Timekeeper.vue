<template>
  <auth-layout>
    <div class="header">
      <h2>Bảng chấm công</h2>
      <p>Số ngày công: {{ actualWorkdays }}/{{ workingDays }}</p>
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
      workingDays: 0,
      actualWorkdays: 0,
    };
  },

  methods: {
    async getData(data) {
      let date = data.clone().format("YYYY-MM-DD");
      let res = await this.$store.dispatch("timekeeper/getCheckinData", {
        date: date,
      });

      if (res.status === 200) {
        this.workingDays = res.data.workingDays;
        this.actualWorkdays = res.data.actualWorkdays;
        this.calendarData = res.data.data.map((date) => ({
          ...date,
          date: moment(date.date).format("DD/MM/YYYY"),
          dayOffs: Object.values(date.dayOffs),
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
