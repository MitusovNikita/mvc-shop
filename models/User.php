<?php

class User
{
    /**
     * Регистрация нового пользователя
     * @param string $name
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public static function register($name, $email, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO mvcshop.user (name, email, password) VALUES (:name, :email, :password)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name
     * @return boolean
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone
     * @return boolean
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password
     * @return boolean
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email
     * @return boolean
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email на наличие в базе
     * @param string $email
     * @return boolean
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM mvcshop.user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return false;
        }
        return true;
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : integer user id or false
     */
    public static function checkUserData($email, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM mvcshop.user WHERE email = :email AND password = :password';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        // Обращаемся к записи
        $user = $result->fetch();
        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     * @param integer $userId
     */
    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован
     * Иначе перенаправляет на страницу входа
     * @return string Идентификатор пользователя
     */
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /projects/mvc-shop/user/login");
    }

    /**
     * Является ли пользователь авторизованным
     * @return boolean
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id
     * @return array
     */
    public static function getUserById($id)
    {
        if ($id) {
            // Соединение с БД
            $db = Db::getConnection();
            // Текст запроса к БД
            $sql = 'SELECT * FROM mvcshop.user WHERE id = :id';
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return $result->fetch();
        }
    }

    /**
     * Редактирование данных пользователя
     * @param integer $id
     * @param string $name
     * @param string $password
     */
    public static function edit($id, $name, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE mvcshop.user
            SET name = :name, password = :password
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
}
