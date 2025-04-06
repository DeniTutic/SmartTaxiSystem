
<?php
include_once '../db.php';

class PaymentDAO {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM payments");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM payments WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO payments (booking_id, amount, payment_date, method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idss", $data['booking_id'], $data['amount'], $data['payment_date'], $data['method']);
        return $stmt->execute();
    }

    public static function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE payments SET booking_id=?, amount=?, payment_date=?, method=? WHERE id=?");
        $stmt->bind_param("idssi", $data['booking_id'], $data['amount'], $data['payment_date'], $data['method'], $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM payments WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
<?php