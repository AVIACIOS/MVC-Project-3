<?php

namespace Models;

class Post extends Model
{
    # Присваиваем название таблицы с которой работает модель
    protected $table = 'posts';

    # Получение автора из базы по его ID
    public function author($user_id)
    {
        return (new User())->find($user_id)['name'];
    }
}