<?php
header('Content-Type: application/json');
include_once '../dao/UserDAO.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode(UserDAO::getById($_GET['id']));
        } else {
            echo json_encode(UserDAO::getAll());
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(UserDAO::create($data));
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(UserDAO::update($_GET['id'], $data));
        break;
    case 'DELETE':
        echo json_encode(UserDAO::delete($_GET['id']));
        break;
}
?>
<?php