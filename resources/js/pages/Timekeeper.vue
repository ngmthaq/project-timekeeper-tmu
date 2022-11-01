<template>
  <auth-layout>
    <div class="header">
      <h2>Bảng chấm công</h2>
      <p>Số ngày công: 11/21</p>
    </div>
    <calendar :data="calendarData"></calendar>
  </auth-layout>
</template>

<script>
import { Calendar } from "../components";

export default {
  components: {
    calendar: Calendar,
  },

  data() {
    return {
      calendarData: [
        {
          checkin: "07:30",
          checkinColor: "#28a745",
          checkout: "15:30",
          checkoutColor: "#dc3545",
          date: "31/10/2022",
          off: 0,
        },
        {
          checkin: "07:30",
          checkinColor: "#28a745",
          checkout: "17:30",
          checkoutColor: "#28a745",
          date: "01/11/2022",
          off: 0,
        },
      ],
    };
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
