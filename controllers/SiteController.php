<?php
class SiteController
{
  public function actionIndex()
  {
    $categories = array();
    $categories = Category::getCategoriesList();

    $latestProducts = Product::getLatestProducts(6);

    $sliderProducts = Product::getRecommendedProducts();

    require_once(ROOT.'/views/site/index.php');

    return true;
  }

  public function actionContact()
  {
      // Переменные для формы
      $userEmail = false;
      $userText = false;
      $result = false;
      // Обработка формы
      if (isset($_POST['submit'])) {
          // Если форма отправлена
          // Получаем данные из формы
          $userEmail = $_POST['userEmail'];
          $userText = $_POST['userText'];
          // Флаг ошибок
          $errors = false;
          // Валидация полей
          if (!User::checkEmail($userEmail)) {
              $errors[] = 'Неправильный email';
          }
          if ($errors == false) {
              // Если ошибок нет
              // Отправляем письмо администратору
              $adminEmail = 'mitusov@office11.ru';
              $message = "Текст: {$userText}. От {$userEmail}";
              $subject = 'Тема письма';
              $result = mail($adminEmail, $subject, $message);
              $result = true;
          }
      }
      // Подключаем вид
      require_once(ROOT . '/views/site/contact.php');
      return true;
  }
}
