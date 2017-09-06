<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h3>1. Выбрать название города и количество сотрудников, проживающих в нём, возраст которых старше 30 лет и они созданы более 1 месяца назад.</h3>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Название города</th>
                <th>Количество людей</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cities as $city): ?>
            <tr>
                <td><?= Html::encode("{$city['name']}") ?></td>
                <td><?= Html::encode("{$city['count_staff']}") ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>