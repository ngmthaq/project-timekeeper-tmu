<template>
    <div class="text-center">
        <v-dialog width="500" v-model="isOpenDialog">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on">
                    <v-icon large color="green darken-2">
                        {{ icon }}
                    </v-icon>
                </v-btn>
            </template>

            <v-card style="padding: 10px">
                <v-card-title class="text-h5 lighten-2 title">
                    {{ title }}
                </v-card-title>

                <div style="display: flex; flex-direction: column; padding: 10px;">
                    <p>Ca nghỉ *</p>
                    <select id="shift" v-model="shift">
                        <option value="0">-- Chọn ca --</option>
                        <option value="1">Ca sáng</option>
                        <option value="2">Ca chiều</option>
                        <option value="3">Cả ngày</option>
                    </select>
                    <p>Ngày nghỉ phép *</p>
                    <input type="date" id="date_reason" v-model="now">
                    <p>Lý do nghỉ phép *</p>
                    <textarea id="reason" name="reason" rows="2" cols="50" v-model="reason"></textarea>
                    <p :class="[isOpenMes ? 'openNoti' : 'notification']">Hãy nhập hết trường</p>
                </div>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="submitAdd">
                        Thêm
                    </v-btn>
                    <v-btn @click="isOpenDialog = false">
                        Hủy bỏ
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import moment from "moment";
export default {
    name: "DialogCustom",
    props: {
        title: String,
        icon: String,
    },
    data() {
        return {
            now: moment().format('YYYY-MM-DD'),
            shift: 0,
            reason: '',
            isOpenMes: false,
            timeout: null,
            isOpenDialog: false,
        }
    },
    methods: {
        submitAdd() {
            if (this.shift == 0 || this.reason.length == 0) {
                this.isOpenMes = true;
                this.timeout = setTimeout(() => this.isOpenMes = false, 3000);
            } else {
                //TODO thêm đơn nghỉ phép vào backend và validate
                console.log(this.now, this.shift, this.reason);
                this.isOpenDialog = false;
            }

        }
    },

    beforeDestroy() {
        clearTimeout(this.timeout);
    },
};
</script>

<style lang="scss" scoped>
.title {
    height: 60px;
    display: flex;
    justify-content: center;
}

#reason {
    width: inherit;
    border: 1px solid black;
    resize: none;
    border-radius: 4px;
    padding: 5px;
    margin-bottom: 10px;
}

#shift {
    width: inherit;
    border: 1px solid black;
    border-radius: 4px;
    padding: 5px;
    margin-bottom: 10px;
}

#date_reason {
    width: inherit;
    border: 1px solid black;
    border-radius: 4px;
    margin-bottom: 10px;
    padding: 7px;
}

.notification {
    color: red;
    display: none;
}

.openNoti {
    color: red;
    display: block;
}
</style>
