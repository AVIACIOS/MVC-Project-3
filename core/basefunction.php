<?php
/*
 * Располагаются базовые функции доступные ото всюду
 */

# Отвечает за получение значение из SESSION
function session($name) {
    return $_SESSION[$name];
}

# Проверяет на существование элемента в SESSION
function has_session($name) {
    return isset($_SESSION[$name]);
}

# Записывает значение в SESSION
function put_session($name, $value) {
    $_SESSION[$name] = $value;
}

# Функция отвечающая за redirect на другую страницу
function redirect($url) {
    return header('Location: ' . $url);
}