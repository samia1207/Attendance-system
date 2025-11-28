document.getElementById("showReport").addEventListener("click", () => {

    const attendanceState = JSON.parse(localStorage.getItem("attendanceState")) || {};

    let totalStudents = Object.keys(attendanceState).length;
    let present = 0;
    let participated = 0;

    Object.values(attendanceState).forEach(boxes => {
        boxes.forEach((checked, index) => {
            if (index % 2 === 0 && checked) present++;        // Present
            if (index % 2 === 1 && checked) participated++;  // Participated
        });
    });

    const ctx = document.getElementById("myChart").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Total Students", "Present", "Participated"],
            datasets: [{
                label: "Attendance Report",
                data: [totalStudents, present, participated],
                backgroundColor: ["#4a6fa5", "#28a745", "#ffc107"]
            }]
        }
    });

});
