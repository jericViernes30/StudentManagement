$(document).ready(function () {
    $("#toggleEye").on("click", function () {
        const passwordField = $("#password");
        const passwordFieldType = passwordField.attr("type");

        if (passwordFieldType === "password") {
            passwordField.attr("type", "text");
            $("#eye").removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordField.attr("type", "password");
            $("#eye").removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#closeAddStudentModal").on("click", function () {
        $("#addModal").addClass("hidden");
        $("#overlay").addClass("hidden");
    });

    $("#openAddStudentModal").on("click", function () {
        $("#addModal").removeClass("hidden");
        $("#overlay").removeClass("hidden");
    });

    document.querySelectorAll(".gradeDiv").forEach((div) => {
        div.addEventListener("click", function () {
            const data = JSON.parse(this.getAttribute("data-student"));
            const studentNumber = data.student.student_number;
            const grades = data.grades;

            document.getElementById("modalStudentNumber").value = studentNumber;

            const fieldsContainer = document.getElementById("gradesFields");
            fieldsContainer.innerHTML = "";

            grades.forEach((grade) => {
                fieldsContainer.innerHTML += `
                    <div>
                    <label class="block font-medium text-sm mb-1 text-gray-700">${grade.subject}</label>
                    <input type="hidden" name="grades[${grade.grade_id}][subject]" value="${grade.subject}">
                    <input type="hidden" name="grades[${grade.grade_id}][grade_id]" value="${grade.grade_id}">
                    <input type="number" name="grades[${grade.grade_id}][grade]" value="${grade.grade}" min="0" max="100"
                    class="w-full bg-white text-gray-800 border border-gray-300 px-3 py-1 rounded" required>
                    </div>
                `;
            });

            document.getElementById("editModal").classList.remove("hidden");
        });
    });

    $("#cancel").on("click", function () {
        $("#editModal").addClass("hidden");
    });

    let chartInstance = null;
    let currentStudentNumber = null;

    $(document).on("click", "#viewGrades", function () {
        const studentNumber = $(this).data("val");
        const studentRow = $(this).closest(".chart-list");

        // If chart is already shown for this student, hide it and reset
        if (
            currentStudentNumber === studentNumber &&
            !$("#gradesChartContainer").hasClass("hidden")
        ) {
            $("#gradesChartContainer").addClass("hidden");

            // Destroy chart instance
            if (chartInstance) {
                chartInstance.destroy();
                chartInstance = null;
            }

            // Clear canvas content to prevent stacking
            const canvas = $("#gradesChart")[0];
            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            currentStudentNumber = null;
            return;
        }

        // Otherwise, show chart for this student
        currentStudentNumber = studentNumber;

        $.get("/student/grades/" + studentNumber, function (response) {
            const subjects = response.grades.map((g) => g.subject);
            const grades = response.grades.map((g) => parseInt(g.grade));

            const subjectColors = {
            Filipino: "#f59e0b",
            English: "#3b82f6",
            Science: "#10b981",
            Mathematics: "#8b5cf6",
            "Araling Panlipunan": "#ef4444",
            "Physical Education": "#22c55e",
            ESP: "#ec4899",
            EPP: "#eab308",
            TLE: "#14b8a6",
            Music: "#6366f1",
            Arts: "#f43f5e",
            Health: "#84cc16",
            };

            const backgroundColors = subjects.map(
            (sub) => subjectColors[sub] || "#9ca3af"
            );

            // Move and show the chart container
            $("#gradesChartContainer").insertAfter(studentRow).removeClass("hidden");

            // Reset canvas size and make it responsive
            const canvas = $("#gradesChart")[0];
            canvas.width = $("#gradesChartContainer").width(); // Set width to container's width
            canvas.height = $("#gradesChartContainer").height(); // Set height to container's height
            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear any previous content

            // Destroy previous chart if it exists
            if (chartInstance) {
            chartInstance.destroy();
            }

            // Create a new chart
            chartInstance = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: subjects,
                datasets: [
                    {
                    label: "Grades",
                    data: grades,
                    backgroundColor: backgroundColors,
                    borderRadius: 5,
                    },
                ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Allow the chart to take up the full size of the canvas
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: {
                        beginAtZero: false,
                        min: 70,
                        max: 100,
                        ticks: {
                            stepSize: 1,
                            },
                        },
                    },
                },
            });
        });
    });

    $(document).on('click', '#editStudentInfo', function(){
        const studentNumber = $(this).data('val');

        // Move and show the edit modal
        $("#editModal").removeClass("hidden");
        $("#overlay").removeClass("hidden");
        $('#loader').removeClass('hidden');

        // Fetch student data
        $.ajax({
            url: "/student/fetch-info/" + studentNumber,
            type: "GET",
            success: function (response) {
                $('#loader').addClass('hidden');

                console.log(response)
                const student = response
                const form = $("#editStudentForm");
                form.removeClass("hidden");

                // Populate the form fields with the student data
                form.find("#student_number_edit").val(student.student_number);
                form.find("#first_name_edit").val(student.first_name);
                form.find("#last_name_edit").val(student.last_name);
                form.find("#email_address_edit").val(student.email_address);
                form.find("#address_edit").val(student.address);
                form.find("#contact_number_edit").val(student.contact_number);
                form.find("#grade_level_edit").val(student.grade_level);
                form.find("#section_edit").val(student.section);
                form.find("#gender_edit").val(student.gender);
                form.find("#age_edit").val(student.age);
            },
            error: function (error) {
                console.error("Error fetching student data:", error);
            },
        });
    })

    // student subjects
    $('#addNewSubject').on('click', function(){
        $('#addSubjectModal').removeClass('hidden')
        $('#overlay').removeClass('hidden')
    })
});

function confirmDeletion(studentNumber) {
    Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
    reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/student/delete-student/" + studentNumber;
        }
    });
}
