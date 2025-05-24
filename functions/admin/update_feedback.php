<?php
// Definovanie koreňovej cesty (dva priečinky nad aktuálnym súborom)
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('__ROOT__', dirname(dirname(__DIR__)));
require_once(__ROOT__ . '/functions/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['feedback_name'];
    $message = $_POST['feedback_text'];
    $link = $_POST['client_link'];
    $role = $_POST['client_role'];
    $image = $_POST['img_filename'];

    $conn = new mysqli($config["HOST"], $config["USER_NAME"], $config["PASSWORD"], 'zaverecny_project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE feedback SET feedback_name=?, feedback_text=?, client_link=?, client_role=?, img_filename=? WHERE id=?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $name, $message, $link, $role, $image, $id);
    
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Update failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>