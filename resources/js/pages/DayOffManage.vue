<template>
  <auth-layout>
    <v-sheet class="box_title">
      <h3>Danh sách nhân viên đăng ký nghỉ phép</h3>
      <input type="month" id="selectMonth" v-model="monthYear" class="selectMonth" @change="getData">
    </v-sheet>
    <v-sheet class="box_body">
      <v-data-table :headers="headers" :items="desserts" lang="vi" :items-per-page="10" class="elevation-1">
        <template v-slot:item.option="{ item, index }">
          <div v-if="item.option == 0 ? true : false" id="hide">
            <v-dialog width="500" v-model="isOpenRefuse">
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" @click="id = item.id">
                  <v-icon large color="green darken-2">
                    mdi-close
                  </v-icon>
                </v-btn>
              </template>
              <v-card style="padding: 10px">
                <v-card-title class="text-h5 lighten-2 title">
                  Xác nhận từ chối
                </v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="submitRefuse">
                    Xác nhận
                  </v-btn>
                  <v-btn @click="isOpenRefuse = false">
                    Hủy bỏ
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog width="500" v-model="isOpenAccept">
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" @click="id = item.id">
                  <v-icon large color="green darken-2">
                    mdi-check
                  </v-icon>
                </v-btn>
              </template>
              <v-card style="padding: 10px">
                <v-card-title class="text-h5 lighten-2 title">
                  Xác nhận chấp nhận
                </v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="submitAccept">
                    Xác nhận
                  </v-btn>
                  <v-btn @click="isOpenAccept = false">
                    Hủy bỏ
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </div>
        </template>
      </v-data-table>
    </v-sheet>
  </auth-layout>
</template>

<script>
export default {
  data() {
    return {
      isOpenRefuse: false,
      isOpenAccept: false,
      headers: [
        {
          text: 'Mã nhân viên',
          align: 'start',
          sortable: false,
          value: 'employee_code',
        },
        { text: 'Tên nhân viên', value: 'name' },
        { text: 'Ngày nghỉ', value: 'date' },
        { text: 'Ca nghỉ', value: 'shifts' },
        { text: 'Lý do', value: 'reason' },
        { text: 'Trạng thái', value: 'status' },
        { text: '', value: 'option' },
      ],
      desserts: [],
      id: "",
      monthYear: new Date().toISOString().slice(0, 7),
    };
  },

  async created() {
    await this.getData();
  },

  mounted() {
    // this.id = this._uid;
    // console.log(this.id);
  },

  methods: {
    async getData() {
      let res = await this.$store.dispatch("dayoffManager/getManagerDayOff", {
        'month': this.monthYear.slice(5, 7),
        'year': this.monthYear.slice(0, 4),
      });
      if (res && res.status === 200) {
        this.desserts = res.data.response.map((item) => ({
          ...item,
          employee_code: item.user_id,
          shifts: this.$options.filters.convertLeaveShift(item.shifts),
          status: this.$options.filters.convertLeaveStatus(item.status),
          option: item.status,
        }));
      }
      console.log(this.desserts);
    },

    async submitRefuse() {
      let res = await this.$store.dispatch("dayoffManager/updateManagerDayOff", {
        id: this.id,
        //2 là từ chối
        status: 2,
      });
      if (res.status === 200) {
        location.reload();
      } else {
        alert("Đã xảy ra lỗi ngoài ý muốn")
      }
      this.isOpenRefuse = false;
    },

    async submitAccept() {
      let res = await this.$store.dispatch("dayoffManager/updateManagerDayOff", {
        id: this.id,
        //1 là chấp nhận
        status: 1,
      });
      if (res.status === 200) {
        location.reload();
      } else {
        alert("Đã xảy ra lỗi ngoài ý muốn")
      }
      this.isOpenAccept = false;
    }
  }
};
</script>

<style lang="scss" scoped>
.box_title {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  & .selectMonth {
      margin-right: 20px;
      border: 1px solid black;
      border-radius: 5px;
      padding: 4px;
      box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
      font-size: 15px;
    }
  }
</style>
