

function serviceInquiryList() {
    $("#serviceinquiryTable").DataTable({
        processing: true,
        bDestroy: true,
        bAutoWidth: false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/service_inquiry/list",
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "name",
            name: "name"
        },
        {
            data: "email",
            name: "email"
        },
        {
            data: "phone_number",
            name: "phone_number"
        },
        {
            data: "comment",
            name: "comment"
        },
        {
            data: "service",
            name: "service"
        },
        ],
        columnDefs: [{
            targets: [],
            orderable: false,
        },],

    });
}
serviceInquiryList();