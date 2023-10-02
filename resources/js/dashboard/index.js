import axios from "axios";

axios.get(chartDataUrl).then((response) => {
    const roomStudents = document.getElementById("room-students-chart");
    const countStudents = document.getElementById("count-students-chart");
    const rooms = response.data.rooms;
    const counts = response.data.counts;

    console.log(counts);

    // Membuat array yang berisi nama-nama ruangan
    const roomNames = rooms.map((room) => room.name);

    // Membuat array yang berisi jumlah siswa dalam setiap ruangan
    const studentCounts = rooms.map((room) => room.students_count);

    const monthNames = counts.map((count) => count.month_name);
    const violationCounts = counts.map((count) => count.student_count);

    new Chart(countStudents, {
        type: "line",
        data: {
            labels: monthNames,
            datasets: [
                {
                    label: "Jumlah Siswa",
                    fill: !0,
                    backgroundColor: "rgba(101, 163, 13, .45)",
                    borderColor: "rgba(101, 163, 13, 1)",
                    pointBackgroundColor: "rgba(101, 163, 13, 1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(2, 132, 199, 1)",
                    barThickness: 30,
                    data: violationCounts,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            responsive: !0,
            maintainAspectRatio: !1,
            tension: 0.4,
            interaction: { intersect: !1 },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (e) {
                            return " " + e.parsed.y + " Siswa";
                        },
                    },
                },
            },
        },
    });

    new Chart(roomStudents, {
        type: "bar",
        data: {
            labels: roomNames,
            datasets: [
                {
                    label: "Jumlah Siswa",
                    fill: !0,
                    backgroundColor: "rgba(2, 132, 199, .45)",
                    borderColor: "rgba(2, 132, 199, 1)",
                    pointBackgroundColor: "rgba(2, 132, 199, 1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(2, 132, 199, 1)",
                    barThickness: 30,
                    data: studentCounts,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            responsive: !0,
            maintainAspectRatio: !1,
            tension: 0.4,
            interaction: { intersect: !1 },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (e) {
                            return " " + e.parsed.y + " Siswa";
                        },
                    },
                },
            },
        },
    });
});
