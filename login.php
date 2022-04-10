<?php

session_start();
require 'connection.php';

$login = $_POST['login'];
$password = password_verify($_POST['password'],PASSWORD_DEFAULT);

$check_user = mysqli_quety($connection, "SELECT * FROM USERS WHERE login = '$login' AND pass = '$password'");
if(mysqli_num_rows($check_user) > 0){
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        "name" => $user['name'];
        "email" => $user['mail'];
        "bio" => $user['bio'];
        "year" => $user['date'];
        "gender" => $user['gender'];
        "limbs" => $user['limbs'];
    ];
    header('Location: index.php');
}else{
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <title>Вход</title>
</head>
<body>


    <form  method="post" action="login.php">
        <div class="alert alert-danger"role="alert" <?php if(!@$_SESSION['message']) print('hidden'); ?> >
            <?php
                print(@$_SESSION['message']);
            ?>
        </div>
        <div class="popup" id="popup">
            <div class="popup__body">
                <div class="popup__content">
                    <div class="popup__title">Вход</div>
                    <div class="popup__text">
                            <div>
                                <input type="text" name="login" class="login__elem" placeholder="Логин">
                            </div>
                            <div>
                                <input type="text" name="password" class="login__elem" placeholder="Пароль">
                            </div>
                        <div>
                            <input type="submit" class="popup__btn" value="Войти" name="do_login">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>