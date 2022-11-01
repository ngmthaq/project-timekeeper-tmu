<template>
  <div class="calendar-container">
    <div class="calendar-action">
      <v-btn class="mx-2" fab small plain @click="prevMonth">
        <v-icon large> mdi-menu-left </v-icon>
      </v-btn>
      <p>{{ dayHandle.format("MM") }}/{{ dayHandle.format("YYYY") }}</p>
      <v-btn class="mx-2" fab small plain @click="nextMonth">
        <v-icon large> mdi-menu-right </v-icon>
      </v-btn>
    </div>
    <div class="calendar-header">
      <div class="calendar-header-item" v-for="header in headers" :key="header">
        {{ header }}
      </div>
    </div>
    <div class="calendar-week" v-for="(week, index) in calendar" :key="index">
      <div
        class="calendar-day"
        v-for="(d, index) in week"
        :key="index"
        :data-day="d.day.format('DD/MM/YYYY')"
        :data-today="today.format('DD/MM/YYYY')"
        :class="{
          'disable-day':
            d.day.isBefore(startOfMonth) || d.day.isAfter(endOfMonth),
        }"
      >
        <div
          class="day"
          :class="{
            'current-day':
              d.day.format('DD/MM/YYYY') === today.format('DD/MM/YYYY'),
          }"
        >
          {{ d.day.format("DD") }}
        </div>
        <div
          class="checkin status"
          :style="{ backgroundColor: d.checkinColor }"
        >
          {{ d.checkin || "&nbsp;" }}
        </div>
        <div
          class="checkout status"
          :style="{ backgroundColor: d.checkoutColor }"
        >
          {{ d.checkout || "&nbsp;" }}
        </div>
        <!-- <div class="note">{{ d.note || "&nbsp;" }}</div> -->
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

const today = moment();
export default {
  props: {
    data: {
      type: Array,
    },
  },

  data() {
    return {
      startDay: today.clone().startOf("month").startOf("week"),
      endDay: today.clone().endOf("month").endOf("week"),
      day: today.clone().startOf("month").startOf("week").subtract(1, "day"),
      startOfMonth: today.clone().startOf("month"),
      endOfMonth: today.clone().endOf("month"),
      today: today.clone(),
      dayHandle: today.clone(),
      headers: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
    };
  },

  computed: {
    calendar() {
      let result = [];
      let day = this.day.clone();
      while (day.isBefore(this.endDay, "day")) {
        result.push(
          Array(7)
            .fill(0)
            .map(() => day.add(1, "day").clone())
        );
      }

      result = result.map((week) => {
        return week.map((day) => {
          let i = this.data.findIndex(
            (d) => d.date === day.format("DD/MM/YYYY")
          );

          if (i > -1) {
            let data = this.data[i];
            day = { day: day, ...data };
          } else {
            day = { day: day, checkin: "", checkout: "", note: "" };
          }

          return day;
        });
      });

      return result;
    },
  },

  methods: {
    nextMonth() {
      let next = this.dayHandle.clone().add(1, "month");
      let startDay = next.clone().startOf("month").startOf("week");
      let endDay = next.clone().endOf("month").endOf("week");
      let startOfMonth = next.clone().startOf("month");
      let endOfMonth = next.clone().endOf("month");
      let day = next
        .clone()
        .startOf("month")
        .startOf("week")
        .subtract(1, "day");

      this.startDay = startDay;
      this.endDay = endDay;
      this.day = day;
      this.startOfMonth = startOfMonth;
      this.endOfMonth = endOfMonth;
      this.dayHandle = next;
      this.$emit("changeMonth", next);
    },

    prevMonth() {
      let prev = this.dayHandle.clone().subtract(1, "month");
      let startDay = prev.clone().startOf("month").startOf("week");
      let endDay = prev.clone().endOf("month").endOf("week");
      let startOfMonth = prev.clone().startOf("month");
      let endOfMonth = prev.clone().endOf("month");
      let day = prev
        .clone()
        .startOf("month")
        .startOf("week")
        .subtract(1, "day");

      this.startDay = startDay;
      this.endDay = endDay;
      this.day = day;
      this.startOfMonth = startOfMonth;
      this.endOfMonth = endOfMonth;
      this.dayHandle = prev;
      this.$emit("changeMonth", prev);
    },
  },
};
</script>

<style lang="scss" scoped>
.calendar-container {
  border: 1px solid #999099;
  border-radius: 4px;
  overflow: hidden;

  & * {
    user-select: none;
  }
}

.calendar-week {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #999099;

  &:last-child {
    border-bottom: 0;
  }
}

.calendar-day {
  width: calc(100% / 7);
  height: 126px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-right: 1px solid #999099;
  flex-direction: column;

  &:last-child {
    border-right: 0;
  }
}

.calendar-header {
  display: flex;
  align-items: center;
  justify-content: space-between;

  &-item {
    font-weight: 600;
    width: calc(100% / 7);
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #999099;
    border-right: 1px solid #999099;

    &:last-child {
      border-right: 0;
    }
  }
}

.day {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 8px;
}

.current-day {
  background-color: rgba($color: #0c61ff, $alpha: 0.3) !important;
}

.disable-day {
  background-color: #ececec;
  color: #999099;

  & .status {
    opacity: 0.5;
  }
}

.status {
  color: #ffffff;
  padding: 2px 24px;
  border-radius: 4px;
  margin-bottom: 2px;
}

.calendar-action {
  display: flex;
  justify-content: space-between;
  align-content: center;
  padding: 16px;
  border-bottom: 1px solid #999999;

  & p {
    display: flex;
    align-items: center;
    font-weight: 600;
    font-size: 18px;
  }
}
</style>
