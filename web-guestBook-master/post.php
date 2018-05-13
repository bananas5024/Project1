<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'src/control/crypto.php';
require_once 'src/database/connection.php';

session_start();

//Data base/
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
///////////

//Getting form param
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$hashPassword = generateHash($password);
$text = htmlentities($_POST['text']);
///////////


//Main action

//Check user
if (checkUser($email, $link)){
    if (checkPassword($password, $email, $link)) {
        if (addRecord($text, $email, $link)) {
            update();
        }
    }else{
        doError("Wrong password");
    }
}else{
    if (addUser($email, $password, $link)){
        if (addRecord($text, $email, $link)){
            update();
        }
    }
}

// закрываем подключение
mysqli_close($link);


////////////////////////////////////////

function addUser($email, $password, $link){
    $hashPassword = generateHash($password);
    $query = "INSERT INTO guestbook.users (email, password) VALUES ('$email', '$hashPassword')";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if (!$result){
        doError("Adding user error!");
        return false;
    }
    return true;
}

function checkUser ($email, $link){
    $query ="SELECT * FROM guestbook.users WHERE users.email = '$email'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result) {
        if ($result->num_rows > 0){
            return true;
        }
    }
    return false;
}

function checkPassword ($password, $email ,$link){
    $query ="SELECT users.password FROM guestbook.users WHERE users.email = '$email'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $row = mysqli_fetch_row($result);
    if ($result){
        if ($result->num_rows > 0){
            if (verify($password, $row[0]))
            return true;
        }
    }
    return false;
}

function addRecord($text, $email, $link){
    $query = "INSERT INTO guestbook.records (userId, record) VALUES ((SELECT id FROM guestbook.users WHERE users.email = '$email'), '$text')";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if (!$result){
        doError("Adding records error!");
        return false;
    }
    return true;
}

function update(){
    header("Location: index.php");
}

function doError($error){
    $_SESSION['error-message'] = "$error";
    header("Location: index.php");
}