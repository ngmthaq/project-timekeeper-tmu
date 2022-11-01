<template>
    <auth-layout>
        <v-sheet class="box_title">
            <h3>Danh sách ngày nghỉ phép</h3>
            <div style="display: flex;">
                <input type="month" id="selectMonth" v-model="month" class="selectMonth">
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
                    value: 'day_off',
                },
                { text: 'Thời gian', value: 'time' },
                { text: 'Lý  do', value: 'reason' },
                { text: 'Trạng thái', value: 'status' },
                { text: 'Người duyệt', value: 'approver' },
            ],
            desserts: [
                {
                    day_off: 159,
                    time: '22-02-2022',
                    reason: 6.0,
                    status: 24,
                    approver: 4.0,
                },
                {
                    day_off: 237,
                    time: '22-02-2022',
                    reason: 9.0,
                    status: 37,
                    approver: 4.3,
                },
                {
                    day_off: 262,
                    time: '22-02-2022',
                    reason: 16.0,
                    status: 23,
                    approver: 6.0,
                },
                {
                    day_off: 305,
                    time: '22-02-2022',
                    reason: 3.7,
                    status: 67,
                    approver: 4.3,
                },
                {
                    day_off: 356,
                    time: '22-02-2022',
                    reason: 16.0,
                    status: 49,
                    approver: 3.9,
                },
                {
                    day_off: 375,
                    time: '22-02-2022',
                    reason: 0.0,
                    status: 94,
                    approver: 0.0,
                },
                {
                    day_off: 392,
                    time: '22-02-2022',
                    reason: 0.2,
                    status: 98,
                    approver: 0,
                },
                {
                    day_off: 408,
                    time: '22-02-2022',
                    reason: 3.2,
                    status: 87,
                    approver: 6.5,
                },
                {
                    day_off: 452,
                    time: '22-02-2022',
                    reason: 25.0,
                    status: 51,
                    approver: 4.9,
                },
                {
                    day_off: 518,
                    time: '22-02-2022',
                    reason: 26.0,
                    status: 65,
                    approver: 7,
                },
                {
                    day_off: 159,
                    time: '22-02-2022',
                    reason: 6.0,
                    status: 24,
                    approver: 4.0,
                },
                {
                    day_off: 237,
                    time: '22-02-2022',
                    reason: 9.0,
                    status: 37,
                    approver: 4.3,
                },
                {
                    day_off: 262,
                    time: '22-02-2022',
                    reason: 16.0,
                    status: 23,
                    approver: 6.0,
                },
                {
                    day_off: 305,
                    time: '22-02-2022',
                    reason: 3.7,
                    status: 67,
                    approver: 4.3,
                },
                {
                    day_off: 356,
                    time: '22-02-2022',
                    reason: 16.0,
                    status: 49,
                    approver: 3.9,
                },
                {
                    day_off: 375,
                    time: '22-02-2022',
                    reason: 0.0,
                    status: 94,
                    approver: 0.0,
                },
                {
                    day_off: 392,
                    time: '22-02-2022',
                    reason: 0.2,
                    status: 98,
                    approver: 0,
                },
                {
                    day_off: 408,
                    time: '22-02-2022',
                    reason: 3.2,
                    status: 87,
                    approver: 6.5,
                },
                {
                    day_off: 452,
                    time: '22-02-2022',
                    reason: 25.0,
                    status: 51,
                    approver: 4.9,
                },
                {
                    day_off: 518,
                    time: '22-02-2022',
                    reason: 26.0,
                    status: 65,
                    approver: 7,
                },
            ],
            month: new Date().toISOString().slice(0, 7),
        };
    },
    methods: {
        clickOpenDialog() {
            console.log("xin nghỉ nè");

        },
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
    }
}

.box_body {}
</style>
