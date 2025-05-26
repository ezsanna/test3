<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem CRUD Asas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container py-4">

    <h2>Sistem Pengurusan Pengguna</h2>

    <form id="userForm">
        <input type="hidden" id="user_id">
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <hr>

    <h4>Senarai Pengguna</h4>
    <table class="table table-bordered" id="userTable">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Tindakan</th></tr>
        </thead>
        <tbody></tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script.js"></script>
</body>
</html>
