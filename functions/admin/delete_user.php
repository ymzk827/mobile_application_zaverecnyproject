<?php
define('__ROOT__', dirname(dirname(__DIR__)));
require_once(__ROOT__ . '/functions/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $conn = new mysqli($config["HOST"], $config["USER_NAME"], $config["PASSWORD"], 'zaverecny_project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $id);


    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Delete failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>