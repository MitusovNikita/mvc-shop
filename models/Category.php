<?php

class Category
{
  //return array of categories
  public static function getCategoriesList()
  {
    $db = Db::getConnection();

    //была ошибка, если просто category
    $result = $db->query('SELECT id, name FROM mvcshop.category WHERE status = "1" ORDER BY sort_order, name ASC');

    $i = 0;
    $categoryList = array();
    while ($row = $result->fetch()) {
      $categoryList[$i]['id'] = $row['id'];
      $categoryList[$i]['name'] = $row['name'];
      $i++;
    }

    return $categoryList;
  }

  /**
   * Возвращает массив категорий для списка в админпанели
   * (при этом в результат попадают и включенные и выключенные категории)
   * @return array Массив категорий
   */
  public static function getCategoriesListAdmin()
  {
      // Соединение с БД
      $db = Db::getConnection();

      // Запрос к БД
      $result = $db->query('SELECT id, name, sort_order, status FROM mvcshop.category ORDER BY sort_order ASC');

      // Получение и возврат результатов
      $categoryList = array();
      $i = 0;
      while ($row = $result->fetch()) {
          $categoryList[$i]['id'] = $row['id'];
          $categoryList[$i]['name'] = $row['name'];
          $categoryList[$i]['sort_order'] = $row['sort_order'];
          $categoryList[$i]['status'] = $row['status'];
          $i++;
      }
      return $categoryList;
  }

  /**
   * Возвращает текстое пояснение статуса для категории :<br/>
   * 0 - Скрыта, 1 - Отображается
   * @param integer $status Статус
   * @return string Текстовое пояснение
   */
  public static function getStatusText($status)
  {
      switch ($status) {
          case '1':
              return 'Отображается';
              break;
          case '0':
              return 'Скрыта';
              break;
      }
  }

  /**
   * Добавляет новую категорию
   * @param string $name Название
   * @param integer $sortOrder Порядковый номер
   * @param integer $status Статус (включено "1", выключено "0")
   * @return boolean Результат добавления записи в таблицу
   */
  public static function createCategory($name, $sortOrder, $status)
  {
      // Соединение с БД
      $db = Db::getConnection();

      // Текст запроса к БД
      $sql = 'INSERT INTO mvcshop.category (name, sort_order, status) '
              . 'VALUES (:name, :sort_order, :status)';

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
      $result->bindParam(':status', $status, PDO::PARAM_INT);
      return $result->execute();
  }

  /**
   * Возвращает категорию с указанным id
   * @param integer $id id категории
   * @return array Массив с информацией о категории
   */
  public static function getCategoryById($id)
  {
      // Соединение с БД
      $db = Db::getConnection();

      // Текст запроса к БД
      $sql = 'SELECT * FROM mvcshop.category WHERE id = :id';

      // Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);

      // Указываем, что хотим получить данные в виде массива
      $result->setFetchMode(PDO::FETCH_ASSOC);

      // Выполняем запрос
      $result->execute();

      // Возвращаем данные
      return $result->fetch();
  }

  /**
   * Редактирование категории с заданным id
   * @param integer $id id категории
   * @param string $name Название
   * @param integer $sortOrder Порядковый номер
   * @param integer $status Статус (включено "1", выключено "0")
   * @return boolean Результат выполнения метода
   */
  public static function updateCategoryById($id, $name, $sortOrder, $status)
  {
      // Соединение с БД
      $db = Db::getConnection();

      // Текст запроса к БД
      $sql = "UPDATE mvcshop.category
          SET
              name = :name,
              sort_order = :sort_order,
              status = :status
          WHERE id = :id";

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
      $result->bindParam(':status', $status, PDO::PARAM_INT);
      return $result->execute();
  }

  /**
   * Удаляет категорию с заданным id
   * @param integer $id
   * @return boolean Результат выполнения метода
   */
  public static function deleteCategoryById($id)
  {
      // Соединение с БД
      $db = Db::getConnection();

      // Текст запроса к БД
      $sql = 'DELETE FROM mvcshop.category WHERE id = :id';

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      return $result->execute();
  }
}
