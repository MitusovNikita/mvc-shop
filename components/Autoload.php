<?php
//функция __autoload для автоматического подключения классов
function __autoload($class_name)
{
  //массив папок в которых могут находиться необходимые классы
  $array_paths = array(
    '/models/',
    '/components/',
    '/controllers/',
  );

  //проходим по массиву папок
  foreach($array_paths as $path) {

    //формируем имя и путь к файлу с классом
    $path = ROOT.$path.$class_name.'.php';

    if (is_file($path)) {
      include_once $path;
    }
  }
}
