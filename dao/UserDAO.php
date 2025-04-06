<?php
include_once '../db.php';

class UserDAO {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (name, email, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['role']);
        return $stmt->execute();
    }

    public static function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $data['name'], $data['email'], $data['role'], $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
