<?php

namespace Controllers;

use Models\Comment;
use Models\Post;

class PostController extends BaseController
{
    public function create()
    {
        return view('posts/create');
    }

    public function createPost()
    {
        # Если пользователь не авторизован!
        if(!has_session('id'))
            return redirect('/');

        # Default значение переменной $errors
        $errors = [];

        # Проверка на существование
        if(!isset($_POST['name'])) $errors['name'][] = 'Поле не существует!';
        if(!isset($_POST['keywords'])) $errors['keywords'][] = 'Поле не существует!';
        if(!isset($_POST['descriptions'])) $errors['descriptions'][] = 'Поле не существует!';

        # Проверка на заполненность
        if(empty($_POST['name'])) $errors['name'][] = 'Поле не заполнено!';
        if(empty($_POST['keywords'])) $errors['keywords'][] = 'Поле не заполнено!';
        if(empty($_POST['descriptions'])) $errors['descriptions'][] = 'Поле не заполнено!';

        # Если существуют ошибки, отправляем их на клиента
        if($errors != [])
            return view('posts/create', compact('errors'));

        # Помещаем массив суперглобальной переменной $_POST в переменную $inputs
        $inputs = $_POST;
        # Добавляем не достающий элемент пользовательского ID которому он принадлежит
        $inputs['user_id'] = session('id');
        # Добавляем не достающий элемент сегодняшней даты и времени
        $inputs['created_at'] = date('d-m-Y H:i:s');

        # Создаем новый пост
        $post = new Post();
        $post->create($inputs);

        # Отправляем представление posts/create со значением выполнения операции успешно
        return view('posts/create', ['success' => true]);
    }

    public function index()
    {
        $posts = new Post();
        return view('index', compact('posts'));
    }

    public function first()
    {
        $posts = new Post();
        $post = $posts->find($_GET['id']);
        return view('posts/first', compact('post', 'posts'));
    }

    public function commentCreate()
    {
        if(!has_session('id'))
            return redirect('/');

        $errors = [];
        if(!isset($_POST['comment'])) $errors['comment'][] = 'Поле не существует!';
        if(empty($_POST['comment'])) $errors['comment'][] = 'Поле не заполнено!';

        if($errors != [])
            return view('posts/first', compact('errors'));

        $inputs = $_POST;
        $inputs['user_id'] = session('id');
        $inputs['post_id'] = $_GET['id'];
        $comment = new Comment();
        $comment->create($inputs);

        return redirect("/posts?id={$inputs['post_id']}");
    }
}