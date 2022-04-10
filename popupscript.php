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