<?php
require ('popupscript.php');
?>
<form  id="form">
    <div class="popup" id="popup">
        <div class="popup__body">
            <div class="popup__content">
                <a href="#" class="popup__close close-popup">X</a>
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