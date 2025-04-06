
<?php
include_once '../db.php';

class BookingDAO {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM bookings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, service_id, booking_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $data['user_id'], $data['service_id'], $data['booking_date'], $data['status']);
        return $stmt->execute();
    }

    public static function update($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE bookings SET user_id=?, service_id=?, booking_date=?, status=? WHERE id=?");
        $stmt->bind_param("iissi", $data['user_id'], $data['service_id'], $data['booking_date'], $data['status'], $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
