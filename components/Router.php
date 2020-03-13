<?php
/*
класс Router
компонент для работы с маршрутами
*/
class Router
{
  //свойство для хранения массива роутов
  private $routes;

  //конструктор
  public function __construct()
  {
    //путь к файлу с роутами
    $routesPath = ROOT.'/config/routes.php';

    //получаем роуты из файла
    $this->routes = include($routesPath);
  }

  //возвращаем строку запроса
  private function getURI()
  {
    if(!empty($_SERVER['REQUEST_URI'])) {
      $uri = trim(preg_replace('~/projects/mvc-shop~','',$_SERVER['REQUEST_URI']),'/');
      return $uri;
    }
  }

  //метод для обработки запроса
  public function run()
  {
    //получаем строку запроса
    $uri = $this->getURI();

    //проверяем наличие такого запроса в массиве маршрутов (routes.php)
    foreach ($this->routes as $uriPattern => $path) {

      //сравниваем $uriPattern и $uri
      if (preg_match("~$uriPattern~", $uri)) {

        //получаем внутренний путь из внешнего согласно правилу
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

        //Определить контроллер, action, параметры
        $segments = explode('/', $internalRoute);

        $controllerName = array_shift($segments).'Controller';
        $controllerName = ucfirst($controllerName);

        $actionName = 'action'.ucfirst(array_shift($segments));

        $parameters = $segments;

        //получить файл класса контроллера
        $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

        if (file_exists($controllerFile)) {
          include_once($controllerFile);
        }

        //создать объект, вызвать action
        $controllerObject = new $controllerName;

        //вызываем необходимый метод ($actionName)
        //у определенного класса ($controllerObject)
        //c заданными ($parameters) параметрами
        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

        //если метод контроллера успешно вызван - завершаем работу роутера
        if ($result != null) {
          break;
        }
      }
    }
  }
}
