<?php
require ('../db.php');




?>

<div class="popup" id="popup">
            <div class="popup__body">
                <div class="popup__content">
                    <a href="#" class="popup__close close-popup">X</a>
                    <div class="popup__title">Вход</div>
                    <div class="popup__text">
                        <div>
                            <input type="text" name="login" class="login__elem" placeholder="Логин">
                        </div>
                        <div>
                            <input type="text" name="password" class="login__elem" placeholder="Пароль">
                        </div>
                        <div>
                            <input type="submit" class="popup__btn" value="Войти">
                        </div>
                    </div>
                </div>
            </div>
</div>