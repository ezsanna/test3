$(document).ready(function() {
    fetchUsers();

    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#user_id').val();
        let name = $('#name').val();
        let email = $('#email').val();
        let action = id ? 'update' : 'add';

        $.post('action.php', { action, id, name, email }, function() {
            $('#userForm')[0].reset();
            $('#user_id').val('');
            fetchUsers();
        });
    });

    function fetchUsers() {
        $.post('action.php', { action: 'read' }, function(data) {
            let users = JSON.parse(data);
            let rows = '';
            $.each(users, function(i, user) {
                rows += `<tr>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit" data-id="${user.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete" data-id="${user.id}">Padam</button>
                    </td>
                </tr>`;
            });
            $('#userTable tbody').html(rows);
        });
    }

    $(document).on('click', '.delete', function() {
        let id = $(this).data('id');
        $.post('action.php', { action: 'delete', id }, fetchUsers);
    });

    $(document).on('click', '.edit', function() {
        let id = $(this).data('id');
        $.post('action.php', { action: 'getUser', id }, function(data) {
            let user = JSON.parse(data);
            $('#user_id').val(user.id);
            $('#name').val(user.name);
            $('#email').val(user.email);
        });
    });
});
