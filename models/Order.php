<?php
/**
 * Класс Order - модель для работы с заказами
 */
class Order
{
    /**
     * Сохранение заказа
     * @param string $userName
     * @param string $userPhone
     * @param string $userComment
     * @param integer $userId
     * @param array $products
     * @return boolean
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO mvcshop.product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
        $products = json_encode($products);
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        return $result->execute();
    }
}
