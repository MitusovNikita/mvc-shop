<?php
class Cart
{
/**
 * Добавление товара в корзину
 * @param integer $id
 */
  public static function addProduct($id)
  {
    $id = intval($id);

    // пустой массив товаров в корзине
    $productsInCart = array();

    // если в корзине есть товары - они есть в сессии
    if (isset($_SESSION['products'])) {
        // то заполним массив товарами
        $productsInCart = $_SESSION['products'];
    }

    // Если товар добавлен в корзину повторно
    if (array_key_exists($id, $productsInCart)) {
        $productsInCart[$id]++;
    } else {
        // добавление нового товара в корзмну
        $productsInCart[$id] = 1;
    }

    $_SESSION['products'] = $productsInCart;

    return self::countItems();
  }

  /**
   * подсчет кол-ва товаров в корзине
   * @return integer
   */
   public static function countItems()
   {
       if (isset($_SESSION['products'])) {
           $count = 0;
           foreach ($_SESSION['products'] as $id => $quantity) {
               $count = $count + $quantity;
           }
           return $count;
       } else {
           return 0;
       }
   }

   /**
    * получаем массив товаров и кол-ва
    * @return array
    */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * получаем сумму цен товаров в корзине
     * @param array $products
     * @return array $total
     */
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;

        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    /**
     * очистка корзины
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
    /**
     * удаляет товар из корзины
     */
    public static function deleteProduct($id)
    {
        if (isset($_SESSION['products'][$id])) {
            unset($_SESSION['products'][$id]);
        }
    }
}
