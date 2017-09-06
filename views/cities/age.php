<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h3> Показать средний возраст текущих сотрудников (статус - 0) по каждому городу.</h3>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Название города</th>
                <th>Средний возраст</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cities as $city): ?>
            <tr>
                <td><?= Html::encode("{$city['name']}") ?></td>
                <td><?= Html::encode("{$city['count_age']}") ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>