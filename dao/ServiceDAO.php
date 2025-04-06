
<?php
include_once '../db.php';

class ServiceDAO {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM services");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO services (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $data['name'], $data['description'], $data['price']);
        return $stmt->execute();
    }

    public static function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE services SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $data['name'], $data['description'], $data['price'], $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
<?php