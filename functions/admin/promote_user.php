<?php
// Definovanie koreňovej cesty (dva priečinky nad aktuálnym súborom)
define('__ROOT__', dirname(dirname(__DIR__)));
require_once(__ROOT__ . '/functions/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Predpokladáme, že $config je definovaný v config.php
    $conn = new mysqli($config["HOST"], $config["USER_NAME"], $config["PASSWORD"], 'zaverecny_project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE user SET role = 'admin' WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    
    $stmt->close();
    $conn->close();
    // header("Location: ".__ROOT__ ."/admin.php");
    exit;
} else {
    echo "Invalid request.";
}
?>