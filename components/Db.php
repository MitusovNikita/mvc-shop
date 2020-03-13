<?php
//класс Db - компонент для работы с базой данных
class Db
{
  //устанавливает соединение с базой данных
  //return объект класса PDO для работы с базой данных
  public static function getConnection()
  {
    //получаем параметры подключения из файла
    $paramsPath = ROOT.'/config/db_params.php';
    $params = include($paramsPath);

    //устанавливаем соединение
    $dsn = "mysql:host = {$params['host']}; dbname = {$params['dbname']}";
    $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    //задаем кодировку
    $db->exec("set names utf8");

    return $db;
  }
}
