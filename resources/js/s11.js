$(document).on('click', '.staticBackdrop"', function () {
    const id = $(this).data('id');
    $.get(`/employee/${id}`, function (data) {
        $('#employeeName').text(data.name);
        $('#employeeEmail').text(data.email);
        $('#employeePhone').text(data.skills);
        $('#staticBackdrop"').modal('show');
    });
});