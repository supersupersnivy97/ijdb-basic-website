<?php
if (!isset($_POST['id'])) {
    header('location: jokes.php');
} else {
    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';
        
        deleteJoke($pdo, $_POST['id']);
        
        header('location: jokes.php');
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
}
include __DIR__ . '/../templates/layout.html.php';