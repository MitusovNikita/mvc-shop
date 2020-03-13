<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1>Кабинет пользователя</h1>
            <p>Привет, <?=$user['name'];?>!</p>

            <ul>
                <li><a href="/projects/mvc-shop/cabinet/edit">Редактировать данные</a></li>
                <li><a href="/projects/mvc-shop/cabinet/history">Список покупок</a></li>
            </ul>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
