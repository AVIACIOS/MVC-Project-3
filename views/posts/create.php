<?php
$title = 'Создание нового поста';
@include_once __DIR__ . '/../header.php';
?>
<div class="container mt-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <h2>Создание нового поста</h2>
            <?php if(isset($success)): ?>
                <div class="alert alert-success">Запись успешно создана!</div>
            <?php else: ?>
                <form action="" method="POST">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Наименование поста:</label>
                    <input type="text"
                           name="name"
                           <?= $isError('name', true) ?>
                           id="inputName"
                           placeholder="Укажите наименование поста"
                           required>
                    <?= $isError('name') ?>
                </div>
                <div class="mb-3">
                    <label for="inputKeywords" class="form-label">Ключевые слова:</label>
                    <input type="text"
                           name="keywords"
                           <?= $isError('keywords', true) ?>
                           id="inputKeywords"
                           placeholder="Укажите ключевые слова через запятую"
                           required>
                    <?= $isError('keywords') ?>
                </div>
                <div class="mb-3">
                    <label for="inputDescription" class="form-label">Описание поста:</label>
                    <textarea
                           name="descriptions"
                           <?= $isError('descriptions', true) ?>
                           id="inputDescription"
                           placeholder="Описание поста"
                           required></textarea>
                    <?= $isError('descriptions') ?>
                </div>
                <button type="submit" class="btn btn-success mt-1">Создать новый пост</button>
            </form>
            <?php endif; ?>
        </div>
        <div class="col"></div>
    </div>
</div>
