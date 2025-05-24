<?php
// Definovanie koreňovej cesty (dva priečinky nad aktuálnym súborom)
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('__ROOT__', dirname(dirname(__DIR__)));
require_once(__ROOT__ . '/functions/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['feedback_name'];
    $id = null;
    $message = $_POST['feedback_text'];
    $link = $_POST['client_link'];
    $role = $_POST['client_role'];
    $image = $_POST['img_filename'];

    $conn = new mysqli($config["HOST"], $config["USER_NAME"], $config["PASSWORD"], 'zaverecny_project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (feedback_name, feedback_text, client_link, client_role, img_filename) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $message, $link, $role, $image);
    
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