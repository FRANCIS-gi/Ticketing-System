<?php
try {
    $pdo = new PDO('sqlsrv:Server=your_server;Database=your_database', 'your_username', 'your_password');
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
