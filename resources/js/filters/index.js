export const convertLeaveStatus = (value) => {
    if (!value) {
        return "";
    }
    let arrayStatus = ["Đang đợi duyệt", "Chấp nhận", "Từ chối"];

    return arrayStatus[value];
}

export const convertLeaveShift = (value) => {
    if (!value) {
        return "";
    }
    let arrayShift = ["Ca sáng", "Ca chiều", "Cả ngày"];

    return arrayShift[parseInt(value) - 1];
}
