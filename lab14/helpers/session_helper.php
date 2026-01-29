<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash($message) {
    $_SESSION['flash_message'] = $message;
}

function get_flash() {
    if (isset($_SESSION['flash_message'])) {
        $msg = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $msg;
    }
    return null;
}