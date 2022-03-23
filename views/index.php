<?php
    $title = 'Моя главная страница';
    $javascript = [
        ['src' => 'user.js', 'defer' => true]
    ];
    @include_once 'header.php'
?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-8">Что пишут люди:</div>
        <div class="col"></div>
    </div>
    <div class="row">
        <?php foreach($posts->get() as $post): ?>
            <div class="col-12">
                <div class="alert alert-secondary">
                    <h4 class="alert-heading"><?= $post['name'] ?></h4>
                    <p><?= mb_substr($post['descriptions'], 0, 56) . '...' ?></p>
                    <hr>
                    <p class="mb-0">Автор: <?= $posts->author($post['user_id']) ?> | <a href="/posts?id=<?= $post['id'] ?>">Подробнее</a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
@include_once 'footer.php'
?>