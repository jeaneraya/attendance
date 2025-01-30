$(document).on('click','.register-student', function() {
    document.querySelectorAll(".form-ctrl").forEach(input => input.value = "");
    document.querySelectorAll(".form-ctrl").forEach(input => input.removeAttribute("disabled"));
    $('.qr-wrapper').hide();
    $('.student_modal').text('Register Student');
    $('.modal-footer').show();
    $('#registerStudent').modal('show');
});

$(document).on('click','.view-student', function() {
    var student_id = $(this).data('id');

    $.get('/student/'+ student_id, function(data) {
        $('.qr-wrapper').show();
        $("#last_name").val(data.last_name).attr("disabled", true);
        $("#first_name").val(data.first_name).attr("disabled", true);
        $("#middle_name").val(data.middle_name).attr("disabled", true);
        $("#student_id").val(data.student_id).attr("disabled", true);
        $("#course").val(data.course).attr("disabled", true);
        $("#year_level").val(data.year_level).attr("disabled", true);
        $("#stud_id").val(data.id).attr("disabled", true);
        $("#qr_code").attr("src", data.qr_code);
    });
    $('.student_modal').text('View Student');
    $('.modal-footer').hide();
    $('#registerStudent').modal('show');
});

$(document).on('click','.edit-student', function() {
    var student_id = $(this).data('id');

    $.get('/student/'+ student_id, function(data) {
        $('.qr-wrapper').hide();
        $("#last_name").val(data.last_name).attr("disabled", false);
        $("#first_name").val(data.first_name).attr("disabled", false);
        $("#middle_name").val(data.middle_name).attr("disabled", false);
        $("#student_id").val(data.student_id).attr("disabled", false);
        $("#course").val(data.course).attr("disabled", false);
        $("#year_level").val(data.year_level).attr("disabled", false);
        $("#stud_id").val(data.id).attr("disabled", false);
    });
    $('.student_modal').text('Edit Student');
    $('.modal-footer').show();
    $('#registerStudent').modal('show');
});

function archiveStudent(button) {
    var studentId = $(button).data('id'); // Get the student ID from the button's data-id

    if (confirm("Are you sure you want to archive this student?")) {
        $.get('/students/archive/' + studentId, function(response) {
            if (response.success) {
                alert("Student archived successfully!");
                location.reload();
            } else {
                alert("Failed to archive student.");
            }
        });
    }
}
