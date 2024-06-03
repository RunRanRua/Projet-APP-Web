<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['concert_id'])) {
        $_SESSION['concert_id'] = $_POST['concert_id'];
        echo 'Session updated successfully - PHP';
    } else {
        echo 'Concert ID not set';
    }
} else {
    echo 'Invalid request method';
}
?>