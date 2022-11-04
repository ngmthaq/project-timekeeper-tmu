<template>
  <auth-layout>
    <v-sheet class="box_title">
      <h3>Danh sách nhân viên đăng ký nghỉ phép</h3>
    </v-sheet>
    
    <v-sheet class="box_body">
      <v-data-table :headers="headers" :items="desserts" lang="vi" :items-per-page="5" class="elevation-1">
        <template v-slot:item.option="{ item }">
          <div>
            <v-dialog width="500" v-model="isOpenRefuse">
              <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on">
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
                <v-btn v-bind="attrs" v-on="on">
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
        { text: 'Thời gian', value: 'time' },
        { text: 'Lý do', value: 'reason' },
        { text: 'Trạng thái', value: 'status' },
        { text: '', value: 'option' },
      ],
      desserts: [
        {
          employee_code: 1,
          name: "Vũ Ngọc Tiến",
          date: '04-11-2022',
          time: "Ca sáng",
          reason: "ABCD jfhakjshfkajhfkjashfhjkahfsjakfsafa",
          status: "Đang xét duyệt"
        }
      ],
    };
  },
  methods: {
    accept() {
      console.log("Ầ");
    },
    refuse() {
      console.log("B");
    },
    submitRefuse() {
      this.isOpenRefuse = false;
    },
    submitAccept() {
      this.isOpenAccept = false;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
