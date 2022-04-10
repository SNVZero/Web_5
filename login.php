<?php
require 'db.php';
if(isset($_POST['do_login'])){
    $mess = array();
    $stmt = $db->prepare("SELECT login FROM USERS WHERE login = ?" );
    $stmt->execute(array($_POST['login']));
    $login = $stmt->fetch(PDO::FETCH_LAZY);
    if($login != $_POST['login']){
        $mass['login']= TRUE;
    }else{
        $mess['login'] = FALSE;
        $stmt = $db->prepare("SELECT pass FROM USERS WHERE login = ?" );
        $stmt->execute(array($_POST['login']));
        $password = $stmt->fetch(PDO::FETCH_LAZY);
        if(password_verify($_POST['password'],$password)){
            $mess['password']= FALSE;
            $_SESSION['logged_user'] = $login;
            header('Location: index.php');
        }else{
            $mess['password']=TRUE;
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


    <form  method="post" action="popuplogin.php">
        <div class="popup" id="popup">
            <div class="popup__body">
                <div class="popup__content">
                    <div class="popup__title">Вход</div>
                    <div class="popup__text">
                            <div>
                                <input type="text" name="login" class="login__elem" placeholder="Логин" value="<?php @$_POST['login'] ?>">
                                <div class="text-danger err ">
                                            <?php
                                                if(@$mess['login'] == TRUE){
                                                    print('Неправильно введен логин');
                                                }
                                            ?>
                                        </div>
                            </div>
                            <div>
                                <input type="text" name="password" class="login__elem" placeholder="Пароль">
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