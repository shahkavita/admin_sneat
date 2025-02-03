<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category CRUD with DataTables & AJAX</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
</head>
<body>
    <h2>Category Management</h2>

    <table id="categoryTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function () {
            let table = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("category.list") }}',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'status' },
                    { data: 'actions', orderable: false, searchable: false }
                ]
            });
        });

    </script>
</body>
</html>
