<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $mess = array();
    if(!empty($_COOKIE['save_1'])){
        setcookie('save_1','',1);
    }

    $error = array();

    $error['login'] = !empty($_COOKIE['login_error']);
    $error['password'] = !empty($_COOKIE['password_error']);

    if($error['login']){
        setcookie('login_error','',1);
        $mess['login'] = TRUE;
    }

    if($error['password']){
        setcookie('password_error','',1);
        $mess['password'] = TRUE;
    }

    $val = array();
    $val['login'] = empty($_COOKIE['login_value']) ? '' : $_COOKIE['login_value'];
    $val['password'] = empty($_COOKIE['password_value']) ? '' : $_COOKIE['password_value'];

}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = FALSE;


    $stmt = $db->prepare("SELECT login FROM USERS WHERE login = ?" );
    $stmt->execute(array($_POST['login']));
    $login = $stmt->fetch(PDO::FETCH_LAZY);

    if($login != $_POST['login']){
        $errors = TRUE;
        setcookie('login_value',$_POST['login']);

    }else{
        setcookie('login_value',$_POST['login']);

        $stmt = $db->prepare("SELECT pass FROM USERS WHERE login = ?" );
        $stmt->execute(array($_POST['login']));
        $password = $stmt->fetch(PDO::FETCH_LAZY);
        if(password_verify($_POST['password'],$password)){
            $_SESSION['logged_user'] = $login;
            header('Location: index.php');
        }else{
            setcookie('password_value',$_POST['password']);
            $errors = TRUE;
        }
        if ($errors) {
            header('Location: login.php');
            exit();
        }
    }
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
        <div class="popup" id="popup">
            <div class="popup__body">
                <div class="popup__content">
                    <div class="popup__title">Вход</div>
                    <div class="popup__text">
                            <div>
                                <input type="text" name="login" class="login__elem" placeholder="Логин" value="<?php @$val['login'] ?>">
                                <div class="text-danger err ">
                                            <?php
                                                if(@$mess['login'] == TRUE){
                                                    print('Неправильно введен логин');
                                                }
                                            ?>
                                        </div>
                            </div>
                            <div>
                                <input type="text" name="password" class="login__elem" placeholder="Пароль" value="<?php @$val['password'] ?>
                                <div class="text-danger err ">
                                            <?php
                                                if(@$mess['pass'] == TRUE){
                                                    print('Неправильно введен пароль');
                                                }
                                            ?>
                                        </div>
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