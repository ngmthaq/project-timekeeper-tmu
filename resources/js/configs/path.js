const paths = [
    { name: "Trang chủ", path: "#", isAdmin: false, isActive: false },
    { name: "Chấm công", path: "/timekeeper", isAdmin: false, isActive: true },
    { name: "Xin nghỉ phép", path: "/day/off", isAdmin: false, isActive: true },
    {
        name: "Duyệt nghỉ phép",
        path: "/manage/day/off",
        isAdmin: true,
        isActive: true,
    },
    
];

export default paths;
