<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'src/database/connection.php';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$query = "SELECT users.email, records.record FROM guestbook.users INNER JOIN guestbook.records ON users.id = records.userId";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if ($result) {
    if ($result->num_rows > 0){
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}