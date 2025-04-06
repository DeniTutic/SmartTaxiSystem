
<?php
include_once '../db.php';

class FeedbackDAO {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM feedbacks");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM feedbacks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO feedbacks (user_id, message, rating, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $data['user_id'], $data['message'], $data['rating'], $data['created_at']);
        return $stmt->execute();
    }

    public static function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE feedbacks SET user_id=?, message=?, rating=?, created_at=? WHERE id=?");
        $stmt->bind_param("isisi", $data['user_id'], $data['message'], $data['rating'], $data['created_at'], $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM feedbacks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
