<?php
    if (isset($_COOKIE['user']))
    {
        unset($_COOKIE['user']);
        setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
    }
    header("Location: login.php");