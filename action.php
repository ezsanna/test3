<?php
require 'db.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
    }

    if ($action == 'read') {
        $result = $conn->query("SELECT * FROM users ORDER BY id DESC");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    if ($action == 'delete') {
        $id = $_POST['id'];
        $conn->query("DELETE FROM users WHERE id = $id");
    }

    if ($action == 'getUser') {
        $id = $_POST['id'];
        $result = $conn->query("SELECT * FROM users WHERE id = $id");
        echo json_encode($result->fetch_assoc());
    }

    if ($action == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $conn->query("UPDATE users SET name = '$name', email = '$email' WHERE id = $id");
    }
}
?>
