$(document).ready( function () {
    $('#myTable').DataTable({
        "ordering": false
    });
} );

$(document).ready( function () {
    $('#myTableAdmin').DataTable({
        "ordering": false,
        "paging": false,
        "searching": false
    });
} );
