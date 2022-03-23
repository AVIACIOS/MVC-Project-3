<?php

namespace Controllers;

use Models\User;

class UserController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerPost()
    {
        $errors = [];
        if(!isset($_POST['name'])) $errors['name'][] = 'Нет поля name';
        if(!isset($_POST['login'])) $errors['login'][] = 'Нет поля login';
        if(!isset($_POST['password'])) $errors['password'][] = 'Нет поля password';
        if(!isset($_POST['password_confirmed'])) $errors['password_confirmed'][] = 'Нет поля password_confirmed';

        if(empty($_POST['name'])) $errors['name'][] = 'Поле name не заполнено!';
        if(empty($_POST['login'])) $errors['login'][] = 'Поле login не заполнено!';
        if(empty($_POST['password'])) $errors['password'][] = 'Поле password не заполнено!';
        if(empty($_POST['password_confirmed'])) $errors['password_confirmed'][] = 'Поле password_confirmed не заполнено!';

        if($_POST['password'] != $_POST['password_confirmed']) $errors['password'][] = 'Пароли не совпали!';

        if($errors != [])
            return view('register', compact('errors'));

        unset($_POST['password_confirmed']);
        # Шифруем пароль в SHA1
        $_POST['password'] = sha1($_POST['password']);
        $user = new User();

        # Проверка что логин уникальны!
        if($user->isNotUniqueColumn('login', $_POST['login'])) {
            $errors['login'][] = 'Логин не является уникальным!';
            return view('register', compact('errors'));
        }

        $user = $user->create($_POST);
        return view('users/successRegister', compact('user'));
    }

    public function login()
    {
        return view('users/login');
    }

    public function loginPost()
    {
        $errors = [];
        if(!isset($_POST['login'])) $errors['login'][] = 'Нет поля login';
        if(!isset($_POST['password'])) $errors['password'][] = 'Нет поля password';

        if(empty($_POST['login'])) $errors['login'][] = 'Поле login не заполнено!';
        if(empty($_POST['password'])) $errors['password'][] = 'Поле password не заполнено!';

        if($errors != [])
            return view('users/login', compact('errors'));

        # Создаем запрос на поиск пользователя по введенным данным!
        $user = new User();
        $user->where(
            [
                ['login', '=', $_POST['login']],
                ['password', '=', sha1($_POST['password'])],
            ]
        );
        # Получаем данные в переменную $fUser - при этом будет там массив всех данных
        $fUser = $user->get();

        # Если пользователь не найден, то выведет ошибку!
        if(count($fUser) == 0) {
            $errors['error_auth'][] = 'tr';
            return view('users/login', compact('errors'));
        }

        # записываем в сессию ID пользователя!
        $_SESSION['id'] = $fUser[0]['id'];

        return redirect('/');
    }
}