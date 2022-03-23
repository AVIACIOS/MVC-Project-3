<?php
    $title = "Пост - {$post['name']}";
    @include_once __DIR__ . '/../header.php';
?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <h1 class="mt-1"><?= $post['name'] ?></h1>
            <p class="small">Автор: <?= $posts->author($post['user_id']) ?></p>
            <p><?= $post['descriptions'] ?></p>
            <hr>
            <p class="small">Ключевые слова: <?= $post['keywords'] ?></p>
        </div>
        <div class="col"></div>
    </div>
    <div class="row mt-2">
        <div class="col"></div>
        <div class="col-6 border border-1 p-3">
            <?php if(has_session('id')): ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="inputComment" class="form-label">Комментарий поста:</label>
                    <textarea
                            name="comment"
                           <?= $isError('comment', true) ?>
                           id="inputComment"
                            placeholder="Комментарий"
                            required></textarea>
                    <?= $isError('comment') ?>
                </div>
                <button type="submit" class="btn btn-success mt-1">Отправить комментарий</button>
            </form>
            <?php else: ?>
            <div class="alert alert-secondary">Авторизуйтесь, чтобы оставить комментарий <a href="/login">перейти!</a></div>
            <?php endif; ?>
        </div>
        <div class="col"></div>
    </div>
</div>
