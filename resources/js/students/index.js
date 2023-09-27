import { showConfirmationModal } from "@/utils/helper.js";

let table;

$(() => {
    table = $(".table").DataTable();
});

function handleSuccess() {
    table.ajax.reload();
}

function deleteStudent(url) {
    showConfirmationModal(
        "Dengan menekan tombol hapus, Maka semua data <b>Siswa</b> akan hilang!",
        "Hapus Data",
        url,
        "DELETE",
        handleSuccess
    );
}

$(document).on("click", ".delete-students", function (e) {
    e.preventDefault();
    let url = urlDestroy;
    url = url.replace(":uuid", $(this).data("uuid"));
    deleteStudent(url);
});

// Show Detail Student
$(document).on("click", ".show-students", function (e) {
    e.preventDefault();
    var url = urlShowDetail.replace(":uuid", $(this).data("uuid"));
    function showStudent(url) {
        const modal = $("#modal-show-student");
        const modalContent = modal.find(".modal-content");

        modal.modal("show");
        modal.find(".block-title").text("Detail Data Siswa");

        $.get(url).done((response) => {
            const student = response.student;
            const kelas = student.room;

            const elements = {
                "#student-name": student.name,
                "#student-email": student.email,
                "#student-phone": student.phone,
                "#student-gender": student.jk,
                "#student-dob": student.dob,
                "#student-pob": student.place_of_birth,
                "#student-address": student.address,
                "#student-father": student.father,
                "#student-mother": student.mother,
                "#student-room": kelas.name,
                "#student-wali": kelas.user.name,
            };

            Object.entries(elements).forEach(([selector, value]) => {
                modalContent.find(selector).text(value);
            });
        });
    }

    return showStudent(url);
});
