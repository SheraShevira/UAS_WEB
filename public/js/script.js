$(document).ready(function () {
    $("#data").DataTable({
        dom: "rt",
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: {
            heightMatch: "none",
        },
        columnDefs: [
            {
                width: "20px",
                targets: 0,
            },
            {
                width: "130px",
                targets: 1,
            },
            {
                className: "dt-body-center",
                width: "130px",
                targets: 3,
            },
            {
                className: "dt-head-center dt-body-center",
                width: "120px",
                targets: 4,
            },
            {
                className: "dt-head-center dt-body-center",
                width: "120px",
                targets: 5,
            },
            {
                orderable: false,
                className: "dt-body-center",
                width: "100px",
                targets: 6,
            },
        ],
    });
});
