<template>
    <auth-layout>
        <v-sheet class="box_title">
            <h3>Danh sách ngày nghỉ phép</h3>
            <div style="display: flex;">
                <input type="month" id="selectMonth" v-model="monthYear" class="selectMonth" @change="getData">
                <c-dialog title="Đơn xin nghỉ phép" icon="mdi-plus-circle-outline">
                </c-dialog>
            </div>
        </v-sheet>

        <v-sheet class="box_body">
            <v-data-table :headers="headers" :items="desserts" lang="vi" :items-per-page="5" class="elevation-1">

            </v-data-table>
        </v-sheet>

    </auth-layout>
</template>


<script>

import { Dialog } from "../components";
import {convertLeaveShift, convertLeaveStatus} from "../filters";

export default {
    components: {
        "c-dialog": Dialog,
    },
    data() {
        return {
            headers: [
                {
                    text: 'Ngày nghỉ',
                    align: 'start',
                    sortable: false,
                    value: 'date',
                },
                { text: 'Lý  do', value: 'reason' },
                { text: 'Ca nghỉ', value: 'shifts' },
                { text: 'Trạng thái', value: 'status' }
            ],
            desserts: [],
            monthYear: new Date().toISOString().slice(0, 7),
        };
    },

    async created() {
        await this.getData();
    },

    methods: {
        async getData() {
            let res = await this.$store.dispatch("dayoff/getDayOff", {
                'month': this.monthYear.slice(5,7),
                'year': this.monthYear.slice(0,4),
            });
            console.log(res.data.response)
            if (res && res.status === 200) {
                this.desserts = res.data.response.map((item) => ({
                    ...item,
                    status: this.$options.filters.convertLeaveStatus(item.status),
                    shifts: this.$options.filters.convertLeaveShift(item.shifts),
                }));
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.box_title {
    height: 60px;
    justify-content: space-between;
    display: flex;
    align-items: center;

    & .selectMonth {
        margin-right: 20px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 4px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        font-size: 15px;
    }
}

.box_body {}
</style>
